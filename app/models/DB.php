<?php
namespace BITS;

require_once 'app/config/config.php';
use PDO;

/**
 * BITS Database Connection.
 *
 * Class to simply use PDO Connection to MySQL.
 * This script written with Object Oriented Style (PSR-2) and use static method.
 *
 * @author Nurul Imam
 *
 * @link https://bits.co.id Banten IT Solutions
 *
 * @version 1.1
 */
class DB
{
    /**
     * Get Connection PDO MySQL.
     *
     * @var object
     */
    protected static $koneksi;

    /**
     * Connect to Database with PDO.
     */
    public function __construct()
    {
        $dbhost = DBHOST;
        $dbuser = DBUSER;
        $dbpass = DBPASS;
        $dbname = DBNAME;

        $dsn = "mysql:host=$dbhost;dbname=$dbname";
        try {
            self::$koneksi = new PDO($dsn, $dbuser, $dbpass);
        } catch (PDOException $e) {
            echo 'Failed connect database : '.$e->getMessage();
        }
    }
}
