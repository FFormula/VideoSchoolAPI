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
     * When login is successful, an authorized cookie will be placed.
     */
    public function do_login ($get)
    {
        if (!isset ($get ["email"]))
            return $this->set_error("[email] param does not set");
        if (!isset ($get ["password"]))
            return $this->set_error("[password] field does not set");

        $model_user = new model\user ();
        if (!$model_user->login($get["email"], $get["password"]))
            return $this->set_error ($model_user->get_error());

        return $this->ok();
    }

}
