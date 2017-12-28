<?php
include('header_dashboard.php');
?>
<div class="container-fluid akun-container">
<?php
include('sbmptn_hitung.php');
?>
<div class="col-sm-4">
	<table class="table table-striped">
		<tr>
			<td>KELOMPOK UJIAN</td>
			<td><?php echo $kelompok;?></td>
		</tr>
		<tr>
			<td>PANLOK</td>
			<td><?php echo $panlok->nama_panlok;?></td>
		</tr>
	</table>
</div>
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
					$nnprodi[$x] = $prodi->nn;
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
						<td><?php echo $prodi->ik;?> %</td>
					</tr>
					<?php
					$x++;
				}
				
				if(isset($nnprodi[2]) and isset($nnprodi[3])){
					if($nnprodi[1] < $nnprodi[2] or $nnprodi[1] < $nnprodi[3] or $nnprodi[2] < $nnprodi[3]){
						$aspekurutan = "Belum Rekomendasi";
					}else{
						$aspekurutan = "Rekomendasi";
					}
				}elseif(isset($nnprodi[2]) and !isset($nnprodi[3])){
					if($nnprodi[1] < $nnprodi[2]){
						$aspekurutan = "Belum Rekomendasi";
					}else{
						$aspekurutan = "Rekomendasi";
					}
				}elseif(!isset($nnprodi[2]) and !isset($nnprodi[3])){
					$aspekurutan = "Rekomendasi";
				}
			?>
		</tbody>
	</table>
</div>
<div class="col-sm-12" style="text-align: right;">
	* DT : Daya Tampung
	<br> * IK : Indeks Keketatan
</div>
<div class="row">
</div>
</div>

<div class="container-fluid stat-wrapper">
<div class="diagnistic-wrapper">
	<h1>Analisis Perolehan Nilai Akhir</h1>
	<!--
	<div class="alert alert-danger" role="alert">
		Rekomendasi sementara masih belum tersedia, nilai tes sedang kami proses. Anda akan mendapat pemberitahuan melalui SMS jika rekomendasi telah tersedia. Pastikan nomor Handphone anda aktif, atau edit nomor handphone melalui edit profil. Terima Kasih
	</div>
	-->
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th class="text-center">Keterangan</th>
				<th class="text-center">Status</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<strong>Regulasi pilihan PTN berdsasarkan wilayah pendaftaran</strong>
					<br>
					<ol>
					<li>Program Studi yang ada di PTN dibagi menjadi dua kelompok, yaitu kelompok Saintek&nbsp; dan kelompok Soshum.</li>
					<li>Peserta dapat memilih program studi sebanyak-banyaknya 3 (tiga) program studi dengan ketentuan sebagai berikut:
					<ol style="list-style-type:lower-alpha;">
						<li>Jika program studi yang dipilih semuanya dari kelompok Saintek, maka peserta mengikuti kelompok ujian Saintek.</li>
						<li>Jika program studi yang dipilih semuanya dari kelompok Soshum, maka peserta mengikuti kelompok ujian Soshum.</li>
						<li>Jika program studi yang dipilih terdiri dari kelompok Saintek dan Soshum, maka peserta mengikuti kelompok ujian Campuran.</li>
					</ol>
					</li>
					<li>Urutan dalam pemilihan program studi menyatakan prioritas pilihan.</li>
					<li>Peserta ujian yang hanya memilih 1 (satu) program studi dapat memilih program studi di PTN manapun.</li>
					<li>Peserta ujian yang memilih 2 (dua) atau 3 (tiga) program studi, salah satu program studi pilihannya harus di PTN yang berada dalam satu wilayah pendaftaran dengan tempat peserta mengikuti ujian. Pilihan Program Studi yang lain dapat di PTN yang berada di luar wilayah pendaftaran tempat peserta mengikuti ujian.</li>
				</ol>
				</td>
				<td>
					<span style='color: green;'><strong>REKOMENDASI</strong></span>
				</td>
			</tr>
			<tr>
				<td>
					<strong>Aspek Urutan Program Studi Pilihan</strong>
					<br>
					Urutan dalam pemilihan Program Studi menyatakan prioritas pilihan. Urutan alokasi dilakukan sesuai urutan Program Studi yang dipilih dan daya tampung Program Studi tersebut. setiap peserta akan dialokasikan pada program studi pilihan pertama. Jika gagal, maka peserta tersebut akan dialokasikan ada program studi pilihan kedua (jika mempunyai dua pilihan)
				</td>
				<td>
				<?php
					if($aspekurutan == "Rekomendasi"){
						?>
						<span style="color: green;"><strong><?php echo $aspekurutan;?></strong></span>
						<?php
					}else{
						?>
						<span style="color: red;"><strong><?php echo $aspekurutan;?></strong></span>
						<?php
					}
				?>
				</td>
			</tr>
			<tr>
				<td>
					<strong>Aspek Perolehan Nilai Mentah (NM) dan Nilai Siswa (NS)</strong>
					<br>
					Penilaian dilakukan berdasarkan skor mata uji yang telah ditransformasi menjadi skor terstandar. Pemeringkatan pesera untuk masing-masing kelompok mata ujian Saintek dan Soshum dilakukan dalam urutan yang menurun. Mulai dari peserta dengan nilai tertinggi sampai dengan peserta dengan nilai terendah
				</td>
				<td>
				</td>
			</tr>
		</tbody>
	</table>

	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th></th>
				<th>Perguruan Tinggi Negeri</th>
				<th>Program Studi</th>
				<th>NM</th>
				<th>NS</th>
				<th>NN</th>
				<th>Keterangan</th>
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
						<td><?php echo $NM[$prodi->id_set_prodi];?></td>
						<td><?php echo number_format($jumlahnceeb[$prodi->id_set_prodi], 2, ".","");?></td>
						<td><?php echo $prodi->nn;?></td>
						<td>
						<?php
						if($jumlahnceeb[$prodi->id_set_prodi] > $prodi->nn){
							echo "<span style='color: green;'><strong><strong>REKOMENDASI</strong></span>";
						}else{
							echo "<span style='color: red;'><strong>BELUM REKOMENDASI</strong></span>";
						}
						?>
						</td>
					</tr>
					<?php
					$x++;
					
					if($prodi->kelompok == "SAINTEK"){
						$nilaisaintek = $jumlahnceeb[$prodi->id_set_prodi];
					}else{
						$nilaisoshum = $jumlahnceeb[$prodi->id_set_prodi];
					}
				}
			?>
		</tbody>
	</table>
	* NM = Nilai Mentah
	<br>* NS = Nilai Siswa
	<br>* NN = Nilai Nasional
