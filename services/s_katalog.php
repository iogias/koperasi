<?php
require_once '../libs/config.php';
header('Content-type: application/json');
if (isset($_POST['token']) && $_POST['token']=='single'){
    $arg = $_POST['args'];
    $table = 'tb_'.$_POST['param'];
    $data=AppKatalog::getAllRowsWithStatus($table,$arg);
    echo json_encode($data);
} else if (isset($_POST['token']) && $_POST['token']=='join'){
    $arg = $_POST['arg'];
    $func = 'get_'.$_POST['param'];
    $data=AppKatalog::$func($arg);
    echo json_encode($data);
} else if (isset($_POST['token']) && $_POST['token']=='date'){
    $awal = $_POST['awal'];
    $akhir = $_POST['akhir'];
    $table = 'tb_'.$_POST['param'];
    $data=AppKatalog::getAllRowsWithDate($table,$awal,$akhir);
    echo json_encode($data);
}  else {
    die('NO DATA PASSED');
}