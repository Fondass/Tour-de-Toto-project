<?php

/* class: PhP Page (view) class
 * 
 * Works with: 
 * classes/pages/page.users.php (parent link)
 * classes/class.page_controller.php (controller)
 * 
 * classes/class.rankings.functions.php (model)
 * 
 * page class, generates a download of an excel sheet.
 */

class FonRankingsExcelPage
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
    
    public function show()
    {
        $topriders = $this->functions->getTopRiders();
        $playerscoretotal = $this->functions->getPlayerScoreTotal();
        $playerscorelatest = $this->functions->getPlayerScoreLatest();
        $date = $this->functions->getLatestEtapeDate();
        $competition = $this->helper->specChars($_POST['varcompname']);
        
        $this->buildExcel($topriders, $playerscoretotal, $playerscorelatest, $date, $competition);
    }
    
    protected function buildExcel($topriders, $playerscoretotal, $playerscorelatest, $date, $competition)
    {
        // file name for download
        $fileName = "TourdeToto" . date('Ymd') . ".xls";

        // headers for download
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header("Content-Type: application/vnd.ms-excel");

        $flag = false;
        $keyridernames = array("rider", "position", "points");
        $keyplayernames = array("player", "points");
        
        foreach ($topriders as $row)
        {
            if(!$flag) 
            {
                echo $competition . "\t" . "Etape\t" . $date . "\t\n\n";
                // display field / column names as first row
                echo implode("\t", $keyridernames) . "\r\n\n";
                $flag = true;
            }
            array_walk($row, array($this->functions,'filterData'));
            echo $row[0] . "\t" . $row[1] . "\t" . $row[2] . "\r\n";
        }
            
        echo "\n\n";
        
        $flag = false;
        
        foreach ($playerscorelatest as $row)
        {
            if (!$flag)
            {
                echo implode("\t\t", $keyplayernames) . "\r\n\n";
                $flag = true;
            }
            array_walk($row, array($this->functions,'filterData'));
            echo $row[0] . "\t\t" . $row[1] . "\r\n";
        }
        
        echo "\n\n";
        
        $flag = false;
        
        foreach ($playerscoretotal as $row)
        {
            if (!$flag)
            {
                echo implode("\t\t", $keyplayernames) . "\r\n\n";
                $flag = true;
            }
            array_walk($row, array($this->functions,'filterData'));
            echo $row[0] . "\t\t" . $row[1] . "\r\n";
        }
    }
}