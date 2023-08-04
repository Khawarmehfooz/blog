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
    function find_all_posts(){
        global $db;
        $sql = "SELECT * FROM posts";
        $result = mysqli_query($db,$sql);
        confirm_result_set($result);
        return $result;
    }

    function find_post_by_id($id){
        global $db;

        $sql = "SELECT * FROM posts ";
        $sql .= "WHERE id = '" . $id . "'";
        $result = mysqli_query($db,$sql);
        confirm_result_set($result);
        $post = mysqli_fetch_assoc($result);
        return $post;
    }
    function find_own_post(){
        global $db;
        $user_id = $_SESSION['user_id'];

        $sql = "SELECT * FROM posts ";
        $sql .= "WHERE user_id='" . $user_id . "'";
        $result = mysqli_query($db,$sql);
        confirm_result_set($result);
        return $result;
    }
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
    function update_post($post_id,$post_title,$post_excerpt,$post_description,$post_thumbnail){
        global $db;
        $sql = "UPDATE posts ";
        $sql .= "SET ";
        $sql .= "post_title ='" . $post_title . "', ";
        $sql .= "post_excerpt ='" . $post_excerpt . "', ";
        $sql .= "post_description ='" . $post_description . "', ";
        $sql .= "post_thumbnail ='" . $post_thumbnail . "' ";
        $sql .= "WHERE  id='" . $post_id . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db,$sql);
        if($result) {
            return true;
        } else {
            // UPDATE failed
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function delete_post($id){
        global $db;

        $sql = "DELETE FROM posts ";
        $sql .= "WHERE id='" . $id . "' ";
        $sql .= "LIMIT 1";

        $result = mysqli_query($db,$sql);
        if($result){
            return true;
        }else {
            //  delete failed
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

?>