<?php
include('header_dashboard.php');
$idsiswa = $this->session->userdata('id_siswa');
foreach ($kelasaktif as $kelas) {
    foreach ($data_profil as $profil) {
        if ($profil->id_kelas == $kelas->id_kelas and $profil->status == 1) {
            $id_tryout = $profil->id_tryout;
//            $status_modal_cbt = '1';
//        } else if ($profil->id_kelas == $kelas->id_kelas and $profil->status == 2) {
//            $status_modal_cbt = '2';
            $cek_status_pembayaran = $this->model_dashboard->cek_status_pembayaran($idsiswa, $id_tryout);
            if ($cek_status_pembayaran == '1') {
                $status_modal_cbt = '1';
            } else if ($cek_status_pembayaran == '2') {
                $status_modal_cbt = '2';
            } else if ($cek_status_pembayaran == 0) {
                $status_modal_cbt = '0';
            } else {
                $status_modal_cbt = '4';
            }
        }
    }
}
?>
<style>
	.no-js #loader { display: none;  }
	.js #loader { display: block; position: absolute; left: 100px; top: 0; }
	.se-pre-con {
		width: 97%;
		display: none;
		height: 100%;
		position: absolute;
		z-index: 9999;
		background: url('<?php echo base_url('assets/img/ajax-loading.gif') ?>') center no-repeat #ebeaea;
		transition: .5s;
	}
</style>
<script>
$(document).ready(function(){
    $(document).ajaxStart(function(){
        $(".se-pre-con").css("display", "block");
    });
    $(document).ajaxComplete(function(){
        $(".se-pre-con").css("display", "none");
    });
});
</script>
<script>
$(function(){
	$("#kelas").change(function(){
		$("#profil").load("profil/" + $("#kelas").val());
	});
	$("#profil").change(function(){
		$("#tryout").load("tryout/" + $("#profil").val());
	});
	$("#pilihkelas").change(function(){
		$("#pilihmapel").load("pilihmapel/" + $("#pilihkelas").val());
	});
	$("#pilihmapel").change(function(){
		$("#materi").load("materi/" + $("#pilihmapel").val());
	});
	
	$("#dropkelas li").click(function() {
		$("#dropmapel").load("pilihmapel/" + $(this).attr('id'));
	});
	
	$("#dropkelastryout li").click(function() {
		$("#dropprofil").load("profil/" + $(this).attr('id'));
	});

	$('#cari').keypress(function (e) {
	  if (e.which == 13) {
		$("#materi").load("carimateri/" + encodeURIComponent($(this).val()));
	  }
	});
	$("#pilihprovinsi").change(function(){
		$("#pilihkota").load("../signup/kota/" + $("#pilihprovinsi").val());
	});
	
	$("#pilihkota").change(function(){
		$("#btnTambahSekolah").prop('disabled', false);
		$("#pilihsekolah").load("../signup/sekolah/" + $("#pilihkota").val());
	});
	
	$("#pilihsekolah").change(function(){
		$("#kelassekolah").load("kelasbysekolah/" + $("#pilihsekolah").val());
	});
	$("#jenjangbaru").change(function(){
		$("#kelassekolah").load("kelasbyjenjang/" + $("#jenjangbaru").val());
	});
	
	$(".btn-kelas").click(function() {
		$("#materi").html("<img src='<?php echo base_url('assets/pg_user/images/gears.gif');?>' style='margin: 0 auto; width: 75px;' />"); 
		$("#materi").load("lihatmapel/" + $(this).attr('id'));
	});
	
	$("#btn-tambah-rencana").click(function() {
		$("#content-rencana").load("ajax_tambah_materi");
	});
	
	$(".btn-pilihmateri").click(function() {
		$("#content-rencana").load("ajax_materi_tersimpan_by_mapel/" + $(this).attr('id'));
	});
});
</script>
<script>
  function supports_media_source()
  {
      "use strict";
      var hasWebKit = (window.WebKitMediaSource !== null && window.WebKitMediaSource !== undefined),
          hasMediaSource = (window.MediaSource !== null && window.MediaSource !== undefined);
      return (hasWebKit || hasMediaSource);
  }
