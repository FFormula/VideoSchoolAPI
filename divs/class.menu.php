<?php

namespace divs;

class menu
{
    public $items;
    public $right;

    function __construct()
    {
        $this->items = array ();
        $this->items["news"] = new \divs\menu_item("Лента", "/news");
        $this->items["shop"] = new \divs\menu_item("Курсы", "/shop");
        $this->items["fors"] = new \divs\menu_item("Люди", "/fors");
        $this->items["help"] = new \divs\menu_item("Помощь", "/help");
        $this->right = new \divs\menu_item("Кабинет", "/user");
    }

}