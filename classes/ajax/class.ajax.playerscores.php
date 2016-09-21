<?php

/* class: PhP to Ajax script
 * 
 * Works with: 
 * classes/class.controller.ajax.php (controller)
 * 
 * javascript/ajax.users.playerscores.js
 * 
 * returns data for showing scores of different players,
 * interactive through competition selection.
 */

class FonAjaxPlayerScores
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
    
    public function showPlayerScores($competition)
    {
        $returndata = '<p id="scoresreplaceme">';
        
        $scores = $this->functions->getPlayerScoreData($competition);
        
            foreach($scores as $value)
            {
                $returndata .= '<br>'.$value[0].' points: '.$value[1].'<br>';
            }

        $returndata .= '</p>';
        echo json_encode($returndata);
    }
}