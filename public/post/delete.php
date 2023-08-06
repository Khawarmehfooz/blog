<?php 
    include("../../private/initialize.php"); 
    $id = htmlspecialchars($_GET['id']) ?? '';
    $post = find_post_by_id($id); 
    if($post['user_id'] !== $_SESSION['user_id']){
        $_SESSION['message'] = "Unauthorized!";
        redirect_to(url_for("/user-dashboard"));
        exit;
    } 
    $result = delete_post($id);
    if($result === true){
        $_SESSION['message'] = "Post Delete Successfully!";
        redirect_to(url_for("/user-dashboard"));
    }
?>