<?php

include ROOT . "shared/class.db.php";
include ROOT . "shared/class.data.php";

class Shared
{
    /** @var DB - Class for MySQL database queries */
    public $db;

    /** @var Data - parse and read Model/Action, get and post data */
    public $data;

    private $error = "no";
    private $result;
    
    function __construct ()
    {
        $this -> data = new Data ($this);
        $this -> db = new DB ($this);
    }
    
    public function init ()
    {
        $this -> data -> parse_args ();
        $this -> db -> open ();
    }

    function fatal (Exception $ex)
    {
        $this -> error = $ex -> getMessage();
        $this -> done ();
    }

    function error ($text)
    {
        $this -> error = $text;
        $this -> done ();
    }

    /** Finish work and prepare output
     * @param string $answer - resulted text/array
     */
    public function done ($answer = "")
    {
        $this -> result ["model"]  = $this -> data -> model;
        $this -> result ["action"] = $this -> data -> action;
        $this -> result ["error"]  = $this -> error;
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