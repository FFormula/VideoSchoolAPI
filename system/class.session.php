<?php

namespace system;

class session
{
    public static function get_user ()
    {
        if (isset ($_SESSION ["user"]))
            return $_SESSION ["user"];
        return array ();
    }
    
    public static function set_user ($user)
    {
        $_SESSION ["user"] = $user;
    }
    
    public static function is_logged ()
    {
        if (isset ($_SESSION ["user"] ["id"]))
            return true;
        return false;
    }

    public static function logout ()
    {
        unset ($_SESSION ["user"]);
    }

}