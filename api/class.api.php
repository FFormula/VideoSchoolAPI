<?php

namespace api;

class api
{
    protected $error_message;

    protected function set_error ($message)
    {
        $this->error_message = $message;
        return false;
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