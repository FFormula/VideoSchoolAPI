<?php

namespace table;

use system\resultable;

class user extends resultable
{
    public $id;
    public $name;
    public $email;
    public $password;
    public $phone;
    public $park;
    public $failed_logins;
    public $status;

    public function insert ()
    {
        $query =
            "INSERT INTO users
                SET name = '" . addslashes($this->name) . "', 
                    email = '" . addslashes($this->email) . "', 
                    password = '" . addslashes($this->password) . "',
                    phone = '" . addslashes($this->phone) . "',
                    park = '" . addslashes($this->park) . "',
                    failed_logins = '" . addslashes ($this->failed_logins) . "',
                    status = '" . addslashes($this->status) . "'";
        if (!db::get()->query($query))
            return $this->set_error(db::get()->get_error());

        $this->id = db::get()->insert_id();
        return true;
    }

    public function select_by_email ($email)
    {
        $query =
            "SELECT id, name, email, park, phone, failed_logins, status, password
               FROM users 
              WHERE email = '" . addslashes ($email) . "'";

        $row = db::get()->select_row ($query);
        if (!$row)
            return $this->set_error(db::get()->get_error());

        if (count($row) == 0)
            return $this->set_error ("E-mail not found");

        $this->id = $row ["id"];
        $this->name = $row ["name"];
        $this->email = $row ["email"];
        $this->park = $row ["park"];
        $this->phone = $row ["phone"];
        $this->failed_logins = $row ["failed_logins"];
        $this->status = $row ["status"];
        $this->password = $row ["password"];

        return true;
    }

    public function update ()
    {
        $query =
            "UPDATE users
                SET name = '" . addslashes ($this->name) . "', 
                    email = '" . addslashes ($this->email) . "',
                    password = '" . addslashes ($this->password) . "',
                    phone = '" . addslashes ($this->phone) . "',
                    park = '" . addslashes ($this->park) . "',
                    failed_logins = '" . addslashes ($this->failed_logins) . "',
                    status = '" . addslashes ($this->status) . "'
              WHERE id = '" . addslashes($this->id) . "'";

        if (!db::get()->query($query))
            return $this->set_error(db::get()->get_error());

        return true;
    }

}
