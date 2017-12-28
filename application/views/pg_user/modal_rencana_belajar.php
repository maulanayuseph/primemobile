
	<div class="modal fade bs-example-modal-lg" id="modalrencana" tabindex="-1" role="dialog" aria-labelledby="modalrencana">
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content modal-rencana" style="background-color: #ffe5e5;">
		  <div class="modal-header">
			<button type="button" class="close tutup-modal-rencana" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title judul-box" id="myModalLabel"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Pilih Materi</h4>
		  </div>
		  <div class="modal-body">
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane fade in active" id="homekurikulum">
						<div class="row">
							<div class="col-md-12 text-center">
								<h3 class="sub-judul-rencana" style="margin-bottom: 0px; padding-bottom: 5px;">Pilih kurikulum yang akan kamu gunakan untuk belajar</h3>
								<a href="#infokurikulum" style="color: #ad0000;"aria-controls="infokurikulum" role="tab" data-toggle="tab">Bingung memilih kurikulum yang sesuai <span class="glyphicon glyphicon glyphicon-question-sign" aria-hidden="true"></span></a>
								<br><img src="<?php echo base_url("assets/pg_user/images/pilihkurikulum.png");?>" class="char-pilih-kur"/>
							</div>
							<!--
							<div class="col-sm-6" style="text-align: right;">
								<a href="#tabk13" class="btn btn-danger btn-tambah-rencana" id="tabk13-btn" style="width: 100%;" aria-controls="tabk13" role="tab" data-toggle="tab">K-13</a>
							</div>
							<div class="col-sm-6">
								<a href="#tabktsp" class="btn btn-danger btn-tambah-rencana" id="tabktsp-btn" style="width: 100%;" aria-controls="tabktsp" role="tab" data-toggle="tab">KTSP</a>
							</div>
							-->
						</div>
					</div>
					
					<div role="tabpanel" class="tab-pane fade" id="tabk13">
						<div class="row">
							<div class="col-md-4 kolom-mapel-rencana">
								<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
									<?php
										foreach($datamapel as $mapel){
											?>
											<div class="panel panel-default panel-mapel-kiri" href="#bab<?php echo $mapel->id_mapel;?>" aria-controls="bab<?php echo $mapel->id_mapel;?>" role="tab" data-toggle="tab">
												<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $mapel->id_mapel;?>" aria-expanded="false" aria-controls="collapse<?php echo $mapel->id_mapel;?>">
													<div class="panel-heading" role="tab">
													  <h4 class="panel-title">
														  <?php echo $mapel->nama_mapel;?>
													  </h4>
													</div>
												</a>
												<ul id="collapse<?php echo $mapel->id_mapel;?>" class="panel-collapse collapse hidden-sm hidden-md hidden-lg ul-panel-kiri-bab">
													<?php
														$carimapok 	= $this->model_materi_urutan->cari_mapok_by_mapel($mapel->id_mapel);
														
														foreach($carimapok as $mapok){
															$jumlahsubk13 = $this->model_kurikulum->jumlah_subk13_by_mapok($mapok->id_materi_pokok);
															$jumlahsubirisan = $this->model_kurikulum->jumlah_subkirisan_by_mapok($mapok->id_materi_pokok);
															if($jumlahsubk13 > 0 or $jumlahsubirisan > 0){
																
																//lakukan pengecekan apakah user sudah menyimpan bab di rencana belajar, jika sudah, pake class warna merah
																$cekrencana['k13'][$mapok->id_materi_pokok] = $this->model_rencana_belajar->cek_rencana("k13", $mapok->id_materi_pokok);
																
																if($cekrencana['k13'][$mapok->id_materi_pokok] > 0){
																	//echo $cekrencana['k13'][$mapok->id_materi_pokok];
																	?>
																	<li id="k13-accor-<?php echo $mapok->id_materi_pokok;?>" role="button" class="list-group-item unselect_bab_k13">
																	<span class="glyphicon glyphicon-ok" id="ok-kiri-k13-<?php echo $mapok->id_materi_pokok;?>" aria-hidden="true"></span> <?php echo $mapok->judul_bab_k13;?>
																	</li>
																	<?php
																}else{
																	?>
																	<li id="k13-accor-<?php echo $mapok->id_materi_pokok;?>" role="button" class="list-group-item select_bab_k13">
																	<?php echo $mapok->judul_bab_k13;?>
																	</li>
																	<?php
																}
															}
														}
													?>
												</ul>
											  </div>
											<?php
										};
									?>
									
									<?php
										if($kelasaktif->id_kelas == 6 or $kelasaktif->id_kelas == 9 or $kelasaktif->id_kelas == 19 or $kelasaktif->id_kelas == 20){
											?>
											<div class="panel panel-default">
												<div class="panel-heading">
													<h4>Prediksi dan Pembahasan Ujian Nasional</h4>
												</div>
											</div>
											<?php
											foreach($datamapelun as $mapel){
												?>
												<div class="panel panel-default panel-mapel-kiri" href="#bab<?php echo $mapel->id_mapel;?>" aria-controls="bab<?php echo $mapel->id_mapel;?>" role="tab" data-toggle="tab">
													<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $mapel->id_mapel;?>" aria-expanded="false" aria-controls="collapse<?php echo $mapel->id_mapel;?>">
														<div class="panel-heading" role="tab">
														  <h4 class="panel-title">
															  <?php echo $mapel->nama_mapel;?>
														  </h4>
														</div>
													</a>
													<ul id="collapse<?php echo $mapel->id_mapel;?>" class="panel-collapse collapse hidden-sm hidden-md hidden-lg ul-panel-kiri-bab">
														<?php
															$carimapok 	= $this->model_materi_urutan->cari_mapok_by_mapel($mapel->id_mapel);
															
															foreach($carimapok as $mapok){
																$jumlahsubk13 = $this->model_kurikulum->jumlah_subk13_by_mapok($mapok->id_materi_pokok);
																$jumlahsubirisan = $this->model_kurikulum->jumlah_subkirisan_by_mapok($mapok->id_materi_pokok);
																if($jumlahsubk13 > 0 or $jumlahsubirisan > 0){
																	
																	//lakukan pengecekan apakah user sudah menyimpan bab di rencana belajar, jika sudah, pake class warna merah
																	$cekrencana['k13'][$mapok->id_materi_pokok] = $this->model_rencana_belajar->cek_rencana("k13", $mapok->id_materi_pokok);
																	
																	if($cekrencana['k13'][$mapok->id_materi_pokok] > 0){
																		//echo $cekrencana['k13'][$mapok->id_materi_pokok];
																		?>
																		<li id="k13-accor-<?php echo $mapok->id_materi_pokok;?>" role="button" class="list-group-item unselect_bab_k13">
																		<span class="glyphicon glyphicon-ok" id="ok-kiri-k13-<?php echo $mapok->id_materi_pokok;?>" aria-hidden="true"></span> <?php echo $mapok->judul_bab_k13;?>
																		</li>
																		<?php
																	}else{
																		?>
																		<li id="k13-accor-<?php echo $mapok->id_materi_pokok;?>" role="button" class="list-group-item select_bab_k13">
																		<?php echo $mapok->judul_bab_k13;?>
																		</li>
																		<?php
																	}
																}
															}
														?>
													</ul>
												  </div>
												<?php
											}
										}
									?>
								</div>
							</div>
							<div class="col-md-8 hidden-xs kolom-bab-rencana">
								<ul class="nav nav-tabs hidden-sm hidden-md hidden-lg" role="tablist">
									<?php
										foreach($datamapel as $mapel){
											?>
											<li role="presentation"><a href="#bab<?php echo $mapel->id_mapel;?>" aria-controls="bab<?php echo $mapel->id_mapel;?>" role="tab" data-toggle="tab" id="tabbab-btn<?php echo $mapel->id_mapel;?>">Settings</a></li>
											<?php
										};
										if($kelasaktif->id_kelas == 6 or $kelasaktif->id_kelas == 9 or $kelasaktif->id_kelas == 19 or $kelasaktif->id_kelas == 20){
											foreach($datamapelun as $mapel){
												?>
												<li role="presentation"><a href="#bab<?php echo $mapel->id_mapel;?>" aria-controls="bab<?php echo $mapel->id_mapel;?>" role="tab" data-toggle="tab" id="tabbab-btn<?php echo $mapel->id_mapel;?>">Settings</a></li>
												<?php
											}
										}
									?>
								</ul>
								<div class="tab-content">
								<?php
									foreach($datamapel as $mapel){
										?>
											<div role="tabpanel" class="tab-pane fade" id="bab<?php echo $mapel->id_mapel;?>">
												<?php
													$carimapok 	= $this->model_materi_urutan->cari_mapok_by_mapel($mapel->id_mapel);
													
													$e = 1;
													foreach($carimapok as $mapok){
														$jumlahsubk13 = $this->model_kurikulum->jumlah_subk13_by_mapok($mapok->id_materi_pokok);
														$jumlahsubirisan = $this->model_kurikulum->jumlah_subkirisan_by_mapok($mapok->id_materi_pokok);
														if($jumlahsubk13 > 0 or $jumlahsubirisan > 0){
															if($cekrencana['k13'][$mapok->id_materi_pokok] > 0){
																?>
																<div role="button" class="panel panel-default panel-bab-kanan pilih-bab ul-panel-kanan-bab">
																	<div class="panel-body unselect_bab_k13" id="k13-panel-<?php echo $mapok->id_materi_pokok;?>">
																		<span class="glyphicon glyphicon-ok" id="ok-kanan-k13-<?php echo $mapok->id_materi_pokok;?>" aria-hidden="true"></span> <?php echo $mapok->judul_bab_k13;?>
																	</div>
																</div>
																<?php
															}else{
																?>
																<div role="button" class="panel panel-default panel-bab-kanan pilih-bab ul-panel-kanan-bab">
																	<div class="panel-body select_bab_k13" id="k13-panel-<?php echo $mapok->id_materi_pokok;?>"><?php echo $mapok->judul_bab_k13;?>
																	</div>
																</div>
																<?php
															}
														}
														$e++;
													}
												?>
											</div>
										<?php
									};
									if($kelasaktif->id_kelas == 6 or $kelasaktif->id_kelas == 9 or $kelasaktif->id_kelas == 19 or $kelasaktif->id_kelas == 20){
										foreach($datamapelun as $mapel){
											?>
												<div role="tabpanel" class="tab-pane fade" id="bab<?php echo $mapel->id_mapel;?>">
													<?php
														$carimapok 	= $this->model_materi_urutan->cari_mapok_by_mapel($mapel->id_mapel);
														
														$e = 1;
														foreach($carimapok as $mapok){
															$jumlahsubk13 = $this->model_kurikulum->jumlah_subk13_by_mapok($mapok->id_materi_pokok);
															$jumlahsubirisan = $this->model_kurikulum->jumlah_subkirisan_by_mapok($mapok->id_materi_pokok);
															if($jumlahsubk13 > 0 or $jumlahsubirisan > 0){
																if($cekrencana['k13'][$mapok->id_materi_pokok] > 0){
																	?>
																	<div role="button" class="panel panel-default panel-bab-kanan pilih-bab ul-panel-kanan-bab">
																		<div class="panel-body unselect_bab_k13" id="k13-panel-<?php echo $mapok->id_materi_pokok;?>">
																			<span class="glyphicon glyphicon-ok" id="ok-kanan-k13-<?php echo $mapok->id_materi_pokok;?>" aria-hidden="true"></span> <?php echo $mapok->judul_bab_k13;?>
																		</div>
																	</div>
																	<?php
																}else{
																	?>
																	<div role="button" class="panel panel-default panel-bab-kanan pilih-bab ul-panel-kanan-bab">
																		<div class="panel-body select_bab_k13" id="k13-panel-<?php echo $mapok->id_materi_pokok;?>"><?php echo $mapok->judul_bab_k13;?>
																		</div>
																	</div>
																	<?php
																}
															}
															$e++;
														}
													?>
												</div>
											<?php
										}
									}
								?>
								</div>
							</div>
							<!--
							<div class="col-sm-6">
								<a href="#homekurikulum" class="btn btn-danger btn-tambah-rencana" id="tabkurikulum-btn" style="width: 100%;" href="#homekurikulum" aria-controls="homekurikulum" role="tab" data-toggle="tab">PILIH KURIKULUM</a>
							</div>
							-->
							<div class="col-sm-12">
								<a href="#homekurikulum" class="btn btn-danger btn-tambah-rencana"  style="width: 100%;" data-dismiss="modal" aria-label="Close">SELESAI</a>
							</div>
						</div>
					</div>
					
					<!-- PANEL UNTUK MATERI KTSP -->
					<!-- ######################################### -->
					<!-- ######################################### -->
					<!-- ######################################### -->
					<div role="tabpanel" class="tab-pane fade" id="tabktsp">
						<div class="row">
							<div class="col-md-4 kolom-mapel-rencana">
								<div class="panel-group" id="accordionktsp" role="tablist" aria-multiselectable="true">
									<?php
										foreach($datamapel as $mapel){
											?>
											<div class="panel panel-default panel-mapel-kiri" href="#babktsp<?php echo $mapel->id_mapel;?>" aria-controls="babktsp<?php echo $mapel->id_mapel;?>" role="tab" data-toggle="tab">
												<a role="button" data-toggle="collapse" data-parent="#accordionktsp" href="#collapsektsp<?php echo $mapel->id_mapel;?>" aria-expanded="false" aria-controls="collapse<?php echo $mapel->id_mapel;?>">
													<div class="panel-heading" role="tab">
													  <h4 class="panel-title">
														  <?php echo $mapel->nama_mapel;?>
													  </h4>
													</div>
												</a>
												<ul id="collapsektsp<?php echo $mapel->id_mapel;?>" class="panel-collapse collapse hidden-sm hidden-md hidden-lg ul-panel-kiri-bab">
													<?php
														$carimapok 	= $this->model_materi_urutan->cari_mapok_by_mapel($mapel->id_mapel);
														
														foreach($carimapok as $mapok){
															$jumlahsubktsp = $this->model_kurikulum->jumlah_ktsp_by_mapok($mapok->id_materi_pokok);
															$jumlahsubirisan = $this->model_kurikulum->jumlah_subkirisan_by_mapok($mapok->id_materi_pokok);
															if($jumlahsubktsp > 0 or $jumlahsubirisan > 0){
																
																$cekrencana['ktsp'][$mapok->id_materi_pokok] = $this->model_rencana_belajar->cek_rencana("ktsp", $mapok->id_materi_pokok);
																
																if($cekrencana['ktsp'][$mapok->id_materi_pokok] > 0){
																	//echo $cekrencana['k13'][$mapok->id_materi_pokok];
																	?>
																	<li id="ktsp-accor-<?php echo $mapok->id_materi_pokok;?>" role="button" class="list-group-item unselect_bab_k13">
																	<span class="glyphicon glyphicon-ok" id="ok-kiri-ktsp-<?php echo $mapok->id_materi_pokok;?>" aria-hidden="true"></span> <?php echo $mapok->judul_bab_ktsp;?>
																	</li>
																	<?php
																}else{
																	?>
																	<li id="ktsp-accor-<?php echo $mapok->id_materi_pokok;?>" role="button" class="list-group-item select_bab_k13">
																	<?php echo $mapok->judul_bab_ktsp;?>
																	</li>
																	<?php
																}
															}
														}
													?>
												</ul>
											  </div>
											<?php
										};
										if($kelasaktif->id_kelas == 6 or $kelasaktif->id_kelas == 9 or $kelasaktif->id_kelas == 19 or $kelasaktif->id_kelas == 20){
											?>
											<div class="panel panel-default">
												<div class="panel-heading">
													<h4>Prediksi dan Pembahasan Ujian Nasional</h4>
												</div>
											</div>
											<?php
											foreach($datamapelun as $mapel){
												?>
												<div class="panel panel-default panel-mapel-kiri" href="#babktsp<?php echo $mapel->id_mapel;?>" aria-controls="babktsp<?php echo $mapel->id_mapel;?>" role="tab" data-toggle="tab">
													<a role="button" data-toggle="collapse" data-parent="#accordionktsp" href="#collapsektsp<?php echo $mapel->id_mapel;?>" aria-expanded="false" aria-controls="collapse<?php echo $mapel->id_mapel;?>">
														<div class="panel-heading" role="tab">
														  <h4 class="panel-title">
															  <?php echo $mapel->nama_mapel;?>
														  </h4>
														</div>
													</a>
													<ul id="collapsektsp<?php echo $mapel->id_mapel;?>" class="panel-collapse collapse hidden-sm hidden-md hidden-lg ul-panel-kiri-bab">
														<?php
															$carimapok 	= $this->model_materi_urutan->cari_mapok_by_mapel($mapel->id_mapel);
															
															foreach($carimapok as $mapok){
																$jumlahsubktsp = $this->model_kurikulum->jumlah_ktsp_by_mapok($mapok->id_materi_pokok);
																$jumlahsubirisan = $this->model_kurikulum->jumlah_subkirisan_by_mapok($mapok->id_materi_pokok);
																if($jumlahsubktsp > 0 or $jumlahsubirisan > 0){
																	
																	$cekrencana['ktsp'][$mapok->id_materi_pokok] = $this->model_rencana_belajar->cek_rencana("ktsp", $mapok->id_materi_pokok);
																	
																	if($cekrencana['ktsp'][$mapok->id_materi_pokok] > 0){
																		//echo $cekrencana['k13'][$mapok->id_materi_pokok];
																		?>
																		<li id="ktsp-accor-<?php echo $mapok->id_materi_pokok;?>" role="button" class="list-group-item unselect_bab_k13">
																		<span class="glyphicon glyphicon-ok" id="ok-kiri-ktsp-<?php echo $mapok->id_materi_pokok;?>" aria-hidden="true"></span> <?php echo $mapok->judul_bab_ktsp;?>
																		</li>
																		<?php
																	}else{
																		?>
																		<li id="ktsp-accor-<?php echo $mapok->id_materi_pokok;?>" role="button" class="list-group-item select_bab_k13">
																		<?php echo $mapok->judul_bab_ktsp;?>
																		</li>
																		<?php
																	}
																}
															}
														?>
													</ul>
												  </div>
												<?php
											}
										}
									?>
								  
								</div>
							</div>
							<div class="col-md-8 hidden-xs kolom-bab-rencana">
								<ul class="nav nav-tabs hidden-sm hidden-md hidden-lg" role="tablist">
									<?php
										foreach($datamapel as $mapel){
											?>
											<li role="presentation"><a href="#bab<?php echo $mapel->id_mapel;?>" aria-controls="bab<?php echo $mapel->id_mapel;?>" role="tab" data-toggle="tab" id="tabbab-btn<?php echo $mapel->id_mapel;?>">Settings</a></li>
											<?php
										};
										if($kelasaktif->id_kelas == 6 or $kelasaktif->id_kelas == 9 or $kelasaktif->id_kelas == 19 or $kelasaktif->id_kelas == 20){
											foreach($datamapelun as $mapel){
												?>
												<li role="presentation"><a href="#bab<?php echo $mapel->id_mapel;?>" aria-controls="bab<?php echo $mapel->id_mapel;?>" role="tab" data-toggle="tab" id="tabbab-btn<?php echo $mapel->id_mapel;?>">Settings</a></li>
												<?php
											}
										}
									?>
								</ul>
								<div class="tab-content">
								<?php
									foreach($datamapel as $mapel){
										?>
											<div role="tabpanel" class="tab-pane fade" id="babktsp<?php echo $mapel->id_mapel;?>">
												<?php
													$carimapok 	= $this->model_materi_urutan->cari_mapok_by_mapel($mapel->id_mapel);
													
													foreach($carimapok as $mapok){
														$jumlahsubktsp = $this->model_kurikulum->jumlah_ktsp_by_mapok($mapok->id_materi_pokok);
														$jumlahsubirisan = $this->model_kurikulum->jumlah_subkirisan_by_mapok($mapok->id_materi_pokok);
														if($jumlahsubktsp > 0 or $jumlahsubirisan > 0){
															if($cekrencana['ktsp'][$mapok->id_materi_pokok] > 0){
																?>
																<div role="button" class="panel panel-default panel-bab-kanan pilih-bab ul-panel-kanan-bab">
																	<div class="panel-body unselect_bab_k13" id="ktsp-panel-<?php echo $mapok->id_materi_pokok;?>">
																		<span class="glyphicon glyphicon-ok" id="ok-kanan-k13-<?php echo $mapok->id_materi_pokok;?>" aria-hidden="true"></span> <?php echo $mapok->judul_bab_ktsp;?>
																	</div>
																</div>
																<?php
															}else{
																?>
																<div role="button" class="panel panel-default panel-bab-kanan pilih-bab ul-panel-kanan-bab">
																	<div class="panel-body select_bab_k13" id="ktsp-panel-<?php echo $mapok->id_materi_pokok;?>"><?php echo $mapok->judul_bab_ktsp;?>
																	</div>
																</div>
																<?php
															}
														}
													}
												?>
											</div>
										<?php
									};
									if($kelasaktif->id_kelas == 6 or $kelasaktif->id_kelas == 9 or $kelasaktif->id_kelas == 19 or $kelasaktif->id_kelas == 20){
										foreach($datamapelun as $mapel){
											?>
												<div role="tabpanel" class="tab-pane fade" id="babktsp<?php echo $mapel->id_mapel;?>">
													<?php
														$carimapok 	= $this->model_materi_urutan->cari_mapok_by_mapel($mapel->id_mapel);
														
														foreach($carimapok as $mapok){
															$jumlahsubktsp = $this->model_kurikulum->jumlah_ktsp_by_mapok($mapok->id_materi_pokok);
															$jumlahsubirisan = $this->model_kurikulum->jumlah_subkirisan_by_mapok($mapok->id_materi_pokok);
															if($jumlahsubktsp > 0 or $jumlahsubirisan > 0){
																if($cekrencana['ktsp'][$mapok->id_materi_pokok] > 0){
																	?>
																	<div role="button" class="panel panel-default panel-bab-kanan pilih-bab ul-panel-kanan-bab">
																		<div class="panel-body unselect_bab_k13" id="ktsp-panel-<?php echo $mapok->id_materi_pokok;?>">
																			<span class="glyphicon glyphicon-ok" id="ok-kanan-k13-<?php echo $mapok->id_materi_pokok;?>" aria-hidden="true"></span> <?php echo $mapok->judul_bab_ktsp;?>
																		</div>
																	</div>
																	<?php
																}else{
																	?>
																	<div role="button" class="panel panel-default panel-bab-kanan pilih-bab ul-panel-kanan-bab">
																		<div class="panel-body select_bab_k13" id="ktsp-panel-<?php echo $mapok->id_materi_pokok;?>"><?php echo $mapok->judul_bab_ktsp;?>
																		</div>
																	</div>
																	<?php
																}
															}
														}
													?>
												</div>
											<?php
										}
									}
								?>
								</div>
							</div>
							<!--
							<div class="col-sm-6">
								<a href="#homekurikulum" class="btn btn-danger btn-tambah-rencana" id="tabkurikulum-btn" style="width: 100%;" href="#homekurikulum" aria-controls="homekurikulum" role="tab" data-toggle="tab">PILIH KURIKULUM</a>
							</div>
							-->
							<div class="col-sm-12">
								<a href="#homekurikulum" class="btn btn-danger btn-tambah-rencana"  style="width: 100%;" data-dismiss="modal" aria-label="Close">SELESAI</a>
							</div>
						</div>
					</div>
					<!-- END PANEL UNTUK MATERI KTSP -->
					<!-- ######################################### -->
					<!-- ######################################### -->
					<!-- ######################################### -->
					
					<!-- PANEL UNTUK MATERI K-13 REVISI -->
					<!-- ######################################### -->
					<!-- ######################################### -->
					<!-- ######################################### -->
					<div role="tabpanel" class="tab-pane fade" id="tabk13rev">
						<div class="row">
							<div class="col-md-4 kolom-mapel-rencana">
								<div class="panel-group" id="accordionk13rev" role="tablist" aria-multiselectable="true">
									<?php
										foreach($datamapel as $mapel){
											?>
											<div class="panel panel-default panel-mapel-kiri" href="#babk13rev<?php echo $mapel->id_mapel;?>" aria-controls="bab<?php echo $mapel->id_mapel;?>" role="tab" data-toggle="tab">
												<a role="button" data-toggle="collapse" data-parent="#accordionk13rev" href="#collapsek13rev<?php echo $mapel->id_mapel;?>" aria-expanded="false" aria-controls="collapse<?php echo $mapel->id_mapel;?>">
													<div class="panel-heading" role="tab">
													  <h4 class="panel-title">
														  <?php echo $mapel->nama_mapel;?>
													  </h4>
													</div>
												</a>
												<ul id="collapsek13rev<?php echo $mapel->id_mapel;?>" class="panel-collapse collapse hidden-sm hidden-md hidden-lg ul-panel-kiri-bab">
													<?php
														$carimapok 	= $this->model_materi_urutan->cari_mapok_by_mapel($mapel->id_mapel);
														
														foreach($carimapok as $mapok){
															$jumlahsubk13rev = $this->model_kurikulum->jumlah_subk13rev_by_mapok($mapok->id_materi_pokok);
															if($jumlahsubk13rev > 0){
																
																//lakukan pengecekan apakah user sudah menyimpan bab di rencana belajar, jika sudah, pake class warna merah
																$cekrencana['k13rev'][$mapok->id_materi_pokok] = $this->model_rencana_belajar->cek_rencana("K-13 REVISI", $mapok->id_materi_pokok);
																
																if($cekrencana['k13rev'][$mapok->id_materi_pokok] > 0){
																	//echo $cekrencana['k13'][$mapok->id_materi_pokok];
																	?>
																	<li id="k13rev-accor-<?php echo $mapok->id_materi_pokok;?>" role="button" class="list-group-item unselect_bab_k13">
																	<span class="glyphicon glyphicon-ok" id="ok-kiri-k13-<?php echo $mapok->id_materi_pokok;?>" aria-hidden="true"></span> <?php echo $mapok->judul_bab_k13;?>
																	</li>
																	<?php
																}else{
																	?>
																	<li id="k13rev-accor-<?php echo $mapok->id_materi_pokok;?>" role="button" class="list-group-item select_bab_k13">
																	<?php echo $mapok->judul_bab_k13;?>
																	</li>
																	<?php
																}
															}
														}
													?>
												</ul>
											  </div>
											<?php
										};
										if($kelasaktif->id_kelas == 6 or $kelasaktif->id_kelas == 9 or $kelasaktif->id_kelas == 19 or $kelasaktif->id_kelas == 20){
											?>
											<div class="panel panel-default">
												<div class="panel-heading">
													<h4>Prediksi dan Pembahasan Ujian Nasional</h4>
												</div>
											</div>
											<?php
											foreach($datamapelun as $mapel){
												?>
												<div class="panel panel-default panel-mapel-kiri" href="#babk13rev<?php echo $mapel->id_mapel;?>" aria-controls="bab<?php echo $mapel->id_mapel;?>" role="tab" data-toggle="tab">
													<a role="button" data-toggle="collapse" data-parent="#accordionk13rev" href="#collapsek13rev<?php echo $mapel->id_mapel;?>" aria-expanded="false" aria-controls="collapse<?php echo $mapel->id_mapel;?>">
														<div class="panel-heading" role="tab">
														  <h4 class="panel-title">
															  <?php echo $mapel->nama_mapel;?>
														  </h4>
														</div>
													</a>
													<ul id="collapsek13rev<?php echo $mapel->id_mapel;?>" class="panel-collapse collapse hidden-sm hidden-md hidden-lg ul-panel-kiri-bab">
														<?php
															$carimapok 	= $this->model_materi_urutan->cari_mapok_by_mapel($mapel->id_mapel);
															
															foreach($carimapok as $mapok){
																$jumlahsubk13rev = $this->model_kurikulum->jumlah_subk13rev_by_mapok($mapok->id_materi_pokok);
																if($jumlahsubk13rev > 0){
																	
																	//lakukan pengecekan apakah user sudah menyimpan bab di rencana belajar, jika sudah, pake class warna merah
																	$cekrencana['k13rev'][$mapok->id_materi_pokok] = $this->model_rencana_belajar->cek_rencana("K-13 REVISI", $mapok->id_materi_pokok);
																	
																	if($cekrencana['k13rev'][$mapok->id_materi_pokok] > 0){
																		//echo $cekrencana['k13'][$mapok->id_materi_pokok];
																		?>
																		<li id="k13rev-accor-<?php echo $mapok->id_materi_pokok;?>" role="button" class="list-group-item unselect_bab_k13">
																		<span class="glyphicon glyphicon-ok" id="ok-kiri-k13-<?php echo $mapok->id_materi_pokok;?>" aria-hidden="true"></span> <?php echo $mapok->judul_bab_k13;?>
																		</li>
																		<?php
																	}else{
																		?>
																		<li id="k13rev-accor-<?php echo $mapok->id_materi_pokok;?>" role="button" class="list-group-item select_bab_k13">
																		<?php echo $mapok->judul_bab_k13;?>
																		</li>
																		<?php
																	}
																}
															}
														?>
													</ul>
												  </div>
												<?php
											}
										}
									?>

									

								</div>
							</div>
							<div class="col-md-8 hidden-xs kolom-bab-rencana">
								<ul class="nav nav-tabs hidden-sm hidden-md hidden-lg" role="tablist">
									<?php
										foreach($datamapel as $mapel){
											?>
											<li role="presentation"><a href="#babk13rev<?php echo $mapel->id_mapel;?>" aria-controls="babk13rev<?php echo $mapel->id_mapel;?>" role="tab" data-toggle="tab" id="tabbab-btn<?php echo $mapel->id_mapel;?>">Settings</a></li>
											<?php
										};

										//MAPEL UNTUK PEMBAHASAN US/M SD
										//##############################
										//##############################
										//##############################
										if($kelasaktif->id_kelas == 6 or $kelasaktif->id_kelas == 9 or $kelasaktif->id_kelas == 19  or $kelasaktif->id_kelas == 20){
											foreach($datamapelun as $mapel){
												?>
												<li role="presentation"><a href="#babk13rev<?php echo $mapel->id_mapel;?>" aria-controls="babk13rev<?php echo $mapel->id_mapel;?>" role="tab" data-toggle="tab" id="tabbab-btn<?php echo $mapel->id_mapel;?>">Settings</a></li>
												<?php
											}
										}
										//END MAPEL UNTUK PEMBAHASAN US/M SD
										//##############################
										//##############################
										//##############################
									?>
								</ul>
								<div class="tab-content">
								<?php
									foreach($datamapel as $mapel){
										?>
											<div role="tabpanel" class="tab-pane fade" id="babk13rev<?php echo $mapel->id_mapel;?>">
												<?php
													$carimapok 	= $this->model_materi_urutan->cari_mapok_by_mapel($mapel->id_mapel);
													
													$e = 1;
													foreach($carimapok as $mapok){
														$jumlahsubk13rev = $this->model_kurikulum->jumlah_subk13rev_by_mapok($mapok->id_materi_pokok);
														if($jumlahsubk13rev > 0){
															if($cekrencana['k13rev'][$mapok->id_materi_pokok] > 0){
																?>
																<div role="button" class="panel panel-default panel-bab-kanan pilih-bab ul-panel-kanan-bab">
																	<div class="panel-body unselect_bab_k13" id="k13rev-panel-<?php echo $mapok->id_materi_pokok;?>">
																		<span class="glyphicon glyphicon-ok" id="ok-kanan-k13-<?php echo $mapok->id_materi_pokok;?>" aria-hidden="true"></span> <?php echo $mapok->judul_bab_k13;?>
																	</div>
																</div>
																<?php
															}else{
																?>
																<div role="button" class="panel panel-default panel-bab-kanan pilih-bab ul-panel-kanan-bab">
																	<div class="panel-body select_bab_k13" id="k13rev-panel-<?php echo $mapok->id_materi_pokok;?>"><?php echo $mapok->judul_bab_k13;?>
																	</div>
																</div>
																<?php
															}
														}
														$e++;
													}
												?>
											</div>
										<?php
									};
									if($kelasaktif->id_kelas == 6 or $kelasaktif->id_kelas == 9 or $kelasaktif->id_kelas == 19 or $kelasaktif->id_kelas == 20){
										foreach($datamapelun as $mapel){
											?>
												<div role="tabpanel" class="tab-pane fade" id="babk13rev<?php echo $mapel->id_mapel;?>">
													<?php
														$carimapok 	= $this->model_materi_urutan->cari_mapok_by_mapel($mapel->id_mapel);
														
														$e = 1;
														foreach($carimapok as $mapok){
															$jumlahsubk13rev = $this->model_kurikulum->jumlah_subk13rev_by_mapok($mapok->id_materi_pokok);
															if($jumlahsubk13rev > 0){
																if($cekrencana['k13rev'][$mapok->id_materi_pokok] > 0){
																	?>
																	<div role="button" class="panel panel-default panel-bab-kanan pilih-bab ul-panel-kanan-bab">
																		<div class="panel-body unselect_bab_k13" id="k13rev-panel-<?php echo $mapok->id_materi_pokok;?>">
																			<span class="glyphicon glyphicon-ok" id="ok-kanan-k13-<?php echo $mapok->id_materi_pokok;?>" aria-hidden="true"></span> <?php echo $mapok->judul_bab_k13;?>
																		</div>
																	</div>
																	<?php
																}else{
																	?>
																	<div role="button" class="panel panel-default panel-bab-kanan pilih-bab ul-panel-kanan-bab">
																		<div class="panel-body select_bab_k13" id="k13rev-panel-<?php echo $mapok->id_materi_pokok;?>"><?php echo $mapok->judul_bab_k13;?>
																		</div>
																	</div>
																	<?php
																}
															}
															$e++;
														}
													?>
												</div>
											<?php
										}
									}
								?>
								</div>
							</div>
							
							<!--
							<div class="col-sm-6">
								<a href="#homekurikulum" class="btn btn-danger btn-tambah-rencana" id="tabkurikulum-btn" style="width: 100%;" href="#homekurikulum" aria-controls="homekurikulum" role="tab" data-toggle="tab">PILIH KURIKULUM</a>
							</div>
							-->
							<div class="col-sm-12">
								<a href="#homekurikulum" class="btn btn-danger btn-tambah-rencana"  style="width: 100%;" data-dismiss="modal" aria-label="Close">SELESAI</a>
							</div>
						</div>
					</div>
					<!-- END PANEL UNTUK MATERI K-12 REVISI -->
					<!-- ######################################### -->
					<!-- ######################################### -->
					<!-- ######################################### -->
					
					<div role="tabpanel" class="tab-pane fade" id="infokurikulum">
						<div class="row">
							<div class="col-md-12 text-center">
								<img src="<?php echo base_url("assets/pg_user/images/bingungkurikulum.png");?>" style="height: 350px; width: auto;" />
							</div>
							<div class="col-md-12">
								
							</div>
							<div class="col-sm-6" style="text-align: right;">
								<a href="#tabk13" class="btn btn-danger btn-tambah-rencana" id="tabk13-btn" style="width: 100%;" aria-controls="tabk13" role="tab" data-toggle="tab">K-13</a>
							</div>
							<div class="col-sm-6">
								<a href="#tabktsp" class="btn btn-danger btn-tambah-rencana" id="tabktsp-btn" style="width: 100%;" aria-controls="tabk13" role="tab" data-toggle="tab">KTSP</a>
							</div>
							<div class="col-sm-6">
								<a href="#tabk13rev" class="btn btn-danger btn-tambah-rencana" id="tabk13rev-btn" style="width: 100%;" aria-controls="tabk13rev" role="tab" data-toggle="tab">K-13 REVISIS</a>
							</div>
						</div>
					</div>
				</div>
		  </div>
		</div>
	  </div>
	</div>
	<!-- END RENCANA BELAJAR KURIKULUM -->
	<!-- ###################################### -->
	<!-- ###################################### -->
	
	<!-- MODAL NOTIFIKASI ERROR JIKA TERJADI KEGAGALAN AJAX -->
	<!-- ###################################### -->
	<!-- ###################################### -->
	
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalrencanaerror" style="display: none;">
Launch demo modal
</button>

<div class="modal fade" id="modalrencanaerror" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Error</h4>
      </div>
      <div class="modal-body">
        Terjadi kesalahan koneksi ke server, silahkan coba lagi
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
	
	<!-- END MODAL NOTIFIKASI ERROR JIKA TERJADI KEGAGALAN AJAX -->
	<!-- ###################################### -->
	<!-- ###################################### -->