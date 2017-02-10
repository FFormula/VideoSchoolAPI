<?php

namespace system;

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
        $this->init_get();
        $this->init_post();
        $this->init_class();
        $this->init_method();
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

    private function init_data ()
    {
        if (isset ($_GET [DATA_GET]))
            $this -> data = explode ('/', trim($_GET [DATA_GET], '\\/'));
        else
            $this -> data = array ();
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

    private function init_class ()
    {
        if (isset ($this->get [0]))
            $this->class = "\\api\\" . $this->get [0];
        else
            $this->class = "\\api\\" . DATA_DEFAULT_CLASS;
    }

    private function init_method ()
    {
        if (isset ($this->data [1]))
            $this->method = $this->data [1];
        else
            $this->method = DATA_DEFAULT_METHOD;
        if (count ($this->post) > 0)
            $this->method .= "_post";
    }

    private function start ()
    {
        $api = new $this->class ();
        if (!is_callable(array ($api, $this->method)))
            $this->method = DATA_DEFAULT_METHOD;
//        if (count ($this->post) > 0)
//            $res = $api->{$this->method} ($this->get, $this->post);
//        else

        if ($api->{$this->method} ($this->get))
            $this->info["success"] = "ok";
        else
            $this->info["error"] = $api->get_error();
    }

}