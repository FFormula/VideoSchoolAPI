<?php
    include "config.php";
    include "header.php";

    $div = new \run\div();

    if ($div->run())
        $answer = "ok";
    else
        $answer = $div->get_error();

    echo $answer;
