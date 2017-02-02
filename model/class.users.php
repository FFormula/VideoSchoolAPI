<?php
/**
 * @author Jevgenij Volosatov
 */
class users extends table
{
    public function users ()
    {
        $this->clear();
    }

    public function clear()
    {
        $this->row = array
        (
            "user_id" => "",
            "name" => "",
            "email" => "",
            "password_hash" => "",
            "master_id" => "",
            "status" => ""
        );
    }

    public function login ($email, $password)
    {
        $auth = db::getDB()->select_row (
            "SELECT user_id, name, password_hash
               FROM users
              WHERE email = '$email'");
        if (!$auth ["user_id"])
            return false; //"email not found";
        if ($auth ["password_hash"] != $this->encrypt_password($auth["name"], $password))
            return false; //"invalid password";
        return $auth["user_id"];
    }

    public function find_id_by_name ($name)
    {
        $user_id = db::getDB()->scalar (
            "SELECT user_id
               FROM users 
              WHERE name = '" . $name . "'");
        return $user_id;
    }

    public function find_id_by_email ($email)
    {
        $user_id = db::getDB()->scalar (
            "SELECT user_id
               FROM users 
              WHERE email = '" . $email . "'");
        return $user_id;
    }

    public function select ($user_id)
    {
        $this->row = db::getDB()->select_row (
            "SELECT user_id, name, email, master_id, status
               FROM users 
              WHERE user_id = '" . $user_id . "'");
    }

    public function insert ()
    {
        $this->row["status"] = "wait";
        $this->row["password_hash"] =
            $this->encrypt_password($this->row["name"], $this->row["password"]);
        db::getDB()->query(
        "INSERT INTO users
                 SET name = '" . $this->row["name"] .
                "', email = '" . $this->row["email"] .
        "', password_hash = '" . $this->row["password_hash"] .
            "', master_id = '" . $this->row["master_id"] .
               "', status = '" . $this->row["status"] . "'");
        return db::getDB()->insert_id();
    }

    protected function encrypt_password ($name, $passw)
    {
        return sha1 ($name . "/" . $passw);
    }
}
