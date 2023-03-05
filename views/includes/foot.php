<footer class="main-footer">
  <strong>Copyright &copy; 2023 <a href="<?= URL ?>">ricien_stock.com</a>.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 0.1
  </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo URL; ?>public/frameworks/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo URL; ?>public/frameworks/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo URL; ?>public/frameworks/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo URL; ?>public/frameworks/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo URL; ?>public/frameworks/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo URL; ?>public/frameworks/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo URL; ?>public/frameworks/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo URL; ?>public/frameworks/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo URL; ?>public/frameworks/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo URL; ?>public/frameworks/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo URL; ?>public/frameworks/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo URL; ?>public/frameworks/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo URL; ?>public/frameworks/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo URL; ?>public/frameworks/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo URL; ?>public/frameworks/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Select 2  -->
<script src="<?php echo URL; ?>public/frameworks/plugins/select2/js/select2.full.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo URL; ?>public/frameworks/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo URL; ?>public/frameworks/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo URL; ?>public/frameworks/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo URL; ?>public/frameworks/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo URL; ?>public/frameworks/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo URL; ?>public/frameworks/plugins/moment/moment.min.js"></script>
<script src="<?php echo URL; ?>public/frameworks/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo URL; ?>public/frameworks/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo URL; ?>public/frameworks/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo URL; ?>public/frameworks/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?php echo URL; ?>public/frameworks/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?php echo URL; ?>public/frameworks/plugins/toastr/toastr.min.js"></script>
<!-- PrintThis -->
<script src="<?php echo URL; ?>public/librairies/printthis/printThis.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo URL; ?>public/frameworks/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo URL; ?>public/frameworks/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo URL; ?>public/frameworks/dist/js/pages/dashboard.js"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  });
</script>
<!-- Css propre au module-->
<?php
  if (isset($this->js)) {
      foreach ($this->js as $js) {
          echo '<script type="text/javascript" src="' . URL . 'views/' . $js . '"></script>';
      }
  }
?>

</body>

</html>