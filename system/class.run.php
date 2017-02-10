<?php

namespace system;

class run
{
    private $class; // class to be used in API
    private $method; // method to be called

    public function __construct()
    {
        $this->init_class();
        $this->init_method();
        $this->start();
    }

    private function init_class ()
    {
        if (!isset ($_GET ["class"]))
            $class = API_DEFAULT_CLASS;
        else
            $class = $_GET ["class"];
        if (!text::is_alpha($class))
            die ("incorrect symbols in class param");
        $this->class = "\\api\\" . $class;
    }

    private function init_method ()
    {
        if (!isset ($_GET ["method"]))
            $method = API_DEFAULT_METHOD;
        else
            $method = $_GET ["method"];
        if (!text::is_alpha($method))
            die ("incorrect symbols in method param");
        $this->method = $method;
    }

    private function start ()
    {
        $api = new $this->class ();
        if (!is_callable(array ($api, $this->method)))
            throw new \Exception("api class/method not found: " . $this->class . "/" . $this->method);

        if ($api->{$this->method} ($_GET))
            echo "ok";
        else
            echo $api->get_error();
    }

}