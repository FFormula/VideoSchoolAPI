<?php

namespace page;

use \system\lang;

class user extends \system\resultable
{
    public function login ()
    {
        echo "#";
        echo lang::get()->word("user.login.title.user login page") . "#";
        $this->array["menu"] = "user/login";
        $this->array["title"] = lang::get()->word("user.login.title.user login page");
        $this->array["email"] = "";
        return true;
    }

    public function login_post ($get, $post)
    {
        $this->login();
        $this->array["email"] = $post ["email"];
        $api_user = new \api\user();
        if (!$api_user->do_login($post))
            return $this->set_error($api_user->get_error());
        return true;
    }

    public function signup ()
    {
        $this->array["menu"] = "user/signup";
        $this->array["title"] = lang::get()->word("user.signup.title.user signup page");
        $this->array["name"] = "";
        $this->array["email"] = "";
        $this->array["phone"] = "";
        $this->array["park"] = "";
        return true;
    }

    public function signup_post ($get, $post)
    {
        $this->signup();
        $this->array["name"] = $post ["name"];
        $this->array["email"] = $post ["email"];
        $this->array["phone"] = $post ["phone"];
        $this->array["park"] = $post ["park"];
        $api_user = new \api\user();
        if (!$api_user->do_signup($post))
            return $this->set_error($api_user->get_error());
        return true;
    }
}