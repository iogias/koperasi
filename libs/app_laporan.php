<?php
if (!defined('WEB_ROOT')) {
    exit;
}
require_once 'app_katalog.php';
class AppLaporan {

    public static function get_laporan_simpanan($awal,$akhir){
        $now = date('Y-m-d');
        $table = AppKatalog::getAllRowsWithStatus('tb_simpanan',1);
        $sql = "SELECT a.salut,a.nama AS anggota,\n";
        foreach($table as $item){
            $sql .= "COALESCE(SUM(CASE WHEN sa.id_simpanan='".$item['id']."' THEN sa.nominal END), 0) AS '".$item['nama']."',\n";
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
        $sql .="GROUP BY sa.id_anggota ORDER BY a.nama ASC";
        $params =array('tanggal'=>$awal);
        return DbHandler::getAll($sql,$params);
    }

    public static function get_laporan_pinjaman($idp=1,$awal,$akhir){
        $sql = "SELECT a.salut,a.nama AS anggota,
                pa.nomor_kontrak,pa.tanggal,
                pa.pokok,pa.bunga_rupiah,pa.total_pinjaman,
                pa.tenor,pa.status,
                COALESCE(SUM(b.nominal_pokok),0) AS bayar_pokok,
                COALESCE(SUM(b.nominal_bunga),0) AS bayar_bunga
                FROM tb_pinjaman_anggota pa
                LEFT JOIN tb_pembayaran b ON b.nomor_kontrak=pa.nomor_kontrak
                JOIN tb_pinjaman p ON p.id=pa.id_pinjaman
                JOIN tb_anggota a ON a.id=pa.id_anggota\n";
        $sql .="WHERE pa.id_pinjaman='".$idp."' AND pa.tanggal BETWEEN '".$awal."' AND '".$akhir."'";
        $sql .="GROUP BY pa.nomor_kontrak\n";
        $params =array('id_pinjaman'=>$idp,'tanggal'=>$awal);
        return DbHandler::getAll($sql,$params);
    }

    public static function get_total($table){
        $nominal = 'nominal';
        if($table=='tb_pinjaman_anggota'){
            $nominal = 'pokok';
        }
        $sql = "SELECT COALESCE(SUM($nominal),0) AS total FROM $table";
        return DbHandler::getOne($sql);
    }
}