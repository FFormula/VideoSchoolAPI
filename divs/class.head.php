<?php

namespace divs;

class head
{
    public $title;
    public $description;
    public $keywords;
    public $image;

    function divs_head ($title)
    {
        $this->title = $title;
        $this->description = "my description";
        $this->keywords = "my,keywords";
        $this->image = "https://www.videosharp.info/data/img/pics/robot.png";
    }
}