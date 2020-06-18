<?php
if (!defined('WEB_ROOT')) {
    exit;
}

class AppKatalog {

    public static function getRowById($table,$id){
        $sql = "SELECT * FROM $table WHERE id ='" . $id . "'";
        $param = array('id' => $id);
        return DbHandler::getRow($sql, $param);
    }

    public static function getRowByIdJoinAnggota($table,$id){
        $sql = "SELECT b.*,a.nama AS nm_anggota FROM $table b
        JOIN tb_anggota a ON a.id=b.id_anggota
        WHERE b.id ='" . $id . "'";
        $param = array('id' => $id);
        return DbHandler::getRow($sql, $param);
    }

    public static function getRowBayarJoinAnggota($id){
        $sql = "SELECT b.*,pa.id_pinjaman,a.nama AS nm_anggota FROM tb_pembayaran b
        JOIN tb_pinjaman_anggota pa ON pa.nomor_kontrak=b.nomor_kontrak
        JOIN tb_anggota a ON a.id=pa.id_anggota
        WHERE b.id ='" . $id . "'";
        $param = array('id' => $id);
        return DbHandler::getRow($sql, $param);
    }

    public static function delRowById($table,$id){
        $sql = "DELETE FROM $table WHERE id ='" . $id . "'";
        $param = array('id' => $id);
        DbHandler::cExecute($sql,$param);
    }

    public static function getAllRowsWithStatus($table,$arg='99'){
        $sql = "SELECT * FROM $table\n";
        if($arg!='99'){
            $sql .= "WHERE status='".$arg."'";
        }
        $param = array('status'=>$arg);
        return DbHandler::getAll($sql,$param);
    }

    public static function getAllRowsWithDate($table,$awal,$akhir){
        $tawal = date('Y-m-d',strtotime($awal));
        $takhir = date('Y-m-d',strtotime($akhir));
        $sql = "SELECT * FROM $table\n";
        $sql .= "WHERE tanggal BETWEEN '".$tawal."' AND '".$takhir."'";
        $param = array('tanggal'=>$tawal);
        return DbHandler::getAll($sql,$param);
    }

    public static function getLastId($table){
        $sql = "SELECT MAX(id) FROM $table";
        return DbHandler::getOne($sql);
    }

    public static function getLastNoUrut($idp,$ida){
        $sql = "SELECT MAX(no_urut) FROM tb_pinjaman_anggota
                WHERE id_anggota='".$ida."' AND id_pinjaman='".$idp."'";
        return DbHandler::getOne($sql);
    }

    private static function zeroFill($num, $zerofill = 4) {
        return str_pad($num, $zerofill, '0', STR_PAD_LEFT);
    }

    public static function search_anggota($key){
        $sql = "SELECT id,nama FROM tb_anggota WHERE nama LIKE '%$key%' AND status=1 LIMIT 5";
        $param = array('nama' => $key);
        return DbHandler::getAll($sql,$param);
    }

    public static function getRowByNomorKontrak($nomor){
        $sql = "SELECT pa.*,a.nama FROM tb_pinjaman_anggota pa
        JOIN tb_anggota a ON a.id=pa.id_anggota
        WHERE pa.nomor_kontrak ='" . $nomor . "'";
        $param = array('nomor_kontrak' => $nomor);
        return DbHandler::getRow($sql, $param);
    }

    public static function search_nomor_kontrak($key,$idp){
        $sql = "SELECT a.id,pa.nomor_kontrak,a.nama FROM tb_pinjaman_anggota pa
        JOIN tb_anggota a ON a.id=pa.id_anggota
        WHERE pa.nomor_kontrak LIKE '%$key%'
        AND pa.id_pinjaman='".$idp."'
        AND pa.status<>'LUNAS'
        LIMIT 5";
        $param = array('nama' => $key);
        return DbHandler::getAll($sql,$param);
    }

