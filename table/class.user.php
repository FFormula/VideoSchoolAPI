<?php

namespace table;

use system\resultable;

class user extends resultable
{
    public $id;
    public $name;
    public $email;
    public $park;
    public $phone;
    public $failed_logins;
    public $status;
    public $password;

    public function select_by_email ($email)
    {
        $query =
            "SELECT id, name, email, park, phone, failed_logins, status, password
               FROM users 
              WHERE email = '" . addslashes ($email) . "'";

        $row = db::getDB()->select_row ($query);
        if (!$row)
            return $this->set_error(db::getDB()->get_error());

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
                    park = '" . addslashes ($this->park) . "',
                    phone = '" . addslashes ($this->phone) . "',
                    failed_logins = '" . addslashes ($this->failed_logins) . "',
                    status = '" . addslashes ($this->status) . "',
                    password = '" . addslashes ($this->password) . "'
              WHERE id = '" . addslashes($this->id) . "'";

        if (!db::getDB()->query($query))
            return $this->set_error(db::getDB()->get_error());

        return true;
    }

}
