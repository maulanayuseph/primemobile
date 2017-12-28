<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>

<div class="wrapper">
  <?php include "sidebar.php"; ?>

  <div class="main-panel">
    <?php include "navbar.php"; ?>
    
    <div class="content">      
      <div class="container-fluid">
	  
        <div class="row">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" id="tab-mapel"><a href="#mapel" aria-controls="home" role="tab" data-toggle="tab">MATA PELAJARAN</a></li>
				<li role="presentation" id="tab-bab"><a href="#bab" aria-controls="profile" role="tab" data-toggle="tab">MATERI</a></li>
				<li role="presentation" id="tab-silabus"><a href="#silabus" aria-controls="silabus" role="tab" data-toggle="tab">SILABUS</a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
			
				<div role="tabpanel" class="tab-pane fade" id="mapel">
					<div class="row">
						<div class="col-sm-12">
							&nbsp;
						</div>
						<div class="col-sm-6">
							<select class="form-control" id="pilih-kelas-mapel">
								<option value="0">--- Pilih Kelas ---</option>
								<?php
									foreach($datakelas as $kelas){
										?>
										<option value="<?php echo $kelas->id_kelas;?>"><?php echo $kelas->alias_kelas;?></option>
										<?php
									}
								?>
							</select>
							&nbsp;
						</div>
						<div class="col-sm-6" style="text-align: right;">
							<button class="btn btn-primary" id="tambah-mapel"  data-toggle="modal" data-target="#modalsilabus">+ Tambah Mata Pelajaran</button>
						</div>
						
						<div class="col-sm-12" id="daftar-mapel">
							
						</div>
					</div>
				</div>
				
				<div role="tabpanel" class="tab-pane fade" id="bab">
					<div class="row">
						<div class="col-sm-12">
							&nbsp;
						</div>
						<div class="col-sm-12" style="text-align: right;">
							<button class="btn btn-primary" id="tambah-bab" data-toggle="modal" data-target="#modalsilabus" style="width: 100%;">+ Tambah Bab</button>
							<br>&nbsp;
						</div>
						<div class="col-sm-3">
							<select id="kelas-tab-bab" class="form-control"> 
								<option value="0">--- Pilih Kelas ---</option>
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
							<select class="form-control" id="mapel-tab-bab">
								<option value='0'>-- Pilih Mata Pelajaran --</option>
							</select>
						</div>
						<div class="col-sm-3">
							<select class="form-control" id="kurikulum-tab-bab">
								<option value="0">-- Pilih Kurikulum --</option>
								<option value="KTSP">KTSP</option>
								<option value="K-13">K-13</option>
							</select>
						</div>
						<div class="col-sm-3">
							<select class="form-control" id="tahun-tab-bab">
								<option value="0">-- Pilih Tahun Ajaran --</option>
								<?php
									foreach($tahunajaran as $tahun){
										?>
										<option value="<?php echo $tahun->id_tahun_ajaran;?>"><?php echo $tahun->tahun_ajaran;?></option>
										<?php
									}
								?>
							</select>
						</div>
						<div class="col-sm-12">
							&nbsp;
						</div>
						<div class="col-sm-12" id="daftar-bab">
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane fade" id="silabus">
					<div class="row">
						<div class="col-sm-12">
							<br>&nbsp;
							<br><button class="btn btn-primary" id="tambah-kd" data-toggle="modal" data-target="#modalsilabus" style="width: 100%;">+ Tambah Kompetensi Dasar</button>
							<br>&nbsp;
						</div>
						<div class="col-sm-4">
							<select class="form-control" id="kelas-kd">
								<option value="0">--- Pilih Kelas ---</option>
								<?php
									foreach($datakelas as $kelas){
										?>
										<option value="<?php echo $kelas->id_kelas;?>"><?php echo $kelas->alias_kelas;?></option>
										<?php
									}
								?>
							</select>
						</div>
						<div class="col-sm-4">
							<select class="form-control" id="mapel-kd">
								<option value='0'>-- Pilih Mata Pelajaran --</option>
							</select>
						</div>
						<div class="col-sm-4">
							<select class="form-control" id="tahun-kd">
								<option value="0">-- Pilih Tahun Ajaran --</option>
								<?php
									foreach($tahunajaran as $tahun){
										?>
										<option value="<?php echo $tahun->id_tahun_ajaran;?>"><?php echo $tahun->tahun_ajaran;?></option>
										<?php
									}
								?>
							</select>
						</div>
						<div class="col-sm-12">
						&nbsp;
						</div>
						<div class="col-sm-12" id="daftar-kd">

						</div>
					</div>
				</div>
			</div>
			
        </div>
		
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->

    <?php include "footer.php"; ?>

  </div>