    public static function search_anggota_with($key,$idp){
        $sql = "SELECT a.id,a.nama,pa.nomor_kontrak,pa.status FROM tb_anggota a
        LEFT JOIN tb_pinjaman_anggota pa ON pa.id_anggota=a.id
        WHERE pa.id_pinjaman='".$idp."'
        AND pa.status='LUNAS' OR pa.status IS NULL AND
        a.nama LIKE '%$key%'";
        $param = array('nama' => $key,'id_pinjaman'=>$idp);
        return DbHandler::getAll($sql,$param);
    }

    public static function search_anggota_with2($key,$idp){
        $sql = "SELECT a.id,a.nama,pa.nomor_kontrak,pa.status FROM tb_anggota a
        JOIN tb_pinjaman_anggota pa ON pa.id_anggota=a.id
        WHERE pa.id_pinjaman='".$idp."'
        AND pa.status<>'LUNAS' AND a.nama LIKE '%$key%'";
        $param = array('nama' => $key,'id_pinjaman'=>$idp);
        return DbHandler::getAll($sql,$param);
    }

    public static function new_anggota($data){
        $nama = ucwords($data['nama']);
        $tgl = date('Y-m-d',strtotime($data['tgl-daftar']));
        $sql = "INSERT INTO tb_anggota(id,tanggal,salut,nama,alamat,hp,status)
            VALUES(NULL,
            '".$tgl."',
            '".$data['salut']."',
            '".$nama."',
            '".$data['alamat']."',
            '".$data['hp']."',
            '".$data['status']."')";
        $params = array(
                    'tanggal'=>$tgl,
                    'salut'=>$data['salut'],
                    'nama'=>$nama,
                    'alamat'=>$data['alamat'],
                    'hp'=>$data['hp'],
                    'status'=>$data['status']
                );
        return DbHandler::cExecute($sql, $params);
    }

    public static function update_anggota($data){
        $id = (int)$data['id-anggota'];
        $nama = ucwords($data['nama']);
        $tgl = date('Y-m-d',strtotime($data['tgl-daftar']));
        $sql = "UPDATE tb_anggota SET
            tanggal = '".$tgl."',
            salut = '".$data['salut']."',
            nama = '".$nama."',
            alamat = '".$data['alamat']."',
            hp = '".$data['hp']."',
            status = '".$data['status']."'
            WHERE id ='".$id."'";
        $params = array(
                    'id'=>$id,
                    'tanggal'=>$tgl,
                    'salut'=>$data['salut'],
                    'nama'=>$nama,
                    'alamat'=>$data['alamat'],
                    'hp'=>$data['hp'],
                    'status'=>$data['status']
                );
        return DbHandler::cExecute($sql, $params);
    }

        public static function update_pengaturan($data){
        $id = (int)$data['id-pengaturan'];
        $nama = ucwords($data['nama']);
        $tgl = date('Y-m-d',strtotime($data['tgl-pengaturan']));
        $saldo = to_int_koma($data['saldo-kas-awal']);
        $sql = "UPDATE tb_pengaturan SET
            nama = '".$nama."',
            saldo_kas_awal = '".$saldo."',
            tanggal = '".$tgl."',
            shu_anggota = '".$data['shu-anggota']."',
            jasa_anggota = '".$data['jasa-anggota']."',
            jasa_pengurus = '".$data['jasa-pengurus']."',
            status = '".$data['status']."'
            WHERE id ='".$id."'";
        $params = array(
                    'id'=>$id,
                    'nama'=>$nama,
                    'saldo_kas_awal'=>$saldo,
                    'tanggal'=>$tgl,
                    'shu_anggota'=>$data['shu-anggota'],
                    'jasa_anggota'=>$data['jasa-anggota'],
                    'jasa_pengurus'=>$data['jasa-pengurus'],
                    'status'=>$data['status']
                );
        return DbHandler::cExecute($sql, $params);
    }

