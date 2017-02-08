<?php

class user extends api
{
    public function help ($get)
    {
        return $this->show_help (
"User API functions list:
/user/join - register new user
/user/login - authorize by email and password
/user/show - show logged user info
/user/edit - edit user data
/user/logout - sign out");
    }

    public function join ($get)
    {
        if (count($get) <= 2)
            return $this->show_help(
"Register new user:
[name] - unique user name, min length 3, max length 20, only letters, digits, _ and . 
[email] - valid unique user e-mail address
[password] - user password, min length 8, max length 50
[master] - inviter user name required");
        $user = new users ();
        if (!isset ($get ["name"]))
            return $this->error("[name] param does not set");
        if (!text::is_alpha($get["name"]))
            return $this->error("[name] incorrect, use only letters, digits, _ and .");
        if (strlen($get["name"]) < 3)
            return $this->error("[name] is too short");
        if (strlen($get["name"]) > 20)
            return $this->error("[name] is too long");
        if ($user->find_id_by_name($get["name"]))
            return $this->error("[name] user name already taken");
        if (!isset ($get ["email"]))
            return $this->error("[email] param does not set");
        if (!text::is_email($get["email"]))
            return $this->error("[email] incorrect, provide correct e-mail address");
        if ($user->find_id_by_email($get["email"]))
            return $this->error("[email] user email already registered");
        if (!isset ($get ["password"]))
            return $this->error("[password] field does not set");
        if (strlen($get["password"]) < 8)
            return $this->error("[password] is too short");
        if (strlen($get["password"]) > 50)
            return $this->error("[password] is too long");
        if (!isset ($get ["master"]))
            return $this->error("[master] param does not set");
        if (!text::is_alpha($get["master"]))
            return $this->error("[master] incorrect, provide an inviter user name");
        $master_id = $user->find_id_by_name($get["master"]);
        if (!$master_id)
            return $this->error("[master] user not found");
        $user->set_row_field("name", $get["name"]);
        $user->set_row_field("email", $get["email"]);
        $user->set_row_field("password", $get["password"]);
        $user->set_row_field("master_id", $master_id);
        $id = $user->insert ();
        return array ("id" => $id);
    }

    public function login ($get)
    {
        if (count($get) <= 2)
            return $this->show_help(
"Login an existing user:
[email] - user e-mail addresss
[password] - user password
When login is successful, an authorized cookie will be placed.");
        $user = new users ();
        if (!isset ($get ["email"]))
            return $this->error("[email] param does not set");
        if (!text::is_email($get["email"]))
            return $this->error("[email] incorrect, provide correct e-mail address");
        if (!$user->find_id_by_email($get["email"]))
            return $this->error("[email] this e-mail not found");
        if (!isset ($get ["password"]))
            return $this->error("[password] field does not set");
        $user_id = $user->login($get["email"], $get["password"]);
        if (!$user_id)
            return $this->error("[password] incorrect password");
        $user->select($user_id);
        $status = $user->get_row()["status"];
        if ($status == "wait")
            return $this->error("[status] waiting for confirmation e-mail");
        if ($status == "stop")
            return $this->error("[status] user account has been disabled");
        if ($status == "open")
        {
            $_SESSION ["user"] = $user->get_row();
            return $user->get_row();
        }
        return $this->error("unknown error");
    }

    public function show ($get)
    {
        $arr = array ();
        $head = new divs_head("show user demo");
        $arr ["head"] = $head->get();
        return $arr;

        if (!($id = $this->my_user_id()))
            return $this->error("No login");
        $user = new users ();
        $user->select($id);
        return $user->get_row();
    }

    public function edit_name ($get)
    {
        if (count($get) <= 2)
            return $this->show_help(
"Update name in the user table
[value] new name
[password] confirm changes by current password");
        if (!($id = $this->my_user_id()))
            return $this->error("No login");
        if (!isset($get["value"]))
            return $this->error("[value] param does not set");
        if (!isset($get["password"]))
            return $this->error("[password] param does not set");
        $value = $get["value"];
        if (!text::is_alpha($value))
            return $this->error("[value] must be alphanumerical");
        if (strlen($value) < 3)
            return $this->error("[value] is too short");
        if (strlen($value) > 20)
            return $this->error("[value] is too long");
        $password = $get["password"];
        $user = new users ();
        if ($user->update_name ($id, $value, $password))
            return $this->message("ok");
        return $this->error("name not changed");
    }

    public function edit_email ($get)
    {
        if (count($get) <= 2)
            return $this->show_help(
"Update email in the user table
[value] new e-mail
[password] confirm changes by current password");
        if (!($id = $this->my_user_id()))
            return $this->error("No login");
        if (!isset($get["value"]))
            return $this->error("[value] param does not set");
        if (!isset($get["password"]))
            return $this->error("[password] param does not set");
        $value = $get["value"];
        if (!text::is_email($value))
            return $this->error("[value] must be a correct e-mail address");
        $password = $get["password"];
        $user = new users ();
        if ($user->update_email ($id, $value, $password))
            return $this->message("ok");
        return $this->error("email not changed");
    }

    public function edit_password ($get)
    {
        if (count($get) <= 2)
            return $this->show_help(
"Change user password
[value] new password
[password] confirm changes by current password");
        if (!($id = $this->my_user_id()))
            return $this->error("No login");
        if (!isset($get["value"]))
            return $this->error("[value] param does not set");
        if (!isset($get["password"]))
            return $this->error("[password] param does not set");
        $value = $get["value"];
        if (strlen($value) < 8)
            return $this->error("[value] is too short");
        if (strlen($value) > 50)
            return $this->error("[value] is too long");
        $password = $get["password"];
        $user = new users ();
        if ($user->update_password ($id, $value, $password))
            return $this->message("ok");
        return $this->error("password not changed");
    }

    public function logout ($get)
    {
        unset ($_SESSION ["user"]);
        //return $this->message("Logged out");
        return array ("redirect" => "/");
    }

}