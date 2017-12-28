<?php
//PERHITUNGAN SKOR
foreach($kategoridiagnostic as $diagnostic){
	foreach($datasoal as $soal){
		if($soal->id_diagnostic == $diagnostic->id_diagnostic){
			foreach($jumlahbenar as $datanilai){
				if($datanilai->id_diagnostic == $diagnostic->id_diagnostic){
					
					$skor[$diagnostic->id_diagnostic] = round(($datanilai->jumlah_benar / $soal->jumlah)*100, 2);
					
					$soalbenar[$diagnostic->id_diagnostic] = $datanilai->jumlah_benar;
					
					$jumlahsoalasli[$diagnostic->id_diagnostic] = $soal->jumlah;
					
					$soalsalah[$diagnostic->id_diagnostic] = $soal->jumlah - $datanilai->jumlah_benar;
				}
			}
		}
	}
}

foreach($kategoridiagnostic as $diagnostic){
	if(!isset($skor[$diagnostic->id_diagnostic])){
		$skor[$diagnostic->id_diagnostic] = 0;
	}
	if($skor[$diagnostic->id_diagnostic] < 40){
		$kategori[$diagnostic->id_diagnostic] = "Sangat Rendah";
	}elseif($skor[$diagnostic->id_diagnostic] >= 40 AND $skor[$diagnostic->id_diagnostic] < 56){
		$kategori[$diagnostic->id_diagnostic] = "Rendah";
	}elseif($skor[$diagnostic->id_diagnostic] >= 56 AND $skor[$diagnostic->id_diagnostic] < 71){
		$kategori[$diagnostic->id_diagnostic] = "Sedang";
	}elseif($skor[$diagnostic->id_diagnostic] >= 71 AND $skor[$diagnostic->id_diagnostic] < 86){
		$kategori[$diagnostic->id_diagnostic] = "Tinggi";
	}elseif($skor[$diagnostic->id_diagnostic] >= 86){
		$kategori[$diagnostic->id_diagnostic] = "Sangat Tinggi";
	}
}

foreach($kategoridiagnostic as $diagnostic){
	foreach($jumlahhasil as $jumlah){
		if($jumlah->id_diagnostic == $diagnostic->id_diagnostic){
			foreach($jumlahbenarhasil as $jumlahbenar){
				if($jumlahbenar->id_diagnostic == $diagnostic->id_diagnostic){
					$average[$diagnostic->id_diagnostic] = round(($jumlahbenar->jumlah_benar / $jumlah->jumlah_soal) * 100, 2);
					
					
				}
			}
		}
		$jumlahsoalasli[$diagnostic->id_diagnostic] = $jumlah->jumlah_soal;
	}
}
?>

<?php
	$total = $totalv + $totala + $totalk;
	
	if($totalv == 0){
		$persenv = 0;
	}else{
		$persenv = ($totalv / $total) * 100;
	}
	
	if($totala == 0){
		$persena = 0;
	}else{
		$persena = ($totalv / $total) * 100;
	}
	
	if($totalk == 0){
		$persenk = 0;
	}else{
		$persenk = ($totalv / $total) * 100;
	}
	
?>

<?php 
	$rank = array();
	$skor_maxmin = array();
	$rankkelas = array();
	foreach ($kategoridiagnostic as $diagnostic) {
		foreach ($hasildiagnostic as $hasil) {
			if($hasil->id_diagnostic == $diagnostic->id_diagnostic){
				//rank[id_diagnostic][id_siswa] = jumlah_status
				$rank[$diagnostic->id_diagnostic][] = $hasil->id_siswa;
				foreach ($datasoal as $soal) {
					if($soal->id_diagnostic == $diagnostic->id_diagnostic){
						$skor_maxmin[$diagnostic->id_diagnostic][] = round((($hasil->jumlah_status / $soal->jumlah) * 100), 2);
					}
				}

			}
		}
	}
	foreach ($peringkatsiswa as $kelas) {
		$rankkelas[] = $kelas->id_siswa;
	}
	
	if(!isset($skor)){
		$skor = 0;
	}

