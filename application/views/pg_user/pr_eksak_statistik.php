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
					</tr>
				</thead>
				<tbody>
					<?php
						$no = 1;
						foreach($data_soal as $soal){
							?>
							<tr>
								<td><?php echo $no;?></td>
								<td>
								<div class="panel panel-default">
								  <div class="panel-body">
									<div class="row">
										<div class="col-sm-12">
											<?php echo $soal->intro_soal;?>
										</div>
									</div>
								  </div>
								</div>	
										<?php
											$caritanya = $this->model_psep->fetch_soal_by_intro($soal->id_intro_soal);
											foreach($caritanya as $tanya){
												$cariterjawab = $this->model_pr->fetch_terjawab_by_soal($tanya->id_soal_eksak,  $this->session->userdata('id_siswa'));
												?>
												<div class="panel panel-default">
												  <div class="panel-body">
													<div class="row">
														<div class="col-sm-12">
															<strong>Pertanyaan :</strong>
															<?php echo $tanya->pertanyaan;?>
														</div>
														<div class="col-sm-6">
															<div class="alert alert-success" role="alert">
															<strong>Kunci :</strong>
															<?php echo $tanya->jawaban;?>
															</div>
														</div>
														<div class="col-sm-6">
															<?php
															if($cariterjawab->status == 1){
																?>
																<div class="alert alert-success" role="alert">
																<?php
															}else{
																?>
																<div class="alert alert-danger" role="alert">
																<?php
															}
															?>
															<strong>Terjawab :</strong>
															<?php if($cariterjawab !== null){
																?>
																<?php echo $cariterjawab->terjawab;?>
																<?php
															}else{
																echo "-";
															}?>
															</div>
														</div>
													</div>
												  </div>
												</div>
												<?php
											}
										?>
									
								</td>
							</tr>
							<?php
							$no++;
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


  </body>
</html>
