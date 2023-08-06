<?php 
    require_once('../private/initialize.php'); 
    if(is_post_request()){
        $username = $_POST['username'];
        $email = $_POST['signup-email'];
        $password = $_POST['signup-password'];
        $confirm_password = $_POST['confirm-signup-password'];

        if(is_blank($username)){
            $errors[] = "Username cannot be blank!";
        }
        if(is_blank($email)){
            $errors[] = "Email cannot be blank!";
        }
        if($password){
            if(is_blank($password)){
                $errors[] = "Password cannot be blank!";
            }elseif(!has_length($password,array('min'=>8))){
                $errors[] = "Password must contain 8 or more characters";
            }elseif(!preg_match('/[A-Z]/',$password)){
                $errors[]= "Password must contains at least 1 uppercase character.";

            }elseif(!preg_match('/[a-z]/',$password)){
                $errors[]= "Password must contains at least 1 lowercase character.";

            }elseif(!preg_match('/[0-9]/',$password)){
                $errors[]= "Password must contains at least 1 number.";

            }elseif(!preg_match('/[^A-Za-z0-9\s]/',$password)){
                $errors[]= "Password must contains at least 1 symbol.";
            }


        }
        if(is_blank($confirm_password)){
            $errors[] = "Confirm Password cannot be blank!";
        }
        if($password !== $confirm_password){
            $errors[] = "Password doesnot Match!";
        }

        if(empty($errors)){
            $new_user = new User($username,$email,$password);
            $result = $new_user->createUser(); 
            if( $result === true){
                $new_user_id = mysqli_insert_id($db);
                $_SESSION['message'] = "Account created successfully.";
                redirect_to(url_for("/login.php"));    
            } else{
                $errors[] = $result;
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
        <title>Blog - Sign Up</title>
    </head>
    <body class="dark-bg">
        <section class="login">
            <header class="login-header">
                <a class="login-brand" href="<?php echo url_for("/") ?>">Blog</a>
                <a class="signup-btn" href="<?php echo url_for("/login.php") ?>">Log in</a>
            </header>
            <?php echo display_errors($errors); ?>
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
                    <span>Password must contains Uppercase Character, Lowercase Character, Number and symbol</span>
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