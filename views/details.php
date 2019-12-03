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