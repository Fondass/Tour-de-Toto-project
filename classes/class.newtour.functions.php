<?php

/* class: PhP Model class
 * 
 * Works with: 
 * classes/pages/page.newtour.php (page class)
 * 
 * functions for the newtour page
 */

class FonNewtour
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
    
    public function saveForm()
    {
        $compname = $this->helper->specChars($_POST['compname']);
        $roundnum = $this->helper->specChars($_POST['compnumber']);
        
        for($i = 1; $i < $roundnum+1; $i++)
        {
            $rounddate[$i] = $this->helper->specChars($_POST['compround'.$i.'date']);
        }

        $this->db->saveNewCompetition($compname, $roundnum, $rounddate);
    }
}