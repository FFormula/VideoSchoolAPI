<?php

namespace system;

class resultable
{
    protected $error = "";
    protected $array = array();

    public function get_error ()
    {
        return $this->error;
    }

    public function get_array ()
    {
        return $this->array;
    }

    protected function set_error ($text)
    {
        $this->error = $text;
        return false;
    }

    protected function set_array ($array)
    {
        $this->array = $array;
        return true;
    }

}