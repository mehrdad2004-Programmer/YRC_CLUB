<?php
    require_once __DIR__ . "/../database/database.php";

    class Accounting extends Database {
        private $table = "payment";
        public function __construct(){
            parent::__construct();
        }

        public function set_bill(array $info){
            $bill = $this->create($this->table, $info);
            if($bill){
                return true;
            }
            return false;
        }
    }