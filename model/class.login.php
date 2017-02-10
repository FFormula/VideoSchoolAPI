<?php

namespace model;

class login
{
    private $error_message = "";

    public function get_error ()
    {
        return $this->error_message;
    }

    public function join ($name, $email, $password)
    {
        $user = new \table\user();

        if (!$this->check_name($name)) return false;
        if (!$this->check_email($email)) return false;
        if (!$this->check_password($password)) return false;

        if ($user->select_by_name($name))
            return $this->set_error ("user name taken");
        if ($user->select_by_email($email))
            return $this->set_error ("email registered");

        $user->name = $name;
        $user->email = $email;
        $user->status = "wait";
        $user->passhash = $this->hash_password($name, $password);
        $user->insert();
        return true;
    }

    public function login ($email, $password)
    {
        $user = new \table\user();
        if (!$this->check_email($email)) return false;
        if (!$user->select_by_email($email))
            return $this->set_error("email not found");
        if ($user->status == "stop")
            return $this->set_error("user account has been blocked");
        if ($user->status == "wait")
            return $this->set_error("please confirm your e-mail");
        if ($user->status != "open")
            return $this->set_error("user status unknown");
        if ($user->passhash != $this->hash_password($user->name, $password))
            return $this->set_error("invalid password");

        $_SESSION ["user"] = $user->pack();
        return true;
    }

    public function update_name ($name, $password)
    {
        if (!is_logged()) return false;

        $user = new \table\user($_SESSION["user"]["id"]);
        if (!$user->id)
            return $this->set_error("user not found");
        if ($user->passhash != $this->hash_password($user->name, $password))
            return $this->set_error("invalid password");
        $user->passhash = $this->hash_password($name, $password);
        $user->update();
        return true;
    }

    public function update_email ($id, $email, $password)
    {
        $user = new \table\user($id);
        if (!$user->id)
            return $this->set_error("user not found");
        if ($user->passhash != $this->hash_password($user->name, $password))
            return $this->set_error("invalid password");
        $user->email = $email;
        $user->update();
        return true;
    }

    public function update_password ($id, $new_password, $old_password)
    {
        $user = new \table\user($id);
        if (!$user->id)
            return $this->set_error("user not found");
        if ($user->passhash != $this->hash_password($user->name, $old_password))
            return $this->set_error("invalid password");
        $user->passhash = $this->hash_password($this->name, $new_password);
        $user->update();
        return true;
    }

    protected function check_name ($name)
    {
        if (!\system\text::is_alpha($name))
            return $this->set_error("name incorrect, use letters/digits/./_, start with letter");
        if (strlen($name) < USER_NAME_MIN_LENGTH)
            return $this->set_error("name is too short");
        if (strlen($name) > USER_NAME_MAX_LENGTH)
            return $this->set_error("name is too long");
        return true;
    }

    protected function check_email ($email)
    {
        if (!\system\text::is_email($email))
            return $this->set_error("email incorrect");
        return true;
    }

    protected function check_password ($password)
    {
        if (strlen($password) < USER_PASSWORD_MIN_LENGTH)
            return $this->set_error("[password] is too short");
        if (strlen($password) > USER_PASSWORD_MAX_LENGTH)
            return $this->set_error("[password] is too long");
        return true;
    }

    protected function is_logged ()
    {
        if (!isset ($_SESSION ["user"] ["id"]))
            return $this->set_error("Please relogin");
        return true;
    }

    protected function hash_password ($name, $passw)
    {
        return sha1 ($name . "/" . $passw);
    }

    protected function set_error ($message)
    {
        $this->error_message = $message;
        return false;
    }

}
