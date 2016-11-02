<?php
    include "config.php";
    include ROOT . "system/class.db.php";
    include ROOT . "system/class.data.php";
    include ROOT . "system/class.module.php";

    $db = new DB ();
    $data = new Data ();

    try
    {
        $data -> init ($db);
        $module  = $data -> module;
        $action = "api_" . $data -> action;

        if (!is_file (ROOT . "module/class." . $module . ".php"))
            throw new Exception ("Module [$module] not found");

        include ROOT . "module/class." . $module . ".php";
        $class = new $module ();
        $class -> init ($db, $data);

        if (!is_callable (array ($class, $action)))
            throw new Exception ("Module [$module] action [$action] not found");

        $class -> $action ();
        $data -> done ($class -> get_answer());
    }
    catch (Exception $e)
    {
        $data -> error ($e -> getMessage());
        $data -> done ();
    }

    $data -> output ();
