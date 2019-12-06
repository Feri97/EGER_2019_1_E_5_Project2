<?php if (!defined('APP_VERSION')) { exit; }?>

<?php
    if (!isset($_GET['id'])){
        redirect('404');
    }

    $album = get_album_by_id($_GET['id']);
    if ($album == null){
        redirect('404');
    }
	$id = isset($_GET['id']) ? $_GET['id'] : null;

?>
<?php 

function convert($type,$data){
	// $type = $row['type']; //or the actual mime type of the file
	 $base64blob = base64_encode($data); //encode to base64
	 $datauri = "data:$type;base64,$base64blob";
   return  $datauri;
}

    $namelist = array();
    $datalist= array();
    
    $query = "SELECT * FROM musics WHERE album_id=:albumid";
   
    $params = [':albumid' => $_GET['id']];
    require_once 'database.php';
    $records = getList($query, $params);
    
    foreach($records as $rows) {
        $namelist[] = $rows['name'];
    }
    
    foreach($records as $rows){
    $datalist[]=convert($rows['type'],$rows['data']);
    }
    
    if(array_key_exists('d', $_GET)) {
	
        $query1 =  "DELETE FROM `musics` WHERE id = :id" ;
        $params1 = [ 
            ':id' => $_GET['d'], 
        ];
        require_once 'database.php';
        $success = executeDML($query1, $params1);
        if($success) {
            $host = $_SERVER['HTTP_HOST'];
           
        }
        else echo 'delete in complete';
    
    
    }
	
	

    ?>


    <?php include_once "_header.php"; ?>




<div class="page page-details">
    <table><td><tr>
    <?php if($album['cover']) : ?>
        <img src="<?= asset("img/uploads/{$album['cover']}"); ?>" alt="<?php echo $album['title']; ?>" width="350" height="350">
    <?php else : ?>
        <img src="<?= asset("image/placeholder.gif"); ?>" alt="<?php echo $album['title']; ?>" width="350" height="350">
    <?php endif; ?>
    <h1> <?php echo $album['artist']; ?> - <?php echo $album['title']; ?></h1>
    </tr></td><td>
        <tr><a href="<?php echo url(); ?>" style="font-size:22px;"><i class="fa fa-caret-left"></i></a>
        </tr>
        <?php if($_SESSION["id"] == select_album_col($id)['user_id']) : ?>
        <tr><a href="<?php echo url('edit', ['id' => $album['id']]); ?>" style="font-size:20px;" alt="Edit album"><i class="fa fa-cog"></i></a>
        </tr>
        <?php endif; ?>
    </td></table>
</div>
<div class="player">
<div id="jquery_jplayer_1" class="jp-jplayer"></div>
<div id="jp_container_1" class="jp-audio" role="application" aria-label="media player">
    <div class="jp-type-playlist">
        <div class="jp-gui jp-interface">
            <div class="jp-controls">
                <button class="jp-previous" role="button" tabindex="0">previous</button>
                <button class="jp-play" role="button" tabindex="0">play</button>
                <button class="jp-next" role="button" tabindex="0">next</button>
                <button class="jp-stop" role="button" tabindex="0">stop</button>
            </div>
            
            <div class="jp-progress">
                <div class="jp-seek-bar">
                    <div class="jp-play-bar"></div>
                </div>
            </div>
            <div class="jp-volume-controls">
                <button class="jp-mute" role="button" tabindex="0">mute</button>
                <button class="jp-volume-max" role="button" tabindex="0">max volume</button>
                <div class="jp-volume-bar">
                    <div class="jp-volume-bar-value"></div>
                </div>
            </div>
            
            <div class="jp-time-holder">
                <div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
                <div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
            </div>
            <div class="jp-toggles">
                <button class="jp-repeat" role="button" tabindex="0">repeat</button>
                <button class="jp-shuffle" role="button" tabindex="0">shuffle</button>
            </div>
        </div>
        <div class="jp-playlist">
            <ul>
                <li>&nbsp;</li>
            </ul>
        </div>
        
    
        
    </div>


        <div class="jp-no-solution">
            <span>Update Required</span>
            To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
        </div>

        <div class="jp-title" aria-label="title">&nbsp;</div>
    </div>
      
    
</div>


<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="js/jplayer.playlist.min.js"></script>
<script type="text/javascript">
//<![CDATA[


    var theTitles =<?php echo json_encode($namelist);?>;
    var theMP3s =<?php echo json_encode($datalist);?>;
    var jplayer_playlist;
    var isshuffle=false;
    //var currTitle;

  console.log(theTitles[1]);

  function get_playlist()
    {
        var playlist = new Array();

        for(var i = 0; i < theTitles.length; i++)
        {
            playlist[i] = {title: theTitles[i], mp3: theMP3s[i]};
        }
        return playlist;
    }


    
    function hideSave()
    {
        var x = document.getElementById("save");
  if (x.style.display === "table") {
    x.style.display = "none";
    isshuffle=false;
    //console.log(isshuffle);
  } else {
    x.style.display = "table";
    isshuffle=true;
    //console.log(isshuffle);
  }
    }



$(document).ready(function(){



    

    var playlist = get_playlist();
        jplayer_playlist = new jPlayerPlaylist({
            jPlayer: "#jquery_jplayer_1",
            cssSelectorAncestor: "#jp_container_1",
            oggSupport:false
    }, 
        
    playlist,{
        swfPath: "../../dist/jplayer",
        supplied: "oga, mp3",
        wmode: "window",
        useStateClassSkin: true,
        autoBlur: true,
        enableRemoveControls: true,
        smoothPlayBar: true,
        keyEnabled: true
        
    });


$("#test").click(function(){

console.log(isshuffle);

    if (isshuffle!=false) {

        jplayer_playlist.shuffle(false);
        
    }
    });
    
});





//]]>
</script>

</div><?php include_once "_footer.php";?>