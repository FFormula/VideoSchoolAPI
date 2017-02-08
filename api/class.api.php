<?php

namespace api;

class api
{
    protected $get;
    protected $post;
    protected $info;

    protected function error ($text)
    {
        $this->info["error"] = $text;
    }

    protected function show_help ($text)
    {
        return array (
            "help" => $text
        );
    }

    protected function my_user_id ()
    {
        if (!isset($_SESSION ["user"] ["user_id"]))
            return false;
        return $_SESSION ["user"] ["user_id"];
    }
}