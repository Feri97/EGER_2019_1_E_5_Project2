
<?php
session_start();
define('APP_VERSION', '1.0.0');

include_once "config.php";
include_once "functions.php";

include_once "database.php";


$page = isset($_GET['p']) ? $_GET['p'] : 'welcome';

$db = db_connect();

if (file_exists("./views/{$page}.php")){
    include_once "./views/{$page}.php";
} else{
    include_once "./views/404.php";
}

db_close();
?>