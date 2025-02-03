<?php
    require_once __DIR__ . "/../database/database.php";
    class Registration extends Database{
        private $table = "registration";
        public function __construct()
        {
            parent::__construct();
        }

        public function register_student(array $info){
            $reg = $this->create($this->table, $info);
            if($reg){
                return true;
            }
            return false;
        }
    }