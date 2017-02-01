<?php

class user
{
    public function join ($get)
    {
        $user = new users ();
        $user->set_row_field("user", $get["user"]);
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
        $id = $user->login($get["email"], $get["passw"]);
        if (!$id)
            return array ("error" => "Invalid email or password");
        return array ("id" => $id);
    }

    public function show ($get)
    {
        $user = new users ();
        if (isset ($get ["id"]))
            $user -> select_by_id($get ["id"]);
        else if (isset ($get ["user"]))
            $user -> select_by_user($get ["user"]);
        else
            $user -> clear ();
        return $user -> get_row();
    }

    public function edit ($get, $post)
    {

    }

    public function logout ($get)
    {

    }

}