</div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="modalsilabus" id="modalsilabus">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
		</div>
		<div class="modal-body" id="konten-modal">
		</div>
    </div>
  </div>
</div>

<!-- MODAL LOADING AJAX -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-loader" style="display: none;">
  Launch demo modal
</button>

<!-- Modal untuk loading ajax -->
<div class="modal fade" id="modal-loader" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <img src="<?php echo base_url("assets/img/rolling.gif");?>"/>
		<p id="text-load"> Memproses</p>
      </div>
    </div>
  </div>
</div>
<!-- END MODAL LOADING AJAX -->

<!-- MODAL ERROR AJAX -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-error" style="display: none;">
  Launch demo modal
</button>

<!-- Modal untuk error ajax -->
<div class="modal fade" id="modal-error" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
		<p>Terjadi kesalahan, periksa koneksi atau ulangi lagi
      </div>
	  <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
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

<script>
$(function(){
	$("#pilih-kelas-mapel").change(function(){
		$("#daftar-mapel").load("silabus/ajax_mapel_by_kelas/" + $("#pilih-kelas-mapel").val());
	});
	$("#kelas-tab-bab").change(function(){
		$("#mapel-tab-bab").load("silabus/ajax_dropdown_mapel_by_kelas/" + $("#kelas-tab-bab").val());
	});
	$("#kelas-kd").change(function(){
		$("#mapel-kd").load("silabus/ajax_dropdown_mapel_by_kelas/" + $(this).val());
	});
	$("#tambah-mapel").click(function(){
		$("#konten-modal").load("silabus/ajax_editor_mapel");
	});
	$("#tambah-bab").click(function(){
		$("#konten-modal").load("silabus/ajax_editor_bab");
	});
	$("#mapel-tab-bab").change(function(){
		$("#daftar-bab").load("silabus/ajax_bab/" + $("#mapel-tab-bab").val() + "/" + $("#kurikulum-tab-bab").val() + "/" + $("#tahun-tab-bab").val());
	});
	$("#kurikulum-tab-bab").change(function(){
		$("#daftar-bab").load("silabus/ajax_bab/" + $("#mapel-tab-bab").val() + "/" + $("#kurikulum-tab-bab").val() + "/" + $("#tahun-tab-bab").val());
	});
	$("#tahun-tab-bab").change(function(){
		$("#daftar-bab").load("silabus/ajax_bab/" + $("#mapel-tab-bab").val() + "/" + $("#kurikulum-tab-bab").val() + "/" + $("#tahun-tab-bab").val());
	});
	$("#tambah-kd").click(function(){
		$("#konten-modal").load("silabus/ajax_kd");
	});

	//FUNGSI UNTUK FILTER KOMPETENSI DASAR
	$("#mapel-kd").change(function(){
		$("#daftar-kd").load("silabus/ajax_daftar_kd/" + $(this).val() + "/" + $("#tahun-kd").val());
	});
	$("#tahun-kd").change(function(){
		$("#daftar-kd").load("silabus/ajax_daftar_kd/" + $("#mapel-kd").val() + "/" + $(this).val());
	});
	//END FUNGSI FILTER KOMPETENSI DASAR

	$(document).ajaxSend(function(event, jqxhr, settings){
		alamat 			= settings.url;
		urlfilterbab	= alamat.substring(0, 16);
		urlfilterkd		= alamat.substring(0, 22);
		if(urlfilterbab === "silabus/ajax_bab"){
			$('#text-load').html('memuat bab');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(urlfilterkd === "silabus/ajax_daftar_kd"){
			$('#text-load').html('memuat kompetensi dasar');
			$('#modal-loader').appendTo("body").modal('show');
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		alamat 			= options.url;
		urlfilterbab	= alamat.substring(0, 16);
		urlfilterkd		= alamat.substring(0, 22);
		if(urlfilterbab === "silabus/ajax_bab"){
			$('#modal-loader').modal('hide');
		}
		if(urlfilterkd === "silabus/ajax_daftar_kd"){
			$('#modal-loader').modal('hide');
		}
	});
});
</script>

</html>
