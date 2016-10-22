<?php

class Data
{
    private $shared;
    private $action;
    private $model;
    private $post;
    private $get;
    
    function __counstruct ($shared)
    {
        $this -> shared = $shared;
        $post = array ();
        $get = array ();
    }

    public function __get ($name)
    {
        return isset ($this -> $name) ? $this -> $name : "";
    }
    
    function parse ()
    {
        if (!isset ($_GET ["route"]))
        {
            $this -> model = "help";
            $this -> action = "index";
            return;
        }
        $route = isset ($_GET ["route"]) ? $_GET ["route"] : "";
        
        $route = trim ($route, '\\/');
        $parts = explode ('/', $route);
        
        $this -> model = array_shift ($parts);
        $this -> action = array_shift ($parts);
        
        if (is_array ($parts))
        foreach ($parts as $part)
        {
            list ($field, $value) = explode ('=', $part);
            $this -> get [$field] = addslashes ($value);
        }
        
        if (is_array ($_POST))
        foreach ($_POST as $key => $value)
        {
            $this -> post [$key] = addslashes ($value);
        }
    }
}

?>