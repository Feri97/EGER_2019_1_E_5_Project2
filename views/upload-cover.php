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


if (!isset($_FILES['image']) || $_FILES['image']['size'] <= 0) {
    db_close();
    http_response_code(400);
    $response_array = [
        'errors' => [ 'Cover image is required' ]
    ];
    $response = json_encode($response_array);
    die($response);
}

$target_dir = BASE_PATH . "/img/uploads/";
$target_file = $target_dir . basename($_FILES['image']['name']);
$imageFileType = strtolower(
    pathinfo($target_file, PATHINFO_EXTENSION)
);


//NOTE: feltöltött fájl kép
$check = getimagesize($_FILES['image']['tmp_name']);
if ($check === false) {
    $errors[] = "Selected file is not an image. File type: {$check['mime']}.";
}

//NOTE: feltöltött kép létezik
if (file_exists($target_file)) {
    $errors[] = "The selected file already exists.";
}
?>