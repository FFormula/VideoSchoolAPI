<?php

namespace system;

class text
{
    public static function is_alpha ($text)
    {
        return preg_match("/[a-z]+[a-z0-9_.]*/", $text);
    }

    public static function is_email ($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function is_number ($number)
    {
        return preg_match("/^\d+$/", $number);
    }
}