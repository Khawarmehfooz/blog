<?php require_once('../private/initialize.php'); ?>
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
                <a class="signup-btn" href="<?php echo url_for("/signup.php") ?>">Sign up</a>
            </header>
            <h1>Log in</h1>
            <form action="" class="login-form">
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