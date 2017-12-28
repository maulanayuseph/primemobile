<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>
<script>
$(function(){
	$("#sumber").change(function(){
		$("#manage").load("../ajax_manage/" + $("#sumber").val());
	});
});
</script>
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
                <h4 class="title">Pekerjaan Rumah <?php echo $sekolah->nama_sekolah;?></h4>
              </div>
              <div class="content">
                <div class="row">
					<div class="col-md-6">
						<table class="table table-striped">
							<tr>
								<td>Nama Siswa</td>
								<td>:</td>
								<td><?php echo $infosiswa->nama_siswa;?></td>
							</tr>
							<tr>
								<td>Nama PR</td>
								<td>:</td>
								<td><?php echo $infopr->nama_pr;?></td>
							</tr>
							<tr>
								<td>Kelas</td>
								<td>:</td>
								<td><?php echo $infopr->kelas_paralel;?></td>
							</tr>
							<tr>
								<td>Tahun Ajaran</td>
								<td>:</td>
								<td><?php echo $infopr->tahun_ajaran;?></td>
							</tr>
							<tr>
								<td>Tanggal Penyelesaian</td>
								<td>:</td>
								<td><?php echo $infopr->deadline;?></td>
							</tr>
						</table>
						<a href="<?php echo base_url("psep_sekolah/pr/koreksi/" . $infopr->id_pr . "/" . $infosiswa->id_siswa );?>" class="btn btn-primary btn-sm" style="width: 100%;">Koreksi</a>
					</div>
					<div class="col-md-6">
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
						<div class="col-md-12">
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
																$cariterjawab = $this->model_pr->fetch_terjawab_by_soal($tanya->id_soal_eksak,  $idsiswa);
																?>
																<div class="panel panel-default">
																  <div class="panel-body">
																	<div class="row">
																		<div class="col-sm-12">
																			<strong>Pertanyaan :</strong>
																			<?php echo $tanya->pertanyaan;?>
																		</div>
																		<div class="col-sm-5">
																			<div class="alert alert-success" role="alert">
																			<strong>Kunci :</strong>
																			<?php echo $tanya->jawaban;?>
																			</div>
																		</div>
																		<div class="col-sm-5">
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
																		<div class="col-sm-2">
																			<?php
																				if($cariterjawab->status == 1){
																					?>
																					<a href="<?php echo base_url("psep_sekolah/pr/salahkan_eksak/".$cariterjawab->id_analisis_pr_eksak);?>" class="btn btn-danger"><i class="fa fa-remove" aria-hidden="true"></i></a>
																					<?php
																				}else{
																					?>
																					<a href="<?php echo base_url("psep_sekolah/pr/betulkan_eksak/".$cariterjawab->id_analisis_pr_eksak);?>" alt="Ubah Status Jawaban Menjadi Benar" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i></a>
																					<?php
																				}
																			?>
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

<!-- PLUGINS FUNCTION -->
<!-- Nestable plugin  -->
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
</html>
