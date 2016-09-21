<?php

/* class: PhP Page (view) class
 * 
 * Works with: 
 * classes/pages.page.users.php (parent link)
 * classes/class.page_controller.php (controller)
 * 
 * classes/class.users.scores.functions.php (model class)
 * 
 * javascript/ajax.users.ownscores.js (ajax)
 * javascript/ajax.admin.etapeselection.js (ajax)
 * 
 * classes/ajax/class.ajax.ownscores.php (ajax)
 * classes/ajax/class.ajax.admin.php (ajax)
 * 
 * page that shows the player his own score per competition
 */

class FonUsersOwnscorePage extends FonPage
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
        echo '<script type="text/javascript" src="javascript/ajax.users.ownscores.js"></script>';
    }
    
    protected function bodyContent()
    {
        echo '<div id="scorescreen"><div class="emptybar"></div>';
        
        echo '<select id="selectcompetition">
            <option value="" disabled selected>select competition</option>';
        
        $competitions = $this->db->getParticipatedCompetitions($_SESSION["userid"]);
        
        foreach($competitions as $value)
        {
            echo '<option value="'.$value[1].'">'.$value[0].'</option>';
        }
        
        echo '</select><br>';
        
        echo '<div id="backbuttonscores"><a href="?page=users">Back</a></div></div>';
        
        echo '<div id="scoreslidescreen"><div class="emptybar"></div><br>';
        
        echo '<p id="ownscoresreplaceme"></p><br><br><br></div>';
    }
}