<?php

namespace system;

use \table\db;

class lang
{
    private static $instance = null;

    public static function get()
    {
        if (!isset(static::$instance))
            static::$instance = new lang();
        return static::$instance;
    }

    private $lg;
    private $lang;

    private function __construct()
    {
        $this->init();
    }

    private function init()
    {
        if (isset ($_GET ["lang"]))
            $this->lg = $_GET ["lang"];
        else if (isset ($_SESSION ["lang"]))
            $this->lg = $_SESSION ["lang"];
//      else if (isset ($_COOKIE ["lang"]))
//          $lg = $_COOKIE ["lang"];
        if (!in_array($this->lg, explode(",", LANG_LIST)))
            $this->lg = LANG_DEFAULT;
        $_SESSION ["lang"] = $this->lg;
    }

    public function get_lang()
    {
        return $this->lang;
    }

    public function word($text)
    {
        if (!isset ($this->lang[$text]))
            $this->load_word($text);
        return $this->lang [$text];
    }

    public function load_page ($page)
    {
        $rows = db::get()->select_all(
            "SELECT word, " . $this->lg . "
               FROM langs
              WHERE word LIKE '" . addslashes ($page) . ".%'");
        if (!$rows)
            return;
        foreach ($rows as $value)
            $this->lang [$value ["word"]] = $value [$this->lg];
    }

    private function load_word ($text)
    {
        $word = db::get()->scalar (
            "SELECT " . $this->lg . "
               FROM langs
              WHERE word = '" . addslashes ($text) . "'");

        if ($word === false)
        {
            $str = "";
            foreach (explode(",", LANG_LIST) as $k)
                $str .= ", " . $k . " = '" . $k . ":" . addslashes($text) . "'";
            \table\db::get()->query (
                "INSERT INTO langs 
                    SET word = '" . addslashes ($text) . "'" .
                        $str);
            $word = $this->lg . ":" . $text;
        }
        $this->lang[$text] = $word;
    }



}