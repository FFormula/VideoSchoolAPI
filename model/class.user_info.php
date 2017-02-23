<?php

namespace model;

use \system;
use \table;

class user_info extends system\resultable
{

    public function get_user_info_by_name ($name)
    {
        $user = new table\user ();
        if (!$user->select_by_name($name))
            return $this->set_error ("user not found");

        return $this->set_array
        (
            array (
                "user_id" => $user->id,
                "name" => $user->name,
                "status" => $user->status,
                "avatar" => "https://www.videosharp.info/data/img/photos/avatar.png"
            )
        );
    }

    public function get_all_user_list ()
    {
        $user = new table\user ();
        $rows = $user->select_all();
        return $this->set_array ($rows);
    }
}