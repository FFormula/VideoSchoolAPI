<?php

class singleton
{
    protected static $instance = null;

    protected function __construct() {}
    protected function __clone() {}

    public static function getInstance()
    {
        if (!isset(static::$instance))
            static::$instance = new static;
        return static::$instance;
    }
}