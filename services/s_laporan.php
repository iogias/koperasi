<?php
require_once '../libs/config.php';
header('Content-type: application/json');
if (isset($_POST['token']) && $_POST['token']=='laporan'){
    $awal = ymd($_POST['awal']);
    $akhir = ymd($_POST['akhir']);
    $func = 'get_'.$_POST['param'];
    $result = AppLaporan::$func($awal,$akhir);
    $simpanan = AppKatalog::getAllRowsWithStatus('tb_simpanan',1);
    $data=array();
    foreach($result as $row){
        $sub = array();
        $sub[] = $row['anggota'];
        for($i=0;$i<count($simpanan);$i++){
            $sub[] = money_simple($row[$simpanan[$i]['nama']]);
        }
        $sub[] = money_simple('-'.$row['ambil']);
        $sub[] = money_simple($row['total']);
        $data[]=$sub;
    }
    $res = array('data'=>$data);
    echo json_encode($res);
} else {
    die('NO DATA PASSED');
}