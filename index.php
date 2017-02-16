<?php
    include "system/inc.header.php";

    $div = new \run\div();

    if ($div->run())
        $answer = "ok";
    else
        $answer = $div->get_error();

    echo $answer;
