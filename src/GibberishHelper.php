<?php


namespace rgr\Tools;

use Exception;

/**
 *
 * Detects if a string is gibberish or real text
 *
 * @author    Raphaël Grasset
 * @copyright 2020 Raphaël Grasset
 * @license   Proprietary
 * @version   1.0
 */
class GibberishHelper
{
    protected static $accepted = 'abcdefghijklmnopqrstuvwxyz ';

    /**
    *
    * Computes probability matrix of letters following others in a given language using markov chains
    *
    * @param string $language ISO-2 representation of language to train
    *                         Must have the valid files in the language directory
    *
    * @return json
    */
    public function train($language = 'fr')
    {
        $string = new Str();
        $corpusFile = 'assets/gibberish/' . $language . '/corpus_' . $language . '.txt';
        $examplesGoodFile = 'assets/gibberish/' . $language . '/examples_good_' . $language . '.txt';
        $examplesBadFile = 'assets/gibberish/' . $language . '/examples_bad_' . $language . '.txt';

        if (!file_exists($corpusFile)) {
            throw new Exception('Corpus file not found (' . $language . ').');
        }
        if (!file_exists($examplesGoodFile)) {
            throw new Exception('Good examples file not found (' . $language . ').');
        }
        if (!file_exists($examplesBadFile)) {
            throw new Exception('Bad examples file not found (' . $language . ').');
        }

        // Initialize probability matrix
        // Assumes each pair has been seen at least 10 times so the probability
        // of being gibberish won't be 0 if we meet an unobserved characgter.
        $k = strlen(self::$accepted);
        $pos = array_flip(str_split(self::$accepted));

        $logProbMatrix = [];
        $range = range(0, count($pos) - 1);
        foreach ($range as $index1) {
            $array = [];
            foreach ($range as $index2) {
                $array[$index2] = 10;
            }
            $logProbMatrix[$index1] = $array;
        }

        // Count number of transition from corpus
        $lines = file($corpusFile);
        foreach ($lines as $line) {
            // Return all n grams from l after normalizing
            $filteredLine = str_split(strtolower($string->clean($line)));
            $a = false;
            foreach ($filteredLine as $b) {
                if ($a !== false) {
                    $logProbMatrix[$pos[$a]][$pos[$b]] += 1;
                }
                $a = $b;
            }
        }
        unset($lines, $filteredLine);

        // Normalize the counts so that they become log probabilities
        // This is to avoid numeric underflow issues with long texts
        foreach ($logProbMatrix as $i => $row) {
            $s = (float) array_sum($row);
            foreach ($row as $k => $j) {
                $logProbMatrix[$i][$k] = log($j / $s);
            }
        }

        // Find the probability of generating a few arbitrarily choosen good and bad phrases.
        $goodLines = file($examplesGoodFile);
        $goodProbs = [];
        foreach ($goodLines as $line) {
            array_push($goodProbs, $this->probability($line, $logProbMatrix));
        }
        $badLines = file($examplesBadFile);
        $badProbs = [];
        foreach ($badLines as $line) {
            array_push($badProbs, $this->probability($line, $logProbMatrix));
        }
        // Assert that we actually are capable of detecting the junk.
        $minGoodProbs = min($goodProbs);
        $maxBadProbs = max($badProbs);

        if ($minGoodProbs <= $maxBadProbs) {
            throw new Exception('Bad probabilities is superior to good probabilities in training examples.');
        }

        // And pick a threshold halfway between the worst good and best bad inputs.
        $threshold = ($minGoodProbs + $maxBadProbs) / 2;

        // save matrix
        $result = [
            'threshold' => $threshold,
            'matrix'    => $logProbMatrix, ];
        $fp = fopen('assets/gibberish/' . $language . '/prob_' . $language . '.json', 'w');
        fwrite($fp, json_encode($result));
        fclose($fp);
    }

    /**
    *
    * Predicts if given string is gibberish
    *
    * @param string $str String of text to assess
    * @param string $language ISO-2 representation of language to assess
    *
    * @return bool
    */
    public function isGibberish($str, $language = 'fr')
    {
        $probFile = 'assets/gibberish/' . $language . '/prob_' . $language . '.json';
        if (!file_exists($probFile)) {
            throw new Exception('Probability file not found (' . $language . ').');
        }

        $jsondata = file_get_contents($probFile);
        $prob = json_decode($jsondata, true);

        $gibberishProb = $this->probability($str, $prob['matrix']);

        $result = false;
        if ($gibberishProb < $prob['threshold']) {
            $result = true;
        }

        return $result;
    }

    /**
    *
    * Predicts if given string is gibberish
    *
    * @param string $str String of text to assess
    * @param array $matrix Matrix of log prabability of letters following letters
    *
    * @return int
    */
    private function probability($str, $matrix)
    {
        $string = new Str();
        $logProb = 1.0;
        $transitionCt = 0;

        $pos = array_flip(str_split(self::$accepted));
        $filteredStr = str_split(strtolower($string->clean($str)));

        $a = false;
        foreach ($filteredStr as $b) {
            if ($a !== false) {
                $logProb += $matrix[$pos[$a]][$pos[$b]];
                $transitionCt += 1;
            }
            $a = $b;
        }
        // The exponentiation translates from log probs to probs.
        return exp($logProb / max($transitionCt, 1));
    }
}
