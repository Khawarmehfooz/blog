<?php 
    function select_all_users(){
        global $db;
        $sql = "SELECT * FROM users";
        $result = mysqli_query($db,$sql);
        confirm_result_set($result);
        return $result;
    }

    function find_user_by_email($email){
        global $db;
        $sql = "SELECT * FROM users ";
        $sql .= "WHERE email='".$email."' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db,$sql);
        confirm_result_set($result);
        $user = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $user;
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

    // Post
    function insert_post($post_title,$post_excerpt,$post_description,$post_thumbnail){
        global $db;
        $user_id = $_SESSION['user_id'];

        if(!empty($errors)){
            return $errors;
        }

        $sql = "INSERT INTO posts ";
        $sql .= "(user_id, post_title,post_excerpt,post_description,publish_date,post_thumbnail) ";
        $sql .= "VALUES(";
        $sql .= "'" . $user_id . "', ";
        $sql .= "'" . $post_title . "', ";
        $sql .= "'" . $post_excerpt . "', ";
        $sql .= "'" . $post_description . "', ";
        $sql .= "'" . time() . "', ";
        $sql .= "'" . $post_thumbnail . "'";
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