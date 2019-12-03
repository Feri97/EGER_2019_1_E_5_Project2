<?php if (!defined('APP_VERSION')) { exit; } ?>
<?php


 if(array_key_exists('d', $_GET) && array_key_exists('ad', $_GET)) {
	
    $query =  "DELETE FROM `musics` WHERE id = :id" ;
    $params = [ 
        ':id' => $_GET['d'], 
    ];
    $success = executeDML($query, $params);
    if($success) {
    
    redirect('edit',['id'=>$_GET['ad']]);
     
     
    }
    else{echo "<script>alert(''delete incomplete'');</script>";} 


}

?>