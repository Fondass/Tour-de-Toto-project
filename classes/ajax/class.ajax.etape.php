<?php

/* class: PhP to Ajax script
 * 
 * Works with: 
 * classes/class.controller.ajax.php (controller)
 * 
 * javascript/ajax.etape.js
 * 
 * Allows for adding more winners (or falouts) after the initial 
 * selection of 10;
 */

class FonAjaxEtape
{
    
    protected $user;
    protected $db;
    protected $helper;
    protected $functions;
    
    public function __construct($user, $db, $helper)
    {
        $this->user = $user;
        $this->db = $db;
        $this->helper = $helper;
        
        $this->functions = new FonEtapeFunctions($this->user, $this->db, $this->helper);
    }
    
    public function addAnotherWinner($i)
    {
        $returndata = $this->functions->insertNewWinner($i);
        echo json_encode($returndata);
    }
}