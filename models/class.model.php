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

        if ($message == "")
            $message = "Param [$field] not set";
        $this -> shared -> error ($message);
        return true;
    }

    public function done ()
    {
        $this -> shared -> done ($this -> answer);
    }

}

?>