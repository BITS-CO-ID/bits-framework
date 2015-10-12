<?php

namespace BITS;

/**
 * BITS Shopping Cart.
 *
 * Class to simply use Shopping Cart support PDO and PHP OOP.
 * This script written with Object Oriented Style (PSR-2) and use static method.
 *
 * @author Nurul Imam
 *
 * @link https://bits.co.id Banten IT Solutions
 *
 * @version 1.1
 */
class Cart
{
    public static function add($sesname, $code, $qty)
    {
        if (!isset($_SESSION[$sesname][$code]['qty'])) {
            $_SESSION[$sesname][$code]['qty'] = $qty;
        } else {
            $_SESSION[$sesname][$code]['qty'] += $qty;
        }
    }

    public static function next($sesname, $user)
    {
        if (!isset($_SESSION[$sesname])) {
            $nomor = 1;
            $_SESSION[$sesname][$nomor][$nomor] = $nomor;
            $_SESSION[$sesname][$nomor]['user'] = $user;
        } else {
            $nomor = key(end($_SESSION[$sesname])) + 1;
            $_SESSION[$sesname][$nomor][$nomor] = $nomor;
            $_SESSION[$sesname][$nomor]['user'] = $user;
        }
    }
}
