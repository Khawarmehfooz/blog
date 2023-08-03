<?php 
    function select_all_users(){
        global $db;
        $sql = "SELECT * FROM users";
        $result = mysqli_query($db,$sql);
        confirm_result_set($result);
        return $result;
    }
    
    function insert_user($username,$email,$password){
        global $db;
        if(!has_unique_email($email)){
            $errors ="Email already exists. Try another." ;
        }
        if(!empty($errors)){
            return $errors;
        }
        $hashed_password = password_hash($password,PASSWORD_BCRYPT);
        
        $sql = "INSERT INTO users ";
        $sql .= "(username,email,hashed_password) ";
        $sql .= "VALUES(";
        $sql .= "'" . $username . "',";
        $sql .= "'" . $email . "',";
        $sql .= "'" . $hashed_password . "'";
        $sql .= ")";

        $result = mysqli_query($db,$sql);

        if($result){
            return true;
        }else{
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }

    }

?>