    public static function new_simpanan($data){
        $nama = ucwords($data['nama']);
        $keterangan = trim($data['keterangan']);
        $sql = "INSERT INTO tb_simpanan(id,nama,keterangan,status)
            VALUES(NULL,
            '".$nama."',
            '".$keterangan."',
            '".$data['status']."')";
        $params = array(
                    'nama'=>$nama,
                    'keterangan'=>$keterangan,
                    'status'=>$data['status']
                );
        return DbHandler::cExecute($sql, $params);
    }

    public static function update_simpanan($data){
        $id = (int)$data['id-simpanan'];
        $nama = ucwords($data['nama']);
        $keterangan = trim($data['keterangan']);
        $sql = "UPDATE tb_simpanan SET
            nama = '".$nama."',
            keterangan = '".$keterangan."',
            status = '".$data['status']."'
            WHERE id ='".$id."'";
        $params = array(
                    'id'=>$id,
                    'nama'=>$nama,
                    'keterangan'=>$keterangan,
                    'status'=>$data['status']
                );
        return DbHandler::cExecute($sql, $params);
    }

    public static function get_saldo_simpanan($id){
        $sql = "SELECT COALESCE(SUM(nominal),0) as saldo FROM tb_simpanan_anggota sa\n";
        $sql .= "WHERE id_simpanan<>1 AND id_anggota='".$id."'";
        $param = array('id_anggota'=>$id);
        return DbHandler::getOne($sql,$param);
    }

    public static function get_simpanan_anggota($arg='99'){
        $sql = "SELECT sa.id,sa.id_simpanan,sa.id_anggota,
        sa.tanggal,sa.nominal,s.nama AS simpanan, a.nama AS anggota, a.salut
        FROM tb_simpanan_anggota sa
        JOIN tb_simpanan s ON s.id=sa.id_simpanan
        JOIN tb_anggota a ON a.id=sa.id_anggota\n";
        if($arg!='99'){
            $sql .= "WHERE id_simpanan='".$arg."'";
        }
        $param = array('id_simpanan'=>$arg);
        return DbHandler::getAll($sql,$param);
    }

    public static function new_simpanan_anggota($data){
        $nominal = to_int_koma($data['nominal']);
        $tgl = date('Y-m-d',strtotime($data['tgl-setor']));
        $sql = "INSERT INTO tb_simpanan_anggota(id,id_simpanan,id_anggota,tanggal,nominal)
            VALUES(NULL,
            '".$data['id-simpanan']."',
            '".$data['id-anggota']."',
            '".$tgl."',
            '".$nominal."')";
        $params = array(
                'id_simpanan'=>$data['id-simpanan'],
                'id_anggota'=>$data['id-anggota'],
                'tanggal'=>$tgl,
                'nominal'=>$nominal
                );
        return DbHandler::cExecute($sql, $params);
    }

    public static function update_simpanan_anggota($data){
        $id = (int)$data['id-simpanan_anggota'];
        $nominal = to_int_koma($data['nominal']);
        $tgl = date('Y-m-d',strtotime($data['tgl-setor']));
        $sql = "UPDATE tb_simpanan_anggota SET
            id_simpanan='".$data['id-simpanan']."',
            id_anggota='".$data['id-anggota']."',
            tanggal='".$tgl."',
            nominal='".$nominal."'
            WHERE id='".$id."'";
        $params = array(
                'id'=>$id,
                'id_simpanan'=>$data['id-simpanan'],
                'id_anggota'=>$data['id-anggota'],
                'tanggal'=>$tgl,
                'nominal'=>$nominal,
                );
        return DbHandler::cExecute($sql, $params);
    }

    public static function new_draw_anggota($data){
        $nominal = to_int_koma($data['nominal-draw_anggota']);
        $tgl = date('Y-m-d',strtotime($data['tgl-draw_anggota']));
        $sql = "INSERT INTO tb_draw_anggota(id,id_anggota,tanggal,nominal)
            VALUES(NULL,
            '".$data['id-draw_anggota']."',
            '".$tgl."',
            '".$nominal."')";
        $params = array(
                'id_anggota'=>$data['id-draw_anggota'],
                'tanggal'=>$tgl,
                'nominal'=>$nominal
                );
        return DbHandler::cExecute($sql, $params);
    }

