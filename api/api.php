<?php

class api
{
    protected function error ($message)
    {
        return array (
            "error" => $message
        );
    }

    protected function show_help ($message)
    {
        return array (
            "help" => $message
        );
    }
}