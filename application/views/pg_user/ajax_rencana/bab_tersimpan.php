<?php
$overalpersen = ($pencapaian / $jumlahkonten)*100;
$overalpersen = number_format($overalpersen, 0, ",", "");
?>
<script>
$(function(){
	$("#kembalirencanabelajar").click(function() {
		$("#halamanrencana").load("../ajax_rencana/refresh_rencana");
	});
});
</script>
<div class="tombol-atas">
	<div role="button" class="tombol-kembali" id="kembalirencanabelajar">
	<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Kembali
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
<?php
foreach($materibelajar as $materi){
$carisubmateri = $this->model_rencana_belajar->fetch_sub_by_materi_pokok_and_kurikulum($materi->id_materi_pokok, $materi->rencana_kurikulum);

//cari pencapaian belajar masing2 sub-materi
$pencapaian = 0;
foreach($carisubmateri as $sub){
	$cekpencapaian = $this->model_rencana_belajar->cek_pencapaian($this->session->userdata("id_siswa"), $sub->id_sub_materi);
	if($cekpencapaian > 0){
		$pencapaian += 1;
	}
}
	?>
	<div class="col-sm-12 seleksi-saved-bab"  role="tab" id="heading<?php echo $materi->id_rencana_belajar;?>" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $materi->id_rencana_belajar;?>">
		<div class="col-sm-8">
			<strong>
			<?php
				if($materi->rencana_kurikulum == "K-13"){
					echo $materi->judul_bab_k13 . " (K13)";
				}elseif($materi->rencana_kurikulum == "KTSP"){
					echo $materi->judul_bab_ktsp . " (KTSP)";
				}else{
					echo $materi->judul_bab_k13 . " (KTSP & K13)";
				}
			?>
			</strong>
			<?php
				$jumlahkonten = $this->model_rencana_belajar->get_jumlah_konten_by_kurikulum($materi->id_materi_pokok, $materi->rencana_kurikulum);
				
				$jumlahselesai = $this->model_rencana_belajar->get_jumlah_belajar_selesai($this->session->userdata("id_siswa"), $materi->id_materi_pokok);
				
				if($pencapaian == "0"){
					$persen = 0;
				}else{
					$persen = number_format(($pencapaian / $jumlahkonten) * 100, '0', ',', '');
				}
			?>
			<div class="progress progress-mapok">
			  <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $persen;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persen;?>%;">
				<?php echo $persen;?>% Selesai
			  </div>
			</div>
		</div>
		<div class="col-sm-4 col-btn-mulai">
			<button class="btn btn-default">
				Lihat Materi <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			</button>
		</div>
	</div>
	<div class="col-sm-12" style="background-color: white;">
	<div id="collapse<?php echo $materi->id_rencana_belajar;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $materi->id_rencana_belajar;?>">
		<div class="panel-body">
			<?php
				//echo $materi->rencana_kurikulum;
				//$carisubmateri = $this->model_rencana_belajar->fetch_sub_by_materi_pokok_and_kurikulum($materi->id_materi_pokok, $materi->rencana_kurikulum);
				
				foreach($carisubmateri as $sub){
					//cari apakah sudah pernah di akses
					if($sub->kategori == 1 or $sub->kategori == 2){
						$cari = $this->model_rencana_belajar->get_pencapaian($this->session->userdata("id_siswa"), $sub->id_sub_materi);
					}else{
						$cari = $this->model_rencana_belajar->get_pencapaian($this->session->userdata("id_siswa"), $sub->id_sub_materi);
					}
					if($sub->kategori == 1){
						if($materi->rencana_kurikulum == "K-13" or $materi->rencana_kurikulum == "ktsp"){
							?>
							<a href="<?php echo base_url("materi/teks/" . $materi->rencana_kurikulum . "/" . $sub->id_konten);?>">
							<?php
						}else{
							?>
							<a href="<?php echo base_url("materi/teks/all/" . $sub->id_konten);?>">
							<?php
						}
					}elseif($sub->kategori == 2){
						if($materi->rencana_kurikulum == "K-13" or $materi->rencana_kurikulum == "ktsp"){
							?>
							<a href="<?php echo base_url("materi/video/" . $materi->rencana_kurikulum . "/" . $sub->id_konten);?>">
							<?php
						}else{
							?>
							<a href="<?php echo base_url("materi/video/all/" . $sub->id_konten);?>">
							<?php
						}
					}elseif($sub->kategori == 3){
						?>
						<a href="<?php echo base_url("latihan/index/" . $sub->id_sub_materi);?>">
						<?php
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
									$caristatus = $this->model_pg->get_status_latihan_siswa($this->session->userdata("id_siswa"), $sub->id_sub_materi);
									if($caristatus > 0){
										$carinilai = $this->model_pg->fetch_status_latihan($sub->id_sub_materi, $this->session->userdata("id_siswa"));
										if($carinilai->skor !== ""){
											$nilaisiswa = $carinilai->skor;
										}else{
											$jumlahbobot 	= $this->model_pg->fetch_jumlah_bobot($sub->id_sub_materi);
											$bobotsiswa		= $this->model_pg->fetch_bobot_siswa($sub->id_sub_materi, $this->session->userdata("id_siswa"));
											$nilaisiswa		= number_format(($bobotsiswa->bobot_siswa / $jumlahbobot->jumlah_bobot) * 100, 2, '.', ',');
										}
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
						</a>
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
									$caristatus = $this->model_pg->get_status_latihan_siswa($this->session->userdata("id_siswa"), $sub->id_sub_materi);
									if($caristatus > 0){
										$carinilai = $this->model_pg->fetch_status_latihan($sub->id_sub_materi, $this->session->userdata("id_siswa"));
										if($carinilai->skor !== ""){
											$nilaisiswa = $carinilai->skor;
										}else{
											$jumlahbobot 	= $this->model_pg->fetch_jumlah_bobot($sub->id_sub_materi);
											$bobotsiswa		= $this->model_pg->fetch_bobot_siswa($sub->id_sub_materi, $this->session->userdata("id_siswa"));
											$nilaisiswa		= number_format(($bobotsiswa->bobot_siswa / $jumlahbobot->jumlah_bobot) * 100, 2, '.', ',');
										}
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
						</a>
						<?php
					}
					?>
					<?php
				}
			?>
		</div>
	</div>
	</div>
	<?php
}
?>
