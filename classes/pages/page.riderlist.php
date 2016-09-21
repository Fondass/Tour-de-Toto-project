<?php

/* class: PhP Page (view) class
 * 
 * Works with: 
 * classes/pages/page.users.php (parent link)
 * classes/class.page_controller.php (controller)
 * 
 * classes/class.riderlist.php (model class)
 * 
 * javascript/ajax.riderlist.js (ajax)
 * classes/ajax.class.ajax.riderlist.php (ajax)
 * 
 * page that shows a form to users to enter their 25 athletes.
 */

class FonRiderlistPage Extends FonPage
{
    
    protected $user;
    protected $db;
    protected $helper;
    protected $functions;
    
    public function __construct($user, $db, $helper, $functions)
    {
        $this->user = $user;
        $this->db = $db;
        $this->helper = $helper;
        $this->functions = $functions;
    }
    
    protected function endHeader()
    {
        echo '<script type="text/javascript" src="javascript/ajax.riderlist.js"></script>
            </head>'; 
    }
    
    protected function bodyContent()
    {
        if (isset($_POST["submitriderchoice"])) 
        {
            if ($this->functions->saveForm() === true)
            {
                echo '<div id="homescreen"><div class="emptybar"></div>Your form has been submited, thank you for playing
                    <a href=?page=users><input type="button" value="continue"></a></div>';
                
            }
            else
            {
                $this->showForm();
                echo '<script type="text/javascript" src="javascript/popup.js"></script>';
            }
        }
        else
        {
            $this->showForm();
        }
    }
    
//================================================
//                   show Form
//================================================
/*
 * shows the form that allows users to select
 * a team of athletes for their winner bet list.
 */   
//================================================   
    
    protected function showForm()
    {
        $compid = $this->helper->specChars($_POST["userselectcompetition"]);
        $riders = $this->db->getRidersAndId();
        
        echo '<div id="riderlistscreen"><div class="emptybar"></div>';
        
        echo '<form id="riderlistform" method="POST">';
        
        echo '<ul id="riderlistlist"><li><input id="riderlistsubmit" type="submit" name="submitriderchoice" value="Send"></li>';
        echo '<input type="hidden" name="userselectcompetition" value="'.$compid.'">
              <input type="hidden" name="page" value="riderlist"></form>';
        
        echo '<li><div id="backbuttonriderlist"><a href="?page=users">Back</a></div></li></ul></div>';
        
        echo '<div id="riderlistingscreen"><div class="emptybar"></div>';
        
        for($i = 1; $i < 26; $i++)
        {
            echo 'Select rider '.$i.' <select form="riderlistform" name="rider'.$i.'" id="rider'.$i.'">
                <option value="" disabled selected>Select rider</option>';
            
            foreach($riders as $value)
            {
                echo '<option value="'.$value[1].'" ajaxdata="'.$i.'" required>'.$value[0].'</option>';
            }
  
            echo '</select> 
                  <b>From team:</b> <p id="sel-t'.$i.'"></p><br>';
        }
        echo '</div>';
    }
}