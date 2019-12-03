<?php
// Initialize the session
//session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    redirect('home');
    exit;
}


?>
 <?php include_once "_header.php"?>
    <div class="page page-welcome">
        <h1 style="font-size: 50px; line-height: 150%;">Welcome to our site.</h1>
        <p style="text-align: center; font-size:25px; line-height: 150%">Would you like to have fun and find your peace of mind at the same time? Just follow three step.</p>
        <table style="width:100%;">
          <th><img src="image/register.png" > <br>First you just have to register</th>
          <th><img src="image/login.png" > <br> Then Log in</th>
          <th><img src="image/listentomusic.jfif" ><br> And you can already listen to the music</th>
        </table>
    </div>
<?php include_once "_footer.php"?>