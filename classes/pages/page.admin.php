<?php

/* class: PhP Page (view) class
 * 
 * Works with: 
 * classes/pages/page.home.php (parent link)
 * classes/class.page_controller.php (controller)
 * 
 * classes/ajax/class.ajax.admin.php (ajax)
 * javascript/ajax.admin.js (ajax)
 * 
 * classes/pages/page.newtour.php (link)
 * classes/pages/page.newriders.php (link)
 * 
 * classes/pages/page.etape.php (ajax-enabled)(link)
 * 
 * Gateway page for admin functionality within the site.
 */

class FonAdminPage extends FonPage
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
    
    protected function endHeader() 
    {
        echo '<script type="text/javascript" src="javascript/ajax.admin.js"></script>
            <script type="text/javascript" src="javascript/window.admin.js"></script></head>';
    }

    protected function bodyContent() 
    {
        echo '<div id="adminscreen"><div class="emptybar"></div><ul id="adminlist">
              <li><div id="newmenu">New tour/riders</div></li>';
        
        echo '<li><div id="etapeconclusion">Etape</div></li>';
        
        echo '<li><a href="?page=home"><div class="backbutton">Back</div></a></li></ul></div>';
        
        echo '<div id="etapescreen"><div class="emptybar"></div>';
        
        echo '<form method="post"><div></div>
              select competition: <select id="selectcompetition" name="competitionselected" required>
              <option value="" disabled selected>Select competition</option>';
              
        $competitions = $this->db->getRunningCompetitions();
        
        foreach($competitions as $value)
        {
            echo '<option value="'.$value[1].'">'.$value[0].'</option>';
        }
        
        echo '</select><p id="etapeselection"></p>';
        
        echo '<input type="hidden" name="page" value="etape">
            <input type="submit" name="etapeselected" value="Continue">
              </form></div>';
        
        echo '<div id="newscreen"><div class="emptybar"></div>';
        
        echo '<ul id="adminnewlist"><li><a href="?page=newtour"><div>new tour</div></a></li>
              <li><a href="?page=newriders"><div>new riders</div></a></li></ul></div>';
    }
}


