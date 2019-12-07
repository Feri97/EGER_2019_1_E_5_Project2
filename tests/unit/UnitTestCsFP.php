<?php


use PHPUnit\Framework\TestCase;
define('DOMAIN', 'http://localhost/PROJECTPLAYER/');

class TestFunctions extends TestCase{

    public function test_dump_output(){
        $variable = '50';
        $expected = '<pre>50</pre>';
        $this->expectOutputString($expected);
        $dumpTest = new FunctionToTest();
        $dumpTest->dump($variable);
    }
    public function test_url_output(){

        $expected = 'http://localhost/PROJECTPLAYER/?p=details&id=8';
        $urlTest = new FunctionToTest();
        $this->assertSame($expected, $urlTest->url('details', ['id' => 8]));
    }
}
class FunctionToTest{

    public function dump($varibale) {
        echo "<pre>";
        print_r($varibale);
        echo "</pre>";
    }
    
    public function url($page = 'home', $params = []) {
        $url = DOMAIN . "?p={$page}";
        if (is_array($params)) {
            foreach ($params as $key => $value) {
                $url .= "&$key=$value";
            }
        }
        return $url;
    }
}

?>