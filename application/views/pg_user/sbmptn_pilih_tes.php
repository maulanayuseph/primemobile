<?php
include('header_dashboard.php');
?>

<div class="container-fluid akun-container">
<div class="col-lg-12">	
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th></th>
				<th>Perguruan Tinggi Negeri</th>
				<th>Program Studi</th>
				<th>Kode</th>
				<th>Kel</th>
				<th>Wilayah</th>
				<th>Prov</th>
				<th>DT</th>
				<th>IK</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$x = 1;
				foreach($setprodi as $prodi){
					?>
					<tr>
						<td>Pilihan <?php echo $x;?></td>
						<td><?php echo $prodi->nama_ptn;?></td>
						<td><?php echo $prodi->nama_prodi;?></td>
						<td><?php echo $prodi->kode_prodi;?></td>
						<td><?php echo $prodi->kelompok;?></td>
						<td><?php echo $prodi->wilayah;?></td>
						<td><?php echo $prodi->nama_provinsi;?></td>
						<td><?php echo $prodi->dt_new;?></td>
						<td><?php echo $prodi->ik;?></td>
					</tr>
					<?php
					$x++;
				}
			?>
		</tbody>
	</table>
</div>
<div class="col-sm-6">
	<a href="<?php echo base_url("sbmptn/hasil/" . $paket->id_paket_sbmptn);?>" class="btn btn-danger">Lihat Hasil CBT</a>
</div>
<div class="col-sm-6" style="text-align: right;">
	* DT : Daya Tampung
	<br> * IK : Indeks Keketatan
</div>
<div class="row">
</div>
<div class="tabel-analisa waktu">
	<div class="title"><img src="<?php echo base_url('assets/dashboard/images/file.png'); ?>">TKPA (TEST KEMAMPUAN DAN POTENSI AKADEMIK)</div>
