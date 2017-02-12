<?php
    include "config.php";
    include "header.php";

    require_once "lib/Smarty.class.php";
    $smart = new \Smarty ();
    $smart->caching = false;
    $smart->debugging = false;
    $smart->template_dir = SMARTY_TEMPLATES_DIR;
    $smart->display ("index.tpl");

