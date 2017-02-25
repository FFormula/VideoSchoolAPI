<?php

namespace model;

use \system\resultable;
use \table;

class user extends resultable
{
    /**
     * @param $email user e-mail
     * @param $password user password
     * @return bool true on successful register, false on error
     * Authorize user and store him in session
     */
    public function login($email, $password)
    {
        $table_user = new table\user();

        if (!$table_user->select_by_email($email))
            return $this->set_error("email not found");

        if ($table_user->failed_logins >= 5)
            return $this->set_error("Account has been blocked: too many incorrect authorizations");

        if ($table_user->password != $this->get_passhash($email, $password)) {
            $table_user->failed_logins++;
            $table_user->update();
            return $this->set_error("invalid password");
        }

        if ($table_user->failed_logins > 0) {
            $table_user->failed_logins = 0;
            $table_user->update();
        }

        if ($table_user->status == "stop")
            return $this->set_error("user account has been blocked");

        if ($table_user->status == "wait")
            return $this->set_error("please wait for approving by admin");

        if (!in_array($table_user->status, ["user", "moder", "admin"]))
            return $this->set_error("unknown user status");

        return $this->ok();
    }

    public function signup($name, $email, $password, $phone, $park)
    {
        if (!$this->check_name($name))
            return false;
        if (!$this->check_password($password))
            return false;
        $table_user = new table\user();
        if ($table_user->select_by_email($email) != false)
            return $this->set_error("this email already registered");
        $table_user->name = $name;
        $table_user->email = $email;
        $table_user->password = $this->get_passhash($email, $password);
        $table_user->phone = $phone;
        $table_user->park = $park;
        $table_user->failed_logins = 0;
        $table_user->status = 'wait';
        if (!$table_user->insert())
            return $this->set_error($table_user->get_error());

        return true;
    }

    private function get_passhash ($email, $password)
    {
        return sha1($email . "/" . $password);
    }

    private function check_name ($name)
    {
//        if (!is_alpha($name))
//            return $this->set_error("name incorrect, use letters/digits/./_, start with letter");
        if (strlen($name) < USER_NAME_MIN_LENGTH)
            return $this->set_error("name is too short");
        if (strlen($name) > USER_NAME_MAX_LENGTH)
            return $this->set_error("name is too long");
        return true;
    }

    private function check_email ($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            return $this->set_error("email incorrect");
        return true;
    }

    private function check_password ($password)
    {
        if (strlen($password) < USER_PASSWORD_MIN_LENGTH)
            return $this->set_error("[password] is too short");
        if (strlen($password) > USER_PASSWORD_MAX_LENGTH)
            return $this->set_error("[password] is too long");
        return true;
    }

}
