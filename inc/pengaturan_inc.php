<?php
if (!defined('WEB_ROOT')) {
    exit;
}
$atur=AppKatalog::getRowById('tb_pengaturan',1);
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-5">
        <div class="card bg-gradient-light">
          <div class="card-header border-0">
            <h3 class="card-title">
              <i class="fas fa-tools mr-2"></i>Pengaturan
            </h3>
            <!-- <div class="card-tools">
  <button title="Tambah Pengaturan" class="btn btn-info btn-tambah" id="tambah-pengaturan">
    <i class="fas fa-pencil-alt"></i>
  </button>
</div> -->
          </div>
          <div class="card-body">
            <form class="form-horizontal" id="f-pengaturan" name="f-pengaturan" autocomplete="off">
              <div class="form-group row">
                <label for="tgl-pengaturan" class="col-sm-3 col-form-label">Tanggal</label>
                <div class="col-sm-5">
                  <input value="<?php echo dmY($atur['tanggal']);?>" type="text" class="input-tanggal form-control form-pengaturan" id="tgl-pengaturan" name="tgl-pengaturan" data-zdp_readonly_element="false">
                </div>
              </div>
              <div class="form-group row">
                <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-9">
                  <input value="<?php echo $atur['id'];?>" type="hidden" class="form-control form-pengaturan" id="id-pengaturan" name="id-pengaturan">
                  <input value="<?php echo $atur['nama'];?>" type="text" class="form-control form-pengaturan" id="nama" name="nama">
                </div>
              </div>
              <div class="form-group row">
                <label for="saldo-kas-awal" class="col-sm-3 col-form-label">Saldo Kas Awal</label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" value="<?php echo money_simple($atur['saldo_kas_awal']);?>" class="format-uang form-control form-pengaturan" id="saldo-kas-awal" name="saldo-kas-awal">
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="shu-anggota" class="col-sm-3 col-form-label">SHU Anggota</label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <input type="text" value="<?php echo $atur['shu_anggota'];?>" class="form-control form-pengaturan" id="shu-anggota" name="shu-anggota">
                    <div class="input-group-append">
                      <span class="input-group-text">%</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="alamat" class="col-sm-3 col-form-label">Jasa Anggota</label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <input type="text" value="<?php echo $atur['jasa_anggota'];?>" class="form-control form-pengaturan" id="jasa-anggota" name="jasa-anggota">
                    <div class="input-group-append">
                      <span class="input-group-text">%</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="jasa-pengurus" class="col-sm-3 col-form-label">Jasa Pengurus</label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <input type="text" value="<?php echo $atur['jasa_pengurus'];?>" class="form-control form-pengaturan" id="jasa-pengurus" name="jasa-pengurus">
                    <div class="input-group-append">
                      <span class="input-group-text">%</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="status" class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-5">
                  <select class="form-control form-pengaturan" name="status" id="status">
                    <option value="1">Aktif</option>
                    <option value="0">Non-Aktif</option>
                  </select>
                </div>
              </div>
            </form>
          </div>
          <div class="card-footer text-right">
            <button type="button" class="btn btn-success btn-form" id="update-pengaturan">
              <i class="fas fa-check mr-2"></i>UPDATE
            </button>
            <!-- <button type="button" class="btn btn-info btn-form" id="simpan-pengaturan">
  <i class="fas fa-save mr-2"></i>SIMPAN
</button> -->
            <!--             <button type="button" class="btn btn-secondary btn-batal" id="batal-pengaturan">
              <i class="fas fa-times mr-2"></i>BATAL
            </button> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>