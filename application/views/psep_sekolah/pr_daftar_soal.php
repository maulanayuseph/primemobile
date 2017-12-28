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
					
					<div class="col-md-12" style="text-align: right;">
						<a href="<?php echo base_url("psep_sekolah/pr/tambah_soal/".$infopr->id_pr);?>" class="btn btn-sm btn-success">
						<i class="fa fa-plus" aria-hidden="true"></i>
						</a>
					</div>
					<div class="col-md-12">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>No.</th>
									<th>Soal</th>
									<th>Kunci Jawaban</th>
									<th>Operasi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$x = 1;
									foreach($datasoal as $soal){
										?>
										<tr>
											<td><?php echo $x;?></td>
											<td>
												<div class="panel panel-default">
													<div class="panel-body">
														<?php echo $soal->pertanyaan;?>
													
														<div class="col-md-12">
															Pilihan Jawaban : 
														</div>
														<div class="col-md-6">
															A. <?php echo $soal->jawab_1;?>
														</div>
														<div class="col-md-6">
															B. <?php echo $soal->jawab_2;?>
														</div>
														<div class="col-md-12">
															&nbsp;
														</div>
														<div class="col-md-6">
															C. <?php echo $soal->jawab_3;?>
														</div>
														<div class="col-md-6">
															D. <?php echo $soal->jawab_4;?>
														</div>
														<div class="col-md-6">
															E. <?php echo $soal->jawab_5;?>
														</div>
													</div>
												</div>
											</td>
											<td>
												<?php echo $soal->kunci;?>
											</td>
											<td>
												<a href="<?php echo base_url("psep_sekolah/pr/hapus_soal/".$soal->id_soal_pr . "/" . $infopr->id_pr);?>" onclick="return confirm('Apakah anda yakin ingin menghapus soal ini ?')" class="btn btn-sm btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a>
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
