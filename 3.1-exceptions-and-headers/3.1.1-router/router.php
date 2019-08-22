<?php
    class Router
    {
        private $links;

        function __construct($availableLinks) {
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