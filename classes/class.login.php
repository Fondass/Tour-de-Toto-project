<?php

/*
/* class: PhP Model class
 * 
 * Works with: 
 * classes/pages/page.login.php (page class)
 * 
 * login functions
 */

class FonLogin
{
    protected $db;
    protected $helper;
    
    public function __construct($db, $helper)
    {
        $this->db = $db;
        $this->helper = $helper;
    }

//================================================
//             check User Credentials
//================================================
/*
 * check's if the entered login credentials are correct.
 * It returns true when a user has succsesfully logged in, and false when a 
 * user entered the wrong username / password.
 */    
//================================================
    
    public function checkCredentials()
    {
        $username = $this->helper->specChars($_POST["usernamefield"]);
        
        $userid = $this->db->getActiveUserID($username);
        
        if (isset ($_POST["passwordfield"]))
        {
            $password = $this->helper->specChars($_POST["passwordfield"]);
            $password .= $this->db->getSalt($userid);

            $password = hash("sha256", $password);
        }
        
        else
        {
            $password = "";
        }
        
        $data = $this->db->getPasswordPermissionOnUserid($userid);
        
        $pass = $data[0];
        $permission = $data[1];
        
        if ($this->helper->specChars($password) === $pass)
        {
            $_SESSION["userid"] = $userid;
            $_SESSION["permission"] = $permission;
            return true;
        }
        else
        {
            return false;
        }
    }

//================================================
//                  check Logged
//================================================
/*
 * loggedUser is a small function that one might call 
 * upppon whenever one sees fit to check if the user 
 * is really logged in. 
 * 
 * This is the function to use to close of certain parts of the website:
 * (returns true if the user is correctly logged in, and false if not)
 */   
//================================================

    public function checkLogged()
    {
        return (isset($_SESSION["userid"]) != "");
    }
    
//================================================
//                  check Permission
//================================================
/*
 * 
 */   
//================================================
    
    public function checkPermission()
    {
        if (isset($_SESSION["permission"]) != "")
        {
            return $_SESSION["permission"];
        }
        else
        {
            return 0;
        }
    }
    
//================================================
//                  user logout
//================================================
/*
 * function to call uppon to log the user out. (alternatively, one can simply 
 * enter session_destroy() whenever.
 */
//================================================
    
    public function logout()
    {
        session_destroy();
        header("location: ?page=home");
    }
}