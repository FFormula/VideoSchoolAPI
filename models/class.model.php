<?php

abstract class model
{
    protected $shared;
    protected $answer;
        
    function __construct (Shared $shared)
    {
        $this -> shared = $shared;
    }
    
    protected function is_empty ($field, $error = "")
    {
        if ($this -> shared -> data -> get ($field) != "")
            return false;
        if ($this -> shared -> data -> post ($field) != "")
            return false;

        if ($error == "")
            $error = "Param [$field] not set";
        $this -> set_error ($error);
        return true;
    }

    /**
     * @param $error
     */
    protected function set_error ($error)
    {
        $this -> shared -> error -> set_error ($error);
        $this -> answer = "";
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
        if ($this -> is_empty("key")) {
            $this->set_error("Key not specified");
            return false;
        }
        if ($this -> shared -> data -> get ("key") == "123")
            return true;
        $this -> set_error ("Key incorrect");
        return false;
    }

}

?>