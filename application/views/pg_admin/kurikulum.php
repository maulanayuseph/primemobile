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
        <?php echo $this->session->flashdata('alert'); ?>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
                <h4 class="title">Manajemen Kurikulum Materi</h4>
                <p class="category">Pengorganisasian Struktur Kurikulum Materi</p>
              </div>
              <div class="content">
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation"><a href="#tema" aria-controls="tema" role="tab" data-toggle="tab">TEMATIK K13 REVISI</a></li>

					<li role="presentation"><a href="#tema-bab" aria-controls="tema-bab" role="tab" data-toggle="tab">SET TEMA BAB K13 REVISI</a></li>



					<li role="presentation"><a href="#bab" aria-controls="bab" role="tab" data-toggle="tab">BAB</a></li>
					<li role="presentation"><a href="#subbab" aria-controls="subbab" role="tab" data-toggle="tab">SUB-BAB</a></li>
					<li role="presentation"><a href="#setkurikulum" aria-controls="setkurikulum" role="tab" data-toggle="tab">SET KURIKULUM SUB-BAB</a></li>
				</ul>
				
				<div class="tab-content">

					<!-- TAB UNTUK TEMATIK K13 REVISI-->
					<!-- ############################ -->
					<!-- ############################ -->
					<!-- ############################ -->
					<div role="tabpanel" class="tab-pane fade" id="tema">
						<div class="row">
							<div class="col-sm-6">
								<select class="form-control" id="kelas-tematik">
									<option value="0">--- Pilih Kelas ---</option>
									<?php 
									foreach ($select_options_kelas as $item) { 
									?>
										<option value="<?php echo $item->id_kelas;?>" > <?php echo $item->alias_kelas; ?> </option>
									<?php
										}
									?>
								</select>
							</div>
							<div class="col-sm-6">
								<button class="btn btn-sm btn-danger" style="width: 100%;" id="btn-tambah-tema" data-toggle="modal" data-target="#modal-kurikulum">Tambah Tema</button>
							</div>
							<div class="col-sm-12">
								&nbsp;
							</div>
							<div class="col-sm-12" id="daftar-tema">

							</div>
						</div>
					</div>
					<!-- END TAB UNTUK TEMATIK K13 REVISI-->
					<!-- ############################ -->
					<!-- ############################ -->
					<!-- ############################ -->
					<div role="tabpanel" class="tab-pane fade" id="tema-bab">
						<div class="row">
							<div class="col-sm-6">
								<select class="form-control" id="kelas-tema-bab">
									<option value="0">--- Pilih Kelas ---</option>
									<?php 
									foreach ($select_options_kelas as $item) { 
									?>
										<option value="<?php echo $item->id_kelas;?>" > <?php echo $item->alias_kelas; ?> </option>
									<?php
										}
									?>
								</select>
							</div>
							<div class="col-sm-6">
								<select class="form-control" id="mapel-tema-bab">
									<option value="0">--- Pilih Kelas ---</option>
								</select>
							</div>
							<div class="col-sm-12">
								&nbsp;
							</div>
							<div class="col-sm-12" id="daftar-tema-bab">
								
							</div>
						</div>
					</div>

					<div role="tabpanel" class="tab-pane fade" id="bab">
						<form action="<?php echo base_url("pg_admin/kurikulum/proses_edit");?>" method="post">
							<div  class="table-responsive">
								<table class="table table-stripped">
									<tr>
									<td>
										<select id="kelas" class="form-control">
											<option value="">Pilih Kelas...</option>
											  <?php 
											  foreach ($select_options_kelas as $item) { 
											  ?>
											  <option value="<?php echo $item->id_kelas;?>" > <?php echo $item->alias_kelas; ?> </option>
											  <?php } ?>
										</select>
									</td>
									<td>
										<select id="mapel" class="form-control" name="idmapel" required>
											<option value="">Pilih Mata Pelajaran...</option>
										</select>
									</td>
									</tr>
								</table>
							</div>
							<div class="table-responsive">
								<table class="table table-stripped">
									<thead>
										<tr>
											<th>Judul K13</th>
											<th>Judul KTSP</th>
											<th style="width: 100px;">BAB K13</th>
											<th style="width: 100px;">BAB KTSP</th>
										</tr>
									</thead>
									<tbody id="list-bab">
									</tbody>
								</table>
							</div>
						</form>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="subbab">
						<form action="<?php echo base_url("pg_admin/kurikulum/proses_edit_sub");?>" method="post">
						<div  class="table-responsive">
							<table class="table table-stripped">
								<tr>
									<td>
										<select id="kelassub" class="form-control">
											<option value="">Pilih Kelas...</option>
											  <?php 
											  foreach ($select_options_kelas as $item) { 
											  ?>
											  <option value="<?php echo $item->id_kelas;?>" > <?php echo $item->alias_kelas; ?> </option>
											  <?php } ?>
										</select>
									</td>
									<td>
										<select id="mapelsub" class="form-control" name="idmapel" required>
											<option value="">Pilih Mata Pelajaran...</option>
										</select>
									</td>
									<td>
										<select id="drop-bab" class="form-control" name="idmapok" required>
											<option value="">Pilih Bab...</option>
										</select>
									</td>
								</tr>
							</table>
						</div>
						<div class="table-responsive">
							<table class="table table-stripped">
								<thead>
									<tr>
										<th>Judul Sub-Bab</th>
										<th style="width: 100px;">SUB-BAB K13</th>
										<th style="width: 100px;">SUB-BAB KTSP</th>
									</tr>
								</thead>
								<tbody id="list-sub-bab">
								</tbody>
							</table>
						</div>
						</form>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="setkurikulum">
						<form action="<?php echo base_url("pg_admin/kurikulum/proses_set_kurikulum");?>" method="post">
							<div  class="table-responsive">
								<table class="table table-stripped">
									<tr>
										<td>
											<select id="setkelas" class="form-control">
												<option value="">Pilih Kelas...</option>
												  <?php 
												  foreach ($select_options_kelas as $item) { 
												  ?>
												  <option value="<?php echo $item->id_kelas;?>" > <?php echo $item->alias_kelas; ?> </option>
												  <?php } ?>
											</select>
										</td>
										<td>
											<select id="setmapel" class="form-control" name="idmapel" required>
												<option value="">Pilih Mata Pelajaran...</option>
											</select>
										</td>
										<td>
											<select id="setbab" class="form-control" name="idmapok" required>
												<option value="">Pilih Bab...</option>
											</select>
										</td>
									</tr>
								</table>
							</div>
							<div class="table-responsive">
								<table class="table table-stripped">
									<thead>
										<tr>
											<th>JUDUL SUB-BAB</th>
											<th>SET KURIKULUM</th>
										</tr>
									</thead>
									<tbody id="setlist">
									</tbody>
								</table>
							</div>
						</form>
					</div>
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



