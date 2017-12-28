<html>
<head>
<?php
$x = 1;
$jumlahpeserta = 0;
foreach($dataperingkat as $peringkat){
	if(isset($peringkat->waktu_kerja)){
		$skor[$x] =round(($peringkat->jumlah_bobot_benar/$peringkat->jumlah_bobot)*100, 2);
		$nilai[$x] =$peringkat->jumlah_bobot_benar;
		if($peringkat->id_siswa == $idsiswa){
			$skorsaya = round(($peringkat->jumlah_bobot_benar/$peringkat->jumlah_bobot)*100, 2);
			$nilaisaya = $peringkat->jumlah_bobot_benar;
			
			$peringkatsaya = $x;
			
		}
		$x++;
		$jumlahpeserta++;
	}
}

if(!isset($skorsaya)){
	$skorsaya = 0;
}
if(!isset($nilaisaya)){
	$nilaisaya = 0;
}
if(!isset($peringkatsaya)){
	$peringkatsaya = "N/A";
}

?>
<style>
.tabel-garis tbody tr td, .tabel-garis thead tr th{
	border: 1px solid black;
	padding: 0.1cm;
}
</style>
</head>

<body>
<center>
<h4>Laporan & Analisis Computer Based Test</h4>
<h5><?php echo $infosiswa->nama_sekolah;?></h5>
</center>
<hr>
<table class="table" cellspacing="0" cellpadding="5">
	<tr>
		<td rowspan="5" valign="top"><img src="<?php
				if($infosiswa->foto == ""){
				echo html_entity_decode(preg_replace("/&#?[a-z0-9]+;/i","",str_replace('http://primemobile.co.id/','',base_url('assets/uploads/foto_siswa/default.jpg'))));
				}else{
				echo html_entity_decode(preg_replace("/&#?[a-z0-9]+;/i","",str_replace('http://primemobile.co.id/','',base_url('assets/uploads/foto_siswa/'.$infosiswa->foto))));
				}?>" style="width: 3cm;"/></td>
		<td>Nama Siswa</td>
		<td>:</td>
		<td><?php echo $infosiswa->nama_siswa;?></td>
	</tr>
	<tr>
		<td>Sekolah</td>
		<td>:</td>
		<td><?php echo $infosiswa->nama_sekolah;?></td>
	</tr>
	<tr>
		<td>Kelas</td>
		<td>:</td>
		<td><?php echo $infosiswa->alias_kelas;?></td>
	</tr>
	<tr>
		<td>Ujian</td>
		<td>:</td>
		<td><?php echo $aliaskelas->nama_profil; ?><</td>
	</tr>
	<tr>
		<td>Peringkat</td>
		<td>:</td>
		<td><?php echo $peringkatsaya; ?> dari <?php echo $jumlahpeserta; ?></td>
	</tr>
</table>

<br>&nbsp;

