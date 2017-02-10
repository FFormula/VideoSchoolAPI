<?php

namespace api;

use model;

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

        $login = new model\login ();
        if (!$login->join($get["name"], $get["email"], $get["password"]))
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

        $login = new model\login ();
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
            return $this->set_error("[name] param does not set");
        if (!isset($get["password"]))
            return $this->set_error("[password] param does not set");

        $login = new model\login ();
        if (!$login->update_name($get["name"], $get["password"]))
            return $this->set_error ($login->get_error());

        return true;
    }

    /**
     * @param $get
     * @return bool
     * Update email in the user table
     *     [email] new e-mail
     *     [password] confirm changes by current password
     */
    public function edit_email ($get)
    {
        if (!isset($get["email"]))
            return $this->set_error("[email] param does not set");
        if (!isset($get["password"]))
            return $this->set_error("[password] param does not set");

        $login = new model\login ();
        if (!$login->update_email($get["email"], $get["password"]))
            return $this->set_error ($login->get_error());

        return true;
    }

    /**
     * @param $get
     * @return bool
     * Change user password
     *     [new_password] new password
     *     [password] confirm changes by current password
     */
    public function edit_password ($get)
    {
        if (!isset($get["new_password"]))
            return $this->set_error("[new_password] param does not set");
        if (!isset($get["password"]))
            return $this->set_error("[password] param does not set");

        $login = new model\login ();
        if (!$login->update_password($get["new_password"], $get["password"]))
            return $this->set_error ($login->get_error());

        return true;
    }

    public function logout ($get)
    {
        unset ($_SESSION ["user"]);
        //return $this->message("Logged out");
        return array ("redirect" => "/");
    }

}