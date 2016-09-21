<?php

/* class: PhP Model class
 * 
 * Works with: 
 * classes/pages/page.ownscores.php (page class)
 * classes/pages/page.playerscores.php (page class)
 * 
 * functions for the scores pages.
 */

class FonUsersScoresFunctions
{
    protected $user;
    protected $db;
    protected $helper;
    protected $score;
    
    public function __construct($user, $db, $helper)
    {
        $this->user = $user;
        $this->db = $db;
        $this->helper = $helper;
    }
    
    public function getPlayerScoreData($competition)
    {
        
        $players = $this->db->getPlayerscoreDataOnCompetition($competition);
        $riders = $this->db->getRiderscoreDataOnCompetition($competition);
        $score = array();
        
        $a = 0;

        foreach ($players as $value)
        {
            
            if ($a == 0)
            {
                $score[$a][0] = $value[0];
                $score[$a][1] = 0;
                $b = 0;
                $c = 20;
                $a++;
            }
            elseif (!isset($score[$a][0]) && $score[$a-1][0] != $value[0])
            {
                $score[$a][0] = $value[0];
                $score[$a][1] = 0;
                $b = 0;
                $c = 20;
                $a++;
            }
            
            if ($b < $c)
            {
                foreach ($riders as $pos)
                {
                    if ($value[1] == $pos[1])
                    {
                        if ($pos[4] == 1)
                        {
                            $score[$a-1][1] += $pos[3]  ;
                        }
                        else
                        {
                            $c++;
                        }
                    }
                }
            }
            $b++;
        }
        foreach ($score as $key => $value)
        {
            $points[$key] = $value[1];
        }
        
        array_multisort($points, SORT_DESC, $score);
        
        return $score; 
    } 
        
    public function getOwnScoreData($competition)
    {
        $user = $_SESSION["userid"];
        
        $player = $this->db->getPlayerRiderList($competition, $user);
        $riders = $this->db->getRiderscoreDataOnCompetition($competition);
        
        $score = array();
        $score[0] = 0;
        
        $a = 0;
        $b = 0;
        $c = 20;
        
        $temp_etape = array();
        
        foreach($riders as $valur)
        {
            if (!isset($temp_etape[0]))
            {
                $temp_etape[0] = $valur[0];
                $score[$a+1] = 0;
                $a++;
            }
            elseif ($temp_etape[$a-1] != $valur[0])
            {
                $temp_etape[$a] = $valur[0];
                $score[$a+1] = 0;
                $a++;
            }    
        }
        
        foreach ($player as $value)
        {
            if ($b < $c)
            {
                foreach ($riders as $pos)
                {    
                    if ($value[1] == $pos[1])
                    {
                        if ($pos[4] == 1)
                        {
                            $score[0] += $pos[3];
                            for ($i = 1; $i < $a+1; $i++)
                            {
                                if ($temp_etape[$i-1] == $pos[0])
                                {
                                    $score[$i] += $pos[3];
                                }
                            }
                        }
                        else
                        {
                            $c++;
                        }
                    }
                }
            }
            $b++;
        }      
        return $score;
    }
    
    
    
        /*
        $playerslist = $this->convertMultiArray($players, 'name', 2);
        $riderslist = $this->convertMultiArray($riders, 'round', 4);
        
        $returndata = array();
        $a =0;
         * 
         */
        
        /*
        foreach ($playerslist as $value)
        {
            $returndata[$a][0] = $playerslist[$a][0];
            $this->score = 0;
            foreach ($value as $rider)
            {
                // debug::write($rider[0]);
                foreach ($riderslist as $round)
                {
                    
                    $j = 20;
                    for ($i = 0; $i < $j; $i++)
                    {
                        debug::write('round'.$round[$i][0]);
                        // debug::write('loop = '.$j);
                        if ($rider[0] == $round[$i][0])
                        {
                           // debug::write($round[$i][0]);
                            
                            if ($round[$i][3] != 0)
                            {
                                $returndata[$a][1] .= $round[$i][2];
                            }
                            else
                            {
                                if ($j < 25)
                                {
                                    $j +1;
                                }
                            }
                        }
                    }
                }   
            }
            $a++;
        }
         * 
         */
    
    
    protected function convertMultiArray($array, $key, $elements)
    {
        // TODO : bug: when putting through rider score on competition 14, rider id and position mssing second number.
        // $this->functions->getDataArrays(14); $this->riders = $this->convertMultiArray($riders, 'round', 4);
        
        
        $temp_array = array();
        $i = 0;
        $j = 0;
        $key_array = array();
        $l = $elements;
        
        foreach ($array as $value)
        {
            if (!in_array($value[$key], $key_array))
            {
                $key_array[$i] = $value[$key];
                $temp_array[$i][0] = $value[0];
                foreach ($array as $val)
                {
                    if ($val[$key] == $value[$key])
                    {
                        for ($k = 0; $k < $l; $k++)
                        {
                            $temp_array[$i][$j][$k] = $val[$k+1];
                        }
                    }
                    $j++;
                }
            }
            $i++;
            $j = 0;
        }
        return $temp_array;
    } 
}