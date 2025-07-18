<?php

namespace rgr\Tools;

use Exception;

/**
*
* Clustering Component
*
* @author    Raphaël Grasset
* @copyright 2014 Raphaël Grasset
* @license   Proprietary
* @version   1.2.0
*/
class ClusteringHelper
{
    //  K-Mean Clustering
    //------------------------------------------------------------------------------

    /**
    *
    * Run the K-Means Algorithm
    *
    * @param array $dataset A set of points with n features
    * @param array $k Number of clusters to create
    * @param array $features Names of the features to enhance (x0,x1,x3)
    * @param string $return 'IDValues' : returns ID + values, 'ID' : returns only ID
    *
    * @return array
    */
    public static function kMeans($dataset, $k = 2, $features = null, $return = 'IDValues')
    {
        //Data check
        if (count($dataset) === 0 or is_null($dataset)) {
            throw new Exception('Not enough data given');
        }
        if ($k < 2 or is_null($k)) {
            throw new Exception('Number of wanted clusters cannot be less than 2');
        }
        if ($k > count($dataset)) {
            throw new Exception('Number of wanted clusters cannot be superior to the number of data provided');
        }

        //Initialization of the centroids points
        if (count($dataset) < 100) {
            // With smaller dataset, using the Diagonal initialization technique is more accurate and quicker
            // It will calculate the path that cross all dimensions diagonally and align at equal distance all
            // the centroids to maximize the covered surface and distance between each of them.
            $centroids = self::initializeCentroidsDiagonal($dataset, $k);
        } else {
            // With bigger dataset, we can use random initialization for good and quick results
            // It will initialize the centroids at the coordinates of some randomly chosen data coordinates from the set.
            $centroids = self::initializeCentroidsRandom($dataset, $k);
        }
        $mapping = [];

        while (true) {
            //Assign centroids
            $newMapping = self::assignCentroids($dataset, $centroids);

            //If no data has moved to another centroid that means the clusters are found
            if ($mapping != $newMapping) {
                $mapping = $newMapping;
            } else {
                return self::kMeansFormatResults($newMapping, $return);
            }

            //Move centroids
            $centroids = self::moveCentroids($mapping, $features);
        }
    }

    /**
    *
    * Initialize centroids position by aligning all centroids on the path that cross all dimensions diagonally
    *
    * @param array $dataset A set of points with n features
    * @param array $k Number of clusters to create
    *
    * @return array
    */
    private static function initializeCentroidsDiagonal($dataset, $k)
    {
        $centroids = [];
        $featuresNb = count($dataset[array_rand($dataset)]);
        $n = 0;

        //Initialize all the features
        for ($i = 0; $i < $featuresNb; ++$i) {
            ${'x' . $i . 'Max'} = null;
            ${'x' . $i . 'Min'} = null;
        }

        //For every centroid wanted...
        for ($ki = 0; $ki < $k; ++$ki) {
            $coordinates = [];

            //...We calculate each of its features position
            for ($i = 0; $i < $featuresNb; ++$i) {
                //Get Maximum and Minimum value of each dimension
                foreach ($dataset as $datak => $datav) {
                    if (is_null(${'x' . $i . 'Max'}) or ${'x' . $i . 'Max'} < $datav[$i]) {
                        ${'x' . $i . 'Max'} = $datav[$i];
                    }
                    if (is_null(${'x' . $i . 'Min'}) or ${'x' . $i . 'Min'} > $datav[$i]) {
                        ${'x' . $i . 'Min'} = $datav[$i];
                    }
                }

                //Calculates the position of the centroid on the dimension's grid
                $coordinate = round(((${'x' . $i . 'Max'} - ${'x' . $i . 'Min'}) / 100) * (100 / ($k + 1)) * ($ki + 1));

                array_push($coordinates, $coordinate);
            }

            $centroids[$ki] = $coordinates;
        }

        return $centroids;
    }

    /**
    *
    * Initialize centroids position on randomly chozen dataset's points
    *
    * @param array $dataset A set of points with n features
    * @param array $k Number of clusters to create
    *
    * @return array
    */
    private static function initializeCentroidsRandom($dataset, $k)
    {
        $centroids = [];

        for ($i = 0; $i < $k; ++$i) {
            $dataRand = array_rand($dataset);
            $centroids[$i] = $dataset[$dataRand];
            //Unset the data point for it not to be used again as an initialization point
            unset($dataset[$dataRand]);
        }

        return $centroids;
    }

    /**
    *
    * Calculates the distance between data points and centroids
    *
    * @param array $dataset A set of points with n features
    * @param array $centroids Cluster centroids
    *
    * @return array
    */
    private static function assignCentroids($dataset, $centroids)
    {
        $map = [];

        foreach ($dataset as $dataID => $datavalue) {
            $minDistance = null;
            $minCentroid = null;

            foreach ($centroids as $centroidID => $centroidvalue) {
                //Distance between the data and the centroid
                $dist = StatHelper::euclideanDistance($datavalue, $centroidvalue);
                //If it's closer we save the centroid ID
                if ($minDistance == null or $dist < $minDistance) {
                    $minDistance = $dist;
                    $minCentroid = $centroidID;
                }
            }

            $map[$minCentroid][$dataID] = $datavalue;
        }

        return $map;
    }

    /**
    *
    * Calculates the coordinates of the centroid in the middle of it's new mapping group
    *
    * @param array $mapping Non final cluster
    *
    * @return array
    */
    private static function moveCentroids($mapping, $features)
    {
        $centroids = [];

        foreach ($mapping as $centroidID => $data) {
            //Set centroid new coordinates
            $centroids[$centroidID] = StatHelper::centroid($data, $features);
        }

        return $centroids;
    }

    /**
    *
    * Format the results to return
    *
    * @param array $mapping Non final cluster
    * @param string $return 'IDValues' : returns ID + values, 'ID' : returns only ID
    *
    * @return array
    */
    private static function kMeansFormatResults($mapping, $return)
    {
        $cluster = [];

        if ($return === 'ID') {
            foreach ($mapping as $centroidID => $data) {
                foreach ($data as $dataID => $datavalue) {
                    $cluster[$centroidID][] = $dataID;
                }
            }
        } else {
            $cluster = $mapping;
        }

        return $cluster;
    }
}
