<?php if (!defined('APP_VERSION')) { exit; } ?>
<?php

function dump($varibale) {
    echo "<pre>";
    print_r($varibale);
    echo "</pre>";
}

function dd($varibale) {
    dump($varibale);
    die("END");
}

function asset($asset) {
    return DOMAIN . $asset;
}

function url($page = 'home', $params = []) {
    $url = DOMAIN . "?p={$page}";
    if (is_array($params)) {
        foreach ($params as $key => $value) {
            $url .= "&$key=$value";
        }
    }
    return $url;
}

function redirect($page = 'home', $params = []) {
    $url = url($page, $params);
    header("Location: $url");
    die();
}

function is_post() {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function html_errors($key) {
    global $errors;

    $html = "";
    if (isset($errors[$key])) {
        foreach ($errors[$key] as $error) {
            $html .= "<p class='input-error'>$error</p>";
        }
    }
    return $html;
}

function db_connect()
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Connection failed: {$conn->connect_error}");
    }

    return $conn;
}

function db_close()
{
    global $db;

    $db->close();
}

function get_album_list()
{
    global $db;

    $sql = $db->prepare("SELECT * FROM albums");
    $sql->execute();


    $result = $sql->get_result();

    $sql->close();

    return $result;
}


?>