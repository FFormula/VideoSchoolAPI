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
            "passw" => "",
            "master_id" => "",
            "status" => ""
        );
    }

    public function login ($email, $passw_raw)
    {
        $auth = db::getDB()->select_row (
            "SELECT user_id, name, email, passw, master_id, status
               FROM users
              WHERE email = '$email'");
        if (!$auth ["user_id"])
            return "email not found";
        if ($auth ["passw"] != $this->encrypt_password($auth["name"], $passw_raw))
            return "invalid password";
        if ($auth ["status"] != "open")
            return "user stopped";
        $this->row = $auth;
        return "ok";
    }

    public function select_by_name ($name)
    {
        $this->row = db::getDB()->select_row (
            "SELECT user_id, name, email, passw, master_id, status
               FROM users 
              WHERE name = '" . $name . "'");
    }

    public function select_by_id ($user_id)
    {
        $this->row = db::getDB()->select_row (
            "SELECT user_id, name, email, master_id, status
               FROM users 
              WHERE user_id = '" . $user_id . "'");
    }

    public function insert ()
    {
        $this->row["passw"] = $this->encrypt_password($this->row["name"], $this->row["passw_raw"]);
        db::getDB()->query(
        "INSERT INTO users
                 SET name = '" . $this->row["name"] .
                "', email = '" . $this->row["email"] .
                "', passw = '" . $this->row["passw"] .
            "', master_id = '" . $this->row["master_id"] .
               "', status = '" . $this->row["status"] . "'");
        return db::getDB()->insert_id();
    }

    protected function encrypt_password ($name, $passw)
    {
        return sha1 ($name . "/" . $passw);
    }
}