if(empty($data_eq)){
	$skor_aq = 0;
	$skor_eq = 0;
	$skor_am = 0;
}else{
	$skor_aq = $data_eq->skor_aq;
	$skor_eq = $data_eq->skor_eq;
	$skor_am = $data_eq->skor_am;
}
?>

<style>
	table{
		border-collapse: collapse;
	}
	.bordered tr td{
		border: 1px solid black;
	}
	td{
		padding: 0.2cm;
	}
</style>

<body>
<table style="width: 18cm;" class="">
	<tr>
		<td style="width: 9cm;" align="right"><img src="<?php echo html_entity_decode(preg_replace("/&#?[a-z0-9]+;/i","",str_replace('http://primemobile.co.id/','',base_url("assets/dashboard/images/logo-red.png"))));?>" style="height: 1cm;"/></td>
		<td align="left"><img src="<?php echo html_entity_decode(preg_replace("/&#?[a-z0-9]+;/i","",str_replace('http://primemobile.co.id/','',base_url("assets/dashboard/images/agcu.jpg"))));?>" style="height: 1cm;"/></td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;"><h4>ACADEMIC GENERAL CHECK UP REPORT</h4></td>
	</tr>
</table>



<table class="table">
	<tr>
		<td style="width: 4cm;">Nama Siswa</td>
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
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table class="" style="width: 18.5cm; background-color: red;">
	<tr>
		<td style="color: white;" align="center"><h4 style="margin: 0.2cm;">DIAGNOSTIC TEST</h4></td>
	</tr>
</table>

<table class="table bordered" style="width: 18.5cm;">
	<tr>
		<td style="background-color: purple; color: white; text-align: center;">Bidang Studi</td>
		<td style="background-color: purple; color: white; text-align: center;">Nilai</td>
		<td style="background-color: purple; color: white; text-align: center;">Rata-rata Kelas</td>
		<td style="background-color: purple; color: white; text-align: center;">Rank. Bidang Studi</td>
		<td style="background-color: purple; color: white; text-align: center;">Kategori</td>
	</tr>
	<?php
		foreach($kategoridiagnostic as $diagnostic){
	?>
		<tr>
			<td>
				<?php echo $diagnostic->nama_kategori; ?>
			</td>
			<td align="center">
				<?php
					
					echo number_format($skor[$diagnostic->id_diagnostic], 2, '.', ',');
				?>
			</td>
			<td align="center">
				<?php 
				if(isset($average[$diagnostic->id_diagnostic])){
					echo number_format($average[$diagnostic->id_diagnostic], 2, '.', ',');
				}else{
					echo 0;
				}
				; 
				
				?>
			</td>
			<td align="center">
				<?php 
					echo (array_search($idsiswa, $rank[$diagnostic->id_diagnostic])) + 1;
				?> 
			</td>
			<td align="center">
				<?php
					
					echo $kategori[$diagnostic->id_diagnostic];
				?>
			</td>
		</tr>
	<?php
		}
	?>
	<tr>
		<td>Jumlah Nilai</td>
		<td align="center"><?php 
		if($skor !== 0){
			echo array_sum($skor);
		}else{
			echo "0";
		}
		?></td>
		<td align="center" colspan="3">Peringkat</td>
	</tr>
	<tr>
		<td>Nilai Rata-rata</td>
		<td align="center">
		<?php
			if($skor !== 0){
				$jumlaharray = count($skor);
				echo number_format((array_sum($skor)/$jumlaharray),2,'.',',');
			}else{
				echo "0";
			}
		?>
		</td>
		<td align="center" colspan="3">
			<?php $r = array_search($idsiswa, $rankkelas);?>
			Rangking <?php echo !empty($rankkelas) ? ($r+1) : 0 ?> dari <?php echo count($rankkelas)?> Siswa</td>
	</tr>
</table>
<p>&nbsp;</p>
<table class="" style="width: 18.5cm; background-color: red;">
	<tr>
		<td style="color: white;" align="center"><h4 style="margin: 0.2cm;">LEARNING STYLE TEST</h4></td>
	</tr>
</table>

