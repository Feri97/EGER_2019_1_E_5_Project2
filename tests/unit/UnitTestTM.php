<?php


use PHPUnit\Framework\TestCase;
define('DB_TYPE','mysql');
define('DB_CHARSET', 'utf8');
define('DB_HOST', 'localhost:3306');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'musicp');

class TestFunctions extends TestCase{

    public function test_db_connect(){
        $expected = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $dumpTest = new FunctionToTest();
        $this->assertEquals($expected, $dumpTest->db_connect());
       
    }



    public function test_asset(){
        $variable='css/app.css';
        $expected ='http://localhost/PROJECTPLAYER/css/app.css';
        $htmlTest = new FunctionToTest();
        $this->assertSame($expected,$htmlTest->asset($variable));
    }

 }

class FunctionToTest{

    function db_connect()
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Connection failed: {$conn->connect_error}");
    }

    return $conn;
}
    
function asset($asset) {
    return DOMAIN . $asset;
}
}



 ?>
 


