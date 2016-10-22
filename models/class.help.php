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
        $this -> shared -> done ("0.2");
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
            $class_name = $matches [1];
            $this -> getClassInfo ($class_name);
        }
        $this -> shared -> done ($this -> answer);
    }

    /** Collect docs-info for each method
     * @param $class_name - Name of class to analyze
     */
    private function getClassInfo ($class_name)
    {
        include_once "models/class.$class_name.php";
        $rc = new ReflectionClass($class_name);
//      $info ["info"] = $rc -> getDocComment ();
        $info ["methods"] = array ();
        foreach ($rc -> getMethods () as $method)
            if (substr($method -> name, 0, strlen ($this -> api_prefix)) == 
                                                   $this -> api_prefix)
            {
                $m = substr($method -> name, strlen ($this -> api_prefix));
                $this -> answer [$class_name . "/" . $m] =
                    $rc -> getMethod ($method -> name) -> getDocComment ();
            }
    }

}

?>