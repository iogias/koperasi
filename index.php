<?php
require_once 'libs/config.php';
require_once 'inc/header_inc.php';
ob_start();
if(!isset($_SESSION['username']) && !isset($_SESSION['id'])){
    header("Location:".DOC_ROOT."/login.php");
} else {
  $session_us = $_SESSION['username'];
  $session_id = $_SESSION['id'];
}

$tglnow = date('d-m-Y');
$hari = hari_ini();

?>

<body class="sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand text-sm navbar-dark navbar-navy">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-user mr-2"></i>
            <input type="hidden" id="userid-hide" value="<?php echo $session_id;?>" />
            <span id="#text-user">
              <?php echo $session_us;?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item" id="btn-keluar">
              <p class="text-sm"><i class="fas fa-sign-out-alt mr-1"></i>Logout</p>
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->
    <?php require_once 'inc/menu_inc.php';?>
    <div class="content-wrapper text-sm">
      <?php
   if (isset($_GET['action'])){
        for ($i = 0; $i < count($modul); $i++) {
            $path = $modul[$i]['path'];
            $nama = $modul[$i]['nama'];
            $judul = $modul[$i]['judul'];
            if ($_GET['action']==$nama){ ?>
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">
              <h4 class="text-center">
                <?php echo $judul; ?>
              </h4>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <?php require_once $path.'.php';
            }
        }
   } else{ ?>
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">
              <h4 class="text-center">Beranda</h4>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <?php  require_once 'inc/beranda_inc.php';
   } ?>
      <?php require_once 'inc/footer_inc.php';?>