</div>
<h4>TPA (Test Potensi Akademik)</h4>
<div class="row">
	<?php
	if($testpa !== null){
	$caritryout = $this->model_dashboard->get_tryout_by_profil($testpa->id_tryout);
	$idsiswa = $this->session->userdata('id_siswa');
	foreach($caritryout as $tryout){
		?>
		<div class="mapel-container">
			<div class="header"><?php echo $tryout->jumlah_soal;?> Soal</div>
			<div class="content">
				<div class="title">
				<h3><?php echo $tryout->nama_kategori;?></h3>
				
				<?php
					$cariskor 		= $this->model_dashboard->cari_skor($tryout->id_kategori, $idsiswa);
					$cariskorsalah 	= $this->model_dashboard->cari_skor_salah($tryout->id_kategori, $idsiswa);
					$cariwaktu 		= $this->model_dashboard->cari_waktu($tryout->id_kategori, $idsiswa);
					
					$salah 		= $cariskorsalah * -1;
					$benar 		= ($cariskor * 4) + $salah;
					$total 		= $tryout->jumlah_soal * 4;
					
					$prosentase = round(($benar/$total) * 100, 2);
					
					if($cariskor > 0 and $cariwaktu > 0){
						
						echo "<h4>".$prosentase."% Tuntas</h4>
						<h6>".$cariskor."/".$tryout->jumlah_soal." Soal yang benar</h6>
						";
					}elseif($cariskor == 0 and $cariskorsalah == 0 and  $cariwaktu > 0 ){
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
				if((($cariskor > 0 or $cariskorsalah > 0) and $cariwaktu > 0) or ($cariskor == 0 and $cariskorsalah == 0 and  $cariwaktu > 0)){
				?>
					<div class="progress" style="height: 10px;">
					<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $prosentase;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prosentase;?>%;">
					<span class="sr-only"><?php echo $prosentase;?>% Complete</span>
					</div>
				</div>
				<a href="../openclass/<?php echo $tryout->id_kategori; ?>" class="btn btn-primary" style="float: right; margin: 15px 0;">Open Class</a>
				<a href="../pembahasan/<?php echo $tryout->id_kategori;?>" class="btn btn-success" type="submit" style="float: right; margin: 15px 15px;">Pembahasan</a>
				<?php
				}elseif(($cariskor > 0 or $cariskorsalah > 0) and $cariwaktu == 0){
				?>
					<div class="progress" style="height: 10px;">
						<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
						<span class="sr-only">0% Complete</span>
						</div>
					</div>
					<a href="../mulai/<?php echo $tryout->id_kategori;?>" class="btn btn-default btn-mapel" type="submit">Lanjut Mengerjakan</a>
				<?php
				}else{
				?>
				<div class="progress" style="height: 10px;">
					<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
					<span class="sr-only">0% Complete</span>
					</div>
				</div>
				
				<a href="../mulai/<?php echo $tryout->id_kategori;?>" class="btn btn-default btn-mapel" type="submit">Mulai</a>
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
<h4>TKDU (Test Kemampuan Dasar Umum)</h4>
<div class="row">
	<?php
	if($testkdu !== null){
	$caritryout = $this->model_dashboard->get_tryout_by_profil($testkdu->id_tryout);
	$idsiswa = $this->session->userdata('id_siswa');

	foreach($caritryout as $tryout){
		?>
		<div class="mapel-container">
			<div class="header"><?php echo $tryout->jumlah_soal;?> Soal</div>
			<div class="content">
				<div class="title">
				<h3><?php echo $tryout->nama_kategori;?></h3>
				
				<?php
					$cariskor 		= $this->model_dashboard->cari_skor($tryout->id_kategori, $idsiswa);
					$cariskorsalah 	= $this->model_dashboard->cari_skor_salah($tryout->id_kategori, $idsiswa);
					$cariwaktu 		= $this->model_dashboard->cari_waktu($tryout->id_kategori, $idsiswa);
					
					$salah 		= $cariskorsalah * -1;
					$benar 		= ($cariskor * 4) + $salah;
					$total 		= $tryout->jumlah_soal * 4;
					
					$prosentase = round(($benar/$total) * 100, 2);
					
					if($cariskor > 0 and $cariwaktu > 0){
						
						echo "<h4>".$prosentase."% Tuntas</h4>
						<h6>".$cariskor."/".$tryout->jumlah_soal." Soal yang benar</h6>
						";
					}elseif($cariskor == 0 and $cariskorsalah == 0 and  $cariwaktu > 0 ){
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
				if((($cariskor > 0 or $cariskorsalah > 0) and $cariwaktu > 0) or ($cariskor == 0 and $cariskorsalah == 0 and  $cariwaktu > 0)){
				?>
					<div class="progress" style="height: 10px;">
					<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $prosentase;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prosentase;?>%;">
					<span class="sr-only"><?php echo $prosentase;?>% Complete</span>
					</div>
				</div>
				<a href="../openclass/<?php echo $tryout->id_kategori; ?>" class="btn btn-primary" style="float: right; margin: 15px 0;">Open Class</a>
				<a href="../pembahasan/<?php echo $tryout->id_kategori;?>" class="btn btn-success" type="submit" style="float: right; margin: 15px 15px;">Pembahasan</a>
				<?php
				}elseif(($cariskor > 0 or $cariskorsalah > 0) and $cariwaktu == 0){
				?>
					<div class="progress" style="height: 10px;">
						<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
						<span class="sr-only">0% Complete</span>
						</div>
					</div>
					<a href="../mulai/<?php echo $tryout->id_kategori;?>" class="btn btn-default btn-mapel" type="submit">Lanjut Mengerjakan</a>
				<?php
				}else{
				?>
				<div class="progress" style="height: 10px;">
					<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
					<span class="sr-only">0% Complete</span>
					</div>
				</div>
				
				<a href="../mulai/<?php echo $tryout->id_kategori;?>" class="btn btn-default btn-mapel" type="submit">Mulai</a>
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
<div class="tabel-analisa waktu">
	<div class="title"><img src="<?php echo base_url('assets/dashboard/images/file.png'); ?>">TKD (TEST KEMAMPUAN DASAR)</div>
</div>
<?php
	if(($kelompok == "SAINTEK") or ($kelompok == "CAMPURAN")){
		?>
		<h4>TKD (Tes Kemampuan Dasar) SAINTEK</h4>
		<div class="row">
		<?php
		if($tessaintek !== null){
		$caritryout = $this->model_dashboard->get_tryout_by_profil($tessaintek->id_tryout);
		$idsiswa = $this->session->userdata('id_siswa');

		foreach($caritryout as $tryout){
			?>
			<div class="mapel-container">
				<div class="header"><?php echo $tryout->jumlah_soal;?> Soal</div>
				<div class="content">
					<div class="title">
					<h3><?php echo $tryout->nama_kategori;?></h3>
					
					<?php
						$cariskor 		= $this->model_dashboard->cari_skor($tryout->id_kategori, $idsiswa);
						$cariskorsalah 	= $this->model_dashboard->cari_skor_salah($tryout->id_kategori, $idsiswa);
						$cariwaktu 		= $this->model_dashboard->cari_waktu($tryout->id_kategori, $idsiswa);
						
						$salah 		= $cariskorsalah * -1;
						$benar 		= ($cariskor * 4) + $salah;
						$total 		= $tryout->jumlah_soal * 4;
						
						$prosentase = round(($benar/$total) * 100, 2);
						
						if($cariskor > 0 and $cariwaktu > 0){
							
							echo "<h4>".$prosentase."% Tuntas</h4>
							<h6>".$cariskor."/".$tryout->jumlah_soal." Soal yang benar</h6>
							";
						}elseif($cariskor == 0 and $cariskorsalah == 0 and  $cariwaktu > 0 ){
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
					if((($cariskor > 0 or $cariskorsalah > 0) and $cariwaktu > 0) or ($cariskor == 0 and $cariskorsalah == 0 and  $cariwaktu > 0)){
					?>
						<div class="progress" style="height: 10px;">
						<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $prosentase;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prosentase;?>%;">
						<span class="sr-only"><?php echo $prosentase;?>% Complete</span>
						</div>
					</div>
					<a href="../openclass/<?php echo $tryout->id_kategori; ?>" class="btn btn-primary" style="float: right; margin: 15px 0;">Open Class</a>
					<a href="../pembahasan/<?php echo $tryout->id_kategori;?>" class="btn btn-success" type="submit" style="float: right; margin: 15px 15px;">Pembahasan</a>
					<?php
					}elseif(($cariskor > 0 or $cariskorsalah > 0) and $cariwaktu == 0){
					?>
						<div class="progress" style="height: 10px;">
							<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
							<span class="sr-only">0% Complete</span>
							</div>
						</div>
						<a href="../mulai/<?php echo $tryout->id_kategori;?>" class="btn btn-default btn-mapel" type="submit">Lanjut Mengerjakan</a>
					<?php
					}else{
					?>
					<div class="progress" style="height: 10px;">
						<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
						<span class="sr-only">0% Complete</span>
						</div>
					</div>
					
					<a href="../mulai/<?php echo $tryout->id_kategori;?>" class="btn btn-default btn-mapel" type="submit">Mulai</a>
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
		<?php
	}
?>
<?php
	if(($kelompok == "SOSHUM") or ($kelompok == "CAMPURAN")){
		?>
		<div class="row">
		<h4>TKD (Tes Kemampuan Dasar) SOSHUM</h4>
		<?php
		if($tessoshum !== null){
		$caritryout = $this->model_dashboard->get_tryout_by_profil($tessoshum->id_tryout);
		$idsiswa = $this->session->userdata('id_siswa');

		foreach($caritryout as $tryout){
			?>
			<div class="mapel-container">
				<div class="header"><?php echo $tryout->jumlah_soal;?> Soal</div>
				<div class="content">
					<div class="title">
					<h3><?php echo $tryout->nama_kategori;?></h3>
					
					<?php
						$cariskor 		= $this->model_dashboard->cari_skor($tryout->id_kategori, $idsiswa);
						$cariskorsalah 	= $this->model_dashboard->cari_skor_salah($tryout->id_kategori, $idsiswa);
						$cariwaktu 		= $this->model_dashboard->cari_waktu($tryout->id_kategori, $idsiswa);
						
						$salah 		= $cariskorsalah * -1;
						$benar 		= ($cariskor * 4) + $salah;
						$total 		= $tryout->jumlah_soal * 4;
						
						$prosentase = round(($benar/$total) * 100, 2);
						if($cariskor > 0 and $cariwaktu > 0){
							
							echo "<h4>".$prosentase."% Tuntas</h4>
							<h6>".$cariskor."/".$tryout->jumlah_soal." Soal yang benar</h6>
							";
						}elseif($cariskor == 0 and $cariskorsalah == 0 and  $cariwaktu > 0 ){
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
					if((($cariskor > 0 or $cariskorsalah > 0) and $cariwaktu > 0) or ($cariskor == 0 and $cariskorsalah == 0 and  $cariwaktu > 0)){
					?>
						<div class="progress" style="height: 10px;">
						<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $prosentase;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prosentase;?>%;">
						<span class="sr-only"><?php echo $prosentase;?>% Complete</span>
						</div>
					</div>
					<a href="../openclass/<?php echo $tryout->id_kategori; ?>" class="btn btn-primary" style="float: right; margin: 15px 0;">Open Class</a>
					<a href="../pembahasan/<?php echo $tryout->id_kategori;?>" class="btn btn-success" type="submit" style="float: right; margin: 15px 15px;">Pembahasan</a>
					<?php
					}elseif(($cariskor > 0 or $cariskorsalah > 0) and $cariwaktu == 0){
					?>
						<div class="progress" style="height: 10px;">
							<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
							<span class="sr-only">0% Complete</span>
							</div>
						</div>
						<a href="../mulai/<?php echo $tryout->id_kategori;?>" class="btn btn-default btn-mapel" type="submit">Lanjut Mengerjakan</a>
					<?php
					}else{
					?>
					<div class="progress" style="height: 10px;">
						<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
						<span class="sr-only">0% Complete</span>
						</div>
					</div>
					
					<a href="../mulai/<?php echo $tryout->id_kategori;?>" class="btn btn-default btn-mapel" type="submit">Mulai</a>
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
		<?php
	}
?>
</div>

<?php include('footer.php'); ?>

   <script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>
  
  <script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>"></script>
  <script src="<?php echo base_url('assets/dashboard/js/init.js');?>"></script>
  
 

    

  <script type="text/javascript" charset="utf-8">
    $(window).load(function(){
 
    });
  </script>
  

  </body>
</html>
