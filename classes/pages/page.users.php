<?php

/* class: PhP Page (view) class
 * 
 * Works with: 
 * classes/pages/page.home.php (parent link)
 * classes/class.page_controller.php (controller)
 * 
 * classes/pages/page.riders.php (link)
 * classes/pages/page.teams.php (link)
 * classes/pages/page.countries.php (link)
 * classes/pages/page.playerscores.php (link)
 * classes/pages/page.ownscores.php (link)
 * classes/pages/page.riderlist.php (link)
 * 
 * gateway page for users
 */

class FonUsersPage Extends FonPage
{
    
    protected $user;
    protected $db;
    protected $helper;
    protected $competitions;
    
    public function __construct($user, $db, $helper)
    {
        $this->user = $user;
        $this->db = $db;
        $this->helper = $helper;
        
        $this->competitions = $this->db->getActiveCompetitions();
    }
    
    protected function endHeader() 
    {
        echo '<script type="text/javascript" src="javascript/compname.users.js">
            </script><script type="text/javascript" src="javascript/window.users.js"></script></head>';
    }
    
    protected function bodyContent() 
    {
        $this->showForm();
        $this->showMenu();
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
        echo '<div id="userscreen"><div class="emptybar"></div><ul id="userlist">';
        
        echo '<li><div id="joinbuton">Join</div></li>';
        
        echo '<li><div id="scoresbutton">Scores</div></li>';
        
        echo '<li><div id="summarybutton">Summary</div></li>';
        
        echo '<li><a href="?page=home"><div class="backbutton">Back</div></a></li></ul></div>';
        
        echo '<div id="joinscreen"><div class="emptybar"></div><br><br>';
        
        echo '<form method="POST">
            For which competition would you like to join?<br>
            <select name="userselectcompetition" required>
            <option value="" disabled selected>select competition</option>';
        
        foreach($this->competitions as $value)
        {
            if (($this->db->userHasEnteredRiders($_SESSION["userid"], $value[1])) != 1)
            {
                echo '<option value="'.$value[1].'">'.$value[0].'</option>';
            }
        }
        
        echo '</select><br><input type="hidden" name="page" value="riderlist">
            <input type="submit" name="submitcompetitionchoice" value="submit"></form><br><br></div>';
    }
    
    protected function showMenu()
    {
        echo '<div id="allscorescreen"><div class="emptybar"></div>';
        
        echo '<br><br><a href="?page=riders"><div>riders top 10</div</a>
              <a href="?page=teams"><div>teams top 5</div></a>
              <a href="?page=countries"><div>countries top 3</div></a>';
        
        echo '<br><br><a href="?page=playerscores"><div>player score lists</div></a>
              <a href="?page=ownscore"><div>vieuw personal score lists</div></a></div><br><br></div>';
        
        echo '<div id="summaryscreen"><div class="emptybar"></div>';
        
        echo '<br>Download latest rankings summary<br><form method="POST">
            <select name="rankingscompetitionselect" class="rankingscompetitionselect">
             <option value="" disabled selected>select competition</option>';
        
        foreach($this->competitions as $value)
        {
            echo '<option value="'.$value[1].'">'.$value[0].'</option>';
        }
        
        echo '</select><input type="hidden" class="varcompname" name="varcompname" value=""/>
            <input type="hidden" name="page" value="rankings">
            <br><input type="submit" value="download"></form>';
        
        echo '<br>Download latest rankings in excel<br><form method="POST">
            <select name="rankingscompetitionselect" class="rankingscompetitionselect">
             <option value="" disabled selected>select competition</option>';
        
        foreach($this->competitions as $value)
        {
            echo '<option value="'.$value[1].'">'.$value[0].'</option>';
        }
        
        echo '</select><input type="hidden" class="varcompname" name="varcompname" value=""/>
            <input type="hidden" name="page" value="rankingsexcel">
            <br><input type="submit" value="download"></form><br><br></div>';
    } 
}