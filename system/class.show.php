<?php

namespace system;

class show
{
    private $parts;
    private $class;

    public function __construct()
    {
        $this->init_parts();
        $this->init_class();
    }

    private function init_parts ()
    {
        if (isset ($_GET [DATA_GET]))
            $this -> parts = explode ('/', trim($_GET [DATA_GET], '\\/'));
        else
            $this -> parts = array ();
    }

    private function init_class ()
    {
        if (!isset ($this->parts[0]))
            $this->class = DIVS_DEFAULT_CLASS;
        else
            $this->class = $this->parts [0];
    }

    public function run_div ()
    {
        $this->error = "";
        if (!text::is_alpha($this->class))
            return $this->set_error ("incorrect symbols in class param");
        $class = "\\api\\" . $this->class;

        $api = new $class ();

        if (!text::is_alpha($this->method))
            return $this->set_error ("incorrect symbols in method param");
        $method = $this->method;

        if (!is_callable(array ($api, $method)))
            return $this->set_error ("api class/method not found: " . $class . "/" . $method);

        if (!$api->$method ($_GET))
            return $this->set_error ($api->get_error());

        return true;
    }



}