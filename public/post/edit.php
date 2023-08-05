<?php
    include("../../private/initialize.php");
    require_login();
    $post_id = $_GET['id'] ?? '';
    $post = find_post_by_id($post_id);
    if($post['user_id'] !== $_SESSION['user_id']){
        $_SESSION['message'] = "Unauthorized!";
        redirect_to(url_for("/user-dashboard"));
        exit;
    }

    if(is_post_request()){
        // Update Post
        $id = $post_id; 
        $post_title = $_POST['post-title'] ?? '';
        $post_excerpt = $_POST['post-excerpt'] ?? '';
        $post_description = $_POST['post-description'] ?? '';
        $post_thumbnail = "Will Do Later";

        
            $result = update_post($id,$post_title,$post_excerpt,$post_description,$post_thumbnail);
            if($result === true){
                $_SESSION['message'] = "Post Updated Successfully!";

                redirect_to(url_for("/user-dashboard"));
            }else{
                $errors[] = $result;

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
    <?php echo display_errors($errors); ?>
    <form action="<?php echo url_for("/post/edit.php?id={$post_id}") ?>" class="create-post-form" method="POST">
        <input type="text" name="post-title" id="post-title" placeholder="Title" value="<?php echo $post['post_title']; ?>">
        <input type="text" name="post-excerpt" id="post-excerpt" placeholder="Except" value="<?php echo $post['post_excerpt']; ?>">
        <!-- <input type="file" name="post-image" id="post-image"> -->
        <textarea name="post-description" id="post-description" cols="30" rows="10" >
            <?php echo $post['post_description'];?>
        </textarea>
        <input type="submit" value="Update Post">
        <script>
            CKEDITOR.replace('post-description');
        </script>
    </form>
    
</body>
</html>