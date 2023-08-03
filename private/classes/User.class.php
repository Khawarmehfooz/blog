<?php
//   require_once("query_functions.php");

class User{
    public $username,$email,$password;

    public function __construct($username="",$email="",$password=""){
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    public function createUser(){
        $result = insert_user($this->username,$this->email,$this->password);
        return $result;
    }
}
?>