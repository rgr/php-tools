<?php


namespace rgr\Tools;

use Exception;

/**
*
* Clustering Component
*
* @author    Raphaël Grasset
* @copyright 2016 Raphaël Grasset
* @license   Proprietary
* @version   1.0
*/
class SampleHelper
{
    /**
    *
    * Run the Sampling Algorithm to select a population based on its characteristicts or at random
    *
    * @param array $dataset A set of data with or whitout n features
    * @param int $sampleSize Size of the final sample
    * @param string $method You can choose between :
    *     - 'characteristic' : based on n (n>=2) characteristics of a population (age, location, etc...)
    *     - 'probabilistic' : systematic probabilistic sampling
    * @param string $return 'IDValues' : returns ID + values, 'ID' : returns only ID
    *
    * @return array
    */
    public function extractSample($dataset, $sampleSize = null, $method = 'characteristic', $return = 'ID')
    {
        $clustering = new Clustering();
        $arr = new Arr();

        if ($dataset === 0 or is_null($dataset)) {
            throw new Exception('Dataset cannot be null');
        }

        //Suffle data set to improve randmoness
        $dataset = $arr->shuffleAArray($dataset);

        if ($method == 'characteristic') {
            //Calculates the number of features to make as many clusters
            $featuresNb = count(next($dataset));

            //Create the clusters
            $clusters = $clustering->kMeans($dataset, $featuresNb, null, 'IDValues');

            //Calculates how many samples to take in each cluster
            $samplesPerCluster = ceil($sampleSize / count($clusters));

            foreach ($clusters as $cluster) {
                if (count($cluster) < $samplesPerCluster) {
                    foreach ($cluster as $datak => $datav) {
                        $sample[$datak] = $datav;
                    }
                } else {
                    $sub = count($cluster) - $samplesPerCluster;

                    for ($i = 0; $i < $sub; ++$i) {
                        array_pop($cluster);
                    }

                    foreach ($cluster as $datak => $datav) {
                        $sample[$datak] = $datav;
                    }
                }
            }

            //If we have selected to many samples
            if (count($sample) > $sampleSize) {
                $sub = count($sample) - $sampleSize;

                for ($i = 0; $i < $sub; ++$i) {
                    array_pop($sample);
                }
            }
        } elseif ($method == 'probabilistic') {
            $i = 0;
            //Selects the first $sampleSize elements (dataset has been shuffled before)
            foreach ($dataset as $datak => $datav) {
                if ($i < $sampleSize) {
                    $sample[$datak] = $datav;
                }
                ++$i;
            }
        }

        //Format the data to return
        if ($return === 'ID') {
            return array_keys($sample);
        }

        return $sample;
    }

    /**
    *
    * Calculates the needed size of the sample considering the wanted confidence and the acceptable error rate
    *
    * @param int $datasetSize The size of your dataset
    * @param int $confidence Represents the chances of a mistake (1.96 represents a 95% confidence rate)
    * @param int $representation Percentage of people expressing the observed caracteristic (0.5 for a population without anything specific to observe)
    * @param int $error Represents the span of the error (0.05 represents a +-5% error)
    * @param int $margin Number of people (in percent, based on the dataset size) you want to had in case the person does not answer, answers badly, etc.
    *
    * @return int
    */
    public function sampleSize($datasetSize = null, $confidence = 1.96, $representation = 0.5, $error = 0.03, $margin = 5)
    {
        if ($datasetSize === 0 or is_null($datasetSize)) {
            throw new Exception('Dataset size cannot be null');
        }

        $n = round((($confidence * $confidence) * $representation * (1 - $representation)) / ($error * $error));

        //Adds some security to the panel by adding a margin
        $n = $n + ceil($datasetSize / 100 * $margin);

        //If the needed sample size is greater than the actual dataset, we apply a correction factor
        if ($datasetSize < $n) {
            $n = round($n / (1 + ($n + 1) / $datasetSize));
        }

        return $n;
    }
}