<table class="" style="width: 18.5cm;">
	<tr>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
		<th style="text-align:center;">Skor</th>
		<th>Dominasi : 
		<span class="hasil">
		<?php
			if($dominasi == "V"){
				echo "VISUAL";
			}elseif($dominasi == "A"){
				echo "AUDITORI";
			}elseif($dominasi == "K"){
				echo "KINESTETIK";
			}elseif($dominasi == "VA"){
				echo "VISUAL - AUDITORI";
			}elseif($dominasi == "VK"){
				echo "VISUAL - KINESTETIK";
			}elseif($dominasi == "AK"){
				echo "AUDITORI - KINESTETIK";
			}
		?>
		</span></th>
	</tr>
	<tr>
		<td><img src="<?php echo html_entity_decode(preg_replace("/&#?[a-z0-9]+;/i","",str_replace('http://primemobile.co.id/','',base_url('assets/dashboard/images/visual.jpg'))));?>" style="height: 1cm;"></td>
		<td>VISUAL</td>
		<td style="text-align: center;"><?php echo $totalv; ?></td>
		<td style="text-align: center;">
			<?php echo number_format($persenv, 2, ',', ''); ?>%
		</td>
	  </tr>
	  <tr>
		<td><img src="<?php echo html_entity_decode(preg_replace("/&#?[a-z0-9]+;/i","",str_replace('http://primemobile.co.id/','',base_url('assets/dashboard/images/auditori.jpg'))));?>" style="height: 1cm;"></td>
		<td>AUDITORI</td>
		<td style="text-align: center;"><?php echo $totala; ?></td>
		<td style="text-align: center;">
			<?php echo number_format($persena, 2, ',', ''); ?>%
		</td>
	  </tr>
	  <tr>
		<td><img src="<?php echo html_entity_decode(preg_replace("/&#?[a-z0-9]+;/i","",str_replace('http://primemobile.co.id/','',base_url('assets/dashboard/images/kinestetik.jpg'))));?>" style="height: 1cm;"></td>
		<td>KINESTETIK</td>
		<td style="text-align: center;"><?php echo $totalk; ?></td>
		<td style="text-align: center;">
			<?php echo number_format($persenk, 2, ',', ''); ?>%
		  </div>
		</td>
	  </tr>
</table>
<p>&nbsp;</p>
<table class="" style="width: 18.5cm; background-color: red;">
	<tr>
		<td style="color: white;" align="center"><h4 style="margin: 0.2cm;">PSYCHOLOGY POTENTIAL TEST</h4></td>
	</tr>
</table>
<table class="table bordered" style="width: 18.5cm;">
  <tr>
	<th>&nbsp;</th>
	<th>&nbsp;</th>
	<th style="text-align:center;">Skor</th>
	<th>Kategori</th>
  </tr>
  <tr>
	<td><img src="<?php echo html_entity_decode(preg_replace("/&#?[a-z0-9]+;/i","",str_replace('http://primemobile.co.id/','',base_url('assets/dashboard/images/aq.jpg'))));?>" style="height: 1cm;"></td>
	<td>AQ (ADVERSITY QUOTIENT) - DAYA JUANG</td>
	<td><?php echo $skor_aq; ?></td>
	<td><?php
		if($skor_aq < 7){
			echo "Rendah";
		}elseif($skor_aq <= 11){
			echo "Rata-Rata Bawah";
		}elseif($skor_aq <= 21){
			echo "Rata-Rata";
		}elseif($skor_aq <= 26){
			echo "Rata-Rata Atas";
		}elseif($skor_aq <= 32){
			echo "Tinggi";
		}
	?></td>
  </tr>
  <tr>
	<td><img src="<?php echo html_entity_decode(preg_replace("/&#?[a-z0-9]+;/i","",str_replace('http://primemobile.co.id/','',base_url('assets/dashboard/images/eq.jpg'))));?>" style="height: 1cm;"></td>
	<td>EQ (EMOTIONAL QUOTIENT) - KECERDASAN EMOSI</td>
	<td><?php echo $skor_eq; ?></td>
	<td>
	<?php
	if($skor_eq < 7){
		echo "Rendah";
	}elseif($skor_eq <= 11){
		echo "Rata-Rata Bawah";
	}elseif($skor_eq <= 21){
		echo "Rata-Rata";
	}elseif($skor_eq <= 26){
		echo "Rata-Rata Atas";
	}elseif($skor_eq <= 32){
		echo "Tinggi";
	}
	?>
	</td>
  </tr>
  <tr>
	<td><img src="<?php echo html_entity_decode(preg_replace("/&#?[a-z0-9]+;/i","",str_replace('http://primemobile.co.id/','',base_url('assets/dashboard/images/am.jpg'))));?>" style="height: 1cm;"></td>
	<td>AM (ACHIEVEMENT MOTIVATION) - MOTIVASI BERPRESTASI</td>
	<td><?php echo $skor_am; ?></td>
	<td>
	<?php
	if($skor_am < 7){
		echo "Rendah";
	}elseif($skor_am <= 11){
		echo "Rata-Rata Bawah";
	}elseif($skor_am <= 21){
		echo "Rata-Rata";
	}elseif($skor_am <= 26){
		echo "Rata-Rata Atas";
	}elseif($skor_am <= 32){
		echo "Tinggi";
	}
	?>
	</td>
  </tr>
