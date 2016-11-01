<?php

class DB
{
    private $shared;
    protected $mi;
    
    function __counstruct ($shared)
    {
        $this -> shared = $shared;
    }
    
    /**
     * One-time connection to the database
     */
    protected function connect() 
    {
        if (isset($this -> mi))
            return;

//      echo "  host: " . DB_HOST . ", user: " . DB_USER . ", base: " . DB_BASE . ", " . DB_PASS;
        $this -> mi = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_BASE);

        if ($this -> mi -> connect_errno)
            throw new Exception (
                        "Error connecting to database: " . 
                        $this -> mi -> connect_error); 
    }

    /**
     * Query the database
     *
     * @param $query The query string
     * @return mixed The result of the mysqli::query() function
     */
    public function query ($query) 
    {
        $this -> connect();

        $result = $this -> mi -> query ($query);

        if (!$result)
            throw new Exception (
                        "Error during query: " . 
                        $this -> mi -> error . 
                        ". Query text: " . 
                        $query);

        return $result;
    }

    /**
     * Fetch rows from the database (SELECT query)
     *
     * @param $query The query string
     * @return array database rows on success
     */
    public function select ($query) 
    {
        $rows = array();
        $result = $this -> query ($query);

        while ($row = $result -> fetch_assoc()) 
            $rows[] = $row;

        return $rows;
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

        $res = $result -> fetch_array();

        return $res [0];
    }

}

?>
