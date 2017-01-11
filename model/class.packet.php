<?php
/**
 * @author Jevgenij Volosatov
 */
class packet extends subject
{
    public function select ($packet_id)
    {
        $this->row = $this->db->select_row (
            "SELECT packet_id, name, info, html, price
               FROM packets
              WHERE packet_id = '" . $packet_id . "'");
    }

    public function insert ()
    {
        $this->db->query(
           "INSERT INTO packets
               SET packet_id = '" . $this->row["packet_id"] . "',
                   name = '". $this->row["name"] . "',
                   info = '". $this->row["info"] . "', 
                   html = '". $this->row["html"] . "', 
                   price = '". $this->row["price"] . "'");
    }

    public function update ($packet_id)
    {
        $this->db->query(
           "UPDATE packets
               SET name = '". $this->row["name"] . "',
                   info = '". $this->row["html"] . "', 
                   html = '". $this->row["html"] . "', 
                   price = '". $this->row["price"] . "'
             WHERE packet_id = '" . $packet_id . "'");
    }


}