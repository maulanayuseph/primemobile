<?php if ($ispdf == 0){ ?>
<?php include('header_dashboard.php'); ?>
<?php } else { ?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $judul; ?></title>
<link href="<?php echo base_url('assets/dashboard/css/bootstrap.min.css');?>" rel="stylesheet">
<link href="<?php echo base_url('assets/dashboard/css/style.css');?>" rel="stylesheet">
</head>
<body onload="window.print()">
<?php } ?>

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
	
	$persenv = ($totalv / $total) * 100;
	$persena = ($totala / $total) * 100;
	$persenk = ($totalk / $total) * 100;
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
?>
    <div class="container-fluid stat-wrapper" style="padding: 70px 10% 0;">
	  <h1 style="background:none;color:#000;font-size:24px;text-align:center;padding-bottom:20px;border-bottom:solid 1px #ddd;">AGCU REPORT</h1>	
      <div class="diagnistic-wrapper">
        <h1>DIAGNOSTIC TEST</h1>
		
        <div class="diagnistic-container">
          <?php if ($ispdf == 0){ ?>
          <div class="grafik">
		  <canvas id="myChart" width="400" height="400"></canvas>
		  </div>
		  <?php } ?>
          <table class="table" <?php if ($ispdf > 0){ echo 'style="width:100%"'; } ?>>
            <tr class="diagnistic-title">
              <th>Bid. Studi</th>
              <th>Nilai</th>
              <th>Rata-rata Kelas</th>
              <th>Rank. Bid Studi</th>
              <th>Kategori</th>
            </tr>
            <?php
				foreach($kategoridiagnostic as $diagnostic){
			?>
				<tr>
					<td>
						<?php echo $diagnostic->nama_kategori; ?>
					</td>
					<td>
						<?php
							
							echo number_format($skor[$diagnostic->id_diagnostic], 2, '.', ',');
						?>
					</td>
					<td>
						<?php 
						if(isset($average[$diagnostic->id_diagnostic])){
							echo number_format($average[$diagnostic->id_diagnostic], 2, '.', ',');
						}else{
							echo 0;
						}
						; 
						
						?>
					</td>
					<td>
						<?php 
							echo (array_search($_SESSION['id_ortu_siswa'], $rank[$diagnostic->id_diagnostic])) + 1;
						?> 
					</td>
					<td>
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
				<td><?php 
				if($skor !== 0){
					echo array_sum($skor);
				}else{
					echo "0";
				}
				?></td>
				<td style="text-align: center;" colspan="3">Peringkat</td>
			</tr>
			<tr>
				<td>Nilai Rata-rata</td>
				<td>
				<?php
					if($skor !== 0){
						$jumlaharray = count($skor);
						echo number_format(array_sum($skor)/$jumlaharray,2,'.',',');
					}else{
						echo "0";
					}
				?>
				</td>
				<td style="text-align: center;" colspan="3">
					<?php $r = array_search($_SESSION['id_ortu_siswa'], $rankkelas);?>
					Rangking <?php echo !empty($rankkelas) ? ($r+1) : 0 ?> dari <?php echo count($rankkelas)?> Siswa</td>
			</tr>
          </table>
        </div>
      </div>

      <div class="learn-wrapper">
        <h1>LEARNING STYLE</h1>
        <table class="table">
          <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th style="text-align:center;">Skor</th>
            <th>Dominasi
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
            <td><img src="<?php echo base_url('assets/dashboard/images/visual.jpg');?>"></td>
            <td>VISUAL</td>
            <td><?php echo $totalv; ?></td>
            <td>
              <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $persenv; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persenv; ?>%;">
                  <span class="sr-only"><?php echo $persenv; ?>%</span>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td><img src="<?php echo base_url('assets/dashboard/images/auditori.jpg');?>"></td>
            <td>AUDITORI</td>
            <td><?php echo $totala; ?></td>
            <td>
              <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $persena; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persena; ?>%;">
                  <span class="sr-only"><?php echo $persena; ?>%</span>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td><img src="<?php echo base_url('assets/dashboard/images/kinestetik.jpg');?>"></td>
            <td>KINESTETIK</td>
            <td><?php echo $totalk; ?></td>
            <td>
              <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $persenk; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persenk; ?>%;">
                  <span class="sr-only"><?php echo $persenk; ?>%</span>
                </div>
              </div>
            </td>
          </tr>
        </table>
      </div>

      <div class="eq-wrapper">
        <h1>PSYCHOLOGY POTENTIAL TEST</h1>
        <table class="table">
          <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th style="text-align:center;">Skor</th>
            <th>Kategori</th>
          </tr>
          <tr>
            <td><img src="<?php echo base_url('assets/dashboard/images/aq.jpg');?>"></td>
            <td>AQ (ADVERSITY QUOTIENT) - DAYA JUANG</td>
            <td><?php echo $data_eq->skor_aq; ?></td>
            <td><?php
				if($data_eq->skor_aq < 7){
					echo "Rendah";
				}elseif($data_eq->skor_aq <= 11){
					echo "Rata-Rata Bawah";
				}elseif($data_eq->skor_aq <= 21){
					echo "Rata-Rata";
				}elseif($data_eq->skor_aq <= 26){
					echo "Rata-Rata Atas";
				}elseif($data_eq->skor_aq <= 32){
					echo "Tinggi";
				}
			?></td>
          </tr>
          <tr>
            <td><img src="<?php echo base_url('assets/dashboard/images/eq.jpg');?>"></td>
            <td>EQ (EMOTIONAL QUOTIENT) - KECERDASAN EMOSI</td>
            <td><?php echo $data_eq->skor_eq; ?></td>
            <td>
			<?php
			if($data_eq->skor_eq < 7){
				echo "Rendah";
			}elseif($data_eq->skor_eq <= 11){
				echo "Rata-Rata Bawah";
			}elseif($data_eq->skor_eq <= 21){
				echo "Rata-Rata";
			}elseif($data_eq->skor_eq <= 26){
				echo "Rata-Rata Atas";
			}elseif($data_eq->skor_eq <= 32){
				echo "Tinggi";
			}
			?>
			</td>
          </tr>
          <tr>
            <td><img src="<?php echo base_url('assets/dashboard/images/am.jpg');?>"></td>
            <td>AM (ACHIEVEMENT MOTIVATION) - MOTIVASI BERPRESTASI</td>
            <td><?php echo $data_eq->skor_am; ?></td>
            <td>
			<?php
			if($data_eq->skor_am < 7){
				echo "Rendah";
			}elseif($data_eq->skor_am <= 11){
				echo "Rata-Rata Bawah";
			}elseif($data_eq->skor_am <= 21){
				echo "Rata-Rata";
			}elseif($data_eq->skor_am <= 26){
				echo "Rata-Rata Atas";
			}elseif($data_eq->skor_am <= 32){
				echo "Tinggi";
			}
			?>
			</td>
          </tr>
        </table>
      </div>

      <div class="nilai-wrapper">
        <h2>STATISTIK NILAI</h2>
        <div class="nilai-container">
          <table class="table">
            <tr class="nilai-title">
              <th>Mata Pelajaran</th>
              <th>Nilai Tertinggi</th>
              <th>Nilai Terendah</th>
              <th>Nilai Rata - rata</th>
            </tr>
            <?php 
            	$tabelhex = array('#fabdbe','#fee7b9','#bad1e4','#dbedc5','#ead9ea','#e3c9e1');
            	foreach ($kategoridiagnostic as $diagnostic) {
            		$currentskor = $skor_maxmin[$diagnostic->id_diagnostic];
            		$skor_max = reset($skor_maxmin[$diagnostic->id_diagnostic]); 
            		$skor_min = end($skor_maxmin[$diagnostic->id_diagnostic]);
            		$skor_rata = round(array_sum($currentskor) / count($currentskor), 2);
            	?>
	            <tr>
	              <td style="background-color:<?php echo current($tabelhex); next($tabelhex)?>;"><?php echo $diagnostic->nama_kategori?></td>
	              <td><?php echo $skor_max?></td>
	              <td><?php echo $skor_min?></td>
	              <td><?php echo $skor_rata?></td>
	            </tr>
            	<?php
            	}
            ?>
          </table>
          <div class="nilai-images">
            <div class="top">
				<div class="ranking" style="margin:0;">Ranking Kelas <br/><span><?php echo !empty($rankkelas) ? ($r+1) : 0 ?> dari <?php echo count($rankkelas)?> Siswa</td></span></div>
				<div class="bottom" style="padding: 10px 0px 0px 15px;">
				  <h6 style="padding:0;">PREDIKAT</h6>
				  <h5>PERLU BIMBINGAN <br>
				  <?php 
				  if($skor !== 0){
						echo round((array_sum($skor) / count($skor)), 2);
					}else{
						echo "0";
					}
				  
				  ?>%
				  </h5>
				</div>
            </div>
          </div>
        </div>
        <div class="row">
    		<?php 
			$panelhex = array('#ed2429','#fbb116','#1b67a6','#87c440','#ba80b8','#a24b9d');
			foreach ($kategoridiagnostic as $diagnostic) {
				?>
				<div class="col-lg-4">
					<div class="persentase" style="width:100%;">
						<h3 style="background-color:<?php echo current($panelhex); next($panelhex)?>;"><?php echo strtoupper($diagnostic->nama_kategori)?></h3>
						<h4><?php echo $skor[$diagnostic->id_diagnostic]; ?>%
						</h4>
					</div>
				</div>
				<?php
			}
        	?>
        </div>
      </div>

      <div class="analisa-learn-wrapper">
        <h2>HASIL ANALISA "LEARNING STYLE"</h2>
        <div class="result">
          <div class="title">
			<?php
			if($dominasi == "V"){
			?>
			<img src="<?php echo base_url('assets/dashboard/images/visual.jpg');?>">
            <h5>VISUAL</h5>
			<?php
			}elseif($dominasi == "A"){
			?>
			<img src="<?php echo base_url('assets/dashboard/images/auditori.jpg');?>">
            <h5>AUDITORI</h5>
			<?php
			}elseif($dominasi == "K"){
			?>
			<img src="<?php echo base_url('assets/dashboard/images/kinestetik.jpg');?>">
            <h5>KINESTETIK</h5>
			<?php
			}elseif($dominasi == "VA"){
			?>
			<img src="<?php echo base_url('assets/dashboard/images/visual.jpg');?>">
			<img src="<?php echo base_url('assets/dashboard/images/auditori.jpg');?>">
            <h5>VISUAL-AUDITORI</h5>
			<?php
			}elseif($dominasi == "VK"){
			?>
			<img src="<?php echo base_url('assets/dashboard/images/visual.jpg');?>">
			<img src="<?php echo base_url('assets/dashboard/images/kinestetik.jpg');?>">
            <h5>VISUAL-KINESTETIK</h5>
			<?php
			}elseif($dominasi == "AK"){
			?>
			<img src="<?php echo base_url('assets/dashboard/images/auditori.jpg');?>">
			<img src="<?php echo base_url('assets/dashboard/images/kinestetik.jpg');?>">
            <h5>AUDITORI-KINESTETIK</h5>
			<?php
			}
			?>
            
          </div>
          <p>Berdasarkan data dan Modalitas Belajar di atas, maka yang menonjol adalah kemampuan 
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
        </div>
        <div class="desc">
          <div class="title">KARAKTERISTIK</div>
          <div class="content">
           <?php echo $karakteristik; ?>
          </div>
        </div>
        <div class="desc">
          <div class="title">SARAN STRATEGI BELAJAR</div>
          <div class="content">
            <?php echo $saran; ?>
          </div>
        </div>
      </div>

      <div class="analisa-eq-wrapper">
        <h2>HASIL ANALISA TES "PSYCHOLOGY POTENTIAL TEST"</h2>
        <div class="analisa-eq">
          <div class="top">
            <img src="<?php echo base_url('assets/dashboard/images/aqBlue.jpg');?>">
            <div class="title">AQ (ADVERSITY QUOTIENT) <br/><b>DAYA JUANG</b></div>
            <div class="result">
			<?php
				if($data_eq->skor_aq < 7){
					echo "Rendah";
				}elseif($data_eq->skor_aq <= 11){
					echo "Rata-Rata Bawah";
				}elseif($data_eq->skor_aq <= 21){
					echo "Rata-Rata";
				}elseif($data_eq->skor_aq <= 26){
					echo "Rata-Rata Atas";
				}elseif($data_eq->skor_aq <= 32){
					echo "Tinggi";
				}
			?>
			</div>
          </div>
          <div class="content">
            <?php echo $analisis_aq;?>
          </div>
        </div>
        <div class="analisa-eq">
          <div class="top">
            <img src="<?php echo base_url('assets/dashboard/images/eqBlue.jpg');?>">
            <div class="title">EQ (EMOTIONAL QUOTIENT) <br/><b>KECERDASAN EMOSI</b></div>
            <div class="result">
			<?php
			if($data_eq->skor_eq < 7){
				echo "Rendah";
			}elseif($data_eq->skor_eq <= 11){
				echo "Rata-Rata Bawah";
			}elseif($data_eq->skor_eq <= 21){
				echo "Rata-Rata";
			}elseif($data_eq->skor_eq <= 26){
				echo "Rata-Rata Atas";
			}elseif($data_eq->skor_eq <= 32){
				echo "Tinggi";
			}
			?>
			</div>
          </div>
          <div class="content">
            <?php echo $analisis_eq;?>
          </div>
        </div>
        <div class="analisa-eq">
          <div class="top">
            <img src="<?php echo base_url('assets/dashboard/images/amBlue.jpg');?>">
            <div class="title">AM (ACHIEVEMENT MOTIVATION) <br/><b>MOTIVASI BERPRESTASI</b></div>
            <div class="result">
			<?php
			if($data_eq->skor_am < 7){
				echo "Rendah";
			}elseif($data_eq->skor_am <= 11){
				echo "Rata-Rata Bawah";
			}elseif($data_eq->skor_am <= 21){
				echo "Rata-Rata";
			}elseif($data_eq->skor_am <= 26){
				echo "Rata-Rata Atas";
			}elseif($data_eq->skor_am <= 32){
				echo "Tinggi";
			}
			?>
			</div>
          </div>
          <div class="content">
            <?php echo $analisis_am;?>
          </div>
        </div>
      </div>

      <div class="analisa-diagnostic-wrapper">
        <h2>HASIL ANALISA "DIAGNOSTIC TEST"</h2>
        <div class="title">
          <h5>DIAGNOSTIC TEST</h5>
          <h6>PERLU BIMBINGAN</h6>
        </div>
        <div class="content">
          Dari dianosa kemampuan awalmateri uji Academic General Check Up (AGCU), bidang studi Matematika, Bahasa Indonesia, Bahasa Inggris, Fisika, dan Biologi, secara umum hasilnya masih rendah, sehingga perlu dipersiapkan sejak dini dan dilakukan pengulanganbeberapa materi, sehingga diharapkan siswa mampu memahami kelemahannya dan berusaha terus belajar. Beberapa materi uji AGCU ini masih belum tuntas dan belum memenuhi target awal. Nilai bidang studi (Matematika, Bahasa Inggris, Fisika) masih belum tuntas.
        </div>
      </div>
      <div class="hasil-nilai-wrapper">
         <!-- ANALISIS TOPIK -->
	    <?php
			foreach($kategoridiagnostic as $diagnostic){
		?>
		<div class="hasil-nilai-container">
				<h4><?php echo $diagnostic->nama_kategori; ?></h4>
				<table class="table table-striped">
					<thead>
						<tr>
							<th width="75%" style="text-align: center;">INDIKATOR</th>
							<th colspan="2" width="25%" style="text-align: center;">KETUNTASAN</th>
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
								<td>
									<?php
										if($analisis->status == 1){
											echo "Tuntas";
										}else{
											echo "Belum Tuntas";
										}
									?>
								</td>
								<td style="text-align: center;">
									<?php
										if($analisis->status == 1){
											echo '<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true" style="color: green"></span>';
										}else{
											echo '<span class="glyphicon glyphicon-thumbs-down" aria-hidden="true" style="color: red"></span>';
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
				<table class="table-result table">
					<tr>
						<td class="col-md-2 empty">&nbsp;</td>
						<td class="col-md-2">Nilai</td>
						<td class="col-md-1">
						<?php echo $skor[$diagnostic->id_diagnostic] ;?>
						</td>
						<td class="col-md-3">Tuntas</td>
						<td class="col-md-2">
						
						<?php
						if(isset($soalbenar[$diagnostic->id_diagnostic])){
							echo $soalbenar[$diagnostic->id_diagnostic];
						}else{
							echo 0;
						}
						?> Soal
						
						</td>
						<td class="col-md-2">
						<?php echo $skor[$diagnostic->id_diagnostic] ;?> %
						</td>
					</tr>
					<tr>
						<td class="col-md-2 empty">&nbsp;</td>
						<td class="col-md-2">Kategori</td>
						<td class="col-md-1">
						<?php echo $kategori[$diagnostic->id_diagnostic];?>
						</td>
						<td class="col-md-3">Belum Tuntas</td>
						<td class="col-md-2">
						<?php
						if(isset($soalsalah[$diagnostic->id_diagnostic])){
							echo $soalsalah[$diagnostic->id_diagnostic];
						}else{
							echo $jumlahsoalasli[$diagnostic->id_diagnostic];
						}
						?> Soal
						</td>
						
						<td class="col-md-2">
						<?php echo 100-$skor[$diagnostic->id_diagnostic] ;?> %
						</td>
					</tr>
				</table>
		</div>
		<?php
			}
		?>
	<!-- END ANALISIS TOPIK -->

    <?php if ($ispdf == 0){ ?>   
	<center><a href="<?php echo base_url('parents/report_agcu/1')?>" class="btn btn-primary" target="_blank">Print Report</a></center>
	<?php } ?>
	<br /><br /><br /><br />
	
    </div>
	</div>

<?php if ($ispdf == 0){ ?>
	
	<?php include('footer.php'); ?>

  <script src="js/jquery1.11.0.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/init.js"></script>
  <div id="edit-profile" class="edit-profile-wrapper">
    <div class="edit-profile-container">
      <div class="header"><img src="images/logo.png"></div>
      <h4>Lengkapi Profil Anda</h4><a href="javascript:;" class="close"><span class="glyphicon glyphicon-remove"></span></a>
      <form id="edit-profile-form" class="edit-profile-form">
        <div class="form-group">
          <div class="label-style required">Nama</div>
          <input class="input-style form-control" type="text" id="name" name="name" placeholder="Nama">
        </div>
        <div class="form-group">
          <div class="label-style">Tanggal Lahir</div>
          <input class="input-style form-control" type="text" id="datebirth" name="datebirth" placeholder="Tanggal Lahir">
        </div>
        <div class="form-group">
          <div class="label-style">Nomor HP</div>
          <input class="input-style form-control" type="text" id="phone" name="phone" placeholder="Nomor HP">
        </div>
        <div class="form-group">
          <div class="label-style required">Email</div>
          <input class="input-style form-control" type="text" id="email" name="email" placeholder="Email">
        </div>
        <div class="form-group">
          <div class="label-style required">Jenis Kelamin</div>
          <select class="form-control input-style" id="gender" name="gender">
              <option value="laki">Laki - laki</option><option value="perempuan">Perempuan</option>               
          </select>
        </div>
        <div class="form-group">
          <div class="label-style required">Alamat (Domisili)</div>
          <input class="input-style form-control" type="text" id="address" name="address" placeholder="Alamat">
        </div>
        <div class="form-group">
          <div class="label-style required">Kelas/Tingkat</div>
          <input class="input-style form-control" type="text" id="class" name="class" placeholder="KELAS XI IPA">
        </div>
        <div class="form-group">
          <div class="label-style required">Sekolah</div>
          <input class="input-style form-control" type="text" id="school" name="school" placeholder="Sekolah">
        </div>
        <div class="form-group">
          <div class="label-style">Ganti Foto</div>
          <input class="input-style" type="file" id="exampleInputFile">
        </div>
        <div class="form-group">
          <div class="label-style">&nbsp;</div>
          <div class="input-style form-thanks">Thank you for submitting your booking with us, this is not a confirmation for your booking, our reservation staff will contact you through your email within 24 hours. Please also check your SPAM or JUNK mail.</div>
        </div>
        <div class="form-group">
          <div class="label-style">&nbsp;</div>
          <button name="csubmit" type="submit" class="btn btn-primary">Submit</button>&nbsp;<button id="Rreset" name="rreset" type="reset" class="btn btn-warning">Reset</button>
        </div>
      </form>
    </div>
  </div>
  <script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>
  
  <script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>"></script>
  <script type="text/javascript" charset="utf-8">
    $(window).load(function(){
 
    });
  </script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/Chart.js');?>"></script>
  <script>
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
		<?php
		foreach($kategoridiagnostic as $diagnostic){
			echo '"'.$diagnostic->nama_kategori.'",';
		}
		?>
		],
        datasets: [{
            label: '# Nilai Mata Pelajaran',
            data: [
			<?php
			foreach($kategoridiagnostic as $diagnostic){
				echo $skor[$diagnostic->id_diagnostic].",";
			}
			?>
			],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
<?php } ?>

  </body>
</html>
