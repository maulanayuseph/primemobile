<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>
<script>
$(function(){
	$("#kelas").change(function(){
		$("#daftarsiswa").load("ajax_siswa_by_kelas/" + $("#kelas").val());
		$("#kelasparalel").load("ajax_kelas_paralel_by_kelas/" + $("#kelas").val());
	});
	
	$("#carinama").keyup(function(){
		$("#daftarsiswa").load("ajax_siswa_by_nama/" + encodeURI($("#carinama").val()));
	});
});
</script>

<script>
$(function(){
	/*
	$('#checkall').click(function(){
		if($('#checkall').is(':checked')) {
			$("input:checkbox").attr('checked', true);
			$("#checkall").attr('checked', true);
		}else{
			$("input:checkbox").attr('checked', false);
			$("#checkall").attr('checked', false);
		}
	});
	*/
	$( '#checkall' ).click( function () {
		$( '#daftarsiswa input[type="checkbox"]' ).prop('checked', this.checked)
	  })
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
                <h4 class="title">Rancangan Studi Siswa <?php echo $sekolah->nama_sekolah;?></h4>
              </div>
              <div class="content">
                <div class="row">
					<div class="col-md-4">
						<p>Filter Siswa
						<select class="form-control" id="kelas">
							<option value="">-- Pilih Kelas --</option>
							<?php
								foreach($datakelas as $kelas){
							?>
								<option value="<?php echo $kelas->id_kelas;?>"><?php echo $kelas->alias_kelas;?></option>
							<?php
								}
							?>
						</select>
					</div>
					<div class="col-md-8">
						<p>Cari Nama Siswa
						<input type="text" name="nama" class="form-control" id="carinama"/>
					</div>
					<div class="col-md-12">
						<form action="<?php echo base_url("psep_sekolah/siswa/insert_siswa_paralel");?>" method="post">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>No.</th>
									<th>Kelas</th>
									<th>Siswa</th>
									<th style="width: 5%; text-align: center;">
									<input type="checkbox" id="checkall"/>
									</th>
								</tr>
							</thead>
							<tbody id="daftarsiswa">
								
							</tbody>
						</table>
						<table class="table">
							<tr>
								<td>Kelas : </td>
								<td>
									<select class="form-control" name="kelasparalel" id="kelasparalel" required>
										<option value="">-- Pilih Kelas Paralel --</option>
									</select>
								</td>
								<td>
									Tahun Ajaran :
								</td>
								<td>
									<select class="form-control" name="tahunajaran" required>
										<option value="">-- Pilih Tahun Ajaran --</option>
										<?php
											foreach($datatahunajaran as $tahun){
										?>
											<option value="<?php echo $tahun->id_tahun_ajaran;?>"><?php echo $tahun->tahun_ajaran;?></option>
										<?php
											}
										?>
									</select>
								</td>
								<td>
									<input type="submit" value="Register Siswa" class="btn btn-primary"/>
								</td>
							</tr>
						</table>
						</form>
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
