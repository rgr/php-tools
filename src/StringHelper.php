<?php

namespace LearningRaph\Tools;

/**
*
* @author    Raphaël Grasset
* @copyright 2016 Raphaël Grasset
* @license   Proprietary
* @version   1.0
*/
class StringHelper
{
    /**
    *
    * Generate a random string
    *
    * @param int $lenght Length of the string
    * @param string $type Type of output string ('alphabetic', 'alphanumeric', 'numeric')
    *
    * @return string
    */
    public function random($length = 8, $type = 'alphanumeric')
    {
        $string = '';

        if ($type == 'alphanumeric') {
            $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        } elseif ($type == 'alphabetic') {
            $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        } elseif ($type == 'numeric') {
            $pool = '0123456789';
        }

        for ($i = 0; $i < $length; ++$i) {
            $char = substr($pool, mt_rand(0, strlen($pool) - 1), 1);
            $string .= $char;
        }

        return $string;
    }

    /**
    *
    * Generate a secure token
    *
    * @param int $lenght Length of the token
    *
    * @return string
    */
    public function token($length = 32)
    {
        if (!isset($length) || intval($length) <= 8) {
            $length = 32;
        }

        if (function_exists('random_bytes')) {
            return bin2hex(random_bytes($length));
        }
        if (function_exists('mcrypt_create_iv')) {
            return bin2hex(mcrypt_create_iv($length, MCRYPT_DEV_URANDOM));
        }
        if (function_exists('openssl_random_pseudo_bytes')) {
            return bin2hex(openssl_random_pseudo_bytes($length));
        }
    }

    /**
    *
    * Clean string of accents, urls, punctuation and numbers
    *
    * @param string $str
    *
    * @return string
    */
    public function clean($str)
    {
        $str = $this->removeAcents($str);

        $str = $this->removeUrls($str);

        $str = $this->removePunctuation($str);

        $str = $this->removeAllButLetters($str);

        return trim($str);
    }

    /**
    *
    * Remove accents from string
    *
    * @param string $str
    *
    * @return string
    */
    public function removeAcents($str)
    {
        $accents = [
            'Á'=> 'A', 'À'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Å'=>'A', 'Ä'=>'A', 'Æ'=>'AE', 'Ç'=>'C',
            'É'=> 'E', 'È'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Í'=>'I', 'Ì'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ð'=>'Eth',
            'Ñ'=> 'N', 'Ó'=>'O', 'Ò'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O',
            'Ú'=> 'U', 'Ù'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y',

            'á'=> 'a', 'à'=>'a', 'â'=>'a', 'ã'=>'a', 'å'=>'a', 'ä'=>'a', 'æ'=>'ae', 'ç'=>'c',
            'é'=> 'e', 'è'=>'e', 'ê'=>'e', 'ë'=>'e', 'í'=>'i', 'ì'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'eth',
            'ñ'=> 'n', 'ó'=>'o', 'ò'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o',
            'ú'=> 'u', 'ù'=>'u', 'û'=>'u', 'ü'=>'u', 'ý'=>'y',
            'ß'=> 'sz', 'þ'=>'thorn', 'ÿ'=>'y', ];

        $str = strtr($str, $accents);

        // Normalize apostrophe style
        $str = preg_replace('/(’|\'|ʼ)/', '’', $str);

        // Delete double or more whitespaces
        $str = preg_replace('/  +/', ' ', $str);

        return trim($str);
    }

    /**
    *
    * Remove numbers from string
    *
    * @param string $str
    *
    * @return string
    */
    public function removeNumbers($str)
    {
        $str = preg_replace('/[0-9]+/', ' ', $str);

        // Delete double or more whitespaces
        $str = preg_replace('/  +/', ' ', $str);

        return trim($str);
    }

    /**
    *
    * Remove everything that is not a letter
    *
    * @param string $str
    *
    * @return string
    */
    public function removeAllButLetters($str)
    {
        $str = $this->removeAcents($str);
        $str = preg_replace('/[^a-zA-Z]/i', ' ', $str);

        // Delete double or more whitespaces
        $str = preg_replace('/  +/', ' ', $str);

        return trim($str);
    }

    /**
    *
    * Remove urls from string
    *
    * @param string $str
    *
    * @return string
    */
    public function removeUrls($str)
    {
        $str = preg_replace('#((https?|ftp)://(\S*?\.\S*?))([\s)\[\]{},;"\':<]|\.\s|$)#i', ' ', $str);

        // Delete double or more whitespaces
        $str = preg_replace('/  +/', ' ', $str);

        return trim($str);
    }

    /**
    *
    * Remove punctuation from string
    *
    * @param string $str
    *
    * @return string
    */
    public function removePunctuation($str)
    {
        $str = preg_replace('#[[:punct:]]#', '', $str);

        // Delete double or more whitespaces
        $str = preg_replace('/  +/', ' ', $str);

        return trim($str);
    }

    /**
    *
    * Compute the similarity between two strings (max 255 char) based on the levenshtein distance
    *
    * @param string $str1
    * @param string $str2
    *
    * @return int
    */
    public function similarity($str1, $str2)
    {
        $str1 = $this->clean($str1);
        $str2 = $this->clean($str2);

        $lev = round((1 - levenshtein($str1, $str2) / max(strlen($str1), strlen($str2))) * 100);

        return $lev;
    }
}
