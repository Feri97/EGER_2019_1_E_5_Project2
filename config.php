<?php if(!defined('APP_VERSION')){exit;}?>
<?php

define('DOMAIN', 'http://localhost/PROJECTPLAYER/');
define('BASE_PATH', __DIR__);

define('MAX_UPLOAD_SIZE', 5);

//database settings
define('BASE_DIR','./');




define('DB_TYPE','mysql');
define('DB_CHARSET', 'utf8');


define('DB_HOST', 'localhost:3306');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'musicp');
 
/* Attempt to connect to MySQL database */
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
?>