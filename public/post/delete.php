<?php 
    include("../../private/initialize.php"); 
    $id = $_GET['id'] ?? '';
    $result = delete_post($id);
    if($result === true){
        $_SESSION['message'] = "Post Delete Successfully!";
        redirect_to(url_for("/user-dashboard"));
    }
?>