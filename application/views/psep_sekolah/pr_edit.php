<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>
<script src="<?php echo base_url('assets/js/plugins/tinymce/tinymce.min.js');?>" type="text/javascript"></script>
<script>
$(function(){
	$("#kelas").change(function(){
		$("#listpr").load("ajax_pr/" + $("#kelas").val() + "/" + $("#tahunajaran").val());
	});
	$("#tahunajaran").change(function(){
		$("#listpr").load("ajax_pr/" + $("#kelas").val() + "/" + $("#tahunajaran").val());
	});
	$("#jenjang").change(function(){
		$("#listkelas").load("../ajax_assignment/" + $("#jenjang").val() + "/" + $("#ajaran").val() + "/" + <?php echo $infopr->id_pr;?>);
	});
	$("#ajaran").change(function(){
		$("#listkelas").load("../ajax_assignment/" + $("#jenjang").val() + "/" + $("#ajaran").val() + "/" + <?php echo $infopr->id_pr;?>);
	});
	$("#lihatsoal").click(function(){
		$("#soal").load("../ajax_daftar_soal/" + <?php echo $infopr->id_pr;?>);
	});
	$("#jenjang-nilai").change(function(){
		//$("#listnilai").load("../ajax_penilaian/" + $("#jenjang-nilai").val() + "/" + $("#ajaran-nilai").val() + "/" + <?php echo $infopr->id_pr;?>);
		$("#paralel-nilai").load("../ajax_dropdown_kelas_paralel/" + $("#jenjang-nilai").val());
	});
	$("#paralel-nilai").change(function(){
		$("#listnilai").load("../ajax_penilaian/" + $("#paralel-nilai").val() + "/" + $("#ajaran-nilai").val() + "/" + <?php echo $infopr->id_pr;?>);
	});
	$("#ajaran-nilai").change(function(){
		$("#listnilai").load("../ajax_penilaian/" + $("#paralel-nilai").val() + "/" + $("#ajaran-nilai").val() + "/" + <?php echo $infopr->id_pr;?>);
	});
});
</script>
<div class="wrapper">
  <?php include "sidebar.php"; ?>

  <div class="main-panel">
    <?php include "navbar.php"; ?>
    
    <div class="content">      
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
                <h4 class="title">Kontrol Tugas <?php echo $infopr->nama_pr;?></h4>
              </div>
              <div class="content">
                <div class="row">
					<form action="<?php echo base_url("psep_sekolah/pr/proses_edit");?>" method="post">
					<!--
					<div class="col-md-6">
						<select class="form-control" id="kelas" name="kelas" required>
							<option value="<?php echo $infopr->id_kelas_paralel;?>"><?php echo $infopr->alias_kelas;?> - <?php echo $infopr->kelas_paralel;?></option>
							<?php
								foreach($kelasparalel as $kelas){
									if($kelas->id_kelas_paralel !== $infopr->id_kelas_paralel){
									?>
										<option value="<?php echo $kelas->id_kelas_paralel;?>"><?php echo $kelas->alias_kelas;?> - <?php echo $kelas->kelas_paralel;?></option>
									<?php
									}
								}
							?>
						</select>
					</div>
					<div class="col-md-6">
						<select class="form-control" id="tahunajaran" name="tahun" required>
							<option value="<?php echo $infopr->id_tahun_ajaran;?>"><?php echo $infopr->tahun_ajaran;?></option>
							<?php
								foreach($datatahunajaran as $tahun){
									if($tahun->id_tahun_ajaran !== $infopr->id_tahun_ajaran){
							?>
								<option value="<?php echo $tahun->id_tahun_ajaran;?>"><?php echo $tahun->tahun_ajaran;?></option>
							<?php
									}
								}
							?>
						</select>
					</div>
					-->
					<div class="col-md-6">
						<p>Nama Tugas :
						<p><input type="text" name="nama" class="form-control" placeholder="Masukkan Nama PR" value="<?php echo $infopr->nama_pr;?>" required/>
						<input type="hidden" name="idpr" value="<?php echo $infopr->id_pr;?>" />
					</div>
					<!--
					<div class="col-md-6">
						<p>&nbsp;
						<p>Tanggal Penyelesaian :
						<p>
						<input type="text" name="deadline" id="datepicker" class="form-control" value="<?php echo $infopr->deadline;?>" required/>
					</div>
					-->
					<div class="col-md-6">
						<p>&nbsp;
						<p><input type="submit" class="btn btn-primary" value="Edit" />
					</div>
					</form>
					<p>&nbsp;
                </div>
				<div class="row">
					<div class="col-sm-12">
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation"><a href="#penugasan" aria-controls="penugasan" role="tab" data-toggle="tab">Penugasan</a></li>
							<li role="presentation"><a href="#soal" aria-controls="soal" role="tab" data-toggle="tab" id="lihatsoal">Soal</a></li>
							<li role="presentation"><a href="#penilaian" aria-controls="penilaian" role="tab" data-toggle="tab">Penilaian</a></li>
						</ul>
					</div>
					<div class="col-sm-12">
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane" id="penugasan">
								<div class="row">
									<div class="col-sm-6">
										<select id="jenjang" class="form-control">
											<option value="0">-- Pilih Jenjang Kelas --</option>
											<?php
												foreach($datakelas as $kelas){
													?>
													<option value="<?php echo $kelas->id_kelas;?>"><?php echo $kelas->alias_kelas;?></option>
													<?php
												}
											?>
										</select>
									</div>
									<div class="col-sm-6">
										<select id="ajaran" class="form-control">
											<option value="0">-- Pilih Tahun Ajaran --</option>
											<?php
												foreach($datatahunajaran as $tahun){
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
									<div class="col-sm-12" id="listkelas">
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane" id="soal">
							</div>
							<div role="tabpanel" class="tab-pane" id="penilaian">
								<div class="row">
									<div class="col-sm-4">
										<select id="jenjang-nilai" class="form-control">
											<option value="0">-- Pilih Jenjang Kelas --</option>
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
										<select id="paralel-nilai" class="form-control">
											<option value="0">-- Pilih Kelas Paralel --</option>
										</select>
									</div>
									<div class="col-sm-4">
										<select id="ajaran-nilai" class="form-control">
											<option value="0">-- Pilih Tahun Ajaran --</option>
											<?php
												foreach($datatahunajaran as $tahun){
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
									<div class="col-sm-12" id="listnilai">
										
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->
	
	<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-soal" style="position: fixed; bottom: 60px; right: 20px; background-color: rgba(255,255,255,0.8);">
	  <i class="fa fa-plus" aria-hidden="true"></i>
	</button>
	
    <?php include "footer.php"; ?>
  </div>
</div>

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


<!-- MODAL UNTUK TAMBAH SOAL -->



<div class="modal fade" id="modal-soal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Tambah Soal</h4>
		</div>
		<div class="modal-body" style="height: 80vh; overflow-y: scroll;">
			 <?php
			  $this->load->view("psep_sekolah/pr_modal_tambah_soal");
			  ?>
		</div>
    </div>
  </div>
</div>
<!-- END MODAL TAMBAH SOAL -->

<!-- MODAL UNTUK EDIT SOAL ESSAI -->
<!-- Modal -->
<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
      </div>
      <div class="modal-body" id="konten-edit" style="height: 80vh; overflow-y: scroll;">
        ...
      </div>
    </div>
  </div>
</div>
<!-- end modal edit soal -->
</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>

<!--  Datatables Plugin -->
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>

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
 <!--  Datatables Plugin -->
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>

<script>
$(function(){
$("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });

$("#listnilai").on('click','.reset-nilai', function(){
	rawid 	= $(this).attr("id");
	idsplit = rawid.split("-");
	idpr 	= idsplit[0];
	idsiswa = idsplit[1];

	if(confirm("Reset tugas siswa untuk dikerjakan ulang ?")){
		$.ajax({
			type: 'POST',
			url: '../ajax_reset',
			data:{
				'idpr' 		: idpr,
				'idsiswa'	: idsiswa
			}
		})
	}
})

$(document).ajaxSend(function(event, jqxhr, settings){
	console.log(settings.url);
	alamat 		= settings.url;
	urlpasti	= alamat.substring(0, 18);
	urllihatsoal	= alamat.substring(0, 19);
	//console.log(urlpasti);
	if(urlpasti === "../ajax_assignment"){
		$('#text-load').html('memuat penugasan');
		$('#modal-loader').appendTo("body").modal('show');
	}
	if(urllihatsoal == "../ajax_daftar_soal"){
		$('#text-load').html('memuat daftar soal');
		$('#modal-loader').appendTo("body").modal('show');
	}
	if(settings.url === "../ajax_reset"){
		$('#text-load').html('Reset tugas siswa');
		$('#modal-loader').appendTo("body").modal('show');
	}
});
$(document).ajaxSuccess(function(event, request, options){
	console.log(options.url);
	alamat 		= options.url;
	urlpasti	= alamat.substring(0, 18);
	urllihatsoal	= alamat.substring(0, 19);
	//console.log(urlpasti);
	if(urlpasti === "../ajax_assignment"){
		$('#modal-loader').modal('hide');
	}
	if(urllihatsoal == "../ajax_daftar_soal"){
		$('#modal-loader').modal('hide');
	}
	if(options.url === "../proses_set_jadwal"){
		if(request.responseText === "failed"){
			$('#modal-loader').modal('hide');
			alert("Tanggal akhir akses tidak boleh sebelum tanggal mulai !");
		}else{
			//$('#modal-loader').modal('hide');
			$('#modaledit').modal('hide');
			
			$("#listkelas").load("../ajax_assignment/" + $("#jenjang").val() + "/" + $("#ajaran").val() + "/" + <?php echo $infopr->id_pr;?>);
		}
	}
	if(options.url === "../set_assignment"){
			//console.log(request.responseText);
			if(request.responseText === "sukses"){
				$("#listkelas").load("../ajax_assignment/" + $("#jenjang").val() + "/" + $("#ajaran").val() + "/" + <?php echo $infopr->id_pr;?>);
			}
	}
	if(options.url === "../filter_bank_soal_sekolah"){
		$("#daftarsoal").html(request.responseText);
	}
	if(options.url === "../ajax_reset"){
		idkelasparalel 	= $("#paralel-nilai").val();
		idtahunajaran 	= $("#ajaran-nilai").val();

		$("#listnilai").load("../ajax_penilaian/" + idkelasparalel + "/" + idtahunajaran + "/" + <?php echo $infopr->id_pr;?>);

		$('#modal-loader').modal('hide');
	}
});
$(document).ajaxError(function(event, request, options){
	console.log(options.url);
	alamat 		= options.url;
	urlpasti	= alamat.substring(0, 18);
	urllihatsoal	= alamat.substring(0, 19);
	//console.log(urlpasti);
	if(urlpasti === "../ajax_assignment"){
		console.log(urlpasti);
		$('#modal-loader').modal('hide');
		$('#modal-error').appendTo("body").modal('show');
	}
	if(urllihatsoal == "../ajax_daftar_soal"){
		console.log(urllihatsoal);
		$('#modal-loader').modal('hide');
		$('#modal-error').appendTo("body").modal('show');
	}
})
});
</script>
</html>
