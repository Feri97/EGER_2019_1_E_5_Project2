<?php if(!defined('APP_VERSION')) {exit;} ?>
<?php
    $url = url('details', ['id' => $album['id']]);
?>
<div class="album">
    <a href="<?php echo $url; ?>">
        <?php if($album['cover']) : ?>
            <img src="<?= asset("img/uploads/{$album['cover']}"); ?>" alt="<?php echo $album['title']; ?>" width="260" height="260">
        <?php else : ?>
            <img src="<?= asset("image/placeholder.gif"); ?>" alt="<?php echo $album['title']; ?>" width="260" height="260">
        <?php endif; ?>
    <p class="album-title" title="<?php echo $album['title']; ?>">
        <a href="<?php echo $url; ?>">
            <?php echo $album['title']; ?>
        </a>
    </p>
    <p class="album-meta">
        <?php echo $album['artist']; ?>(<?php echo $album['year']; ?>)
    </p>
</div>