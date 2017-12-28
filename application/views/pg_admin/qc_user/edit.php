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
		
		<div class="col-sm-6">
			<div class="card">
				<div class="content">
					<div class="row">
						<div class="col-sm-126">
							<form method="post" action="<?php echo base_url('pg_admin/qc_user/proses_edit');?>">
								<input type="hidden" name="idadmin" value="<?php echo $admin->id_adm;?>">
								<table class="table">
									<tr>
										<td>Nama</td>
										<td>:</td>
										<td>
											<input type="text" name="nama" class="form-control" placeholder="Masukkan Nama QC" value="<?php echo $admin->nama;?>" required>
										</td>
									</tr>
									<tr>
										<td>Username</td>
										<td>:</td>
										<td>
											<input type="text" name="username" class="form-control" placeholder="Masukkan username" value="<?php echo $admin->username;?>" required>
										</td>
									</tr>
									<tr>
										<td colspan="3" style="text-align: right;">
											<a href="<?php echo base_url("pg_admin/qc_user");?>" class="btn btn-sm btn-danger">Kembali</a>
											<input type="submit" name="submit" class="btn btn-sm btn-danger" value="Edit User QC">
										</td>
									</tr>
								</table>
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
<script src="<?php echo base_url('assets/js/jquery-1.10.2.js" type="text/javascript');?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<!--<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script> -->

<!-- Bootstrap Switch Plugin -->
<script src="<?php echo base_url('assets/js/plugins/bootstrap-switch/bootstrap-switch.min.js');?>"></script>

<!-- Progress -->
<script src="<?= base_url('assets/js/nprogress.js')?>" ></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>



<script type="text/javascript">
$(function(){

$('table.display').DataTable();

$(document).ajaxSend(function(event, jqxhr, settings){
	$("#modal-loader").modal('show');
});
$(document).ajaxSuccess(function(event, request, options){
	
});
$(document).ajaxError(function(event, request, options){
	$("#modal-loader").modal("hide");
});

})
</script>

</html>
