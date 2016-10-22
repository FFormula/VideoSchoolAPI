<?php

/**
* Model.Help
* General info about this API
* @author Jevgenij Volosatov
*/
class help extends model
{
    private $api_prefix = "api_";

    /** Return current version of API */
    public function api_version ()
    {
        $this -> shared -> done (array ("version" => "0.1"));
    }
    
    /** Return list of all methods */
    public function api_index ()
    {
        $dir = scandir("models/"); 
        $this -> answer = array ();
        foreach ($dir as $key => $file)
        {
            if (!preg_match ('/class\\.(.+)\\.php$/', $file, $matches))
                continue;
            $name = $matches [1];
            if (in_array ($name, array ("model")))
                continue;

            $this -> getClassInfo ($name);

        }
        $this -> shared -> done ($this -> answer);
    }
    
    private function getClassInfo ($name)
    {
        include_once "models/class.$name.php";
        $rc = new ReflectionClass($name);
//      $info ["info"] = $rc -> getDocComment ();
        $info ["methods"] = array ();
        foreach ($rc -> getMethods () as $method)
            if (substr($method -> name, 0, strlen ($this -> api_prefix)) == 
                                                   $this -> api_prefix)
            {
                $m = substr($method -> name, strlen ($this -> api_prefix));
                $this -> answer [$name . "/" . $m] = 
                    $rc -> getMethod ($method -> name) -> getDocComment ();
            }
    }

}

?>