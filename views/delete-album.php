<?php if (!defined('APP_VERSION')) { exit; } ?>
<?php

$id = isset($_GET['id']) ? $_GET['id'] : null;

unlink("img/uploads/" .select_album_col($id)['cover']);

global $db;

    $sql = $db->prepare("DELETE FROM `musics` WHERE album_id = ?");
    $sql->bind_param('i', $id);
    $sql->execute();
    $sql->close();

    if (select_music_by_album($id)==null) {

    $sql = $db->prepare("DELETE FROM `albums` WHERE id = ?");
    $sql->bind_param('i', $id);
    $sql->execute();

    $sql->close();
        
    }

    redirect();




?>