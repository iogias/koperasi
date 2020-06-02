<?php
if (!defined('WEB_ROOT')) {
    exit;
}
$app = AppKatalog::getRowById('tb_aplikasi',1);
$modul = AppKatalog::getAllRowsWithStatus('tb_modul',1);
$pageTitle = 'Home';
   if (isset($_GET['action'])){
        for ($i = 0; $i < count($modul); $i++) {
            if ($_GET['action']==$modul[$i]['nama']){
              $pageTitle = $modul[$i]['judul'];
            }}}
?>
<!DOCTYPE html>

<head>
  <?php if (isset($pageTitle)) { ?>
  <title>
    <?php echo $app['nama'].' | '.$pageTitle; ?>
  </title>
  <?php } else { ?>
  <title>
    <?php echo $app['nama'];?>
  </title>
  <?php } ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="stylesheet" href="<?php echo BASE_URI . 'static/plugins/fontawesome-free/css/all.min.css'; ?>">
  <link rel="stylesheet" href="<?php echo BASE_URI . 'static/plugins/overlayScrollbars/css/OverlayScrollbars.min.css';?>">
  <link rel="stylesheet" href="<?php echo BASE_URI . 'static/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css';?>">
  <link rel="stylesheet" href="<?php echo BASE_URI . 'static/plugins/icheck-bootstrap/icheck-bootstrap.min.css';?>">
  <link rel="stylesheet" href="<?php echo BASE_URI . 'static/plugins/datatables-buttons/css/buttons.bootstrap4.min.css';?>">
  <link rel="stylesheet" href="<?php echo BASE_URI . 'static/plugins/toastr/toastr.min.css';?>">
  <link rel="stylesheet" href="<?php echo BASE_URI . 'static/adminlte.min.css'; ?>">
  <link rel="stylesheet" href="<?php echo BASE_URI . 'static/css/metallic/zebra_datepicker.min.css'; ?>">
  <script src="<?php echo BASE_URI . 'static/plugins/jquery/jquery.min.js'; ?>"></script>
  <script src="<?php echo BASE_URI . 'static/plugins/bootstrap/js/bootstrap.bundle.min.js'; ?>"></script>
  <script src="<?php echo BASE_URI . 'static/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js'; ?>"></script>
  <script src="<?php echo BASE_URI . 'static/plugins/datatables/jquery.dataTables.min.js'; ?>"></script>
  <script src="<?php echo BASE_URI . 'static/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js';?>"></script>
  <script src="<?php echo BASE_URI . 'static/plugins/datatables-buttons/js/dataTables.buttons.min.js';?>"></script>
  <script src="<?php echo BASE_URI . 'static/plugins/jszip/jszip.min.js';?>"></script>
  <script src="<?php echo BASE_URI . 'static/plugins/datatables-buttons/js/buttons.html5.min.js';?>"></script>
  <script src="<?php echo BASE_URI . 'static/plugins/datatables-buttons/js/buttons.print.min.js';?>"></script>
  <script src="<?php echo BASE_URI . 'static/plugins/datatables-buttons/js/buttons.colVis.min.js';?>"></script>
  <script src="<?php echo BASE_URI . 'static/plugins/datatables-buttons/js/buttons.bootstrap4.min.js';?>"></script>
  <script src="<?php echo BASE_URI . 'static/plugins/inputmask/min/jquery.inputmask.bundle.min.js';?>"></script>
  <script src="<?php echo BASE_URI . 'static/plugins/pdfmake/pdfmake.min.js';?>"></script>
  <script src="<?php echo BASE_URI . 'static/plugins/pdfmake/vfs_fonts.js';?>"></script>
  <script src="<?php echo BASE_URI . 'static/plugins/toastr/toastr.min.js';?>"></script>
  <script src="<?php echo BASE_URI . 'static/js/adminlte.min.js'; ?>"></script>
  <script src="<?php echo BASE_URI . 'static/js/zebra_datepicker.min.js'; ?>"></script>
  <script src="<?php echo BASE_URI . 'static/js/custom.js'; ?>"></script>
</head>