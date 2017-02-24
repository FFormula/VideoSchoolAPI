<?php

namespace run;

use \system;

class page extends system\resultable
{
    private $bars;
    private $class;
    private $method;
    private $args;

    /**
     * @var array - list of all address templates and relation to the functions
     * summary:
     * x - any text [a-z0-9]+
     * 1 - any number [0-9]+
     * / split parameters
     */
    private $router = array
    (
        array ("", "info/index"),
        array ("info/index", "info/index"),
        array ("user/login", "user/login"),
        array ("user/signup", "user/signup"),

        array ("*", "/system/error")
    );

    public function __construct()
    {
        $this->init_parts();
        $this->init_route();
    }

    public function run ()
    {
        if (!is_alpha($this->class))
            return $this->set_error ("incorrect symbols in class param");
        $class = "\\page\\" . $this->class;

        //echo "<br> class/method: " . $class . " -> " . $this->method . " ()";
        //echo "<br> Args: "; print_r ($this->args);

        $page = new $class ();

        $method = $this->method;

        if (!is_callable(array ($page, $method)))
            return $this->set_error ("api class->method not found: " . $class . "->" . $method);

        if (count ($_POST) == 0)
            $page->$method ($this->args);
        else
            $page->{$method."_post"} ($this->args, $_POST);

        $this->set_error ($page->get_error());
        $this->set_array ($page->get_array());

        //print_r ($this->get_array());
        //print_r ($this->get_error());

        return true;
    }

    public function get_class () { return $this->class; }
    public function get_method () { return $this->method; }







    private function init_parts ()
    {
        if (isset ($_GET [DATA_GET]))
            $this -> bars = explode ('/', trim($_GET [DATA_GET], '\\/'));
        else
            $this -> bars = array ();
    }

    private function init_route ()
    {
        $rule = $this->find_route();
        $path = explode("/", $rule [0]);
        $this->init_args($path);

        list ($this->class, $this->method) = explode("/", $rule [1]);
    }

    private function find_route ()
    {
        foreach ($this->router as $rule)
            if ($this->admit($rule[0]))
                return $rule;
        return array ();
    }

    private function init_args ($path)
    {
        $this->args = array ();
        for ($j = 0; $j < count($path); $j ++)
            if (substr($path [$j], 0, 1) == "@")
                $this->args [substr ($path[$j], 1)] = $this->bars [$j];
    }

    private function admit ($route)
    {
        $route_items = explode ("/", trim($route, "/"));

        if (count($this->bars) != count ($route_items))
            return false;

//        echo "\ncmp " . $route;
        for ($j = 0; $j < count ($route_items); $j ++)
            if (!$this->like($route_items[$j], $this->bars[$j]))
                return false;

        return true;
    }

    private function like ($item, $bar)
    {
        if ($item == $bar) return true;
        if (substr($item, 0, 1) == "@") return true;
        return false;
    }

}