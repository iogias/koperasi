<?php
require_once '../libs/config.php';
// header('Content-type: application/json');
if (isset($_POST['token']) && $_POST['token']=='delete'){
    $id = (int) $_POST['data'];
    $table = 'tb_'.$_POST['param'];
    AppKatalog::delRowById($table,$id);
    echo '{"status":true}';
} else {
    die('NO DATA PASSED');
}
