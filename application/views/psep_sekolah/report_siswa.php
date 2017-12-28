<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>
<script>
/*
$(function(){
	$("#kelas").change(function(){
		$("#listsiswa").load("ajax_siswa_by_jenjang/" + $("#kelas").val());
	});
});
*/
</script>

<script>
$(function(){
	$("#kelas").change(function(){
		$("#listsiswa").load("ajax_siswa/" + $("#kelas").val() + "/" + $("#tahunajaran").val() + "/" + $("#profil").val());
	});
	$("#tahunajaran").change(function(){
		$("#listsiswa").load("ajax_siswa/" + $("#kelas").val() + "/" + $("#tahunajaran").val() + "/" + $("#profil").val());
	});
	$("#profil").change(function(){
		$("#listsiswa").load("ajax_siswa/" + $("#kelas").val() + "/" + $("#tahunajaran").val() + "/" + $(this).val());
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
                <h4 class="title">Report AGCU Siswa</h4>
                <p class="category">Report analisis AGCU siswa</p>
              </div>
              <div class="content">
                <div class="row">
                  <div class="col-md-6">
					<form action="<?php echo base_url("psep_sekolah/agcu/rekap_detail");?>" method="get">
                    <select class="form-control" id="kelas" name="kelas" required>
						<option value="0">-- Pilih Kelas --</option>
						<?php
							foreach($kelasparalel as $kelas){
						?>
							<option value="<?php echo $kelas->id_kelas_paralel;?>"><?php echo $kelas->alias_kelas;?> - <?php echo $kelas->kelas_paralel;?></option>
						<?php
							}
						?>
					</select>
					<select class="form-control" id="tahunajaran" name="tahun" required>
						<option value="0">-- Pilih Tahun Ajaran --</option>
						<?php
							foreach($datatahunajaran as $tahun){
						?>
							<option value="<?php echo $tahun->id_tahun_ajaran;?>"><?php echo $tahun->tahun_ajaran;?></option>
						<?php
							}
						?>
					</select>
					<select class="form-control" id="profil" name="profil" required>
						<option value="0">-- Pilih Profil AGCU --</option>
						<?php
							foreach($dataprofil as $profil){
								?>
								<option value="<?php echo $profil->id_profil_diagnostic;?>"><?php echo $profil->nama_profil_diagnostic;?></option>
								<?php
							}
						?>
					</select>
					<br>&nbsp;
					<br><input type="submit" value="Detail Rekapitulasi" class="btn btn-primary"/>
					<br>&nbsp;
					</form>
					</div>
					<div class="col-md-6">
						<table class="table">
							<tr>
								<td>
									<i class="fa fa-check" aria-hidden="true" style="color: green;"></i>
								</td>
								<td>:</td>
								<td>Siswa Sudah Mengerjakan Test</td>
							</tr>
							<tr>
								<td>
									<i class="fa fa-remove" aria-hidden="true" style="color: red;"></i>
								</td>
								<td>:</td>
								<td>Siswa Belum Mengerjakan Test</td>
							</tr>
							<tr>
								<td colspan="3"><i>* Report AGCU siswa hanya bisa dilihat jika siswa sudah mengerjakan keseluruhan test</i></td>
							</tr>
						</table>
					</div>
					<div class="col-md-12">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No. </th>
								<th>Nama Siswa</th>
								<th>Kelas</th>
								<th>Tahun Ajaran</th>
								<th>Diagnostic Test</th>
								<th>Psychological Test</th>
								<th>Learning Style Test</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody id="listsiswa">
							<tr>
								<td colspan="3"> Pilih Kelas Untuk Menampilkan Data Siswa</td>
							</tr>
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


</html>
