<?php
if (!defined('WEB_ROOT')) {
    exit;
}
?>
</div>
<footer class="main-footer no-print">
  <div class="float-right d-none d-sm-block">
    <small>Version
      <?php echo $app['versi'];?>
    </small>
  </div>
  <small>Copyright &copy;
    <?php echo $app['tahun'].' - '.date('Y');?>
    <?php echo $app['nama'];?></small>
</footer>
</div>
</body>

</html>
<?php
DbHandler::cClose();
flush();
ob_flush();
ob_end_clean();
?>