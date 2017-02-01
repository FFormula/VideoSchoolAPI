<?php

class user
{
    public function join ($get, $post)
    {

    }

    public function login ($get)
    {

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