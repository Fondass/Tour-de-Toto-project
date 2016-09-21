<?php

/* class: PhP to Ajax script
 * 
 * Works with: 
 * classes/class.controller.ajax.php (controller)
 * 
 * javascript/ajax.riderlist.js
 * 
 * class intended to play through ajax code to show 
 * selected athelete information. 
 */



class FonAjaxAthleteSelection
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
    
    public function athleteInformation($athlete)
    {
        $info = $this->db->getAthleteInformation($athlete);
        echo json_encode($info);
    }
    
}