<?php
    require_once __DIR__ . "/../database/database.php";
    class User extends Database{
        private $tname;

        public function __construct(){
            parent::__construct();
            $this->tname = 'users';
        }

        public function createUser(string $username, string $password) : bool{
            $reg = $this->create($this->tname, [
                "username" => $username,
                "password" => password_hash($password, PASSWORD_DEFAULT),
                "token" => bin2hex(random_bytes(100))
            ]);
            if($reg){
                return true;
            }
            return false;
        }

        public function modifyUser(string $username, string $newpass) : bool{
            $updated = $this->update($this->tname, [
                "username" => $username,
                "password" => $newpass
            ], ["username" => $username]);

            if($updated){
                return true;
            }
            return false;
        }

        public function deleteUser(string $username) : bool{
            $del = $this->delete($this->tname, ['username' => $username]);
            if($del){
                return true;
            }
            return false;
        }

        public function fetchUsers() : array{
            return $this->read($this->tname);
        }
    }
