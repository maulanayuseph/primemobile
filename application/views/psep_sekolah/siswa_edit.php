<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>
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
                <h4 class="title">Edit Data Siswa <?php echo $sekolah->nama_sekolah;?></h4>
              </div>
              <div class="content">
                <div class="row">
					<div class="col-md-6">
						<table class="table table-striped">
							<tr>
								<td>Nama Siswa</td>
								<td> : </td>
								<td><?php echo $siswa->nama_siswa;?></td>
							</tr>
							<tr>
								<td>Kelas</td>
								<td> : </td>
								<td><?php echo $siswa->alias_kelas;?> - <?php echo $siswa->kelas_paralel;?></td>
							</tr>
							<tr>
								<td>Tahun Ajaran</td>
								<td> : </td>
								<td><?php echo $siswa->tahun_ajaran;?></td>
							</tr>
						</table>
					</div>
					<div class="col-md-12">
						&nbsp;
					</div>
					<div class="col-md-6">
						<h4>Edit Rancangan Studi Siswa</h4>
						<form action="<?php echo base_url("psep_sekolah/siswa/proses_edit");?>" method="post">
						<input type="hidden" name="idsiswapsep" value="<?php echo $siswa->id_siswa_psep;?>" />
						<table class="table table-striped">
							<tr>
								<td>Kelas</td>
								<td> : </td>
								<td>
									<select name="kelasparalel" class="form-control">
										<option value="<?php echo $siswa->id_kelas_paralel;?>"><?php echo $siswa->kelas_paralel;?></option>
										<?php 
											foreach($kelasparalel as $paralel){
										?>
											<option value="<?php echo $paralel->id_kelas_paralel;?>"><?php echo $paralel->kelas_paralel;?></option>
										<?php
											}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td>Tahun Ajaran</td>
								<td> : </td>
								<td>
									<select name="tahunajaran" class="form-control">
										<option value="<?php echo $siswa->id_tahun_ajaran;?>"><?php echo $siswa->tahun_ajaran;?></option>
										<?php 
											foreach($datatahunajaran as $tahun){
										?>
											<option value="<?php echo $tahun->id_tahun_ajaran;?>"><?php echo $tahun->tahun_ajaran;?></option>
										<?php
											}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td><input type="submit" value="Simpan Data Siswa" class="btn btn-primary btn-sm"/></td>
								<td></td>
								<td></td>
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
