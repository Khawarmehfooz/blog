<?php 
    require_once("../../private/initialize.php");

    unset($_SESSION['username']);
    unset($_SESSION['admin_id']);
    $_SESSION['message'] = "Logout Successfully.";
    redirect_to(url_for("/admin"));
?>