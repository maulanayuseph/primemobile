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
						<h4 class="title">Quality Control Bank Soal</h4>
              		</div>
              	</div>
              </div>
              <div class="content">
				<div class="row">
					<div class="col-sm-3">
						<select class="form-control" id="filter-kelas">
							<option value="">-- PIlih Kelas --</option>
							<?php
								foreach($datakelas as $kelas){
									$jumlahqckelas = $this->model_banksoal->count_qc_by_kelas($kelas->id_kelas);
									?>
									<option value="<?php echo $kelas->id_kelas;?>"><?php echo $kelas->alias_kelas;?> (<?php echo $jumlahqckelas;?>)</option>
									<?php
								}
							;?>
						</select>
					</div>
					<div class="col-sm-3">
						<select class="form-control" id="filter-mapel">
							<option value="">-- Pilih Mapel --</option>

						</select>
					</div>
					<div class="col-sm-3">
						<select class="form-control" id="filter-kategori">
							<option value="">-- Pilih Kategori --</option>

						</select>
					</div>
					<div class="col-sm-3">
						<select class="form-control" id="filter-status">
							<option value="">-- Pilih Status QC --</option>

						</select>
					</div>
					<div class="col-sm-12">
						&nbsp;
					</div>
					<div class="col-sm-12" id="data-soal">
						
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

$("#filter-kelas").change(function(){
	idkelas = $(this).val();
	$("#filter-mapel").load("ajax_mapel_qc/" + idkelas);
})

$("#filter-mapel").change(function(){
	idmapel = $(this).val();
	$("#filter-kategori").load("ajax_kategori_qc/" + idmapel);
})

$("#filter-kategori").change(function(){
	idkategori = $(this).val();
	$("#filter-status").load("ajax_status_qc/" + idkategori);
})

$("#filter-status").change(function(){
	idkategori 	= $("#filter-kategori").val();
	status 		= $(this).val();
	$("#data-soal").load("ajax_soal_by_status/" + idkategori + "/" + status);
})

$('#data-soal').on('click', '.approve', function(){
	rawid 		= $(this).attr('id');
	idsplit 	= rawid.split("-");
	idsoal 		= idsplit[1];

	if(confirm('Approve Soal ?')){
		$.ajax({
			type: 'POST',
			url: 'ajax_approve',
			data:{
				'idbanksoal'	: idsoal
			}
		});
	}
})

$(document).ajaxSend(function(event, jqxhr, settings){
	$("#modal-loader").modal("show");
});
$(document).ajaxSuccess(function(event, request, options){
	if(options.url !== "ajax_approve"){
		$("#modal-loader").modal("hide");
	}
	if(options.url === "ajax_approve"){
		obj 		= JSON.parse(request.responseText);
		status 		= $("#filter-status").val();
		idkategori	= obj['idkategori'];
		$("#data-soal").load("ajax_soal_by_status/" + idkategori + "/" + status);
	}
});
$(document).ajaxError(function(event, request, options){
	$("#modal-loader").modal("hide");
	$("#modal-error").modal("show");
});

})
</script>

</html>
