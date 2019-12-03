<?php if (!defined('APP_VERSION')) { exit; } ?>
<?php

header("Contet-Type: application/json; charset=UTF-8");
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id == null) {
    http_response_code(404);
    $response_array = [
        'errors' => ['Page not found']
    ];
    $response = json_encode($response_array);
    die($response);
}


$album = get_album_by_id($id);
if ($album == null) {
    db_close();
    http_response_code(404);
    die(json_encode([ 'errors' => ['Album not found'] ]));
}

$errors = [];

if (!isset($_FILES['audiofile']['name']) || $_FILES['audiofile']['size'] <= 0) {
    db_close();
    http_response_code(400);
    $response_array = [
        'errors' => [ 'Audio file is required.' ]
    ];
    $response = json_encode($response_array);
    die($response);
}

$allowedFormats = [ "audio/mp3" ];

if (!in_array($_FILES['audiofile']['type'], $allowedFormats)) {
    $errors[] = "The selected file format is not allowed. Try one of these: " . implode(", ", $allowedFormats);
}
if (select_music_by_name($_FILES['audiofile']['name'])['name'] == $_FILES['audiofile']['name']) {
    $errors[] = "The selected file already exists.";
}
if (count($errors) > 0) {
    http_response_code(400);
    die(json_encode([
        "errors" => $errors
    ]));
} else {
    $name=$_FILES['audiofile']['name'];
    $type=$_FILES['audiofile']['type'];
    $data=file_get_contents($_FILES['audiofile']['tmp_name']);
    
    $query="INSERT INTO `musics` (name,type,data,album_id) VALUES(:name,:type,:data,:album_id)";
    $params=[
        
        ':name'=>$name,
        ':type'=>$type,
        ':data'=>$data,
        ':album_id'=>$id
      
    ];

    $success = executeDML($query, $params);
   
    $response_array = [
        'filename' => $_FILES['audiofile']['name'],
        'message' => 'Audio file uploaded successfully'
    ];
    http_response_code(200);
    die(json_encode($response_array));
    
}


?>