    public static function new_pengeluaran($data){
        $nama = ucwords($data['nama']);
        $nominal = to_int_koma($data['nominal']);
        $tgl = date('Y-m-d',strtotime($data['tgl-pengeluaran']));
        $sql = "INSERT INTO tb_pengeluaran(id,tanggal,nama,nominal)
            VALUES(NULL,
            '".$tgl."',
            '".$nama."',
            '".$nominal."')";
        $params = array(
                    'tanggal'=>$tgl,
                    'nama'=>$nama,
                    'nominal'=>$nominal
                );
        return DbHandler::cExecute($sql, $params);
    }

    public static function update_pengeluaran($data){
        $id = (int) $data['id-pengeluaran'];
        $nama = ucwords($data['nama']);
        $nominal = to_int_koma($data['nominal']);
        $tgl = date('Y-m-d',strtotime($data['tgl-pengeluaran']));
        $sql = "UPDATE tb_pengeluaran SET
            tanggal='".$tgl."',
            nama='".$nama."',
            nominal='".$nominal."'
            WHERE id='".$id."'";
        $params = array(
                    'id'=>$id,
                    'tanggal'=>$tgl,
                    'nama'=>$nama,
                    'nominal'=>$nominal
                );
        return DbHandler::cExecute($sql, $params);
    }

    public static function new_pinjaman($data){
        $nama = ucwords($data['nama']);
        $keterangan = trim($data['keterangan']);
        $plafon = to_int_koma($data['max-plafon']);
        $sql = "INSERT INTO tb_pinjaman(id,nama,keterangan,status,max_plafon,max_bunga,max_tenor,max_admin)
            VALUES(NULL,
            '".$nama."',
            '".$keterangan."',
            '".$data['status']."',
            '".$plafon."',
            '".$data['max-bunga']."',
            '".$data['max-tenor']."',
            '".$data['max-admin']."'
            )";
        $params = array(
                    'nama'=>$nama,
                    'keterangan'=>$keterangan,
                    'status'=>$data['status'],
                    'max_plafon'=>$plafon,
                    'max_bunga'=>$data['max-bunga'],
                    'max_tenor'=>$data['max-tenor'],
                    'max_admin'=>$data['max-admin']
                );
        return DbHandler::cExecute($sql, $params);
    }

    public static function update_pinjaman($data){
        $id = (int)$data['id-pinjaman'];
        $nama = ucwords($data['nama']);
        $keterangan = trim($data['keterangan']);
        $plafon = to_int_koma($data['max-plafon']);
        $sql = "UPDATE tb_pinjaman SET
            nama = '".$nama."',
            keterangan = '".$keterangan."',
            status = '".$data['status']."',
            max_plafon = '".$plafon."',
            max_bunga = '".$data['max-bunga']."',
            max_tenor = '".$data['max-tenor']."',
            max_admin = '".$data['max-admin']."'
            WHERE id ='".$id."'";
        $params = array(
                    'id'=>$id,
                    'nama'=>$nama,
                    'keterangan'=>$keterangan,
                    'status'=>$data['status'],
                    'max_plafon'=>$plafon,
                    'max_bunga'=>$data['max-bunga'],
                    'max_tenor'=>$data['max-tenor'],
                    'max_admin'=>$data['max-admin']
                );
        return DbHandler::cExecute($sql, $params);
    }

    private static function nomor_kontrak($tgl,$ida,$idp){
        $index = self::getLastNoUrut($idp,$ida);
        $tahun = explode('-',$tgl);
        $bln = $tahun[1];
        $th = substr($tahun[2],-2);
        $no = (!$index) ? 1 : $index+1;
        $no_urut = self::zeroFill($no,3);
        $pad_idp = self::zeroFill($idp,2);
        $pad_ida = self::zeroFill($ida,2);
        $format = $bln.$th.$pad_idp.$pad_ida.'-'.$no_urut;
        return $format;
    }

