<?php

/* class: PhP controller class
 * 
 * Works with: 
 * classes/class.page_controller.php (controller class)
 * 
 * controller for all ajax requests.
 */

class AjaxController
{
    
    protected $user;
    protected $db;
    protected $helper;
    
    public function __construct($user, $db, $helper)
    {
        $this->user = $user;
        $this->db = $db;
        $this->helper = $helper;
        require_once("classes/class.debug.php");
    }

    //================================================
    //               handle Ajax Request
    //================================================
    /*
     * The Ajax controller. This is responsible for 
     * calling the requested ajax function. Case is retrieved
     * from ?ajaxaction= (url) by getAjaxPage().
     */
    //================================================

        public function handleAjaxRequest()
        {
            $pagevar = $this->getAjaxAction();
            $ajaxaction = $this->helper->specChars($pagevar);

            switch($ajaxaction)
            {
                case "selection":
                    require_once("classes/ajax/class.ajax.riderlist.php");
                    
                    $rider = $this->helper->specChars($_POST["select"]);
                    $selection = new FonAjaxAthleteSelection($this->user, $this->db, $this->helper);
                    $selection->athleteInformation($rider);
                    break;
                
                case "competitionrounds":
                    require_once("classes/ajax/class.ajax.newtour.php");
                    $rounds = $this->helper->specChars($_POST["roundsamount"]);
                    $newtourrounds = new FonAjaxNewtour($this->user, $this->db, $this->helper);
                    $newtourrounds->getRoundsHtml($rounds);
                    break;
                
                case "roundincompetition":
                    require_once("classes/ajax/class.ajax.admin.php");
                    $competition = $this->helper->specChars($_POST["competitionid"]);
                    $roundamount = new FonAjaxAdmin($this->user, $this->db, $this->helper);
                    $roundamount->showEtaperounds($competition);
                    break;
                
                case "addetapewinner":
                    require_once("classes/ajax/class.ajax.etape.php");
                    require_once("classes/class.etape.functions.php");
                    $number = $this->helper->specChars($_POST["winnercount"]);
                    $etapeentry = new FonAjaxEtape($this->user, $this->db, $this->helper);
                    $etapeentry->addAnotherWinner($number);
                    break;
                
                case "top10":
                    require_once("classes/ajax/class.ajax.users.top.php");
                    $competition = $this->helper->specChars($_POST["competition"]);
                    $top10 = new FonAjaxUsersTop($this->user, $this->db, $this->helper);
                    $top10->showRidertop10($competition);
                break;
                
                case "top5":
                    require_once("classes/ajax/class.ajax.users.top.php");
                    $competition = $this->helper->specChars($_POST["competition"]);
                    $top5 = new FonAjaxUsersTop($this->user, $this->db, $this->helper);
                    $top5->showTeamtop5($competition);
                break;
            
                case "top3":
                    require_once("classes/ajax/class.ajax.users.top.php");
                    $competition = $this->helper->specChars($_POST["competition"]);
                    $top3 = new FonAjaxUsersTop($this->user, $this->db, $this->helper);
                    $top3->showCountrytop3($competition);
                break;
            
                case "playerscores":
                    require_once("classes/ajax/class.ajax.playerscores.php");
                    require_once("classes/class.users.scores.functions.php");
                    $competition = $this->helper->specChars($_POST["competition"]);
                    $functions = new FonUsersScoresFunctions($this->user, $this->db, $this->helper);
                    $scores = new FonAjaxPlayerScores($this->user, $this->db, $this->helper, $functions);      
                    $scores->showPlayerScores($competition);
                    break;
                
                case "ownscore":
                    require_once("classes/ajax/class.ajax.ownscores.php");
                    require_once("classes/class.users.scores.functions.php");
                    $competition = $this->helper->specChars($_POST["competition"]);
                    $functions = new FonUsersScoresFunctions($this->user, $this->db, $this->helper);
                    $ownscore = new FonAjaxOwnScores($this->user, $this->db, $this->helper, $functions);
                    $ownscore->showOwnScores($competition);
                    break;
                
            }      
        }

    //================================================
    //                get Ajax Action
    //================================================
    /*
     * small function that asks the helper class
     * CheckRequestMethod to give back the 
     * ?ajaxaction= element and hands it over 
     * to handleAjaxRequest.
     */
    //================================================

        protected function getAjaxAction()
        {
            $key = "ajaxaction";

            $result = $this->helper->checkRequestMethod($key);
            return $result;
        }
}