<?php

namespace table;

class user extends table
{
    public $id;
    public $name;
    public $email;
    public $status;
    public $passhash;

    public function __construct($id = "")
    {
        if ($id) $this->select($id);
    }

    public function pack ()
    {
        return array (
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "status" => $this->status
        );
    }

    public function insert ()
    {
        db()->query(
            "INSERT INTO users
                SET name = '" . strtolower($this->name) .
                "', email = '" . strtolower($this->email) .
                "', status = '" . $this->status .
                "', passhash = '" . $this->passhash . "'");
        $this->id = db()->insert_id();
    }

    public function select ($id)
    {
        if (!$id) return false;
        return $this->select_from ("users", "id", $id);
    }

    public function update ()
    {
        if (!$this->id) return;
        db()->query(
            "UPDATE users
                SET name = '" . strtolower($this->name) .
                "', email = '" . strtolower($this->email) .
                "', status = '" . $this->status .
                "', passhash = '" . $this->passhash .
           "' WHERE id = '" . $this->id . "'");
    }

    public function select_by_name ($name)
    {
        return $this->select_from ("users", "name", strtolower($name));
    }

    public function select_by_email ($email)
    {
        return $this->select_from ("users", "email", strtolower($email));
    }
}
