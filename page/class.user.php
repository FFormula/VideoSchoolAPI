<?php

namespace page;

class user extends \system\resultable
{
    public function login ()
    {
        global $lang;
        include_lang ("menu");
        $this->array["menu"] = "user/login";

        include_lang ("user");
        $this->array["title"] = $lang["user.title.user login page"];
        return true;
    }
}
