<?php 
    include("../../private/initialize.php"); 
    require_login();
    $posts_set = find_own_post();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo url_for("/css/public.css") ?>">
    <title>Dashboard</title>
</head>
<body class="dark-bg">
    <header class="dashboard-header">
        <nav class="dashboard-navbar">
            <h1 class="dashboard-title">Welcome to Blog</h1>
            <a class="login-btn" href="<?php echo url_for("/logout.php") ?>">Logout</a>
        </nav>
    </header>
    <main>
        <section class="dashboard-content">
            <p class="welcome-message">Welcome Back <?php echo $_SESSION['username'] ?></p>
            <?php 
                echo display_session_message();
            ?>
            <div class="flex space-between align-center">
                <a class="home-btn" role="button" href="<?php echo url_for("/") ?>">Home</a>
                <a class="create-post-btn" role="button" href="<?php echo url_for("/post/new.php") ?>">Create Post</a>
            </div>

            
            <h2 class="recent-title">Recent Posts</h2>
            <table class="recent-post-table" border="1">
                <tr>
                    <th>Post Title</th>
                    <th colspan="3">Actions</th>
                </tr>
                <?php while($post = mysqli_fetch_assoc($posts_set)){ ?>
                <tr>
                    <td><?php echo $post['post_title']; ?></td>
                    <td>
                        <a class="view-btn" href="<?php echo url_for("/post/view.php?id={$post['id']}"); ?>">View</a>
                    </td>
                    <td>
                        <a class="edit-btn" href="<?php echo url_for("/post/edit.php?id={$post['id']}"); ?>">Edit</a>
                    </td>
                    <td>
                        <a class="delete-btn" href="<?php echo url_for("/post/confirm-delete.php?id={$post['id']}") ?>">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </section>
    </main>
    
</body>
</html>