<?php 
    include("../../private/initialize.php"); 
    require_admin_login();
    $result_set = get_joined_post_user();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo url_for("/css/public.css") ?>">
    <title>Dashboard</title>
    <style>
        .dashboard{
            width:90%;
            margin-inline:auto;
        }
        .admin-dashboard-header {
            border-bottom: 2px solid var(--white);
            margin-bottom: 3rem;
        }
        .admin-dashboard-navbar{
            width: 90%;
            margin-inline:auto;
            display: flex;
            align-items: center;
            justify-content: space-between;

            
        }
        .logout-btn{
            color: white;
        }
        .menu {
            display:flex;
            gap:2rem;
            align-items:center;
            border-bottom: 1px solid white;
            margin-bottom: 1rem;
        }
        .menu a{
            color:white;
            font-size: clamp(18px,20px,24px);
        }


    </style>
</head>
<body class="dark-bg">
    <header class="admin-dashboard-header">
        <nav class="admin-dashboard-navbar">
            <h1 class="dashboard-title">Welcome to Blog</h1>
            <a class="logout-btn" href="<?php echo url_for("admin/logout-admin.php") ?>">Logout</a>
        </nav>
    </header>
    <main>
        <section class="dashboard">
            <p class="welcome-message">Welcome Back <?php echo $_SESSION['username'] ?></p>
            <?php 
                echo display_session_message();
            ?>
            <h2 class="recent-title">Recent Updates</h2>
            <table class="recent-post-table" border="1">
                <tr>
                    <th>Post Title</th>
                    <th>Post Author</th>
                    <th>Publish Date</th>
                    <th>Actions</th>
                </tr>
                <?php while($post = mysqli_fetch_assoc($result_set)){ ?>
                <tr>
                    <td><?php echo $post['post_title']; ?></td>
                    <td>
                        <?php echo $post['username'] ?>
                    </td>
                    <td>
                        <?php echo $post['publish_date'] ?>
                    </td>
                    <td>
                        <a class="view-btn" href="<?php echo url_for("/post/view.php?id={$post['id']}"); ?>">View</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </section>
    </main>
    
</body>
</html>