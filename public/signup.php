<?php 
    require_once('../private/initialize.php'); 
    if(is_post_request()){
        $username = $_POST['username'];
        $email = $_POST['signup-email'];
        $password = $_POST['signup-password'];
        $confirm_password = $_POST['confirm-signup-password'];

        $new_user = new User($username,$email,$password);
        if($new_user->createUser()){
            echo "<pre>";
            var_dump($new_user);
            echo "</pre>";    
        } 
        

    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo url_for("/css/public.css") ?>">
        <title>Blog - Sign Up</title>
    </head>
    <body class="dark-bg">
        <section class="login">
            <header class="login-header">
                <a class="login-brand" href="<?php echo url_for("/") ?>">Blog</a>
                <a class="signup-btn" href="<?php echo url_for("/login.php") ?>">Log in</a>
            </header>
            <h1>Sign Up</h1>
            <form action="signup.php" class="login-form" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="signup-email" id="email" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="signup-password" id="password" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" name="confirm-signup-password" id="confirm-password" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="submit" value="Sign Up">
                </div>
            </form>
        </section>
    </body>
</html>