<?php

namespace model;

use \table;
use \system;

/**
 * Class login
 * @package model
 * Register, authorize operation
 * Change password, update user name and email
 */
class login
{
    /**
     * @param $name user name
     * @param $email user e-mail
     * @param $password user password
     * @return bool true on success, false on error
     * Register new user
     */
    public function join ($name, $email, $password)
    {
        if (!$this->check_name($name)) return false;
        if (!$this->check_email($email)) return false;
        if (!$this->check_password($password)) return false;
        $user = new table\user();

        if ($user->select_by_name($name))
            return $this->set_error ("user name taken");
        if ($user->select_by_email($email))
            return $this->set_error ("email registered");

        $user->name = $name;
        $user->email = $email;
        $user->status = "wait";
        $user->passhash = $this->hash_password($name, $password);
        $user->insert();
        return true;
    }

    /**
     * @param $email user e-mail
     * @param $password user password
     * @return bool true on successful register, false on error
     * Authorize user and store him in session
     */
    public function login ($email, $password)
    {
        if (!$this->check_email($email)) return false;

        $user = new table\user();
        if (!$user->select_by_email($email))
            return $this->set_error("email not found");
        if ($user->passhash != $this->hash_password($user->name, $password))
            return $this->set_error("invalid password");
        if ($user->status == "stop")
            return $this->set_error("user account has been blocked");
        if ($user->status == "wait")
            return $this->set_error("please confirm your e-mail");
        if ($user->status != "open")
            return $this->set_error("unknown user status");

        system\session::set_user($user->pack());
        return true;
    }

    /**
     * @param $name new user name
     * @param $password user password for confirmation
     * @return bool true on success
     * Update user name
     */
    public function update_name ($name, $password)
    {
        if (!system\session::is_logged())
            return $this->set_error("no login");

        if (!$this->check_name($name)) return false;

        $user = new table\user(system\session::get_user()["id"]);
        if (!$user->id)
            return $this->set_error("user not found");
        if ($user->passhash != $this->hash_password($user->name, $password))
            return $this->set_error("invalid password");
        if ($user->name == $name)
            return $this->set_error("name is the same");
        $user->name = $name;
        $user->passhash = $this->hash_password($name, $password);
        $user->update();
        return true;
    }

    /**
     * @param $email new user e-mail
     * @param $password user password for confirmation
     * @return bool true on success
     * Update user e-mail
     */
    public function update_email ($email, $password)
    {
        if (!system\session::is_logged())
            return $this->set_error("no login");

        if (!$this->check_email($email)) return false;

        $user = new table\user(system\session::get_user()["id"]);
        if (!$user->id)
            return $this->set_error("user not found");
        if ($user->passhash != $this->hash_password($user->name, $password))
            return $this->set_error("invalid password");
        if ($user->email == $email)
            return $this->set_error("email is the same");
        $user->email = $email;
        $user->update();
        return true;
    }

    /**
     * @param $new_password a new password for user
     * @param $old_password current password for confirmation
     * @return bool true on success
     * Change user password
     */
    public function update_password ($new_password, $old_password)
    {
        if (!system\session::is_logged())
            return $this->set_error("no login");

        if (!$this->check_password($new_password)) return false;
        
        $user = new table\user(system\session::get_user()["id"]);
        if (!$user->id)
            return $this->set_error("user not found");
        if ($user->passhash != $this->hash_password($user->name, $old_password))
            return $this->set_error("invalid password");
        if ($new_password == $old_password)
            return $this->set_error("password is the same");
        $user->passhash = $this->hash_password($user->name, $new_password);
        $user->update();
        return true;
    }

    /**
     * @return bool true
     * Logout and close the session
     */
    public function logout ()
    {
        system\session::logout();
        return true;
    }

    protected function check_name ($name)
    {
        if (!system\text::is_alpha($name))
            return $this->set_error("name incorrect, use letters/digits/./_, start with letter");
        if (strlen($name) < USER_NAME_MIN_LENGTH)
            return $this->set_error("name is too short");
        if (strlen($name) > USER_NAME_MAX_LENGTH)
            return $this->set_error("name is too long");
        return true;
    }

    protected function check_email ($email)
    {
        if (!system\text::is_email($email))
            return $this->set_error("email incorrect");
        return true;
    }

    protected function check_password ($password)
    {
        if (strlen($password) < USER_PASSWORD_MIN_LENGTH)
            return $this->set_error("[password] is too short");
        if (strlen($password) > USER_PASSWORD_MAX_LENGTH)
            return $this->set_error("[password] is too long");
        return true;
    }

    protected function hash_password ($name, $password)
    {
        return sha1 ($name . "/" . $password);
    }


    protected $error = "";
    public function get_error () { return $this->error; }
    protected function set_error ($message) { $this->error = $message; return false; }

}
