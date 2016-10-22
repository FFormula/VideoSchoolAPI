<?php

class Error
{
    private $shared;
    private $text = "no";
    
    function __counstruct ($shared)
    {
        $this -> shared = $shared;
        $this -> text = "ok";
    }
    
    function set_fatal ($ex)
    {
        $this -> text = $ex -> getMessage();
    }
    
    function set_error ($text)
    {
        $this -> text = $text;
    }
    
    function get_error ()
    {
        return $this -> text;
    }

}

?>