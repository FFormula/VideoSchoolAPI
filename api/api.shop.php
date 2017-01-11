<?php

class shop
{
    /** Return current version of API */
    public function version()
    {
        return "3.14";
    }

    public function index($get)
    {
        return $get;
    }

    public function open($get)
    {
        $packet = new packet ();
        $packet->select($get[2]);
        return $packet->get_row();
    }

    public function insert($get)
    {
        $packet = new packet ();
        $packet->set_row_field("packet_id", "bilife");
        $packet->set_row_field("name", "Бинарная жизнь");
        $packet->set_row_field("info", "Описание");
        $packet->set_row_field("html", "<html>");
        $packet->set_row_field("price", "100");
        $packet->insert();
        $data = "added";
        return $data;
    }
}