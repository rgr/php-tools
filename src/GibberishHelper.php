<?php

namespace rgr\Tools;

use Exception;
use rgr\Tools\StringHelper;

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
     * Get the base directory for assets
     *
     * @return string
     */
    private static function getAssetsBasePath()
    {
        // Try to find the project root by looking for composer.json
        $currentDir = __DIR__;
        $maxDepth = 10; // Prevent infinite loops

        for ($i = 0; $i < $maxDepth; $i++) {
            if (file_exists($currentDir . '/composer.json')) {
                return $currentDir . '/assets/gibberish/';
            }
            $parentDir = dirname($currentDir);
            if ($parentDir === $currentDir) {
                break; // Reached filesystem root
            }
            $currentDir = $parentDir;
        }

        // Fallback to relative path from current directory
        return 'assets/gibberish/';
    }

    /**
     * Validate and get file path with proper error handling
     *
     * @param string $language
     * @param string $fileType
     * @return string
     * @throws Exception
     */
    private static function getFilePath($language, $fileType)
    {
        $basePath = self::getAssetsBasePath();
        $languageDir = $basePath . $language . '/';

        // Validate language directory exists
        if (!is_dir($languageDir)) {
            throw new Exception("Language directory not found: {$language}");
        }

        $filePath = $languageDir . $fileType . '_' . $language . '.txt';

        if ($fileType === 'prob') {
            $filePath = $languageDir . $fileType . '_' . $language . '.json';
        }

        if (!file_exists($filePath)) {
            throw new Exception("File not found: {$filePath}");
        }

        if (!is_readable($filePath)) {
            throw new Exception("File not readable: {$filePath}");
        }

        return $filePath;
    }

    /**
    *
    * Computes probability matrix of letters following others in a given language using markov chains
    *
    * @param string $language ISO-2 representation of language to train
    *                         Must have the valid files in the language directory
    *
    * @return json
    */
    public static function train($language = 'fr')
    {
        $string = new StringHelper();

        // Validate language parameter
        if (!is_string($language) || strlen($language) !== 2) {
            throw new Exception('Language must be a 2-character ISO code.');
        }

        // Get file paths with proper validation
        try {
            $corpusFile = self::getFilePath($language, 'corpus');
            $examplesGoodFile = self::getFilePath($language, 'examples_good');
            $examplesBadFile = self::getFilePath($language, 'examples_bad');
        } catch (Exception $e) {
            throw new Exception('File access error: ' . $e->getMessage());
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
        if ($lines === false) {
            throw new Exception('Failed to read corpus file: ' . $corpusFile);
        }

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
        if ($goodLines === false) {
            throw new Exception('Failed to read good examples file: ' . $examplesGoodFile);
        }

        $goodProbs = [];
        foreach ($goodLines as $line) {
            array_push($goodProbs, self::probability($line, $logProbMatrix));
        }

        $badLines = file($examplesBadFile);
        if ($badLines === false) {
            throw new Exception('Failed to read bad examples file: ' . $examplesBadFile);
        }

        $badProbs = [];
        foreach ($badLines as $line) {
            array_push($badProbs, self::probability($line, $logProbMatrix));
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
            'matrix'    => $logProbMatrix,
        ];

        $outputFile = dirname($corpusFile) . '/prob_' . $language . '.json';
        $fp = fopen($outputFile, 'w');
        if ($fp === false) {
            throw new Exception('Failed to create output file: ' . $outputFile);
        }

        $jsonResult = json_encode($result);
        if ($jsonResult === false) {
            fclose($fp);
            throw new Exception('Failed to encode JSON result');
        }

        $writeResult = fwrite($fp, $jsonResult);
        fclose($fp);

        if ($writeResult === false) {
            throw new Exception('Failed to write to output file: ' . $outputFile);
        }

        return $result;
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
    public static function isGibberish($str, $language = 'fr')
    {
        // Validate input parameters
        if (!is_string($str)) {
            throw new Exception('Input string must be a string.');
        }

        if (!is_string($language) || strlen($language) !== 2) {
            throw new Exception('Language must be a 2-character ISO code.');
        }

        try {
            $probFile = self::getFilePath($language, 'prob');
        } catch (Exception $e) {
            throw new Exception('Probability file access error: ' . $e->getMessage());
        }

        $jsondata = file_get_contents($probFile);
        if ($jsondata === false) {
            throw new Exception('Failed to read probability file: ' . $probFile);
        }

        $prob = json_decode($jsondata, true);
        if ($prob === null) {
            throw new Exception('Failed to decode JSON from probability file: ' . $probFile);
        }

        if (!isset($prob['matrix']) || !isset($prob['threshold'])) {
            throw new Exception('Invalid probability file format: missing matrix or threshold');
        }

        $gibberishProb = self::probability($str, $prob['matrix']);

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
    private static function probability($str, $matrix)
    {
        $string = new StringHelper();
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
