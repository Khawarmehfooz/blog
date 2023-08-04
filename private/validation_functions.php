<?php 

function has_unique_email($email,$current_id=0){
    global $db;

    $sql = "SELECT * FROM users ";
    $sql .= "WHERE email='" . $email . "' ";
    $sql .= "AND id != '" . $current_id . "'";

    $result = mysqli_query($db,$sql);
    $user_count = mysqli_num_rows($result);
    mysqli_free_result($result);

    return $user_count === 0;
}

function is_blank($val){
    return !isset($val) || trim($val) ==='';
}

?>