<?php
    include("../../private/initialize.php");
    require_login();
    if(is_post_request()){
        $user_id = $_SESSION['user_id'];
        $post_title = $_POST['post-title'];
        $post_excerpt = $_POST['post-excerpt'];
        $post_description = $_POST['post-description'];
        $publish_date = date('F j, Y');
        $post_thumbnail = "Will Add Later";

        if(is_blank($post_title)){
            $errors[] = "Post title cannot be blank.";
        }
        if(is_blank($post_excerpt)){
            $errors[] = "Post Excerpt cannot be blank.";
        }
        if(is_blank($post_description)){
            $errors[] = "Post description cannot be blank.";
        }
        $Post = new Post($post_title,$post_excerpt,$post_description,$publish_date,$post_thumbnail);
        if(empty($errors)){
            $result = $Post->createPost();
            if($result === true){
                $Post_id = mysqli_insert_id($db);
                $_SESSION['message'] = "New Post Created Successfully";
                redirect_to(url_for("/user-dashboard"));
            }else{
                $errors[] = $result;
            }
        }
    }
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
    <div class="message-container">
        <?php 
            echo display_errors($errors);
            echo display_session_message();
        ?>
    </div>
    
    <form action="new.php" class="create-post-form" method="POST">
        <input type="text" name="post-title" id="post-title" placeholder="Title">
        <input type="text" name="post-excerpt" id="post-excerpt" placeholder="Except">
        <!-- <input type="file" name="post-image" id="post-image"> -->
        <textarea name="post-description" id="post-description" cols="30" rows="10"></textarea>
        <input type="submit" value="Publish">
        <script>
            CKEDITOR.replace('post-description');
        </script>
    </form>
    
</body>
</html>