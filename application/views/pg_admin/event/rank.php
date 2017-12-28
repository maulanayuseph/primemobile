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
						<h4 class="title">Manajemen Event</h4>
              		</div>
              	</div>
              </div>
              <div class="content">
				<div class="row">
					<div class="col-sm-12">
						<select class="form-control" id="select-cbt">
							<option value="">-- Pilih CBT --</option>
							<?php
								foreach($datacbt as $cbt){
									?>
									<option value="<?php echo $cbt->id_tryout;?>"><?php echo $cbt->nama_profil;?></option>
									<?php
								}
							?>
						</select>
					</div>
					<div class="col-sm-12" id="main-col-peringkat">
						
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

$("#select-cbt").change(function(){
	idcbt 	= $(this).val();

	$("#main-col-peringkat").load("../ajax_peringkat_cbt/" + idcbt);
})

$('#main-col-peringkat').on('click', '.filter-rank-prov', function(){
	idprovinsi = $("#select-prov").val();
	if(idprovinsi !== ""){
		$(".konten-rank-provinsi").load("../ajax_peringkat_by_provinsi/" + idprovinsi + "/" + $("#idprofil").val());
	}
})

$("#main-col-peringkat").on('change', '#select-prov-sekolah', function(){
	idprovinsi = $(this).val();
	$("#select-kota-sekolah").load("../ajax_kota_by_provinsi/" + idprovinsi);
})

$("#main-col-peringkat").on('change', '#select-kota-sekolah', function(){
	idkota = $(this).val();
	$("#select-sekolah-sekolah").load("../ajax_sekolah_by_kota/" + idkota + "/" + $("#idkelas").val());
})

$('#main-col-peringkat').on('click', '.filter-rank-sekolah', function(){
	idsekolah = $("#select-sekolah-sekolah").val();
	if(idsekolah !== "" ){
		$(".konten-rank-sekolah").load("../ajax_peringkat_by_sekolah/" + idsekolah + "/" +  $("#idprofil").val());
	}
})

$('#main-col-peringkat').on('click', '.filter-rank-wilayah', function(){
	idwilayah = $("#select-wilayah").val();
	if(idwilayah !== "" ){
		$(".konten-rank-wilayah").load("../ajax_peringkat_by_wilayah/" + idwilayah + "/" +  $("#idprofil").val());
	}
})

$(document).ajaxSend(function(event, jqxhr, settings){
	$("#modal-loader").modal("show");
});
$(document).ajaxSuccess(function(event, request, options){
	$("#modal-loader").modal("hide");
});
$(document).ajaxError(function(event, request, options){
	$("#modal-loader").modal("hide");
	$("#modal-error").modal("show");
});

})
</script>

</html>
