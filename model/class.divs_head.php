<?php

class divs_head
{
    var $rows;

    function divs_head ($title)
    {
        $this->rows = array ();
        $this->rows["title"] = $title;
        $this->rows["description"] = "my description";
        $this->rows["keywords"] = "my,keywords";
        $this->rows["image"] = "https://www.videosharp.info/data/img/pics/robot.png";
    }

    function get ()
    {
        return $this->rows;
    }
}