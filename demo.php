<?php
    include "system/inc.header.php";

    require_once ROOT . "data/smarty/Smarty.class.php";
    $smart = new \Smarty ();
    $smart->caching = false;
    $smart->debugging = false;
    $smart->template_dir = SMARTY_TEMPLATES_DIR;
    $smart->display ("index.tpl");

