<?php

/* class: PhP Model class
 * 
 * Works with: 
 * classes/pages/page.riderlist.php (page class)
 * 
 * functions for the riderlist page.
 */

class FonRiderlistpageFunctions
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
        $riderlist = array();
        for ($i = 1; $i < 26; $i++)
        {
            if(isset($_POST['rider'.$i.'']))
            {
                $rider = $this->helper->specChars($_POST['rider'.$i.'']);

                $riderlist[$i] = $rider;    
            }
            else
            {
                return false;
            }
        }
        
        if ($this->helper->hasDuplicates($riderlist))
        {
            // if riderlist has duplicates
            return false;
        }
        else
        {
            $compid = $this->helper->specChars($_POST["userselectcompetition"]);
            // if riderlist does not have duplicates
            $userid = $_SESSION["userid"];
            $this->db->saveRiderSelection($userid, $riderlist, $compid);
            $this->db->saveCompetionEntry($compid, $userid);
            return true;
        }
    }
}