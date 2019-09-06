<?php  
    class Router {
        
        public $links;
        public function __construct($availableLinks) {
            $this->$links = $availableLinks;
        }        
        public function isAvailablePage($getParameter) {
            if (in_array($getParameter, $this->$links)) {
                return true;
            }
            else {          
                return false;
            }
        }
    }
?>