<?php

/* class: PhP Page (view) class
 * 
 * Works with: 
 * classes/class.page_controller.php (controller)
 * 
 * classes/pages/page.users.php (link)
 * classes/pages/page.admin.php (link)
 * classes/pages/page.login.php (link)
 * classes/pages/page.register.php (link)
 * 
 * Gateway page for site
 */

class FonHomePage extends FonPage
{
    
    protected $user;
    protected $db;
    protected $helper;
    
    protected function endHeader()
    {
        echo '<script type="text/javascript" src="javascript/window.home.js"></script></head>';
    }
    
    public function bodyContent() 
    {
        $permission = 0;
        $permission = $this->helper->specChars(isset($_SESSION["permission"]));
        
        echo '<div id="homescreen"><div class="emptybar"></div><ul id="homelist">';
        
        if ($this->user->checkLogged())
        {
            echo '<li><a href="?page=users"><div>Users</div></a></li>';
        }
        
        if ($permission == 2)
        {
            echo '<li><a href=?page=admin><div>Admin</div></a></li>';
        }
            
        if ($this->user->checkLogged())
        {
            echo '<li><a href=?page=logout><div>Logout</div></a></li></ul></div>';
        }
        else
        {
            echo '<li><a><div id="loginonmenu">Login</div></a></li>';
            echo '<li><a><div id="registermenu">Register</div></a></li></ul></div>';
        }  
        
        echo '<div id="loginscreen">
            <form method="POST">
            <input type="hidden" name="page" value="login">
            <br>
            <input id="usernameinput" type="text" name="usernamefield" placeholder="Username" required>
            <br>
            <input id="passwordinput" type="password" name="passwordfield" placeholder="Password" required>
            <br><input type="submit" name="loginsubmit" value="Login">

            </form></div>';
        
        echo '<div id="registerscreen">';
        
        echo '<b>Register</b>
                <form name="register" action="" method="POST">
                <input type="hidden" name="page" value="register">
                Name:
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
            <br></form></div>';
    }
}