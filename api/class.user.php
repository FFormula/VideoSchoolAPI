<?php

namespace api;

/**
 * Class user
 * @package api
 * User API functions list:
 */
class user extends api
{
    /**
     * @param $get
     * @return bool
     * Register new user:
     *     [name] - unique user screen-name,
     *     [email] - valid unique user e-mail address
     *     [password] - user password, stored sha1-hash code
     */
    public function join ($get)
    {
        if (!isset ($get ["name"]))
            return $this->set_error("[name] param does not set");
        if (!isset ($get ["email"]))
            return $this->set_error("[email] param does not set");
        if (!isset ($get ["password"]))
            return $this->set_error("[password] field does not set");

        $login = new \model\login ();
        if ($login->join($get["name"], $get["email"], $get["password"]))
            return $this->set_error($login->get_error());

        return true;
    }

    /**
     * @param $get
     * @return bool
     * Login an existing user:
     *     [email] - user e-mail addresss
     *     [password] - user password
     * When login is successful, an authorized cookie will be placed.
     */
    public function login ($get)
    {
        if (!isset ($get ["email"]))
            return $this->set_error("[email] param does not set");
        if (!isset ($get ["password"]))
            return $this->set_error("[password] field does not set");

        $login = new \model\login ();
        if (!$login->login($get["email"], $get["password"]))
            return $this->set_error ($login->get_error());

        return true;
    }

    public function show ($get)
    {
        $arr = array ();
        $arr ["head"] = new \divs\head("show user demo");
        $arr ["menu"] = new \divs\menu();
        $arr ["tail"] = new \divs\tail();
        return $arr;
    }

    /**
     * @param $get
     * @return bool
     * Update name in the user table
     *    [name] new name
     *    [password] confirm changes by current password
     */
    public function edit_name ($get)
    {
        if (!isset($get["name"]))
            return $this->error("[name] param does not set");
        if (!isset($get["password"]))
            return $this->error("[password] param does not set");

        $login = new \model\login ();
        if (!$login->update_name($get["name"], $get["password"]))
            return $this->set_error ($login->get_error());

        return true;
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
        if (!\system\text::is_email($value))
            return $this->error("[value] must be a correct e-mail address");
        $password = $get["password"];
        $user = new \model\users ();
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
        $user = new \model\users ();
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