<?php

abstract class model
{
    protected $shared;
    protected $answer;
        
    function __construct ($shared)
    {
        $this -> shared = $shared;
    }
    
    protected function notset ($field, $error = "")
    {
        if (isset($this -> shared -> data -> get [$field]) &&
            "" != $this -> shared -> data -> get [$field])
            return false;

        if ($error == "")
            $error = "Param [$field] not set";
        $this -> error ($error);
        return true;
    }
    
    protected function error ($error)
    {
        $this -> shared -> error -> setError ($error);
        $this -> answer = "";
    }
    
    public function done ()
    {
        $this -> shared -> done ($this -> answer);
    }

}

?>