<table class="tabel-garis" cellspacing="0">
  <thead>
	<tr>
		<th colspan="7" style="text-align: center; background-color: #630b0b; color: white;">Nilai Mata Pelajaran</th>
	</tr>
	<tr>
		<th style="text-align: center; width: 8cm;">Mata Pelajaran</th>
		<th style="text-align: center; width: 2cm;">Jumlah Soal</th>
		<th style="text-align: center;">Benar</th>
		<th style="text-align: center;">Salah</th>
		<th style="text-align: center;">KKM</th>
		<th style="text-align: center;">Nilai</th>
		<!-- <th style="text-align: center;">Skor</th> -->
		<th style="text-align: center;">Ketuntasan</th>
	</tr>
  </thead>
  <tbody>
	<?php
		foreach($analisis_mapel as $datamapel){
			$skor = round(($datamapel->jumlah_bobot_benar/$datamapel->jumlah_bobot)*100);
	?>
		<tr>
			<td><?php echo $datamapel->nama_kategori; ?></td>
			<td style="text-align: center;"><?php echo $datamapel->count_benar + $datamapel->count_salah; ?></td>
			<td style="text-align: center;">
			<?php 
			if($datamapel->count_benar == ""){
				echo "0";
			}else{
				echo $datamapel->count_benar;
			}
			?></td>
			<td style="text-align: center;"><?php echo $datamapel->count_salah; ?></td>
			<td>
				<?php
					// cek apakah sekolah memiliki KKM sendiri
					$cekkkm = $this->model_psep_cbt->cek_kkm($datamapel->id_kategori, $infosiswa->sekolah_id);
					if($cekkkm !== null){
						$kkm = $cekkkm->ketuntasan;
					}else{
						$kkm = $datamapel->ketuntasan;
					}
					echo $kkm;
				?>
			</td>
			<td style="text-align: center;">
			<?php  
			if($datamapel->count_benar == ""){
				echo "0";
			}else{
				if($datamapel->jumlah_bobot_benar > 100){
					echo "100.00";
				}else{
					echo number_format($datamapel->jumlah_bobot_benar, 2, '.', '');
				}
			}
			?></td>
			<!--
			<td style="text-align: center;"><?php echo number_format(($datamapel->jumlah_bobot_benar/$datamapel->jumlah_bobot)*100, 2, '.', '')."%"; ?></td> -->
			<td style="text-align: center;">
				<?php
					if($skor >= $kkm){
				?>
					<span style="color: green;">Tuntas</span>	
				<?php
					}else{
				?>
					<span style="color: red;">Belum Tuntas</span>
				<?php
					}
				?>
			</td>
		</tr>
	<?php
		}
	?>
  </tbody>
</table>

<br>&nbsp;
<table class="tabel-garis" cellspacing="0">
  <thead>
	<tr>
		<th colspan="5" style=" background-color: #630b0b; color: white;">Perolehan Waktu</th>
	</tr>
	<tr>
	  <th style="text-align: center; width: 8cm;">Mata Pelajaran</th>
	  <th>jumlah Soal</th>
	  <th>Disediakan</th>
	  <th>Dikerjakan</th>
	  <th>Rata - rata</th>
	</tr>
  </thead>
  <tbody>
	<?php
		foreach($analisis_waktu as $datawaktu){
	?>
		<tr>
			<td><?php echo $datawaktu->nama_kategori; ?></td>
			<td style="text-align: center;"><?php echo $datawaktu->jumlah_soal; ?></td>
			<td style="text-align: center; width: 3cm;"><?php echo $datawaktu->disediakan; ?></td>
			<td style="text-align: center; width: 3cm;"><?php echo $datawaktu->dikerjakan; ?></td>
			<td style="text-align: center;"><?php echo $datawaktu->rata_rata; ?></td>
		</tr>
	<?php
		}
	?>
  </tbody>
</table>

<br>&nbsp;

<?php foreach($kategori as $kategoritopik){
?>
	<table class="tabel-garis" cellspacing="0">
		<thead>
			<tr>
				<th colspan="6" style=" background-color: #630b0b; color: white;"><?php echo $kategoritopik->nama_kategori; ?></th>
			</tr>
			<tr>
				<th class="text-center" style="text-align: center; width: 8cm;">Topik/Indikator</th>
				<th class="text-center">Jml Soal</th>
				<th class="text-center">Benar</th>
				<th class="text-center">Salah</th>
				<th class="text-center">Skor</th>
				<th class="text-center" style="text-align: center; width: 5cm;">Ketuntasan</th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach($analisis_topik as $topik){
					if($topik->id_kategori == $kategoritopik->id_kategori){
			?>
					<tr>
						<td><?php echo $topik->topik; ?></td>
						<td style="text-align: center;"><?php echo $topik->jumlah_soal ?></td>
						<td style="text-align: center;"><?php echo $topik->jumlah_benar ?></td>
						<td style="text-align: center;"><?php echo $topik->jumlah_salah ?></td>
						<td style="text-align: center;">
						<?php 
							echo round((($topik->jumlah_benar / $topik->jumlah_soal) * 100), 2).'%';
						?>
						</td>
						<td style="text-align: center;">
						<?php if($topik->status == 1){
						?>
						<span style="color: green;">Tuntas</span>
						<?php
						}else{
						?>
						<span style="color: red;">Belum Tuntas</span>
						<?php	
						}?>
						</td>
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
</body>
</html>