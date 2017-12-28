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
                <h4 class="title">Data Kelas paralel <?php echo $sekolah->nama_sekolah;?></h4>
              </div>
              <div class="content">
                <div class="row">
                  <div class="col-md-4">
					<form action="<?php echo base_url("psep_sekolah/kelas_paralel/proses_tambah");?>" method="post">
						<h4>Tambah Kelas paralel</h4>
						<p>Kelas
						<select class="form-control" name="kelas" required>
							<option value="">-- Pilih Jenjang Kelas --</option>
							<?php
								foreach($datakelas as $kelas){
							?>
							<option value="<?php echo $kelas->id_kelas;?>"><?php echo $kelas->alias_kelas;?></option>
							<?php
								}
							?>
						</select>
						<p>Kelas paralel
						<input type="text" name="kelasparalel" class="form-control" required />
						<p>
						<input type="submit" class="btn btn-primary" value="Tambah Kelas paralel" />
					</form>
				</div>
				<div class="col-md-8">
					<br>&nbsp;
					<br>&nbsp;
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>Kelas</th>
								<th>Kelas Paralel</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$x = 1;
								foreach($kelasparalel as $kelas){
							?>
							<tr>
								<td>
									<?php echo $x;?>
								</td>
								<td>
									<?php echo $kelas->alias_kelas;?>
								</td>
								<td>
									<?php echo $kelas->kelas_paralel;?>
								</td>
								<td>
									<a href="<?php echo base_url("psep_sekolah/kelas_paralel/edit/".$kelas->id_kelas_paralel);?>" class="btn btn-warning">
										<i class="fa fa-pencil" aria-hidden="true"></i>
									</a>
									<a href="<?php echo base_url("psep_sekolah/kelas_paralel/hapus/".$kelas->id_kelas_paralel);?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus <?php echo $kelas->kelas_paralel;?> ?')">
										<i class="fa fa-remove" aria-hidden="true"></i>
									</a>
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
