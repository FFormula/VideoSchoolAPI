<?php

/**
* Model.Help
* General info about this API
* @author Jevgenij Volosatov
*/
class user extends Module
{
    /** Register new user account 
    * @param email - valid email
    * @param name - user name
    * password will be sent to the specified email address
    */
    public function api_join ()
    {
        if (!$this -> data -> is_param ("email")) return;
        if (!$this -> data -> is_param ("name")) return;

        $this -> answer = "User successfully not registered";
    }
    
    /** Checking access by key
    * @param email
    * @param passw
    */
    public function api_login ()
    {
        if (!$this -> data -> is_param ("email")) return;
        if (!$this -> data -> is_param ("passw")) return;
        $nr = "1";
        $key = $nr . "." . md5 (
                        $this -> db -> scalar ("SELECT DATE(NOW())") . "/" .
                        $this -> shared -> data -> get ("email") . "/" .
                        $this -> shared -> data -> get ("passw"));
        $this -> answer = array (
            "key" => $key
        );
    }

}