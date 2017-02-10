<?php

namespace api;

class api
{
    protected $error_message = "";

    protected function set_error ($message)
    {
        $this->error_message = $message;
        return false;
    }
    
    public function get_error ()
    {
        return $this->error_message;
    }

}