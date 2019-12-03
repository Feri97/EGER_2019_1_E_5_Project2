<?php if (!defined('APP_VERSION')) { exit; } ?>
<?php include "_header.php"; ?>
<div class="page table">
    <table><td><tr>
    
    <?php if($album['cover']) : ?>
        <img src="<?= asset("img/uploads/{$album['cover']}"); ?>" alt="<?php echo $album['title']; ?>" onload="resizeImg(this, 300, 300);">
    <?php else : ?>
        <img src="https://via.placeholder.com/300" alt="<?php echo $album['title']; ?>">
	<?php endif; ?>
	<h1> Edit album - <?php echo $album['title']; ?></h1>
    
    </tr></td><td><tr>
        <a href="<?php echo url('details', ['id' => $album['id']]); ?>" style="font-size:22px;"><i class="fa fa-caret-left" alt="Back"></i></a>
        </tr>
        <?php if($_SESSION["id"] == select_album_col($id)['user_id']) : ?>
		<tr><a href="<?php echo url('delete-album', ['id' => $album['id']]); ?>" style="font-size:20px;" ><i class="fa fa-trash" alt="Delete album"></i></a>
		</tr>
		<?php endif; ?>
    </td></table>
</div>
<div class="page page-edit">
    <?php if (isset($_GET['success'])) : ?>
        <div class="alert alert-success">
            <p>Album saved successfully.</p>   
        </div>
    <?php endif; ?>
    
    <form id="cover-upload" action="<?php echo url('upload-cover', ['id' => $album['id']]); ?>" method="POST" enctype="multipart/form-data">
        
        <div id="upload-response"></div>
        <div class="form-group">
            <label for="image">Cover image</label>
            <input type="file" name="image">
        </div>
        <div class="form-group">
        <button class="btn" type="submit">Upload</button>
        </div>
    </form>
    
    <form action="<?php echo url('edit', ['id' => $id]); ?>" method="POST">
    
    <div class="form-group<?php echo isset($errors['artist'])?" has-error":"" ?>">
        <label for="artist">Artist</label>
        <input class="form-input" type="text" name="artist" value="<?php echo isset($artist)?$artist:''; ?>">
        <?php if (isset($errors['artist'])) : ?>
            <?php foreach($errors['artist'] as $error) : ?>
                <p class="input-error"><?php echo $error; ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="form-group<?php echo isset($errors['year'])?" has-error":"" ?>">
        <label for="year">Year</label>
        <input class="form-input" type="number" name="year" value="<?php echo isset($year)?$year:''; ?>">
        <?php if (isset($errors['year'])) : ?>
            <?php foreach($errors['year'] as $error) : ?>
                <p class="input-error"><?php echo $error; ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="form-group<?php echo isset($errors['title'])?" has-error":"" ?>">
        <label for="title">Album</label>
        <input class="form-input" type="text" name="title" value="<?php echo isset($title)?$title:''; ?>">
        <?php if (isset($errors['title'])) : ?>
            <?php foreach($errors['title'] as $error) : ?>
                <p class="input-error"><?php echo $error; ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
        <div class="form-group">
            <button class="btn" type="submit" name="save">Save</button>
        </div>
</form>

</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
<!-- if? -->
<script src="<?php echo asset('js/upload-audio.js'); ?>"></script>
<script src="<?php echo asset('js/upload-image.js'); ?>"></script>

<?php include "_footer.php"; ?>