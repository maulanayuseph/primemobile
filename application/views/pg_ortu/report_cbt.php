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
$x = 1;
foreach($dataperingkat as $peringkat){
	$skor[$x] =round(($peringkat->jumlah_bobot_benar/$peringkat->jumlah_bobot)*100, 2);
	$nilai[$x] =$peringkat->jumlah_bobot_benar;
	if($peringkat->id_siswa == $_SESSION['id_ortu_siswa']){
		$skorsaya = round(($peringkat->jumlah_bobot_benar/$peringkat->jumlah_bobot)*100, 2);
		$nilaisaya = $peringkat->jumlah_bobot_benar;
		
		$peringkatsaya = $x;
	}
	
	$x++;
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
    <div class="hasil-wrapper">
	  <?php if ($tipereport == 'hasil' || $tipereport == 'all'){ ?>
	  <h1 style="background:none;color:#000;font-size:24px;text-align:center;padding-bottom:20px;border-bottom:solid 1px #ddd;">CBT REPORT</h1>	
	  <?php } else if ($tipereport == 'peringkat'){ ?>
	  <h1 style="background:none;color:#000;font-size:24px;text-align:center;padding-bottom:20px;border-bottom:solid 1px #ddd;">PERINGKAT CBT</h1>	
	  <?php } ?>

      <div class="hasil-left">
        <h3><?php echo $aliaskelas->nama_profil; ?></h3>
        <h5>AKTIFITAS PROGRESS</h5>
        <?php if ($ispdf == 0){ ?>
        <canvas id="myChart" style="width: 200px; height: 200px; margin-bottom: 30px;"></canvas>
        <?php } ?>
        <h5>DAFTAR SEMUA MATERI</h5>
        <ul class="materi">
		  
		  <?php foreach($analisis_mapel as $statmapel){
			?>
			<li>
			<h6><span class="glyphicon glyphicon-play"></span><?php echo $statmapel->nama_kategori; ?></h6>
			<div class="progress">
			  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round(($statmapel->jumlah_bobot_benar/$statmapel->jumlah_bobot)*100)."%"; ?>;">
			  </div>
			</div>
			</li>
			<?php
			}
			?>
        </ul>
      </div>
      
      <div class="hasil-right" style="padding: 10px 0 0 5%;">
      <?php if ($tipereport == 'peringkat' || $tipereport == 'all'){ ?>
		  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<h5><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Total Peserta: <?php echo count($dataperingkat);?></h5>
		  </div>
		  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<h5><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Total Soal: <?php echo $totalsoal->jumlah_soal;?></h5>
		  </div>
		  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<h5><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Benar: <?php echo $jumlahbenar->jumlah_benar;?></h5>
		  </div>
		  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<h5><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Peringkat: <?php echo $peringkatsaya;?></h5>
		  </div>
		  <div class="col=lg-12">
			&nbsp;
		  </div>
        <ul class="score">
          <li>
              <h4>TERTINGGI</h4>
              <h5>NILAI : 
			  <?php
			  if(isset($nilai)){
				  echo number_format($nilai[1], 2, '.', '');
			  }else{
				  echo number_format(0, 2, '.', '');
			  }
			  ?></h5>
              <h5>SKOR : 
			  <?php 
			  if(isset($nilai)){
				  echo number_format($skor[1], 2, '.', ''); 
			  }else{
				  echo number_format(0, 2, '.', ''); 
			  }
			  ?>
			  %
			  </h5>
          </li>
          <li>
              <h4>ANDA</h4>
              <h5>NILAI : <?php echo number_format($nilaisaya, 2, '.', ''); ?></h5>
              <h5>SKOR : <?php echo number_format($skorsaya, 2, '.', ''); ?>%</h5>
          </li>
          <li>
              <h4>TERENDAH</h4>
              <h5>NILAI : <?php echo number_format(min($nilai), 2, '.', ''); ?></h5>
              <h5>SKOR : <?php echo number_format(min($skor), 2, '.', ''); ?>%</h5>
          </li>
        </ul>
        <br /><br />
      <?php } ?>


		  <ul class="nav nav-tabs" role="tablist">
			<?php if ($tipereport == 'hasil' || $tipereport == 'all'){ ?>
			<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Hasil Tes</a></li>
			<?php } ?>
			<?php if ($tipereport == 'peringkat' || $tipereport == 'all'){ ?>
			<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Rangking</a></li>
			<li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Grafik</a></li>
			<li role="presentation"><a href="#rekap" aria-controls="messages" role="tab" data-toggle="tab">Rekap</a></li>
			<?php } ?>
		  </ul>
		
<div class="tab-content" style="overflow-x: scroll;">
	
	<?php if ($tipereport == 'hasil' || $tipereport == 'all'){ ?>
	<div role="tabpanel" class="tab-pane active" id="home">
        <div class="hasil-container">
          <div class="tabel-analisa">
            <div class="title"><img src="<?php echo base_url('assets/dashboard/images/file.png'); ?>">ANALISIS PELAJARAN</div>
            <table class="table">
              <thead>
                <tr>
			<th style="text-align: center; width: 10px;">KAtegori</th>
			<th style="text-align: center;">Jumlah Soal</th>
			<th style="text-align: center;">Benar</th>
			<th style="text-align: center;">Salah</th>
			<th style="text-align: center;">Nilai</th>
			<th style="text-align: center;">Skor</th>
			<th style="text-align: center;">Tuntas</th>
		</tr>
              </thead>
              <tbody>
				<?php
					foreach($analisis_mapel as $datamapel){
						$skor = round(($datamapel->jumlah_bobot_benar/$datamapel->jumlah_bobot)*100);
				?>
					<tr>
						<td><?php echo $datamapel->nama_kategori; ?></td>
						<td><?php echo $datamapel->count_benar + $datamapel->count_salah; ?></td>
						<td>
						<?php 
						if($datamapel->count_benar == ""){
							echo "0";
						}else{
							echo $datamapel->count_benar;
						}
						?></td>
						<td><?php echo $datamapel->count_salah; ?></td>
						<td>
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
						<td><?php echo number_format(($datamapel->jumlah_bobot_benar/$datamapel->jumlah_bobot)*100, 2, '.', '')."%"; ?></td>
						<td>
							<?php
								if($skor > $datamapel->ketuntasan){
							?>
								<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true" style="color: green;"></span>	
							<?php
								}else{
							?>
								<span class="glyphicon glyphicon-thumbs-down" aria-hidden="true" style="color: red;"></span>
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
          </div>
          <div class="tabel-analisa waktu">
            <div class="title"><img src="<?php echo base_url('assets/dashboard/images/alarm.png'); ?>">ANALISIS WAKTU</div>
            <table class="table">
              <thead>
                <tr>
                  <td>Try Out</td>
                  <td>jumlah Soal</td>
                  <td>Disediakan</td>
                  <td>Dikerjakan</td>
                  <td>Rata - rata</td>
                </tr>
              </thead>
              <tbody>
                <?php
					foreach($analisis_waktu as $datawaktu){
				?>
					<tr>
						<td><?php echo $datawaktu->nama_kategori; ?></td>
						<td><?php echo $datawaktu->jumlah_soal; ?></td>
						<td><?php echo $datawaktu->disediakan; ?></td>
						<td><?php echo $datawaktu->dikerjakan; ?></td>
						<td><?php echo $datawaktu->rata_rata; ?></td>
					</tr>
				<?php
					}
				?>
              </tbody>
            </table>
          </div>
		  <a role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
			<div class="col-lg-12" style="background-color: #DB5C5C;; text-align: center;">
				<h4 style="color: white;">Analisis Topik</h4>
			</div>
			</a>
			<p>&nbsp;
			
			<!-- analisis topik -->
			<div class="<?php //if ($ispdf == 0){ echo 'collapse'; } else { echo ''; } ?>" id="collapseExample">
			<?php foreach($kategori as $kategoritopik){
			?>
			<div class="tabel-analisa waktu">
			  <div class="title"><img src="<?php echo base_url('assets/dashboard/images/atom.png'); ?>"><?php echo $kategoritopik->nama_kategori; ?></div>
				<table class="table">
					<thead>
						<tr>
							<th class="text-center">Topik/Indikator</th>
							<th class="text-center">Jml Soal</th>
							<th class="text-center">Benar</th>
							<th class="text-center">Salah</th>
							<th class="text-center">Skor</th>
							<th class="text-center">Ketuntasan</th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach($analisis_topik as $topik){
								if($topik->id_kategori == $kategoritopik->id_kategori){
						?>
								<tr>
									<td class="text-center"><?php echo $topik->topik; ?></td>
									<td><?php echo $topik->jumlah_soal ?></td>
									<td><?php echo $topik->jumlah_benar ?></td>
									<td><?php echo $topik->jumlah_salah ?></td>
									<td class="text-center">
									<?php 
										echo round((($topik->jumlah_benar / $topik->jumlah_soal) * 100), 2).'%';
									?>
									</td>
									<td class="text-center">
									<?php if($topik->status == 1){
									?>
									<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true" style="color: green;"></span>
									<?php
									}else{
									?>
									<span class="glyphicon glyphicon-thumbs-down" aria-hidden="true" style="color: red;"></span>
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
			 </div>
			<?php
			}
			?>
			</div>

    <?php if ($ispdf == 0){ ?>   
	<center><a href="<?php echo base_url('parents/report_cbt/'.$idprofil.'/'.$tipereport.'/1')?>" class="btn btn-primary" target="_blank">Print Report</a></center>
	<?php } ?>
	<br /><br /><br /><br />
	
        </div>
	</div>
	<?php } ?>
	
	<?php if ($tipereport == 'peringkat' || $tipereport == 'all'){ ?>
	<div role="tabpanel" class="tab-pane <?php if ($tipereport == 'peringkat'){ echo 'active'; } ?>" id="profile">
	<div class="tabel-analisa waktu">
	  <div class="title"><img src="<?php echo base_url('assets/dashboard/images/first.png'); ?>">Daftar Ranking</div>
		<table class="table">
			<thead>
				<tr>
					<th style="text-align: center; width: 10px;">No.</th>
					<th style="text-align: center;">Foto</th>
					<th style="text-align: center;">Nama</th>
					<th style="text-align: center;">Sekolah</th>
					<th style="text-align: center;">Waktu</th>
					<th style="text-align: center;">Nilai</th>
					<th style="text-align: center;">Skor</th>
				</tr>
			</thead>
			<tbody id="list-profil">
		
		<?php		
		$no = 1;
		foreach($dataperingkat as $peringkat){
			
			$datasiswa = $this->model_dashboard->data_peringkat($peringkat->id_siswa, $idprofil);
			
			
			if(isset($peringkat->waktu_kerja)){
				$waktu = round($peringkat->waktu_kerja / 60, 2);
		?>
			<tr>
				<td><?php echo $no; ?></td>
				<td>
				<?php
				if($datasiswa->foto !== ""){
				?>
				<img src="<?php echo base_url('assets/uploads/foto_siswa/'.$datasiswa->foto); ?>" style="width: 75px;"></img>
				<?php
				}else{
				?>
				<img src="<?php echo base_url('assets/dashboard/images/profile.jpg'); ?>" style="width: 75px;"></img>
				<?php
				}
				?>
					
				</td>
				<td>
				
				<?php 
				if($peringkat->id_siswa == $this->session->userdata('id_siswa')){
					echo "<b>".$datasiswa->nama_siswa."</b>"; 
				}else{
					echo $datasiswa->nama_siswa;
				}
				?>
				</td>
				
				<td class="text-center"><?php echo $datasiswa->nama_sekolah; ?><br> <?php echo $datasiswa->nama_kota; ?> - <?php echo $datasiswa->nama_provinsi; ?></td>
				<td class="text-center"><?php echo $waktu; ?> Menit</td>
				<td class="text-center"><?php echo number_format($peringkat->jumlah_bobot_benar, 2, '.', ''); ?>
				
				</td>
				<td class="text-center"><?php echo number_format(($peringkat->jumlah_bobot_benar/$peringkat->jumlah_bobot)*100, 2, '.', ''); ?>%</td>
			</tr>
		<?php
			}
		$no++;
		}
		?>
		
			</tbody>
		</table>
	 </div>
	</div>
	
	<div role="tabpanel" class="tab-pane" id="messages">	
	<canvas id="grafik" style="width: 200px; height: 200px; margin-bottom: 30px;"></canvas>
	</div>
	
	<div role="tabpanel" class="tab-pane" id="rekap" style="height: 800px;">
	<div class="tabel-analisa waktu">
	  <div class="title"><img src="<?php echo base_url('assets/dashboard/images/first.png'); ?>">Rekapitulasi Nilai</div>
		<table class="table">
			<thead>
				<tr>
					<th style="text-align: center; width: 10px;">No.</th>
					<th style="text-align: center;">Nama</th>
					<th style="text-align: center;">Sekolah</th>
					<?php
					foreach($kategori as $kategoritopik){
					echo "<td>".$kategoritopik->nama_kategori."</td>";
					}
					?>
					<th style="text-align: center;">Jumlah Nilai</th>
					<th style="text-align: center;">Skor</th>
					<th style="text-align: center;">Waktu</th>
				</tr>
			</thead>
			<tbody id="list-rekap">
				
		<?php
		$no = 1;
		foreach($dataperingkat as $peringkat){
			
			$datasiswa = $this->model_dashboard->data_peringkat($peringkat->id_siswa, $idprofil);
			
			
			if(isset($peringkat->waktu_kerja)){
				$waktu = round($peringkat->waktu_kerja / 60, 2);
		?>
			<tr>
				<td><?php echo $no; ?></td>
				<td>
				
				<?php 
				if($peringkat->id_siswa == $this->session->userdata('id_siswa')){
					echo "<b>".$datasiswa->nama_siswa."</b>"; 
				}else{
					echo $datasiswa->nama_siswa;
				}
				?>
				</td>
				
				<td class="text-center"><?php echo $datasiswa->nama_sekolah; ?><br> <?php echo $datasiswa->nama_kota; ?> - <?php echo $datasiswa->nama_provinsi; ?></td>
				
				<?php
					$datanilai = $this->model_dashboard->rekap_nilai($idprofil, $peringkat->id_siswa);
				
					foreach($datanilai as $nilai){
					?>
						<td><?php echo number_format($nilai->jumlah_bobot_benar, 2, '.', '');?></td>
					<?php
					}
				?>
				
				<td class="text-center">
				<?php
				if($peringkat->jumlah_bobot_benar > 100){
					echo "100.00";
				}else{
					echo number_format($peringkat->jumlah_bobot_benar, 2, '.', '');
				}
				?>
				</td>
				<td class="text-center"><?php echo number_format(($peringkat->jumlah_bobot_benar/$peringkat->jumlah_bobot)*100, 2, '.', ''); ?>%</td>
				<td class="text-center"><?php echo $waktu; ?> Menit</td>
			</tr>
		<?php
			}
		$no++;
		}
		?>
		
			</tbody>
		</table>
		
	 </div>
	</div>
	<?php } ?>
	</div>
		
	
      </div>
    </div>
    
<?php if ($ispdf == 0){ ?>
	
	<?php include('footer.php'); ?>

  <script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>
  
  <script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>"></script>
  <script type="text/javascript" charset="utf-8">
    $(window).load(function(){
 
    });
  </script>
  
  <!-- import chart.js -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/Chart.js');?>"></script>
    
    <!-- Menu Toggle Script -->
    <script type="text/javascript">
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
    </script>
    
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-scrolltofixed.js');?>"></script>
    <script type="text/javascript">
        $('#fixednav').scrollToFixed();
        $('#sidebar').scrollToFixed({
            marginTop: $('.header').outerHeight() - 250,
            limit: function() {
                var limit = $('.footer').offset().top - $('#sidebar').outerHeight(true) - 10;
                return limit;
            },
            zIndex: 999,
            removeOffsets: true
        });
    </script>
    
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/animatescroll.js');?>"></script>
    
	<script>
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: [
        "Soal Selesai",
        "Sisa Soal"
    ],
    datasets: [
        {
            data: [<?php echo $jumlahbenar->jumlah_benar;?>, <?php echo $totalsoal->jumlah_soal - $jumlahbenar->jumlah_benar;?>],
            backgroundColor: [
                "#36A2EB",
                "#B5B5B5"
            ],
            hoverBackgroundColor: [
                "#36A2EB",
                "#B5B5B5"
            ]
        }]
    }
});
</script>
<script>
var ctx = document.getElementById("grafik");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
        <?php
			foreach($analisis_mapel as $statmapel){
				echo '"'.$statmapel->nama_kategori.'",';
			}
		?>
    ],
    datasets: [
        {
			label: "Skor",
            data: [
			<?php
			foreach($analisis_mapel as $statmapel){
				echo (($statmapel->jumlah_bobot_benar/$statmapel->jumlah_bobot)*100) . ",";
			}
			?>
			],
        }]
    }
});
</script>

<?php } ?>

  </body>
</html>
