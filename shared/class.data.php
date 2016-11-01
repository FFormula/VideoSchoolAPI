<?php

class Data
{
    private $shared;
    public $action;
    public $model;
//  private $post; common array for both GET and POST data
    private $get;

    private $data_parts;
    
    function __construct ($shared)
    {
        $this -> shared = $shared;
        $this -> post = array ();
        $this -> get = array ();
    }

    public function get ($field)
    {
        if (isset ($this -> get [$field]))
            return $this -> get [$field];
        return "";
    }

    /** Parse route, post and get arguments */
    public function parse_args ()
    {
        $this -> parse_route();
        $this -> parse_post();
        $this -> parse_get();
    }

    private function parse_route ()
    {
        if (!isset ($_GET ["data"]))
        {
            $this -> model  = DATA_DEFAULT_MODEL;
            $this -> action = DATA_DEFAULT_ACTION;
            return;
        }
        $route = trim ($_GET ["data"], '\\/');
        $this -> data_parts = explode ('/', $route);

        $this -> model = array_shift ($this -> data_parts);
        $this -> action = array_shift ($this -> data_parts);
    }

    private function parse_post()
    {
        if (!is_array($_POST))
            return;
        foreach ($_POST as $key => $value)
            $this -> get [$key] = addslashes($value);
    }

    private function parse_get()
    {
        if (!is_array ($this -> data_parts))
            return;
        foreach ($this -> data_parts as $part)
        {
            list ($field, $value) = explode ('=', $part);
            $this -> get [$field] = addslashes ($value);
        }
    }

}
