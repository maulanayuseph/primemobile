<script>
$(function(){
	$("#kembalirencanabelajar").click(function() {
		$("#content-rencana").load("ajax_loader");
		$("#content-rencana").load("ajax_rencana_belajar_awal");
	});
	
	$(".btn-mapel").click(function() {
		$("#daftar-bab").load("ajax_loader");
		$("#daftar-bab").load("ajax_bab_tersimpan_by_mapel/" + $(this).attr('id'));
	});
});
</script>
<?php
$overalpersen = ($pencapaian / $jumlahkonten)*100;
$overalpersen = number_format($overalpersen, 0, ",", "");
?>
<div class="col-sm-12">
	<div class="tombol-atas">
		<div role="button" class="tombol-kembali" id="kembalirencanabelajar">
		<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Mata Pelajaran
		</div>
		<div class="title-rencana-mapel">
		<?php echo $infomapel->nama_mapel;?>
		</div>
	</div>
	<div class="progress progress-overall">
	  <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $overalpersen;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $overalpersen;?>%;">
		<?php echo $overalpersen;?>% Selesai
	  </div>
	</div>
	<div class="panel panel-default">
		<div class="panel-body" style="background-color: #ffd1d1;">
			<?php
				foreach($datamapok as $mapok){
					?>
					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="heading<?php echo $mapok->id_materi_pokok;?>" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $mapok->id_materi_pokok;?>">
						  <div class="row">
						  <div class="col-sm-8">
						  <h4 class="panel-title">
							<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $mapok->id_materi_pokok;?>" aria-expanded="false" aria-controls="collapseTwo">
							  <?php echo $mapok->nama_materi_pokok;?>
							</a>
						  </h4>
						  </div>
						  <div class="col-sm-4">
							<?php
								$jumlahkonten = $this->model_rencana_belajar->get_jumlah_konten($mapok->id_materi_pokok);
								
								$jumlahselesai = $this->model_rencana_belajar->get_jumlah_belajar_selesai($this->session->userdata("id_ortu_siswa"), $mapok->id_materi_pokok);
								
								$persen = number_format(($jumlahselesai / $jumlahkonten) * 100, '0', ',', '');
							?>
							<div class="progress progress-mapok">
							  <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $persen;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persen;?>%;">
								<?php echo $persen;?>% Selesai
							  </div>
							</div>
						  </div>
						  </div>
						</div>
						<div id="collapse<?php echo $mapok->id_materi_pokok;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $mapok->id_materi_pokok;?>">
						  <div class="panel-body">
							<?php
								$carisubmateri = $this->model_rencana_belajar->fetch_sub_by_materi_pokok($mapok->id_materi_pokok);
								
								foreach($carisubmateri as $sub){
									//cari apakah sudah pernah di akses
									if($sub->kategori == 1 or $sub->kategori == 2){
										$cari = $this->model_rencana_belajar->get_pencapaian($this->session->userdata("id_ortu_siswa"), $sub->id_sub_materi);
									}else{
										$cari = $this->model_rencana_belajar->get_pencapaian($this->session->userdata("id_ortu_siswa"), $sub->id_sub_materi);
									}
									if($cari == 1){
										?>
										<div class="alert alert-success btn-mulai-belajar" role="alert">
										<div class="row">
											<div class="col-sm-6 judul-sub">
											<?php
											if($sub->kategori == 1){
												?>
												<span class="icon-teks"></span>
												<?php
											}elseif($sub->kategori == 2){
												?>
												<span class="icon-video"></span>
												<?php
											}elseif($sub->kategori == 3){
												?>
												<span class="icon-tes"></span>
												<?php
											}
											?>			 
											<?php echo $sub->nama_sub_materi;?></div>
											<div class="col-sm-6 status-belajar">
												<?php
												if($sub->kategori == 3){
													//cari apakah sudah mengerjakan tes
													$caristatus = $this->model_pg->get_status_latihan_siswa($this->session->userdata("id_ortu_siswa"), $sub->id_sub_materi);
													if($caristatus > 0){
														$jumlahbobot 	= $this->model_pg->fetch_jumlah_bobot($sub->id_sub_materi);
														$bobotsiswa		= $this->model_pg->fetch_bobot_siswa($sub->id_sub_materi, $this->session->userdata("id_ortu_siswa"));
														$nilaisiswa		= number_format(($bobotsiswa->bobot_siswa / $jumlahbobot->jumlah_bobot) * 100, 2, '.', ',');
														
														echo "<h3>".$nilaisiswa." <span class='glyphicon glyphicon-ok' aria-hidden='true'></span></h3>";
													}else{
														echo "<h3><h3><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></h3></h3>";
													}
												}else{
													echo "<h3><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></h3>";
												}
												?>
											</div>
										</div>
										</div>
										<?php
									}else{
										?>
										<div class="alert alert-danger btn-mulai-belajar" role="alert">
										<div class="row">
											<div class="col-sm-6 judul-sub">
												<?php
												if($sub->kategori == 1){
													?>
													<span class="icon-teks"></span>
													<?php
												}elseif($sub->kategori == 2){
													?>
													<span class="icon-video"></span>
													<?php
												}elseif($sub->kategori == 3){
													?>
													<span class="icon-tes"></span>
													<?php
												}
												?>			 
												<?php echo $sub->nama_sub_materi;?>
											</div>
											<div class="col-sm-6 status-belajar">
												<?php
												if($sub->kategori == 3){
													//cari apakah sudah mengerjakan tes
													$caristatus = $this->model_pg->get_status_latihan_siswa($this->session->userdata("id_ortu_siswa"), $sub->id_sub_materi);
													if($caristatus > 0){
														$jumlahbobot 	= $this->model_pg->fetch_jumlah_bobot($sub->id_sub_materi);
														$bobotsiswa		= $this->model_pg->fetch_bobot_siswa($sub->id_sub_materi, $this->session->userdata("id_ortu_siswa"));
														$nilaisiswa		= number_format(($bobotsiswa->bobot_siswa / $jumlahbobot->jumlah_bobot) * 100, 2, '.', ',');
														
														echo "<h3>".$nilaisiswa." <span class='glyphicon glyphicon-menu-right' aria-hidden='true'></span></h3>";
													}else{
														echo "<h3><span class='glyphicon glyphicon-menu-right' aria-hidden='true'></span></h3>";
													}
												}else{
													echo "<h3><span class='glyphicon glyphicon-menu-right' aria-hidden='true'></span></h3>";
												}
												?>
											</div>
										</div>
										</div>
										<?php
									}
									?>
									<?php
								}
							?>
						  </div>
						</div>
					</div>
				</div>
					<?php
				}
			?>
		</div>
	</div>
