<?php

namespace BITS;

/**
 * BITS Auth Services.
 *
 * Class to simply use Auth Sevices support PDO and PHP OOP.
 * This script written with Object Oriented Style (PSR-2) and use static method.
 *
 * @author Nurul Imam
 *
 * @link https://bits.co.id Banten IT Solutions
 *
 * @version 1.1
 */
class Auth extends BITS
{

    /**
     * Check Username to database. If exist, return password validation.
     * @param  string $table    Table User.
     * @param  string $fuser    Field username of table.
     * @param  string $username Input username data.
     * @param  string $fpass    Field password of table.
     * @param  string $password Input password data.
     * @return string           Session of username and salt.
     */
    public function login($table, $username, $password, $fuser = "username", $fpass = "password")
    {
        $userdata = parent::find($table, $fuser, $username);
        if (empty($userdata)) {
            $_SESSION['alert'] = 'danger';
            $_SESSION['message'] = 'Username is not registered...!';
        } else {
            if (password_verify($password, $userdata[0][$fpass])) {
                $_SESSION['username'] = $userdata[0][$fuser];
                self::generateSalt();
            } else {
                $_SESSION['alert'] = 'danger';
                $_SESSION['message'] = 'Wrong Password...!';
            }
        }
    }

    /**
     * Generate Salt Fingerprint.
     * @return string salt.
     */
    public function generateSalt()
    {
        $fingerprint = md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT'].date('d.m.Y'));
        if (isset($_SESSION['_USER_LOOSE_IP']) != long2ip(ip2long($_SERVER['REMOTE_ADDR'])  & ip2long("255.255.0.0"))
            || isset($_SESSION['_REMOTE_ADDR']) !== $_SERVER['REMOTE_ADDR']
            || isset($_SESSION['_USER_AGENT']) != $_SERVER['HTTP_USER_AGENT']
            || isset($_SESSION['_USER_ACCEPT']) != $_SERVER['HTTP_ACCEPT']
            || isset($_SESSION['_USER_ACCEPT_ENCODING']) != $_SERVER['HTTP_ACCEPT_ENCODING']
            || isset($_SESSION['_USER_ACCEPT_LANG']) != $_SERVER['HTTP_ACCEPT_LANGUAGE']
            || isset($_SESSION['salt']) !== $fingerprint) {
            session_unset();
            session_destroy();
            setcookie("sid", session_id(), strtotime("+1 hour"), "/", ".bits.co.id", true, true);
            session_start();
            session_regenerate_id(true);
            $_SESSION['_REMOTE_ADDR']          = $_SERVER['REMOTE_ADDR'];
            $_SESSION['_USER_AGENT']           = $_SERVER['HTTP_USER_AGENT'];
            $_SESSION['_USER_ACCEPT']          = $_SERVER['HTTP_ACCEPT'];
            $_SESSION['_USER_ACCEPT_ENCODING'] = $_SERVER['HTTP_ACCEPT_ENCODING'];
            $_SESSION['_USER_ACCEPT_LANG']     = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
            $_SESSION['_USER_LOOSE_IP']        = long2ip(ip2long($_SERVER['REMOTE_ADDR']) & ip2long("255.255.0.0"));
            $_SESSION['salt']                  = $fingerprint;
        }
    }

    /**
     * Redirecting to a url.
     * @param  string $url Url to redirect a page.
     * @return object      Redirecting to a page.
     */
    public function redirect($url)
    {
        header("Location: $url");
    }

    /**
     * User logout to destroy all session login.
     * @return boolean Set to true if successfully logged out.
     */
    public function logout()
    {
        session_destroy();
        return true;
    }
}
