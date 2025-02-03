<?php
require_once __DIR__ . "/../database/database.php";
class Authentication {
    private $user, $db;

    public function __construct(User $user, Database $database) {
        $this->user = $user;
        $this->db = $database;
    }

    public function login($username, $password) : array{
        try{
            $user = $this->user->read("users", ["username" => $username]);
            if(count($user) > 0){
                if(password_verify($password, $user[0]['password'])){
                    $token = bin2hex(random_bytes(100));
                    $this->db->update('users', ["token" => $token], ["username" => $username]);
                    return array(
                        "result" => true,
                        "token" => $token
                    );
                }
            }
            return array(
                "result" => false,
                "token" => null
            );
        }catch(Exception $e){
            echo $e;
            return false;
        }
    }

    public function logout(){} 

    public function isAuthenticated($token) :bool{
        $data = $this->db->read('users', ['token' => $token]);
        if(isset($token) && count($data) > 0){
            return true;
        }
        return false;
    }

    public function getCurrentUser(){} 
}


?>