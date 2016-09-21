<?php

/* class: PhP Page (view) class
 * 
 * Works with: 
 * classes/pages/page.users.php (parent link)
 * classes/class.page_controller.php (controller)
 * 
 * classes/class.users.scores.functions.php (model class)
 * 
 * javascript/ajax.users.playerscores.js (ajax)
 * classes/ajax/class.ajax.playerscores.php (ajax)
 * 
 * page that shows all palyer scores by competition selection
 */

class FonUsersScoresPage extends FonPage
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
        echo '<script type="text/javascript" src="javascript/ajax.users.playerscores.js"></script></head>';
    }
    
    protected function bodyContent()
    {
        echo '<div id="scorescreen"><div class="emptybar"></div>';
        
        echo '<select id="scorecompsel">
            <option value="" disabled selected>select competition</option>';
        
        $competitions = $this->db->getActiveCompetitions();
        
        foreach($competitions as $value)
        {
            echo '<option value="'.$value[1].'">'.$value[0].'</option>';
        }
        
        echo '</select>';
        
        echo '<div id="backbuttonscores"><a href="?page=users">Back</a></div></div>';
        
        echo '<div id="scoreslidescreen"><div class="emptybar"></div>';
        
        echo '<p id="scoresreplaceme"></p><br><br><br></div>';
    }  
}