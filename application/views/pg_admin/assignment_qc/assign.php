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

          <div class="col-md-3">
              <div class="content">
				<div class="row">
					<div class="col-sm-12">
						<table class="table">
							<tr>
								<td>Username</td> 
								<td>:</td>
								<td><?php echo $user->username;?></td>
							</tr>
						</table>
					</div>
				</div>
              </div>
          </div>
		
		<div class="col-sm-12">
			&nbsp;
		</div>

		<div class="col-sm-6">
			<div class="card">
				<div class="content">
					<div class="row">
						<div class="col-sm-12">
							<select class="form-control" id="select-kelas">
								<option value="">-- Pilih Kelas --</option>
								<?php
									foreach($datakelas as $kelas){
										?>
										<option value="<?php echo $kelas->id_kelas;?>"><?php echo $kelas->alias_kelas;?></option>
										<?php
									}
								?>
							</select>
						</div>
						<div class="col-sm-12" id="list-mapel">
							
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-sm-6">
			<div class="card">
				<div class="content">
					<div class="row">
						<div class="col-sm-12">
							<table class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th class="text-center">Kelas</th>
										<th class="text-center">Mapel</th>
										<th class="text-center">Operasi</th>
									</tr>
								</thead>
								<tbody id="assignment-adm">
									
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

$("#select-kelas").change(function(){
	idkelas = $(this).val();
	if(idkelas !== ""){
		$("#list-mapel").load("../ajax_mapel_by_kelas/" + idkelas);
	}
});

$('#list-mapel').on('click', '.assign', function(){
	rawid 		= $(this).attr("id");
	idsplit		= rawid.split("-");
	idmapel 	= idsplit[1];

	$.ajax({
		type: 'POST',
		url: '../assign_mapel',
		data:{
			'idmapel'	: idmapel
		}
	})
});

$(document).ajaxSend(function(event, jqxhr, settings){
	$("#modal-loader").modal('show');
});
$(document).ajaxSuccess(function(event, request, options){
	
});
==$(document).ajaxError(function(event, request, options){
	$("#modal-loader").modal("hide");
});

})
</script>

</html>
