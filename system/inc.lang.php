<?php

    function set_lang ()
    {
        global $lg;
        if (isset ($_GET ["lang"]))
            $lg = $_GET ["lang"];
        else if (isset ($_SESSION ["lang"]))
            $lg = $_SESSION ["lang"];
        else if (isset ($_COOKIE ["lang"]))
            $lg = $_COOKIE ["lang"];
        $langs = explode(",", LANG_LIST);
        if (!in_array($lg, $langs))
            $lg = LANG_DEFAULT;
        $_SESSION ["lang"] = $lg;
    }

    function include_lang ($page)
    {
        global $lang, $lg;
        $rows = \table\db::getDB()->select (
            "SELECT word, $lg
               FROM langs
              WHERE word LIKE '$page.%'");
        foreach ($rows as $value)
            $lang [$value ["word"]] = $value [$lg];
        /*
        $langfile = ROOT . "lang/$page.$lg.php";
        if (file_exists ($langfile))
            include_once $langfile;
        else {
            $langfile = ROOT . "lang/$page." . LANG_DEFAULT . ".php";
            @include_once $langfile;
        }*/
    }

