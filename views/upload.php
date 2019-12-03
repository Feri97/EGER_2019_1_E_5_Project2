<?php if(!defined('APP_VERSION')){exit;}?>


<?php include_once "_header.php";?>
<div class="page page-upload">
<h1>Upload</h1>
<form action="<?php echo url('upload'); ?>" method="POST">
    
    <div class="form-group<?php echo isset($errors['artist'])?" has-error":"" ?>">
        <label for="artist">Artist</label>
        <input class="form-input" type="text" name="artist" value="<?php echo isset($artist)?$artist:''; ?>">
        <?php echo html_errors('artist');?>
    </div>
    <div class="form-group<?php echo isset($errors['year'])?" has-error":"" ?>">
        <label for="year">Year</label>
        <input class="form-input" type="number" name="year" value="<?php echo isset($year)?$year:''; ?>">
        <?php echo html_errors('year');?>
    </div>
    <div class="form-group<?php echo isset($errors['title'])?" has-error":"" ?>">
        <label for="title">Album</label>
        <input class="form-input" type="text" name="title" value="<?php echo isset($title)?$title:''; ?>">
        <?php echo html_errors('title');?>
    </div>
        <div class="form-group">
            <button class="btn" type="submit">Upload</button>
        </div>
</form>

</div>
<?php include_once "_footer.php";?>