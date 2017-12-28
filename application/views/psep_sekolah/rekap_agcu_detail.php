<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>
<?php
	foreach($kategoridiagnostic as $diagnostic){
		
	}
?>
<div class="wrapper">
  <?php include "sidebar.php"; ?>

  <div class="main-panel">
    <?php include "navbar.php"; ?>
    
    <div class="content">      
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
                <h4 class="title">Rekapitulasi AGCU <?php echo $datakelas->alias_kelas." ". $datasekolah->nama_sekolah;?></h4>
                <p class="category">Rekapitulasi analisis AGCU  </p>
              </div>
              <div class="content">
                <div class="row">
					<div class="col-md-12">
						<h5>Rekapitulasi Diagnostic Test Kelas <?php echo $datakelas->kelas_paralel;?></h5>
						<h5><?php echo $datasekolah->nama_sekolah; ?></h5>
						<?php
							foreach($kategoridiagnostic as $diagnostic){
							?>
								<div class="col-sm-6">
								<h5><?php echo $diagnostic->nama_kategori;?></h5>
								
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>Bab</th>
											<th>Ketuntasan</th>
										</tr>
									</thead>
									<tbody>
										<?php
											foreach($datasoal as $soal){
												if($soal->id_diagnostic == $diagnostic->id_diagnostic){
												?>
													<tr>
														<td><?php echo $soal->topik;?></td>
														<td>
														<?php
															foreach($datasoalbenar as $soalbenar){
																if($soalbenar->id_soal == $soal->id_banksoal){
																	//echo $soalbenar->id_siswa.",";
																	if(isset($jumlahbenar[$soal->id_banksoal])){
																		$jumlahbenar[$soal->id_banksoal] += 1;
																	}else{
																		$jumlahbenar[$soal->id_banksoal] = 1;
																	}
																}
															}
															if(!isset($jumlahbenar[$soal->id_banksoal])){
																$jumlahbenar[$soal->id_banksoal] = 0;
															}
															//echo $jumlahbenar[$soal->id_banksoal];
															if($jumlahsiswa > 0){
																$ketuntasan = $jumlahbenar[$soal->id_banksoal]/$jumlahsiswa * 100;
															}else{
																$ketuntasan = 0;
															}
														?>
														<?php 
														if($ketuntasan < 65){
															?>
															<button type="button" class="btn btn-danger"><?php echo number_format($ketuntasan, 2, ',', '');?>%</button>
															<?php
														}else{
															?>
															<button type="button" class="btn btn-success"><?php echo number_format($ketuntasan, 2, ',', '');?>%</button>
															<?php
														}
														?></td>
													</tr>
												<?php
												}
											}
										?>
									</tbody>
								</table>
								</div>
							<?
							}
						?>
					</div>
					<div class="col-sm-12">
						<h4>Rekapitulasi Gaya Belajar / Learning Style</h4>
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>VISUAL</th>
									<th>AUDITORY</th>
									<th>KINESTETIK</th>
									<th>VISUAL - AUDITORY</th>
									<th>VISUAL - KINESTETIK</th>
									<th>AUDITORY - KINESTETIK</th>
									<th>VISUAL - AUDITORY - KINESTETIK</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<?php echo number_format($prosentasev, 2, ',', '');?>%
									</td>
									<td>
										<?php echo number_format($prosentasea, 2, ',', '');?>%
									</td>
									<td>
										<?php echo number_format($prosentasek, 2, ',', '');?>%
									</td>
									<td>
										<?php echo number_format($prosentaseva, 2, ',', '');?>%
									</td>
									<td>
										<?php echo number_format($prosentasevk, 2, ',', '');?>%
									</td>
									<td>
										<?php echo number_format($prosentaseak, 2, ',', '');?>%
									</td>
									<td>
										<?php echo number_format($prosentasevak, 2, ',', '');?>%
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<canvas id="grafik" style="width: 100%; height: 500px;">
					
					</canvas>
					<div class="col-sm-12">
						<h4>Rekapitulasi Psychologycal Test</h4>
					</div>
					<div class="col-md-6">
						<table class="table table-bordered table-striped" style="margin-top: 25px;">
							<thead>
								<tr>
									<th colspan="5" style="text-align: center;">AQ (ADVERSITY QUOTIENT) - DAYA JUANG</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>RENDAH</td>
									<td>RATA-RATA BAWAH</td>
									<td>RATA-RATA</td>
									<td>RATA-RATA ATAS</td>
									<td>TINGGI</td>
								</tr>
								<tr>
									<td><?php echo number_format($persenaqrendah, 2, ',', '');?>%</td>
									<td><?php echo number_format($persenaqratabawah, 2, ',', '');?>%</td>
									<td><?php echo number_format($persenaqrata, 2, ',', '');?>%</td>
									<td><?php echo number_format($persenaqrataatas, 2, ',', '');?>%</td>
									<td><?php echo number_format($persenaqtinggi, 2, ',', '');?>%</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-md-6">
						<canvas id="grafikaq" style="width: 100%; height: 300px;">
						</canvas>
					</div>
					<div class="col-md-12">
					<hr>
					</div>
					<div class="col-md-6">
						<table class="table table-bordered table-striped" style="margin-top: 25px;">
							<thead>
								<tr>
									<th colspan="5" style="text-align: center;">EQ (EMOTIONAL QUOTIENT) - KECERDASAN EMOSI</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>RENDAH</td>
									<td>RATA-RATA BAWAH</td>
									<td>RATA-RATA</td>
									<td>RATA-RATA ATAS</td>
									<td>TINGGI</td>
								</tr>
								<tr>
									<td><?php echo number_format($perseneqrendah, 2, ',', '');?>%</td>
									<td><?php echo number_format($perseneqratabawah, 2, ',', '');?>%</td>
									<td><?php echo number_format($perseneqrata, 2, ',', '');?>%</td>
									<td><?php echo number_format($perseneqrataatas, 2, ',', '');?>%</td>
									<td><?php echo number_format($perseneqtinggi, 2, ',', '');?>%</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-md-6">
						<canvas id="grafikeq" style="width: 100%; height: 300px;">
						</canvas>
					</div>
					<div class="col-md-12">
					<hr>
					</div>
					<div class="col-md-6">
						<table class="table table-bordered table-striped" style="margin-top: 25px;">
							<thead>
								<tr>
									<th colspan="5" style="text-align: center;">AM (ACHIEVEMENT MOTIVATION) - MOTIVASI BERPRESTASI</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>RENDAH</td>
									<td>RATA-RATA BAWAH</td>
									<td>RATA-RATA</td>
									<td>RATA-RATA ATAS</td>
									<td>TINGGI</td>
								</tr>
								<tr>
									<td><?php echo number_format($persenamrendah, 2, ',', '');?>%</td>
									<td><?php echo number_format($persenamratabawah, 2, ',', '');?>%</td>
									<td><?php echo number_format($persenamrata, 2, ',', '');?>%</td>
									<td><?php echo number_format($persenamrataatas, 2, ',', '');?>%</td>
									<td><?php echo number_format($persenamtinggi, 2, ',', '');?>%</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-md-6">
						<canvas id="grafikam" style="width: 100%; height: 300px;">
						</canvas>
					</div>
					<div class="col-md-12">
					<hr>
					</div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->

    <?php include "footer.php"; ?>

  </div>
