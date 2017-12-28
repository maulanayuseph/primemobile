<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>
<div class="wrapper">
  <?php include "sidebar.php"; ?>

  <div class="main-panel">
    <?php include "navbar.php";?>
    
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
              </div>
              <div class="content">
				<h3>Detail Rekapitulasi Konten <?php echo $infokelas->alias_kelas;?></h3>
				<a class="btn btn-success" href="<?php echo base_url("pg_admin/rekap/export/".$infokelas->id_kelas);?>">
					Export
				</a>
				<p>&nbsp;
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<?php
					foreach($datamapel as $mapel){
				?>
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingOne">
						  <h4 class="panel-title">
							<a role="button" data-toggle="collapse" data-parent="#accordion" href="#mapel<?php echo $mapel->id_mapel;?>" aria-expanded="true" aria-controls="collapseOne">
							  <?php echo $mapel->nama_mapel;?>
							</a>
						  </h4>
						</div>
						<div id="mapel<?php echo $mapel->id_mapel;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
						  <div class="panel-body">
							<?php
								$datamateripokok = $this->model_adm->fetch_materi_pokok_by_mapel2($mapel->id_mapel);
								foreach($datamateripokok as $bab){
							?>
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th>BAB</th>
										<th>JUMLAH SUB-BAB</th>
										<th>JUMLAH LATIHAN SOAL</th>
										<th>JUMLAH SOAL</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><?php echo $bab->nama_materi_pokok;?></td>
										<td>
											<?php
												$jumlahsubbab = $this->model_adm->jumlah_sub_bab_by_materi_pokok($bab->id_materi_pokok);
												
												echo $jumlahsubbab;
											?>
										</td>
										<td>
											<?php
												$jumlahlatihan = $this->model_adm->jumlah_latihan_soal_by_materi_pokok($bab->id_materi_pokok);
												
												echo $jumlahlatihan;
											?>
										</td>
										<td>
											<?php
												$jumlahsoal = $this->model_adm->jumlah_soal_by_materi_pokok($bab->id_materi_pokok);
												
												echo $jumlahsoal;
											?>
										</td>
									</tr>
									<?php
										$datasub = $this->model_adm->fetch_sub_materi_by_mapel($mapel->id_mapel);
										
										foreach($datasub as $sub){
											if($sub->id_materi_pokok == $bab->id_materi_pokok){
												?>
												<tr>
													<td>&nbsp;</td>
													<td colspan="2">
														<?php
															echo $sub->nama_sub_materi;
														?>
													</td>
													<td>
														<?php
															if($sub->kategori == 3){
																$jumlahsoal = $this->model_adm->jumlah_soal_by_sub_materi($sub->id_sub_materi);
																echo $jumlahsoal;
																
															}else{
																echo "-";
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
							<?php
								}
							?>
							
						  </div>
						</div>
					</div>
				<?php
					}
				?>
				</div>
                <div class="footer">
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>

    <?php include "footer.php"; ?>

  </div>
</div>

</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-1.10.2.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="<?php echo base_url('assets/js/demo.js');?>"></script>

</html>
