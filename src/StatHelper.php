<?php


namespace LearningRaph\Tools;

use Exception;

/**
*
* @author    Raphaël Grasset
* @copyright 2016 Raphaël Grasset
* @license   Proprietary
* @version   1.0
*/
class StatHelper
{
    /**
    *
    * Calculates the Euclidean distance between two points of n dimensions
    *
    * @param array $a A point of n dimensions
    * @param array $b A point of n dimensions
    *
    * @return int
    */
    public function euclideanDistance($a, $b)
    {
        if (count($a) != count($b)) {
            throw new Exception('Euclidean distance calculation impossible : data are not the same size');
        }

        $squareSum = 0;

        foreach ($a as $item => $value) {
            if (array_key_exists($item, $b)) {
                $squareSum += ($value - $b[$item]) * ($value - $b[$item]);
            }
        }

        return abs($squareSum);
    }

    /**
    *
    * Creates a matrix of the Euclidean distance between all the points of a dataset
    *
    * @param array $dataset A set of points with n features
    *
    * @return array
    */
    public function euclideanDistanceMatrix($dataset)
    {
        $dataMatrix = [];
        $MatrixA = $dataset;
        $MatrixB = $dataset;

        foreach ($MatrixA as $Akey => $Avalue) {
            foreach ($MatrixB as $Bkey => $Bvalue) {
                $dataMatrix[$Akey][$Bkey] = $this->EuclideanDistance($Avalue, $Bvalue);
            }
        }

        return $dataMatrix;
    }

    /**
    *
    * Calculates the center of gravity of a set of points with n features
    * Some points can be enhanced to weight more than others
    *
    * @param array $dataset A set of points with n features
    * @param array $features Index of the features to enhance (ex : 'x0', 'x1', 'x3')
    * @param array $weight How much to enhance the features by
    *
    * @return array
    */
    public function centroid($dataset, $features = null, $weight = 1.2)
    {
        $centroid = [];
        $featuresNb = count($dataset[array_rand($dataset)]);
        $n = 0;

        //Initialize all the features
        for ($i = 0; $i < $featuresNb; ++$i) {
            ${'x' . $i} = null;
        }

        //Add all the features
        foreach ($dataset as $data) {
            ++$n;
            for ($i = 0, $nb = count($data); $i < $nb; ++$i) {
                ${'x' . $i} += $data[$i];
            }
        }

        //Minimizes the Euclidian distance and create coordinates
        for ($i = 0; $i < $featuresNb; ++$i) {
            //If the feature is considered important, we apply a weight
            if (!is_null($features) && in_array('x' . $i, $features)) {
                array_push($centroid, round((${'x' . $i} * $weight) / $n));
            } else {
                array_push($centroid, round(${'x' . $i} / $n));
            }
        }

        return $centroid;
    }

    /**
    *
    * Calculates the arithmetic mean of a set of values
    *
    * @param array $array A set of values
    *
    * @return int
    */
    public function arithmeticMean($array)
    {
        return array_sum($array) / count($array);
    }

    /**
    *
    * Calculates the geometric mean of a set of values
    *
    * @param array $array A set of values
    *
    * @return int
    */
    public function geometricMean($array)
    {
        foreach ($array as $i => $n) {
            if ($i == 0) {
                $mean = $n;
            } else {
                if ($n == 0) {
                    $mean = $mean;
                } else {
                    $mean = $mean * $n;
                }
            }
        }

        return pow($mean, 1 / count($array));
    }

    /**
    *
    * Calculates the harmonic mean of a set of values
    *
    * @param array $array A set of values
    *
    * @return int
    */
    public function harmonicMean($array)
    {
        $sum = 0;
        foreach ($array as $n) {
            if ($n == 0) {
                $sum += 1;
            } else {
                $sum += 1 / $n;
            }
        }

        return (1 / $sum) * count($array);
    }

