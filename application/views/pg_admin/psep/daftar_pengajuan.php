<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view('pg_admin/html_header'); ?>

<div class="wrapper">
	<?php
		if($this->session->userdata("level") == "adminpa"){
			$this->load->view('pg_admin/sidebar_pa');
		}else{
			$this->load->view('pg_admin/sidebar');
		}
	?>

  <div class="main-panel">
		<?php $this->load->view('pg_admin/navbar'); ?>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
                <h4 class="title"><?= $judul ?></h4>
                <?php echo $this->session->flashdata('alert'); ?>
              </div>
              <div class="content">
              	<div class="row">
              		<div class="col-sm-6">
              		</div>
              		<div class="col-sm-6" style="text-align: right;">
              			<a class="btn btn-sm btn-danger" href="<?php echo base_url("pg_admin/psep/pengajuan");?>">Buat Pengajuan Aktivasi PSEP</a>
              		</div>
              		<div class="col-sm-12">
              			&nbsp;
              		</div>
					<div class="col-sm-12">
						<table class="table table-responsive table-bordered table-striped display">
							<thead>
								<tr>
									<th style="width: 10px;">#</th>
									<th class="text-center">Tanggal Pengajuan</th>
									<th class="text-center">Sekolah</th>
									<th class="text-center">Dealer</th>
									<th class="text-center">Aktivasi PSEP</th>
									<th class="text-center">Status</th>
									<th class="text-center">Operasi</th>
								</tr>
							</thead>
							<tbody>
								<?php

								?>
								<tr>
									<td class="text-center"></td>
									<td class="text-center"></td>
									<td class="text-center"></td>
									<td class="text-center"></td>
									<td class="text-center"></td>
									<td class="text-center"></td>
									<td class="text-center"></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
		<?php $this->load->view('pg_admin/footer'); ?>
  </div>
</div>
<?php $this->load->view("pg_admin/modal_ajax");?>
</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-1.10.2.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>

<!--  Datatables Plugin -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="<?php echo base_url('assets/js/demo.js');?>"></script>

<!-- CUSTOM JS FUNCTION -->
<!-- Reset Form -->


<!-- PLUGINS FUNCTION -->
<!-- Chosen - select box plugin  -->
<script src="<?php echo base_url('assets/js/plugins/chosen/chosen.jquery.js');?>" type="text/javascript"></script>

<script>
$(function(){
	$('table.display').DataTable();
	$(document).ajaxSend(function(event, jqxhr, settings){
	alamat 			= settings.url;
		if(settings.url === ""){

		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		alamat 			= options.url;
		if(options.url === ""){

		}
	});
	$(document).ajaxError(function(event, request, options){
		alamat 			= options.url;
		if(options.url === ""){

		}
	});

});
</script>

</html>
