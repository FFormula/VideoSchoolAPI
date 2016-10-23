<?php

class Auth
{
    private $shared;
    private $userdata;

    function __construct ($shared)
    {
        $this -> shared = $shared;
        $userdata = array ();
    }

    public function get ($field)
    {
        if (isset ($this -> userdata [$field]))
            return $this -> userdata [$field];
        return "";
    }

    public function sign ()
    {
        $key = $this -> shared -> data -> get ("key");
        if (!$key) return false;

        if ($key != "1.md5code")
            return false;

        $this->userdata ["id"] = 1;
        return true;
    }

    public function can_action ()
    {
        $model  = $this -> shared -> data -> model;
        $action = $this -> shared -> data -> action;
        $model_action = $model . "/" . $action;
        if ($model_action == "help/version") return true;
        if ($model_action == "help/index") return true;
        if ($model_action == "user/login") return true;
        if ($model_action == "user/join") return true;
        if (!$this -> get ("id")) return false;

        if ($this -> get ("id") == "1")
            return true;

        return false;
    }

}