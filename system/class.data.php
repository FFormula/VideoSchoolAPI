<?php

class Data
{
    private $db;
    public $action;
    public $module;
    protected $error;
    protected $result;

//  private $post; common array for both GET and POST data
    private $get;
    private $data_parts;

    function __construct ()
    {
        $this -> get = array ();
    }

    public function get ($field)
    {
        if (isset ($this -> get [$field]))
            return $this -> get [$field];
        return "";
    }

    /** Parse route, post and get arguments */
    public function init ($db)
    {
        $this -> db = $db;
        $this -> error = "";
        $this -> parse_route();
        $this -> parse_post();
        $this -> parse_get();
    }

    private function parse_route ()
    {
        if (!isset ($_GET ["data"]))
        {
            $this -> module = DATA_DEFAULT_MODULE;
            $this -> action = DATA_DEFAULT_ACTION;
            return;
        }
        $route = trim ($_GET ["data"], '\\/');
        $this -> data_parts = explode ('/', $route);

        $this -> module = array_shift ($this -> data_parts);
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
            list ($param, $value) = explode ('=', $part);
            $this -> get [$param] = addslashes ($value);
        }
    }

    public function is_param ($param, $error = "")
    {
        if (isset ($this -> get [$param]))
            return true;

        if ($error == "")
            $error = "Param [$param] not set";
        $this -> error ($error);
        return false;
    }

    public function error ($text)
    {
        $this -> error = $text;
    }

    public function done ($answer = "")
    {
        $this -> result ["module"] = $this -> module;
        $this -> result ["action"] = $this -> action;
        if ($this -> error)
            $this -> result ["error"]  = $this -> error;
        else
            $this -> result ["answer"] = $answer;
    }

    /** Print all data by default/specified format */
    public function output ()
    {
        echo "<pre>";
        print_r ($this -> result);
//        echo json_encode ($this -> result);
    }}
