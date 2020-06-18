<?php
require_once '../libs/config.php';
if (isset($_POST['token']) && $_POST['token']=='cari'){
    $key = $_POST['query'];
    $param = $_POST['param'];
    $arg = (isset($_POST['arg'])&&$_POST['arg']!='')?$_POST['arg']:'';
    $anggota='';
    $msg = 'Anggota belum terdaftar';
    $data='';
    $kontrak='';
    if($arg=='pinjaman'){
        $idp = (int) $_POST['idp'];
        $anggota=AppKatalog::search_anggota_with($key,$idp);
        $msg = 'Anggota masih ada kontrak untuk pinjaman ini';
    } else if($arg=='bayar'){
        $idp = (int) $_POST['idp'];
        $anggota=AppKatalog::search_anggota_with2($key,$idp);
        $msg = 'Anggota tidak ada kontrak untuk pinjaman ini';
    } else {
        $anggota=AppKatalog::search_anggota($key);
    }
    if($anggota){
       foreach($anggota as $row){
            $id = $row["id"];
            if(array_key_exists('nomor_kontrak',$row)){
                if($row['nomor_kontrak']!=''){
                    $kontrak = 'data-kontrak='.$row['nomor_kontrak'];
                }
            }
            $data .= '<li class="list-group-item contsearch">
            <a href="javascript:void(0)" class="gsearch nav-link" id="'.$param.'-'.$id.'" '.$kontrak.'>'.$row["nama"].'</a></li>';
        }
    echo $data;
    } else {
        echo '<small class="text-danger">'.$msg.'</small>';
    }

 } else if (isset($_POST['token']) && $_POST['token']=='carino'){
    $key = trim($_POST['query']);
    $param = $_POST['param'];
    $idp = (int) $_POST['idp'];
    $nomor = AppKatalog::search_nomor_kontrak($key,$idp);
    $msg = 'Tidak ada data';
    $data = '';
    $kontrak='';
    if($nomor){
       foreach($nomor as $row){
            $id = $row["id"];
            if($row['nomor_kontrak']!=''){
                    $kontrak = 'data-kontrak='.$row['nomor_kontrak'];
                }
            $data .= '<li class="list-group-item contsearch">
            <a href="javascript:void(0)" class="gsearch nav-link" id="'.$param.'-'.$id.'" '.$kontrak.'>'.$row["nomor_kontrak"].'</a></li>';
        }
    echo $data;
    } else {
        echo '<small class="text-danger">'.$msg.'</small>';
    }
 } else {
    die('NO DATA PASSED');
 }