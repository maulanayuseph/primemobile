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
					</div>
					<div class="col-md-6">
						<table class="table">
							<tr>
								<td>
									<i class="fa fa-check" aria-hidden="true" style="color: green;"></i>
								</td>
								<td>:</td>
								<td>Siswa Sudah Mengerjakan PR</td>
							</tr>
							<tr>
								<td>
									<i class="fa fa-remove" aria-hidden="true" style="color: red;"></i>
								</td>
								<td>:</td>
								<td>Siswa Belum Mengerjakan PR</td>
							</tr>
						</table>
					</div>
					<div class="col-md-12">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">No.</th>
									<th class="text-center">Nama Siswa</th>
									<th class="text-center">Status</th>
									<th class="text-center">Nilai</th>
									<th class="text-center">Operasi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$x = 1;
									foreach($datasiswa as $siswa){
										?>
										<tr>
											<td><?php echo $x;?></td>
											<td><?php echo $siswa->nama_siswa;?></td>
											<td class="text-center">
											<?php
												$caristatus = $this->model_pr->fetch_status_pr($infopr->id_pr, $siswa->id_siswa);
												if($caristatus == null){
													?>
													<i class="fa fa-remove" aria-hidden="true" style="color: red;"></i>
													<?php
												}else{
													if($caristatus->status == 0){
														?>
														<i class="fa fa-remove" aria-hidden="true" style="color: red;"></i>
														<?php
													}elseif($caristatus->status == 1){
														?>
														<i class="fa fa-check" aria-hidden="true" style="color: green;"></i>
														<?php
													}elseif($caristatus->status == 2){
														?>
														<i class="fa fa-remove" aria-hidden="true" style="color: red;"></i>
														<?php
													}
												}
											?>
											</td>
											<td class="text-center">
												<?php
													if($caristatus == null){
														echo 0;
													}else{
														$jumlahsoal	 	= $this->model_pr->jumlah_soal($infopr->id_pr);
														$jumlahbenar 	= $this->model_pr->jumlah_benar_by_siswa_and_pr($infopr->id_pr, $siswa->id_siswa);
														
														$nilai = ($jumlahbenar / $jumlahsoal) * 100;
														echo $nilai;
													}
													
												?>
											</td>
											<td class="text-center">
												<?php
													if($caristatus == null){
														echo "-";
													}else{
														?>
														<a href="<?php echo base_url("psep_sekolah/pr/detail/" . $infopr->id_pr . "/" . $siswa->id_siswa);?>" class="btn btn-sm btn-success"><i class="fa fa-th-list" aria-hidden="true"></i></a>
														<?php
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

<!-- PLUGINS FUNCTION -->
<!-- Nestable plugin  -->


<script>
$(function(){
$("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
});
</script>
</html>
