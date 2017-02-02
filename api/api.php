<?php

class api
{
    protected function message ($text)
    {
        return array (
            "message" => $text
        );
    }

    protected function error ($text)
    {
        return array (
            "error" => $text
        );
    }

    protected function show_help ($text)
    {
        return array (
            "help" => $text
        );
    }
}