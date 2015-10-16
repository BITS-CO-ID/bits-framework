<?php

namespace BITS;

/**
* Convert Date Format
*
* Allow to generate format from date().
*/
class Date
{
    /**
     * Convert Date Format.
     * @param  date $date Date generated from date().
     * @param  string $type stripe, slash, time
     * @return date  Date formatted.
     */
    public function convert($date, $type = "stripe")
    {
        if ($type == "stripe") {
            $data = date('d - F - Y', strtotime($date));
        } elseif ($type == "slash") {
            $data = date('d/m/Y', strtotime($date));
        } elseif ($type == "time") {
            $data = date('d M Y, h:i', strtotime($date));
        } else {
            $data = date('Y-m-d');
        }
        return $data;
    }
}
