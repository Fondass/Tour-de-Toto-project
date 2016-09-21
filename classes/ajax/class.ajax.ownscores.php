<?php

/* class: PhP to Ajax script
 * 
 * Works with: 
 * classes/class.controller.ajax.php (controller)
 * 
 * javascript/ajax.users.ownscores.js
 * 
 * returns data to show the players total score per etape
 */

class FonAjaxOwnScores
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
    
    public function showOwnScores($competition)
    {
        $compscore = $this->functions->getOwnScoreData($competition);
        $roundsrun = $this->db->getFinishedEtapeRound($competition);
        $roundsrunfixed = array();
        
        foreach ($roundsrun as $value)
        {
            $roundsrunfixed[] = $value[0];
        }
        
        $returndata = '<p id="ownscoresreplaceme">Competition score: '.$compscore[0].'<br>';

        $a = count($compscore);
        $b = 1;
        for ($i = 1; $i < $a; $i++)
        {
            if (in_array($i, $roundsrunfixed))
            {
                $returndata .= '<br>Score etape '.$i.' = '.$compscore[$b].'<br>';
                $b++;
            }
            else
            {
                $a++;
            }
        }
        
        $returndata .= '</p>';
        
        echo json_encode($returndata);
    }
}