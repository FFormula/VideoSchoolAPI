<?php

namespace api;

use \model;

class info extends \system\resultable
{

    public function show_user_by_name ($get)
    {
        if (!isset ($get ["name"]))
            return $this->set_error("[name] param does not set");

        $user_info = new model\user_info();
        if (!$user_info->get_user_info_by_name($get ["name"]))
            return $this->set_error ("user not found");

        return $this->set_array($user_info->get_array());
    }

    public function show_all_users ($get)
    {
        $user_info = new model\user_info();
        if (!$user_info->get_all_user_list())
            return $this->set_error ("user not found");

        return $this->set_array($user_info->get_array());
    }
}