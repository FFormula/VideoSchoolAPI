<?php

namespace model;

class login
{
    public function join ($name, $email, $password)
    {
        $user = new \table\user();
        if ($user->select_by_name($name))
            return "user name taken";
        if ($user->select_by_email($email))
            return "email registered";
        $user->name = $name;
        $user->email = $email;
        $user->status = "wait";
        $user->passhash = $this->hash_password($name, $password);
        $user->insert();
        return "ok";
    }

    public function login ($email, $password)
    {
        $user = new \table\user();
        if (!$user->select_by_email($email))
            return "unknown email";
        if ($user->passhash != $this->hash_password($user->name, $password))
            return "invalid password";
        return "ok";
    }

    protected function hash_password ($name, $passw)
    {
        return sha1 ($name . "/" . $passw);
    }

    public function update_name ($id, $name, $password)
    {
        $user = new \table\user($id);
        if (!$user->id) return false;
        if ($user->passhash != $this->hash_password($user->name, $password))
            return false;
        $user->passhash = $this->hash_password($name, $password);
        $user->update();
        return true;
    }

    public function update_email ($id, $email, $password)
    {
        $user = new \table\user($id);
        if (!$user->id) return false;
        if ($user->passhash != $this->hash_password($user->name, $password))
            return false;
        $user->email = $email;
        $user->update();
        return true;
    }

    public function update_password ($id, $new_password, $old_password)
    {
        $user = new \table\user($id);
        if (!$user->id) return false;
        if ($user->passhash != $this->hash_password($user->name, $old_password))
            return false;
        $user->passhash = $this->hash_password($this->name, $new_password);
        $user->update();
        return true;
    }

}
