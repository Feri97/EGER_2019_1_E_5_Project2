<?php


 use PHPUnit\Framework\TestCase;
 

 define('DB_TYPE','mysql');
 define('DB_HOST','localhost');
 define('DB_NAME','kldt76');
 define('DB_USER','root');
 define('DB_PASS','');
 define('DB_CHARSET', 'utf8');

 class LaborUnitTest extends TestCase
 {
    

    public function test_connection()
    {   
        $connection = new PDO(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME.';',DB_USER, DB_PASS);
        $connection->exec("SET NAMES '".DB_CHARSET."'");                        
        if($connection){
           $test=true;
        }
        else $test=false;
        $this->assertTrue($test);
        
    }
   

    public function test_executeDML()
    {
        $queryString="DELETE FROM `users` WHERE `id` = 1";
        $queryParams=[':id' => 10];
        $connection = new PDO(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME.';',DB_USER, DB_PASS);
        $connection->exec("SET NAMES '".DB_CHARSET."'");
        $statement = $connection->prepare($queryString);
        $success = $statement->execute($queryParams);
        $statement->closeCursor();
        $connection = null;
        if($success)
        {
            $test=true;
        }
        else
        {
            $test=false;
        }
        $this->assertTrue($test);

    }

    

}


?>

    