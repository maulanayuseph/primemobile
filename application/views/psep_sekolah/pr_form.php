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
                <h4 class="title">Tambah Tugas Baru</h4>
              </div>
              <div class="content">
                <div class="row">
					<form action="<?php echo base_url("psep_sekolah/pr/proses_tambah");?>" method="post">
					<!--
					<div class="col-md-4">
						<select class="form-control" id="kelas" name="kelas" required>
							<option value="">-- Pilih Kelas --</option>
							<?php
								foreach($kelasparalel as $kelas){
							?>
								<option value="<?php echo $kelas->id_kelas_paralel;?>"><?php echo $kelas->alias_kelas;?> - <?php echo $kelas->kelas_paralel;?></option>
							<?php
								}
							?>
						</select>
					</div>
					<div class="col-md-4">
						<select class="form-control" id="tahunajaran" name="tahun" required>
							<option value="">-- Pilih Tahun Ajaran --</option>
							<?php
								foreach($datatahunajaran as $tahun){
							?>
								<option value="<?php echo $tahun->id_tahun_ajaran;?>"><?php echo $tahun->tahun_ajaran;?></option>
							<?php
								}
							?>
						</select>
					</div>
					-->
					<div class="col-md-4">
						<p>Nama Tugas :
						<p><input type="text" name="nama" class="form-control" placeholder="Masukkan Nama PR" required/>
					</div>
					<div class="col-md-4">
						<p>Tipe Tugas :
						<p><select name="tipe" class="form-control" required>
							<option value="">-- Pilih Tipe Tugas --</option>
							<option value="1">Pilihan Ganda</option>
							<option value="2">Jawaban Eksakta</option>
							<option value="3">Essay</option>
						</select>
					</div>
					<div class="col-md-4">
						<p>&nbsp;
						<p><input type="submit" class="btn btn-primary" value="Lanjut" />
					</div>
					<!--
					<div class="col-md-6">
						<p>&nbsp;
						<p>Tanggal Penyelesaian :
						<p>
						<input type="text" name="deadline" id="datepicker" class="form-control" required/>
					</div>
					-->
					</form>
					<p>&nbsp;
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
