<?php

/* class: PhP Page (view) class
 * 
 * Works with: 
 * classes/pages/page.users.php (parent link)
 * classes/class.page_controller.php (controller)
 * 
 * classes/class.rankings.functions.php (model)
 * 
 * clases/class.rankings.pdf.php    (pdf generator)
 * 
 * page class, shows a generated pdf an outputs it to the browser.
 */


class FonRankingsPage
{
    protected $user;
    protected $db;
    protected $helper;
    protected $pdf;
    protected $functions;
    
    public function __construct($user, $db, $helper, $pdf, $functions)
    {
        $this->user = $user;
        $this->db = $db;
        $this->helper = $helper;
        $this->pdf = $pdf;
        $this->functions = $functions;
    }
    
    public function show()
    {
        $topriders = $this->functions->getTopRiders();
        $playerscoretotal = $this->functions->getPlayerScoreTotal();
        $playerscorelatest = $this->functions->getPlayerScoreLatest();
        $date = $this->functions->getLatestEtapeDate();
        
        $this->pdf->createRankings($topriders, $playerscoretotal, $playerscorelatest, $date);
    }

}