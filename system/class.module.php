<?php

abstract class Module
{
    protected $db;
    protected $data;
    protected $answer;
        
    function __construct ()
    {

    }

    public function init ($db, $data)
    {
        $this -> db = $db;
        $this -> data = $data;
    }

    public function get_answer ()
    {
        return $this -> answer;
    }
    
    public function can_action ()
    {
        $action = $this -> shared -> data -> model . "/" . $this -> shared -> data -> action;
        if ($action == "help/version") return true;
        if ($action == "help/index") return true;
        if ($action == "help/now") return true;
        if ($action == "user/join") return true;
        if ($this -> is_empty("key")) return false;

        if ($this -> shared -> data -> get ("key") == "123")
            return true;

        $this -> shared -> error ("Key incorrect");
        return false;
    }

}
