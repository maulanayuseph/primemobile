<?php
$this->load->view("pg_user/header_dashboard");
?>
<div class="container-fluid akun-container">
	<div class="tabel-analisa waktu">
		<div class="title"><img src="<?php echo base_url('assets/dashboard/images/first.png'); ?>"><?php echo $event->nama_event;?></div>
	</div>
	<div class="col-sm-12">
		<?php
			$idsiswa 			= $this->session->userdata("id_siswa");
			if($datacbt !== null){
				foreach($datacbt as $sesi){
					if($sesi->id_kelas == $kelasaktif->id_kelas){
						//cari apakah siswa sudah mengerjakan CBT gelombang pertama

						if($sesi->banner == "-"){
							$back = base_url("assets/pg_user/images/talent.jpg");
						}else{
							$back = base_url("assets/uploads/banner/" . $sesi->banner);
						}
						?>
						<div class="panel panel-default panel-cbt">
							<div class="panel-body panel-body-cbt">
								<div class="row row-cbt">
									
									<div class="col-sm-4 panel-cbt-banner" style="background-image: url('<?php echo $back;?>');">
									</div>
									<div class="col-sm-8 panel-cbt-desc">
										<div class="col-sm-6">
											<h3><?php echo $sesi->nama_profil;?></h3>
										</div>
										<div class="col-sm-6">
										<h3 class="panel-title">Materi Ujian</h3>
										<?php
											$caritryout = $this->model_dashboard->get_all_tryout_by_profil($sesi->id_tryout);
											foreach($caritryout as $tryout){
												?>
												<br>- <?php echo $tryout->nama_kategori;?>
												<?php
											}
										?>
										</div>
										<div class="col-sm-12 panel-btn-cbt">
											<div class="col-sm-6 col-xs-12">
												<!--<a class="btn btn-sm btn-danger" href="<?php echo base_url('user/statistiknilai/'.$sesi->id_tryout);?>" style="width: 100%;">Lihat Ranking & Penilaian</a>-->
											</div>
											<div class="col-sm-6 col-xs-12">
												<button  class="btn btn-sm btn-success" style="width: 100%;" type="button" data-toggle="collapse" data-target="#sesi<?php echo $sesi->id_tryout;?>" aria-expanded="false" aria-controls="sesi<?php echo $sesi->id_tryout;?>">Mulai CBT</button >
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="collapse" id="sesi<?php echo $sesi->id_tryout;?>">
							<div class="row" style="margin: 0px;">
							<?php
							foreach($caritryout as $tryout){
								?>
								<div class="mapel-container" style="width: 100%; margin-left: 0px; margin-right: 0px; border-radius: 0;">
									<div class="header"><?php echo $tryout->jumlah_soal;?> Soal</div>
									<div class="content">
										<div class="title">
										<h5><?php echo $tryout->alias_kelas;?></h5>
										<h3><?php echo $tryout->nama_kategori;?></h3>
										
										<?php
											$cariskor 		= $this->model_dashboard->cari_skor($tryout->id_kategori, $idsiswa);
											$cariskorsalah 	= $this->model_dashboard->cari_skor_salah($tryout->id_kategori, $idsiswa);
											$cariwaktu 		= $this->model_dashboard->cari_waktu($tryout->id_kategori, $idsiswa);
											
											$prosentase = round(($cariskor/$tryout->jumlah_soal) * 100, 2);
											/*
											if($cariskor > 0 and $cariwaktu > 0){
												
												echo "<h4>".$prosentase."% Tuntas</h4>
												<h6>".$cariskor."/".$tryout->jumlah_soal." Soal yang benar</h6>
												";
											}elseif($cariskor == 0 and $cariskorsalah > 0 and  $cariwaktu > 0){
												echo "
												<h4>0% progress</h4>
												<h6>0/".$tryout->jumlah_soal." Soal yang benar</h6>
												";
											}elseif($cariskor > 0 and $cariwaktu == 0){
												echo "
												<h4>0% progress</h4>
												<h6>0/".$tryout->jumlah_soal." Soal yang benar</h6>
												";
											}elseif($cariskor == 0 and $cariwaktu == 0){
												echo "
												<h4>0% progress</h4>
												<h6>0/".$tryout->jumlah_soal." Soal yang benar</h6>
												";
											}else{
												echo "
												<h4>0% progress</h4>
												<h6>0/".$tryout->jumlah_soal." Soal yang benar</h6>
												";
											}
											*/
										?>
										</div>
									 <?php
										if(($cariskor > 0 or $cariskorsalah > 0) and $cariwaktu > 0){
										?>
										<?php /* TEMPORARY DISABLED
										<div class="progress" style="height: 10px;">
											<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $prosentase;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prosentase;?>%;">
											<span class="sr-only"><?php echo $prosentase;?>% Complete</span>
											</div>
										</div>
										<a href="../tryout/openclass/<?php echo $tryout->id_kategori; ?>" class="btn btn-primary" style="float: right; margin: 15px 0;">Open Class</a>
										<a href="../tryout/pembahasan/<?php echo $tryout->id_kategori;?>" class="btn btn-success" type="submit" style="float: right; margin: 15px 15px;">Pembahasan</a>
										*/ ?>
										<?php
										}elseif(($cariskor > 0 or $cariskorsalah > 0) and $cariwaktu == 0){
										?>
											<div class="progress" style="height: 10px;">
												<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
												<span class="sr-only">0% Complete</span>
												</div>
											</div>
											<a href="../../tryout/mulai/<?php echo $tryout->id_kategori;?>" class="btn btn-default btn-mapel" type="submit">Lanjut Mengerjakan</a>
										<?php
										}else{
										?>
										<div class="progress" style="height: 10px;">
											<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
											<span class="sr-only">0% Complete</span>
											</div>
										</div>
										
										<a href="../../tryout/mulai/<?php echo $tryout->id_kategori;?>" class="btn btn-default btn-mapel" type="submit">Mulai</a>
										<?php
										}	
										?>
										
										
									</div>
								</div>
								<?php
								}
							?>
							</div>
						</div>
						<?php
					}
					//echo "<p>" . $sesi->startdate;
				}
			}
		?>
		<?php
			if($event->id_event == 1){
				?>
				<div class="col-sm-12 text-center">
					<br>
					<img src="<?php echo base_url("assets/cbt2017/image/jump.png");?>" class="img img-repsonsive" style="max-width: 200px; margin: 0 auto;">
					<br>
					<br>
					Pengumuman bagi peserta <?php echo $event->nama_event;?>, Sebelumnya kami ucapkan terimakasih atas partisipasi anda dalam mengikuti event ini.
					<br>Dikarenakan minat pendaftar yang tinggi, event diperpanjang hingga tanggal 10 Desember 2017 dan pemenang akan diumumkan tanggal 11 Desember 2017 setelah diadakan TO susulan bagi pendaftar baru yang belum memiliki kesempatan mengikuti <?php echo $event->nama_event;?>.
					<br>Atas perhatian dan pengertiannya kami sampaikan permintaan maaf dan terima kasih
					<br>
					<br>
					<?php
						if($kelasaktif->id_kelas == 6){
							$idcbt = 178;
						}elseif($kelasaktif->id_kelas == 9){
							$idcbt = 179;
						}elseif($kelasaktif->id_kelas == 19){
							$idcbt = 180;
						}elseif($kelasaktif->id_kelas == 20){
							$idcbt = 181;
						}
					?>
					<a href="<?php echo base_url("cbt_event/analisis/" . $idcbt);?>" class="btn btn-sm btn-danger">Klik Di Sini Untuk Melihat Hasil Pengerjaan TryOut</a>
				</div>
				<?php
			}
		?>
	</div>
</div>
	
<?php
$this->load->view("pg_user/footer");
?>

<script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>

<script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('assets/dashboard/js/init.js');?>"></script>
<!--  Datatables Plugin -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>

 </body>
</html>
