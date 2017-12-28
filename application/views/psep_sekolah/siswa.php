<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>
<script>
$(function(){
	$("#kelas").change(function(){
		$("#daftarsiswa").load("siswa/ajax_siswa/" + $("#kelas").val() + "/" + $("#tahunajaran").val());
	});
	$("#tahunajaran").change(function(){
		$("#daftarsiswa").load("siswa/ajax_siswa/" + $("#kelas").val() + "/" + $("#tahunajaran").val());
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
                <h4 class="title">Data Siswa <?php echo $sekolah->nama_sekolah;?></h4>
              </div>
              <div class="content">
                <div class="row">
					<div class="col-md-12">
						<table class="table">
							<thead>
								<th>Kelas</th>
								<th>:</th>
								<th>
									<select class="form-control" id="kelas">
										<option value="0">-- Pilih Kelas --</option>
										<?php
											foreach($kelasparalel as $kelas){
										?>
											<option value="<?php echo $kelas->id_kelas_paralel;?>"><?php echo $kelas->alias_kelas;?> - <?php echo $kelas->kelas_paralel;?></option>
										<?php
											}
										?>
									</select>
								</th>
								<th>Tahun Ajaran</th>
								<th>:</th>
								<th>
									<select class="form-control" id="tahunajaran">
										<option value="0">-- Pilih Tahun Ajaran --</option>
										<?php
											foreach($datatahunajaran as $tahun){
										?>
											<option value="<?php echo $tahun->id_tahun_ajaran;?>"><?php echo $tahun->tahun_ajaran;?></option>
										<?php
											}
										?>
									</select>
								</th>
							</thead>
						</table>
					</div>
					<div class="col-md-12">
						<table class="table table-bordered table-striped table-hover">
							<thead>
								<tr>
									<th class="text-center">No.</th>
									<th class="text-center">Nama Siswa</th>
									<th class="text-center">Kelas</th>
									<th class="text-center">Tahun Ajaran</th>
									<th class="text-center">Operasi</th>
								</tr>
							</thead>
							<tbody id="daftarsiswa">
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
