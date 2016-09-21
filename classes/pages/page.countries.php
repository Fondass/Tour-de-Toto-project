<?php

/* class: PhP Page (view) class
 * 
 * Works with: 
 * classes/pages/page.users.php (parent link)
 * classes/class.page_controller.php (controller)
 * 
 * classes/class.users.top.functions.php (moddel class)
 * 
 * javascript/ajax.users.top.js (ajax)
 * classes/ajax/class.ajax.users.top.php (ajax)
 * 
 * page that shows the top 5 countries.
 */

class FonCountriesPage extends FonPage
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
        echo '<script type="text/javascript" src="javascript/ajax.users.top.js"></script></head>';
    }
    
    protected function bodyContent() 
    {
        $this->functions->competitionSelect(3);
    }
    
}