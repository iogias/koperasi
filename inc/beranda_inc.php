<?php
if (!defined('WEB_ROOT')) {
    exit;
}
$total_simpanan = AppLaporan::get_total('tb_simpanan_anggota');
$total_pinjaman = AppLaporan::get_total('tb_pinjaman_anggota');
?>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-info">
          <span class="info-box-icon"><i class="fas fa-wallet"></i></span>
          <div class="info-box-content">
            <span class="info-box-text text-lg">Total Saldo Kas</span>
            <span class="info-box-number text-lg">Rp </span>
            <div class="progress">
              <div class="progress-bar" style="width: 100%"></div>
            </div>
            <span class="progress-description">
              <?php echo hari_ini().','.$tglnow;?>
            </span>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-danger">
          <span class="info-box-icon"><i class="fas fa-handshake"></i></span>
          <div class="info-box-content">
            <span class="info-box-text text-lg">Total Pokok Pinjaman</span>
            <span class="info-box-number text-lg">
              Rp
              <?php echo money_simple($total_pinjaman);?>
            </span>
            <div class="progress">
              <div class="progress-bar" style="width: 100%"></div>
            </div>
            <span class="progress-description">
              <?php echo hari_ini().','.$tglnow;?>
            </span>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-success">
          <span class="info-box-icon"><i class="fas fa-piggy-bank"></i></span>
          <div class="info-box-content">
            <span class="info-box-text text-lg">Total Simpanan (P+W)</span>
            <span class="info-box-number text-lg">
              Rp
              <?php echo money_simple($total_simpanan);?>
            </span>
            <div class="progress">
              <div class="progress-bar" style="width: 100%"></div>
            </div>
            <span class="progress-description">
              <?php echo hari_ini().','.$tglnow;?>
            </span>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-lightblue">
          <span class="info-box-icon"><i class="fas fa-clipboard-check"></i></span>
          <div class="info-box-content">
            <span class="info-box-text text-lg">Total SHU</span>
            <span class="info-box-number text-lg">Rp </span>
            <div class="progress">
              <div class="progress-bar" style="width: 100%"></div>
            </div>
            <span class="progress-description">
              <?php echo hari_ini().','.$tglnow;?>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>