<?php
    class User extends DataRecordModel
    {
        public $name;
        public $email;
        public $password;
        public $rate;
        public function addUserFromForm() {
            $this->commit();
        }
    }
?>