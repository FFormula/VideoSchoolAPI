<?php

namespace divs;

class menu_item
{
    public $text;
    public $url;
    public $is_active;
    public $icon;

    function __construct($text, $url)
    {
        $this->text = $text;
        $this->url = $url;
        $this->is_active = false;
        $this->icon = "";
    }
}
