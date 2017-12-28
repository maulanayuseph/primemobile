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
						<h4 class="title">Penjadwalan CBT Sekolah <?php echo $event->nama_event;?></h4>
              		</div>
              	</div>
              </div>
              <div class="content">
				<div class="row">
					<div class="col-sm-12">
						<table class="table display table-bordered table-striped tabel-jadwal">
							<thead>
								<tr>
									<th style="width: 10px;">#</th>
									<th class="text-center">CBT</th>
									<th class="text-center">Kelas</th>
									<th class="text-center">Operasi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$x = 1;
									foreach($datacbt as $cbt){
										
										?>
										<tr>
											<td><?php echo $x;?></td>
											<td>
												<a href="#cbt-<?php echo $cbt->id_tryout;?>" data-toggle="collapse" aria-expanded="false" aria-controls="cbt-<?php echo $cbt->id_tryout;?>" id="titletryout-<?php echo $cbt->id_tryout;?>">
													<?php echo $cbt->nama_profil;?>
												</a>
											</td>
											<td class="text-center">
												<?php echo $cbt->alias_kelas;?>
											</td>
											<td class="text-center">
												<button class="btn btn-sm btn-danger tambah-jadwal" id="tambah-<?php echo $cbt->id_tryout;?>" data-toggle="modal" data-target="#mainmodal" >Tambah Jadwal</button>
											</td>
										</tr>
										<tr>
											<td colspan="4">
												<div class="collapse" id="cbt-<?php echo $cbt->id_tryout;?>">
													<table class="table table-bordered table-striped">
														<thead>
															<tr>
																<th style="width: 10px;">#</th>
																<th class="text-center">Sekolah</th>
																<th class="text-center">Start Date</th>
																<th class="text-center">End Date</th>
																<th class="text-center">Operasi</th>
															</tr>
														</thead>
														<tbody id="list-jadwal-<?php echo $cbt->id_tryout;?>">
															<?php
																//cari jadwal
																$datajadwal = $this->model_adm_event->fetch_jadwal_by_tryout_and_event($event->id_event, $cbt->id_tryout);

																$y = 1;
																foreach($datajadwal as $jadwal){
																	?>
																	<tr>
																		<td><?php echo $y;?></td>
																		<td><?php echo $jadwal->nama_sekolah;?></td>
																		<td><?php echo $jadwal->mulai_date;?></td>
																		<td><?php echo $jadwal->selesai_date;?></td>
																		<td>
																			<button class="btn btn-sm btn-danger hapus-jadwal" id="hapus-<?php echo $jadwal->id_jadwal_event_cbt;?>">Hapus Jadwal</button>
																		</td>
																	</tr>
																	<?php
																	$y++;
																}
															?>
														</tbody>
													</table>
												</div>
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
<script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>

<!--  Nestable Plugin    -->
<script src="<?php echo base_url('assets/js/plugins/nestable/jquery.nestable.js');?>"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>


<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>



<script type="text/javascript">
$(function(){

$(".tambah-jadwal").click(function(){
	rawid 	= $(this).attr("id");
	idsplit = rawid.split("-");
	idcbt 	= idsplit[1];
	$("#mainmodalcontent").load("../ajax_tambah_jadwal/" + <?php echo $event->id_event;?> + "/" + idcbt);
})

$(".tabel-jadwal").on('click', '.hapus-jadwal', function(){
	rawid 	= $(this).attr("id");
	idsplit = rawid.split("-");
	idjadwal 	= idsplit[1];
	if(confirm("Apakah anda yakin untuk menghapus jadwal?")){
		$.ajax({
			type: 'POST',
			url: '../proses_hapus_jadwal',
			data:{
				'idjadwal'	: idjadwal
			}
		});
	}
})


$(document).ajaxSend(function(event, jqxhr, settings){
	alamat 			= settings.url;
	alamattambah 	= alamat.substring(0, 21);
	if(alamattambah === "../ajax_tambah_jadwal"){
		$("#modal-loader").modal("show");
	}
	if(settings.url === "../proses_tambah_jadwal"){
		$("#modal-loader").modal("show");
	}
	if(settings.url === "../proses_hapus_jadwal"){
		$("#modal-loader").modal("show");
	}
});
$(document).ajaxSuccess(function(event, request, options){
	alamat 			= options.url;
	alamattambah 	= alamat.substring(0, 21);
	if(alamattambah === "../ajax_tambah_jadwal"){
		$("#modal-loader").modal("hide");
	}
	if(options.url === "../proses_tambah_jadwal"){
		//$('#modal-loader').modal('hide');
		if(request.responseText === "tanggal error"){
			$('#modal-loader').modal('hide');
			alert("Gagal, periksa kembali tanggal dan jam");
		}else{
			obj = JSON.parse(request.responseText);
			$("#list-jadwal-" + obj['idprofil']).load("../refresh_jadwal/" + <?php echo $event->id_event;?> + "/"+ obj['idprofil']);
			$('#modal-loader').modal('hide');
			$('#mainmodal').modal('hide');
		}
	}
	if(options.url === "../proses_hapus_jadwal"){
		
		obj = JSON.parse(request.responseText);
		$("#list-jadwal-" + obj['idprofil']).load("../refresh_jadwal/" + <?php echo $event->id_event;?> + "/"+ obj['idprofil']);
		$('#modal-loader').modal('hide');
		$('#mainmodal').modal('hide');
	}
});
$(document).ajaxError(function(event, request, options){
	alamat 			= options.url;
	alamattambah 	= alamat.substring(0, 21);
	if(alamattambah === "../ajax_tambah_jadwal"){
		$("#modal-loader").modal("hide");
		$("#mainmodal").modal("hide");
		$("#modal-error").modal("show");
	}
	if(options.url === "../proses_tambah_jadwal"){
		$('#modal-loader').modal('hide');
		$('#modal-error').appendTo("body").modal('show');
	}
	if(options.url === "../proses_hapus_jadwal"){
		$('#modal-loader').modal('hide');
		$('#modal-error').appendTo("body").modal('show');
	}
});

})
</script>

</html>
