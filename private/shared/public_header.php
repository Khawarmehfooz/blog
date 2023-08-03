<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo url_for('/css/public.css') ?>">
        <title>Blog</title>
    </head>
    <body>
        <header >
            <nav class="">    
                    <div class="navbar">
                        <form action="" class="search-form">
                            <input autocomplete="off" type="search" name="search" id="search" placeholder="Search">
                        </form>
                        <a class="brand" href="<?php echo url_for("/") ?>">Blog</a>
                        <div class="cta-btns">
                            <?php
                                if(!is_user_logged_in()){ ?>
                                <a class="login-btn" role="button" href="<?php echo url_for("/login.php") ?>">Login</a>
                                <a class="signup-btn" role="button" href="<?php echo url_for("/signup.php") ?>">Sign Up</a>
                            <?php }else{ ?>
                                <a class="dashboard-btn" role="button" href="<?php echo url_for("/user-dashboard") ?>">Dashboard</a>      
                             <?php } ?>
                        </div>
                    </div>
            </nav>
        </header>
