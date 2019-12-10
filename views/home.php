<?php if(!defined('APP_VERSION')){exit;}?>
<?php    
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        redirect('login');
        exit;
    }
    
    $albums = get_album_list();
?>
<?php include_once "_header.php";?>
<div class="page page-home">
<h1>Home</h1>
<?php if ($albums->num_rows <= 0) : ?>
    <div class="alert alert-warning">
        There is no album yet.
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