</table>

<p>&nbsp;</p>
<table class="" style="width: 18.5cm; background-color: red;">
	<tr>
		<td style="color: white;" align="center"><h4 style="margin: 0.2cm;">LEARNING STYLE ANALISYS RESULT</h4></td>
	</tr>
</table>

<table style="width: 18.5cm;">
	<tr>
		<td style="text-align: center;">
			<?php
			if($dominasi == "V"){
			?>
			<img src="<?php echo html_entity_decode(preg_replace("/&#?[a-z0-9]+;/i","",str_replace('http://primemobile.co.id/','',base_url('assets/dashboard/images/visual.jpg'))));?>" style="height: 1cm;">
			<h5>VISUAL</h5>
			<?php
			}elseif($dominasi == "A"){
			?>
			<img src="<?php echo html_entity_decode(preg_replace("/&#?[a-z0-9]+;/i","",str_replace('http://primemobile.co.id/','',base_url('assets/dashboard/images/auditori.jpg'))));?>" style="height: 1cm;">
			<h5>AUDITORI</h5>
			<?php
			}elseif($dominasi == "K"){
			?>
			<img src="<?php echo html_entity_decode(preg_replace("/&#?[a-z0-9]+;/i","",str_replace('http://primemobile.co.id/','',base_url('assets/dashboard/images/kinestetik.jpg'))));?>" style="height: 1cm;">
			<h5>KINESTETIK</h5>
			<?php
			}elseif($dominasi == "VA"){
			?>
			<img src="<?php echo html_entity_decode(preg_replace("/&#?[a-z0-9]+;/i","",str_replace('http://primemobile.co.id/','',base_url('assets/dashboard/images/visual.jpg'))));?>" style="height: 1cm;">
			<img src="<?php echo html_entity_decode(preg_replace("/&#?[a-z0-9]+;/i","",str_replace('http://primemobile.co.id/','',base_url('assets/dashboard/images/auditori.jpg'))));?>" style="height: 1cm;">
			<h5>VISUAL-AUDITORI</h5>
			<?php
			}elseif($dominasi == "VK"){
			?>
			<img src="<?php echo html_entity_decode(preg_replace("/&#?[a-z0-9]+;/i","",str_replace('http://primemobile.co.id/','',base_url('assets/dashboard/images/visual.jpg'))));?>" style="height: 1cm;">
			<img src="<?php echo html_entity_decode(preg_replace("/&#?[a-z0-9]+;/i","",str_replace('http://primemobile.co.id/','',base_url('assets/dashboard/images/kinestetik.jpg'))));?>" style="height: 1cm;">
			<h5>VISUAL-KINESTETIK</h5>
			<?php
			}elseif($dominasi == "AK"){
			?>
			<img src="<?php echo html_entity_decode(preg_replace("/&#?[a-z0-9]+;/i","",str_replace('http://primemobile.co.id/','',base_url('assets/dashboard/images/auditori.jpg'))));?>" style="height: 1cm;">
			<img src="<?php echo html_entity_decode(preg_replace("/&#?[a-z0-9]+;/i","",str_replace('http://primemobile.co.id/','',base_url('assets/dashboard/images/kinestetik.jpg'))));?>" style="height: 1cm;">
			<h5>AUDITORI-KINESTETIK</h5>
			<?php
			}
			?>
		</td>
	</tr>
	<tr>
		<td style="text-align: center;">
		Berdasarkan data dan Modalitas Belajar di atas, maka yang menonjol adalah kemampuan 
			  <?php
				if($dominasi == "V"){
					echo "VISUAL";
				}elseif($dominasi == "A"){
					echo "AUDITORI";
				}elseif($dominasi == "K"){
					echo "KINESTETIK";
				}elseif($dominasi == "VA"){
					echo "VISUAL - AUDITORI";
				}elseif($dominasi == "VK"){
					echo "VISUAL - KINESTETIK";
				}elseif($dominasi == "AK"){
					echo "AUDITORI - KINESTETIK";
				}
				?>.<br/>
				Putra - putri Bapak/Ibu adalah Pelajar dengan tipe
				<?php
				if($dominasi == "V"){
					echo "VISUAL";
				}elseif($dominasi == "A"){
					echo "AUDITORI";
				}elseif($dominasi == "K"){
					echo "KINESTETIK";
				}elseif($dominasi == "VA"){
					echo "VISUAL - AUDITORI";
				}elseif($dominasi == "VK"){
					echo "VISUAL - KINESTETIK";
				}elseif($dominasi == "AK"){
					echo "AUDITORI - KINESTETIK";
				}
				?>
				. Dengan karakteristik umum dan pola belajar serta metode belajar yang tepat, sebagai berikut.</p>
		</td>
	</tr>
	<tr>
		<td>
			<b>Karakteristik : </b>
			<br><?php echo $karakteristik; ?>
		</td>
	</tr>
	<tr>
		<td>
			<b>Saran dan Strategi Belajar :</b>
			<br><?php echo $saran; ?>
		</td>
	</tr>
