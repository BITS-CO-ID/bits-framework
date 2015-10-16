<?php

namespace BITS;

/**
* Manipulate String format.
*
* Allow to manipulate string.
*/
class String
{
    /**
     * Truncate a string provided by the maximum limit without breaking a word.
     *
     * @param string $str
     * @param string $max
     *
     * @return string
     */
    public function excerpt($str, $max)
    {
        if (strlen($str) > $max) {
            return substr($str, 0, $max).'...';
        } else {
            return $str;
        }
    }

    public function addComma($data)
    {
        $join = '';
        foreach ($data as $isi) {
            $join .= $isi.',';
        }
        return rtrim($join, ',');
    }
}
