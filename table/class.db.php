<?php

namespace table;

use system\resultable;

class db extends resultable
{
    private $mi;

    private static $instance = null;
    public static function getDB()
    {
        if (!isset(static::$instance))
            static::$instance = new db ();
        return static::$instance;
    }
    private function __construct ()
    {
        $this -> connect ();
    }
    
    /**
     * One-time connection to the database
     * @throws Exception on error during connect to MySQL
     */
    protected function connect() 
    {
        if (isset($this -> mi))
            return true;

//      echo "  host: " . DB_HOST . ", user: " . DB_USER . ", base: " . DB_BASE . ", " . DB_PASS;
        $this -> mi = new \MySQLi(DB_HOST, DB_USER, DB_PASS, DB_BASE);

        if ($this -> mi -> connect_errno)
            return $this->set_error(
                        "Error connecting to database: " .
                        $this -> mi -> connect_error);

        return true;
    }

    /**
     * Query the database
     * @param $query The query string
     * @return mixed The result of the mysqli::query() function
     * @throws Exception on MySQL error with query and error message
     */
    public function query ($query) 
    {
        $result = $this -> mi -> query ($query);
        if (!$result)
            return $this->set_error(
                "Error during query: " . $this -> mi -> error .
                ". Query text: " . $query);
        return $result;
    }

    /**
     * Fetch rows from the database (SELECT query)
     * @param $query The query string
     * @return array database rows on success
     */
    public function select_all ($query)
    {
        if (!($result = $this -> query ($query)))
            return false;
        $rows = [];
        while ($row = $result -> fetch_assoc())
            $rows[] = $row;
        return $rows;
    }

    /**
     * Fetch single row from SELECT query
     *
     * @param $query The query string
     * @return array database rows on success
     */
    public function select_row ($query)
    {
        if (!($result = $this -> query ($query)))
            return false;
        if (mysqli_num_rows($result) == 0)
            return [];
        return $result -> fetch_assoc();
    }

    /**
     * Fetch one value from the query
     *
     * @param $query The query string
     * @return fetched value
     */
    public function scalar ($query) 
    {
        if (!($result = $this -> query ($query)))
            return false;
        if (mysqli_num_rows($result) == 0)
            return "";
        $res = $result -> fetch_array();
        return $res [0];
    }

    public function insert_id ()
    {
        return $this -> mi -> insert_id;
    }
}