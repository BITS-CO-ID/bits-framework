<?php

namespace BITS;

/**
 * BITS Custom CRUD Services.
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
class Query extends SQL
{
    /**
     * Get all data from database.
     *
     * @param string $table Table name.
     * @param string $param Additional SQL parameter.
     *
     * @return object Get array data.
     */
    public function all($table, $param = '')
    {
        parent::$query = 'SELECT * FROM '.$table.' '.$param;
        parent::prepare();
        parent::execute();

        return parent::result();
    }

    /**
     * Get all data from database and retun json.
     *
     * @param string $table Table name.
     * @param string $param Additional SQL parameter.
     *
     * @return object Get array data.
     */
    public function allApi($table, $param = '')
    {
        parent::$query = 'SELECT * FROM '.$table.' '.$param;
        parent::prepare();
        parent::execute();

        return parent::json();
    }

    /**
     * Find Data by parameter defined.
     *
     * @param string $table    Table name.
     * @param string $param    Additional SQL parameter.
     * @param string $value    Unique id.
     * @param string $optional Additional parameter, default is null.
     *
     * @return object Get array data.
     */
    public function find($table, $param, $value, $optional = "")
    {
        parent::$query = "SELECT * FROM ".$table." WHERE ".$param." = '".$value."' ".$optional;
        parent::prepare();
        parent::execute();

        return parent::result();
    }

    /**
     * Insert new data to Database.
     *
     * @param string $table Table name.
     * @param array  $isi   Array object to passed parameter bind and value.
     */
    public function add($table, $isi)
    {
        // Initialize empty string
        $isinya = '';

        /*
         * Loop array and add string value to PDO style.
         * Data can used to bind and value PDO Query.
         */
        foreach ($isi as $hasil) {
            $isinya .= ':'.$hasil.', ';
        }

        // Remove last comma used to SQL value.
        $value = rtrim($isinya, ', ');

        // Remove : used to SQL parameter.
        $param = str_replace(':', '', $value);

        parent::$query = 'INSERT INTO '.$table.' ('.$param.') VALUES ('.$value.')';
        parent::prepare();
        parent::bind($isi);
        parent::execute();
    }

    /**
     * Insert new data with custom value.
     *
     * @param string $table Table name.
     * @param array  $isi   Array object to passed parameter bind and value.
     */
    public function addCustom($table, $isi)
    {
        // Remove last comma used to SQL value.
        $value = rtrim(parent::loopAdd($isi), ', ');

        // Remove : used to SQL parameter.
        $param = str_replace(':', '', $value);

        parent::$query = 'INSERT INTO '.$table.' ('.$param.') VALUES ('.$value.')';
        parent::prepare();
        parent::bindCustom($isi);
        parent::execute();
    }

    /**
     * Update data to Database.
     *
     * @param string $table Table name.
     * @param array  $isi   Array object to passed parameter bind and value.
     * @param string $param Unique Column.
     * @param string $value Unique ID.
     *
     * @return object Post Save Changes Data.
     */
    public function update($table, $isi, $param, $value)
    {
        // Initialize empty string
        $isinya = '';

        /*
         * Loop array and add string value to PDO style.
         * Data can used to bind and value PDO Query.
         */
        foreach ($isi as $hasil) {
            $isinya .= $hasil.' = :'.$hasil.', ';
        }

        // Remove last comma.
        $edit = rtrim($isinya, ', ');

        parent::$query = 'UPDATE '.$table.' SET '.$edit.' WHERE '.$param.' = '.$value;
        parent::prepare();
        parent::bind($isi);
        parent::execute();
    }

    /**
     * Update data to Database with custom value.
     *
     * @param string $table Table name.
     * @param array  $isi   Array object to passed parameter bind and value.
     * @param string $param Unique Column.
     * @param string $value Unique ID.
     *
     * @return object Post Save Changes Data.
     */
    public function updateCustom($table, $isi, $param, $value)
    {
        // Remove last comma.
        $edit = rtrim(parent::loopUpdate($isi), ', ');

        parent::$query = 'UPDATE '.$table.' SET '.$edit.' WHERE '.$param.' = '.$value;
        parent::prepare();
        parent::bindCustom($isi);
        parent::execute();
    }

    /**
     * Delete data from Database.
     *
     * @param string $table Table name.
     * @param string $param Unique Column.
     * @param string $value Unique ID.
     *
     * @return object Delete data with ID.
     */
    public function delete($table, $param, $value, $additional)
    {
        parent::$query = 'DELETE FROM '.$table.' WHERE '.$param.' = '.$value.' '.$additional;
        parent::prepare();
        parent::execute();
    }

    /**
     * Custom SQL Query.
     *
     * @param string $query Query to execute SQL command.
     *
     * @return object Get array data.
     */
    public function custom($query)
    {
        parent::$query = "$query";
        parent::prepare();
        parent::execute();

        return parent::result();
    }

    /**
     * Get Last inserted id.
     *
     * @param string $table Table name of last id.
     *
     * @return string Get last id number.
     */
    public function lastID($table)
    {
        $last = parent::custom("SELECT MAX(id) AS idmax FROM $table");
        return $last['idmax'];
    }

    /**
     * Get Last inserted id by column.
     *
     * @param string $table Table name of last id.
     * @param string $column Column name of last id.
     * @param string $order Ordered column of last id.
     *
     * @return string Get last id number.
     */
    public function last($table, $column, $order = "id")
    {
        $last = parent::custom("SELECT $column FROM $table ORDER BY $order DESC LIMIT 1");
        return $last[$column];
    }

    /**
     * Direct Fetch Value from Custom Query.
     *
     * @param string $query SQL Query.
     * @param string $param Column to fetch.
     *
     * @return string Get value of column.
     */
    public function fetch($query, $param)
    {
        $value = parent::custom($query);
        return $value[$param];
    }

    /**
     * Reset Data from table.
     *
     * @param string $table Table to resetting data.
     */
    public function reset($table)
    {
        parent::custom("TRUNCATE TABLE $table");
    }

    /**
     * Get SQL Functions from SQL Query.
     *
     * @param string $table Table name.
     * @param string $func  SQL Functions.
     * @param string $alias Alias result.
     * @param string $param Additional SQL parameter.
     *
     * @return object Get row number.
     */
    public function sqlFunc($table, $func, $alias, $param = '')
    {
        parent::$query = 'SELECT '.$func.' AS '.$alias.' FROM '.$table.' '.$param;
        parent::prepare();
        parent::execute();

        return parent::result();
    }
}
