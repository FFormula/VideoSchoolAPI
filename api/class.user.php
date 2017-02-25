<?php

namespace api;

use system;
use model;

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
     * Login an existing user:
     *     [email] - user e-mail addresss
     *     [password] - user password
     */
    public function do_login ($get)
    {
        if (!isset ($get ["email"]))
            return $this->set_error("[email] param does not set");
        if (!isset ($get ["password"]))
            return $this->set_error("[password] param does not set");

        $model_user = new model\user ();
        if (!$model_user->login($get["email"], $get["password"]))
            return $this->set_error ($model_user->get_error());

        return $this->ok();
    }

    public function do_signup ($get)
    {
        if (!isset ($get ["name"]))
            return $this->set_error("[name] param does not set");
        if (!isset ($get ["email"]))
            return $this->set_error("[email] param does not set");
        if (!isset ($get ["password"]))
            return $this->set_error("[password] param does not set");
        if (!isset ($get ["phone"]))
            return $this->set_error("[phone] param does not set");
        if (!isset ($get ["park"]))
            return $this->set_error("[park] param does not set");

        $model_user = new model\user ();
        if (!$model_user->signup(
                $get["name"], $get["email"], $get["password"], $get["phone"], $get["park"]))
            return $this->set_error ($model_user->get_error());

        return $this->ok();
    }

}
