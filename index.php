<?php
    include "config.php";
    include "header.php";

    $loader = new loader ();
    $output = new output ($loader);
    $output->done ();
