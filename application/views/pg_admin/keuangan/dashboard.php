<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
  $this->load->view("pg_admin/html_header.php");
?>
<div class="wrapper">
  <?php
    $this->load->view("pg_admin/sidebar_keu");
  ?>

  <div class="main-panel">
    <?php
      $this->load->view("pg_admin/navbar");
    ?>
    
    <div class="content">      
      <div class="container-fluid">
	  
        <div class="row">
			
        </div>
		
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->

    <?php
      $this->load->view("pg_admin/footer");
    ?>

  </div>
</div>

<!-- END MODAL ERROR AJAX -->
</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-1.10.2.js" type="text/javascript');?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>

<!--  Nestable Plugin    -->
<script src="<?php echo base_url('assets/js/plugins/nestable/jquery.nestable.js');?>"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>

<!--  Datatables Plugin -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>


</html>
