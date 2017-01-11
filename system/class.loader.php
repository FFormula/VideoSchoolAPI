<?php

class loader
{
    private $get; // all the get information
    private $post;
    private $data; // input from address bar
    private $info = ""; // resulted array

    private $class; // class to be used in API
    private $method; // method to be called


    public function __construct()
    {
        $this->init_data();
        $this->init_class();
        $this->init_method();
        $this->init_get();
        $this->init_post();
        $this->load();
        $this->start();
    }

    public function get_class()
    {
        return $this->class;
    }

    public function get_method()
    {
        return $this->method;
    }

    public function get_info()
    {
        return $this->info;
    }

    private function load ()
    {
        $class = $this->class;
        $file = ROOT . "api/api.$class.php";
        if (!file_exists($file))
            throw new Exception("Cannot load $class API, file $file not found.");
        require_once $file;
    }

    private function start ()
    {
        $class = $this->class;
        $api = new $class ();
        $method = $this->method;
        if (!is_callable(array ($api, $method)))
            $method = DATA_DEFAULT_METHOD;
        if (count ($this->post) == 0)
            $this->info = $api->$method ($this->get);
        else {
            $method_post = $method . "_post";
            $this->info = $api->$method_post ($this->get, $this->post);
        }
    }

    private function init_data ()
    {
        if (isset ($_GET [DATA_GET]))
            $this -> data = explode ('/', trim($_GET [DATA_GET], '\\/'));
        else
            $this -> data = array ();
    }

    private function init_class ()
    {
        if (isset ($this->data [0]))
            $this->class = $this->data [0];
        else
            $this->class = DATA_DEFAULT_CLASS;
    }

    private function init_method ()
    {
        if (isset ($this->data [1]))
            $this->method = $this->data [1];
        else
            $this->method = DATA_DEFAULT_METHOD;
    }

    private function init_get()
    {
        foreach ($this->data as $part)
        {
            if (strpos($part, "=")) {
                list ($param, $value) = explode('=', $part);
                $this->get [$param] = addslashes($value);
            } else {
                $this->get [] = addslashes($part);
            }
        }
    }

    private function init_post()
    {
        if (!is_array($_POST))
            return;
        foreach ($_POST as $key => $value)
            $this -> post [$key] = addslashes($value);
    }

}