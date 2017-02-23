<?php

namespace page;

class auth extends \system\resultable
{
    public function form_login ($get)
    {
        $this->array["title"] = "Вход на сайт";
        $this->array["email"] = @$get ["email"];
        return true;
    }

    public function form_login_post ($get, $post)
    {
        $this->array["title"] = "Вход на сайт";
        $this->array["email"] = $post["email"];

        $api = new \api\user ();
        if (!$api->do_login($post))
            return $this->set_error($api->get_error());

        return true;
    }

    public function form_join ($get)
    {
        $this->array ["title"] = "Регистрация нового пользователя";
        $this->array ["email"] = @$get ["email"];
        $this->array ["name"] = "";
        return true;
    }

    public function form_join_post ($get, $post)
    {
        $this->array ["title"] = "Регистрация нового пользователя";
        $this->array ["email"] = $post["email"];
        $this->array ["name"] = $post["name"];

        $api = new \api\user ();
        if (!$api->do_join($post))
            return $this->set_error($api->get_error());

        $this->array["redirect"] = "/login";
        return true;
    }
}