</div>

<!--
<div class="col-sm-4">
<div class="panel panel-default" style="background-color: #88b0ef; height: 55vh; overflow-y: auto;">
  <div class="panel-body">
	<div class="list-group">
		<?php
		foreach($datamapel as $mapel){
			?>
				<button type="button" class="list-group-item btn-mapel" id="<?php echo $mapel->id_mapel;?>"><?php echo $mapel->nama_mapel;?></button>
			<?php
		}
		?>
	</div>
  </div>
</div>
</div>
<div class="col-sm-8">
<div class="panel panel-default" style="background-color: #88b0ef; height: 55vh; overflow-y: auto;">
  <div class="panel-body" id="daftar-bab">
<?php
	foreach($datamapok as $mapok){
		?>
		<div class="alert alert-info" role="alert">
		<div class="row">
			<div class="col-sm-6">
			<?php echo $mapok->nama_materi_pokok;?>
			</div>
		
			<div class="col-sm-6">
				<div class="progress">
				  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
					60%
				  </div>
				</div>
				<a href="../materi/tabel_konten_detail/<?php echo $mapok->id_materi_pokok;?>" class="btn btn-success" style="width: 100%;">Mulai Belajar</a>
			</div>
		</div>
		</div>
		<?php
	}
?>
</div>
</div>
</div>
-->