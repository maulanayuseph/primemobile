<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
	$this->load->view("pg_admin/html_header");
?>

<div class="wrapper">
  <?php
		if($this->session->userdata("level") == "adminpa"){
			$this->load->view('pg_admin/sidebar_pa');
		}else{
			$this->load->view('pg_admin/sidebar');
		}
	?>

  <div class="main-panel">
    <?php
    	$this->load->view("pg_admin/navbar");
    ?>
    
    <div class="content">      
      <div class="container-fluid">
        <?php echo $this->session->flashdata('alert'); ?>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
              	<div class="row">
					<div class="col-sm-6">
						<h4 class="title">Manajemen Wilayah</h4>
              		</div>
              	</div>
              </div>
              <div class="content">
				<div class="row">
					<div class="col-sm-3">
						<form method="post" action="<?php echo base_url("pg_admin/wilayah/proses_edit_wilayah");?>">
							<strong>Edit WILAYAH</strong>
							<br>
							<br>
							<strong>Nama Wilayah :</strong>
							<input type="text" name="namawilayah" class="form-control" value="<?php echo $wilayah->nama_wilayah;?>">
							<input type="hidden" name="idwilayah" value="<?php echo $wilayah->id_wilayah;?>">
							<br>
							<input type="submit" name="submit" value="Edit Wilayah" style="width: 100%;" class="btn btn-sm btn-danger">
						</form>
					</div>
				</div>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->
    <?php
    	$this->load->view("pg_admin/footer");
    ?>
  </div>
</div>

<?php
	$this->load->view("pg_admin/modal_ajax");
?>
</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>

<!--  Nestable Plugin    -->
<script src="<?php echo base_url('assets/js/plugins/nestable/jquery.nestable.js');?>"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>


<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>



<script type="text/javascript">
$(function(){


$(document).ajaxSend(function(event, jqxhr, settings){
	
});
$(document).ajaxSuccess(function(event, request, options){
	
});
$(document).ajaxError(function(event, request, options){
	
});

})
</script>

</html>
