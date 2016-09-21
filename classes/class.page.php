<?php
	

class FonPage
{
    
    protected $user;
    protected $db;
    protected $helper;
    
    public function show()
    {
            $this->beginDoc();
            $this->beginHeader();
            $this->headerContent();
            $this->endHeader();
            $this->beginBody();
            $this->bodyContent();
            $this->endBody();
            $this->endDoc();
    }	
    
    public function __construct($user, $db, $helper)
    {
        $this->user = $user;
        $this->db = $db;
        $this->helper = $helper;
    }
    
    protected function beginDoc() 
    { 
            echo "<!DOCTYPE html><html>"; 
    }

    protected function beginHeader() 
    { 
            echo '<head>
                <meta charset=UTF-8 />
                <meta name="toto" content="netbeans" />
                <link rel="stylesheet" href="css/stylesheet.css" type="text/css" media="all" />
                <script src="lib/jquery-1.12.4.min.js"></script>
                '; 
    }

    protected function headerContent() 
    { 
            echo "<title></title>";
    }

    protected function endHeader()
    { 
            echo "</head>"; 
    }

    protected function beginBody() 
    { 
            echo '<body><div id="wrapper">'; 
    }

    protected function bodyContent() 
    { 
            echo ""; 
    }

    protected function endBody() 
    { 
            echo "</div></body>"; 
    }

    protected function endDoc() 
    { 
            echo "</html>"; 
    }
}
		

