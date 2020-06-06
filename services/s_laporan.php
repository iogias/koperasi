<?php
require_once '../libs/config.php';
header('Content-type: application/json');
if (isset($_POST['token']) && $_POST['token']=='laporan'){
    $awal = ymd($_POST['awal']);
    $akhir = ymd($_POST['akhir']);
    $data=array();
    if(isset($_POST['param']) && $_POST['param']=='laporan_simpanan') {
        $func = 'get_'.$_POST['param'];
        $result = AppLaporan::$func($awal,$akhir);
        $simpanan = AppKatalog::getAllRowsWithStatus('tb_simpanan',1);
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
    } else if(isset($_POST['param']) && $_POST['param']=='laporan_pinjaman') {
        $func = 'get_'.$_POST['param'];
        $id = (int)$_POST['jpinjaman'];
        $result = AppLaporan::$func($id,$awal,$akhir);
        echo json_encode($result);
    }
} else {
    die('NO DATA PASSED');
}