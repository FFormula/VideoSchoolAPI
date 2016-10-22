<?php

/**
* Model.Help
* General info about this API
* @author Jevgenij Volosatov
*/
class user extends model
{
    /** Register new user account 
    * @param email - valid email
    * @param name - user name
    * password will be sent to the specified email address
    * @return ok or error message
    */
    public function api_join ()
    {
        if ($this -> is_empty ("email")) return;
        if ($this -> is_empty ("name")) return;

        $this -> set_error ("Not done yet");
    }
    
    /** Checking access by key
    * @param key = md5(email . "/" . password)
    * @return ok or an error message
    */
    public function api_login ()
    {
        if ($this -> is_empty ("key")) return;

        $this -> set_error ("Not done yet");
    }

}