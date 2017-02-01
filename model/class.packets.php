<?php
/**
 * @author Jevgenij Volosatov
 */
class packet extends table
{
    public function __construct()
    {
        parent::__construct ();
        $this::clear();
    }

    public function clear()
    {
        $this->row = array
        (
            "packet_id" => "",
            "name" => "",
            "info" => "",
            "html" => "",
            "price" => 0.00
        );
    }

    public function select($packet_id)
    {
        $this->row = db::getDB()->select_row (
            "SELECT packet_id, name, info, html, price
               FROM packets
              WHERE packet_id = '" . $packet_id . "'");
    }

    public function insert()
    {
        db::getDB()->query(
           "INSERT INTO packets
               SET packet_id = '" . $this->row["packet_id"] . "'");
        $this->update($this->row["packet_id"]);
    }

    public function update($packet_id)
    {
        db::getDB()->query(
           "UPDATE packets
               SET name = '". $this->row["name"] . "',
                   info = '". $this->row["info"] . "', 
                   html = '". $this->row["html"] . "', 
                   price = '". $this->row["price"] . "'
             WHERE packet_id = '" . $packet_id . "'");
    }
}