    /**
    *
    * Calculates the median of a set of values
    *
    * @param array $array A set of values
    *
    * @return int
    */
    public function median($array)
    {
        return $this->quantile($array, 0.5);
    }

    /**
    *
    * Calculates the standard deviation of a set of values
    *
    * @param array $array A set of values
    *
    * @return int
    */
    public function standardDeviation($array)
    {
        if (count($array) < 2) {
            return;
        }

        $avg = $this->arithmeticMean($array);

        $sum = 0;
        foreach ($array as $value) {
            $sum += ($value - $avg) * ($value - $avg);
        }

        return sqrt((1 / (count($array) - 1)) * $sum);
    }

    /**
    *
    * Calculates the quantile of a set of values
    *
    * @param array $array A set of values
    * @param int $quantile The desired quantile (between 0 and 1)
    *
    * @return int
    */
    public function quantile($array, $quantile = 0)
    {
        if ($quantile < 0 or $quantile > 1) {
            throw new Exception('Quantile must be between 0 and 1');
        }

        $count = count($array);
        $allIndex = ($count - 1) * $quantile;
        $intValIndex = intval($allIndex);
        $floatVal = $allIndex - $intValIndex;

        sort($array);

        if (!is_float($floatVal)) {
            $result = $array[$intValIndex];
        } else {
            if ($count > $intValIndex + 1) {
                $result = $floatVal * ($array[$intValIndex + 1] - $array[$intValIndex]) + $array[$intValIndex];
            } else {
                $result = $array[$intValIndex];
            }
        }

        return $result;
    }

    /**
    *
    * Compute descriptive stats on a distribution
    *
    * @param array $array Array of values
    * @param int $precision Number of figures after the comma
    *
    * @return array
    */
    public function describe($array, $precision = 0)
    {
        $stats = [
            'n'         => count($array),
            'min'       => Min($array),
            'q1'        => round($this->quantile($array, 0.25), $precision),
            'mean'      => round($this->arithmeticMean($array), $precision),
            'median'    => round($this->median($array), $precision),
            'q3'        => round($this->quantile($array, 0.75), $precision),
            'max'       => Max($array),
            'sd'        => round($this->standardDeviation($array), $precision + 1),
        ];

        return $stats;
    }

    /**
    *
    * Compute the number or the percentage of a set of values between $min and $max
    *
    * @param array $array Array of values
    * @param int $min The minimum interval
    * @param int $min The maximum interval
    * @param int $n Total number of values from wich $array comes
    *
    * @return int A percentage if $n is not null, a number overwise
    */
    public function inBetween($array, $min, $max, $n = null)
    {
        $total = [];
        foreach ($array as $value) {
            if ($value >= $min and $value <= $max) {
                $total[] = $value;
            }
        }

        $totalN = count($total);
        if ($n == null) {
            return $totalN;
        } else {
            return round(($totalN / $n) * 100, 1);
        }
    }

    /**
    *
    * Compute the percentage of the value of each key compare to other values
    *
    * @param array $array Array of values
    *
    * @return array Array of percentage
    */
    public function toPercent($array)
    {
        $arrayNb = array_sum($array);

        if ($arrayNb == 0) {
            throw new Exception('Not enough data given');
        }

        foreach ($array as $key => $value) {
            $array[$key] = round(($value / $arrayNb) * 100, 1);
        }

        return $array;
    }

    /**
    *
    * Converts the score of a X points likert scale to a Y points likert scale
    *
    * @param int $score The score to convert
    * @param int $inMin Minimum of the input scale
    * @param int $inMax Maximum of the input scale
    * @param int $outMin Minimum of the output scale
    * @param int $outMax Maximum of the output scale
    *
    * @return int
    */
    public function likertConvert($score, $inMin = 1, $inMax = 5, $outMin = 1, $outMax = 4)
    {
        return ($outMax - $outMin) * ($score - $inMin) / ($inMax - $inMin) + $outMin;
    }
}
