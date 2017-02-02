<?php

class user extends api
{
    public function join ($get)
    {
        $user = new users ();
        $user->set_row_field("name", $get["name"]);
        $user->set_row_field("email", $get["email"]);
        $user->set_row_field("passw_raw", $get["passw"]);
        $user->set_row_field("master_id", $get["master_id"]);
        $user->set_row_field("status", "open");
        $id = $user->insert ();
        return array ("id" => $id);
    }

    public function login ($get)
    {
        $user = new users ();
        $error = $user->login($get["email"], $get["passw"]);
        if ($error == "ok")
        {
            $_SESSION ["user"] = $user->get_row();
            return $user->get_row();
        }
        return $this->error($error);
    }

    public function show ($get)
    {
        $user = new users ();
        if (isset ($get ["id"]))
            $user -> select_by_id($get ["id"]);
        else if (isset ($get ["name"]))
            $user -> select_by_name($get ["name"]);
        else
            $user -> clear ();
        return $user -> get_row();
    }

    public function edit ($get)
    {
        $field = $get["field"];
        $value = $get["value"];
        $passw = $get["passw"];
        $user = new user ();
    }

    public function logout ($get)
    {
        unset ($_SESSION ["user"]);
    }

}