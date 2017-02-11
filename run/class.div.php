<?php

namespace run;

use \system;

class show
{
    private $parts;
    private $class;
    private $method;

    private $router = array (
        "shop" => array (
            array ("/shop", "list_all_packets"),
            array ("/shop/x", "about_packet"),
            array ("/shop/x/bill", "bill_packet"),
            array ("/shop/x/start", "start_packet"),
            array ("/shop/x/video", "list_all_video_reports_for_packet"),
            array ("/shop/x/reports", "list_all_reports_for_packet"),
            array ("/shop/x/reports/1", "list_all_reports_of_lesson_for_packet"),
            array ("/shop/x/list", "list_all_lessons_for_packet"),
            array ("/shop/x/posts", "list_all_posts_for_packet")
        ),
        "people" => array (
            array ("/people", "list_all_people")
        )
    );

    public function __construct()
    {
        $this->init_parts();
        $this->init_class();
        $this->method = $this->find_method();
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

    private function find_method ()
    {
        if (!isset($this->router[$this->class]))
            return DIVS_DEFAULT_METHOD;
        foreach ($this->router[$this->class] as $item)
            if ($this->admit($item[0]))
                return $this->method = $item[1];
        return DIVS_DEFAULT_METHOD;
    }

    protected function admit ($rule)
    {
        return true;
    }

    public function run ()
    {
        $this->error = "";
        if (!system\text::is_alpha($this->class))
            return $this->set_error ("incorrect symbols in class param");
        $class = "\\div\\" . $this->class;

        $div = new $class ($this->parts);

        if (!system\text::is_alpha($this->method))
            return $this->set_error ("incorrect symbols in method param");
        $method = $this->method;

        if (!is_callable(array ($div, $method)))
            return $this->set_error ("api class/method not found: " . $class . "/" . $method);

        if (!$div->$method ())
            return $this->set_error ($div->get_error());

        return $div->get_packet ();
    }

    protected $error = "";
    public function get_error () { return $this->error; }
    protected function set_error ($message) { $this->error = $message; return false; }
}