<?php

namespace BITS;

/**
 * BITS CRUD Services.
 *
 * Class to simply use CRUD Data Management support PDO and PHP OOP.
 * This script written with Object Oriented Style (PSR-2) and use static method.
 *
 * @author Nurul Imam
 *
 * @link https://bits.co.id Banten IT Solutions
 *
 * @version 1.1
 */
class SQL extends DB
{
    /**
     * PDO Object Connections.
     *
     * @var object
     */
    protected static $data;

    /**
     * Querying SQL Syntax.
     *
     * @var string
     */
    protected static $query;

    /**
     * Convert Array to String used to Insert Query.
     *
     * @param array $isi Array object to passed parameter bind and value.
     *
     * @return string Data string to query value.
     */
    public function loopAdd($isi)
    {
        // Initialize empty string
        $isinya = '';

        /*
         * Loop array and add string value to PDO style.
         * Data can used to bind and value PDO Query.
         */
        foreach ($isi[0] as $hasil) {
            $isinya .= ':'.$hasil.', ';
        }

        return $isinya;
    }

    /**
     * Convert Array to String used to Update Query.
     *
     * @param array $isi Array object to passed parameter bind and value.
     *
     * @return string Data string to query value.
     */
    public function loopUpdate($isi)
    {
        // Initialize empty string
        $isinya = '';

        /*
         * Loop array and add string value to PDO style.
         * Data can used to bind and value PDO Query.
         */
        foreach ($isi[0] as $hasil) {
            $isinya .= $hasil.' = :'.$hasil.', ';
        }

        return $isinya;
    }

    /**
     * PDO Bind Param dynamic value.
     *
     * @param array $isi Array object to passed parameter bind and value from $_POST.
     *
     * @return object Bind PDO Syntax to bind parameter.
     */
    public function bind($isi)
    {
        for ($i = 0; $i < count($isi); ++$i) {
            self::$data->bindParam(':'.$isi[$i], $_POST[$isi[$i]]);
        }
    }

    /**
     * PDO Bind Param custom value.
     *
     * @param array $isi Array object to passed custom bind and value parameter.
     *
     * @return object Bind PDO Syntax to bind parameter.
     */
    public function bindCustom($isi)
    {
        for ($i = 0; $i < count($isi[0]); ++$i) {
            parent::$data->bindParam($isi[0][$i], $isi[1][$i]);
        }
    }

    /**
     * PDO Prepare SQL Query.
     *
     * @return object PDO Prepare Syntax.
     */
    public function prepare()
    {
        self::$data = parent::$koneksi->prepare(self::$query);
    }

    /**
     * PDO Execute SQL Query.
     *
     * @return object Execute SQL Query.
     */
    public function execute()
    {
        self::$data->execute() or die(print_r(self::$data->errorInfo(), true));
    }

    /**
     * Fetch all data with array object.
     *
     * @return object Fetch Array Syntax for PDO.
     */
    public function result()
    {
        return self::$data->fetchAll(\PDO::FETCH_ASSOC);
    }
}
