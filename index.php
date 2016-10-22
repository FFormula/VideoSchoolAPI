<?php
    define ("ROOT", "D:\\phpstorm\\VideoSchool\\");
    include ROOT . "shared/class.shared.php";
    
    $shared = new Shared ();
    try 
    {
        $shared -> init ();
        $model  = $shared -> data -> model;
        $action = "api_" . $shared -> data -> action;
        
        if (!is_file (ROOT . "models/class." . $model . ".php"))
            throw new Exception ("Model $model class not found");

        include ROOT . "models/class.model.php";
        include ROOT . "models/class." . $model . ".php";

        $class = new $model ($shared);
        if (!is_callable (array ($class, $action)))
            throw new Exception ("Model $model action $action not found");

        if ($class -> can_action ())
            $class -> $action ();

        $class -> done ();
    }
    catch (Exception $e) 
    {
        $shared -> error -> set_fatal ($e);
        $shared -> done ();
    }
    
    $shared -> output ();
?>