</div>

</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>

<!--  Nestable Plugin    -->
<script src="<?php echo base_url('assets/js/plugins/nestable/jquery.nestable.js');?>"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>


<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>

<!-- PLUGINS FUNCTION -->
 <!-- Nestable plugin  -->
 
<script type="text/javascript" src="<?php echo base_url('assets/js/Chart.js');?>"></script>

<script>
var ctx = document.getElementById("grafik");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
        "V",
		"A",
		"K",
		"VA",
		"VK",
		"AK",
		"VAK"
    ],
    datasets: [
        {
			label: "Learning Style Score",
            data: [
				<?php echo $prosentasev;?>,
				<?php echo $prosentasea;?>,
				<?php echo $prosentasek;?>,
				<?php echo $prosentaseva;?>,
				<?php echo $prosentasevk;?>,
				<?php echo $prosentaseak;?>,
				<?php echo $prosentasevak;?>
			],
			backgroundColor: [
				"#c65304",
				"#14ab1d",
				"#3a41a0",
				"#36A2EB",
				"#36A2EB",
				"#36A2EB",
				"#36A2EB"
			]
        }]
    },
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
});
</script>

<script>
var ctx = document.getElementById("grafikaq");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
        "RENDAH",
		"RATA-RATA BAWAH",
		"RATA-RATA",
		"RATA-RATA ATAS",
		"TINGGI",
    ],
    datasets: [
        {
			label: "Adversity Quotient Point",
            data: [
				<?php echo $persenaqrendah;?>,
				<?php echo $persenaqratabawah;?>,
				<?php echo $persenaqrata;?>,
				<?php echo $persenaqrataatas;?>,
				<?php echo $persenaqtinggi;?>
			],
			backgroundColor: [
				"#36A2EB",
				"#36A2EB",
				"#36A2EB",
				"#36A2EB",
				"#36A2EB"
			]
        }]
    },
	options: {
        scales: {
            yAxes: [{
                ticks: {
                    max: 100,
                    min: 0,
					stepSize: 10
                }
            }],
			xAxes: [{
                display: false
            }]
        }
    }
});
</script>

<script>
var ctx = document.getElementById("grafikeq");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
        "RENDAH",
		"RATA-RATA BAWAH",
		"RATA-RATA",
		"RATA-RATA ATAS",
		"TINGGI",
    ],
    datasets: [
        {
			label: "Emotional Quotient Point",
            data: [
				<?php echo $perseneqrendah;?>,
				<?php echo $perseneqratabawah;?>,
				<?php echo $perseneqrata;?>,
				<?php echo $perseneqrataatas;?>,
				<?php echo $perseneqtinggi;?>
			],
			backgroundColor: [
				"#36A2EB",
				"#36A2EB",
				"#36A2EB",
				"#36A2EB",
				"#36A2EB"
			]
        }]
    },
	options: {
        scales: {
            yAxes: [{
                ticks: {
                    max: 100,
                    min: 0,
					stepSize: 10
                }
            }],
			xAxes: [{
                display: false
            }]
        }
    }
});
</script>

<script>
var ctx = document.getElementById("grafikam");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
        "RENDAH",
		"RATA-RATA BAWAH",
		"RATA-RATA",
		"RATA-RATA ATAS",
		"TINGGI",
    ],
    datasets: [
        {
			label: "Achievement Motivation Point",
            data: [
				<?php echo $persenamrendah;?>,
				<?php echo $persenamratabawah;?>,
				<?php echo $persenamrata;?>,
				<?php echo $persenamrataatas;?>,
				<?php echo $persenamtinggi;?>
			],
			backgroundColor: [
				"#36A2EB",
				"#36A2EB",
				"#36A2EB",
				"#36A2EB",
				"#36A2EB"
			]
        }]
    },
	options: {
        scales: {
            yAxes: [{
                ticks: {
                    max: 100,
                    min: 0,
					stepSize: 10
                }
            }],
			xAxes: [{
                display: false
            }]
        }
    }
});
</script>

</html>
