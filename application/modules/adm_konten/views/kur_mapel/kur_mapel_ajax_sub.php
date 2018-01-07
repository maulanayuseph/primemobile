<div class="x_panel">
	<div class="x_title">
		<h2><i class="fa fa-align-left"></i> Sub Bab</h2>
		<ul class="nav navbar-right panel_toolbox">
			<li class="btn-urut-sub"><a href="#" data-toggle="modal" data-target="#modal-urut"><i class="fa fa-sort" aria-hidden="true" title="Ubah urutan sub bab"></i></a></li>
		</ul>
		<div class="clearfix">
		</div>
	</div>
	<div class="x_content">
		<?php
			foreach($datasubbab as $sub){
				?>
				<div class="accordion" id="accordion1" role="tablist" aria-multiselectable="true">
					<div class="panel">
						<a class="panel-heading collapsed" role="tab" id="headingTwo1" data-toggle="collapse" data-parent="#accordion1" href="#collapse<?php echo $sub->id_kurikulum_x_sub_bab;?>" aria-expanded="false" aria-controls="collapseTwo">
	                      <h4 class="panel-title"><strong><?php echo $sub->nama_sub_bab;?></strong></h4>
	                    </a>
	                    <div id="collapse<?php echo $sub->id_kurikulum_x_sub_bab;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false" style="height: 0px;">
			                    	<?php
										foreach($datajudul as $judul){
											if($judul->id_sub == $sub->id_kurikulum_x_sub_bab){
												if($judul->tipe == "materi"){
													$function 	= "edit_materi";
													$icon		= "fa fa-book";	
												}elseif($judul->tipe == "latihan"){
													$function 	= "latihan";
													$icon		= "fa fa-clipboard";	
												}
												?>
												<div class="panel-body">
													<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
														<strong><i class="<?php echo $icon;?>" aria-hidden="true"></i> <?php echo $judul->judul;?></strong>
													</div>
													<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
														<ul class="nav navbar-right panel_toolbox">
															<?php if($this->session->userdata('admlevel') == "superadmin" or $this->session->userdata('admlevel') == "editor" or $this->session->userdata('admlevel') == "adminqc"){
																?>
																	<li><a href="<?php echo base_url("adm_konten/". $function ."/" . $judul->id_judul);?>" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
																<?php
															}
															?>
															<?php if($this->session->userdata('admlevel') == "superadmin" or $this->session->userdata('admlevel') == "adminqc"){
																?>
																	<li><a href="<?php echo base_url("adm_konten/hapus_judul/" . $judul->id_judul);?>" title="Hapus"><i class="fa fa-times" aria-hidden="true"></i></a></li>
																<?php
															}
															?>
														</ul>
													</div>
													<div class="clearfix"></div>
													<?php
														if($judul->tipe == "materi"){
															//fetch mater
															$materi = $this->adm_konten_model->fetch_materi_author_by_id_judul($judul->id_judul);
															if($materi == null){
																$author = "N/A";
															}else{
																$author = $materi->nama;
															}

															$materi2 = $this->adm_konten_model->fetch_materi_by_id_judul($judul->id_judul);
															?>
															<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
																<small>Author : <?php echo $author;?>, Date : <?php echo $materi2->tanggal . " " . $materi2->waktu;?></small>
															</div>
															<?php
														}elseif($judul->tipe == 'latihan'){
															$jumlahsoal = $this->adm_konten_model->jumlah_soal_by_judul($judul->id_judul);
															?>
															<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
																<small>Jumlah : <?php echo $jumlahsoal;?> Soal</small>
															</div>
															<?php
														}
													?>
												</div>
												<?php
											}
										}
									?>
	                    </div>
					</div>
				</div>
				<?php
			}
		?>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-urut" tabindex="-1" role="dialog" aria-labelledby="modal-urutLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Ubah Urutan Sub Bab</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="dd" style="width: 100%;">
						<ol class="dd-list">
							<?php
								foreach($datasubbab as $sub){
									?>
									<li class="dd-item" data-id="<?php echo $sub->id_kurikulum_x_sub_bab;?>">
							            <div class="dd-handle"><?php echo $sub->nama_sub_bab;?></div>
							        </li>
									<?php
								}
							?>
						</ol>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary save-urutan-sub">Save changes</button>
			</div>
		</div>
	</div>
</div>