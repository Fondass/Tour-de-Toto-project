<?php

/* class: PhP Model class
 * 
 * Works with: 
 * classes/pages/page.newriders.php (page class)
 * 
 * functions for newriders page.
 */

class FonNewriders
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
    
    public function submitNewRider()
    {
        $rider = $this->helper->specChars($_POST["newriderinput"]);
        $team = $this->helper->specChars($_POST["teaminput"]);
        
        $this->db->saveRiderIntoDb($rider, $team);
    }
    
    public function submitNewTeam()
    {
        $team = $this->helper->specChars($_POST["newteaminput"]);
        $country = $this->helper->specChars($_POST["countryinput"]);

        $this->db->saveTeamIntoDb($team, $country);
    }
   
    public function submitNewCountry()
    {   
        $country = $this->helper->specChars($_POST["newcountryinput"]);
        
        $this->db->saveCountryIntoDb($country);
    }
}                     