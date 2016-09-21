<?php
/* class: PhP to Ajax script
 * 
 * Works with: 
 * classes/class.controller.ajax.php (controller)
 * 
 * javascript/ajax.users.top.js
 * 
 * returns the data for different score selections.
 * returning data for:
 * 
 * the Rider top 10 (per competition)
 * the Team top 5 (per competition)
 * the country top 3 (per competition)
 */


class FonAjaxUsersTop
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
    
    public function showRidertop10($competition)
    {
        $returndata = '<p id="top10replaceme">';
        
        $top10 = $this->db->getRidersTop10($competition);
        
        foreach($top10 as $value)
        {
            $returndata .= '<br>'.$value[0].' points: '.$value[1].'<br>';
        }
        
        $returndata .= '</p>';
        
        echo json_encode($returndata);
    }
    
    public function showTeamtop5($competition)
    {
        $returndata = '<p id="top5replaceme">';
        
        $top5 = $this->db->getTeamsTop5($competition);
        
        foreach($top5 as $value)
        {
            $returndata .= '<br>'.$value[0].' points: '.$value[1].'<br>';
        }
        
        $returndata .= '</p>';

        echo json_encode($returndata);
    }
    
    public function showCountrytop3($competition)
    {
        $returndata = '<p id="top3replaceme">';
        
        $top3 = $this->db->getCountriesTop3($competition);
        
        foreach($top3 as $value)
        {
            $returndata .= '<br>'.$value[0].' points: '.$value[1].'<br>';
        }
        
        $returndata .= '</p>';
        
        echo json_encode($returndata);
    }
}