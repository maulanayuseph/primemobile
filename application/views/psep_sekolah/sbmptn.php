<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>
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
		$("#listperingkat").load("ajax_peringkat/" + $("#profilcbt").val());
		$("#listkategori").load("listkategori/" + $("#profilcbt").val());
		$("#kelas").load("ajax_kelas_by_profil/" + $("#profilcbt").val());
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
                <h4 class="title">Konfigurasi University Selection System</h4>
                <p class="category">Pengaturan Jadwal USS SBMPTN</p>
              </div>
              <div class="content">
                <div class="row">
					<div class="col-sm-12">
						<table class="table table-responsive table-striped">
							<thead>
								<tr>
									<th style="width: 10px;">#</th>
									<th class="text-center" colspan="2">Paket SBMPTN</th>
								</tr>
							</thead>
							<?php
								$x = 1;
								foreach($datasbmptn as $sbmptn){
									?>
									<tr>
										<td><?php echo $x;?></td>
										<td><a  href="#sbmptn-<?php echo $sbmptn->id_paket_sbmptn;?>" data-toggle="collapse" aria-expanded="false" aria-controls="sbmptn-<?php echo $sbmptn->id_paket_sbmptn;?>" id="titlesbmptn-<?php echo $sbmptn->id_paket_sbmptn;?>"><?php echo $sbmptn->nama_paket_sbmptn;?></a></td>
										<td style="text-align: right;">
											<button class="btn btn-sm btn-danger tambah-jadwal" id="paket-<?php echo $sbmptn->id_paket_sbmptn;?>" data-toggle="modal" data-target="#mainmodal">Buat Jadwal</button>
										</td>
									</tr>
									<tr>
										<td colspan="3">
											<div class="collapse" id="sbmptn-<?php echo $sbmptn->id_paket_sbmptn;?>">
												<table class="table table-responsive table-striped">
													<thead>
														<tr>
															<th class="text-center">Kelas</th>
															<th class="text-center">Jadwal</th>
															<th class="text-center">Operasi</th>
														</tr>
													</thead>
													<tbody class="daftar-jadwal" id="list-jadwal-<?php echo $sbmptn->id_paket_sbmptn;?>">
														<?php
															$datajadwal = $this->model_psep_uss->fetch_jadwal_by_paket($sbmptn->id_paket_sbmptn, $this->session->userdata('idsekolah'));

															foreach($datajadwal as $jadwal){
																?>
																<tr>
																	<td class="text-center">
																		<?php echo $jadwal->kelas_paralel;?>
																		<br>
																		<?php
																		echo $jadwal->tahun_ajaran;
																		?>
																	</td>
																	<td class="text-center">
																		<?php echo $jadwal->startdate;?>
																		<br>
																		<?php
																		echo $jadwal->enddate;
																		?>
																	</td>
																	<td valign="middle" class="text-center">
																		<button class="btn btn-sm btn-danger hapus-jadwal" id="hapus-<?php echo $sbmptn->id_paket_sbmptn;?>-<?php echo $jadwal->id_sbmptn_config;?>">
																			Hapus Jadwal
																		</button>
																	</td>
																</tr>
																<?php
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
						</table>
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
<?php $this->load->view("psep_sekolah/modal_ajax");;?>
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

<!-- PLUGINS FUNCTION -->
<!-- Nestable plugin  -->
<script type="text/javascript">
$(function(){

	$(".tambah-jadwal").click(function(){
		rawid 		= $(this).attr("id");
		idsplit 	= rawid.split("-");
		idpaket 	= idsplit[1];
		judulmodal	= $("#titlesbmptn-" + idpaket).html();
		$("#mainmodaltitle").html(judulmodal);
		$("#mainmodalcontent").load("tambah_jadwal_sbmptn/" + idpaket);
	})

	$(".daftar-jadwal").on('click', '.hapus-jadwal', function(){
		rawid 		= $(this).attr("id");
		idsplit 	= rawid.split("-");
		idpaket 	= idsplit[1];
		idconfig 	= idsplit[2];

		if(confirm('Apakah anda yakin untuk menghapus jadwal ?')){
			$.ajax({
				type: 'POST',
				url: 'proses_hapus_jadwal',
				data:{
					'idpaket'	: idpaket,
					'idconfig'	: idconfig
				}
			});
		}
	})

	$(document).ajaxSend(function(event, jqxhr, settings){
		alamat 				= settings.url;
		alamattambahjadwal 	= alamat.substring(0, 20);
		alamatrefresh 		= alamat.substring(0, 14);
		if(alamattambahjadwal === "tambah_jadwal_sbmptn"){
			$("#modal-loader").modal("show");
		}

		if(settings.url === "proses_hapus_jadwal"){
			$("#modal-loader").modal("show");
		}

		if(alamatrefresh === "refresh_jadwal"){
			$("#modal-loader").modal("show");
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		alamat 			= options.url;
		alamattambahjadwal 	= alamat.substring(0, 20);
		alamatrefresh 		= alamat.substring(0, 14);
		if(alamattambahjadwal === "tambah_jadwal_sbmptn"){
			$("#modal-loader").modal("hide");
		}
		if(options.url === "proses_tambah_jadwal"){
			//$('#modal-loader').modal('hide');
			if(request.responseText === "tanggal error"){
				$('#modal-loader').modal('hide');
				alert("Gagal, periksa kembali tanggal dan jam");
			}else{
				obj = JSON.parse(request.responseText);
				$("#list-jadwal-" + obj['idpaket']).load("refresh_jadwal/" + obj['idpaket']);
				$('#mainmodal').modal('hide');
			}
		}
		if(options.url === "proses_hapus_jadwal"){
			obj = JSON.parse(request.responseText);
			$("#list-jadwal-" + obj['idpaket']).load("refresh_jadwal/" + obj['idpaket']);
			$('#mainmodal').modal('hide');
		}
		if(alamatrefresh === "refresh_jadwal"){
			$("#modal-loader").modal("hide");
		}
	});

	$(document).ajaxError(function(event, request, options){
		alamat 			= options.url;
		alamattambahjadwal 	= alamat.substring(0, 20);
		alamatrefresh 		= alamat.substring(0, 14);
		if(alamattambahjadwal === "tambah_jadwal_sbmptn"){
			$("mainmodal").modal("hide");
			$("#modal-loader").modal("hide");
			$("#modal-error").modal("show");
		}
		if(options.url === "proses_hapus_jadwal"){
			$("#modal-loader").modal("hide");
			$("#modal-error").modal("show");
		}
		if(alamatrefresh === "refresh_jadwal"){
			$("#modal-loader").modal("hide");
			$("#modal-error").modal("show");
		}
	});
});
</script>

</html>
