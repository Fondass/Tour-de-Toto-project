<?php

/* class: PhP Model class
 * 
 * Works with: 
 * classes/pages/page.riders.php (page class)
 * classes/pages/page.teams.pgp (page class)
 * classes/pages/page.countries.php (page class)
 * 
 * functions that show the top 10/ top 5, top 3 respectively
 */

class FonUsersTopFunctions
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
    
    public function competitionSelect($number)
    {
        echo '<div id="topscreen"><div class="emptybar"></div>';
        
        echo '<select id="top'.$number.'compsel">
                <option value="" disabled selected>select competition</option>';
        
        $competitions = $this->db->getActiveCompetitions();
        
        foreach($competitions as $value)
        {
            echo '<option value="'.$value[1].'">'.$value[0].'</option>';
        }
        
        echo '</select>';
        
        echo '<div id="backbuttonscores"><a href="?page=users">Back</a></div></div>';
        
        echo '<div id="topreplacescreen"><div class="emptybar"></div><br>';
        
        echo '<p id="top'.$number.'replaceme"></p><br><br></div>';
    }
}