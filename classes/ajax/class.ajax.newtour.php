<?php

/* class: PhP to Ajax script
 * 
 * Works with: 
 * classes/class.controller.ajax.php (controller)
 * 
 * javascript/ajax.newtour.js
 * 
 * When number of rounds is selected in newtour screen, will return 
 * form fields to add additional information per round.
 */

class FonAjaxNewtour
{
    
    protected $user;
    protected $db;
    protected $helper;
    
    public function __construct($user, $db, $helper)
    {
        $this->user = $user;
        $this->db = $db;
        $this->helper = $helper;
    }
    
    public function getRoundsHtml($p)
    {
        $returndata = '<p id="comprounds">';
        
        for($i = 1; $i < $p+1; $i++)
        {
            $returndata .= '<br>round:'.$i.' <input form="newtourform" type="date" name="compround'.$i.'date"><br>';
        }
        
        $returndata .= '</p>';
        
        echo json_encode($returndata);
    }
}