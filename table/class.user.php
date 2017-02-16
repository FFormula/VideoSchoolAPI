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

    public function insert ()
    {
        db::getDB()->query(
            "INSERT INTO users
                SET name = '" . addslashes(strtolower($this->name)) .
                "', email = '" . addslashes(strtolower($this->email)) .
                "', status = '" . addslashes($this->status) .
                "', passhash = '" . addslashes($this->passhash) . "'");
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
        db::getDB()->query(
            "UPDATE users
                SET name = '" . addslashes(strtolower($this->name)) .
                "', email = '" . addslashes(strtolower($this->email)) .
                "', status = '" . addslashes($this->status) .
                "', passhash = '" . addslashes($this->passhash) .
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

    public function select_all_users ()
    {
        return db::getDB()->select (
            "SELECT id, name, status 
               FROM users 
           ORDER BY id");
    }
}
