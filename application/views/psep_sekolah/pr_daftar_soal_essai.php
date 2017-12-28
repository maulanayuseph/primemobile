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
						<a href="<?php echo base_url("psep_sekolah/pr/tambah_soal_essay/".$infopr->id_pr);?>" class="btn btn-sm btn-success">
						<i class="fa fa-plus" aria-hidden="true"></i>
						</a>
					</div>
					<div class="col-md-12">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>No.</th>
									<th>Soal</th>
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
											<p><strong>Pertanyaan :</strong></p>
											<?php echo $soal->soal;?>
											<p><strong>Jawaban :</strong></p>
											<?php echo $soal->jawaban;?>
										</td>
										<td class="text-center">
											<a href="<?php echo base_url("psep_sekolah/pr/edit_soal_essai/" . $soal->id_soal_essai);?>" class="btn btn-sm btn-warning" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-pencil" aria-hidden="true"></i></a>
											<a href="<?php echo base_url("psep_sekolah/pr/hapus_soal_essai/" . $soal->id_soal_essai);?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus pertanyaan');"><i class="fa fa-remove" aria-hidden="true"></i></a>
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
</html>
