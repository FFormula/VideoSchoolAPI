<?php

namespace page;

class user extends \system\resultable
{
    public function login ()
    {
        global $lang;
        $this->array["menu"] = "user/login";
        $this->array["title"] = $lang["user.login.title.user login page"];
        return true;
    }

    public function login_post ($get, $post)
    {
        $this->login();
        $api_user = new \api\user();
        if (!$api_user->do_login($post))
            return $this->set_error($api_user->get_error());
        return true;
    }

    public function signup ()
    {
        global $lang;
        $this->array["menu"] = "user/signup";
        $this->array["title"] = $lang["user.signup.title.user signup page"];
        return true;
    }
}
