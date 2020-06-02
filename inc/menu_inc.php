<?php
if (!defined('WEB_ROOT')) {
    exit;
}

// $uri = $_SERVER['REQUEST_URI'];
// $parse = parse_url($uri);
// parse_str($parse['query'],$params);
// $idl = $params['action'];
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-warning elevation-4">
  <div class="brand-logo text-center border-0">
    <a href="<?php echo BASE_URI; ?>" class="brand-link bg-navy border-0">
      <span class="brand-text">
        <?php echo $app['nama'];?>
      </span>
    </a>
  </div>
  <!-- Sidebar -->
  <div class="sidebar bg-navy">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a id="beranda" href="#" class="nav-link a-link-menu-nav">
            <i class=" nav-icon fas fa-home"></i>
            <p>Beranda</p>
          </a>
        </li>
        <li class="nav-header pt-1">KOPERASI</li>
        <li class="nav-item">
          <a id="anggota" href="#" class="nav-link a-link-menu-nav">
            <i class="nav-icon fas fa-users"></i>
            <p>Anggota</p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-wallet"></i>
            <p>
              Simpanan
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview pl-4">
            <li class="nav-item">
              <a id="simpanan" href="#" class="nav-link a-link-menu-nav">
                <i class="nav-icon fas fa-file-invoice-dollar"></i>
                <p>Jenis Simpanan</p>
              </a>
            </li>
            <li class="nav-item">
              <a id="simpanan_anggota" href="#" class="nav-link a-link-menu-nav">
                <i class="nav-icon fas fa-id-card-alt"></i>
                <p>Simpanan Anggota</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-handshake"></i>
            <p>
              Pinjaman
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview pl-4">
            <li class="nav-item">
              <a id="pinjaman" href="#" class="nav-link a-link-menu-nav">
                <i class="nav-icon fas fa-id-card"></i>
                <p>Jenis Pinjaman</p>
              </a>
            </li>
            <li class="nav-item">
              <a id="pinjaman_anggota" href="#" class="nav-link a-link-menu-nav">
                <i class="nav-icon fas fa-id-card-alt"></i>
                <p>Pinjaman Anggota</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a id="pembayaran" href="#" class="nav-link a-link-menu-nav">
            <i class="nav-icon fas fa-money-bill"></i>
            <p>Pembayaran</p>
          </a>
        </li>
        <li class="nav-item">
          <a id="pengeluaran" href="#" class="nav-link a-link-menu-nav">
            <i class="nav-icon fas fa-receipt"></i>
            <p>Pengeluaran</p>
          </a>
        </li>
        <li class="nav-header pt-1">LAPORAN</li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-line"></i>
            <p>
              Laporan-laporan
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview pl-4">
            <li class="nav-item">
              <a id="laporan_shu" href="#" class="nav-link a-link-menu-nav">
                <i class="nav-icon fas fa-clipboard-check"></i>
                <p>Laporan SHU</p>
              </a>
            </li>
            <li class="nav-item">
              <a id="laporan_pinjaman" href="#" class="nav-link a-link-menu-nav">
                <i class="nav-icon fas fa-clipboard-check"></i>
                <p>Laporan Pinjaman</p>
              </a>
            </li>
            <li class="nav-item">
              <a id="laporan_simpanan" href="#" class="nav-link a-link-menu-nav">
                <i class="nav-icon fas fa-clipboard-check"></i>
                <p>Laporan Simpanan</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-header pt-1">UTILITAS</li>
        <li class="nav-item">
          <a id="pengaturan" href="#" class="nav-link a-link-menu-nav">
            <i class="nav-icon fas fa-tools"></i>
            <p>Pengaturan</p>
          </a>
        </li>
        <li class="nav-item">
          <a id="user" href="#" class="nav-link a-link-menu-nav">
            <i class="nav-icon fas fa-users-cog"></i>
            <p>Manajemen User</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>