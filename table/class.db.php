<?php

namespace table;

class db
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
            return;

//      echo "  host: " . DB_HOST . ", user: " . DB_USER . ", base: " . DB_BASE . ", " . DB_PASS;
        $this -> mi = new \MySQLi(DB_HOST, DB_USER, DB_PASS, DB_BASE);

        if ($this -> mi -> connect_errno)
            throw new Exception (
                        "Error connecting to database: " . 
                        $this -> mi -> connect_error); 
    }

    /**
     * Query the database
     * @param $query The query string
     * @return mixed The result of the mysqli::query() function
     * @throws Exception on MySQL error with query and error message
     */
    public function query ($query) 
    { // TODO - RETURN FALSE ON ERROR
        $result = $this -> mi -> query ($query);
        if (!$result)
            throw new \Exception (
                        "Error during query: " . 
                        $this -> mi -> error . 
                        ". Query text: " . 
                        $query);
        return $result;
    }

    /**
     * Fetch rows from the database (SELECT query)
     * @param $query The query string
     * @return array database rows on success
     */
    public function select ($query) 
    {
        $result = $this -> query ($query);
        $rows = array();
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
        $result = $this -> query ($query);
        if (mysqli_num_rows($result) == 0)
            return false;
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
        $result = $this -> query ($query);
        if (mysqli_num_rows($result) == 0)
            return false;
        $res = $result -> fetch_array();
        return $res [0];
    }

    public function insert_id ()
    {
        return $this -> mi -> insert_id;
    }
}