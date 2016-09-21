<?php

/* class: PhP Page (view) class
 * 
 * Works with: 
 * classes/pages/page.admin.php (parent link)
 * classes/class.page_controller.php (controller)
 * 
 * classes/class.newriders.functions.php (model class)
 * 
 * page for admin where forms are shown to enter new 
 * riders, teams and countries.
 */

class FonNewridersPage extends FonPage
{
    
    protected $user;
    protected $db;
    protected $helper;
    protected $function;
    
    public function __construct($user, $db, $helper, $functions)
    {
        $this->user = $user;
        $this->db = $db;
        $this->helper = $helper;
        $this->function = $functions;
    }
    
    protected function endHeader()
    {
        echo '<script type="text/javascript" src="javascript/window.newriders.js"></script></head>';
    }
    
    protected function bodyContent()
    {
        if(isset ($_POST["newridersubmit"]))
        {
            $this->function->submitNewRider();
        }
        elseif(isset ($_POST["newteamsubmit"]))
        {
            $this->function->submitNewTeam();
        }
        elseif(isset ($_POST["newcountrysubmit"]))
        {
            $this->function->submitNewCountry();
        }
        $this->showContent();
    }
    
//================================================
//              newriders showContent
//================================================
/*
 * 
 */
//================================================   
    
    protected function showContent()
    {
        $countries = $this->db->getCountriesFromDatabase();
        $teams = $this->db->getTeamsFromDatabase();
        
        echo '<div id="newridersscreen"><div class="emptybar"></div><ul id="newriderslist">';
        
        echo '<li><div id="riders">Riders</div></li>';
        
        echo '<li><div id="teams">Teams</div></li>';
        
        echo '<li><div id="countries">Countries</div></li>';
        
        echo '<li><a href="?page=admin"><div class="backbutton">Back</div></a></li></ul></div>';
        
        echo '<div id="riderscreen"><div class="emptybar"></div><form method="POST">
            <input type="Text" name="newriderinput" placeholder="rider">
            <select name="teaminput">';
            
        foreach($teams as $value)
        {
            echo '<option value="'.$value[0].'">'.$value[1].'</option>';
        }

        echo '</select>
            <input type="hidden" name="page" value="newriders">
            <input type="submit" value="submit" name="newridersubmit"></form></div>';
        
        
        
        echo '<div id="teamscreen"><div class="emptybar"></div><form method="POST">
            <input type="Text" name="newteaminput" placeholder="team">
            <select name="countryinput">';
            
        foreach($countries as $value)
        {
            echo '<option value="'.$value[0].'">'.$value[1].'</option>';
        }

        echo '</select><input type="hidden" name="page" value="newriders">
            <input type="submit" value="submit" name="newteamsubmit"></form></div>';

        echo '<div id="countryscreen"><div class="emptybar"></div><form method="POST">
            <input type="Text" name="newcountryinput" placeholder="country">
            <input type="hidden" name="page" value="newriders">
            <input type="submit" value="submit" name="newcountrysubmit"></form></div>';
    }
}