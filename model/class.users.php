<?php
/**
 * @author Jevgenij Volosatov
 */
class users extends table
{
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
            "SELECT user_id, user, email, passw, master_id, status
               FROM users 
              WHERE user_id = '" . $user_id . "'");
    }

}
