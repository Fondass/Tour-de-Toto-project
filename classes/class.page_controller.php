<?php

/* class: PhP controller class
 * 
 * Works with: 
 * index.php
 * 
 * controller for all http requests.
 */

class FonController 
{
    protected $user;
    protected $db;
    protected $helper;
   
    protected $ajax;
    
//================================================
//             construct controller
//================================================
/*
 * This controller is where most site-wide features
 * are handled made or included. All files that are
 * required by many or multiple loads of the site are
 * stacked here for convienence.
 * 
 * also site-wide paramaters are instantiated here
 * so that they may be handed over to most 
 * other classes through the controller.
 * 
 * (note: file requires only required by one 
 * particualar area should be shoved in the 
 * controller itself to limit file loading)
 */
//================================================
       
    public function __construct()
    {
        require_once("classes/class.page.php");
        require_once("classes/class.debug.php");
        require_once("classes/class.pdo.php");
        require_once("classes/class.helpers.php");
        require_once("classes/class.database.php");
        require_once("classes/class.login.php");
        require_once("classes/class.controller.ajax.php");
        
        $this->helper = new Helpers();
        $this->db = new FonDatabase();
        $this->user = new FonLogin($this->db, $this->helper);
        $this->ajax = new AjaxController($this->user, $this->db, $this->helper);
    }
    
//================================================
//                handle Request
//================================================
/*
 * Divides all incomming HTTP requests into
 * page requests or ajax requests.
 */
//================================================
    
    public function handleRequest()
    {
        if (isset($_POST["ajaxaction"]) || isset($_GET["ajaxaction"]))
        {
            $this->ajax->handleAjaxRequest();
        }
        else
        {
            $this->handleHttpRequest();
        }  
    }
    
//================================================
//                 handle http request
//================================================
/*
 * The page found by getPage (if found) is handed
 * on to the controller here after injection
 * validation.
 */
//================================================   
    
    protected function handleHttpRequest() 
    {
        $pagevar =  $this->getPage();
        $page = $this->pageController($this->helper->specChars($pagevar));
        if ($page)
        {
            $page->show();
        }
        else
        {
            echo "Gnomes have stolen the webpage, we apologize for their natural behaviour";
        }
    }
    
//================================================
//                    get page
//================================================
/*
 * small function that asks the helper class
 * CheckRequestMethod to give back the ?page= element
 * and hands it over to handleRequest.
 */
//================================================
    
    protected function getPage () 
    {
        $key = "page";

        $result = $this->helper->checkRequestMethod($key);
        return $result;
    } 
  
//================================================
//                page controller
//================================================
/*
 * main controller of the website. Every new page
 * visit, form post, and others go through here
 * before reaching their destination as designed by
 * this controller.
 */
//================================================
    