</script>


    <div class="container-fluid akun-container">
	<div class="col-lg-12">
	    <?php
			$sisa = $sisaaktivasi->format('%a');
			if($sisa <= 10){
				
				?>
				<div class="alert alert-danger alert-dismissible" role="alert">
					Masa aktif paket anda tersisa <strong><?php echo $sisa;?> hari </strong> lagi, silahkan melakukan pembelian/aktivasi paket untuk memperpanjang akses Prime Mobile
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php
			}
		?>
		<div class="agcu-welcome">
			<p class="text-center">"<?php echo $quote->quote?>"</p>
			<p class="text-center"><i>-<?php echo $quote->tokoh?></i></p>
		</div>
		<br>
		
	  <div class="agcu-welcome">
        <div class="content" id="mulai-agcu">
          <h4>Selamat Datang, <?php echo $infosiswa->nama_siswa; ?></h4>
          <p>Ketahui tipe kepribadian, kondisi psikologis, potensi akademik dan minat belajar anda dengan mengikuti Academic General Check Up (AGCU) Test. Dengan mengikuti AGCU test, anda akan mendapatkan saran metode belajar yang sesuai dengan tipe kepribadian yang anda miliki. </p>
          <?php
			if($status_siswa == "tidak_aktif"){
		  ?>
			<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#aktivasiagcu">
			  Mulai AGCU
			</button>
		  <?php
			}else{
		  ?>
			<a href="../agcutest" class="btn btn-primary">Mulai AGCU</a>
		  <?php
			}
		  ?>
        </div>
        <img class="image" src="<?php echo base_url('assets/dashboard/images/why2.jpg'); ?>" style="float: right;">
      </div>
	  <p>&nbsp;
	  
	  <!--
	<div class="profile-option">
        <div class="input-group search">
          <span class="input-group-addon"><span class="glyphicon glyphicon-search search"></span></span>
          <input type="text" class="form-control" placeholder="Cari Materi..." id="cari">
        </div>
        <ul class="options nav navbar-nav">
          <li class="dropdown kelas-option"><a href="#" class="dropdown-toggle" data-toggle="dropdown">PILIH KELAS<span class="glyphicon glyphicon-chevron-down"></span></a>
            <ul class="dropdown-menu" id="dropkelas">
				<?php
					foreach($kelasaktif as $kelas){
				?>
					<li id='<?php echo $kelas->id_kelas; ?>'><a href="#dropkelas"><?php echo $kelas->alias_kelas; ?></a></li>
				<?php
					}
				  ?>
            </ul>
          </li>
		  <li class="dropdown mapel-option"><a href="#" class="dropdown-toggle" data-toggle="dropdown">PILIH MATA PELAJARAN<span class="glyphicon glyphicon-chevron-down"></span></a>
            <ul class="dropdown-menu" id="dropmapel">
                   <li class='pilih' id="hehehe"><a href='#dropmapel'>coba klik disini<span class='circle' style='background-color:#e6353c;'></span></a></li> 
            </ul>
          </li>
        </ul>
      </div>
	 -->

	 <!-- eksperimen awal rencana belajar -->
	 <div class="content">
		<div class="tabel-analisa waktu" style="overflow: hidden;">
			<div class="title"><img src="<?php echo base_url('assets/dashboard/images/file.png'); ?>">Materi Prime Mobile</div>
		</div>
	</div>	
	<div class="row">
		<div class="col-lg-12" id="content-rencana">
			<div class="se-pre-con"></div>
			<button class="btn btn-primary" id="btn-tambah-rencana"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Tambah Rencana Belajar</button>
			<p>&nbsp;
			<?php
			if($materibelajar == null and $materibelajarsaintek == null and $materibelajarsoshum == null){
				?>
				<img src="<?php echo base_url("assets/pg_user/images/think.png");?>" class="img-tambah-materi center-block">
				<br>Anda belum menyusun rencana belajar untuk mata pelajaran ini. Susun rencana belajar anda di tombol "Tambah Rencana Belajar" di atas
				<?php
			}elseif($materibelajar !== null or $materibelajarsaintek !== null or $materibelajarsoshum !== null){
				foreach($mapeltersimpan as $mapel){
				?>
				<div class='mapel-container'>
					<div class='content'>
							<h4><?php echo $mapel->nama_mapel ;?></h4>
						<button class='btn btn-danger btn-pilihmateri' style='float: right; margin: 15px 0;' id='<?php echo $mapel->id_mapel;?>'>Lihat Materi</button>
					</div>
				</div>
				<?php
				}
			}
			?>
			
		</div>
	</div>
	<!-- end eksperimen -->
	
	<!--
	 <div class="content">
		<div class="tabel-analisa waktu" style="overflow: hidden;">
			<div class="title"><img src="<?php echo base_url('assets/dashboard/images/file.png'); ?>">Materi Prime Mobile</div>
		</div>
	</div>
			<div class="row">
			<div clas="col-lg-12" id="materi">
				<?php
					foreach($kelasaktif as $kelas){
				?>
					<div class="mapel-container">
						<div class="content">
							<h4><?php echo $kelas->alias_kelas;?></h4>
							<button class="btn btn-danger btn-kelas" type="submit" style="float: right; margin: 15px 0;" id="<?php echo $kelas->id_kelas;?>">Lihat Mata Pelajaran</button>
						</div>
					</div>
				<?php
					}
				  ?>
			</div>
			</div>
		-->
		<!-- SPACE UNTUK MEMUNCULKAN PR -->
		<!-- ########################## -->
		<!-- ########################## -->
		<?php
		if($tahunajaran !== null){
			if($datapr !== null){
			?>
				<div class="content">
					<div class="tabel-analisa waktu">
						<div class="title"><img src="<?php echo base_url('assets/dashboard/images/file.png'); ?>">Pekerjaan Rumah</div>
					</div>
				</div>
				<div class="row">
				<div class="col-lg-12">
			<?php
				foreach($datapr as $pr){
					?>
						<div class="mapel-container">
							<div class="content">
								<h4><?php echo $pr->nama_pr;?></h4>
								<table class="table table-striped">
									<tbody>
										<tr>
											<td>Jumlah Soal</td>
											<td>:</td>
											<td>
											<?php
												$jumlahsoal = $this->model_pr->jumlah_soal($pr->id_pr);
												echo $jumlahsoal;
											?>
											</td>
										</tr>
										<tr>
											<td>Batas Submit</td>
											<td>:</td>
											<td><?php echo $pr->deadline;?></td>
										</tr>
									</tbody>
								</table>
								<?php
									$tanggalsekarang = date('Y-m-d');
									$caristatuspr = $this->model_pr->fetch_status_pr($pr->id_pr, $this->session->userdata('id_siswa'));
									if($pr->deadline >= $tanggalsekarang){
										if($caristatuspr == null){
											if($pr->tipe == 1){
												?>
												<a class="btn btn-primary btn-kelas" style="float: right; margin: 15px 0;" href="<?php echo  base_url("pr/mulai/".$pr->id_pr);?>">Kerjakan PR</a>
												<?php
											}elseif($pr->tipe == 2){
												?>
												<a class="btn btn-primary btn-kelas" style="float: right; margin: 15px 0;" href="<?php echo  base_url("pr/mulai_eksak/".$pr->id_pr);?>">Kerjakan PR</a>
												<?php
											}elseif($pr->tipe == 3){
												?>
												<a class="btn btn-primary btn-kelas" style="float: right; margin: 15px 0;" href="<?php echo  base_url("pr/mulai_essai/".$pr->id_pr);?>">Kerjakan PR</a>
												<?php
											}
										}else{
											if($caristatuspr->status == 0){
												if($pr->tipe == 1){
												?>
												<a class="btn btn-primary btn-kelas" style="float: right; margin: 15px 0;" href="<?php echo  base_url("pr/mulai/".$pr->id_pr);?>">Lanjutkan PR</a>
												<?php
											}elseif($pr->tipe == 2){
												?>
												<a class="btn btn-primary btn-kelas" style="float: right; margin: 15px 0;" href="<?php echo  base_url("pr/mulai_eksak/".$pr->id_pr);?>">Lanjutkan PR</a>
												<?php
											}elseif($pr->tipe == 3){
												?>
												<a class="btn btn-primary btn-kelas" style="float: right; margin: 15px 0;" href="<?php echo  base_url("pr/mulai_essai/".$pr->id_pr);?>">Lanjutkan PR</a>
												<?php
											}
											}else{
												if($pr->tipe == 1){
													?>
													<a class="btn btn-success btn-kelas" style="float: right; margin: 15px 0;" href="<?php echo  base_url("pr/statistik/".$pr->id_pr);?>">Lihat Penilaian</a>
													<?php
												}elseif($pr->tipe == 2){
													?>
													<a class="btn btn-success btn-kelas" style="float: right; margin: 15px 0;" href="<?php echo  base_url("pr/statistik_eksak/".$pr->id_pr);?>">Lihat Penilaian</a>
													<?php
												}
											}
										}
									}elseif($pr->deadline < $tanggalsekarang and $caristatuspr !== null and $caristatuspr->status == 1){
										if($pr->tipe == 1){
											?>
											<a class="btn btn-success btn-kelas" style="float: right; margin: 15px 0;" href="<?php echo  base_url("pr/statistik/".$pr->id_pr);?>">Lihat Penilaian</a>
											<?php
										}elseif($pr->tipe == 2){
											?>
											<a class="btn btn-success btn-kelas" style="float: right; margin: 15px 0;" href="<?php echo  base_url("pr/statistik_eksak/".$pr->id_pr);?>">Lihat Penilaian</a>
											<?php
										}
									}
								?>
							</div>
						</div>
					<?php
				}
				?>
				</div>
				<div class="col-md-12" style="text-align: right;">
					<a href="<?php echo base_url("pr");?>" class="btn btn-primary">Lihat Arsip PR</a>
					<p>&nbsp;
				</div>
				</div>
			<?php	
			}

		}
		?>
		<!-- ########################## -->
		<!-- ########################## -->
		<!-- END SPACE UNTUK MEMUNCULKAN PR -->
		
		
		<div class="tabel-analisa waktu">
			<div class="title"><img src="<?php echo base_url('assets/dashboard/images/first.png'); ?>">Prime Mobile CBT</div>
		</div>
		<div class="col-lg-12" id="daftar-cbt">
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
			
			<?php 
				if($tahunajaran !== null){
					$tasiswa = $tahunajaran->id_tahun_ajaran;
				}else{
					$tasiswa = null;
				}
				foreach($aktivasipsep as $psep){
					foreach($datacbtpsep as $cbt){
						if($cbt->id_tryout == $psep->id_profil and $psep->id_tahun_ajaran == $tasiswa){
			?>
			<div>
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
				}
			?>
		</div>
		

	<!--
	<div class="profile-option">
        <div class="input-group search">
          <span class="input-group-addon"><span class="glyphicon glyphicon-file search"></span></span>
          <span class="form-control" id="cari">CBT | <a href="liveskor">Lihat Peringkat CBT</a></span> 
        </div>
        <ul class="options nav navbar-nav">
          <li class="dropdown kelas-option"><a href="#" class="dropdown-toggle" data-toggle="dropdown">PILIH KELAS<span class="glyphicon glyphicon-chevron-down"></span></a>
            <ul class="dropdown-menu" id="dropkelastryout">
				<?php
					foreach($kelasaktif as $kelas){
				?>
					<li id='<?php echo $kelas->id_kelas; ?>'><a href="#dropkelas"><?php echo $kelas->alias_kelas; ?></a></li>
				<?php
					}
				  ?>
            </ul>
          </li>
		  <li class="dropdown mapel-option"><a href="#" class="dropdown-toggle" data-toggle="dropdown">PILIH PROFIL CBT<span class="glyphicon glyphicon-chevron-down"></span></a>
            <ul class="dropdown-menu" id="dropprofil">
                   
            </ul>
          </li>
        </ul>
      </div>
	  -->

      <form action="statistiknilai" method="get">
	<div class="col-lg-12">
		<?php echo $this->session->flashdata('alert'); ?>
      <input type="hidden" id="profilterpilih" name="profil" required/>
	  <input class="btn btn-danger" id="submitstatistik" type="submit" value="Lihat Statistik" style="float: right; display: none;" />
	 </div>
	 </form>
	  <div class="col-lg-12"><p>&nbsp;</p></div>
	  <div class="clearfix"></div>
	

   <!-- mulai sini -->
<!-- untuk snmptn dihapus di pindah ke snmptn.php --.
<!-- akhiri sini -->


	
	
     <div class="akun-slider">
      <div class="content">
        <h5>Ir.H.Heppy Trenggono, M.Kom</h5>
        <p>Orang tua, seperti apapun keadaan mereka, tetap saja merupakan kunci sukses yang paling menentukan</p>
        <a href="">SELENGKAPNYA <span class="glyphicon glyphicon-chevron-right"></span></a>
      </div>
      <img class="slider" src="<?php echo base_url('assets/dashboard/images/slide.jpg');?>">
     </div> 

     <div class="akun-video">
      <h5>BONUS VIDEO MOTIVASI & INSPIRASI</h5>
      <div class="video-wrapper">
         <?php 
        $no = 1;
        foreach ($data_video_motivasi as $video) 
        { 
          $unlocked = in_array($video->id_konten, $bonus_unlocked);
          $style = $unlocked ? "display:none;" : '';
          $url = $unlocked ? "data-target='#videoMotivasiModal' data-source='".$video->url."'" : "data-target='#unlockBonus_modal'";
          ?>
        <div class="video-container" style="height: 150px;">
          <div class="video">
            <div class="caption">
              <img class="lock" src="<?php echo base_url('assets/dashboard/images/lock.png');?>" style="<?php echo $style?>">
              <h6><span class="glyphicon glyphicon-play"></span>5:54</h6>
            </div>
            <?php if($video->gambar !== ""){
			?>
			<img src="<?php echo base_url('assets/uploads/bonus/'.$video->gambar);?>">
			<?php
			}else{
			?>
			<img src="<?php echo base_url('assets/dashboard/images/video1.jpg');?>">
			<?php
			}
			?>
          </div>
          <h6>
            <a href="#;" target="_BLANK" class="modal-video-motivasi" data-value="<?php echo $video->id_konten?>" data-toggle="modal" <?php echo $url?> >
              <?php echo $video->judul_konten?>
            </a>
          </h6>
        </div>
        <?php
        } ?>
      </div>
    </div>

    <div class="akun-video" style="height: 360px; overflow-y: auto;">
      <h5>BONUS KONTEN BELAJAR</h5>
      <div class="video-wrapper">
          <?php 
        $no = 1;
        foreach ($data_bonus as $bonus)
        { 
          $unlocked = in_array($bonus->id_konten, $bonus_unlocked);
          $style = $unlocked ? "display:none;" : '';
          $url = $unlocked ? $bonus->url : '#';
          $target = $unlocked ? '' : "data-target='#unlockBonus_modal'";
        ?>
        <div class="video-container" style="height: 150px;">
          <div class="video">
            <div class="caption">
              <img class="lock" src="<?php echo base_url('assets/dashboard/images/lock.png');?>" style="<?php echo $style?>">
              <h6 style="<?php echo $style?>">UNLOCK</h6>
            </div>
            <?php if($bonus->gambar !== ""){
			?>
			<img src="<?php echo base_url('assets/uploads/bonus/'.$bonus->gambar);?>">
			<?php
			}else{
			?>
			<img src="<?php echo base_url('assets/dashboard/images/konten1.jpg');?>">
			<?php
			}
			?>
          </div>
          <h6>
            <a href="<?php echo $url?>" target="_BLANK" data-value="<?php echo $bonus->id_konten?>" data-toggle="modal" <?php echo $target?> >
              <?php echo $bonus->judul_konten?>
            </a>
          </h6>
        </div>
        <?php
        } ?>  
      </div>
     </div>
    </div>
</div>

<div id="walkthrough-content" style="display: none;">
	<div id="walkthrough-1">
		<h1>Selamat Datang di Prime Mobile</h1>

		<p>Ikuti tour singkat ini untuk menjelajahi fitur-fitur dan cara penggunaan Prime Mobile
	</div>
	<div id="walkthrough-2">
		<h1>Atur Rencana Belajarmu</h1>
		<p>Pilih berbagai materi yang ada di Prime Mobile, sesuaikan dengan kebutuhan belajarmu sendiri
	</div>
	<div id="walkthrough-3">
		<h1>Ketahui Karakter Psikologi dan Gaya Belajarmu</h1>
		<p>Dengan mengikuti tes Academic General Check Up (AGCU)
	</div>
	<div id="walkthrough-4">
		<h1>Asah Kemampuanmu, Ikuti CBT</h1>
		<p>Event CBT akan muncul di sini, dijadwalkan mengikuti agenda pendidikan di Indonesia
	</div>
	<div id="walkthrough-5">
		<h1>Pengaturan Profil</h1>
		<p>Ubah profil, informasi aktivasi, dan pengaturan lainnya ada di sini
	</div>
</div>

<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-walkthrough" style="display: none;">
  Launch demo modal
</button>
<!-- Modal -->
<div class="modal fade" id="modal-walkthrough" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        Tampilkan lagi tutorial ketika login?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Ya</button>
        <button type="button" id="no-walkthrough" class="btn btn-danger" data-dismiss="modal">Tidak, jangan tampilkan lagi</button>
      </div>
    </div>
  </div>
</div>
<?php include('modal_unlock_bonus.php');?>
  <?php include('modal_video_motivasi.php');?>
<?php include('footer.php'); ?>

   <script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>
  
  <script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>"></script>
  <script src="<?php echo base_url('assets/dashboard/js/init.js');?>"></script>
  <!-- DEPEENDENSI UNTUK WALKTHROUGH -->
<!-- ############################# -->
<!-- ############################# -->
 <!-- CSS -->
<link type="text/css" rel="stylesheet" href="<?php echo base_url("assets/pg_user/js/page-walkthrough");?>/css/jquery.pagewalkthrough.css" />
<!-- Page walkthrough plugin -->
<script type="text/javascript" src="<?php echo base_url("assets/pg_user/js/page-walkthrough");?>/jquery.pagewalkthrough.js"></script>

<?php if($this->session->flashdata("walkthrough") !== null and $this->session->flashdata("walkthrough") == 0){
?>
<script>
$(document).ready(function(){
	// Set up tour
	panjang_layar = $(window).width(); 
	console.log(panjang_layar);
	if(panjang_layar <= 768 ){
		console.log("kecil");
	}else{
		$('body').pagewalkthrough({
			name: 'introduction',
			steps: [{
			   popup: {
				   content: '#walkthrough-1',
				   type: 'modal'
			   }
			},{
				wrapper: '#mulai-agcu',
				popup: {
					content: '#walkthrough-3',
					type: 'tooltip',
					position: 'right'
					//contentRotation: 90
				}
			},{
				wrapper: 'button[id="tambah-materi"]',
				popup: {
					content: '#walkthrough-2',
					type: 'tooltip',
					position: 'top'
					//contentRotation: 90
				}
			},{
				wrapper: '#menu-profil',
				popup: {
					content: '#walkthrough-5',
					type: 'tooltip',
					position: 'left'
					//contentRotation: 90
				}
			},{
				wrapper: '#daftar-cbt',
				popup: {
					content: '#walkthrough-4',
					type: 'tooltip',
					position: 'top'
					//contentRotation: 90
				}
			}]
		});
		// Show the tour
		$('body').pagewalkthrough('show');
	}
	
	$("#no-walkthrough").click(function(){
		$.ajax({
			type: 'POST',
			url: 'no_walkthrough',
			data:{
				'idsiswa' : <?php echo $this->session->userdata('id_siswa');?>
			},
			success: function(result){
				console.log(result);
			}
		});
	});

})
</script>
<?php
}?>
<!-- DEPEENDENSI UNTUK WALKTHROUGH -->
<!-- ############################# -->
<!-- ############################# -->
  <!-- JS Function for this Modal -->
  <script type="text/javascript">
    $('#unlockBonus_modal').on('show.bs.modal', function (event) {
      var toggle = $(event.relatedTarget) // toggle that triggered the modal
      var judulBonus = toggle.text() // Extract info from data-* attributes
      var id_bonus = toggle.data('value')
      var modal = $(this)
      modal.find('.judul_bonus').text(judulBonus)
      modal.find('input[name=hidden_row_id]').val(id_bonus)
    })
  </script>

  <script type="text/javascript">
  $(document).ready(function() {
    var form = $('#unlockBonus_form');  
    console.log(form.attr('action'));
    form.submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: form.attr('action'),
        type: 'POST',
        dataType: 'json',
        data: { 
          id_bonus: $('#hidden_row_id').val()  
        },
        success: function(response){
          $("#poinSiswa").html(response.poin);
          if(response.result != 0) {
            // fetch_select_kategori();
            // $("#tambah_kategori").val('');
            // $("#alertDangerUnlockBonus").slideUp();
            // $("#alertSuccessUnlockBonus").slideDown().delay(5000).slideUp();
            setTimeout(function() { 
              location.reload(); 
            }, 0);
          } 
          else {
            $("#alertSuccessUnlockBonus").slideUp();
            $("#msgDangerUnlockBonus").text(response.msg);
            $("#alertDangerUnlockBonus").slideDown().delay(5000).slideUp();
          }
        }
      })
    });
	$('#modalpengumuman').modal('show');
	<?php
	foreach($kelasaktif as $kelas){
		foreach($data_profil as $profil){
			if($profil->id_kelas == $kelas->id_kelas and $profil->status == 1){
	?>
	$('#modalcbtcontest<?php echo $profil->id_tryout; ?>').modal('show');
	<?php
			}
		}
	}
	?>
  });
  </script>

  <script>
      if ( supports_media_source() ) {
        // supported.style.display="";
        videoObj.style.display="";
      }
      else {
        notsupported.style.display="";
      }
      var video;
      var player;
      var source; 
      var estimator;

      function connect(src = null)
      {
        if(connectObj.textContent == "Stop") 
        {
          dashStop();
          connectObj.textContent = "Start";
          statusStr.textContent = "Disconnected";
        }
        else 
        {
          
          connectObj.textContent = "Stop";
          statusStr.textContent = "Playing";
          
          if ( video == null )
          { video = document.querySelector("video"); }

          if ( player == null )
          { player = new shaka.player.Player(video); }

          // Attach the player to the window so that it can be easily debugged.
          window.player = player;

          // Listen for errors from the Player.
          player.addEventListener('error', failed );

          // Construct a DashVideoSource to represent the DASH manifest.
          //var mpdUrl = 'http://turtle-tube.appspot.com/t/t2/dash.mpd';
          if ( estimator != null ) { estimator=null; }
            estimator = new shaka.util.EWMABandwidthEstimator();

          if ( source != null )
          { source = null; }

          if (src !== null)
          {
            // source = new shaka.player.DashVideoSource("<?php //echo $data->video_materi ? $data->video_materi : '';?>", null, estimator);
            // source = new shaka.player.DashVideoSource("http://45.64.97.197:1935/TestVOD/mp4:soal16.mp4/manifest.mpd", null, estimator);
            source = new shaka.player.DashVideoSource(src, null, estimator);

            // Load the source into the Player.
            player.load(source);
          }
        }
      }

      function failed(e)
      {
        var done = false;
        if ( e.detail == 'Error: Network failure.' )
        {
          statusStr.textContent = 'Network Connection Failed.';
          done = true;
        }
        
        if ( e.detail.status!=200 && done == false )
        {
          switch ( e.detail.status )
          {
          case 404:
            statusStr.textContent = e.detail.url+' not found.';
          break;
          
          default:
            statusStr.textContent = 'Error '+e.detail.status+' for '+e.detail.url;
          break;
          }
        }
      }

      function dashStop()
      {
        if(player!=null)
        {
          console.log("player: " + player);
          player.unload();
        }
        connectObj.textContent = "Start";
        statusStr.textContent = "Disconnected";
      }

    </script>
    <!-- /NEEDED FOR SHAKA PLAYER -->

    <script type="text/javascript">
      function playVideo() {
          var video = $("#videoObj");
          // video.paused ? video.get(0).play() : video.get(0).pause();
          video.get(0).play();
          console.log("(onPlay) isPaused: " + video.get(0).paused)
      }        

      function pauseVideo() {
          var video = $("#videoObj");
          // video.paused ? video.get(0).play() : video.get(0).pause();
          video.get(0).pause();
          console.log("(onPause) isPaused: " + video.get(0).paused)
      }

      $("#videoMotivasiModal").on("shown.bs.modal", function(e){
        var video = $("#videoObj");
        console.log('$videoMotivasiModal shown');
        // if(video.get(0).paused == true){
          playVideo();
        // }
      })

      $("#videoMotivasiModal").on("hidden.bs.modal", function(e){
        var video = $("#videoObj");
        $('#konten_video_motivasi').html("");
        console.log('#videoMotivasiModal hidden');
        // if(video.get(0).paused == false){
          //pauseVideo();
        // }
      })        

      $(document).ready(function(){
        var video = $("#videoObj");
        var id = null;
        
        $(".modal-video-motivasi").on("click", function(e) 
        {
          if(id == null)
          { id = $(this).attr("id"); }

          var element = $(this);
          var src = element.data("source");
          
          //hentikan fungsi connect shaka player, ganti dengan jwplayer yang baru dengan ajax di bawahnya
		  /*
          if(source == null) {
            connect(src);
            console.log("(onClick) isPaused: " + video.get(0).paused);
          }
          else if(id !== $(this).attr('id')) {
            id = $(this).attr('id'); //update the id value
            dashStop();
            connect(src);
          } 
		  */
		  
		  $.post("<?php echo base_url("user/ajax_bonus_video");?>",{
			  sumber: src
		  }, function(data, status){
			  $('#konten_video_motivasi').html(data);
		  });
        })

        console.log("(onStart) isPaused: " + video.get(0).paused);    

      });
    </script>

  <script type="text/javascript" charset="utf-8">
    $(window).load(function(){
 
    });
  </script>
  
  <?php include('modal_aktivasi_agcu.php'); ?>
  <?php include('modal_profil.php'); ?>
  
  <?php
	foreach($kelasaktif as $kelas){
		foreach($data_profil as $profil){
			if($profil->id_kelas == $kelas->id_kelas and $profil->status == 1){
				?>
				  <div class="modal fade" id="modalcbtcontest<?php echo $profil->id_tryout; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog modal-dialog-contest" role="document">
						<div class="modal-content modal-content-contest">
						  <div class="modal-body body-modal-contest">
							<img src="<?php echo base_url('assets/uploads/banner/'.$profil->banner);?>" class="img img-responsive"/>
							<div class="row contest-desc">
								<div class="col-lg-3 col-md-3 col-sm-3" style="padding-top: 7px; padding-bottom: 7px;">
								Biaya : Rp. <?php echo $profil->biaya; ?>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4" style="padding-top: 7px; padding-bottom: 7px;">
								Tanggal Pelaksanaan : 
								<?php
								$originalDate = $profil->tgl_acara;
								$newDate = date("d M Y", strtotime($originalDate));
								echo $newDate;
								?>
								</div>
								<div class="col-lg-5 col-md-5 col-sm-5">
									<button class="btn btn-danger" style="float: right; margin-left: 20px;" data-dismiss="modal">
										Tutup
									</button>
                            <a href="../cbt/cbt_detail/<?php echo $profil->id_tryout; ?>" class="btn btn-primary" style="float: right;">
                                Informasi Lebih Lanjut
                            </a>
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
?>

  </body>
</html>
