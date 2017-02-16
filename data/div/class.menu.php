<?php

namespace divs;

class menu
{
    public $items;
    public $right;

    function __construct()
    {
        $this->items = array ();
        $this->items["news"] = new menu_item("Лента", "/news");
        $this->items["shop"] = new menu_item("Курсы", "/shop");
        $this->items["fors"] = new menu_item("Люди", "/people");
        $this->items["help"] = new menu_item("Помощь", "/help");
        $this->right = new menu_item("Кабинет", "/user");
    }

}