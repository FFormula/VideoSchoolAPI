<?php

namespace page;

class info extends \system\resultable
{
    public function index ($get)
    {
        global $lang;
        $this->array["menu"] = "info/index";
        $this->array["title"] = $lang["info.bad drivers database"];
        return true;
    }
}
