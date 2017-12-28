<?php
include('header_dashboard.php');
?>


<div class="container-fluid akun-container">
<div class="col-lg-12">	
		<!-- SPACE UNTUK MEMUNCULKAN PR -->
		<!-- ########################## -->
		<!-- ########################## -->
		<div class="col-md-12 text-center">
			<h3>Statistik <?php echo $infopr->nama_pr;?></h3>
		</div>
		
		<div class="col-md-4">
		<canvas id="donatbenarsalah" style="width: 100%; height: 400px;">
		</canvas>
		<p>&nbsp;
		<table class="table table-striped">
			<tr>
				<td>Jumlah Soal</td>
				<td>:</td>
				<td><?php echo $jumlahsoal;?></td>
			</tr>
			<tr>
				<td>Jumlah Benar</td>
				<td>:</td>
				<td><?php echo $jumlahbenar;?></td>
			</tr>
			<tr>
				<td>Nilai</td>
				<td>:</td>
				<td><?php echo $nilai;?></td>
			</tr>
		</table>
		</div>
		<div class="col-md-8">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th class="text-center" style="width: 30px;">No. Soal</th>
						<th class="text-center">Soal</th>
						<th class="text-center">Kunci</th>
						<th class="text-center">Terjawab</th>
						<th class="text-center" style="width: 30px;">Status</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$datasoal = $this->model_pr->fetch_soal_by_pr($infopr->id_pr);
						
						$x = 1;
						foreach($datasoal as $soal){
							?>
							<tr>
								<td class="text-center"><?php echo $x;?></td>
								<td class="text-center">
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalsoal<?php echo $soal->id_soal_pr;?>">
										<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
									</button>
								</td>
								<td class="text-center">
									<?php
										if($soal->kunci == 1){
											echo "<b>A</b>";
										}elseif($soal->kunci == 2){
											echo "<b>B</b>";
										}elseif($soal->kunci == 3){
											echo "<b>C</b>";
										}elseif($soal->kunci == 4){
											echo "<b>D</b>";
										}elseif($soal->kunci == 5){
											echo "<b>E</b>";
										}
									?>
								</td>
								<td class="text-center">
									<?php
										$cariterjawab = $this->model_pr->fetch_jawaban_per_soal($this->session->userdata('id_siswa'), $soal->id_soal_pr, $infopr->id_pr);
										
										if($cariterjawab == null){
											echo "<b>-</b>";
										}else{
											if($cariterjawab->terjawab == 1){
												echo "<b>A</b>";
											}elseif($cariterjawab->terjawab == 2){
												echo "<b>B</b>";
											}elseif($cariterjawab->terjawab == 3){
												echo "<b>C</b>";
											}elseif($cariterjawab->terjawab == 4){
												echo "<b>D</b>";
											}elseif($cariterjawab->terjawab == 5){
												echo "<b>E</b>";
											}
										}
									?>
								</td>
								<td>
									<?php
										if($cariterjawab == null){
											?>
											<button type="button" class="btn btn-danger">
												<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
											</button>
											<?php
										}else{
											if($soal->kunci == $cariterjawab->terjawab){
												?>
												<button type="button" class="btn btn-success">
													<span class="glyphicon glyphicon-check" aria-hidden="true"></span>
												</button>
												<?php
											}else{
												?>
												<button type="button" class="btn btn-danger">
													<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
												</button>
												<?php
											}
										}
									?>
								</td>
							</tr>
							<?php
							$x++;
						}
					?>
				</tbody>
			</table>
		</div>
		<!-- ########################## -->
		<!-- ########################## -->
		<!-- END SPACE UNTUK MEMUNCULKAN PR -->
</div>
</div>


<?php include('footer.php'); ?>

   <script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>
  
  <script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>"></script>
  <script src="<?php echo base_url('assets/dashboard/js/init.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/Chart.js');?>"></script>

<script>
var ctx = document.getElementById("donatbenarsalah");
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: [
        "Jawaban Benar",
        "Jawaban Salah"
    ],
    datasets: [
        {
            data: [<?php echo $jumlahbenar;?>, <?php echo $jumlahsoal - $jumlahbenar;?>],
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

<?php
$x = 1;
foreach($datasoal as $soal){
	?>
	<div class="modal fade" id="modalsoal<?php echo $soal->id_soal_pr;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Soal No <?php echo $x;?></h4>
		  </div>
		  <div class="modal-body" style="background-color: #a1d3ed;">
			<div class="row">
			  <div class="col-md-6">
				  <div class="panel panel-default">
					  <div class="panel-body">
						<?php echo $soal->pertanyaan;?>
					  </div>
				  </div>
				  <div class="panel panel-default">
					  <div class="panel-body">
						<b>Pembahasan :</b>
						<br>&nbsp;
						<?php echo $soal->pembahasan_teks;?>
					  </div>
				  </div>
			  </div>
			  <div class="col-md-6">
				<div class="panel panel-default">
				  <div class="panel-body">
					<?php
						if($soal->kunci == 1){
							?>
							<div class="alert alert-success" role="alert"><b>A.</b><?php echo $soal->jawab_1;?></div>
							<?php
						}else{
							?>
							<div class="alert alert-danger" role="alert"><b>A.</b><?php echo $soal->jawab_1;?></div>
							<?php
						}
					?>
					<?php
						if($soal->kunci == 2){
							?>
							<div class="alert alert-success" role="alert"><b>B.</b><?php echo $soal->jawab_2;?></div>
							<?php
						}else{
							?>
							<div class="alert alert-danger" role="alert"><b>B.</b><?php echo $soal->jawab_2;?></div>
							<?php
						}
					?>
					<?php
						if($soal->kunci == 3){
							?>
							<div class="alert alert-success" role="alert"><b>C.</b><?php echo $soal->jawab_3;?></div>
							<?php
						}else{
							?>
							<div class="alert alert-danger" role="alert"><b>C.</b><?php echo $soal->jawab_3;?></div>
							<?php
						}
					?>
					<?php
						if($soal->kunci == 4){
							?>
							<div class="alert alert-success" role="alert"><b>D.</b><?php echo $soal->jawab_4;?></div>
							<?php
						}else{
							?>
							<div class="alert alert-danger" role="alert"><b>D.</b><?php echo $soal->jawab_4;?></div>
							<?php
						}
					?>
					<?php
						if(!empty($soal->jawab_5)){
							if($soal->kunci == 5){
								?>
								<div class="alert alert-success" role="alert"><b>E.</b><?php echo $soal->jawab_5;?></div>
								<?php
							}else{
								?>
								<div class="alert alert-danger" role="alert"><b>E.</b><?php echo $soal->jawab_5;?></div>
								<?php
							}
						}
					?>
				  </div>
				</div>
			  </div>
			</div>
		  </div>
		  <div class="modal-footer">
		  </div>
		</div>
	  </div>
	</div>
	<?php
	$x++;
}
?>
  </body>
</html>
