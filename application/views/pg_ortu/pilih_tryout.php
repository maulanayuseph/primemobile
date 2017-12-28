<?php include('header_dashboard.php'); ?>

<div class="container-fluid akun-container" style="padding: 5 10%;min-height:350px;">
	<div clas="col-lg-12">
		<?php if ($tipeview == 'analisa'){ ?>
		<h1 style="background:none;color:#000;font-size:24px;text-align:center;padding-bottom:20px;border-bottom:solid 1px #ddd;">ANALISIS CBT</h1>	
		<?php } else if ($tipeview == 'peringkat'){ ?>
		<h1 style="background:none;color:#000;font-size:24px;text-align:center;padding-bottom:20px;border-bottom:solid 1px #ddd;">PERINGKAT CBT</h1>	
		<?php } ?>
		
			<?php 
					foreach($datacbtreg as $cbt){
						if($cbt->id_kelas == $kelasaktif->id_kelas){
			?>
			<div class="tabel-analisa">
				<table class="table table-bordered">
					<thead>	
						<tr>
							<th style="background-color: white;vertical-align: middle;"><?php echo $cbt->nama_profil;?></th>
							<th style="background-color: white;vertical-align: middle;">Penyelenggara : <?php echo $cbt->penyelenggara;?></th>
							<th style="background-color: white;vertical-align: middle;" class="text-center">
							<?php if ($tipeview == 'analisa'){ ?>
								<a class="btn btn-success" href="<?php echo base_url('parents/report_cbt/'.$cbt->id_tryout.'/hasil');?>">Lihat CBT Report</a>
							<?php } else if ($tipeview == 'peringkat'){ ?>
								<a class="btn btn-success" href="<?php echo base_url('parents/report_cbt/'.$cbt->id_tryout.'/peringkat');?>">Lihat Peringkat CBT</a>
							<?php } ?>
							</th>
						</tr>
					</thead>
					
					<?php if ($tipeview == 'analisa'){ ?>
					<tbody>
						<tr>
							<td colspan="3">
								<?php
								$caritryout = $this->model_dashboard->get_tryout_by_profil($cbt->id_tryout);
								$idsiswa = $_SESSION['id_ortu_siswa'];
								
								foreach($caritryout as $tryout){
									?>
									<div class="mapel-container">
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
											?>
											</div>
											<?php
											if(($cariskor > 0 or $cariskorsalah > 0) and $cariwaktu > 0){
											?>
												<div class="progress" style="height: 10px;">
												<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $prosentase;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prosentase;?>%;">
												<span class="sr-only"><?php echo $prosentase;?>% Complete</span>
												</div>
											</div>
											<?php
											}elseif(($cariskor > 0 or $cariskorsalah > 0) and $cariwaktu == 0){
											?>
												<div class="progress" style="height: 10px;">
													<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
													<span class="sr-only">0% Complete</span>
													</div>
												</div>
											<?php
											}else{
											?>
											<div class="progress" style="height: 10px;">
												<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
												<span class="sr-only">0% Complete</span>
												</div>
											</div>
											<?php
											}	
											?>
											
											
										</div>
										</div>
									<?php
								}
								?>
							</td>
						</tr>
					</tbody>
					<?php } ?>
						
				</table>
			</div>
			<?php
						}
					}
				
			?>
	</div>
</div>

<?php include('footer.php'); ?>

   <script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>
  
  <script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>"></script>
  <script src="<?php echo base_url('assets/dashboard/js/init.js');?>"></script>
  
  <!-- JS Function for this Modal -->
 
  </body>
</html>
