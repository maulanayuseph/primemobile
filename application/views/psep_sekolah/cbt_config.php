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
                <h4 class="title">Konfigurasi CBT</h4>
                <p class="category">Pengaturan Jadwal CBT Sekolah</p>
              </div>
              <div class="content">
                <div class="row">
					<div class="col-sm-12">
						<table class="table display table-striped table-hover">
							<thead>
								<tr>
									<th>No.</th>
									<th class="text-center">Nama Profil Tes</th>
									<th class="text-center">Jadwal</th>
									<th class="text-center">Akses Pembahasan</th>
									<th class="text-center">Periode CBT</th>
									<th class="text-center">Jenjang Kelas</th>
									<th class="text-center">Tipe CBT</th>
									<th class="text-center">Operasi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$idsekolah = $this->session->userdata('idsekolah');

									$no = 1; 
									$tanggalsekarang		= new DateTime(date("Y-m-d"));
									foreach ($datacbt as $item) {
										if($item->tipe == 2){
											//cari apakah CBT PSEP memang milik sekolah tersebut

											$cekcbtpsep = $this->model_psep_cbt->fetch_cbt_psep_by_id_profil($item->id_tryout, $idsekolah);
											if($cekcbtpsep > 0){
												$cbtpsep = "ya";
											}else{
												$cbtpsep = "tidak";
											}
										}else{
											$cbtpsep = "ya";
										}
										$cabang		= substr($item->nama_profil, 0, 16); 
										//echo $cabang;
										$startdate 	= new DateTime($item->start_date);
										$enddate 	= new DateTime($item->end_date);
										if($startdate <= $tanggalsekarang and $enddate >= $tanggalsekarang and $cabang !== 'PRIME GENERATION' and $cbtpsep == "ya"){
											?>
												<tr>
													<td><?php echo $no++;?></td>
													<td><a href="#kategori-<?php echo $item->id_tryout;?>" data-toggle="collapse" aria-expanded="false" aria-controls="kategori-<?php echo $item->id_tryout;?>" id="titletryout-<?php echo $item->id_tryout;?>"><?php echo $item->nama_profil;?></a>
													</td>
													<td class="text-center">
														<button class="btn btn-primary btn-sm tambah-jadwal" id="profil-<?php echo $item->id_tryout;?>" data-toggle="modal" data-target="#mainmodal" >Set Jadwal</button>
													</td>
													<td class="text-center">
														<button class="btn btn-primary btn-sm akses-bahas" id="bahas-<?php echo $item->id_tryout;?>" data-toggle="modal" data-target="#mainmodal" >Set Akses Pembahasan</button>
													</td>
													<td>
														<?php echo $item->start_date;?>
														<br><?php echo $item->end_date;?>
													</td>
													<td><?php echo $item->alias_kelas;?></td>
													<td>
													<?php 
													if($item->tipe == "0"){
														echo "Reguler";
													}elseif($item->tipe == "1"){
														echo "CBT Contest";
													}elseif($item->tipe == "2"){
														echo "PSEP Sekolah";
													}
													?>
													</td>
													<td class="text-center">
														 <button class="btn btn-sm btn-success lihat-profil" id="lihat-profil-<?php echo $item->id_tryout;?>" data-toggle="modal" data-target="#mainmodal" >
														 	<i class="fa fa-eye" aria-hidden="true"></i>
														 </button>
													 </td>
												</tr>
												<tr>
													<td colspan="8">
														<div class="collapse" id="kategori-<?php echo $item->id_tryout;?>">
															
															<table class="table table-striped table-bordered">
																<thead>
																	<tr>
																		<th class="text-center">Kelas / Tahun Ajaran</th>
																		<th class="text-center">Mulai</th>
																		<th class="text-center">Berakhir</th>
																		<th class="text-center">Operasi</th>
																	</tr>
																</thead>
																<tbody id="list-jadwal-<?php echo $item->id_tryout;?>">
																	<?php
																		$carijadwal = $this->model_psep_cbt->fetch_jadwal_by_profil($item->id_tryout, $this->session->userdata('idsekolah'));
																		if($carijadwal !== null){
																			foreach($carijadwal as $jadwal){
																				?>
																				<tr>
																					<td>
																						<strong><?php echo $jadwal->kelas_paralel;?></strong> / <?php echo $jadwal->tahun_ajaran;?>
																					</td>
																					<td class="text-center">
																						<?php echo $jadwal->startdate;?> 
																					</td>
																					<td class="text-center">
																						<?php echo $jadwal->enddate;?>
																					</td>
																					<td class="text-center">
																						<button class="btn btn-sm btn-danger hapus-jadwal" id="hapus-<?php echo $jadwal->id_cbt_sekolah;?>-<?php echo $item->id_tryout;?>">
																							<i class="glyphicon glyphicon-remove"></i>
																						</button>
																					</td>
																				</tr>
																				<?php
																			}
																		}
																	?>
																</tbody>
															</table>

															<!-- JADWAL BUKA AKSES PEMBAHASAN -->
															<table class="table table-striped table-bordered">
																<thead>
																	<tr>
																		<th class="text-center">Kelas / Tahun Ajaran</th>
																		<th class="text-center">Akses Pembahasan</th>
																		<th class="text-center">Operasi</th>
																	</tr>
																</thead>
																<tbody id="list-jadwal-bahas-<?php echo $item->id_tryout;?>">
																	<?php
																		$aksesbahas = $this->model_psep_cbt->fetch_akses_bahas_by_profil($item->id_tryout, $this->session->userdata('idsekolah'));

																		foreach($aksesbahas as $bahas){
																			?>
																			<tr>
																				<td><strong><?php echo $bahas->kelas_paralel;?></strong> / <?php echo $bahas->tahun_ajaran;?></td>
																				<td class="text-center"><?php echo $bahas->bahasdate;?></td>
																				<td class="text-center">
																					<button class="btn btn-sm btn-danger hapus-bahas" id="hapus-bahas-<?php echo $bahas->id_cbt_sekolah_bahas;?>-<?php echo $item->id_tryout;?>">
																							<i class="glyphicon glyphicon-remove"></i>
																						</button>
																				</td>
																			</tr>
																			<?php
																		}
																	?>
																</tbody>
															</table>
															<!-- END JADWAL BUKA AKSES PEMBAHASAN -->
														</div>
													</td>
												</tr>
											  <?php
										}
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
		idtryout 	= idsplit[1];
		judulmodal	= $("#titletryout-" + idtryout).html();
		$("#mainmodaltitle").html(judulmodal);
		$("#mainmodalcontent").load("tambah_jadwal/" + idtryout);
	})
	$(".lihat-profil").click(function(){
		rawid 		= $(this).attr("id");
		idsplit 	= rawid.split("-");
		idtryout 	= idsplit[2];
		judulmodal	= $("#titletryout-" + idtryout).html();
		$("#mainmodaltitle").html(judulmodal);
		$("#mainmodalcontent").load("detail_profil/" + idtryout);
	})
	$(".hapus-jadwal").click(function(){
		rawid 		= $(this).attr("id");
		idsplit 	= rawid.split("-");
		idjadwal	= idsplit[1];
		idprofil	= idsplit[2];

		if(confirm("Apakah anda yakin akan menghapus jadwal?")){
			$.ajax({
				type: 'POST',
				url: 'hapus_jadwal',
				data:{
					'idjadwal'	: idjadwal,
					'idtryout'	: idprofil
				}
			});
		}
	})
	$(".akses-bahas").click(function(){
		rawid 		= $(this).attr('id');
		idsplit		= rawid.split("-");
		idprofil 	= idsplit[1];
		judulmodal	= $("#titletryout-" + idprofil).html();
		$("#mainmodaltitle").html("Akses Pembahasan " + judulmodal);
		$("#mainmodalcontent").load("akses_pembahasan/" + idprofil);
	})

	$(".hapus-bahas").click(function(){
		rawid 		= $(this).attr("id");
		idsplit 	= rawid.split("-");
		idbahas		= idsplit[2];
		idprofil	= idsplit[3];

		if(confirm("Apakah anda yakin akan menghapus akses pembahasan?")){
			$.ajax({
				type: 'POST',
				url: 'hapus_bahas',
				data:{
					'idbahas'	: idbahas,
					'idtryout'	: idprofil
				}
			});
		}
	})
	$(document).ajaxSend(function(event, jqxhr, settings){
		alamat 			= settings.url;
		urltambahjadwal	= alamat.substring(0, 13);
		urldetail		= alamat.substring(0, 13);
		urlsetkkm		= alamat.substring(0, 7);
		urlaksesbahas 	= alamat.substring(0, 16);
		if(urltambahjadwal === "tambah_jadwal"){
			$('#text-load').html('Memuat Editor Jadwal');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(settings.url === "hapus_jadwal"){
			$('#text-load').html('menghapus Jadwal');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(urlsetkkm === "set_kkm"){
			$('#text-load').html('Memuat Editor KKM');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(urldetail === "detail_profil"){
			$('#text-load').html('Memuat Detail CBT');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(settings.url === "proses_set_kkm"){
			$('#text-load').html('Menyimpan KKM');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(urlaksesbahas === "akses_pembahasan"){
			$('#text-load').html('Memuat Editor Akses Pembahasan');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(settings.url === "proses_akses_pembahasan"){
			$('#text-load').html('Menyimpan Akses Pembahasan');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(settings.url === "hapus_bahas"){
			$('#text-load').html('Menghapus Akses Pembahasan');
			$('#modal-loader').appendTo("body").modal('show');
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		alamat 			= options.url;
		urltambahjadwal	= alamat.substring(0, 13);
		urldetail		= alamat.substring(0, 13);
		urlsetkkm		= alamat.substring(0, 7);
		urlaksesbahas 	= alamat.substring(0, 16);
		if(urltambahjadwal === "tambah_jadwal"){
			$('#modal-loader').modal('hide');
		}
		if(options.url === "proses_tambah_jadwal"){
			//$('#modal-loader').modal('hide');
			if(request.responseText === "tanggal error"){
				$('#modal-loader').modal('hide');
				alert("Gagal, periksa kembali tanggal dan jam");
			}else{
				obj = JSON.parse(request.responseText);
				$("#list-jadwal-" + obj['idprofil']).load("refresh_jadwal/" + obj['idprofil']);
				$('#modal-loader').modal('hide');
				$('#mainmodal').modal('hide');
			}
		}if(options.url === "hapus_jadwal"){
			obj = JSON.parse(request.responseText);
			$("#list-jadwal-" + obj['idprofil']).load("refresh_jadwal/" + obj['idprofil']);
			$('#modal-loader').modal('hide');
		}
		if(urlsetkkm === "set_kkm"){
			$('#modal-loader').modal('hide');
		}
		if(urldetail === "detail_profil"){
			$('#modal-loader').modal('hide');
		}
		if(options.url === "proses_set_kkm"){
			idtryout = request.responseText;
			$("#mainmodalcontent").load("detail_profil/" + idtryout);
		}
		if(urlaksesbahas === "akses_pembahasan"){
			$('#modal-loader').modal('hide');
		}
		if(options.url == "proses_akses_pembahasan"){
			if(request.responseText === "ada"){
				$('#modal-loader').modal('hide');
				alert("Gagal! kelas sudah memiliki jadwal akses pembahasan");
			}else{
				obj = JSON.parse(request.responseText);
				$("#list-jadwal-bahas-" + obj['idprofil']).load("refresh_bahas/" + obj['idprofil']);
				$('#modal-loader').modal('hide');
				$('#mainmodal').modal('hide');
			}
		}
		if(options.url === "hapus_bahas"){
			obj = JSON.parse(request.responseText);
				$("#list-jadwal-bahas-" + obj['idprofil']).load("refresh_bahas/" + obj['idprofil']);
				$('#modal-loader').modal('hide');
				$('#mainmodal').modal('hide');
		}
	});
	$(document).ajaxError(function(event, request, options){
		alamat 			= options.url;
		urltambahjadwal	= alamat.substring(0, 13);
		urldetail		= alamat.substring(0, 13);
		urlsetkkm		= alamat.substring(0, 7);
		urlaksesbahas 	= alamat.substring(0, 16);
		if(urltambahjadwal === "tambah_jadwal"){
			$('#modal-loader').modal('hide');
			$('#mainmodal').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
		if(options.url === "hapus_jadwal"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
		if(urlsetkkm === "set_kkm"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
		if(urldetail === "detail_profil"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
		if(options.url === "proses_set_kkm"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
		if(urlaksesbahas === "akses_pembahasan"){
			$('#modal-loader').modal('hide');
			$('#mainmodal').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
		if(options.url === "proses_akses_pembahasan"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
		if(options.url === "hapus_bahas"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
	});
});
</script>

</html>
