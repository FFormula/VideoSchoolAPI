<?php
    include "config.php";
    include "header.php";

    $api = new run\api();

    if ($api->run())
        $answer = "ok";
    else
        $answer = $api->get_error();

    echo $answer;

