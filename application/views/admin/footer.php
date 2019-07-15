    <!-- Essential javascripts for application to work-->
    <script src="<?=base_url('assets/admin/')?>js/jquery-3.2.1.min.js"></script>
    <script src="<?=base_url('assets/admin/')?>js/popper.min.js"></script>
    <script src="<?=base_url('assets/admin/')?>js/bootstrap.min.js"></script>
    <script src="<?=base_url('assets/admin/')?>js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?=base_url('assets/admin/')?>js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="<?=base_url('assets/admin/')?>js/plugins/chart.js"></script>
    <script type="text/javascript" src="<?=base_url('assets/admin/')?>js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?=base_url('assets/admin/')?>js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
    <!-- Google analytics script-->
    <script type="text/javascript">
      if(document.location.hostname == 'pratikborsadiya.in') {
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-72504830-1', 'auto');
        ga('send', 'pageview');
      }
    </script>
    <script>
    $(document).ready(function(){
      $("#bulan").change(function(){
        // alert($(this).val());
        location.href = "<?=base_url()?>admin/transaksi/"+$(this).val();
      });
      $("#bulanBook").change(function(){
        // alert($(this).val());
        location.href = "<?=base_url()?>admin/transaksi/"+$(this).val();
      });
      
    })
    </script>
  </body>
</html>