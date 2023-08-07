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
        $sql .= "WHERE email='" . db_escape($db,$email)."' ";
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
        $sql .= "'" . db_escape($db,$username) . "',";
        $sql .= "'" . db_escape($db,$email) . "',";
        $sql .= "'" . db_escape($db,$hashed_password) . "'";
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
        $sql .= "WHERE id = '" . db_escape($db,$id) . "'";
        $result = mysqli_query($db,$sql);
        confirm_result_set($result);
        $post = mysqli_fetch_assoc($result);
        return $post;
    }
    function find_own_post(){
        global $db;
        $user_id = $_SESSION['user_id'];

        $sql = "SELECT * FROM posts ";
        $sql .= "WHERE user_id='" . db_escape($db,$user_id) . "'";
        $result = mysqli_query($db,$sql);
        confirm_result_set($result);
        return $result;
    }
    function insert_post($post_title,$post_excerpt,$post_description,$publish_date,$post_thumbnail){
        global $db;
        $user_id = $_SESSION['user_id'];

        if(!empty($errors)){
            return $errors;
        }

        $sql = "INSERT INTO posts ";
        $sql .= "(user_id, post_title,post_excerpt,post_description,publish_date,post_thumbnail) ";
        $sql .= "VALUES(";
        $sql .= "'" . db_escape($db,$user_id) . "', ";
        $sql .= "'" . db_escape($db,$post_title) . "', ";
        $sql .= "'" . db_escape($db,$post_excerpt) . "', ";
        $sql .= "'" . db_escape($db,$post_description) . "', ";
        $sql .= "'" . db_escape($db,$publish_date) . "', ";
        $sql .= "'" . db_escape($db,$post_thumbnail) . "'";
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
    function search_post($search_query){
        global $db;
        $sql = "SELECT * FROM posts ";
        $sql .= "WHERE post_title LIKE ";
        $sql .= "'%". db_escape($db,$search_query) . "%'";
        $result = mysqli_query($db,$sql);
        confirm_result_set($result);
        return $result;
    }
    function update_post($post_id,$post_title,$post_excerpt,$post_description,$post_thumbnail){
        global $db;
        $sql = "UPDATE posts ";
        $sql .= "SET ";
        $sql .= "post_title ='" . db_escape($db,$post_title) . "', ";
        $sql .= "post_excerpt ='" . db_escape($db,$post_excerpt) . "', ";
        $sql .= "post_description ='" . db_escape($db,$post_description) . "', ";
        $sql .= "post_thumbnail ='" . db_escape($db,$post_thumbnail) . "' ";
        $sql .= "WHERE  id='" . db_escape($db,$post_id) . "' ";
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
        $sql .= "WHERE id='" . db_escape($db,$id) . "' ";
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
    function get_joined_post_user(){
        global $db;

        $sql = "SELECT * FROM posts ";
        $sql .= "JOIN users ON posts.user_id = users.id";
        $result = mysqli_query($db,$sql);
        confirm_result_set($result);
        return $result;
    }
    // Admin
    function find_admin_by_email($email){
        global $db;
        $sql = "SELECT * FROM admins ";
        $sql .= "WHERE email='" . db_escape($db,$email)."' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db,$sql);
        confirm_result_set($result);
        $admin = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $admin;
    }

?>