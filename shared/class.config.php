<?php

class Config
{
    private $shared;
    private $info;
    
    function __counstruct ($shared)
    {
        $this -> shared = $shared;
    }

    public function get ($topic, $name)
    {
        if (isset ($this -> info [$topic] [$name]))
            return $this -> info [$topic] [$name];
        return "";
    }

    public function load ()
    {
        $this -> info ["data"] ["default_model"] = "help";
        $this -> info ["data"] ["default_action"] = "index";
    }

}

?>