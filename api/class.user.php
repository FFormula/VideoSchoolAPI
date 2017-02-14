<?php

namespace api;

use model;
use system;
/**
 * Class user
 * @package api
 * User API functions list:
 */
class user extends system\resultable
{
    /**
     * @param $get
     * @return bool
     * Register new user:
     *     [name] - unique user screen-name,
     *     [email] - valid unique user e-mail address
     *     [password] - user password, stored sha1-hash code
     */
    public function do_join ($get)
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
    public function do_login ($get)
    {
        if (!isset ($get ["email"]))
            return $this->set_error("[email] param does not set");
        if (!isset ($get ["password"]))
            return $this->set_error("[password] field does not set");

        $login = new model\login ();
        if (!$login->login($get["email"], $get["password"]))
            return $this->set_error ($login->get_error());

        return $this->set_array ("ok");
    }

    /**
     * @param $get
     * @return bool
     * Update name in the user table
     *    [name] new name
     *    [password] confirm changes by current password
     */
    public function do_edit_name ($get)
    {
        if (!isset($get["name"]))
            return $this->set_error("[name] param does not set");
        if (!isset($get["password"]))
            return $this->set_error("[password] param does not set");

        $login = new model\login ();
        if (!$login->update_name($get["name"], $get["password"]))
            return $this->set_error ($login->get_error());

        return $this->set_array ("ok");
    }

    /**
     * @param $get
     * @return bool
     * Update email in the user table
     *     [email] new e-mail
     *     [password] confirm changes by current password
     */
    public function do_edit_email ($get)
    {
        if (!isset($get["email"]))
            return $this->set_error("[email] param does not set");
        if (!isset($get["password"]))
            return $this->set_error("[password] param does not set");

        $login = new model\login ();
        if (!$login->update_email($get["email"], $get["password"]))
            return $this->set_error ($login->get_error());

        return $this->set_array ("ok");
    }

    /**
     * @param $get
     * @return bool
     * Change user password
     *     [new_password] new password
     *     [password] confirm changes by current password
     */
    public function do_edit_password ($get)
    {
        if (!isset($get["new_password"]))
            return $this->set_error("[new_password] param does not set");
        if (!isset($get["password"]))
            return $this->set_error("[password] param does not set");

        $login = new model\login ();
        if (!$login->update_password($get["new_password"], $get["password"]))
            return $this->set_error ($login->get_error());

        return $this->set_array ("ok");
    }

    /**
     * @param $get
     * @return bool true
     * Logout and close user session
     */
    public function do_logout ($get)
    {
        $login = new model\login();
        $login->logout();

        return $this->set_array ("ok");
    }

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