<?php

namespace div;

use table;

class user
{
    protected $divs;
    
    

    function show_one_user_by_name($args)
    {
        $this->divs = array ();

        $user = new table\user ();
        $user->select_by_name ($args ["name"]);
        $head = new \div\head ("User " . $user->name . " card");
        
        $this->divs [] = $head->pack();
        $this->divs [] = array ("div_user" => $user->pack());
        
        return $this->divs;
    }

}