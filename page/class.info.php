<?php

namespace page;

class info extends \system\resultable
{
    public function index ($get)
    {
        $this->array["menu"] = "info/index";

        return true;
    }
}
