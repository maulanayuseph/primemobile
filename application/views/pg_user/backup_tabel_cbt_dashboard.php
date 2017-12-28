<div class="col-lg-12">
	<?php 
	foreach($datacbtreg as $cbt){
		if($cbt->id_kelas == $kelasaktif->id_kelas){
			?>
			<div class="tabel-analisa">
				<table class="table table-bordered">
					<thead>	
						<tr>
							<th style="background-color: white;"><?php echo $cbt->nama_profil;?></th>
							<th style="background-color: white;">Penyelenggara : <?php echo $cbt->penyelenggara;?></th>
							<th style="background-color: white;" class="text-center">
								<a class="btn btn-success" href="<?php echo base_url('user/statistiknilai/'.$cbt->id_tryout);?>">
								Lihat Statistik Nilai
								</a>
							</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td colspan="3">
								<?php
								$caritryout = $this->model_dashboard->get_tryout_by_profil($cbt->id_tryout);
								$idsiswa = $this->session->userdata('id_siswa');
								
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
											<a href="../tryout/openclass/<?php echo $tryout->id_kategori; ?>" class="btn btn-primary" style="float: right; margin: 15px 0;">Open Class</a>
											<a href="../tryout/pembahasan/<?php echo $tryout->id_kategori;?>" class="btn btn-success" type="submit" style="float: right; margin: 15px 15px;">Pembahasan</a>
											<?php
											}elseif(($cariskor > 0 or $cariskorsalah > 0) and $cariwaktu == 0){
											?>
												<div class="progress" style="height: 10px;">
													<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
													<span class="sr-only">0% Complete</span>
													</div>
												</div>
												<a href="../tryout/mulai/<?php echo $tryout->id_kategori;?>" class="btn btn-default btn-mapel" type="submit">Lanjut Mengerjakan</a>
											<?php
											}else{
											?>
											<div class="progress" style="height: 10px;">
												<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
												<span class="sr-only">0% Complete</span>
												</div>
											</div>
											
											<a href="../tryout/mulai/<?php echo $tryout->id_kategori;?>" class="btn btn-default btn-mapel" type="submit">Mulai</a>
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
				</table>
			</div>
			<?php
		}
	}
	?>
	</div>