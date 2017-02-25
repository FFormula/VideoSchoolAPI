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
    public function login ($email, $password)
    {
        $table_user = new table\user();
        if (!$table_user->select_by_email($email))
            return $this->set_error("email not found");
//        if ($table_user->passhash != $this->hash_password($user->name, $password))
//            return $this->set_error("invalid password");
        if ($table_user->failed_logins >= 5)
            return $this->set_error("Account has been blocked. Too many incorrect authorizations");

        if ($table_user->password != $password)
        {
            $table_user->failed_logins ++;
            $table_user->update();
            return $this->set_error("invalid password");
        }
        if ($table_user->failed_logins > 0)
        {
            $table_user->failed_logins = 0;
            $table_user->update();
        }
        if ($table_user->status == "stop")
            return $this->set_error("user account has been blocked");
        if ($table_user->status == "wait")
            return $this->set_error("please wait for approving by admin");
        if (!in_array ($table_user->status, ["user", "moder", "admin"]))
            return $this->set_error("unknown user status");

        return $this->ok();
    }

}
