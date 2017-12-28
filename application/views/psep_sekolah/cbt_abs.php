<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>

<?php
foreach($kategori as $kat){
	$caritopik = $this->model_fronttryout->fetch_soal_by_kategori($kat->id_kategori);
	$x=1;
	foreach($datasiswa as $siswa){
		foreach($caritopik as $topik){
			$nilai = $this->model_psep->fetch_abs_by_kategori($topik->id_kategori, $topik->id_banksoal, $siswa->id_siswa);
			if(!isset($nilai)){
				if(isset($nilaikat[$kat->id_kategori][$topik->id_banksoal])){
					$nilaikat[$kat->id_kategori][$topik->id_banksoal] += 0;
				}else{
					$nilaikat[$kat->id_kategori][$topik->id_banksoal] = 0;
				}																				
			}else{
				if(isset($nilaikat[$kat->id_kategori][$topik->id_banksoal])){
					$nilaikat[$kat->id_kategori][$topik->id_banksoal] += $nilai->status;
				}else{
					$nilaikat[$kat->id_kategori][$topik->id_banksoal] = $nilai->status;
				}	
			}
		}
	}
}
?>
<?php
$jumlahsiswa = 0;
foreach($datasiswa as $siswa){
	$jumlahsiswa += 1;
}
?>
<div class="wrapper">
  <?php include "sidebar.php"; ?>

  <div class="main-panel">
    <?php include "navbar.php"; ?>
	<ul class="nav nav-tabs" role="tablist">
	<?php
	foreach($kategori as $kat){
		?>
		<li role="presentation"><a href="#kat<?php echo $kat->id_kategori;?>" aria-controls="kat<?php echo $kat->id_kategori;?>" role="tab" data-toggle="tab"><?php echo $kat->nama_kategori;?></a></li>
		<?php
	}
	?>
	</ul>
	
	<div class="tab-content">
    <?php
		foreach($kategori as $kat){
			$caritopik = $this->model_fronttryout->fetch_soal_by_kategori($kat->id_kategori);
			$x=1;
			foreach($caritopik as $topik){
				$x = $x;
				$x++;
			}
			?>
			<div role="tabpanel" class="tab-pane" id="kat<?php echo $kat->id_kategori;?>">
			<table class="table table-bordered table-striped" id="example<?php echo $kat->id_kategori;?>">
				<thead>
					<tr>
						<th>Nama Siswa</th>
						<th colspan="<?php echo $x-1;?>">Topik Soal</th>
						<th>Skor</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th></th>
						<?php
							foreach($caritopik as $topik){
								?>
									<td style="width: 50px;" class="text-center"><?php echo $topik->topik;?>
									</td>
								<?php
							}
						?>
						<th></th>
					</tr>
					<tr>
						<th></th>
						<?php
							foreach($caritopik as $topik){
								?>
									<td style="width: 50px;" class="text-center">
									<br><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal<?php echo $kat->id_kategori;?><?php echo $topik->id_banksoal;?>"><i class="fa fa-eye" aria-hidden="true"></i></button>
									</td>
								<?php
							}
						?>
						<th></th>
					</tr>
					<tr>
						<th>&nbsp;</th>
						<?php
							foreach($caritopik as $topik){
								?>
									<td class="text-center"><strong>
									<?php
									$pencapaian = number_format($nilaikat[$kat->id_kategori][$topik->id_banksoal]/$jumlahsiswa * 100, 2, ",", ".");
									
									if($pencapaian < 50){
										?>
										<span style="color: red;"><?php echo $pencapaian;?>%</span>
										<?php
									}else{
										?>
										<span style="color: green;"><?php echo $pencapaian;?>%</span>
										<?php
									}
									?></strong>
									</td>
								<?php
							}
						?>
						<th></th>
					</tr>
					<?php
						foreach($datasiswa as $siswa){
							?>
								<tr>
									<td style="width: 50px;"><?php echo $siswa->nama_siswa;?></td>
									<?php
										foreach($caritopik as $topik){
											$nilai = $this->model_psep->fetch_abs_by_kategori($topik->id_kategori, $topik->id_banksoal, $siswa->id_siswa);
											?>
												<td>
													<?php
														if(!isset($nilai)){
															if(isset($totalsiswa[$siswa->id_siswa])){
																$totalsiswa[$siswa->id_siswa] += 0;
															}else{
																$totalsiswa[$siswa->id_siswa] = 0;
															}	
echo 0;																				
														}else{
															if(isset($totalsiswa[$siswa->id_siswa])){
																$totalsiswa[$siswa->id_siswa] += $nilai->status;
															}else{
																$totalsiswa[$siswa->id_siswa] = $nilai->status;
															}
															echo $nilai->status;
														}
													?>
												</td>
											<?php
										}
									?>
									<td>
										<strong>
										<?php
											$nilaisiswa[$siswa->id_siswa] = number_format($totalsiswa[$siswa->id_siswa]/$x * 100, 2, ",", ".");
											
											if($nilaisiswa[$siswa->id_siswa] < 50){
												?>
												<span style="color: red;"><?php echo $nilaisiswa[$siswa->id_siswa];?>%</span>
												<?php
											}else{
												?>
												<span style="color: green;"><?php echo $nilaisiswa[$siswa->id_siswa];?>%</span>
												<?php
											}
										?>
										</strong>
									</td>
								</tr>
							<?php
						}
					?>
				</tbody>
			</table>
			</div>
			<?php
		}
	?>
	</div>
	
	
	

    <?php include "footer.php"; ?>

  </div>
</div>
<?php
foreach($kategori as $kat){
	$caritopik = $this->model_fronttryout->fetch_soal_by_kategori($kat->id_kategori);
	$x=1;
	foreach($datasiswa as $siswa){
		foreach($caritopik as $topik){
			?>
			<div class="modal fade" id="myModal<?php echo $kat->id_kategori;?><?php echo $topik->id_banksoal;?>" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
				<div class="modal-content" id="modalsoal">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  </div>
				  <div class="modal-body">
					<p><?php echo $topik->pertanyaan; ?></p>
					<table class="table table-bordered table-striped">
						<tr>
							<td style="width: 30px;"><b>A.</b></td>
							<td>
								<?php
								echo $topik->jawab_1;
								?>
							</td>
						</tr>
						<tr>
							<td><b>B.</b></td>
							<td>
								<?php
								echo $topik->jawab_2;
								?>
							</td>
						</tr>
						<tr>
							<td><b>C.</b></td>
							<td>
								<?php
								echo $topik->jawab_3;
								?>
							</td>
						</tr>
						<tr>
							<td><b>D.</b></td>
							<td>
								<?php
								echo $topik->jawab_4;
								?>
							</td>
						</tr>
						<tr>
							<td><b>E.</b></td>
							<td>
								<?php
								echo $topik->jawab_5;
								?>
							</td>
						</tr>
						<tr>
							<td>Kunci Jawaban</td>
							<td>
								<b>
								<?php
									if($topik->kunci == 1){
										echo "A";
									}elseif($topik->kunci == 2){
										echo "B";
									}elseif($topik->kunci == 3){
										echo "C";
									}elseif($topik->kunci == 4){
										echo "D";
									}elseif($topik->kunci == 5){
										echo "E";
									}
								?>
								</b>
							</td>
						</tr>
					</table>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  </div>
				</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
			<?php
		}
	}
}
?>
</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-1.10.2.js" type="text/javascript');?>"></script>
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
<?php
foreach($kategori as $kat){
?>
<script>
$(document).ready(function() {
    $('#example<?php echo $kat->id_kategori;?>').DataTable();
} );
</script>
<?php
}
?>


</html>
