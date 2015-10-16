<?php

namespace BITS;

/**
* Convert number to Romawi Format
*
* Allow to convert number to romawi format.
*/
class Number
{
    public function romawi($nomor)
    {
        $table = array(
            'M'=>1000,
            'CM'=>900,
            'D'=>500,
            'CD'=>400,
            'C'=>100,
            'XC'=>90,
            'L'=>50,
            'XL'=>40,
            'X'=>10,
            'IX'=>9,
            'V'=>5,
            'IV'=>4,
            'I'=>1
        );
        $romawi = '';
        while ($nomor > 0) {
            foreach ($table as $rom => $arb) {
                if ($nomor >= $arb) {
                    $nomor -= $arb;
                    $romawi .= $rom;
                    break;
                }
            }
        }
        return $romawi;
    }
}