    protected function pageController($pagevar) 
    {
        switch ($pagevar) 
        {
            case "users":
                if ($this->user->checkLogged())
                {
                    require_once("classes/pages/page.users.php");
                    $page = new FonUsersPage($this->user, $this->db, $this->helper);
                    break;
                }
            
            case "admin":
                if ($this->user->checkPermission() == 2)
                {
                    require_once("classes/pages/page.admin.php");
                    $page = new FonAdminPage($this->user, $this->db, $this->helper);
                    break;
                }
               
            case "login":
                require_once("classes/pages/page.login.php");
                $page = new FonLoginPage($this->user, $this->db);
                break;
            
            case "riders":
                if ($this->user->checkLogged())
                {
                    require_once("classes/pages/page.riders.php");
                    require_once("classes/class.users.top.functions.php");
                    $functions = new FonUsersTopFunctions($this->user, $this->db, $this->helper);
                    $page = new FonRidersPage($this->user, $this->db, $this->helper, $functions);
                    break;
                }
            
            case "teams":
                if ($this->user->checkLogged())
                {
                    require_once("classes/pages/page.teams.php");
                    require_once("classes/class.users.top.functions.php");
                    $functions = new FonUsersTopFunctions($this->user, $this->db, $this->helper);
                    $page = new FonTeamsPage($this->user, $this->db, $this->helper, $functions);
                    break;
                }
            
            case "countries":
                if ($this->user->checkLogged())
                {
                    require_once("classes/pages/page.countries.php");
                    require_once("classes/class.users.top.functions.php");
                    $functions = new FonUsersTopFunctions($this->user, $this->db, $this->helper);
                    $page = new FonCountriesPage($this->user, $this->db, $this->helper, $functions);
                    break;
                }
            
            case "riderlist";
                if ($this->user->checkLogged())
                {
                    require_once("classes/pages/page.riderlist.php");
                    require_once("classes/class.riderlist.functions.php");
                    $functions = new FonRiderlistpageFunctions($this->user, $this->db, $this->helper);
                    $page = new FonRiderlistPage($this->user, $this->db, $this->helper, $functions);
                    break;
                }
                    
            case "newtour":
                if ($this->user->checkPermission() == 2)
                {
                    require_once("classes/pages/page.newtour.php");
                    require_once("classes/class.newtour.functions.php");
                    $functions = new FonNewtour($this->user, $this->db, $this->helper);
                    $page = new FonNewtourPage($this->user, $this->db, $this->helper, $functions);
                    break;
                }
                
            case "playerscores":
                if ($this->user->checkLogged())
                {
                    require_once("classes/pages/page.playerscores.php");
                    require_once("classes/class.users.scores.functions.php");
                    $functions = new FonUsersScoresFunctions($this->user, $this->db, $this->helper);
                    $page = new FonUsersScoresPage($this->user, $this->db, $this->helper, $functions);
                    break;                    
                }
                
            case "ownscore":
                if ($this->user->checkLogged())
                {
                    require_once("classes/pages/page.ownscores.php");
                    require_once("classes/class.users.scores.functions.php");
                    $functions = new FonUsersScoresFunctions($this->user, $this->db, $this->helper);
                    $page = new FonUsersOwnscorePage($this->user, $this->db, $this->helper, $functions);
                    break;
                }

            case "etape":
                if ($this->user->checkPermission() == 2)
                {
                    require_once("classes/pages/page.etape.php");
                    require_once("classes/class.etape.functions.php");
                    $functions = new FonEtapeFunctions($this->user, $this->db, $this->helper);
                    $page = new FonEtapePage($this->user, $this->db, $this->helper, $functions);
                    break;
                }
            
            case "newriders":
                if ($this->user->checkPermission() == 2)
                {
                    require_once("classes/pages/page.newriders.php");
                    require_once("classes/class.newriders.functions.php");
                    $functions = new FonNewriders($this->user, $this->db, $this->helper);
                    $page = new FonNewridersPage($this->user, $this->db, $this->helper, $functions);
                    break;
                }
            
            case "rankings":
                if ($this->user->checkLogged())
                {
                    require_once("classes/class.pdf.php");
                    require_once("classes/class.rankings.pdf.php");
                    require_once("classes/pages/page.rankings.php");
                    require_once("classes/class.rankings.functions.php");
                    $functions = new FonUsersRankingsFunctions($this->user, $this->db, $this->helper);
                    $pdf = new FonRankingsPdf($this->user, $this->db, $this->helper);
                    $page = new FonRankingsPage($this->user, $this->db, $this->helper, $pdf, $functions);
                    break;
                }
            
            case "rankingsexcel":
                if ($this->user->checkLogged())
                {
                    require_once("classes/pages/page.rankingsexcel.php");
                    require_once("classes/class.rankings.functions.php");
                    $functions = new FonUsersRankingsFunctions($this->user, $this->db, $this->helper);
                    $page = new FonRankingsExcelPage($this->user, $this->db, $this->helper, $functions);
                    break;
                }
                
            case "register":
                require_once("classes/pages/page.register.php");
                require_once("classes/class.register.functions.php");
                require_once("classes/class.captcha.php");
                $functions = new FonRegister($this->user, $this->db, $this->helper);
                $page = new Register($this->user, $this->db, $this->helper, $functions);
                break;
            
            case "logout":
                $this->user->logout();
            
            case "home":
                require_once("classes/class.captcha.php");
                  
            default:
                require_once("classes/pages/page.home.php");
                $page = new FonHomePage($this->user, $this->db, $this->helper);
        }
        return $page;
    }
}