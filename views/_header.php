<?php if(!defined('APP_VERSION')){exit;}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ProjectPlayer</title>
    <link rel="stylesheet" href="<?php echo asset("css/app.css") ?>">
    <link rel="stylesheet" href="<?php echo asset("css/jplayer.blue.monday.css") ?>">
    <link rel="shortcut icon" href="<?php echo asset("image/play-icon.png") ?>">
</head>
<body>
    <header>
        <div class="container">
            <a class="logo" 
                href="<?php echo isset($_SESSION["loggedin"]) 
                && $_SESSION["loggedin"] === true ?
                url() : url('welcome') ;?>">
            <i class="fa fa-home"></i></a>
            <nav>
                <ul>
                    <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
                    <li>
                        <a <?php echo $page == 'home' ? 'class="active"' : ''; ?> href="<?php echo url(); ?>">Home</a>
                    </li>
                    <li>
                        <a <?php echo $page == 'upload' ? 'class="active"' : ''; ?> href="<?php echo url('upload'); ?>">Upload</a>
                    </li>
                    <?php endif; ?>
                    
                    <li>
                        <a <?php echo $page == 'about' ? 'class="active"' : ''; ?> href="<?php echo url('about'); ?>">About</a>
                    </li>
                    <li>
                        <a <?php echo $page == 'contact' ? 'class="active"' : ''; ?> href="<?php echo url('contact'); ?>">Contact</a>
                    </li>

                    <li>
                    <div class="dropdown">
                        <button class="dropbtn"><i class="fa fa-cog"></i></button>
                            <div class="dropdown-content">

                                <?php if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true): ?>
                                    <a <?php echo $page == 'login' ? 'class="active"' : ''; ?> href="<?php echo url('login'); ?>">Login</a>
                                    <a <?php echo $page == 'register' ? 'class="active"' : ''; ?> href="<?php echo url('register'); ?>">Create account</a>
                                <?php endif; ?>

                                <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
                                    <a <?php echo $page == 'reset-password' ? 'class="active"' : ''; ?> href="<?php echo url('reset-password'); ?>">Reset password</a>
                                    <a <?php echo $page == 'logout' ? 'class="active"' : ''; ?> href="<?php echo url('logout'); ?>">Logout</a>
                                <?php endif; ?>

                            </div>
                    </div>
                    </li>
                </ul>
            </nav>
            
        </div>
    </header>
    <main class="container">