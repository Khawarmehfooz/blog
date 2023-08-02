<?php include("../../private/initialize.php"); ?>
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
        <h1 class="delete-post-title">Behind Blog's New Design System</h1>
        <div class="delete-actions">
            <a class="cancel-delete-btn" href="<?php echo url_for("/user-dashboard") ?>">Cancel</a>
            <a class="delete-btn" href="<?php echo url_for("/post/delete.php") ?>">Confirm Delete</a>
        </div>
    </section>
    
</body>
</html>