<?php

namespace rgr\Tools;

/**
*
* @author    Raphaël Grasset
* @copyright 2016 Raphaël Grasset
* @license   Proprietary
* @version   1.0
*/
class ArrayHelper
{
    /**
    *
    * Shuffles an associative array and preserves the keys
    *
    * @param array $array An associative array
    *
    * @return array
    */
    public static function shuffleAArray($array)
    {
        $keys = array_keys($array);
        shuffle($keys);

        $shuffle = [];
        foreach ($keys as $key) {
            $shuffle[$key] = $array[$key];
        }

        return $shuffle;
    }

    /**
    *
    * Sorts an associative array by key and reinitializes the keys
    *
    * @param array $array Associative array to sort
    * @param string $sortKey Key to use for sorting
    * @param int $order Order in which the array has to be sorted ('SORT_DESC', 'SORT_ASC')
    *
    * @return array
    */
    public static function sortAArray($array, $sortKey, $order = SORT_DESC)
    {
        foreach ($array as $key => $row) {
            $sort[$key] = $row[$sortKey];
        }

        array_multisort($sort, $order, $array);

        return array_values($array);
    }

    /**
    *
    * Transforms the non numerical features of an array to integers
    *
    * @param array $dataset An associative array
    * @param array $features Index of the features to preserve (ex : 'x0', 'x1', 'x3')
    *
    * @return array
    */
    public static function numericalIndex($dataset, $features = null)
    {
        $featuresNb = count(next($dataset));
        $arrayIndex = [];

        //Index creation
        foreach ($dataset as $data) {
            for ($i = 0; $i < $featuresNb; ++$i) {
                if (!isset(${'feature' . $i})) {
                    ${'feature' . $i} = [];
                }

                if (is_null($features) or !in_array('x' . $i, $features)) {
                    if (!in_array($data[$i], ${'feature' . $i})) {
                        ${'feature' . $i}[] = $data[$i];
                    }
                }
            }
        }

        //Values replacement
        foreach ($dataset as $datak => $datav) {
            for ($i = 0; $i < $featuresNb; ++$i) {
                $arrayIndex[$datak][$i] = $datav[$i];

                if (is_null($features) or !in_array('x' . $i, $features)) {
                    $arrayIndex[$datak][$i] = array_search($datav[$i], ${'feature' . $i});
                }
            }
        }

        return $arrayIndex;
    }
}
