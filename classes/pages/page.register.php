<?php

/* class: PhP Page (view) class
 * 
 * Works with: 
 * classes/pages/page.home.php          (parent link)
 * classes/class.page_controller.php    (controller)
 * classes/class.register.functions.php (model)
 * 
 * classes/class.captcha.php            (captcha class)
 * 
 * page that shows a register form
 */

class Register extends FonPage
{
    
    protected $db;
    protected $user;
    protected $helper;
    protected $functions;
    
    public function __construct($user, $db, $helper, $functions)
    {
        $this->user=$user;
        $this->db=$db;
        $this->helper=$helper;
        
        $this->functions=$functions;
    }
   
//================================================
//              register controller
//================================================
/*
 * mini controller to control what html will be
 * echo out to the user.
 */  
//================================================
    
    
    public function bodyContent()
    {
        if ((isset($_POST["registerbutt"])))
        {

            $_SESSION['register'] = false;
            if(isset($_POST["captcha"]) && $_POST["captcha"]!="" && $_SESSION["code"]==$_POST["captcha"])
            {
                echo '<div id="homescreen"><div class="emptybar"></div>captcha correct!';
                $this->showRegFormFilled();
            }
            else
            {
                echo '<div id="homescreen"><div class="emptybar"></div>captcha invalid';
            }
        }
        else
        {
            //this boolean limits the a
            $_SESSION['register'] = true;
            $this->showRegisterForm();
        }
    }

//================================================
//              show register form
//================================================
/*
 * html that shows the form for registerin,
 * as well as making a new captcha object. 
 */  
//================================================  
    
    protected function showRegisterForm() 
    { 
        echo '<b>Register</b>
                <form name="register" action="" method="POST">
                <input type="hidden" name="page" value="register">
                name: 
                <input type="text" name="regusername" value="" required />
                <br>
                Wachtwoord: 
                <input type="password" name="regpw" value=""  required />
                <br>
                E-Mail:
                <input type="text" name="regemail" value="" required />
                <br><br>
                CaptCha:
                <input name="captcha" type="text">';
        
        new Captcha;
        
        echo '<img src="captcha.png"/><br>';
        
        echo '<input type="submit" name="registerbutt" value="Register Now" />
            <br></form>'; 
    }
    

//================================================
//              show reg form filled
//================================================
/*
 * checks to see if the registration was a 
 * succes and lets it know to the user.
 */  
//================================================
    
    protected function showRegFormFilled() 
    { 
        $success = $this->functions->saveUserData();
        if ($success == true)
        {
            echo ' thank you so much for registering!
                    <a href=?page=home><input type="button" value="home"></div>';
        }
        else
        {
            echo ' but registration failed!
                <a href=?page=home><input type="button" value="home"></div>';
        }
    }
}