<?php

/* class: PhP to Ajax script
 * 
 * Works with: 
 * classes/class.controller.ajax.php (controller)
 * 
 * javascript/ajax.admin.etapeselection.js
 * 
 * adds the functionality to show etape rounds (selections) after
 * a previous selection (competition selection) through ajax.
 */

class FonAjaxAdmin
{
    protected $user;
    protected $db;
    protected  $helper;
    
    public function __construct($user, $db, $helper)
    {
        $this->user = $user;
        $this->db = $db;
        $this->helper = $helper;
    }
    
    public function showEtaperounds($competition)
    {

        $rounds = $this->db->getRoundOnCompetitionId($competition);
        $latest = $this->db->getFinishedEtapeRound($competition);
        
        $returndata = '<select name="etaperound" id="etapeselection" required>
            <option value="" disabled selected>Select etape</option>';
        
        $scorlatest = array();
        
        foreach ($latest as $val)
        {
            $scorlatest[] = $val[0];
        }
        
        foreach($rounds as $value)
        {
            if (isset($latest))
            {
                if (in_array($value[1], $scorlatest))
                {
                    $returndata .= '<option disabled value="'.$value[0].'">etape:'.$value[1].'</option>';
                }
                else
                {
                    $returndata .= '<option value="'.$value[0].'">etape:'.$value[1].'</option>';
                }
            }
            else
            {
                $returndata .= '<option value="'.$value[0].'">etape:'.$value[1].'</option>';
            }
        }
        
        $returndata .= '</select>';
        echo json_encode($returndata);
    }
}