<?php

namespace run;

use \system;

/**
 * Class run - run an API function
 * @package system
 */
class api
{
    private $class; // class to be used in API
    private $method; // method to be called

    public function __construct()
    {
        $this->init_class();
        $this->init_method();
    }

    public function run ()
    {
        $this->error = "";
        if (!system\text::is_alpha($this->class))
            return $this->set_error ("incorrect symbols in class param");
        $class = "\\api\\" . $this->class;

        $api = new $class ();

        if (!system\text::is_alpha($this->method))
            return $this->set_error ("incorrect symbols in method param");
        $method = $this->method;

        if (!is_callable(array ($api, $method)))
            return $this->set_error ("api class/method not found: " . $class . "/" . $method);

        if (!$api->$method ($_GET))
            return $this->set_error ($api->get_error());

        return true;
    }

    private function init_class ()
    {
        if (!isset ($_GET ["class"]))
            $this->class = API_DEFAULT_CLASS;
        else
            $this->class = $_GET ["class"];
    }

    private function init_method ()
    {
        if (!isset ($_GET ["method"]))
            $this->method = API_DEFAULT_METHOD;
        else
            $this->method = $_GET ["method"];
    }

    protected $error = "";
    public function get_error () { return $this->error; }
    protected function set_error ($message) { $this->error = $message; return false; }

}