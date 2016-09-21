<?php

/* class: PhP Model class
 * 
 * Works with: 
 * classes/pages/page.rankings.php (page class)
 * classes/pages/page.rankingsexcel.php (page class)
 * 
 * class.rankings.pdf.php   (model class, data goes here)
 * 
 * functions for the rankings page to calculate data 
 * for the rankings pdf and rankings excel
 */

class FonUsersRankingsFunctions
{
    protected $user;
    protected $db;
    protected $helper;
    protected $competition;
    
    public function __construct($user, $db, $helper)
    {
        $this->user = $user;
        $this->db = $db;
        $this->helper = $helper;
        
        $this->competition = $this->helper->specChars($_POST["rankingscompetitionselect"]);
    }
    
    protected function playerScoreData($players, $riders, $latest)
    {
        $score = array();
        $inactiveriders = $this->db->getInactiveRidersOnCompetition($this->competition);
        
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
            
            if ($latest == true)
            {
                foreach ($inactiveriders as $active)
                {
                    if($value[1] == $active[0])
                    {
                        $c++;
                    }
                }
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
                        elseif($latest == false)
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

    
    protected function summaryData()
    {
        $competition = $this->competition;
        
        $players = $this->db->getPlayerscoreDataOnCompetition($competition);
        $riders = $this->db->getRiderscoreDataOnCompetition($competition);
        $topridersid = $this->db->getLatestEtapeWinnersID($competition);
        $topriders = $this->db->getLatestEtapeWinners($competition);
        
        $playerscoretotal = $this->playerScoreData($players, $riders, false);
        
        $playerscorelatest = $this->playerScoreData($players, $topridersid, true);
    }
    
    public function getTopRiders()
    {
        return $this->db->getLatestEtapeWinners($this->competition);
    }
    
    public function getPlayerScoreTotal()
    {
        $competition = $this->competition;
        
        $players = $this->db->getPlayerscoreDataOnCompetition($competition);
        $riders = $this->db->getRiderscoreDataOnCompetition($competition);
        
        return $this->playerScoreData($players, $riders, false);
    }
    
    public function getPlayerScoreLatest()
    {
        $competition = $this->competition;
        
        $players = $this->db->getPlayerscoreDataOnCompetition($competition);
        $topriders = $this->db->getLatestEtapeWinnersID($competition);
        
        return $this->playerScoreData($players, $topriders, true);
    }
    
    public function getLatestEtapeDate()
    {
        return $this->db->getLatestEtapeDate($this->competition);
    }
    
    public function filterData(&$str)
    {
        // escape tab characters
        $str = preg_replace("/\t/", "\\t", $str);

        // escape new lines
        $str = preg_replace("/\r?\n/", "\\n", $str);

        // convert 't' and 'f' to boolean values
        if($str == 't') $str = 'TRUE';
        if($str == 'f') $str = 'FALSE';

        // force certain number/date formats to be imported as strings
        if(preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str)) 
        {
         $str = "'$str";
        }

        // escape fields that include double quotes
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    }
}