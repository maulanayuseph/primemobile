<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
//include "html_header.php"; 
$this->load->view("psep_sekolah/html_header");
?>
<script>
/*
$(function(){
	$("#kelas").change(function(){
		$("#listsiswa").load("ajax_siswa_by_jenjang/" + $("#kelas").val());
	});
});
*/
</script>

<script>
$(function(){
	$("#profilcbt").change(function(){

		//$("#listperingkat").load("cbt/ajax_peringkat/" + $("#profilcbt").val());
		$("#listkategori").load("cbt/listkategori/" + $("#profilcbt").val());
		$("#kelas").load("cbt/ajax_kelas_by_profil/" + $("#profilcbt").val());
	});

	$("#kelas").change(function(){
		tahunajaran = $("#tahunajaran").val();
		kelas 		= $(this).val();
		if(tahunajaran !== 0 && kelas !== 0){
			$("#listperingkat").load("cbt/ajax_peringkat_by_kelas/" + $("#profilcbt").val() + "/" + $(this).val() + "/" + tahunajaran);
		}else{
			$("#listperingkat").load("cbt/ajax_peringkat/" + $("#profilcbt").val());
		}
	});

	$("#tahunajaran").change(function(){
		kelas 		= $("#kelas").val();
		tahunajaran = $(this).val();
		if(kelas !== 0 && tahunajaran !== 0){
			$("#listperingkat").load("cbt/ajax_peringkat_by_kelas/" + $("#profilcbt").val() + "/" + kelas + "/" + $(this).val());
		}else{
			$("#listperingkat").load("cbt/ajax_peringkat/" + $("#profilcbt").val());
		}
	})
});
</script>

<div class="wrapper">
  <?php
  //include "sidebar.php"; 
  $this->load->view("psep_sekolah/sidebar");
  ?>

  <div class="main-panel">
    <?php
    //include "navbar.php"; 
    $this->load->view("psep_sekolah/navbar");
    ?>
    
    <div class="content">      
      <div class="container-fluid">
        <div class="row">
		
		  <div class="col-md-3">
		  	<div class="card">
		  		<div class="header">
	                <h5 class="title text-center">Filter Pencarian</h5>
	            </div>
	            <div class="content">
	                <div class="row">
	                	<div class="col-sm-12">
	                		<select class="form-control" id="filter-kelas">
								<option value="">-- Pilih Kelas -- </option>
								<?php
									foreach($datakelas as $kelas){
										?>
										<option value="<?php echo $kelas->id_kelas;?>"><?php echo $kelas->alias_kelas;?></option>
										<?php
									}
								?>
							</select>
							&nbsp;
							<select class="form-control" id="filter-mapel">
								<option value="">-- Pilih Mata Pelajaran --</option>
							</select>
							&nbsp;
							<select class="form-control" id="filter-kurikulum">
								<option value="">-- Pilih Kurikulum --</option>
								<option value="K-13">K-13</option>
								<option value="K-13REVISI">K-13 REVISI</option>
								<option value="KTSP">KTSP</option>
							</select>
							&nbsp;
							<select class="form-control" id="filter-bab">
								<option value="">-- Pilih Bab --</option>
							</select>
							&nbsp;
							<select class="form-control" id="filter-sub">
								<option value="">-- Pilih Konten --</option>
							</select>
	                	</div>
	                </div>
	            </div>
		  	</div>
		  </div>
		  <div class="col-md-9">
		  	<div class="card" id="wrap-konten">
		  		
		  	</div>
		  </div>

        </div>
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->
	<?php $this->load->view("psep_sekolah/modal_ajax");;?>
    <?php
    //include "footer.php";
    $this->load->view("psep_sekolah/footer");
    ?>
	
  </div>
</div>

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

<!-- PLUGINS FUNCTION -->
 <!-- Nestable plugin  -->

<script type="text/javascript">
$(function(){
	$("#filter-kelas").change(function(){
		idkelas = $(this).val();
		if(idkelas !== ""){
			$("#filter-mapel").load('materi/ajax_mapel_by_kelas/' + idkelas);
			$("#filter-kurikulum").html('<option value="">-- Pilih Kurikulum --</option><option value="K-13">K-13</option><option value="K-13REVISI">K-13 REVISI</option><option value="KTSP">KTSP</option>');
		}
	})
	$("#filter-mapel").change(function(){
		$("#filter-bab").html('<option value="">-- Pilih Bab --</option>');
		$("#filter-sub").html('<option value="">-- Pilih Konten --</option>');
		$("#filter-kurikulum").html('<option value="">-- Pilih Kurikulum --</option><option value="K-13">K-13</option><option value="K-13REVISI">K-13 REVISI</option><option value="KTSP">KTSP</option>');
	});
	$("#filter-kurikulum").change(function(){
		idmapel 	= $("#filter-mapel").val();
		kurikulum 	= $(this).val();
		if(kurikulum !== ""){
			$("#filter-bab").load("materi/ajax_bab/" + idmapel + "/" + kurikulum);
		}
	})
	$("#filter-bab").change(function(){
		idbab 		= $("#filter-bab").val();
		Kurikulum 	= $("#filter-kurikulum").val();
		if(idbab !== "" && Kurikulum !== ""){
			$("#filter-sub").load("materi/ajax_konten/" + idbab + "/" + Kurikulum);
		}
	})

	$("#filter-sub").change(function(){
		idsub = $(this).val();
		if(idsub !== ""){
			$("#wrap-konten").load("materi/ajax_view_konten/" + idsub);
		}
	});
	$(document).ajaxSend(function(event, jqxhr, settings){
		$("#modal-loader").modal("show");
	});
	$(document).ajaxSuccess(function(event, request, options){
		$('#modal-loader').modal('hide');
		$('#mainmodal').modal('hide');
	});
	$(document).ajaxError(function(event, request, options){
		$('#modal-loader').modal('hide');
		$('#modal-error').appendTo("body").modal('show');
	});
})
</script>
</html>
