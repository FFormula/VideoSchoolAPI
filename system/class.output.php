<?php

class output
{
    private $mode = "smarty";
    private $class;
    private $method;
    private $info;

    public function __construct($loader)
    {
        $this->info = $loader->get_info();
        $this->class = $loader->get_class();
        $this->method = $loader->get_method();
    }

    public function done ()
    {
        $this->info["class"] = $this->class;
        $this->info["method"] = $this->method;
        switch ($this->mode)
        {
            case "json" : return $this->done_json();
            case "dump" : return $this->done_dump();
            case "array": return $this->done_array();
            case "smarty" :
            case "" :     return $this->done_smarty();
        }
    }

    private function done_json ()
    {
        echo json_encode($this->info);
    }

    private function done_dump ()
    {
        var_dump($this->info);
    }

    private function done_array ()
    {
        echo "<pre>";
        print_r($this->info);
        echo "</pre>";
    }

    private function done_smarty ()
    {
        if ($this->redirect()) return;
        require_once "lib/Smarty.class.php";
        $smart = new Smarty ();
        $smart->caching = false;
        $smart->debugging = false;
        $smart->template_dir = SMARTY_TEMPLATES_DIR;
        $smart->assign ("info", $this->info);
        $smart->display ($this->class . "." . $this->method . ".tpl");
    }

    private function redirect ()
    {
        if (!isset ($this->info["redirect"]))
            return false;
        $url = $this->info["redirect"];
        @header ("Location: $url");
        echo "<script> document.location = '$url'; </script>";
        return true;
    }
}