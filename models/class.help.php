<?php

/**
* Model.Help
* General info about this API
* @author Jevgenij Volosatov
*/
class help extends model
{
    /** Return current version of API */
    public function api_version ()
    {
        $this -> answer = "0.2";
        $this -> done ();
    }
    
    /** Return list of all methods */
    public function api_index ()
    {
        $dir = scandir(ROOT . "models/");
        $this -> answer = array ();
        foreach ($dir as $key => $file)
        {
            if (!preg_match ('/class\\.(.+)\\.php$/', $file, $matches))
                continue;
            $class_name = $matches [1];
            $this -> getClassInfo ($class_name);
        }
        $this -> done ();
    }
    
    /** Return current time from database */
    public function api_now ()
    {
        $now = $this -> shared -> db -> scalar ("SELECT NOW()");
        $this -> answer = $now;
        $this -> done ();
    }

    /** Collect docs-info for each method
     * @param $class_name - Name of class to analyze
     */
    private function getClassInfo ($class_name)
    {
        include_once ROOT . "models/class.$class_name.php";
        $rc = new ReflectionClass($class_name);
//      $info ["info"] = $rc -> getDocComment ();
        $info ["methods"] = array ();
        foreach ($rc -> getMethods () as $method)
            if (substr($method -> name, 0, strlen (HELP_API_PREFIX)) == HELP_API_PREFIX)
            {
                $m = substr($method -> name, strlen (HELP_API_PREFIX));
                $this -> answer [$class_name . "/" . $m] =
                    $rc -> getMethod ($method -> name) -> getDocComment ();
            }
    }

}

?>