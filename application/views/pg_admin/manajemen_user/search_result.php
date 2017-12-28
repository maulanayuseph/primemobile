<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
	$this->load->view("pg_admin/html_header");
?>

<div class="wrapper">
  <?php
		if($this->session->userdata("level") == "adminpa"){
			$this->load->view('pg_admin/sidebar_pa');
		}else{
			$this->load->view('pg_admin/sidebar');
		}
	?>

  <div class="main-panel">
    <?php
    	$this->load->view("pg_admin/navbar");
    ?>
    
    <div class="content">      
      <div class="container-fluid">
        <?php echo $this->session->flashdata('alert'); ?>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
              	<div class="row">
					<div class="col-sm-6">
						<h4 class="title">Manajemen User</h4>
              		</div>
              	</div>
              </div>
              <div class="content">
				<div class="row">
					<form action="<?php echo base_url("pg_admin/manajemen_user/search");?>" method="GET">
						<div class="col-sm-4">
							<select class="form-control" name="where" required>
								<option value="">
									-- Cari Siswa Berdasarkan --
								</option>
								<option value="username">Username</option>
								<option value="kode_voucher">Kode Voucher</option>
								<option value="no_aktivasi">Nomor Aktivasi</option>
								<option value="nama_siswa">Nama</option>
							</select>
						</div>
						<div class="col-sm-4">
							<input type="text" name="keyword" class="form-control" placeholder="Masukkan Keyword" required>
						</div>
						<div class="col-sm-4">
							<input type="submit" class="btn btn-sm btn-danger" value="cari siswa">
						</div>

					</form>
					<div class="col-sm-12">
						&nbsp;
					</div>
					<div class="col-sm-12">
						<?php
							$x = 1;
							foreach($datasiswa as $siswa){
								?>
								<div class="col-sm-3 card text-center" style="word-wrap: initial;">
										<br>
										<br>
									 <img src="<?php 
									if($siswa->foto == ""){
									echo base_url('assets/uploads/foto_siswa/default.jpg');
									}else{
									echo base_url('assets/uploads/foto_siswa/'.$siswa->foto);
									}
									?>" class="img img-responsive img-thumbnail" style="height: 100px;">
									<p>
									<p>
									<strong><span id="nama-<?php echo $siswa->id_login;?>"><?php echo $siswa->nama_siswa;?></span></strong>
									<br><?php echo $siswa->username;?>
									<br>
									<?php echo $siswa->nama_sekolah;?>
									<br>
									<?php echo $siswa->nama_kota;?>
									<br>
									<br>
									<?php echo $siswa->kode_voucher;?>
									<br>
									<?php echo $siswa->no_aktivasi;?>
									<br>
									<br>

									<div class="col-sm-6 text-center">
										<button class="btn btn-sm btn-danger reset" style="width: 100%;" id="siswa-<?php echo $siswa->id_login;?>">Reset Password</button>
									</div>
									<div class="col-sm-6 text-center">
										<button class="btn btn-sm btn-danger reset-login" style="width: 100%;" id="login-<?php echo $siswa->id_siswa;?>">Reset Login</button>
									</div>
								</div>
								<?php
								if($x%4 == 0){
									?>
									<div class="col-sm-12">
										<br>&nbsp;
									</div>
									<?php
								}
								$x++;
							}
						?>
					</div>
				</div>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->
    <?php
    	$this->load->view("pg_admin/footer");
    ?>
  </div>
</div>

<?php
	$this->load->view("pg_admin/modal_ajax");
?>
</body>



<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-1.10.2.js" type="text/javascript');?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<!--<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script> -->

<!-- Bootstrap Switch Plugin -->
<script src="<?php echo base_url('assets/js/plugins/bootstrap-switch/bootstrap-switch.min.js');?>"></script>

<!-- Progress -->
<script src="<?= base_url('assets/js/nprogress.js')?>" ></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>



<script type="text/javascript">
$(function(){

$('table.display').DataTable();

$(".reset").click(function(){
	rawid 		= $(this).attr("id");
	idsplit		= rawid.split("-");
	idlogin 	= idsplit[1];
	namasiswa 	= $("#nama-" + idlogin).html();
	if(confirm("Apakah anda yakin untuk melakukan reset login " + namasiswa + " ?")){
		$.ajax({
			type: 'POST',
			url: 'reset_password',
			data:{
				'idlogin'	: idlogin
			}
		});
	}
})

$(".reset-login").click(function(){
	rawid 		= $(this).attr("id");
	idsplit		= rawid.split("-");
	idsiswa 	= idsplit[1];
	if(confirm("Apakah anda yakin untuk melakukan reset login aktif?")){
		$.ajax({
			type: 'POST',
			url: 'reset_login',
			data:{
				'idsiswa'	: idsiswa
			}
		});
	}
})

$(document).ajaxSend(function(event, jqxhr, settings){
	$('#text-load').html('Proses reset login');
	$('#modal-loader').modal('show');
});
$(document).ajaxSuccess(function(event, request, options){
	if(options.url === "reset_password"){
		$('#modal-loader').modal('hide');
		alert("Reset berhasil, password diganti menjadi default (123456)");
	}
	if(options.url === "reset_login"){
		$('#modal-loader').modal('hide');
		alert("Reset berhasil, User bisa coba login kembali");
	}
});
$(document).ajaxError(function(event, request, options){
	if(options.url === "reset_password"){
		$('#modal-loader').modal('hide');
		$('#modal-error').appendTo("body").modal('show');
	}
	if(options.url === "reset_login"){
		$('#modal-loader').modal('hide');
		$('#modal-error').appendTo("body").modal('show');
	}
});

})
</script>

</html>