<!--MODAL AJAX -->
<!-- ################################# -->
<!-- ################################# -->
<!-- ################################# -->

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


<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-error" style="display: none;">
  Launch demo modal
</button>

<!-- Modal untuk error ajax -->
<div class="modal fade" id="modal-kurikulum" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body" id="konten-modal-ajax">
		
      </div>
	  <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>




<!--END MODAL AJAX -->
<!-- ################################# -->
<!-- ################################# -->
<!-- ################################# -->

<script>
$(function(){
	$("#kelas").change(function(){
		$("#mapel").load("banksoal/ajax_mapel/" + $("#kelas").val());
	});
	$("#mapel").change(function(){
		$("#list-bab").load("kurikulum/ajax_materi_pokok/" + $("#kelas").val() + "/" + $("#mapel").val());
	});
	
	$("#kelassub").change(function(){
		$("#mapelsub").load("banksoal/ajax_mapel/" + $("#kelassub").val());
	});
	
	$("#mapelsub").change(function(){
		$("#drop-bab").load("kurikulum/ajax_materi_pokok_drop/" + $("#kelassub").val() + "/" + $("#mapelsub").val());
	});
	
	$("#drop-bab").change(function(){
		$("#list-sub-bab").load("kurikulum/ajax_sub_bab/" + $("#drop-bab").val());
	});
	
	$("#setkelas").change(function(){
		$("#setmapel").load("banksoal/ajax_mapel/" + $("#setkelas").val());
	});
	
	$("#setmapel").change(function(){
		$("#setbab").load("kurikulum/ajax_materi_pokok_drop/" + $("#setkelas").val() + "/" + $("#setmapel").val());
	});
	
	$("#setbab").change(function(){
		$("#setlist").load("kurikulum/ajax_sub_bab_kurikulum/" + $("#setbab").val());
	});

	$("#kelas-tematik").change(function(){
		$("#daftar-tema").load("kurikulum/ajax_tema/" + $(this).val());
	})

	$("#btn-tambah-tema").click(function(){
		$("#konten-modal-ajax").load("kurikulum/ajax_tambah_tema");
	})

	$("#kelas-tema-bab").change(function(){
		$("#mapel-tema-bab").load("banksoal/ajax_mapel/" + $(this).val());
	})

	$("#mapel-tema-bab").change(function(){
		$("#daftar-tema-bab").load("kurikulum/bab_k13_rev/" + $(this).val());
	})

	$(document).ajaxSend(function(event, jqxhr, settings){
		alamat 			= settings.url;
		alamatedittema 	= alamat.substring(0, 24);
		alamatloadtema	= alamat.substring(0,19);
		alamattambahsub	= alamat.substring(0, 25);
		alamatloadbabtema 	= alamat.substring(0, 21);
		alamatsetsubbabtema	= alamat.substring(0, 27);
		if(settings.url === "kurikulum/ajax_tambah_tema"){
			$('#text-load').html('Memuat Editor Tema');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(settings.url === "kurikulum/proses_tambah_tema"){
			$('#text-load').html('Menyimpan Tema');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(alamatedittema === "kurikulum/ajax_edit_tema"){
			$('#text-load').html('Memuat Tema');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(settings.url === "kurikulum/proses_edit_tema"){
			$('#text-load').html('Menyimpan Tema');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(alamatloadtema === "kurikulum/ajax_tema"){
			$('#text-load').html('Memuat Tema');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(settings.url === "kurikulum/proses_hapus_tema"){
			$('#text-load').html('Menghapus Tema');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(alamattambahsub === "kurikulum/tambah_sub_tema"){
			$('#text-load').html('Memuat editor sub tema');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(settings.url === "kurikulum/proses_tambah_sub_tema"){
			$('#text-load').html('Menyimpan sub tema');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(settings.url === "kurikulum/proses_edit_sub_tema"){
			$('#text-load').html('Menyimpan sub tema');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(settings.url === "kurikulum/proses_hapus_sub_tema"){
			$('#text-load').html('Menghapus Sub Tema');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(alamatloadbabtema === "kurikulum/bab_k13_rev"){
			$('#text-load').html('Memuat Bab');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(settings.url === "kurikulum/proses_edit_tema_bab"){
			$('#text-load').html('Menyimpan Tema Bab');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(alamatsetsubbabtema === "kurikulum/edit_sub_bab_tema"){
			$('#text-load').html('Memuat Sub Bab');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(settings.url === "kurikulum/proses_edit_sub_bab_tema"){
			$('#text-load').html('Memasang Sub Tema');
			$('#modal-loader').appendTo("body").modal('show');
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		alamat 			= options.url;
		alamatedittema 	= alamat.substring(0, 24);
		alamatloadtema	= alamat.substring(0,19);
		alamattambahsub	= alamat.substring(0, 25);
		alamatloadbabtema 	= alamat.substring(0, 21);
		alamatsetsubbabtema	= alamat.substring(0, 27);
		if(options.url === "kurikulum/ajax_tambah_tema"){
			$('#modal-loader').modal('hide');
		}
		if(options.url === "kurikulum/proses_tambah_tema"){
			//$('#modal-loader').modal('hide');
			$('#modal-kurikulum').modal('hide');
			$("#daftar-tema").load("kurikulum/ajax_tema/" + request.responseText);
		}
		if(alamatedittema === "kurikulum/ajax_edit_tema"){
			$('#modal-loader').modal('hide');
		}
		if(options.url === "kurikulum/proses_edit_tema"){
			//$('#modal-loader').modal('hide');
			$('#modal-kurikulum').modal('hide');
			$("#daftar-tema").load("kurikulum/ajax_tema/" + $("#kelas-tematik").val());
		}
		if(alamatloadtema === "kurikulum/ajax_tema"){
			$('#modal-loader').modal('hide');
		}
		if(options.url === "kurikulum/proses_hapus_tema"){
			$("#daftar-tema").load("kurikulum/ajax_tema/" + $("#kelas-tematik").val());
		}
		if(alamattambahsub === "kurikulum/tambah_sub_tema"){
			$('#modal-loader').modal('hide');
		}
		if(options.url === "kurikulum/proses_tambah_sub_tema"){
			$('#modal-kurikulum').modal('hide');
			$("#daftar-tema").load("kurikulum/ajax_tema/" + $("#kelas-tematik").val());
		}
		if(options.url === "kurikulum/proses_edit_sub_tema"){
			$('#modal-kurikulum').modal('hide');
			$("#daftar-tema").load("kurikulum/ajax_tema/" + $("#kelas-tematik").val());
		}
		if(options.url === "kurikulum/proses_hapus_sub_tema"){
			$("#daftar-tema").load("kurikulum/ajax_tema/" + $("#kelas-tematik").val());
		}
		if(alamatloadbabtema === "kurikulum/bab_k13_rev"){
			$('#modal-loader').modal('hide');
		}
		if(options.url === "kurikulum/proses_edit_tema_bab"){
			$('#modal-kurikulum').modal('hide');
			$("#daftar-tema-bab").load("kurikulum/bab_k13_rev/" + $("#mapel-tema-bab").val());
		}
		if(alamatsetsubbabtema === "kurikulum/edit_sub_bab_tema"){
			$('#modal-loader').modal('hide');
		}
		if(options.url === "kurikulum/proses_edit_sub_bab_tema"){
			$('#modal-kurikulum').modal('hide');
			$("#daftar-tema-bab").load("kurikulum/bab_k13_rev/" + $("#mapel-tema-bab").val());
		}
	});
	$(document).ajaxError(function(event, request, options){
		alamat 			= options.url;
		alamatedittema 	= alamat.substring(0, 24);
		alamatloadtema	= alamat.substring(0,19);
		alamattambahsub	= alamat.substring(0, 25);
		alamatloadbabtema 	= alamat.substring(0, 21);
		alamatsetsubbabtema	= alamat.substring(0, 27);
		if(options.url === "kurikulum/ajax_tambah_tema"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
		if(options.url === "kurikulum/proses_tambah_tema"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
		if(alamatedittema === "kurikulum/ajax_edit_tema"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
			$('#modal-kurikulum').modal('hide');
		}
		if(options.url === "kurikulum/proses_edit_tema"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
		if(alamatloadtema === "kurikulum/ajax_tema"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
		if(options.url === "kurikulum/proses_hapus_tema"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
		if(alamattambahsub === "kurikulum/tambah_sub_tema"){
			$('#modal-loader').modal('hide');
			$('#modal-kurikulum').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
		if(options.url === "kurikulum/proses_tambah_sub_tema"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
		if(options.url === "kurikulum/proses_edit_sub_tema"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
		if(options.url === "kurikulum/proses_hapus_sub_tema"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
		if(alamatloadbabtema === "kurikulum/bab_k13_rev"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
		if(options.url === "kurikulum/proses_edit_tema_bab"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
		if(alamatsetsubbabtema === "kurikulum/edit_sub_bab_tema"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
		if(options.url === "kurikulum/proses_edit_sub_bab_tema"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
	})
});
</script>
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

</html>