</div>
<div class="diagnistic-wrapper">
    <h1>TKPA (TES KEMAMPUAN DAN POTENSI AKADEMIK)</h1>
	
	<div class="col-sm-4">
		<canvas id="myChart" height="250px">
		</canvas>
	</div>
	<div class="col-sm-8">
		<h4>Tes Potensi Akademik (TPA)</h4>
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th></th>
					<th></th>
					<th>Jumlah Soal</th>
					<th>Benar</th>
					<th>Skor</th>
					<th>Ketercapaian</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if($testpa !== null){
				$caritryout = $this->model_sbmptn->get_tryout_by_profil2($testpa->id_tryout);
				$idsiswa = $this->session->userdata('id_siswa');
				
				foreach($caritryout as $tryout){
					
					$benar 			= $this->model_dashboard->cari_skor($tryout->id_kategori, $idsiswa);
					
					$cariskorsalah 	= $this->model_dashboard->cari_skor_salah($tryout->id_kategori, $idsiswa);
					
					$cariwaktu 		= $this->model_dashboard->cari_waktu($tryout->id_kategori, $idsiswa);
					
					$salah 				= $cariskorsalah * -1;
					$skor 				= ($benar * 4) + $salah;
					$total 				= $tryout->jumlah_soal * 4;
					$ketercapaian		= number_format(($skor/$total) * 100, 2, '.', '')
					?>
					<tr>
						<td></td>
						<td><?php echo $tryout->nama_kategori;?></td>
						<td><?php echo $tryout->jumlah_soal;?></td>
						<td><?php echo $benar ;?></td>
						<td><?php echo $skor ;?></td>
						<td><?php echo $ketercapaian ;?>%</td>
					</tr>
					<?php
				}
				}
				?>
			</tbody>
		</table>
		<h4>Tes Kemampuan Dasar Umum (TKDU)</h4>
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th></th>
					<th></th>
					<th>Jumlah Soal</th>
					<th>Benar</th>
					<th>Skor</th>
					<th>Ketercapaian</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if($testkdu !== null){
				$caritryout = $this->model_sbmptn->get_tryout_by_profil2($testkdu->id_tryout);
				$idsiswa = $this->session->userdata('id_siswa');
				
				foreach($caritryout as $tryout){
					
					$benar 			= $this->model_dashboard->cari_skor($tryout->id_kategori, $idsiswa);
					
					$cariskorsalah 	= $this->model_dashboard->cari_skor_salah($tryout->id_kategori, $idsiswa);
					
					$cariwaktu 		= $this->model_dashboard->cari_waktu($tryout->id_kategori, $idsiswa);
					
					$salah 				= $cariskorsalah * -1;
					$skor 				= ($benar * 4) + $salah;
					$total 				= $tryout->jumlah_soal * 4;
					$ketercapaian		= number_format(($skor/$total) * 100, 2, '.', '')
					?>
					<tr>
						<td></td>
						<td><?php echo $tryout->nama_kategori;?></td>
						<td><?php echo $tryout->jumlah_soal;?></td>
						<td><?php echo $benar ;?></td>
						<td><?php echo $skor ;?></td>
						<td><?php echo $ketercapaian ;?>%</td>
					</tr>
					<?php
				}
				}
				?>
			</tbody>
		</table>
	</div>
	</div>

