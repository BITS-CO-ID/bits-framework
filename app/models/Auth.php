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
class Auth extends Data
{
    /**
     * User login to access system.
     * @param  string $username     Input username from login page.
     * @param  string $password     Input password from login page.
     * @return object               Create login session.
     */
    public function login($username, $password)
    {
        parent::$query = "SELECT * FROM users WHERE username = '". $username . "'";
        parent::prepare();
        parent::execute();

        $data = parent::$data->fetchAll(\PDO::FETCH_ASSOC);

        self::checkLogin();
        /**
         * Check validation of input login to database data.
         * If username & password match, create name and level session.
         */
        if (parent::$data->rowCount() > 0) {
            if ($username == $data[0]['username'] && password_verify($password, $data[0]['password'])) {
                $_SESSION['user_id']    = $data[0]['id'];
                $_SESSION['username'] = $data[0]['username'];
                //$_SESSION['nama']    = $data[0]['nama'];
            }
        }
    }

    /**
     * Check user login or not.
     * @return boolean If successfully, set to true.
     */
    public function checkLogin()
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
            $_SESSION['_REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR'];
            $_SESSION['_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT'];
            $_SESSION['_USER_ACCEPT']          = $_SERVER['HTTP_ACCEPT'];
            $_SESSION['_USER_ACCEPT_ENCODING'] = $_SERVER['HTTP_ACCEPT_ENCODING'];
            $_SESSION['_USER_ACCEPT_LANG']     = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
            $_SESSION['_USER_LOOSE_IP'] = long2ip(ip2long($_SERVER['REMOTE_ADDR'])
                                                  & ip2long("255.255.0.0"));
            $_SESSION['salt']  = $fingerprint;
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
