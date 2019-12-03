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

//NOTE: fájl méret
if ($_FILES['image']['size'] > (MAX_UPLOAD_SIZE * 1000000)) {
    $errors[] = "The seleceted file is too large.";
}

//NOTE: kiterjesztés
$allowedFormats = [ "jpg", "png", "jpeg", "gif" ];

if (!in_array($imageFileType, $allowedFormats)) {
    $errors[] = "The selected file format is not allowed. Try one of these: " . implode(", ", $allowedFormats);
}

if (count($errors) > 0) {
    http_response_code(400);
    die(json_encode([
        "errors" => $errors
    ]));
} else {
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        if(select_album_col($id)['cover'] != null){
            unlink("img/uploads/" .select_album_col($id)['cover']);
        }
        $sql = $db->prepare("UPDATE albums SET cover=? WHERE id=?");
        //NOTE: saving image name in cover column
        $sql->bind_param("si", $_FILES['image']['name'], $id);
        $sql->execute();
        $sql->close();

        db_close();

        $response_array = [
            "image_url" => asset("img/uploads/" . $_FILES['image']['name']),
            'message' => 'Image uploaded successfully'
        ];
        http_response_code(200);
        die(json_encode($response_array));
    } else {
        http_response_code(500);
        die(json_encode([ "errors" => "Something happend." ]));
    }
}


?>