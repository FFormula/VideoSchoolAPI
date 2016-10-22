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
        if ($this -> notset ("email")) return;
        if ($this -> notset ("name")) return;

        $this -> error ("Not done yet");
    }
    
    /** Checking access by key
    * @param key = md5(email . "/" . password)
    * @return ok or an error message
    */
    public function api_login ()
    {
        if ($this -> notset ("key")) return;
        $this -> error ("Not done yet");
    }

}