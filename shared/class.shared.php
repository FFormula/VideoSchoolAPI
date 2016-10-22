<?php

include ROOT . "shared/class.db.php";
include ROOT . "shared/class.data.php";
include ROOT . "shared/class.error.php";

class Shared
{
    /** @var DB - Class for MySQL database queries */
    public $db;

    /** @var Data - parse and read Model/Action, get and post data */
    public $data;

    /** @var Error - Errors handling */
    public $error;

    private $result;
    
    function __construct ()
    {
        $this -> error = new Error ($this);
        $this -> data = new Data ($this);
        $this -> db = new DB ($this);
    }
    
    public function init ()
    {
        $this -> data -> parse_args ();
        $this -> db -> open ();
    }

    /** Finish work and prepare output
     * @param string $answer - resulted text/array
     */
    public function done ($answer = "")
    {
        $this -> result ["model"]  = $this -> data -> model;
        $this -> result ["action"] = $this -> data -> action;
        $this -> result ["error"]  = $this -> error -> get_error();
        if ($answer != "")
            $this -> result ["answer"] = $answer;
    }
    
    public function output ()
    {
        echo "<pre>";
        print_r ($this -> result);
//        echo json_encode ($this -> result);
    }
}

?>