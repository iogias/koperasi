<?php
if (!defined('WEB_ROOT')) {
    exit;
}
require_once 'app_katalog.php';
class AppLaporan {

    public static function get_laporan_simpanan($awal,$akhir){
        $now = date('Y-m-d');
        $table = AppKatalog::getAllRowsWithStatus('tb_simpanan',1);
        $sql = "SELECT sa.id_anggota,a.nama AS anggota,\n";
        foreach($table as $item){
            $sql .="COALESCE(SUM(CASE WHEN sa.id_simpanan='".$item['id']."' THEN sa.nominal END), 0) AS '".$item['nama']."',\n";
            $sql .= "COALESCE(SUM(d.nominal),0) AS ambil,\n";
            $sql .= "COALESCE(SUM(sa.nominal),0) - COALESCE(SUM(d.nominal),0)  AS total,\n";
        }
        $sql .="sa.id_simpanan\n";
        $sql .= "FROM tb_simpanan_anggota sa
                JOIN tb_simpanan s ON s.id=sa.id_simpanan
                JOIN tb_anggota a ON a.id=sa.id_anggota
                LEFT JOIN tb_draw_anggota d ON d.id_anggota=a.id\n";
        if($awal!=$now){
            $sql .="WHERE sa.tanggal BETWEEN '".$awal."' AND '".$akhir."'\n";
        }
        $sql .="GROUP BY sa.id_anggota";
        $params =array('tanggal'=>$awal);
        return DbHandler::getAll($sql,$params);
    }
}