<?php
    include "config.php";
    include "header.php";

    $run  = new system\run();

    if ($run->run_api())
        $answer = "ok";
    else
        $answer = $run->get_error();

    echo $answer;

