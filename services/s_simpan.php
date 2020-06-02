<?php
require_once '../libs/config.php';
require_once '../libs/app_katalog.php';
header('Content-type: application/json');
if (isset($_POST['token']) && $_POST['token']=='simpan'){
    $table = $_POST['param'];
    $func = 'new_'.$_POST['param'];
    $dt = $_POST['data'];
    parse_str($dt,$data);
    if($table=='draw_anggota'){
        $saldo = AppKatalog::get_saldo_simpanan($data['id-draw_anggota']) ;
        $nominal = to_int_koma($data['nominal-draw_anggota']);
        if((int)$saldo>=(int)$nominal){
            AppKatalog::$func($data);
            echo '{"status":true}';
        } else {
            echo '{"status":false,"msg":"Saldo tidak mencukupi"}';
        }
    } else if($table=='pinjaman_anggota'){
        $dt = $_POST['data'];
        $func = 'new_'.$_POST['param'];
        parse_str($dt,$data);
        AppKatalog::$func($data);
        echo '{"status":true}';
    } else if($table=='pembayaran'){
        $dt = $_POST['data'];
        $func = 'new_'.$_POST['param'];
        parse_str($dt,$data);
        var_dump($data);
    } else {
        AppKatalog::$func($data);
        echo '{"status":true}';
    }

} else if (isset($_POST['token']) && $_POST['token']=='simpan_join'){

} else {
    die ('NO DATA PASSED');
}