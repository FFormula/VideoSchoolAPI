<?php

namespace page;

class info extends \system\resultable
{
    public function index ($get)
    {
        global $lang;
        include_lang ("menu");
        $this->array["menu"] = "info/index";

        include_lang ("info");
        $this->array["title"] = $lang["info.bad drivers database"];

        return true;
    }
}
