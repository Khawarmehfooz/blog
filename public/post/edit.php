<?php
    include("../../private/initialize.php");
    require_login();
    $post_id = htmlspecialchars($_GET['id']) ?? '';
    $post = find_post_by_id($post_id);
    if($post['user_id'] !== $_SESSION['user_id']){
        $_SESSION['message'] = "Unauthorized!";
        redirect_to(url_for("/user-dashboard"));
        exit;
    }
    $current_post_thumbnail_name = htmlspecialchars($post['post_thumbnail']);

    if(is_post_request()){
        // Update Post
        $id = $post_id; 
        $post_title = htmlspecialchars($_POST['post-title']) ?? '';
        $post_excerpt = htmlspecialchars($_POST['post-excerpt']) ?? '';
        $post_description =htmlspecialchars($_POST['post-description']) ?? '';
        $post_thumbnail_path = "";
        

        if(is_blank($post_title)){
            $errors[] = "Post Title cannot be blank!";
        }
        if(has_length_greater_than($post_title,170)){
            $errors[]="Post title lenght must be less than 170 characters";
        }
        if(is_blank($post_excerpt)){
            $errors[] = "Post Excerpt cannot be blank!";
        }
        if(has_length_greater_than($post_excerpt,250)){
            $errors[]= "Excerpt Lenght must be less than 250 characters";
        }
        if(is_blank($post_description)){
            $errors[] = "Post Description cannot be blank!";
        }
        if(is_blank($post_thumbnail_path)){
            $post_thumbnail_path = $current_post_thumbnail_name;
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
            // echo ;
            $res = move_uploaded_file($post_thumbnail_temp_path,$destination);
            if($res){
                $_SESSION['message'] = "Thumbnail Uploaded";
            }else{
                echo "Error";
            }
        }else{
            echo UPLOAD_ERR_NO_FILE;
        }

        if(empty($errors)){
            $result = update_post($id,$post_title,$post_excerpt,$post_description,$post_thumbnail_path);
            if($result === true){
                $_SESSION['message'] = "Post Updated Successfully!";
                redirect_to(url_for("/user-dashboard"));
            }else{
                $errors[] = $result;

            }
        }
    }else{

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo url_for("/css/public.css") ?>">
    <script src="<?php echo url_for("ckeditor/ckeditor.js") ?>"></script>
    <title>Edit Post</title>
</head>
<body class="dark-bg">
    <header class="create-post-header">
        <section>
            <h1>Edit Post</h1>
            <a role="button" href="<?php echo url_for("/") ?>">Cancel</a>
        </section>
    </header>
    <div class="message-container">
        <?php echo display_errors($errors); ?>
    </div>
    <form action="<?php echo url_for("/post/edit.php?id={$post_id}") ?>" class="create-post-form" method="POST" enctype="multipart/form-data">
        <input type="text" name="post-title" id="post-title" placeholder="Title" value="<?php echo htmlspecialchars($post['post_title']); ?>">
        <input type="text" name="post-excerpt" id="post-excerpt" placeholder="Except" value="<?php echo htmlspecialchars($post['post_excerpt']); ?>">
        <h2>Current Thumbnail</h2><br>
        <img src="<?php echo url_for("/post/uploads/{$current_post_thumbnail_name}")?>" id="current-thumbnail" alt=""><br>
        <label for="post-thumbnail"><h2>Choose New Thumbnail</h2></label>
        <input type="file" name="post-thumbnail" id="post-thumbnail" accept="image/*" value="<?php echo url_for("/post/uploads/{$post['post_thumbnail']}") ?>">
        <textarea name="post-description" id="post-description" cols="30" rows="10" >
            <?php echo htmlspecialchars($post['post_description']);?>
        </textarea>
        <input type="submit" value="Update Post">
        <script>
            CKEDITOR.replace('post-description');
        </script>
    </form>
    
</body>
</html>