<div class="diagnistic-wrapper">	
	<h1>TKD (TES KEMAMPUAN DASAR)</h1>
	
	<div class="col-sm-4">
		<?php
			if($kelompok == "SAINTEK" or $kelompok == "SOSHUM"){
				?>
				<canvas id="myChart2" height="250px" style="height: 250px;">
				</canvas>
				<?php
			}elseif($kelompok == "CAMPURAN"){
				?>
				<canvas id="myChart2" height="250px">
				</canvas>
				<canvas id="myChart3" height="250px">
				</canvas>
				<?php
			}
		?>
		
	</div>
	<div class="col-sm-8">
	<?php
		if(($kelompok == "SAINTEK") or ($kelompok == "CAMPURAN")){
		?>
		<h4>Tes Kemampuan Dasar Saintek (TKD SAINTEK)</h4>
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th></th>
					<th></th>
					<th>Jumlah Soal</th>
					<th>Benar</th>
					<th>Skor</th>
					<th>Ketercapaian</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if($tessaintek !== null){
				$caritryout = $this->model_sbmptn->get_tryout_by_profil2($tessaintek->id_tryout);
				$idsiswa = $this->session->userdata('id_siswa');
				
				foreach($caritryout as $tryout){
					
					$benar 			= $this->model_dashboard->cari_skor($tryout->id_kategori, $idsiswa);
					
					$cariskorsalah 	= $this->model_dashboard->cari_skor_salah($tryout->id_kategori, $idsiswa);
					
					$cariwaktu 		= $this->model_dashboard->cari_waktu($tryout->id_kategori, $idsiswa);
					
					$salah 				= $cariskorsalah * -1;
					$skor 				= ($benar * 4) + $salah;
					$total 				= $tryout->jumlah_soal * 4;
					$ketercapaian		= number_format(($skor/$total) * 100, 2, '.', '')
					?>
					<tr>
						<td></td>
						<td><?php echo $tryout->nama_kategori;?></td>
						<td><?php echo $tryout->jumlah_soal;?></td>
						<td><?php echo $benar ;?></td>
						<td><?php echo $skor ;?></td>
						<td><?php echo $ketercapaian ;?>%</td>
					</tr>
					<?php
				}
				}
				?>
			</tbody>
		</table>
		<?php
		}
	?>
	<?php
		if(($kelompok == "SOSHUM") or ($kelompok == "CAMPURAN")){
		?>
		<h4>Tes Kemampuan Dasar Saintek (TKD SOSHUM)</h4>
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th></th>
					<th></th>
					<th>Jumlah Soal</th>
					<th>Benar</th>
					<th>Skor</th>
					<th>Ketercapaian</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if($tessoshum !== null){
				$caritryout = $this->model_sbmptn->get_tryout_by_profil2($tessoshum->id_tryout);
				$idsiswa = $this->session->userdata('id_siswa');
				
				foreach($caritryout as $tryout){
					
					$benar 			= $this->model_dashboard->cari_skor($tryout->id_kategori, $idsiswa);
					
					$cariskorsalah 	= $this->model_dashboard->cari_skor_salah($tryout->id_kategori, $idsiswa);
					
					$cariwaktu 		= $this->model_dashboard->cari_waktu($tryout->id_kategori, $idsiswa);
					
					$salah 				= $cariskorsalah * -1;
					$skor 				= ($benar * 4) + $salah;
					$total 				= $tryout->jumlah_soal * 4;
					$ketercapaian		= number_format(($skor/$total) * 100, 2, '.', '')
					?>
					<tr>
						<td></td>
						<td><?php echo $tryout->nama_kategori;?></td>
						<td><?php echo $tryout->jumlah_soal;?></td>
						<td><?php echo $benar ;?></td>
						<td><?php echo $skor ;?></td>
						<td><?php echo $ketercapaian ;?>%</td>
					</tr>
					<?php
				}
				}
				?>
			</tbody>
		</table>
		<?php
		}
	?>
	</div>
	
	<div class="col-sm-12">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th rowspan="2">Materi Uji</th>
					<th colspan="3">Jumlah</th>
					<th rowspan="2">Nilai</th>
					<th rowspan="2">Prosentase</th>
					<th rowspan="2">Kategori Nilai</th>
				</tr>
				<tr>
					<th>B</th>
					<th>S</th>
					<th>K</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="7"><strong>TES KEMAMPUAN DAN POTENSI AKADEMIK (TKPA)</strong></td>
				</tr>
				<tr>
					<td colspan="7"><strong>A. TPA</strong></td>
				</tr>
				<?php
				if($testpa !== null){
				$caritryout = $this->model_sbmptn->get_tryout_by_profil2($testpa->id_tryout);
				$idsiswa = $this->session->userdata('id_siswa');
				
				foreach($caritryout as $tryout){
					
					$benar 			= $this->model_dashboard->cari_skor($tryout->id_kategori, $idsiswa);
					
					$cariskorsalah 	= $this->model_dashboard->cari_skor_salah($tryout->id_kategori, $idsiswa);
					
					$cariwaktu 		= $this->model_dashboard->cari_waktu($tryout->id_kategori, $idsiswa);
					
					$salah 				= $cariskorsalah * -1;
					$skor 				= ($benar * 4) + $salah;
					$total 				= $tryout->jumlah_soal * 4;
					$ketercapaian		= number_format(($skor/$total) * 100, 2, '.', '');
					$kosong				= $tryout->jumlah_soal - $benar - $cariskorsalah;
					
					$persen				= number_format(($skor/$total) * 100, 2, ',', '');
					if($persen <= 100 and $persen > 85){
						$capai = "Sangat Baik";
					}elseif($persen <= 85 and $persen > 70){
						$capai = "Baik";
					}elseif($persen <= 70 and $persen > 55){
						$capai = "Cukup";
					}elseif($persen <= 55 and $persen >= 0){
						$capai = "Kurang";
					}
					?>
					<tr>
						<td><?php echo $tryout->nama_kategori;?></td>
						<td><?php echo $benar;?></td>
						<td><?php echo $cariskorsalah ;?></td>
						<td><?php echo $kosong ;?></td>
						<td><?php echo $skor ;?></td>
						<td><?php echo $persen;?> %</td>
						<td><?php echo $capai;?></td>
					</tr>
					<?php
				}
				}
				?>
				<tr>
					<td colspan="7"><strong>B. TKDU</strong></td>
				</tr>
				<?php
				if($testkdu !== null){
				$caritryout = $this->model_sbmptn->get_tryout_by_profil2($testkdu->id_tryout);
				$idsiswa = $this->session->userdata('id_siswa');
				
				foreach($caritryout as $tryout){
					
					$benar 			= $this->model_dashboard->cari_skor($tryout->id_kategori, $idsiswa);
					
					$cariskorsalah 	= $this->model_dashboard->cari_skor_salah($tryout->id_kategori, $idsiswa);
					
					$cariwaktu 		= $this->model_dashboard->cari_waktu($tryout->id_kategori, $idsiswa);
					
					$salah 				= $cariskorsalah * -1;
					$skor 				= ($benar * 4) + $salah;
					$total 				= $tryout->jumlah_soal * 4;
					$ketercapaian		= number_format(($skor/$total) * 100, 2, '.', '');
					$kosong				= $tryout->jumlah_soal - $benar - $cariskorsalah;
					
					$persen				= number_format(($skor/$total) * 100, 2, ',', '');
					if($persen <= 100 and $persen > 85){
						$capai = "Sangat Baik";
					}elseif($persen <= 85 and $persen > 70){
						$capai = "Baik";
					}elseif($persen <= 70 and $persen > 55){
						$capai = "Cukup";
					}elseif($persen <= 55 and $persen >= 0){
						$capai = "Kurang";
					}
					?>
					<tr>
						<td><?php echo $tryout->nama_kategori;?></td>
						<td><?php echo $benar;?></td>
						<td><?php echo $cariskorsalah ;?></td>
						<td><?php echo $kosong ;?></td>
						<td><?php echo $skor ;?></td>
						<td><?php echo $persen;?> %</td>
						<td><?php echo $capai;?></td>
					</tr>
					<?php
				}
				}
				?>
				<?php
				if(($kelompok == "SAINTEK") or ($kelompok == "CAMPURAN")){
					?>
					<tr>
						<td colspan="7"><strong>TES KEMAMPUAN DASAR SAINTEK (TKD SAINTEK)</strong></td>
					</tr>
					<?php
					if($tessaintek !== null){
					$caritryout = $this->model_sbmptn->get_tryout_by_profil2($tessaintek->id_tryout);
					$idsiswa = $this->session->userdata('id_siswa');
					
					foreach($caritryout as $tryout){
						
						$benar 			= $this->model_dashboard->cari_skor($tryout->id_kategori, $idsiswa);
						
						$cariskorsalah 	= $this->model_dashboard->cari_skor_salah($tryout->id_kategori, $idsiswa);
						
						$cariwaktu 		= $this->model_dashboard->cari_waktu($tryout->id_kategori, $idsiswa);
						
						$salah 				= $cariskorsalah * -1;
						$skor 				= ($benar * 4) + $salah;
						$total 				= $tryout->jumlah_soal * 4;
						$ketercapaian		= number_format(($skor/$total) * 100, 2, '.', '');
						$kosong				= $tryout->jumlah_soal - $benar - $cariskorsalah;
						
						$persen				= number_format(($skor/$total) * 100, 2, ',', '');
						if($persen <= 100 and $persen > 85){
							$capai = "Sangat Baik";
						}elseif($persen <= 85 and $persen > 70){
							$capai = "Baik";
						}elseif($persen <= 70 and $persen > 55){
							$capai = "Cukup";
						}elseif($persen <= 55 and $persen >= 0){
							$capai = "Kurang";
						}
						?>
						<tr>
							<td><?php echo $tryout->nama_kategori;?></td>
							<td><?php echo $benar;?></td>
							<td><?php echo $cariskorsalah ;?></td>
							<td><?php echo $kosong ;?></td>
							<td><?php echo $skor ;?></td>
							<td><?php echo $persen;?> %</td>
							<td><?php echo $capai;?></td>
						</tr>
						<?php
					}
					}
					?>
					<?php
				}
				?>
				<?php
				if(($kelompok == "SOSHUM") or ($kelompok == "CAMPURAN")){
					?>
					<tr>
						<td colspan="7"><strong>TES KEMAMPUAN DASAR SOSHUM (TKD SOSHUM)</strong></td>
					</tr>
					<?php
					if($tessoshum !== null){
					$caritryout = $this->model_sbmptn->get_tryout_by_profil2($tessoshum->id_tryout);
					$idsiswa = $this->session->userdata('id_siswa');
					
					foreach($caritryout as $tryout){
						
						$benar 			= $this->model_dashboard->cari_skor($tryout->id_kategori, $idsiswa);
						
						$cariskorsalah 	= $this->model_dashboard->cari_skor_salah($tryout->id_kategori, $idsiswa);
						
						$cariwaktu 		= $this->model_dashboard->cari_waktu($tryout->id_kategori, $idsiswa);
						
						$salah 				= $cariskorsalah * -1;
						$skor 				= ($benar * 4) + $salah;
						$total 				= $tryout->jumlah_soal * 4;
						$ketercapaian		= number_format(($skor/$total) * 100, 2, '.', '');
						$kosong				= $tryout->jumlah_soal - $benar - $cariskorsalah;
						
						$persen				= number_format(($skor/$total) * 100, 2, ',', '');
						if($persen <= 100 and $persen > 85){
							$capai = "Sangat Baik";
						}elseif($persen <= 85 and $persen > 70){
							$capai = "Baik";
						}elseif($persen <= 70 and $persen > 55){
							$capai = "Cukup";
						}elseif($persen <= 55 and $persen >= 0){
							$capai = "Kurang";
						}
						?>
						<tr>
							<td><?php echo $tryout->nama_kategori;?></td>
							<td><?php echo $benar;?></td>
							<td><?php echo $cariskorsalah ;?></td>
							<td><?php echo $kosong ;?></td>
							<td><?php echo $skor ;?></td>
							<td><?php echo $persen;?> %</td>
							<td><?php echo $capai;?></td>
						</tr>
						<?php
					}
					}
					?>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>
</div>

<div class="diagnistic-wrapper">	
	<h1>ANALISIS BUTIR SOAL</h1>
		
	<table class="table table-bordered table-striped">
		<tbody>
			<tr>
				<td colspan="4"><strong>TES KEMAMPUAN DAN POTENSI AKADEMIK (TKPA)</strong></td>
			</tr>
			<tr>
				<td colspan="4"><strong>A. TPA</strong></td>
			</tr>
			<?php
			if($testpa !== null){
			$caritryout = $this->model_sbmptn->get_tryout_by_profil2($testpa->id_tryout);
			$idsiswa = $this->session->userdata('id_siswa');
			
			foreach($caritryout as $tryout){
				
				$benar 			= $this->model_dashboard->cari_skor($tryout->id_kategori, $idsiswa);
				
				$cariskorsalah 	= $this->model_dashboard->cari_skor_salah($tryout->id_kategori, $idsiswa);
				
				$cariwaktu 		= $this->model_dashboard->cari_waktu($tryout->id_kategori, $idsiswa);
				
				$salah 				= $cariskorsalah * -1;
				$skor 				= ($benar * 4) + $salah;
				$total 				= $tryout->jumlah_soal * 4;
				$ketercapaian		= number_format(($skor/$total) * 100, 2, '.', '');
				$kosong				= $tryout->jumlah_soal - $benar - $cariskorsalah;
				
				$persen				= number_format(($skor/$total) * 100, 2, ',', '');
				$persen2			= ($skor/$total) * 100;
				if($persen <= 100 and $persen > 85){
					$capai = "Sangat Baik";
				}elseif($persen <= 85 and $persen > 70){
					$capai = "Baik";
				}elseif($persen <= 70 and $persen > 55){
					$capai = "Cukup";
				}elseif($persen <= 55 and $persen >= 0){
					$capai = "Kurang";
				}
				?>
				<tr>
					<td><?php echo $tryout->nama_kategori;?></td>
					<td><span class="label label-success"><?php echo $benar;?> benar</span> / <?php echo $tryout->jumlah_soal;?> soal</td>
					<td>
					<div class="progress">
					  <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $persen2;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persen2;?>%;">
						<?php echo $persen;?>%
					  </div>
					</div>
					</td>
					<td>
					
					</td>
				</tr>
				<?php
			}
			}
			?>
			<tr>
				<td colspan="4"><strong>B. TKDU</strong></td>
			</tr>
			<?php
			if($testkdu !== null){
			$caritryout = $this->model_sbmptn->get_tryout_by_profil2($testkdu->id_tryout);
			$idsiswa = $this->session->userdata('id_siswa');
			
			foreach($caritryout as $tryout){
				
				$benar 			= $this->model_dashboard->cari_skor($tryout->id_kategori, $idsiswa);
				
				$cariskorsalah 	= $this->model_dashboard->cari_skor_salah($tryout->id_kategori, $idsiswa);
				
				$cariwaktu 		= $this->model_dashboard->cari_waktu($tryout->id_kategori, $idsiswa);
				
				$salah 				= $cariskorsalah * -1;
				$skor 				= ($benar * 4) + $salah;
				$total 				= $tryout->jumlah_soal * 4;
				$ketercapaian		= number_format(($skor/$total) * 100, 2, '.', '');
				$kosong				= $tryout->jumlah_soal - $benar - $cariskorsalah;
				
				$persen				= number_format(($skor/$total) * 100, 2, ',', '');
				$persen2			= ($skor/$total) * 100;
				if($persen <= 100 and $persen > 85){
					$capai = "Sangat Baik";
				}elseif($persen <= 85 and $persen > 70){
					$capai = "Baik";
				}elseif($persen <= 70 and $persen > 55){
					$capai = "Cukup";
				}elseif($persen <= 55 and $persen >= 0){
					$capai = "Kurang";
				}
				?>
				<tr>
					<td><?php echo $tryout->nama_kategori;?></td>
					<td><span class="label label-success"><?php echo $benar;?> benar</span> / <?php echo $tryout->jumlah_soal;?> soal</td>
					<td>
					<div class="progress">
					  <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $persen2;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persen2;?>%;">
						<?php echo $persen;?>%
					  </div>
					</div>
					</td>
					<td>
					
					</td>
				</tr>
				<?php
			}
			}
			?>
			<?php
			if(($kelompok == "SAINTEK") or ($kelompok == "CAMPURAN")){
				?>
				<tr>
					<td colspan="4"><strong>TES KEMAMPUAN DASAR SAINTEK (TKD SAINTEK)</strong></td>
				</tr>
				<?php
				if($tessaintek !== null){
				$caritryout = $this->model_sbmptn->get_tryout_by_profil2($tessaintek->id_tryout);
				$idsiswa = $this->session->userdata('id_siswa');
				
				foreach($caritryout as $tryout){
					
					$benar 			= $this->model_dashboard->cari_skor($tryout->id_kategori, $idsiswa);
					
					$cariskorsalah 	= $this->model_dashboard->cari_skor_salah($tryout->id_kategori, $idsiswa);
					
					$cariwaktu 		= $this->model_dashboard->cari_waktu($tryout->id_kategori, $idsiswa);
					
					$salah 				= $cariskorsalah * -1;
					$skor 				= ($benar * 4) + $salah;
					$total 				= $tryout->jumlah_soal * 4;
					$ketercapaian		= number_format(($skor/$total) * 100, 2, '.', '');
					$kosong				= $tryout->jumlah_soal - $benar - $cariskorsalah;
					
					$persen				= number_format(($skor/$total) * 100, 2, ',', '');
					$persen2			= ($skor/$total) * 100;
					if($persen <= 100 and $persen > 85){
						$capai = "Sangat Baik";
					}elseif($persen <= 85 and $persen > 70){
						$capai = "Baik";
					}elseif($persen <= 70 and $persen > 55){
						$capai = "Cukup";
					}elseif($persen <= 55 and $persen >= 0){
						$capai = "Kurang";
					}
					?>
					<tr>
						<td><?php echo $tryout->nama_kategori;?></td>
						<td><span class="label label-success"><?php echo $benar;?> benar</span> / <?php echo $tryout->jumlah_soal;?> soal</td>
						<td>
						<div class="progress">
						  <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $persen2;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persen2;?>%;">
							<?php echo $persen;?>%
						  </div>
						</div>
						</td>
						<td>
						
						</td>
					</tr>
					<?php
				}
				}
				?>
				<?php
			}
			?>
			<?php
			if(($kelompok == "SOSHUM") or ($kelompok == "CAMPURAN")){
				?>
				<tr>
					<td colspan="4"><strong>TES KEMAMPUAN DASAR SOSHUM (TKD SOSHUM)</strong></td>
				</tr>
				<?php
				if($tessoshum !== null){
				$caritryout = $this->model_sbmptn->get_tryout_by_profil2($tessoshum->id_tryout);
				$idsiswa = $this->session->userdata('id_siswa');
				
				foreach($caritryout as $tryout){
					
					$benar 			= $this->model_dashboard->cari_skor($tryout->id_kategori, $idsiswa);
					
					$cariskorsalah 	= $this->model_dashboard->cari_skor_salah($tryout->id_kategori, $idsiswa);
					
					$cariwaktu 		= $this->model_dashboard->cari_waktu($tryout->id_kategori, $idsiswa);
					
					$salah 				= $cariskorsalah * -1;
					$skor 				= ($benar * 4) + $salah;
					$total 				= $tryout->jumlah_soal * 4;
					$ketercapaian		= number_format(($skor/$total) * 100, 2, '.', '');
					$kosong				= $tryout->jumlah_soal - $benar - $cariskorsalah;
					
					$persen				= number_format(($skor/$total) * 100, 2, ',', '');
					$persen2			= ($skor/$total) * 100;
					if($persen <= 100 and $persen > 85){
						$capai = "Sangat Baik";
					}elseif($persen <= 85 and $persen > 70){
						$capai = "Baik";
					}elseif($persen <= 70 and $persen > 55){
						$capai = "Cukup";
					}elseif($persen <= 55 and $persen >= 0){
						$capai = "Kurang";
					}
					?>
					<tr>
						<td><?php echo $tryout->nama_kategori;?></td>
						<td><span class="label label-success"><?php echo $benar;?> benar</span> / <?php echo $tryout->jumlah_soal;?> soal</td>
						<td>
						<div class="progress">
						  <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $persen2;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persen2;?>%;">
							<?php echo $persen;?>%
						  </div>
						</div>
						</td>
						<td>
							
						</td>
					</tr>
					<?php
				}
				}
				?>
				<?php
			}
			?>
		</tbody>
	</table>
	
<!-- REKOMENDASI PTN LAIN SESUAI DENGAN NILAI SISWA -->
<!-- ############################################## -->

<h4>Rekomendai Program Studi Berdasarkan Nilai Siswa</h4>
<ul class="nav nav-tabs" role="tablist">
	<li role="presentation" class="active"><a href="#wilayah1" aria-controls="wilayah1" role="tab" data-toggle="tab">Wilayah 1</a></li>
	<li role="presentation"><a href="#wilayah2" aria-controls="wilayah2" role="tab" data-toggle="tab">Wilayah 2</a></li>
	<li role="presentation"><a href="#wilayah3" aria-controls="wilayah3" role="tab" data-toggle="tab">Wilayah 3</a></li>
	<li role="presentation"><a href="#wilayah4" aria-controls="wilayah4" role="tab" data-toggle="tab">Wilayah 4</a></li>
</ul>

<div class="tab-content">
	<div role="tabpanel" class="tab-pane active" id="wilayah1">
		<?php
		if(isset($nilaisaintek)){
			$this->db->select("*");
			$this->db->from("ptn");
			$this->db->join("panlok", "ptn.id_panlok=panlok.id_panlok", "left");
			$this->db->where("panlok.wilayah", 1);
			$query = $this->db->get();
			$dataptn = $query->result();
				?>
				<div class="col-xs-6">
				<h5>SAINTEK</h5>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No.</th>
							<th>PTN / Program Studi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$x = 1;
							foreach($dataptn as $ptn){
								?>
								<tr>
									<td><?php echo $x;?></td>
									<td><strong><?php echo $ptn->nama_ptn;?></strong></td>
									<td><strong></strong></td>
								</tr>
								<?php
								$this->db->select("*");
								$this->db->from("program_studi");
								$this->db->join("ptn", "program_studi.id_ptn=ptn.id_ptn", "left");
								$this->db->join("panlok", "ptn.id_panlok=panlok.id_panlok", "left");
								$this->db->where("panlok.wilayah", 1);
								$this->db->where("program_studi.nn <=", $nilaisaintek);
								$this->db->where("program_studi.kelompok", "SAINTEK");
								$this->db->where("program_studi.id_ptn", $ptn->id_ptn);
								$this->db->limit(5);
								
								$query = $this->db->get();
								$dataprodisaintek = $query->result();
								foreach($dataprodisaintek as $prodi){
									?>
									<tr>
										<td></td>
										<td><?php echo $prodi->nama_prodi;?></td>
									</tr>
									<?php
								}
								?>
								<?php
							$x++;
							}
						?>
					</tbody>
				</table>
				</div>
				<?php
		}
		if(isset($nilaisoshum)){
			$this->db->select("*");
			$this->db->from("ptn");
			$this->db->join("panlok", "ptn.id_panlok=panlok.id_panlok", "left");
			$this->db->where("panlok.wilayah", 1);
			$query = $this->db->get();
			$dataptn = $query->result();
				?>
				<div class="col-xs-6">
				<h5>SOSHUM</h5>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No.</th>
							<th>PTN / Program Studi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$x = 1;
							foreach($dataptn as $ptn){
								?>
								<tr>
									<td><?php echo $x;?></td>
									<td><strong><?php echo $ptn->nama_ptn;?></strong></td>
									<td><strong></strong></td>
								</tr>
								<?php
								$this->db->select("*");
								$this->db->from("program_studi");
								$this->db->join("ptn", "program_studi.id_ptn=ptn.id_ptn", "left");
								$this->db->join("panlok", "ptn.id_panlok=panlok.id_panlok", "left");
								$this->db->where("panlok.wilayah", 1);
								$this->db->where("program_studi.nn <=", $nilaisoshum);
								$this->db->where("program_studi.kelompok", "SOSHUM");
								$this->db->where("program_studi.id_ptn", $ptn->id_ptn);
								$this->db->limit(5);
								
								$query = $this->db->get();
								$dataprodisaintek = $query->result();
								foreach($dataprodisaintek as $prodi){
									?>
									<tr>
										<td></td>
										<td><?php echo $prodi->nama_prodi;?></td>
									</tr>
									<?php
								}
								?>
								<?php
							$x++;
							}
						?>
					</tbody>
				</table>
				</div>
				<?php
		}
		?>
	</div>
	<div role="tabpanel" class="tab-pane" id="wilayah2">
		<?php
		if(isset($nilaisaintek)){
			$this->db->select("*");
			$this->db->from("ptn");
			$this->db->join("panlok", "ptn.id_panlok=panlok.id_panlok", "left");
			$this->db->where("panlok.wilayah", 2);
			$query = $this->db->get();
			$dataptn = $query->result();
				?>
				<div class="col-xs-6">
				<h5>SAINTEK</h5>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No.</th>
							<th>PTN / Program Studi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$x = 1;
							foreach($dataptn as $ptn){
								?>
								<tr>
									<td><?php echo $x;?></td>
									<td><strong><?php echo $ptn->nama_ptn;?></strong></td>
									<td><strong></strong></td>
								</tr>
								<?php
								$this->db->select("*");
								$this->db->from("program_studi");
								$this->db->join("ptn", "program_studi.id_ptn=ptn.id_ptn", "left");
								$this->db->join("panlok", "ptn.id_panlok=panlok.id_panlok", "left");
								$this->db->where("panlok.wilayah", 2);
								$this->db->where("program_studi.nn <=", $nilaisaintek);
								$this->db->where("program_studi.kelompok", "SAINTEK");
								$this->db->where("program_studi.id_ptn", $ptn->id_ptn);
								$this->db->limit(5);
								
								$query = $this->db->get();
								$dataprodisaintek = $query->result();
								foreach($dataprodisaintek as $prodi){
									?>
									<tr>
										<td></td>
										<td><?php echo $prodi->nama_prodi;?></td>
									</tr>
									<?php
								}
								?>
								<?php
							$x++;
							}
						?>
					</tbody>
				</table>
				</div>
				<?php
		}
		if(isset($nilaisoshum)){
			$this->db->select("*");
			$this->db->from("ptn");
			$this->db->join("panlok", "ptn.id_panlok=panlok.id_panlok", "left");
			$this->db->where("panlok.wilayah", 2);
			$query = $this->db->get();
			$dataptn = $query->result();
				?>
				<div class="col-xs-6">
				<h5>SOSHUM</h5>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No.</th>
							<th>PTN / Program Studi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$x = 1;
							foreach($dataptn as $ptn){
								?>
								<tr>
									<td><?php echo $x;?></td>
									<td><strong><?php echo $ptn->nama_ptn;?></strong></td>
									<td><strong></strong></td>
								</tr>
								<?php
								$this->db->select("*");
								$this->db->from("program_studi");
								$this->db->join("ptn", "program_studi.id_ptn=ptn.id_ptn", "left");
								$this->db->join("panlok", "ptn.id_panlok=panlok.id_panlok", "left");
								$this->db->where("panlok.wilayah", 2);
								$this->db->where("program_studi.nn <=", $nilaisoshum);
								$this->db->where("program_studi.kelompok", "SOSHUM");
								$this->db->where("program_studi.id_ptn", $ptn->id_ptn);
								$this->db->limit(5);
								
								$query = $this->db->get();
								$dataprodisaintek = $query->result();
								foreach($dataprodisaintek as $prodi){
									?>
									<tr>
										<td></td>
										<td><?php echo $prodi->nama_prodi;?></td>
									</tr>
									<?php
								}
								?>
								<?php
							$x++;
							}
						?>
					</tbody>
				</table>
				</div>
				<?php
		}
		?>
	</div>
	<div role="tabpanel" class="tab-pane" id="wilayah3">
		<?php
		if(isset($nilaisaintek)){
			$this->db->select("*");
			$this->db->from("ptn");
			$this->db->join("panlok", "ptn.id_panlok=panlok.id_panlok", "left");
			$this->db->where("panlok.wilayah", 3);
			$query = $this->db->get();
			$dataptn = $query->result();
				?>
				<div class="col-xs-6">
				<h5>SAINTEK</h5>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No.</th>
							<th>PTN / Program Studi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$x = 1;
							foreach($dataptn as $ptn){
								?>
								<tr>
									<td><?php echo $x;?></td>
									<td><strong><?php echo $ptn->nama_ptn;?></strong></td>
									<td><strong></strong></td>
								</tr>
								<?php
								$this->db->select("*");
								$this->db->from("program_studi");
								$this->db->join("ptn", "program_studi.id_ptn=ptn.id_ptn", "left");
								$this->db->join("panlok", "ptn.id_panlok=panlok.id_panlok", "left");
								$this->db->where("panlok.wilayah", 3);
								$this->db->where("program_studi.nn <=", $nilaisaintek);
								$this->db->where("program_studi.kelompok", "SAINTEK");
								$this->db->where("program_studi.id_ptn", $ptn->id_ptn);
								$this->db->limit(5);
								
								$query = $this->db->get();
								$dataprodisaintek = $query->result();
								foreach($dataprodisaintek as $prodi){
									?>
									<tr>
										<td></td>
										<td><?php echo $prodi->nama_prodi;?></td>
									</tr>
									<?php
								}
								?>
								<?php
							$x++;
							}
						?>
					</tbody>
				</table>
				</div>
				<?php
		}
		if(isset($nilaisoshum)){
			$this->db->select("*");
			$this->db->from("ptn");
			$this->db->join("panlok", "ptn.id_panlok=panlok.id_panlok", "left");
			$this->db->where("panlok.wilayah", 3);
			$query = $this->db->get();
			$dataptn = $query->result();
				?>
				<div class="col-xs-6">
				<h5>SOSHUM</h5>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No.</th>
							<th>PTN / Program Studi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$x = 1;
							foreach($dataptn as $ptn){
								?>
								<tr>
									<td><?php echo $x;?></td>
									<td><strong><?php echo $ptn->nama_ptn;?></strong></td>
									<td><strong></strong></td>
								</tr>
								<?php
								$this->db->select("*");
								$this->db->from("program_studi");
								$this->db->join("ptn", "program_studi.id_ptn=ptn.id_ptn", "left");
								$this->db->join("panlok", "ptn.id_panlok=panlok.id_panlok", "left");
								$this->db->where("panlok.wilayah", 3);
								$this->db->where("program_studi.nn <=", $nilaisoshum);
								$this->db->where("program_studi.kelompok", "SOSHUM");
								$this->db->where("program_studi.id_ptn", $ptn->id_ptn);
								$this->db->limit(5);
								
								$query = $this->db->get();
								$dataprodisaintek = $query->result();
								foreach($dataprodisaintek as $prodi){
									?>
									<tr>
										<td></td>
										<td><?php echo $prodi->nama_prodi;?></td>
									</tr>
									<?php
								}
								?>
								<?php
							$x++;
							}
						?>
					</tbody>
				</table>
				</div>
				<?php
		}
		?>
	</div>
	<div role="tabpanel" class="tab-pane" id="wilayah4">
		<?php
		if(isset($nilaisaintek)){
			$this->db->select("*");
			$this->db->from("ptn");
			$this->db->join("panlok", "ptn.id_panlok=panlok.id_panlok", "left");
			$this->db->where("panlok.wilayah", 4);
			$query = $this->db->get();
			$dataptn = $query->result();
				?>
				<div class="col-xs-6">
				<h5>SAINTEK</h5>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No.</th>
							<th>PTN / Program Studi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$x = 1;
							foreach($dataptn as $ptn){
								?>
								<tr>
									<td><?php echo $x;?></td>
									<td><strong><?php echo $ptn->nama_ptn;?></strong></td>
									<td><strong></strong></td>
								</tr>
								<?php
								$this->db->select("*");
								$this->db->from("program_studi");
								$this->db->join("ptn", "program_studi.id_ptn=ptn.id_ptn", "left");
								$this->db->join("panlok", "ptn.id_panlok=panlok.id_panlok", "left");
								$this->db->where("panlok.wilayah", 4);
								$this->db->where("program_studi.nn <=", $nilaisaintek);
								$this->db->where("program_studi.kelompok", "SAINTEK");
								$this->db->where("program_studi.id_ptn", $ptn->id_ptn);
								$this->db->limit(5);
								
								$query = $this->db->get();
								$dataprodisaintek = $query->result();
								foreach($dataprodisaintek as $prodi){
									?>
									<tr>
										<td></td>
										<td><?php echo $prodi->nama_prodi;?></td>
									</tr>
									<?php
								}
								?>
								<?php
							$x++;
							}
						?>
					</tbody>
				</table>
				</div>
				<?php
		}
		if(isset($nilaisoshum)){
			$this->db->select("*");
			$this->db->from("ptn");
			$this->db->join("panlok", "ptn.id_panlok=panlok.id_panlok", "left");
			$this->db->where("panlok.wilayah", 4);
			$query = $this->db->get();
			$dataptn = $query->result();
				?>
				<div class="col-xs-6">
				<h5>SOSHUM</h5>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No.</th>
							<th>PTN / Program Studi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$x = 1;
							foreach($dataptn as $ptn){
								?>
								<tr>
									<td><?php echo $x;?></td>
									<td><strong><?php echo $ptn->nama_ptn;?></strong></td>
									<td><strong></strong></td>
								</tr>
								<?php
								$this->db->select("*");
								$this->db->from("program_studi");
								$this->db->join("ptn", "program_studi.id_ptn=ptn.id_ptn", "left");
								$this->db->join("panlok", "ptn.id_panlok=panlok.id_panlok", "left");
								$this->db->where("panlok.wilayah", 4);
								$this->db->where("program_studi.nn <=", $nilaisoshum);
								$this->db->where("program_studi.kelompok", "SOSHUM");
								$this->db->where("program_studi.id_ptn", $ptn->id_ptn);
								$this->db->limit(5);
								
								$query = $this->db->get();
								$dataprodisaintek = $query->result();
								foreach($dataprodisaintek as $prodi){
									?>
									<tr>
										<td></td>
										<td><?php echo $prodi->nama_prodi;?></td>
									</tr>
									<?php
								}
								?>
								<?php
							$x++;
							}
						?>
					</tbody>
				</table>
				</div>
				<?php
		}
		?>
	</div>
</div>
<!-- end REKOMENDASI PTN LAIN SESUAI DENGAN NILAI SISWA -->
<!-- ############################################## -->


</div>
</div>

<?php include('footer.php'); ?>

   <script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>
  
  <script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/Chart.js');?>"></script>
<script>
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: [
        <?php
			
			if($testpa !== null){
				$caritryouttpa = $this->model_sbmptn->get_tryout_by_profil2($testpa->id_tryout);
				foreach($caritryouttpa as $tryout){
					echo '"'.$tryout->nama_kategori.'",';
				}
			}
			if($testkdu !== null){
				$caritryouttkdu = $this->model_sbmptn->get_tryout_by_profil2($testkdu->id_tryout);
				foreach($caritryouttkdu as $tryout){
					echo '"'.$tryout->nama_kategori.'",';
				}
			}
			
		?>
    ],
    datasets: [
        {
			label: "Skor",
            data: [
			<?php
			if($testpa !== null){
				$caritryouttpa = $this->model_sbmptn->get_tryout_by_profil2($testpa->id_tryout);
				$idsiswa = $this->session->userdata('id_siswa');
				foreach($caritryouttpa as $tryout){
					$benar 			= $this->model_dashboard->cari_skor($tryout->id_kategori, $idsiswa);
					$cariskorsalah 	= $this->model_dashboard->cari_skor_salah($tryout->id_kategori, $idsiswa);
					$cariwaktu 		= $this->model_dashboard->cari_waktu($tryout->id_kategori, $idsiswa);
					$salah 				= $cariskorsalah * -1;
					$skor 				= ($benar * 4) + $salah;
					$total 				= $tryout->jumlah_soal * 4;
					$ketercapaian		= number_format(($skor/$total) * 100, 0, '.', '');
					if($ketercapaian < 0){
						echo 0 . ",";
					}else{
						echo $ketercapaian.',';
					}
				}
			}
			if($testkdu !== null){
				$caritryouttkdu = $this->model_sbmptn->get_tryout_by_profil2($testkdu->id_tryout);
				foreach($caritryouttkdu as $tryout){
					$benar 			= $this->model_dashboard->cari_skor($tryout->id_kategori, $idsiswa);
					$cariskorsalah 	= $this->model_dashboard->cari_skor_salah($tryout->id_kategori, $idsiswa);
					$cariwaktu 		= $this->model_dashboard->cari_waktu($tryout->id_kategori, $idsiswa);
					$salah 				= $cariskorsalah * -1;
					$skor 				= ($benar * 4) + $salah;
					$total 				= $tryout->jumlah_soal * 4;
					$ketercapaian		= number_format(($skor/$total) * 100, 0, '.', '');
					if($ketercapaian < 0){
						echo 0 . ",";
					}else{
						echo $ketercapaian.',';
					}
				}
			}
			?>
			],
			backgroundColor: [
				"#4286f4",
				"#41f47d",
				"#e8f441",
				"#f4b841",
				"#f44941",
				"#f441f1",
			],
        }]
    },
	options: {
		maintainAspectRatio : false
	}
	/*
	options: {
        scales: {
            yAxes: [{
                ticks: {
                    max: 100,
                    min: 0,
					stepSize: 10
                }
            }]
        }
    }
	*/
});
</script>
<?php
if($kelompok == "SAINTEK"){
?>
<script>
var ctx = document.getElementById("myChart2");
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: [
        <?php
			
			if($tessaintek !== null){
				$caritryouttsaintek = $this->model_sbmptn->get_tryout_by_profil2($tessaintek->id_tryout);
				foreach($caritryouttsaintek as $tryout){
					echo '"'.$tryout->nama_kategori.'",';
				}
			}
			
		?>
    ],
    datasets: [
        {
			label: "Skor",
            data: [
			<?php
			if($tessaintek !== null){
				$caritryouttsaintek = $this->model_sbmptn->get_tryout_by_profil2($tessaintek->id_tryout);
				$idsiswa = $this->session->userdata('id_siswa');
				foreach($caritryouttsaintek as $tryout){
					$benar 			= $this->model_dashboard->cari_skor($tryout->id_kategori, $idsiswa);
					$cariskorsalah 	= $this->model_dashboard->cari_skor_salah($tryout->id_kategori, $idsiswa);
					$cariwaktu 		= $this->model_dashboard->cari_waktu($tryout->id_kategori, $idsiswa);
					$salah 				= $cariskorsalah * -1;
					$skor 				= ($benar * 4) + $salah;
					$total 				= $tryout->jumlah_soal * 4;
					$ketercapaian		= number_format(($skor/$total) * 100, 0, '.', '');
					if($ketercapaian < 0){
						echo 0 . ",";
					}else{
						echo $ketercapaian.',';
					}
				}
			}
			?>
			],
			backgroundColor: [
				"#4286f4",
				"#41f47d",
				"#e8f441",
				"#f4b841"
			],
        }]
    },
	options: {
		maintainAspectRatio : true
	}
	/*
	options: {
        scales: {
            yAxes: [{
                ticks: {
                    max: 100,
                    min: 0,
					stepSize: 10
                }
            }]
        }
    }
	*/
});
</script>
<?php
}elseif($kelompok == "SOSHUM"){
?>
<script>
var ctx = document.getElementById("myChart2");
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: [
        <?php
			if($tessoshum !== null){
				$caritryouttsoshum = $this->model_sbmptn->get_tryout_by_profil2($tessoshum->id_tryout);
				foreach($caritryouttsoshum as $tryout){
					echo '"'.$tryout->nama_kategori.'",';
				}
			}
		?>
    ],
    datasets: [
        {
			label: "Skor",
            data: [
			<?php
			if($tessoshum !== null){
				$caritryouttsoshum = $this->model_sbmptn->get_tryout_by_profil2($tessoshum->id_tryout);
				$idsiswa = $this->session->userdata('id_siswa');
				foreach($caritryouttsoshum as $tryout){
					$benar 			= $this->model_dashboard->cari_skor($tryout->id_kategori, $idsiswa);
					$cariskorsalah 	= $this->model_dashboard->cari_skor_salah($tryout->id_kategori, $idsiswa);
					$cariwaktu 		= $this->model_dashboard->cari_waktu($tryout->id_kategori, $idsiswa);
					$salah 				= $cariskorsalah * -1;
					$skor 				= ($benar * 4) + $salah;
					$total 				= $tryout->jumlah_soal * 4;
					$ketercapaian		= number_format(($skor/$total) * 100, 0, '.', '');
					if($ketercapaian < 0){
						echo 0 . ",";
					}else{
						echo $ketercapaian.',';
					}
				}
			}
			?>
			],
			backgroundColor: [
				"#4286f4",
				"#41f47d",
				"#e8f441",
				"#f4b841",
				"#4286f4"
			],
        }]
    },
	options: {
		maintainAspectRatio : true
	}
	/*
	options: {
        scales: {
            yAxes: [{
                ticks: {
                    max: 100,
                    min: 0,
					stepSize: 10
                }
            }]
        }
    }
	*/
});
</script>
<?php
}elseif($kelompok == "CAMPURAN"){
?>
<script>
var ctx2 = document.getElementById("myChart2");
var myChart2 = new Chart(ctx2, {
    type: 'doughnut',
    data: {
        labels: [
        <?php
			if($tessaintek !== null){
				$caritryouttsaintek = $this->model_sbmptn->get_tryout_by_profil2($tessaintek->id_tryout);
				foreach($caritryouttsaintek as $tryout){
					echo '"'.$tryout->nama_kategori.'",';
				}
			}
		?>
    ],
    datasets: [
        {
			label: "Skor",
            data: [
			<?php
			if($tessaintek !== null){
				$caritryouttsaintek = $this->model_sbmptn->get_tryout_by_profil2($tessaintek->id_tryout);
				$idsiswa = $this->session->userdata('id_siswa');
				foreach($caritryouttsaintek as $tryout){
					$benar 			= $this->model_dashboard->cari_skor($tryout->id_kategori, $idsiswa);
					$cariskorsalah 	= $this->model_dashboard->cari_skor_salah($tryout->id_kategori, $idsiswa);
					$cariwaktu 		= $this->model_dashboard->cari_waktu($tryout->id_kategori, $idsiswa);
					$salah 				= $cariskorsalah * -1;
					$skor 				= ($benar * 4) + $salah;
					$total 				= $tryout->jumlah_soal * 4;
					$ketercapaian		= number_format(($skor/$total) * 100, 0, '.', '');
					if($ketercapaian < 0){
						echo 0 . ",";
					}else{
						echo $ketercapaian.',';
					}
				}
			}
			?>
			],
			backgroundColor: [
				"#4286f4",
				"#41f47d",
				"#e8f441",
				"#f4b841"
			],
        }]
    },
	options: {
		maintainAspectRatio : true
	}
	/*
	options: {
        scales: {
            yAxes: [{
                ticks: {
                    max: 100,
                    min: 0,
					stepSize: 10
                }
            }]
        }
    }
	*/
});
</script>
<script>
var ctx3 = document.getElementById("myChart3");
var myChart3 = new Chart(ctx3, {
    type: 'doughnut',
    data: {
        labels: [
        <?php
			if($tessoshum !== null){
				$caritryouttsoshum = $this->model_sbmptn->get_tryout_by_profil2($tessoshum->id_tryout);
				foreach($caritryouttsoshum as $tryout){
					echo '"'.$tryout->nama_kategori.'",';
				}
			}
		?>
    ],
    datasets: [
        {
			label: "Skor",
            data: [
			<?php
			if($tessoshum !== null){
				$caritryouttsoshum = $this->model_sbmptn->get_tryout_by_profil2($tessoshum->id_tryout);
				$idsiswa = $this->session->userdata('id_siswa');
				foreach($caritryouttsoshum as $tryout){
					$benar 			= $this->model_dashboard->cari_skor($tryout->id_kategori, $idsiswa);
					$cariskorsalah 	= $this->model_dashboard->cari_skor_salah($tryout->id_kategori, $idsiswa);
					$cariwaktu 		= $this->model_dashboard->cari_waktu($tryout->id_kategori, $idsiswa);
					$salah 				= $cariskorsalah * -1;
					$skor 				= ($benar * 4) + $salah;
					$total 				= $tryout->jumlah_soal * 4;
					$ketercapaian		= number_format(($skor/$total) * 100, 0, '.', '');
					if($ketercapaian < 0){
						echo 0 . ",";
					}else{
						echo $ketercapaian.',';
					}
				}
			}
			?>
			],
			backgroundColor: [
				"#4286f4",
				"#41f47d",
				"#e8f441",
				"#f4b841"
			],
        }]
    },
	options: {
		maintainAspectRatio : true
	}
	/*
	options: {
        scales: {
            yAxes: [{
                ticks: {
                    max: 100,
                    min: 0,
					stepSize: 10
                }
            }]
        }
    }
	*/
});
</script>
<?php
}
?>


    

  <script type="text/javascript" charset="utf-8">
    $(window).load(function(){
 
    });
  </script>
  </body>
</html>
