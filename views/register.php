<?php if(!defined('APP_VERSION')){exit;}?>
<?php
require_once "config.php";
 
$username = $password = $confirm_password = $email = "";
$username_err = $password_err = $confirm_password_err = $email_err = "";

 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = trim($_POST["confirm_password"]);

    if(empty($username)){
        $username_err = "Please enter a username.";
    } else{
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $username);
            
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $username_err = "This username is already taken.";
                } 
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        $stmt->close();
    }
    
    if(empty($email)){
        $email_err = "Please enter an email address.";
    }else{
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = "Invalid email format";
        }
    }

    if(empty($password)){
        $password_err = "Please enter a password.";     
    } elseif(strlen($password) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } 

    if(empty($confirm_password)){
        $confirm_password_err = "Please confirm password.";     
    } else{
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
         
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ss", $username, $param_password, $email);
            
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                redirect('login');
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        $stmt->close();
    }
    
    $mysqli->close();
}
?>
 
<?php include_once "_header.php";?>
    <div class="page page-register">
        <h1>Sign Up</h1>
        <h2>Please fill this form to create an account.</h2>
        <form action="<?php echo url('register'); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-input" value="<?php echo $username; ?>">
                <span class="input-error"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>E-mail address</label>
                <input type="email" name="email" class="form-input" value="<?php echo $email; ?>">
                <span class="input-error"><?php echo $email_err; ?></span>
            </div>  
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-input" >
                <span class="input-error"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-input" >
                <span class="input-error"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" value="Submit">
                <!--<input type="reset" class="btn" value="Reset">-->
            </div>
            <p>Already have an account? <a href="<?php echo url('login'); ?>">Login here</a>.</p>
        </form>
    </div>  
    <?php include_once "_footer.php";?>