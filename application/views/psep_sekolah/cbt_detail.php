<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
$x = 1;
$totalpeserta = 0;
foreach($dataperingkat as $peringkat){
	if(isset($peringkat->waktu_kerja)){
		$skor[$x] =round(($peringkat->jumlah_bobot_benar/$peringkat->jumlah_bobot)*100, 2);
		$nilai[$x] =$peringkat->jumlah_bobot_benar;
		if($peringkat->id_siswa == $infosiswa->id_siswa){
			$skorsaya = round(($peringkat->jumlah_bobot_benar/$peringkat->jumlah_bobot)*100, 2);
			$nilaisaya = $peringkat->jumlah_bobot_benar;
			
			$peringkatsaya = $x;
		}
		
		if($peringkat->waktu_kerja !== null){
			$totalpeserta++;
			$x++;
		}

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
<?php include "html_header.php"; ?>

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
                <h4 class="title">Laporan CBT Siswa <?php echo $sekolah->nama_sekolah;?></h4>
              </div>
              <div class="content">
                <div class="row">
					<div class="col-sm-4">
					<table class="table">
						<tr>
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
							<td>Peringkat</td>
							<td>:</td>
							<td><?php echo $peringkatsaya;?> dari <?php echo $totalpeserta;?></td>
						</tr>
					</table>
					</div>
					<div class="col-sm-12">
					</div>
					<div class="col-sm-4">
						<h4><?php echo $aliaskelas->nama_profil; ?></h4>
						<canvas id="myChart" style="width: 200px; height: 200px; margin-bottom: 30px;"></canvas>
						<h4>DAFTAR SEMUA MATERI</h4>
						<?php foreach($analisis_mapel as $statmapel){
						?>
						<h6><span class="glyphicon glyphicon-play"></span><?php echo $statmapel->nama_kategori; ?></h6>
						<div class="progress">
						  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round(($statmapel->jumlah_bobot_benar/$statmapel->jumlah_bobot)*100)."%"; ?>;">
						  </div>
						</div>
						<?php
						}
						?>
					</div>
					<div class="col-sm-8">
						<h4>ANALISIS PELAJARAN</h4>
						<table class="table">
						  <thead>
							<tr>
								<th style="text-align: center; width: 10px;">KAtegori</th>
								<th style="text-align: center;">Jumlah Soal</th>
								<th style="text-align: center;">Benar</th>
								<th style="text-align: center;">Salah</th>
								<th style="text-align: center;">KKM</th>
								<th style="text-align: center;">Nilai</th>
								<!-- <th style="text-align: center;">Skor</th> -->
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
									<!--
									<td><?php echo number_format(($datamapel->jumlah_bobot_benar/$datamapel->jumlah_bobot)*100, 2, '.', '')."%"; ?></td>
									-->
									<td>
										<?php
											if($skor >= $kkm){
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
						<h4>ANALISIS WAKTU</h4>
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
					<div class="col-sm-12">
						<h4>Analisis Topik</h4>
						<?php foreach($kategori as $kategoritopik){
						?>
						  <strong><h5><?php echo $kategoritopik->nama_kategori; ?></h5></strong>
							<table class="table able-bordered table-striped">
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
												<td><?php echo $topik->topik; ?></td>
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
						<?php
						}
						?>
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


<!--  Datatables Plugin -->
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>

<!--  Nestable Plugin    -->
<script src="<?php echo base_url('assets/js/plugins/nestable/jquery.nestable.js');?>"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>


<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/Chart.js');?>"></script>
<!-- PLUGINS FUNCTION -->
<!-- Nestable plugin  -->

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
$(function(){
$("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
});
</script>
</html>
