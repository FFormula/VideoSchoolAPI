<?php
    include "system/inc.header.php";

    $api = new run\api();

    if ($api->run())
        $answer = $api->get_array();
    else
        $answer = $api->get_error();

    echo "<pre>";
    print_r ($answer);
    // echo "\n" . json_encode ($answer);


