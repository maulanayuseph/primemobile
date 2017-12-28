<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>
<div class="wrapper">
  <?php include "sidebar.php"; ?>
<?php
/*
	foreach($datakelas as $kelas){
		$jmapel[$kelas->id_kelas] = $this->model_adm->jumlah_mapel_by_kelas($kelas->id_kelas);
		
		
		$jbab[$kelas->id_kelas] = $this->model_adm->jumlah_materi_pokok_by_kelas($kelas->id_kelas);
		if(!isset($bab)){
			$bab = $jbab[$kelas->id_kelas];
		}else{
			$bab += $jbab[$kelas->id_kelas];
		}
		
		$jsubbab[$kelas->id_kelas] = $this->model_adm->jumlah_sub_bab_by_kelas($kelas->id_kelas);
		if(!isset($subbab)){
			$subbab = $jsubbab[$kelas->id_kelas];
		}else{
			$subbab += $jsubbab[$kelas->id_kelas];
		}
		
		$jlatihansoal[$kelas->id_kelas] = $this->model_adm->jumlah_latihan_soal_by_kelas($kelas->id_kelas);
		if(!isset($latihansoal)){
			$latihansoal = $jlatihansoal[$kelas->id_kelas];
		}else{
			$latihansoal += $jlatihansoal[$kelas->id_kelas];
		}
		
		$jsoal[$kelas->id_kelas] = $this->model_adm->jumlah_soal_by_kelas($kelas->id_kelas);
		if(!isset($soal)){
			$soal = $jsoal[$kelas->id_kelas];
		}else{
			$soal += $jsoal[$kelas->id_kelas];
		}
		
		$jvideo[$kelas->id_kelas] = $this->model_adm->jumlah_pembahasan_video_by_kelas($kelas->id_kelas);
		if(!isset($video)){
			$video = $jvideo[$kelas->id_kelas];
		}else{
			$video += $jvideo[$kelas->id_kelas];
		}
	}
	*/
	
?>
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
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Kelas</th>
								<th>Jumlah Mata Pelajaran</th>
								<th>Jumlah Bab</th>
								<th>Jumlah Sub Bab</th>
								<th>Jumlah Soal</th>
								<th>Jumlah Soal Bab</th>
								<th>Jumlah Soal Sub Bab</th>
								<th>Pembahasan Video</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach($datakelas as $kelas){
							?>
								<tr>
									<td><?php echo $kelas->alias_kelas;?></td>
									<?php
										$jumlahmapel = $this->model_adm->jumlah_mapel_by_kelas($kelas->id_kelas);
										
										echo "
										<td>".$jumlahmapel."</td>
										";
									?>
									<?php
										$jumlahbab = $this->model_adm->jumlah_materi_pokok_by_kelas($kelas->id_kelas);
										
										echo "
											<td>
											"
											.$jumlahbab.
											"
											</td>
										";
									?>
									<?php
										$jumlahsubbab = $this->model_adm->jumlah_sub_bab_by_kelas($kelas->id_kelas);
										
										echo "
										<td>
											".$jumlahsubbab."
										</td>
										";
									?>
									<?php
										$jumlahsoal = $this->model_adm->jumlah_soal_by_kelas($kelas->id_kelas);
										
										
										echo "
										<td>
											".$jumlahsoal."
										</td>
										";
									?>
									<?php
										
										$jumlahsoalbab = $this->model_rekap->get_jumlah_soal_by_tipe_and_kelas(1, $kelas->id_kelas);
										echo "
										<td>
											".$jumlahsoalbab."
										</td>
										";
									?>
									<?php
										$jumlahsoalsubbab =  $this->model_rekap->get_jumlah_soal_by_tipe_and_kelas(0, $kelas->id_kelas);
										
										echo "
										<td>
											".$jumlahsoalsubbab."
										</td>
										"; 
									?>
									<?php
										$jumlahvideo = $this->model_adm->jumlah_pembahasan_video_by_kelas($kelas->id_kelas);
										
										echo "
										<td>
											".$jumlahvideo."
										</td>
										";
									?>
									<td>
									<a href="<?php echo base_url("pg_admin/rekap/detail/".$kelas->id_kelas);?>" class="btn btn-primary btn-sm">
										Detail Rekap
									</a>
									<a class="btn btn-success btn-sm" href="<?php echo base_url("pg_admin/rekap/export/".$kelas->id_kelas);?>" target="_BLANK">
										Export Excel
									</a>
									<a href="<?php echo base_url("pg_admin/rekap/export_by_kurikulum/k13/".$kelas->id_kelas);?>" class="btn btn-primary btn-sm" target="_BLANK">
										<i class="fa fa-file-excel-o" aria-hidden="true"></i> - K13
									</a>
									<a href="<?php echo base_url("pg_admin/rekap/export_by_kurikulum/ktsp/".$kelas->id_kelas);?>" class="btn btn-primary btn-sm" target="_BLANK">
										<i class="fa fa-file-excel-o" aria-hidden="true"></i> - KTSP
									</a>
									</td>
								</tr>
							<?php
								}
							?>
						</tbody>
					</table>
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
