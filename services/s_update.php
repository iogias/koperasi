<?php
require_once '../libs/config.php';
header('Content-type: application/json');
if (isset($_POST['token']) && $_POST['token']=='update'){
    $table= 'tb_'.$_POST['param'];
    $func = 'update_'.$_POST['param'];
    $dt = $_POST['data'];
    parse_str($dt,$data);
    AppKatalog::$func($data);
    echo '{"status":true}';
} else {
    die ('NO DATA PASSED');
}