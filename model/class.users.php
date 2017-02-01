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
            "user" => "",
            "email" => "",
            "passw" => "",
            "master_id" => "",
            "status" => ""
        );
    }

    public function login ($email, $passw_raw)
    {
        $auth = db::getDB()->select_row (
            "SELECT user_id, user, passw
               FROM users
              WHERE email = '$email'");
        if (!$auth ["user_id"])
            return false;
        if ($auth ["passw"] == $this->encrypt_password($auth["user"], $passw_raw))
            return $auth ["user_id"];
        return false;
    }

    public function select_by_user ($user)
    {
        $this->row = db::getDB()->select_row (
            "SELECT user_id, user, email, passw, master_id, status
               FROM users 
              WHERE user = '" . $user . "'");
    }

    public function select_by_id ($user_id)
    {
        $this->row = db::getDB()->select_row (
            "SELECT user_id, user, email, master_id, status
               FROM users 
              WHERE user_id = '" . $user_id . "'");
    }

    public function insert ()
    {
        $this->row["passw"] = $this->encrypt_password($this->row["user"], $this->row["passw_raw"]);
        db::getDB()->query(
        "INSERT INTO users
                 SET user = '" . $this->row["user"] .
                "', email = '" . $this->row["email"] .
                "', passw = '" . $this->row["passw"] .
            "', master_id = '" . $this->row["master_id"] .
               "', status = '" . $this->row["status"] . "'");
        return db::getDB()->insert_id();
    }

    protected function encrypt_password ($user, $passw)
    {
        return sha1 ($user . "/" . $passw);
    }
}
