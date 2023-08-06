<?php
    include("../../private/initialize.php");
    require_login();
    if(is_post_request()){
        $user_id = htmlspecialchars($_SESSION['user_id']);
        $post_title = htmlspecialchars($_POST['post-title']);
        $post_excerpt = htmlspecialchars($_POST['post-excerpt']);
        $post_description = htmlspecialchars($_POST['post-description']);
        $publish_date = date('F j, Y');
        $post_thumbnail_path = "";
        
        if(is_blank($post_title)){
            $errors[] = "Post title cannot be blank.";
        }
        if(strlen($post_title) > 170){
            $errors[]="Post title lenght must be less than 170 characters";
        }
        if(is_blank($post_excerpt)){
            $errors[] = "Post Excerpt cannot be blank.";
        }
        if(strlen($post_excerpt) >= 170){
            $errors[]= "Excerpt Lenght must be less than 170 characters";
        }
        if(is_blank($post_description)){
            $errors[] = "Post description cannot be blank.";
        }
        // File Uploading
        $post_thumbnail = $_FILES['post-thumbnail'];
        $post_thumbnail_name = $post_thumbnail['name'];
        $post_thumbnail_temp_path = $post_thumbnail['tmp_name'];
        $post_thumbnail_error = $post_thumbnail['error'];

        if($post_thumbnail_error===UPLOAD_ERR_OK && empty($errors)){
            $thumbnail_upload_directory = getcwd() . "/uploads/";
            $unique_thumbnail_name = uniqid(). "-" . $post_thumbnail_name;
            $destination = $thumbnail_upload_directory . $unique_thumbnail_name;
            $post_thumbnail_path = $unique_thumbnail_name;
            $res = move_uploaded_file($post_thumbnail_temp_path,$destination);
        }else{
            echo UPLOAD_ERR_NO_FILE;
        }
        $Post = new Post($post_title,$post_excerpt,$post_description,$publish_date,$post_thumbnail_path);
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
    
    <form action="new.php" class="create-post-form" method="POST" enctype="multipart/form-data">
        <input type="text" name="post-title" id="post-title" placeholder="Title">
        <input type="text" name="post-excerpt" id="post-excerpt" placeholder="Except">
        <label for="post-thumbnail">Thumbnail</label>
        <input type="file" name="post-thumbnail" id="post-thumbnail" accept="image/*">
        <textarea name="post-description" id="post-description" cols="30" rows="10"></textarea>
        <input type="submit" value="Publish">
        <script>
            CKEDITOR.replace('post-description');
        </script>
    </form>
    
</body>
</html>