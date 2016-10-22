<?php

abstract class model
{
    protected $shared;
    protected $answer;
        
    function __construct (Shared $shared)
    {
        $this -> shared = $shared;
    }
    
    protected function is_empty ($field, $message = "")
    {
        if ($this -> shared -> data -> get ($field) != "")
            return false;
        if ($this -> shared -> data -> post ($field) != "")
            return false;

        if ($message == "")
            $message = "Param [$field] not set";
        $this -> shared -> error ($message);
        return true;
    }

    public function done ()
    {
        $this -> shared -> done ($this -> answer);
    }

    public function can_action ()
    {
        $action = $this -> shared -> data -> model . "/" . $this -> shared -> data -> action;
        if ($action == "help/version") return true;
        if ($action == "help/index") return true;
        if ($action == "user/join") return true;
        if ($this -> is_empty("key")) return false;

        if ($this -> shared -> data -> get ("key") == "123")
            return true;

        $this -> shared -> error ("Key incorrect");
        return false;
    }

}

?>