<?php
include('header_dashboard.php');
?>
<div class="container-fluid akun-container">
	<div class="tabel-analisa waktu">
		<div class="title"><img src="<?php echo base_url('assets/dashboard/images/first.png'); ?>">Prime Mobile CBT </div>
	</div>
	<div class="col-lg-12">
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active text-center" style="width: 50%;"><a href="#cbt" aria-controls="cbt" role="tab" data-toggle="tab">Sedang Berlangsung</a></li>
		<li role="presentation" class="text-center" style="width: 50%;"><a href="#arsip" aria-controls="cbt" role="tab" data-toggle="tab">Arsip, Penilaian & Pembahasan CBT</a></li>
	</ul>
	</div>
	<div class="col-lg-12">
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane fade in active" id="cbt">
				<br>&nbsp;
				<?php
					if($tahunajaran !== null){
						$carikelasparalel = $this->model_pr->fetch_kelas_siswa($this->session->userdata("id_siswa"));
						if($carikelasparalel !== null){
							foreach($carikelasparalel as $kelassiswa){
								//cari cbt berdasarkan kelas paralel, tahun ajaran dan tanggal
								$fetchcbt = $this->model_psep_cbt->fetch_cbt_berlangsung($kelassiswa->id_kelas_paralel, $kelassiswa->id_tahun_ajaran);

								if($fetchcbt !== null){
									$idprofil = 0;
									foreach($fetchcbt as $sesi){
										if($idprofil !== $sesi->id_profil){
											//echo "<p>" . $sesi->startdate;
											if($sesi->banner == "-"){
												$back = base_url("assets/pg_user/images/talent.jpg");
											}else{
												$back = base_url("assets/uploads/banner/" . $sesi->banner);
											}

											if($kelasaktif->tipe == 0){
												if($sesi->tipe == 0){
													$akses = "bisa";
												}elseif($sesi->tipe == 2 and $tahunajaran !== null){
													$akses = "bisa";
												}elseif($sesi->tipe == 2 and $tahunajaran == null){
													$akses = "tidak bisa";
												}elseif($sesi->tipe == 4){
													$akses = "bisa";
												}elseif($sesi->tipe == 5){
													$akses = "tidak bisa";
												}
											}elseif($kelasaktif->tipe == 3){
												if($sesi->tipe == 0){
													$akses = "bisa";
												}elseif($sesi->tipe == 2 and $tahunajaran !== null){
													$akses = "bisa";
												}elseif($sesi->tipe == 2 and $tahunajaran == null){
													$akses = "tidak bisa";
												}elseif($sesi->tipe == 4){
													$akses = "tidak bisa";
												}elseif($sesi->tipe == 5){
													$akses = "tidak bisa";
												}
											}elseif($kelasaktif->tipe == 4){
												if($sesi->tipe == 0){
													$akses = "bisa";
												}elseif($sesi->tipe == 2 and $tahunajaran !== null){
													$akses = "bisa";
												}elseif($sesi->tipe == 2 and $tahunajaran == null){
													$akses = "tidak bisa";
												}elseif($sesi->tipe == 4){
													$akses = "bisa";
												}elseif($sesi->tipe == 5){
													$akses = "bisa";
												}
											}
											?>
											<div class="panel panel-default panel-cbt">
												<div class="panel-body panel-body-cbt">
													<div class="row row-cbt">
														
														<div class="col-sm-4 panel-cbt-banner" style="background-image: url('<?php echo $back;?>');">
														</div>
														<div class="col-sm-8 panel-cbt-desc">
															<div class="col-sm-12">
																<h3><?php echo $sesi->nama_profil;?></h3>
															</div>
															<div class="col-sm-6">
																<strong>Tanggal Mulai : </strong><?php echo $sesi->startdate;?>
																<br><strong>Tanggal Berakhir : </strong><?php echo $sesi->enddate;?>
																<br>&nbsp;
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
																	<a class="btn btn-sm btn-danger" href="<?php echo base_url('user/statistiknilai/'.$sesi->id_tryout);?>" style="width: 100%;">Lihat Ranking & Penilaian</a>
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
																$caripel 		= $this->model_dashboard->cari_analisis_pelajaran($tryout->id_kategori, $idsiswa);
																
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
															if($caripel > 0){
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
																<?php
																	if($akses == "bisa"){
																		?>
																		<a href="../tryout/mulai/<?php echo $tryout->id_kategori;?>" class="btn btn-default btn-mapel" type="submit">Lanjut Mengerjakan</a>
																		<?php
																	}else{
																		?>
																		<button class="btn btn-default btn-mapel">Lanjut Mengerjakan</button>
																		<?php
																	}
																?>
															<?php
															}else{
															?>
															<div class="progress" style="height: 10px;">
																<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
																<span class="sr-only">0% Complete</span>
																</div>
															</div>
															<?php
																if($akses == "bisa"){
																	?>
																	
																	<?php
																}else{
																	?>

																	<?php
																}
															?>
															<a href="../tryout/mulai/<?php echo $tryout->id_kategori;?>" class="btn btn-default btn-mapel" type="submit">Mulai</a>
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
										$idprofil = $sesi->id_profil;
									}
								}
							}
						}
					}else{
						if($infosiswa->kurikulum == ""){
							?>
							<div class="alert alert-danger" role="alert">
								Akses CBT tidak dapat dibuka, anda harus set kurikulum yang akan anda gunakan terlebih dahulu.
								<br><a href="#">Klik di sini untuk set kurikulum</a>
							</div>
							<?php
						}else{
							foreach($datacbtreg as $cbt){
								if($cbt->id_kelas == $kelasaktif->id_kelas){
									$startdate 	= new DateTime($cbt->start_date);
									$enddate 	= new DateTime($cbt->end_date);
									$today		= new DateTime(date("Y-m-d"));
									
									if($cbt->banner == "-"){
										$back = base_url("assets/pg_user/images/talent.jpg");
									}else{
										$back = base_url("assets/uploads/banner/" . $cbt->banner);
									}
									
									if($startdate <= $today and $enddate >= $today and $cbt->kurikulum == $infosiswa->kurikulum){
										?>
										<div class="panel panel-default panel-cbt">
											<div class="panel-body panel-body-cbt">
												<div class="row row-cbt">
													
													<div class="col-sm-4 panel-cbt-banner" style="background-image: url('<?php echo $back;?>');">
													</div>
													<div class="col-sm-8 panel-cbt-desc">
														<div class="col-sm-12">
															<h3><?php echo $cbt->nama_profil;?></h3>
														</div>
														<div class="col-sm-6">
															<strong>Tanggal Mulai : </strong><?php echo $cbt->start_date;?>
															<br><strong>Tanggal Berakhir : </strong><?php echo $cbt->end_date;?>
															<br>&nbsp;
														</div>
														<div class="col-sm-6">
														<h3 class="panel-title">Materi Ujian</h3>
														<?php
															$caritryout = $this->model_dashboard->get_all_tryout_by_profil($cbt->id_tryout);
															foreach($caritryout as $tryout){
																?>
																<br>- <?php echo $tryout->nama_kategori;?>
																<?php
															}
														?>
														</div>
														<div class="col-sm-12 panel-btn-cbt">
															<div class="col-sm-6 col-xs-12">
																<a class="btn btn-sm btn-danger" href="<?php echo base_url('user/statistiknilai/'.$cbt->id_tryout);?>" style="width: 100%;">Lihat Ranking & Penilaian</a>
															</div>
															<div class="col-sm-6 col-xs-12">
																<button  class="btn btn-sm btn-success" style="width: 100%;" type="button" data-toggle="collapse" data-target="#cbt<?php echo $cbt->id_tryout;?>" aria-expanded="false" aria-controls="cbt<?php echo $cbt->id_tryout;?>">Mulai CBT</button >
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="collapse" id="cbt<?php echo $cbt->id_tryout;?>">
											<div class="row" style="margin: 0px;">
											<?php
											foreach($caritryout as $tryout){
												if($tryout->status_kategori == 1){
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
											}
											?>
											</div>
										</div>
										<?php
									}
								}
							}
						}
					}
				?>
				<?php 
				
				?>
			</div>
			<div role="tabpanel" class="tab-pane fade" id="arsip">
				<br>&nbsp;
				<?php
					if($tahunajaran !== null){
						$carikelasparalel = $this->model_pr->fetch_kelas_siswa($this->session->userdata("id_siswa"));
						if($carikelasparalel !== null){
							foreach($carikelasparalel as $kelassiswa){
								//cari cbt berdasarkan kelas paralel, tahun ajaran dan tanggal
								$fetchcbt = $this->model_psep_cbt->fetch_cbt_bahas($kelassiswa->id_kelas_paralel, $kelassiswa->id_tahun_ajaran);

								if($fetchcbt !== null){
									foreach($fetchcbt as $cbt){
										if($cbt->banner == "-"){
											$back = base_url("assets/pg_user/images/talent.jpg");
										}else{
											$back = base_url("assets/uploads/banner/" . $cbt->banner);
										}

										?>
										<div class="panel panel-default panel-cbt">
											<div class="panel-body panel-body-cbt">
												<div class="row row-cbt">
													
													<div class="col-sm-4 panel-cbt-banner" style="background-image: url('<?php echo $back;?>');">
													</div>
													<div class="col-sm-8 panel-cbt-desc">
														<div class="col-sm-12">
															<h3><?php echo $cbt->nama_profil;?></h3>
														</div>
														<div class="col-sm-6">
														<h3 class="panel-title">Materi Ujian</h3>
														<?php
															$caritryout = $this->model_dashboard->get_all_tryout_by_profil($cbt->id_tryout);
															foreach($caritryout as $tryout){
																?>
																<br>- <?php echo $tryout->nama_kategori;?>
																<?php
															}
														?>
														</div>
														<div class="col-sm-12">
															&nbsp;
														</div>
														<div class="col-sm-12 panel-btn-cbt">
															<div class="col-sm-6 col-xs-12">
																<button  class="btn btn-sm btn-success" style="width: 100%;" type="button" data-toggle="collapse" data-target="#bahas<?php echo $cbt->id_tryout;?>" aria-expanded="false" aria-controls="bahas<?php echo $cbt->id_tryout;?>">Pembahasan</button >
															</div>
															<div class="col-sm-6 col-xs-12">
																<a class="btn btn-sm btn-danger" href="<?php echo base_url('user/statistiknilai/'.$cbt->id_tryout);?>" style="width: 100%;">Lihat Ranking & Penilaian</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="collapse" id="bahas<?php echo $cbt->id_tryout;?>">
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
																$caripel 		= $this->model_dashboard->cari_analisis_pelajaran($tryout->id_kategori, $idsiswa);
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
															if($caripel > 0){
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
																<a href="../tryout/openclass/<?php echo $tryout->id_kategori; ?>" class="btn btn-primary" style="float: right; margin: 15px 0;">Open Class</a>
																<a href="../tryout/pembahasan/<?php echo $tryout->id_kategori;?>" class="btn btn-success" type="submit" style="float: right; margin: 15px 15px;">Pembahasan</a>
															<?php
															}else{
															?>
															<div class="progress" style="height: 10px;">
																<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
																<span class="sr-only">0% Complete</span>
																</div>
															</div>
															
															<a href="../tryout/openclass/<?php echo $tryout->id_kategori; ?>" class="btn btn-primary" style="float: right; margin: 15px 0;">Open Class</a>
															<a href="../tryout/pembahasan/<?php echo $tryout->id_kategori;?>" class="btn btn-success" type="submit" style="float: right; margin: 15px 15px;">Pembahasan</a>
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
								}

							}
						}
					}else{
						foreach($datacbtreg as $cbt){
							if($cbt->id_kelas == $kelasaktif->id_kelas){
								$startdate 	= new DateTime($cbt->start_date);
								$enddate 	= new DateTime($cbt->end_date);
								$today		= new DateTime(date("Y-m-d"));
								
								if($cbt->banner == "-"){
									$back = base_url("assets/pg_user/images/talent.jpg");
								}else{
									$back = base_url("assets/uploads/banner/" . $cbt->banner);
								}
								
								if($startdate <= $today and $enddate <= $today){
									?>
									<div class="panel panel-default panel-cbt">
										<div class="panel-body panel-body-cbt">
											<div class="row row-cbt">
												
												<div class="col-sm-4 panel-cbt-banner" style="background-image: url('<?php echo $back;?>');">
												</div>
												<div class="col-sm-8 panel-cbt-desc">
													<div class="col-sm-12">
														<h3><?php echo $cbt->nama_profil;?></h3>
													</div>
													<div class="col-sm-6">
														<strong>Tanggal Mulai : </strong><?php echo $cbt->start_date;?>
														<br><strong>Tanggal Berakhir : </strong><?php echo $cbt->end_date;?>
														<br>&nbsp;
													</div>
													<div class="col-sm-6">
													<h3 class="panel-title">Materi Ujian</h3>
													<?php
														$caritryout = $this->model_dashboard->get_all_tryout_by_profil($cbt->id_tryout);
														foreach($caritryout as $tryout){
															?>
															<br>- <?php echo $tryout->nama_kategori;?>
															<?php
														}
													?>
													</div>
													<div class="col-sm-12 panel-btn-cbt">
														<div class="col-sm-6 col-xs-12">
															
														</div>
														<div class="col-sm-6 col-xs-12">
															<a class="btn btn-sm btn-danger" href="<?php echo base_url('user/statistiknilai/'.$cbt->id_tryout);?>" style="width: 100%;">Lihat Ranking & Penilaian</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<?php
								}
							}
						}
					}
				?>
			</div>
		</div>
	</div>
	
	
</div>
	
<!-- Modal untuk error ajax -->
<div class="modal fade" id="modal-error-aktivasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
		<p>Anda tidak memiliki aktivasi untuk akses fitur pembelajaran
      </div>
	  <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<?php include('footer.php'); ?>

<script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>

<script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('assets/dashboard/js/init.js');?>"></script>
<!--  Datatables Plugin -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>

 </body>
</html>
