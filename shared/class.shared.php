<?php

include "shared/class.db.php";
include "shared/class.log.php";
include "shared/class.data.php";
include "shared/class.error.php";
include "shared/class.config.php";

class Shared
{
    private $db;
    private $log;
    private $data;
    private $error;
    private $config;
    private $result;
    
    function __construct ()
    {
        $this -> config = new Config ($this);
        $this -> error = new Error ($this);
        $this -> data = new Data ($this);
        $this -> log = new Log ($this);
        $this -> db = new DB ($this);
    }
    
    public function __get ($name)
    {
        return isset ($this -> $name) ? $this -> $name : null;
    }
    
    public function init ()
    {
        $this -> config -> load ();
        $this -> data -> parse ();
        $this -> db -> open ();
    }
    
    public function done ($answer = "")
    {
        $this -> result ["model"]  = $this -> data -> model;
        $this -> result ["action"] = $this -> data -> action;
        $this -> result ["error"]  = $this -> error -> getError();
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