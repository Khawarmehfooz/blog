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
                            <a class="login-btn" role="button" href="<?php echo url_for("/login.php") ?>">Login</a>
                            <a class="signup-btn" role="button" href="#">Sign Up</a>
                        </div>
                    </div>
            </nav>
        </header>
