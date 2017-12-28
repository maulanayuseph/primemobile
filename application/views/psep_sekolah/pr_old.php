<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>
<script>
$(function(){
	$("#kelas").change(function(){
		$("#listpr").load("pr/ajax_pr/" + $("#kelas").val() + "/" + $("#tahunajaran").val());
	});
	$("#tahunajaran").change(function(){
		$("#listpr").load("pr/ajax_pr/" + $("#kelas").val() + "/" + $("#tahunajaran").val());
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
                <h4 class="title">Daftar Semua Tugas</h4>
              </div>
              <div class="content">
                <div class="row">
					<div class="col-md-12">
						<a href="<?php echo base_url("psep_sekolah/pr/tambah");?>" class="btn btn-primary" style="width: 100%;">Tambah Tugas</a>
					</div>
					<p>&nbsp;
					<div class="col-md-12" id="listpr">
						<div class="table-responsive">
						  <table id="" class="table table-striped table-hover display">
							<thead>
							  <tr>
								<th style="width: 20px;">No. </th>
								<th>Tugas</th>
								<th>Tipe PR</th>
								<th>Operasi</th>
							  </tr>
							</thead>
							<tbody>
							  <?php
								$x = 1;
								foreach($datapr as $pr){
									$jumlahselesai	= $this->model_psep->jumlah_selesai($pr->id_pr);
									$jumlahterkoreksi 	= $this->model_psep->jumlah_terkoreksi($pr->id_pr);
									$jumlahkoreksi 	= $this->model_psep->jumlah_koreksi($pr->id_pr);
									?>
										<tr>
											<td><?php echo $x;?></td>
											<td><strong><?php echo $pr->nama_pr;?></strong>
											<ul>
												<li><?php
												echo $jumlahselesai + $jumlahterkoreksi;
												?> Siswa Selesai</li>
												<?php
												if($pr->tipe == 2 or $pr->tipe == 3){
													if($jumlahkoreksi > 0){
														?>
														<li style="color: red;"><?php echo $jumlahkoreksi;?> Menunggu Koreksi</li>
														<?php
													}
												}
												?>
											</ul>
											</td>
											<td>
											<?php
											if($pr->tipe == 1){
												echo "Pilihan Ganda";
											}elseif($pr->tipe == 2){
												echo"Jawaban Eksak";
											}elseif($pr->tipe == 3){
												echo"Jawaban Essai";
											}
											?>
											</td>
											<td class="text-center">
											<?php
											if($pr->tipe == 1){
												?>
												<a href="<?php echo base_url("psep_sekolah/pr/daftar_soal/".$pr->id_pr);?>" class="btn btn-sm btn-success"><i class="fa fa-book" aria-hidden="true"></i></a>
												<?php
											}elseif($pr->tipe == 2){
												?>
												<a href="<?php echo base_url("psep_sekolah/pr/daftar_soal_eksak/".$pr->id_pr);?>" class="btn btn-sm btn-success"><i class="fa fa-book" aria-hidden="true"></i></a>
												<?php
											}elseif($pr->tipe == 3){
												?>
												<a href="<?php echo base_url("psep_sekolah/pr/daftar_soal_essai/".$pr->id_pr);?>" class="btn btn-sm btn-success"><i class="fa fa-book" aria-hidden="true"></i></a>
												<?php
											}
											?>
												<a href="<?php echo base_url("psep_sekolah/pr/edit/".$pr->id_pr);?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
												<a href="<?php echo base_url("psep_sekolah/pr/hapus/".$pr->id_pr);?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus PR <?php echo $pr->nama_pr;?>? semua soal dan penilaian siswa akan ikut terhapus.');"><i class="fa fa-remove" aria-hidden="true"></i></a>
											<?php
											if($pr->tipe == 1){
												?>
												<a href="<?php echo base_url("psep_sekolah/pr/rekap/".$pr->id_pr);?>" class="btn btn-sm btn-primary"><i class="fa fa-list-alt" aria-hidden="true"></i></a>
												<?php
											}elseif($pr->tipe == 2){
												?>
												<a href="<?php echo base_url("psep_sekolah/pr/rekap_eksak/".$pr->id_pr);?>" class="btn btn-sm btn-primary"><i class="fa fa-list-alt" aria-hidden="true"></i></a>
												<?php
											}elseif($pr->tipe == 3){
												?>
												<a href="<?php echo base_url("psep_sekolah/pr/rekap_essai/".$pr->id_pr);?>" class="btn btn-sm btn-primary"><i class="fa fa-list-alt" aria-hidden="true"></i></a>
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
        </div>
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->

    <?php include "footer.php"; ?>

  </div>
</div>

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
 <!--  Datatables Plugin -->
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>


<script>
$(document).ready(function() {
    $('table.display').DataTable();
} );
</script>
</html>
