<?php
    class Users extends JsonDataArray
    {
        public function displaySortedList() {
            return $this->newQuery()->getObjs();
        }
    }
?>