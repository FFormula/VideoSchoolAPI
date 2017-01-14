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

    public function index_post ($get, $post)
    {
        return $post;
    }

    public function open($get)
    {
        $packet = new packet ();
        $packet->select($get[2]);
        return $packet->get_row();
    }

    public function edit($get)
    {
        $packet_id = $get[2];
        $packet = new packet ();
        $packet->select($packet_id);
        return $packet->get_row();
    }

    public function edit_post ($get, $post)
    {
        $packet = new packet ();
        $packet_id = $get[2];
        $packet->select($packet_id);
        $post["packet_id"] = $packet_id;
        foreach ($packet->get_row() as $field => $value)
            $packet->set_row_field($field, $post[$field]);
        $packet->update($packet_id);
        $info ["redirect"] = "/shop/open/" . $packet_id;
        return $info;
    }
}