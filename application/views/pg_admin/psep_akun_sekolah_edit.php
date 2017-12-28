<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>
<script>
$(function(){
	$("#provinsi").change(function(){
		$("#kota").load("../ajax_kota/" + $("#provinsi").val());
	});
	$("#kota").change(function(){
		$("#sekolah").load("../ajax_sekolah/" + $("#kota").val());
	});
});
</script>
<div class="wrapper">
 <?php
    if($this->session->userdata("level") == "adminpa"){
      include "sidebar_pa.php";
    }else{
      include "sidebar.php";
    }
  ?>

  <div class="main-panel">
    <?php include "navbar.php"; ?>
    
    <div class="content">      
      <div class="container-fluid">
        <?php echo $this->session->flashdata('alert'); ?>

        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="header">
                <h4 class="title">Tambah Akun Sekolah</h4>
              </div>
              <div class="content">
                <form action="<?php echo base_url('pg_admin/akun_psep/proses_edit_akun_sekolah');?>" method="post">
				<input type="hidden" name="idlogin" value="<?php echo $sekolah->id_login_sekolah;?>" />
					<div class="form-group">
						<label>Provinsi<span class="text-danger">*</span></label>
						<select id="provinsi" class="form-control" required>
							<option value="<?php echo $sekolah->id_provinsi;?>"><?php echo $sekolah->nama_provinsi;?></option>
							<?php
								foreach($dataprovinsi as $provinsi){
							?>
								<option value="<?php echo $provinsi->id_provinsi;?>"><?php echo $provinsi->nama_provinsi;?></option>
							<?php
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Kota / Kabupaten<span class="text-danger">*</span></label>
						<select id="kota" class="form-control" required>
							<option value="<?php echo $sekolah->id_kota;?>"><?php echo $sekolah->nama_kota;?></option>
						</select>
					</div>
					<div class="form-group">
						<label>Sekolah<span class="text-danger">*</span></label>
						<select id="sekolah" name="sekolah" class="form-control" required>
							<option value="<?php echo $sekolah->id_sekolah;?>"><?php echo $sekolah->nama_sekolah;?></option>
						</select>
					</div>
					<div class="form-group">
						<label>Username<span class="text-danger">*</span></label>
						<input type="text" name="username" class="form-control" placeholder="Masukkan Username..." value="<?php echo $sekolah->username;?>" required />
					</div>
					<input type="submit" class="btn btn-primary" value="Simpan Akun" />
				</form>
              </div>
            </div>
          </div>
        </div>
      </div> 
    </div> <!-- end .content -->

    <?php include "footer.php"; ?>
    
  </div> <!-- end .main-panel -->
</div>

<?php include "alert_modal.php"; ?>
</body>

  <!--   Core JS Files   -->
 <script src="<?php echo base_url('assets/js/jquery-1.10.2.js" type="text/javascript');?>"></script>
 <script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>

 <!--  Checkbox, Radio & Switch Plugins -->
 <script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>


<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>


</html>
