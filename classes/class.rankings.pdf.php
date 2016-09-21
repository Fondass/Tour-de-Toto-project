<?php

/* class: PhP PdfGen (model) class
 * 
 * Works with: 
 * classes/pages/page.rankings.php (page)
 * classes/class.page_controller.php (controller)
 * 
 * classes/class.rankings.functions.php (model)
 * 
 * clases/class.pdf.php  (parent)
 * 
 * class that takes calculated data and orders in in a PDF
 */

class FonrankingsPdf extends FPDF
{
    
    protected $user;
    protected $db;
    protected $helper;
    
    protected $competition;
    protected $round;
    protected $riderdata;
    protected $playerdata;
    
    public function __construct($user, $db, $helper)
    {
        parent::__construct();
        $this->user = $user;
        $this->db = $db;
        $this->helper = $helper;
    }
    
    public function createRankings($topriders, $playerscoretotal, $playerscorelatest, $date)
    {
       $this->setDefaults($topriders, $playerscoretotal, $playerscorelatest, $date);
       $this->createData();
    }
    
    protected function setDefaults($topriders, $playerscoretotal, $playerscorelatest, $date)
    {
        $this->competition = $this->helper->specChars($_POST['varcompname']);
        $this->round = $date;
        $this->topriders = $topriders;
        $this->playerscoretotal = $playerscoretotal;
        $this->playerscorelatest = $playerscorelatest;
    }
    
    protected function createData()
    {
        $this->AddPage();
        $this->SetFont('Arial','B',16);
        $this->Cell(60,10,'Rankings');
        $this->Cell(80,10,'Competition: '.$this->competition,0,0,'L');
        $this->Cell(60,10,'Etape: '.$this->round,0,1,'L');
        $this->Ln(4);
        $this->SetFont('Arial','B',12);
        $this->Cell(0,0,'','T',2);
        $this->Cell(90,10,'Rider ranks latest etape',0,1,'L');
        $this->Cell(80,10,'Rider',0,0,'L');
        $this->Cell(80,10,'Position',0,0,'L');
        $this->Cell(60,10,'Points',0,1,'L');
        // $this->Cell(90,10,'New Total Score',0,1,'R');
        $this->Cell(0,0,'','T',2);
        $this->SetFont('Arial','',10);
        
        // Rider part of the pdf is created here.
        
        for($i=0;$i<=14;$i++)
        {
            if (isset($this->topriders[$i][0]))
            {
                $this->Cell(80,6,$this->topriders[$i][0],0,0,'L');
                $this->Cell(80,6,$this->topriders[$i][1],0,0,'L');
                $this->Cell(60,6,$this->topriders[$i][2],0,1,'L');
            }
            else
            {
                $this->Cell(80,6,'n/a',0,0,'L');
                $this->Cell(80,6,'n/a',0,0,'L');
                $this->Cell(60,6,'n/a',0,1,'L');
            }
        }
        $this->Cell(0,0,'','T',2);
        $this->SetFont('Arial','B',12);
        $this->Cell(90,10,'Player rank latest etape',0,1,'L');
        $this->Cell(160,10,'Player',0,0,'L');
        $this->Cell(60,10,'Points',0,1,'L');
        $this->Cell(0,0,'','T',2);
        $this->SetFont('Arial','',10);
        for($i=0;$i<=19;$i++)
        {
            if (isset($this->playerscorelatest[$i][0]))
            {
                $this->Cell(160,6,$this->playerscorelatest[$i][0],0,0,'L');
                $this->Cell(60,6,$this->playerscorelatest[$i][1],0,1,'L');
            }
            else
            {
                break;
            }
        }
        
        $this->AddPage();
        $this->SetFont('Arial','B',12);
        $this->Cell(90,10,'Player rank new total',0,1,'L');
        $this->Cell(50,10,'Player',0,0,'L');
        $this->Cell(60,10,'Points',0,0,'L');
        $this->Cell(50,10,'Player',0,0,'L');
        $this->Cell(50,10,'Points',0,1,'L');
        $this->Cell(0,0,'','T',2);
        $this->SetFont('Arial','',10);
        for($i=0;$i<=40;$i++)
        {
            if (isset($this->playerscoretotal[$i][0]))
            {
                if (isset($this->playerscoretotal[$i+40][0]))
                {
                    $this->Cell(50,6,$this->playerscoretotal[$i][0],0,0,'L');
                    $this->Cell(60,6,$this->playerscoretotal[$i][1],0,0,'L');
                    $this->Cell(50,6,$this->playerscoretotal[$i+40][0],0,0,'L');
                    $this->Cell(60,6,$this->playerscoretotal[$i+40][1],0,1,'L');
                }
                else
                {
                    $this->Cell(50,6,$this->playerscoretotal[$i][0],0,0,'L');
                    $this->Cell(60,6,$this->playerscoretotal[$i][1],0,1,'L');
                }
            }
            else
            {
                break;
            }
        }
        $this->Output();
    }
}