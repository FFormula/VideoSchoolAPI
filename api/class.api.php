<?php

namespace api;

class api
{
    protected $error = "";
    protected $array = "";

    protected function set_error ($message)
    {
        $this->error = $message;
        return false;
    }

    protected function set_array ($array)
    {
        $this->array = $array;
        return true;
    }

    public function get_error ()
    {
        return $this->error;
    }

    public function get_array ()
    {
        return $this->array;
    }

}