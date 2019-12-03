<?php if(!defined('APP_VERSION')){exit;}?>

<?php 
    $errors = [];
    if (is_post()){
        $title = $_POST['title'];
        $year = $_POST['year'];
        $artist = $_POST['artist'];
        $max_string_length = 255;

        if ($title == null){
            $errors['title'][] = "Album title is required";
        }else{
            if(strlen($title) <= 2 || $max_string_length < strlen($title)){
                $errors['title'][] = "Album title must be between 3 and 255";
            }
        }
        if ($artist == null){
            $errors['artist'][] = "Artist is required";
        }else{
            if($max_string_length < strlen($artist)){
                $errors['artist'][] = "Artist must be shorter than 255";
            }
        }
        if ($year == null){
            $errors['year'][] = "Year is required";
        } else{
            if(!is_numeric($year)){
                $errors['year'][] = "Year must be a number";
            }
            else{
                $curr_year = date('Y');
                if ($curr_year < $year || $year < 1900){
                    $errors['year'][] = "Invalid year (must be between 1900-$curr_year)";
                }
            }
        }
        
    if(count($errors)==0){
        
        $sql = $db->prepare("INSERT INTO `albums` (`artist`,`year`,`title`,`user_id`) values (?, ?, ?, ?)");
        $sql->bind_param('sisi',  $artist, $year, $title, $_SESSION["id"]);
        $sql->execute();
        $sql->close();
        
        $new_id = $db->insert_id;
        
        redirect('edit', ['id' => $new_id, 'success' => 1]);
        
    }


    }

?>

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