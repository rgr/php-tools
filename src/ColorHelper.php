<?php

namespace rgr\Tools;

/**
*
* @author    Raphaël Grasset
* @copyright 2016 Raphaël Grasset
* @license   Proprietary
* @version   1.0
*/
class ColorHelper
{
    /**
    *
    * Converts a color from HEX to RGB
    *
    * @param string $hex The color in Hexadecimal (#FFFFFF or FFFFFF)
    *
    * @return array
    */
    public static function hex2rgb($hex)
    {
        if (strlen($hex) == 7) {
            $hex = substr($hex, 1, 6);
        }

        $hexR = substr($hex, 0, 2);
        $hexG = substr($hex, 2, 2);
        $hexB = substr($hex, 4, 2);

        return [hexdec($hexR), hexdec($hexG), hexdec($hexB)];
    }

    /**
    *
    * Converts a color from RGB to HEX
    *
    * @param int $R The Red color value
    * @param int $G The Green color value
    * @param int $B The Blue color value
    *
    * @return string
    */
    public static function rgb2hex($R, $G, $B)
    {
        $hexR = dechex($R);
        if (strlen($hexR) < 2) {
            $hexR = '0' . $hexR;
        }
        $hexG = dechex($G);
        if (strlen($hexG) < 2) {
            $hexG = '0' . $hexG;
        }
        $hexB = dechex($B);
        if (strlen($hexB) < 2) {
            $hexB = '0' . $hexB;
        }

        return '#' . $hexR . $hexG . $hexB;
    }

    /**
    *
    * Converts a color from RGB to HSV
    *
    * @param int $R The Red color value
    * @param int $G The Green color value
    * @param int $B The Blue color value
    *
    * @return array
    */
    public static function rgb2hsv($R, $G, $B)
    {
        $R = ($R / 255);
        $G = ($G / 255);
        $B = ($B / 255);

        $maxRgb = max($R, $G, $B);
        $minRgb = min($R, $G, $B);
        $chroma = $maxRgb - $minRgb;

        $Value = 100 * $maxRgb;

        if ($chroma == 0) {
            return [0, 0, $Value];
        }

        $Saturation = 100 * ($chroma / $maxRgb);

        $h = 5 - (($B - $R) / $chroma);

        if ($R == $minRgb) {
            $h = 3 - (($G - $B) / $chroma);
        } elseif ($B == $minRgb) {
            $h = 1 - (($R - $G) / $chroma);
        }

        $Hue = 60 * $h;

        return [$Hue, $Saturation, $Value];
    }
}
