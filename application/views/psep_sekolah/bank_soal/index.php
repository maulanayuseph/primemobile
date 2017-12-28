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
		
		  <div class="col-md-12">
		  	<div class="card">
		  		<div class="header">
		  			<div class="col-sm-6">
		  				<h4 class="title">Bank Soal</h4>
		  			</div>
		  			<div class="col-sm-6" style="text-align: right;">
		  				<a href="<?php echo base_url("psep_sekolah/bank_soal/tambah_soal");?>" class="btn btn-sm btn-danger">Tambah Soal</a>
		  			</div>
	            </div>
	            <div class="content">
	                <div class="row">
	                	<div class="col-sm-12">
	                		&nbsp;
	                	</div>
	                	<div class="col-sm-3">
							<select class="form-control" id="filter-kelas">
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
	                	<div class="col-sm-3">
							<select class="form-control" id="filter-mapel">
								<option value="">-- Pilih Mata Pelajaran --</option>
								<?php
									foreach($datamapel as $mapel){
										?>
										<option value="<?php echo $mapel->id_mapel;?>"><?php echo $mapel->nama_mapel;?></option>
										<?php
									}
								?>
							</select>
	                	</div>
	                	<div class="col-sm-3">
							<select class="form-control" id="filter-kategori">
								<option value="">-- Pilih Kategori --</option>
								<?php
									foreach($datakategori as $kategori){
										?>
										<option value="<?php echo $kategori->id_atribut;?>"><?php echo $kategori->atribut;?></option>
										<?php
									}
								?>
							</select>
	                	</div>
	                	<div class="col-sm-3">
	                		<button class="btn btn-danger" id="submit-filter" style="width: 100%;">
	                			Filter Soal
	                		</button>
	                	</div>
	                	<div class="col-sm-12">
	                		&nbsp;
	                	</div>
	                	<div class="col-sm-12" id="list-soal">
	                	</div>
	                </div>
	            </div>
		  	</div>
		  </div>

		  

        </div>
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->
	
    <?php
    //include "footer.php";
    $this->load->view("psep_sekolah/footer");
    ?>
	
  </div>
</div>
<?php $this->load->view("psep_sekolah/modal_ajax");?>
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

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>

<script type="text/javascript">
$(function(){
	
	$("#submit-filter").click(function(){
		idkelas 	= $("#filter-kelas").val();
		idmapel 	= $("#filter-mapel").val();
		idatribut 	= $("#filter-kategori").val();
		if(idkelas !== "" && idmapel !== "" && idatribut !== ""){
			$.ajax({
				type: 'POST',
				url: 'bank_soal/ajax_filter_soal',
				data:{
					'idkelas'	: idkelas,
					'idmapel'	: idmapel,
					'idatribut'	: idatribut
				}
			})
		}else{
			alert("Lengkapi filter!");
		}
	})

	$('#list-soal').on('click', '.hapus', function(){
		if(confirm("Proses hapus soal?")){
			rawid 	= $(this).attr('id');
			idsplit = rawid.split("-");
			idsoal 	= idsplit[1];
			$.ajax({
				type: 'POST',
				url: 'bank_soal/hapus_soal',
				data:{
					'idsoal'	: idsoal
				}
			})
		}
	})

	$(document).ajaxSend(function(event, jqxhr, settings){
		$("#modal-loader").modal("show");
	});
	$(document).ajaxSuccess(function(event, request, options){
		if(options.url !== 'bank_soal/hapus_soal'){
			$('#modal-loader').modal('hide');
		}
		
		if(options.url === "bank_soal/ajax_filter_soal"){
			$("#list-soal").html(request.responseText);
		}
		if(options.url === 'bank_soal/hapus_soal'){
			obj = JSON.parse(request.responseText);
			$.ajax({
				type: 'POST',
				url: 'bank_soal/ajax_filter_soal',
				data:{
					'idkelas'	: obj['idkelas'],
					'idmapel'	: obj['idmapel'],
					'idatribut'	: obj['idatribut']
				}
			})
		}
	});
	$(document).ajaxError(function(event, request, options){
		$('#modal-loader').modal('hide');
		$('#modal-error').appendTo("body").modal('show');
	});
})
</script>
</html>
