<?php if(!defined('APP_VERSION')) {exit;} ?>
<?php
    $url = url('details', ['id' => $album['id']]);
?>
<div class="album">
    <a href="<?php echo $url; ?>">
        <?php if($album['cover']) : ?>
            <img src="<?= asset("img/uploads/{$album['cover']}"); ?>" alt="<?php echo $album['title']; ?>" onload="resizeImg(this, 300, 300);">
        <?php else : ?>
            <img src="https://via.placeholder.com/300" alt="<?php echo $album['title']; ?>">
        <?php endif; ?>
        <img src="">
    <p class="album-title" title="<?php echo $album['title']; ?>">
        <a href="<?php echo $url; ?>">
            <?php echo $album['title']; ?>
        </a>
    </p>
    <p class="album-meta">
        <?php echo $album['artist']; ?>(<?php echo $album['year']; ?>)
    </p>
</div>