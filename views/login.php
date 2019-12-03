<?php if(!defined('APP_VERSION')){exit;}?>
 
<?php include_once "_header.php";?>
    <div class="page page-login">
        <h1>Login</h1>
        <h2>Please fill in your credentials to login.</h2>
        <form action="<?php echo url('login'); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-input" value="<?php echo $username; ?>">
                <span class="input-error"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-input">
                <span class="input-error"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" value="Login">
            </div>
            <p>Don't have an account? <a href="<?php echo url('register'); ?>">Sign up now</a>.</p>
        </form>
    </div>    
<?php include_once "_footer.php"; ?>