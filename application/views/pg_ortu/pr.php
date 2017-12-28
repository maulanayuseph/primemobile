<?php include('header_dashboard.php'); ?>
<style>
.dashboard-icon span { font-size:30px; }
.dashboard-icon { color:#fff; font-size:20px; }
.dashboard-icon:hover { color:#810000; }
.box-icon { border: solid 1px #ddd; padding:10px;background-image: url(<?php echo base_url()?>assets/dashboard/images/profileBar.jpg);background-position:center;background-size:cover;}
.padding-lr10 {padding: 0px 10px;}
</style>
<script>
  function supports_media_source()
  {
      "use strict";
      var hasWebKit = (window.WebKitMediaSource !== null && window.WebKitMediaSource !== undefined),
          hasMediaSource = (window.MediaSource !== null && window.MediaSource !== undefined);
      return (hasWebKit || hasMediaSource);
  }
</script>

<div class="container-fluid akun-container" style="padding: 90px 10% 50px;">
	<!-- SPACE UNTUK MEMUNCULKAN PR -->
	<!-- ########################## -->
	<!-- ########################## -->
	<?php
	if($tahunajaran !== null){
		?>
			<div class="content">
				<div class="tabel-analisa waktu">
					<div class="title"><img src="<?php echo base_url('assets/dashboard/images/file.png'); ?>">Tugas</div>
				</div>
			</div>
			<div class="row">
			<div class="col-lg-12">
				<table class="table display table-responsive table-bordered table-striped">
					<thead>
						<tr>
							<th style="width: 10px;">#</th>
							<th class="text-center">Tugas</th>
							<th class="text-center">Status</th>
							<th class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php
					//cari kelas dan tahun ajaran siswa
					$carikelasparalel = $this->model_pr->fetch_kelas_siswa($this->session->userdata("id_ortu_siswa"));
					if($carikelasparalel !== null){
						$x = 1;
						foreach($carikelasparalel as $kelassiswa){
							//cari pr berdasarkan kelas dan tahun ajaran
							$caripr = $this->model_pr->fetch_pr_by_kelas_and_tahun_ajaran($kelassiswa->id_kelas_paralel, $kelassiswa->id_tahun_ajaran);
							foreach($caripr as $pr){
								?>
								<tr>
									<td><?php echo $x;?></td>
									<td>
										<strong><?php echo $pr->nama_pr;?></strong>
										<br>Tipe Tugas : 
										<?php
											if($pr->tipe == 1){
												echo "Pilihan Ganda";
											}elseif($pr->tipe == 2){
												echo "Jawaban Eksak";
											}elseif($pr->tipe == 3){
												echo "Jawaban Essai";
											}
										?> | Jumlah Soal : 
										<?php
											$jumlah = $this->model_pr->jumlah_soal_by_tipe($pr->id_pr);
											echo $jumlah;
										?>
									</td>
									<td class="text-center">
										<?php
											if($pr->akses == 0){
												echo '<span class="label label-danger">Akses Tugas Ditutup</span>';
											}elseif($pr->akses == 1){
												echo '<span class="label label-success">Akses Tugas Dibuka</span>';
											}
										?>
									</td>
									<td class="text-center">
										<?php
											$caristatuspr = $this->model_pr->fetch_status_pr($pr->id_pr, $this->session->userdata('id_ortu_siswa'));
											
											if($caristatuspr == null){
												if($pr->akses == 0){
													echo "-";
												}elseif($pr->akses == 1){
													if($pr->tipe == 1){
														?>
														<a class="btn btn-primary btn-kelas" href="#">Sedang Mengerjakan</a>
														<?php
													}elseif($pr->tipe == 2){
														?>
														<a class="btn btn-primary btn-kelas" href="#">Sedang Mengerjakan</a>
														<?php
													}elseif($pr->tipe == 3){
														?>
														<a class="btn btn-primary btn-kelas" href="#">Sedang Mengerjakan</a>
														<?php
													}
												}
											}else{
												if($pr->akses == 0 and $pr->bahas == 0){
													if($pr->tipe == 1){
														if($caristatuspr->status == 0){
															echo '<span class="label label-danger">Akses Tugas dan Pembahasan Ditutup</span>';
														}elseif($caristatuspr->status == 1){
															echo '<span class="label label-danger">Akses Pembahasan Ditutup</span>';
														}
													}elseif($pr->tipe == 2){
														if($caristatuspr->status == 0){
															echo '<span class="label label-danger">Akses Tugas dan Pembahasan Ditutup</span>';
														}elseif($caristatuspr->status == 1){
															echo '<span class="label label-primary">Menunggu Koreksi Guru</span>';
														}elseif($caristatuspr->status == 2){
															echo '<span class="label label-danger">Akses Pembahasan Ditutup</span>';
														}
													}elseif($pr->tipe == 3){
														if($caristatuspr->status == 0){
															echo '<span class="label label-danger">Akses Tugas dan Pembahasan Ditutup</span>';
														}elseif($caristatuspr->status == 1){
															echo '<span class="label label-primary">Menunggu Koreksi Guru</span>';
														}elseif($caristatuspr->status == 2){
															echo '<span class="label label-danger">Akses Pembahasan Ditutup</span>';
														}
													}
												}elseif($pr->akses == 1 and $pr->bahas == 0){
													if($pr->tipe == 1){
														if($caristatuspr->status == 0){
															?>
															<a class="btn btn-primary btn-kelas" href="<?php echo  base_url("pr/mulai/".$pr->id_pr);?>">Lanjutkan Tugas</a>
															<?php
														}elseif($caristatuspr->status == 1){
															echo '<span class="label label-danger">Akses Pembahasan Ditutup</span>';
														}
													}elseif($pr->tipe == 2){
														if($caristatuspr->status == 0){
															?>
															<a class="btn btn-primary btn-kelas" href="<?php echo  base_url("pr/mulai_eksak/".$pr->id_pr);?>">Lanjutkan Tugas</a>
															<?php
														}elseif($caristatuspr->status == 1){
															echo '<span class="label label-primary">Menunggu Koreksi Guru</span>';
														}elseif($caristatuspr->status == 2){
															echo '<span class="label label-danger">Akses Pembahasan Ditutup</span>';
														}
													}elseif($pr->tipe == 3){
														if($caristatuspr->status == 0){
															?>
															<a class="btn btn-primary btn-kelas" href="<?php echo  base_url("pr/mulai_essai/".$pr->id_pr);?>">Lanjutkan Tugas</a>
															<?php
														}elseif($caristatuspr->status == 1){
															echo '<span class="label label-primary">Menunggu Koreksi Guru</span>';
														}elseif($caristatuspr->status == 2){
															echo '<span class="label label-danger">Akses Pembahasan Ditutup</span>';
														}
													}
												}elseif($pr->akses == 0 and $pr->bahas == 1){
													if($pr->tipe == 1){
														if($caristatuspr->status == 0){
															?>
															<a class="btn btn-success btn-kelas" href="<?php echo  base_url("parents/statistik_pr/".$pr->id_pr);?>">Lihat Penilaian & Pembahasan</a>
															<?php
														}elseif($caristatuspr->status == 1){
															?>
															<a class="btn btn-success btn-kelas" href="<?php echo  base_url("parents/statistik_pr/".$pr->id_pr);?>">Lihat Penilaian & Pembahasan</a>
															<?php
														}
													}elseif($pr->tipe == 2){
														if($caristatuspr->status == 0){
															?>
															<a class="btn btn-success btn-kelas" href="<?php echo  base_url("parents/statistik_eksak/".$pr->id_pr);?>">Lihat Penilaian & Pembahasan</a>
															<?php
														}elseif($caristatuspr->status == 1){
															echo '<span class="label label-primary">Menunggu Koreksi Guru</span>';
														}elseif($caristatuspr->status == 2){
															?>
															<a class="btn btn-success btn-kelas" href="<?php echo  base_url("parents/statistik_eksak/".$pr->id_pr);?>">Lihat Penilaian & Pembahasan</a>
															<?php
														}
													}elseif($pr->tipe == 3){
														if($caristatuspr->status == 0){
															?>
															<a class="btn btn-success btn-kelas" href="<?php echo  base_url("parents/statistik_essai/".$pr->id_pr);?>">Lihat Penilaian & Pembahasan</a>
															<?php
														}elseif($caristatuspr->status == 1){
															echo '<span class="label label-primary">Menunggu Koreksi Guru</span>';
														}elseif($caristatuspr->status == 2){
															?>
															<a class="btn btn-success btn-kelas" href="<?php echo  base_url("parents/statistik_essai/".$pr->id_pr);?>">Lihat Penilaian & Pembahasan</a>
															<?php
														}
													}
												}elseif($pr->akses == 1 and $pr->bahas == 1){
													if($pr->tipe == 1){
														if($caristatuspr->status == 0){
															?>
															<a class="btn btn-primary btn-kelas" href="<?php echo  base_url("pr/mulai/".$pr->id_pr);?>">Lanjutkan Tugas</a>
															<?php
														}elseif($caristatuspr->status == 1){
															?>
															<a class="btn btn-success btn-kelas" href="<?php echo  base_url("parents/statistik_pr/".$pr->id_pr);?>">Lihat Penilaian & Pembahasan</a>
															<?php
														}
													}elseif($pr->tipe == 2){
														if($caristatuspr->status == 0){
															?>
															<a class="btn btn-primary btn-kelas" href="<?php echo  base_url("pr/mulai_eksak/".$pr->id_pr);?>">Lanjutkan Tugas</a>
															<?php
														}elseif($caristatuspr->status == 1){
															echo '<span class="label label-primary">Menunggu Koreksi Guru</span>';
														}elseif($caristatuspr->status == 2){
															?>
															<a class="btn btn-success btn-kelas" href="<?php echo  base_url("parents/statistik_eksak/".$pr->id_pr);?>">Lihat Penilaian & Pembahasan</a>
															<?php
														}
													}elseif($pr->tipe == 3){
														if($caristatuspr->status == 0){
															?>
															<a class="btn btn-primary btn-kelas" href="<?php echo  base_url("pr/mulai_essai/".$pr->id_pr);?>">Lanjutkan Tugas</a>
															<?php
														}elseif($caristatuspr->status == 1){
															echo '<span class="label label-primary">Menunggu Koreksi Guru</span>';
														}elseif($caristatuspr->status == 2){
															?>
															<a class="btn btn-success btn-kelas" href="<?php echo  base_url("parents/statistik_essai/".$pr->id_pr);?>">Lihat Penilaian & Pembahasan</a>
															<?php
														}
													}
												}
											}
										?>
									</td>
								</tr>
								<?php
								$x++;
							}
						}
					}
					?>
					</tbody>
				</table>
			</div>
			</div>
		<?php
	}
	?>
	<!-- ########################## -->
	<!-- ########################## -->
	<!-- END SPACE UNTUK MEMUNCULKAN PR -->
	
</div>

<div class="container-fluid akun-container" style="padding-top:0px;">
	<div class="col-lg-12">	
     <div class="akun-slider">
      <div class="content">
        <h5>Ir.H.Heppy Trenggono, M.Kom</h5>
        <p>Orang tua, seperti apapun keadaan mereka, tetap saja merupakan kunci sukses yang paling berharga</p>
        <a href="">SELENGKAPNYA <span class="glyphicon glyphicon-chevron-right"></span></a>
      </div>
      <img class="slider" src="<?php echo base_url('assets/dashboard/images/slide.jpg');?>">
     </div> 

    </div>
</div>

<?php include('footer.php'); ?>

   <script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>
  
  <script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>"></script>
  <script src="<?php echo base_url('assets/dashboard/js/init.js');?>"></script>
  
  <!-- JS Function for this Modal -->
 <!--  Datatables Plugin -->
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>
  </body>
</html>
