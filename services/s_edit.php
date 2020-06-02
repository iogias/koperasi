<?php
require_once '../libs/config.php';
header('Content-type: application/json');
if (isset($_POST['token']) && $_POST['token']=='edit'){
    $table= 'tb_'.$_POST['param'];
    $id = (int) $_POST['data'];
    $items = AppKatalog::getRowById($table,$id);
    echo '{"status":true,"row":'.json_encode($items).'}';
} else if(isset($_POST['token']) && $_POST['token']=='join_anggota'){
    $table= 'tb_'.$_POST['param'];
    $id = (int) $_POST['data'];
    $items = AppKatalog::getRowByIdJoinAnggota($table,$id);
    echo '{"status":true,"row":'.json_encode($items).'}';
} else if(isset($_POST['token']) && $_POST['token']=='bayar'){
    $id = $_POST['data'];
    $items = AppKatalog::getRowByNomorKontrak($id);
    echo '{"status":true,"row":'.json_encode($items).'}';
} else {
    die ('NO DATA PASSED');
}