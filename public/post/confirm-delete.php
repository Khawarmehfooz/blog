<?php 
    include("../../private/initialize.php"); 
    require_login();
    $id = htmlspecialchars($_GET['id']) ?? '';
    $post = find_post_by_id($id); 
    if($post['user_id'] !== $_SESSION['user_id']){
        $_SESSION['message'] = "Unauthorized!";
        redirect_to(url_for("/user-dashboard"));
        exit;
    }   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo url_for("/css/public.css") ?>">
    <title>Delete Post</title>
</head>
<body class="dark-bg">
    <section class="delete-container">
        <p class="delete-warning">Do you really want to delete this post?</p>
        <h1 class="delete-post-title"><?php echo htmlspecialchars($post['post_title']); ?></h1>
        <div class="delete-actions">
            <a class="cancel-delete-btn" href="<?php echo url_for("/user-dashboard") ?>">Cancel</a>
            <a class="delete-btn" href="<?php echo url_for("/post/delete.php?id={$id}") ?>">Confirm Delete</a>
        </div>
    </section>
    
</body>
</html>