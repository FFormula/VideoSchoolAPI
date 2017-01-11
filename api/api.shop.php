<?php

class shop
{
    /** Return current version of API */
    public function version()
    {
        return "3.14";
    }

    /** Return list of all methods */
    public function index()
    {
        //$packet = new packet ();
        $data = array ("list");
        return $data;
    }
}