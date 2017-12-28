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
			<div class="col-md-4">
				<div class="card card-user">
					<div class="image">
						<?php
						 if($sekolah->banner !== ""){
							 ?>
							 <img src="<?php echo base_url("assets/uploads/logo-sekolah/" . $sekolah->banner);?>" alt="..."/>
							 <?php
						 }else{
							 ?>
							 <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."/>
							 <?php
						 }
						 ?>
					</div>
					<div class="content">
						<div class="author">
							 <?php
							 if($sekolah->logo !== ""){
								 ?>
								 <img class="avatar border-gray" src="<?php echo base_url("assets/uploads/logo-sekolah/" . $sekolah->logo);?>" alt="..."/>
								 <?php
							 }else{
								 ?>
								 <img class="avatar border-gray" src="<?php echo base_url("assets/pg_user/images/custom/am.jpg");?>" alt="..."/>
								 <?php
							 }
							 ?>
							

							  <h4 class="title"><?php echo $sekolah->nama_sekolah;?><br />
								 <small>&nbsp;
									<?php
										echo $sekolah->motto;
									?>&nbsp;
								 </small>
							  </h4>
						</div>
						<table class="table table-striped">
							<tr>
								<td>Alamat</td>
								<td> : </td>
								<td><?php echo $sekolah->alamat_sekolah;?></td>
							</tr>
							<tr>
								<td>Email</td>
								<td> : </td>
								<td><?php echo $sekolah->email;?></td>
							</tr>
							<tr>
								<td>Telepon</td>
								<td> : </td>
								<td><?php echo $sekolah->telepon;?></td>
							</tr>
						</table>
						
						<div class="row">
							<div class="col-sm-6 text-center">
								<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#uploadlogo">Upload Logo</button>
							</div>
							<div class="col-sm-6 text-center">
								<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#uploadbanner">Upload Banner</button>
							</div>
						</div>
					</div>
					<hr>
				</div>
			</div>
			
			<div class="col-md-8">
				<div class="card">
					<div class="content">
						<div class="row">
							<div class="col-sm-12">
								<form method="post" action="<?php echo base_url("psep_sekolah/profil_sekolah/proses_edit");?>">
									<table class="table table-striped">
										<tr>
											<td>Alamat</td>
											<td> : </td>
											<td>
												<input type="text" name="alamat" value="<?php echo $sekolah->alamat_sekolah;?>" class="form-control"/>
											</td>
										</tr>
										<tr>
											<td>Email</td>
											<td> : </td>
											<td>
												<input type="text" name="email" value="<?php echo $sekolah->email;?>" class="form-control"/>
											</td>
										</tr>
										<tr>
											<td>Telepon</td>
											<td> : </td>
											<td>
												<input type="text" name="telepon" value="<?php echo $sekolah->telepon;?>" class="form-control"/>
											</td>
										</tr>
										<tr>
											<td>Motto</td>
											<td> : </td>
											<td>
												<input type="text" name="motto" value="<?php echo $sekolah->motto;?>" class="form-control"/>
											</td>
										</tr>
									</table>
									<br>
									<br><input type="submit" class="btn btn-sm btn-danger" value="simpan profil" />
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


<!-- Modal -->
<div class="modal fade" id="uploadlogo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Upload Logo Sekolah</h4>
      </div>
	  <form method="post" enctype='multipart/form-data' action="<?php echo base_url("psep_sekolah/profil_sekolah/upload_logo");?>">
		  <div class="modal-body">
				<div class="row">
					<div class="col-sm-12">
						<input type="file" name="logo" class="form-control"/>
					</div>
				</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			<input type="submit" class="btn btn-primary" value="Upload" />
		  </div>
	  </form>
    </div>
  </div>
</div>
</body>

<!-- Modal -->
<div class="modal fade" id="uploadbanner" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Upload Banner Sekolah</h4>
      </div>
	  <form method="post" enctype='multipart/form-data' action="<?php echo base_url("psep_sekolah/profil_sekolah/upload_banner");?>">
		  <div class="modal-body">
				<div class="row">
					<div class="col-sm-12">
						<input type="file" name="banner" class="form-control"/>
					</div>
				</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			<input type="submit" class="btn btn-primary" value="Upload" />
		  </div>
	  </form>
    </div>
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
