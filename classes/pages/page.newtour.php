<?php

/* class: PhP Page (view) class
 * 
 * Works with: 
 * classes/pages/page.admin.php (parent link)
 * classes/class.page_controller.php (controller)
 * 
 * classes/class.newtour.php (model class)
 * 
 * javascript/ajax.newtour.js (ajax)
 * classes/ajax/class.ajax.newtour.php (ajax) 
 * 
 * admin page that shows a form to create a new competition
 */

class FonNewTourPage extends FonPage
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
    
    protected function endHeader() 
    {
        echo '<script src="javascript/ajax.newtour.js"></script>
            </head>';
    }
    
    protected function bodyContent()        
    {
        if ($this->helper->checkRequestMethod("compsendnew"))
        {
            $this->functions->saveForm();
            $this->formFilled();
        }
        else
        {
            $this->showForm();
        }
    }
    
    protected function showForm()
    {
        echo '<div id="newtourscreen"><div class="emptybar"></div>';
        
        echo '<form id="newtourform" method="POST">
              Competition name:<input type="text" name="compname"><br>';
        
        echo 'How many rounds?<input id="competitionrounds" type="number" name="compnumber"><br>';
        
        echo '<div id="backbuttonnewtour"><a href="?page=admin">Back</div></div>';
        
        echo '<div id="compscreen"><div class="emptybar"></div>';
        
        echo '<p id="comprounds"></p>';
        
        echo '<input type="submit" value="send" name="compsendnew">
              <input type="hidden" name="page" value="newtour">
              </form><br><br>';
        
        echo '</div>';  
    }
    
    protected function formFilled()
    {
        echo '<div id="homescreen"><div class="emptybar"></div>Your competition has been succsesfully made
              <a href=?page=home><input type="button" value="home"></a></div>';
    }
}