    public static function get_pinjaman_anggota(){
        $sql = "SELECT pa.*,a.nama,a.salut
                FROM tb_pinjaman_anggota pa
                JOIN tb_anggota a ON a.id=pa.id_anggota";
        return DbHandler::getAll($sql);
    }

    public static function new_pinjaman_anggota($data){
        $nomor = self::nomor_kontrak($data['tgl-pinjaman_anggota'],$data['id-pinjaman_anggota'],$data['jenis-pinjaman_anggota']);
        $index = self::getLastNoUrut($data['jenis-pinjaman_anggota'],$data['id-pinjaman_anggota']);
        $no_urut = (!$index) ? 1 : $index+1;
        $tgl = date('Y-m-d',strtotime($data['tgl-pinjaman_anggota']));
        $pokok = to_int_koma($data['plafon']);
        $bunga_rp = to_int_koma($data['bunga-rp']);
        $admin_rp = to_int_koma($data['admin-rp']);
        $terima = to_int_koma($data['total-terima']);
        $total = (int) $pokok + (int) $bunga_rp;
        $sql = "INSERT INTO tb_pinjaman_anggota (id,no_urut,nomor_kontrak,tanggal,id_anggota,id_pinjaman,
                pokok,tenor,bunga_persen,bunga_rupiah,admin_persen,admin_rupiah,
                total_pinjaman,total_terima,status)
                VALUES(NULL,
                '".$no_urut."',
                '".$nomor."',
                '".$tgl."',
                '".$data['id-pinjaman_anggota']."',
                '".$data['jenis-pinjaman_anggota']."',
                '".$pokok."',
                '".$data['tenor']."',
                '".$data['bunga-persen']."',
                '".$bunga_rp."',
                '".$data['admin-persen']."',
                '".$admin_rp."',
                '".$total."',
                '".$terima."',
                'JALAN'
                )";
        $params = array(
                'no_urut'=>$no_urut,
                'nomor_kontrak'=>$nomor,
                'tanggal'=>$tgl,
                'id_anggota'=>$data['id-pinjaman_anggota'],
                'id_pinjaman'=>$data['jenis-pinjaman_anggota'],
                'pokok'=>$pokok,
                'tenor'=>$data['tenor'],
                'bunga_persen'=>$data['bunga-persen'],
                'bunga_rupiah'=>$bunga_rp,
                'admin_persen'=>$data['admin-persen'],
                'admin_rupiah'=>$admin_rp,
                'total_pinjaman'=>$total,
                'total_terima'=>$terima
                );
        return DbHandler::cExecute($sql, $params);
    }

    public static function update_pinjaman_anggota($data){
        $id = $data['id2-pinjaman_anggota'];
        $tgl = date('Y-m-d',strtotime($data['tgl-pinjaman_anggota']));
        $pokok = to_int_koma($data['plafon']);
        $bunga_rp = to_int_koma($data['bunga-rp']);
        $admin_rp = to_int_koma($data['admin-rp']);
        $terima = to_int_koma($data['total-terima']);
        $total = (int) $pokok + (int) $bunga_rp;
        $sql = "UPDATE tb_pinjaman_anggota SET
                tanggal = '".$tgl."',
                id_anggota = '".$data['id-pinjaman_anggota']."',
                id_pinjaman = '".$data['jenis-pinjaman_anggota']."',
                pokok = '".$pokok."',
                tenor = '".$data['tenor']."',
                bunga_persen = '".$data['bunga-persen']."',
                bunga_rupiah = '".$bunga_rp."',
                admin_persen = '".$data['admin-persen']."',
                admin_rupiah = '".$admin_rp."',
                total_pinjaman = '".$total."',
                total_terima = '".$terima."',
                status = '".$data['status-pinjaman_anggota']."' WHERE id='".$id."'";
        $params = array(
                'id'=>$id,
                'id_anggota'=>$data['id-pinjaman_anggota'],
                'id_pinjaman'=>$data['jenis-pinjaman_anggota'],
                'pokok'=>$pokok,
                'tenor'=>$data['tenor'],
                'bunga_persen'=>$data['bunga-persen'],
                'bunga_rupiah'=>$bunga_rp,
                'admin_persen'=>$data['admin-persen'],
                'admin_rupiah'=>$admin_rp,
                'total_pinjaman'=>$total,
                'total_terima'=>$terima,
                'status'=>$data['status-pinjaman_anggota']
                );
        return DbHandler::cExecute($sql, $params);
    }

    public static function get_pembayaran(){
        $sql = "SELECT p.*,pa.id_anggota,a.nama AS anggota
                FROM tb_pembayaran p
                JOIN tb_pinjaman_anggota pa ON pa.nomor_kontrak=p.nomor_kontrak
                JOIN tb_anggota a ON a.id=pa.id_anggota";
        return DbHandler::getAll($sql);
    }

    public static function new_pembayaran($data){
        $tgl = date('Y-m-d',strtotime($data['tgl-bayar']));
        $bayar_pokok = ($data['bayar-pokok'] =='') ? 0 : to_int_koma($data['bayar-pokok']);
        $bayar_bunga = ($data['bayar-bunga'] == '') ? 0 : to_int_koma($data['bayar-bunga']);
        $keterangan = trim($data['keterangan']);
        $sql = "INSERT INTO tb_pembayaran
                (id,nomor_kontrak,tanggal,nominal_pokok,nominal_bunga,keterangan)
                VALUES(NULL,
                '".$data['nomor-kontrak']."',
                '".$tgl."',
                '".$bayar_pokok."',
                '".$bayar_bunga."',
                '".$keterangan."')";
        $params = array(
                'nomor-kontrak'=>$data['nomor-kontrak'],
                'tanggal'=>$tgl,
                'nominal_pokok'=>$bayar_pokok,
                'nominal_bunga'=>$bayar_bunga,
                'keterangan'=>$keterangan
                );
        return DbHandler::cExecute($sql,$params);

    }

    public static function update_pembayaran($data){
        $tgl = date('Y-m-d',strtotime($data['tgl-bayar']));
        $bayar_pokok = ($data['bayar-pokok'] =='') ? 0 : to_int_koma($data['bayar-pokok']);
        $bayar_bunga = ($data['bayar-bunga'] == '') ? 0 : to_int_koma($data['bayar-bunga']);
        $keterangan = trim($data['keterangan']);
        $sql = "UPDATE tb_pembayaran SET
                tanggal = '".$tgl."',
                nominal_pokok = '".$bayar_pokok."',
                nominal_bunga = '".$bayar_bunga."',
                keterangan = '".$keterangan."'
                WHERE id='".$data['id-pembayaran']."'";
        $params = array(
                'id'=>$data['id-pembayaran'],
                'tanggal'=>$tgl,
                'nominal_pokok'=>$bayar_pokok,
                'nominal_bunga'=>$bayar_bunga,
                'keterangan'=>$keterangan
                );
        return DbHandler::cExecute($sql,$params);

    }

    public static function select_sum_bayar($no){
        $sql = "SELECT COALESCE(SUM(nominal_pokok),0) AS sum_pokok,
                COALESCE(SUM(nominal_bunga),0) AS sum_bunga
                FROM tb_pembayaran
                WHERE nomor_kontrak = '".$no."'";
        $param = array('nomor_kontrak'=>$no);
        return DbHandler::getRow($sql,$param);
    }

    public static function select_count_bayar($no){
        $sql = "SELECT COUNT(IF(nominal_pokok>0,1,NULL)) AS ct_pokok,
                COUNT(IF(nominal_bunga>0,1,NULL)) AS ct_bunga
                FROM tb_pembayaran
                WHERE nomor_kontrak = '".$no."'";
        $param = array('nomor_kontrak'=>$no);
        return DbHandler::getRow($sql,$param);
    }

}