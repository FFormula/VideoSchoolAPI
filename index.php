<?php
    include "config.php";

    if ($_SERVER['PHP_SELF'] != "/index.php")
        $_GET ["data"] = "/shop/index";

    try
    {
        $loader = new loader ();
        $output = new output ($loader);
        $output->done ();
    }
    catch (Exception $e)
    {
        echo $e -> getMessage();
    }