</table>

<p>&nbsp;</p>
<table class="" style="width: 18.5cm; background-color: red;">
	<tr>
		<td style="color: white;" align="center"><h4 style="margin: 0.2cm;">PSYCOLOGY POTENTIAL TEST ANALISYS RESULT</h4></td>
	</tr>
</table>

<table class="table bordered" style="width: 18.5cm;">
	<tr>
		<td style="text-align: right;">AQ (ADVERSITY QUOTIENT) <br/><b>DAYA JUANG</b></td>
		<td> Hasil : 
		<?php
		if($skor_aq < 7){
			echo "Rendah";
		}elseif($skor_aq <= 11){
			echo "Rata-Rata Bawah";
		}elseif($skor_aq <= 21){
			echo "Rata-Rata";
		}elseif($skor_aq <= 26){
			echo "Rata-Rata Atas";
		}elseif($skor_aq <= 32){
			echo "Tinggi";
		}
		?>
		</td>
	</tr>
	<tr>
		<td style="text-align: right;"><img src="<?php echo html_entity_decode(preg_replace("/&#?[a-z0-9]+;/i","",str_replace('http://primemobile.co.id/','',base_url('assets/dashboard/images/aqBlue.jpg'))));?>" style="height: 1cm;"></td>
		<td>
			<?php echo $analisis_aq;?>
		</td>
	</tr>
	<tr>
		<td style="text-align: right;">EQ (EMOTIONAL QUOTIENT) <br/><b>KECERDASAN EMOSI</b></td>
		<td> Hasil : 
		<?php
		if($skor_eq < 7){
			echo "Rendah";
		}elseif($skor_eq <= 11){
			echo "Rata-Rata Bawah";
		}elseif($skor_eq <= 21){
			echo "Rata-Rata";
		}elseif($skor_eq <= 26){
			echo "Rata-Rata Atas";
		}elseif($skor_eq <= 32){
			echo "Tinggi";
		}
		?>
		</td>
	</tr>
	<tr>
		<td style="text-align: right;"><img src="<?php echo html_entity_decode(preg_replace("/&#?[a-z0-9]+;/i","",str_replace('http://primemobile.co.id/','',base_url('assets/dashboard/images/eqBlue.jpg'))));?>" style="height: 1cm;"></td>
		<td>
			<?php echo $analisis_eq;?>
		</td>
	</tr>
	<tr>
		<td style="text-align: right;">AM (ACHIEVEMENT MOTIVATION) <br/><b>MOTIVASI BERPRESTASI</b></td>
		<td> Hasil : 
		<?php
		if($skor_am < 7){
			echo "Rendah";
		}elseif($skor_am <= 11){
			echo "Rata-Rata Bawah";
		}elseif($skor_am <= 21){
			echo "Rata-Rata";
		}elseif($skor_am <= 26){
			echo "Rata-Rata Atas";
		}elseif($skor_am <= 32){
			echo "Tinggi";
		}
		?>
		</td>
	</tr>
	<tr>
		<td style="text-align: right;"><img src="<?php echo html_entity_decode(preg_replace("/&#?[a-z0-9]+;/i","",str_replace('http://primemobile.co.id/','',base_url('assets/dashboard/images/amBlue.jpg'))));?>" style="height: 1cm;"></td>
		<td>
			<?php echo $analisis_am;?>
		</td>
	</tr>
