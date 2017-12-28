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
                <h4 class="title">Data Tahun Ajaran <?php echo $sekolah->nama_sekolah;?></h4>
              </div>
              <div class="content">
                <div class="row">
                  <div class="col-md-4">
					<form action="<?php echo base_url("psep_sekolah/tahun_ajaran/proses_tambah");?>" method="post">
						<h4>Tambah Tahun Ajaran Baru</h4>
						<p>
						<input type="text" name="tahun" class="form-control" required/>
						<p>
						<input type="submit" class="btn btn-primary" value="Tambah Tahun Ajaran" />
					</form>
				</div>
				<div class="col-md-8">
					<br>&nbsp;
					<br>&nbsp;
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>Tahun Ajaran</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$x = 1;
								foreach($datatahunajaran as $tahun){
							?>
							<tr>
								<td>
									<?php echo $x;?>
								</td>
								<td>
									<?php echo $tahun->tahun_ajaran;?>
								</td>
								<td>
									<a href="<?php echo base_url("psep_sekolah/tahun_ajaran/edit/".$tahun->id_tahun_ajaran);?>" class="btn btn-warning">
										<i class="fa fa-pencil" aria-hidden="true"></i>
									</a>
									<a href="<?php echo base_url("psep_sekolah/tahun_ajaran/hapus/".$tahun->id_tahun_ajaran);?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus tahun ajaran <?php echo $tahun->tahun_ajaran;?> ?')">
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
