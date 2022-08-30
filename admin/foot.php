<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<footer class="main-footer">
  <strong>Copyright TAOWEBGAME.COM</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 4.0
  </div>
</footer>
</div>
<script src="/assets1/js-giao-dien/function.js?ntd=<?= rand(1, 99999999); ?>"></script>
<script src="<?= BASE_URL('assets1/js/backend-bundle.min.js'); ?>" type="b9e3e84309a92aaf852234bf-text/javascript"></script>
<script src="<?= BASE_URL('assets1/js/all.min.js?' . time()); ?>" type="b9e3e84309a92aaf852234bf-text/javascript"></script>

<script type="b9e3e84309a92aaf852234bf-text/javascript">
  const pusher = new Pusher('668e4c588c763d16fcc4', {
    cluster: 'ap1'
  });
</script>

<script src="<?= BASE_URL('assets1/js/function.vendors3243242.js?' . time()); ?>" type="b9e3e84309a92aaf852234bf-text/javascript"></script>
<script type="b9e3e84309a92aaf852234bf-text/javascript">
  $(document).ready(function() {
    if (!getCookie('modalSystem')) {
      $('#modalSystem').modal('show');
    }
  });

  function closeModalSystem() {
    setCookie('modalSystem', true, 1);
    $('#modalSystem').modal('hide');
  }
</script>

<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="b9e3e84309a92aaf852234bf-|49" defer=""></script>


<!-- jQuery -->
<script src="/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/admin/dist/js/adminlte.js"></script>

<script src="/admin/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="/admin/plugins/raphael/raphael.min.js"></script>
<script src="/admin/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="/admin/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="/admin/plugins/chart.js/Chart.min.js"></script>


<script src="/admin/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/admin/dist/js/pages/dashboard2.js"></script>
</body>

</html>