</table>

<p>&nbsp;</p>
<table class="" style="width: 18.5cm; background-color: red;">
	<tr>
		<td style="color: white;" align="center"><h4 style="margin: 0.2cm;">DIAGNOSTIC TEST</h4></td>
	</tr>
</table>
<?php
	$clr = array('c65304','14ab1d','3a41a0','36A2EB');
	$w = 0;
	foreach($kategoridiagnostic as $diagnostic){								
?>
<div class="hasil-nilai-container">
		<h4 style="background:#<?php echo $clr[$w]; ?>; color: white;"><?php echo $diagnostic->nama_kategori; ?></h4>
		<table class="table bordered">
			<thead>
				<tr>
					<th width="75%" style="text-align: center;">INDIKATOR</th>
					<th width="25%" style="text-align: center;">KETUNTASAN</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($analisistopik as $analisis){
						if($analisis->id_diagnostic == $diagnostic->id_diagnostic){
				?>
					<tr>
						<td>
							<?php echo $analisis->topik; ?>
						</td>
						<td style="text-align: center;">
							<?php
								if($analisis->status == 1){
									echo "<span style='color: green;'>Tuntas</span>";
								}else{
									echo "<span style='color: red;'>Belum Tuntas</span>";
								}
							?>
						</td>
					</tr>
				<?php
						}
					}
				?>
				
			</tbody>
		</table>

		<table class="table bordered" style="width:18.5cm;">
			<tr>
				<th style="text-align:center">Nilai</th>
				<th style="text-align:center">Kategori</th>
			</tr>
			<tr>
				<td align="center"><?php echo $skor[$diagnostic->id_diagnostic] ;?></td>
				<td align="center"><?php echo $kategori[$diagnostic->id_diagnostic];?></td>
			</tr>
		</table>
		<table class="table bordered" style="width:18.5cm;">
			<tr>
				<th style="text-align:center" colspan="3">Ketuntasan</th>
			</tr>
			<tr>
				<td align="center" width="33.33%">Tuntas</td>
				<td align="center" width="33.33%">
				<?php
				if(isset($soalbenar[$diagnostic->id_diagnostic])){
					echo $soalbenar[$diagnostic->id_diagnostic];
				}else{
					echo 0;
				}
				?> Soal
				</td>
				<td align="center" width="33.33%">
				<?php echo $skor[$diagnostic->id_diagnostic] ;?> %
				</td>
			</tr>
			<tr>
				<td align="center">Belum Tuntas</td>
				<td align="center">
				<?php
				if(isset($soalsalah[$diagnostic->id_diagnostic])){
					echo $soalsalah[$diagnostic->id_diagnostic];
				}else{
					echo $jumlahsoalasli[$diagnostic->id_diagnostic];
				}
				?> Soal
				</td>
				<td align="center">
				<?php echo 100-$skor[$diagnostic->id_diagnostic] ;?> %
				</td>
			</tr>
		</table>
</div>
<?php
	$w++;
	}
?>
<!-- END ANALISIS TOPIK -->
</body>