<?php
    include     "../system/inc.config.php";
    include ROOT . "system/inc.lang.php";
    include ROOT . "system/inc.fun.php";

    session_start();
    header('Content-Type: text/html; charset=utf-8');
    date_default_timezone_set("Europe/Moscow");

    if ($_SERVER['PHP_SELF'] != "/index.php") // PHPStorm Debug Init
        $_GET ["data"] = "/shop/index";

    set_lang ();

    function __autoload ($class)
    {
        $path = explode ("\\", $class);
        if (count ($path) != 2) return;
        $file = ROOT . $path[0] . "/class." . $path[1] . ".php";
        //echo "Class [" . $class ."] ";
        //echo "from file [" . $file . "]<br>";
        if (!file_exists($file)) return;
        require_once $file;
    }
