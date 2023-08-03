<?php
    include("../../private/initialize.php");
    require_login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo url_for("/css/public.css") ?>">
    <script src="<?php echo url_for("ckeditor/ckeditor.js") ?>"></script>
    <title>Create Post</title>
</head>
<body class="dark-bg">
    <header class="create-post-header">
        <section>
            <h1>New Post</h1>
            <a role="button" href="<?php echo url_for("/") ?>">Cancel</a>
        </section>
    </header>
    <form action="" class="create-post-form">
        <input type="text" name="post-title" id="post-title" placeholder="Title">
        <input type="text" name="post-excerpt" id="post-excerpt" placeholder="Except">
        <input type="file" name="post-image" id="post-image">
        <textarea name="post-description" id="post-description" cols="30" rows="10"></textarea>
        <input type="submit" value="Publish">
        <script>
            CKEDITOR.replace('post-description');
        </script>
    </form>
    
</body>
</html>