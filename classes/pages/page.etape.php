<?php

/* class: PhP Page (view) class
 * 
 * Works with: 
 * classes/pages/page.admin.php (parent link)
 * classes/class.page_controller.php (controller)
 * 
 * classes/class.etape.functions.php (model class)
 * 
 * javascript/ajax.etape.js (ajax)
 * classes/ajax/class.ajax.etape.php (ajax)
 * 
 * page that shows form to enter the conclusion of an etape. 
 */

class FonEtapePage extends FonPage
{
    protected $user;
    protected $db;
    protected $helper;
    protected $functions;
    
    public function __construct($user, $db, $helper, $functions)
    {
        $this->user=$user;
        $this->db=$db;
        $this->helper=$helper;
        $this->functions=$functions; 
    }
    
    protected function endHeader()
    {
        echo '<script type="text/javascript" src="javascript/ajax.etape.js"></script></head>';
    }
    
    protected function bodyContent() 
    {
        if (isset($_POST["submitetapeconclusion"]))
        {
            if($this->functions->saveConclusionIntoDb())
            {
                echo '<div id="homescreen"><div class="emptybar"></div>';
                
                echo 'Form has been sucsesfully submitted<br>';
                
                echo '<a href="?page=admin"><input type="button" value="continue"></a></div>';
            }
            else
            {
                $this->showForm();
                echo '<script type="text/javascript" src="javascript/popup.js"></script>';
            }
        }
        else
        {
            $this->showForm();
        }
    }
    
    protected function showForm()
    {
        $competition = $this->helper->specChars($_POST["competitionselected"]);
        $etaperound = $this->helper->specChars($_POST["etaperound"]);
        $p = 0;
        
        echo '<div id="etape2screen"><div class="emptybar"></div>';
        
        echo '<form id="etapeconclusion" method="POST">';
        
        echo '<input type="hidden" id="competitionselected" name="competitionselected" value="'.$competition.'">
              <input type="hidden" id="etaperound" name="etaperound" value="'.$etaperound.'">
              <input type="hidden" name="page" value="etape">';
        
        echo '<ul id="etape2list"><li><div id="addanother">Add winner</div></li>';
        
        echo '<li><input id="etapesubmit" type="submit" name="submitetapeconclusion" value="Send"></li></form>';
        
        echo '<li><a href="?page=admin"><div>Back</div></a></li></ul></div>';
        
        echo '<div id="etape3screen"><div class="emptybar"></div><div id="colom1">';
        
        for($i = 1; $i < 6; $i++)
        {
            echo $this->functions->insertNewWinner($i);
            $p .= $i;
        }
        
        echo '</div><div id="colom2">';
        
        for($i = 6; $i < 11; $i++)
        {
            echo $this->functions->insertNewWinner($i);
            $p .= $i;
        }
        
        echo '<p id="replacemep"></p></div>';
        
        
    }
}
