<?php
    include "system/inc.header.php";

    $page = new \run\page();
    $page->run();

    if (isset ($page->get_array()["redirect"]))
    {
        header("Location: " . $page->get_array()["redirect"]);
        die ();
    }

    include "lang/info.ru.php";
    include "lang/menu.ru.php";

    include ROOT . "data/smarty/Smarty.class.php";
    $smart = new Smarty ();
    $smart->template_dir = SMARTY_TEMPLATES_DIR;
    $smart->assign("arr", $page->get_array());
    $smart->assign("err", $page->get_error());
    $smart->assign("lang", $lang);
    $view_file = $page->get_class() . "/" . $page->get_method() . ".tpl";
    //echo $view_file . "<br>";
    $smart->display($view_file);
