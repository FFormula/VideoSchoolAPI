<?php
    include "config.php";
    include ROOT . "shared/class.shared.php";

    $shared = new Shared ();
    try 
    {
        $shared -> init ();
        if (!$shared -> auth -> can_action())
            throw new Exception("Access denied");

        $model  = $shared -> data -> model;
        $action = "api_" . $shared -> data -> action;

        if (!is_file (ROOT . "models/class." . $model . ".php"))
        throw new Exception ("Model $model class not found");

        include ROOT . "models/class.model.php";
        include ROOT . "models/class." . $model . ".php";

        $class = new $model ($shared);
        if (!is_callable (array ($class, $action)))
            throw new Exception ("Model $model action $action not found");

        $class -> $action ();

        $class -> done ();
    }
    catch (Exception $e) 
    {
        $shared -> fatal ($e);
    }
    
    $shared -> output ();
