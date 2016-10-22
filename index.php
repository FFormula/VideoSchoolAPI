<?php

    include "shared/class.shared.php";
    
    $shared = new Shared ();
    try 
    {
        $shared -> init ();
        $model  = $shared -> data -> model;
        $action = "api_" . $shared -> data -> action;
        
        if (!is_file ("models/class." . $model . ".php"))
            throw new Exception ("Model $model class not found");

        include "models/class.model.php";
        include "models/class." . $model . ".php";

        $class = new $model ($shared);
        if (!is_callable (array ($class, $action)))
            throw new Exception ("Model $model action $action not found");

        $class -> $action ();
        $class -> done ();
    }
    catch (Exception $e) 
    {
        $shared -> error -> setFatal ($e);
        $shared -> done ();
    }
    
    $shared -> output ();
?>