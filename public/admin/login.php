<?php 
    require_once('../../private/initialize.php'); 

    $errors = [];
    $email = [];
    $password = [];
    if(is_post_request()){
        $email = htmlspecialchars($_POST['login-email']);
        $password = htmlspecialchars($_POST['login-password']);

        if(is_blank($email)){
            $errors[] = "Email Cannot be blank!"; 
        }
        if(is_blank($password)){
            $errors[] = "Password cannot be blank!";
        }
        if(empty($errors)){
            $admin = find_admin_by_email($email);
            if($admin){
                if(password_verify($password,$admin['hashed_password'])){
                    log_in_admin($admin['id'],$admin['username']);
                    redirect_to(url_for("/admin"));

                }else{
                    // username found, but password does not match
                    $errors[] = "Log in was unsuccessful.";
                }

            }else{
                // No Username found
                    $errors[] = "Log in was unsuccessful.";
            }
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo url_for("/css/public.css") ?>">
        <title>Blog - Login</title>
    </head>
    <body class="dark-bg">
        <section class="login">
            <header class="login-header">
                <a class="login-brand" href="<?php echo url_for("/") ?>">Blog</a>
            </header>
            <?php 
                echo display_session_message(); 
                echo display_errors($errors);
            ?>

            <h1>Log in</h1>
            <form action="<?php echo url_for("/admin/login.php") ?>" class="login-form" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="login-email" id="email" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="login-password" id="password" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="submit" value="Login">
                </div>
            </form>
        </section>
    </body>
</html>