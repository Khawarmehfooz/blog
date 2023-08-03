<?php 
    function log_in_user($user_id,$username){
        session_regenerate_id();
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        $_SESSION['last_login'] = time();
        return true;
    }

    function is_user_logged_in(){
        return isset($_SESSION['user_id']);
    }

    function require_login(){
        if(!is_user_logged_in()){
            redirect_to(url_for('/login.php'));
        }else{
            // Do Nothing
        }
    }
?>