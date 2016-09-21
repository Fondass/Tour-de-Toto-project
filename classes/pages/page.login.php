<?php

/*
 * class: PhP Page (view) class
 * 
 * Works with: 
 * classes/pages/page.home.php (parent link)
 * classes/class.page_controller.php (controller)
 * 
 * classes/class.login.php (model)
 * 
 * 
 * page that shows a login form.
 */

class FonLoginPage extends FonPage
{
    
    protected $user;
    protected $db;

    public function __construct($user, $db)
    {
        $this->user = $user;
        $this->db = $db;
    }
    
//================================================
//                    show Login
//================================================
/*
 * showLogin displays the form for logging in.
 */  
//================================================
    public function showLogin() 
    {
        echo '
            <div class="Axcellentsegment"><form method="POST">
            <input type="hidden" name="page" value="login">

            
            <input type="text" name="usernamefield" placeholder="Username" required>
            <br>
            <input type="password" name="passwordfield" placeholder="Password" required>
            <br>
            <input type="submit" name="loginsubmit" value="Login">

            </form></div>';
    }

//================================================
//                    show Login
//================================================
/*
 * bodyContent decides what to pressent to the
 * user uppon visiting the login page and 
 * displays either a login form (showlogin) or
 * now the home page.
 */
//================================================
    
    public function bodyContent()
    {
        if ($_SERVER["REQUEST_METHOD"] === "GET" && $this->user->checkLogged() === true)
        {
            // activates when a user visist the login page when already logged in
            
            echo '<div id="homescreen"><div class="emptybar"></div><p>Welcome Back pall</p>
                <a href="?page=home"><input type="button" value="continue"></a></div>';
        }
        
        elseif ($_SERVER["REQUEST_METHOD"] === "POST" && $this->user->checkCredentials() === true)
        {
            // Activates when a user logs in from logged out state.
            
            echo '<div id="homescreen"><div class="emptybar"></div><p>Welcome online sir, how my i help you today</p>
                <a href="?page=home"><input type="button" value="continue"></a></div>'; 
        }
        
        elseif ($_SERVER["REQUEST_METHOD"] === "POST" && $this->user->checkCredentials() !== true)
        {
            // activates when a user tries to log in from a logged out state but fails the
            // userCheck(), and thus, provided wrong login credentials.
            
            echo 'The princess is in another castle';
        }
        
        else
        {
            $this-> showLogin();
        }
    }
}
