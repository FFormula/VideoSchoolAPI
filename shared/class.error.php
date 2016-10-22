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
    
    function setFatal ($ex)
    {
        $this -> text = $ex -> getMessage();
    }
    
    function setError ($text)
    {
        $this -> text = $text;
    }
    
    function getError ()
    {
        return $this -> text;
    }

}

?>