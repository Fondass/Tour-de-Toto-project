<?php

/* class: PhP Model class
 * 
 * Works with: 
 * classes/pages/page.etape.php (page class)
 * 
 * functions that enable the admin to conclude an etape.
 */

class FonEtapeFunctions
{
    protected $user;
    protected $db;
    protected $helper;
    
    protected $riders;
    protected $competition;
    protected $round;
    protected $inactiveridersarray;
    
    public function __construct($user, $db, $helper)
    {
        $this->user = $user;
        $this->db = $db;
        $this->helper = $helper;
        
        $this->riders = $this->db->getRidersAndId();
        
        $this->competition = $this->helper->specChars($_POST["competitionselected"]);
        $this->round = $this->helper->specChars($_POST["etaperound"]);
        
        $this->inactiveridersarray = $this->db->getInactiveRidersOnCompetitionEtape($this->competition, $this->round);
    }
    
    public function insertNewWinner($i)
    {
        $inactiveriders = array();
        
        foreach ($this->inactiveridersarray as $row)
        {
            $inactiveriders[] = $row[0];
        }
        
        $riderlist = '<br><select form="etapeconclusion" name="etapewinner'.$i.'">';
        
        foreach ($this->riders as $value)
        {
            if (in_array($value[1], $inactiveriders))
            {
                $riderlist .= '<option disabled value="'.$value[1].'">'.$value[0].'</option>';
            }
            else
            {
                $riderlist .= '<option value="'.$value[1].'">'.$value[0].'</option>';
            }
        }
        
        $riderlist .= '</select>';
        
        $riderlist .= '<br><select form="etapeconclusion" name="etapeposition'.$i.'">';
        
        for ($j = 1; $j < 11; $j++)
        {
            if ($j == $i)
            {
                $riderlist .= '<option selected value="'.$j.'">position '.$j.'</option>';
            }
            else
            {
                $riderlist .= '<option value="'.$j.'">position '.$j.'</option>';
            }
        }
        
        $riderlist .= '<option value="0"> N/A </option>';
        
        $riderlist .= '</select><br>';
        
        $riderlist .= '<select form="etapeconclusion" name="rideralive'.$i.'">
                        <option value="1" selected>active</option>
                        <option value="0">not active</option>
                       </select><br>';
        return $riderlist;
    }
    
    public function saveConclusionIntoDb()
    {
        
        $winners = array();
        for ($i = 1; $i < 51; $i++)
        {
            if (isset($_POST['etapewinner'.$i.'']) != "")
            {
                $winners[$i] = array();
                $winners[$i][0] = $this->helper->specChars($_POST['etapewinner'.$i.'']);
                $winners[$i][1] = $this->helper->specChars($_POST['etapeposition'.$i.'']);
                
                switch($winners[$i][1])
                {
                    case 1:
                        $points = 25;
                        break;
                    case 2: 
                        $points = 20;
                        break;
                    case 3:
                        $points = 15;
                        break;
                    case 4:
                        $points = 10;
                        break;
                    case 5:
                        $points = 9;
                        break;
                    case 6:
                        $points = 8;
                        break;
                    case 7:
                        $points = 7;
                        break;
                    case 8:
                        $points = 6;
                        break;
                    case 9:
                        $points = 5;
                        break;
                    case 10:
                        $points = 4;
                        break;
                    case 0:
                        $points = 0;
                        break;
                }
                $winners[$i][2] = $points;
                $winners[$i][3] = $this->helper->specChars($_POST['rideralive'.$i.'']);
            }
            else
            {
                break;
            }
        }
        $array = array();
        
        foreach($winners as $value)
        {
            $array[] = $value[0];
        }
        
        if ($this->helper->hasDuplicates($array))
        {
            // if $winners has duplicates
            return false;
        }
        else
        {
            // if $winners does not have duplicates.
            $this->db->saveEtapeConclusion($this->round, $winners);
            
            $rounds = $this->db->getRoundOnCompetitionId($this->competition);
            $latest = $this->db->getFinishedEtapeRound($this->competition);
            
            $scorlatest = array();
        
            foreach ($latest as $val)
            {
                $scorlatest[] = $val[0];
            }
            
            $a = 0;
            $b =0;
            
            foreach($rounds as $value)
            {
                if (isset($latest))
                {
                    if (in_array($value[1], $scorlatest))
                    {
                        $a++;
                    }
                    else
                    {
                        $b++;
                    }
                }
                else
                {
                    $b++;
                }
            }
            
            if ($b === 0 && $a != 0)
            {
                return $this->db->saveCompletedCompetition($this->competition);
            }
            return true;
        } 
    }
}