<?php if (!defined('APP_VERSION')) { exit; } ?>
<?php

function dump($varibale) {
    echo "<pre>";
    print_r($varibale);
    echo "</pre>";
}

function dd($varibale) {
    dump($varibale);
    die("END");
}

function asset($asset) {
    return DOMAIN . $asset;
}

?>