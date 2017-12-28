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
		
		<div class="col-sm-12">
			<div class="card">
				<div class="content">
					<div class="row">
						<div class="col-sm-12" style="text-align: right;">
							<a href="<?php echo base_url("pg_admin/qc_user/tambah");?>" class="btn btn-sm btn-danger">Tambah User QC</a>
							<br>&nbsp;
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<table class="display table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th class="text-center" style="width: 10px;">No.</th>
										<th class="text-center">Nama</th>
										<th class="text-center">Username</th>
										<th class="text-center">Operasi</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$x = 1;
										foreach($dataadmin as $admin){
											?>
											<tr>
												<td><?php echo $x;?></td>
												<td><?php echo $admin->nama;?></td>
												<td><?php echo $admin->username;?></td>
												<td class="text-center">
													<a href="<?php echo base_url("pg_admin/qc_user/edit/" . $admin->id_adm);?>">Edit</a> | <a href="<?php echo base_url("pg_admin/qc_user/ubah_password/" . $admin->id_adm);?>">Ubah Password</a> | <a href="<?php echo base_url("pg_admin/qc_user/assignment_qc/" . $admin->id_adm);?>">Assignment Mapel</a>
												</td>
											</tr>
											<?php
											$x++;
										}
									?>
								</tbody>
							</table>
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
