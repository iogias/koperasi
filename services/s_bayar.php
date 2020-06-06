<?php
require_once '../libs/config.php';
header('Content-type: application/json');
if(isset($_POST['token']) && $_POST['token']=='bayar'){
    $id = $_POST['data'];
    $table= 'tb_'.$_POST['param'];

    $items = AppKatalog::getRowByNomorKontrak($id);
    $angs_pokok = 0;
    $angs_bulan = 0;
    $total_angs = 0;

    $items2 = AppKatalog::getRowById($table,$id);
    $sum = AppKatalog::select_sum_bayar($id);
    $ct = AppKatalog::select_count_bayar($id);
    $sum_pokok = 0;
    $sum_bunga = 0;
    $total_terbayar = 0;
    $count_pokok = 0;
    $count_bunga = 0;

    $sisa_pokok = 0;
    $sisa_bunga = 0;
    $total_sisa = 0;


    if($items){
        $angs_pokok = round($items['pokok'] / $items['tenor']);
        $angs_bunga = round($items['bunga_rupiah'] / $items['tenor']);
        $total_angs = $angs_pokok + $angs_bunga;
    }

    if($sum) {

        $sum_pokok = $sum['sum_pokok'];
        $sum_bunga = $sum['sum_bunga'];
        $count_pokok = $ct['ct_pokok'];
        $count_bunga = $ct['ct_bunga'];
        $total_terbayar = $sum_pokok + $sum_bunga;
    }

    $sisa_pokok = $items['pokok'] - $sum_pokok;
    $sisa_bunga = $items['bunga_rupiah'] - $sum_bunga;
    $total_sisa = $sisa_pokok + $sisa_bunga;

    echo '{"status":true,
        "angs_pokok":'.$angs_pokok.',
        "angs_bunga":'.$angs_bunga.',
        "total_angs":'.$total_angs.',
        "sisa_pokok":'.$sisa_pokok.',
        "sisa_bunga":'.$sisa_bunga.',
        "total_sisa":'.$total_sisa.',
        "pokok_terbayar":'.$sum_pokok.',
        "bunga_terbayar":'.$sum_bunga.',
        "total_terbayar":'.$total_terbayar.',
        "ct_pokok":'.$count_pokok.',
        "ct_bunga":'.$count_bunga.',
        "row":'.json_encode($items).',
        "row2":'.json_encode($items2).'
    }';
}