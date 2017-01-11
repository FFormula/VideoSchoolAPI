<?php
    session_start();
    header('Content-Type: text/html; charset=utf-8');
    date_default_timezone_set("Europe/Moscow");

    if ($_SERVER['PHP_SELF'] != "/index.php") // PHPStorm Debug Init
        $_GET ["data"] = "/shop/index";

    function __autoload ($class)
    {
        $include_dirs = array ("model", "system");
        foreach ($include_dirs as $dir)
        {
            $file = ROOT . $dir . "/class." . $class . ".php";
            if (file_exists($file))
            {
                require_once $file;
                return;
            }
        }
    }