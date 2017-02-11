<?php

namespace api;

class api
{
    protected $error = "";

    protected function set_error ($message)
    {
        $this->error = $message;
        return false;
    }
    
    public function get_error ()
    {
        return $this->error;
    }

}