<?php if(!defined('APP_VERSION')){exit;}?>
<?php    
    $albums = get_album_list();
?>
<?php include_once "_header.php";?>
<div class="page page-home">
<h1>Home</h1>
<?php if ($albums->num_rows <= 0) : ?>
    <div class="alert alert-warning">
        Nincs megjelenítendő album.
    </div>
<?php else : ?>
    <div class="album-list">
        <?php while ($album = $albums->fetch_assoc()) : ?>
            <?php include "_album_list_item.php"; ?>
        <?php endwhile; ?>
    </div>
<?php endif; ?>
</div>
<?php include_once "_footer.php";?>