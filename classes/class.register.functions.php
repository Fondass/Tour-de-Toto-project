<?php

/* class: PhP Model class
 * 
 * Works with: 
 * classes/pages/page.register.php (page class)
 * 
 * functions for register page.
 */

class FonRegister
{     
    protected $user;
    protected $db;
    protected $helper;
    
    public function __construct($user, $db, $helper)
    {
        $this->user = $user;
        $this->db = $db;
        $this->helper = $helper;
    }
    
//================================================
//                  make salt
//================================================
/*
 * create's a random assortment of characters
 * to add to the users password.
 */  
//================================================
    
    protected function makeSalt()
    {
        $salt = mcrypt_create_iv(32);

        if ($salt == true)
        {
            return $salt;
        }
        else
        {
            return null;
        }
    }
    
//================================================
//              save user data
//================================================
/*
 * aplies salt to the password en sends the
 * data (username, password, and salt) to the
 * database class for further storage.
 */  
//================================================
    
    public function saveUserData()
    {
        $salt = $this->makeSalt();
                 
        if (is_string($salt))
        {
            $usern = $this->helper->specChars($_POST["regusername"]);
            $email = $this->helper->specChars($_POST["regemail"]);
            $pasw = $this->helper->specChars($_POST["regpw"]);
            $pasw .= $salt;
            $pasw = hash("sha256",$pasw);
            $result = $this->db->saveNewUser($usern, $pasw, $salt, $email);
            return $result;
        }
        else
        {
            return false;
        }
    }
}