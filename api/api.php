<?php

class api
{
    function error ($message)
    {
        return array (
            "error" => $message
        );
    }
}