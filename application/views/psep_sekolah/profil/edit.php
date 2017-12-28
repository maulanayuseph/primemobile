<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
$this->load->view("psep_sekolah/html_header");
?>


<div class="wrapper">
  <?php
  	$this->load->view("psep_sekolah/sidebar");
  ?>

  <div class="main-panel">
    <?php
		$this->load->view("psep_sekolah/navbar");
	?>
    
    <div class="content">      
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
                <h4 class="title">Edit Profil Guru</h4>
              </div>
              <div class="content">
                <div class="row">
					<div class="col-sm-12">
			  			<?php echo $this->session->flashdata('alert'); ?>
			  		</div>
			  		<form method="post" action="<?php echo base_url('psep_sekolah/profil/proses_edit');?>">
				  		<div class="col-sm-6">
				  			<div class="form-group">
								<label for="inputnama">Nama :</label>
								<input type="text" name="nama" class="form-control" id="inputnama" placeholder="Nama" value="<?php echo $guru->nama;?>" required>
							</div>
							<div class="form-group">
								<label for="inputemail">Email :</label>
								<input type="text" name="email" class="form-control" id="inputemail" placeholder="Email" value="<?php echo $guru->email;?>" required>
							</div>
							<div class="form-group">
								<label for="inputhp">HP :</label>
								<input type="text" name="hp" class="form-control" id="inputhp" placeholder="08123456789" value="<?php echo $guru->hp;?>" required>
							</div>
				  		</div>
				  		<div class="col-sm-6">
				  			<div class="form-group">
								<label for="inputprovinsi">Provinsi :</label>
								<select id="inputprovinsi" name="provinsi" class="form-control" required>
									<option value="">-- Pilih Provinsi --</option>
									<?php
										foreach ($dataprovinsi as $provinsi) {
											if($provinsi->id_provinsi == $kota->provinsi_id){
												$selected = "selected";
											}else{
												$selected = "";
											}
											?>
											<option value="<?php echo $provinsi->id_provinsi;?>" <?php echo $selected;?>><?php echo $provinsi->nama_provinsi;?></option>
											<?php
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="inputkota">Kota / Kabupaten :</label>
								<select id="inputkota" name="kota" class="form-control" required>
									<option value="">-- Pilih Kota --</option>
									<?php
										foreach($kotabyprovinsi as $kota){
											if($kota->id_kota == $guru->id_kota){
												$selected = "selected";
											}else{
												$selected = "";
											}
											?>
											<option value="<?php echo $kota->id_kota;?>" <?php echo $selected;?>><?php echo $kota->nama_kota;?></option>
											<?php
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="inputalamat">Alamat :</label>
								<textarea id="inputalamat" name="alamat" class="form-control" required=""><?php echo $guru->alamat;?></textarea>
							</div>
				  		</div>
				  		<div class="col-sm-12" style="text-align: right;">
							<input type="submit" name="submit" value="Simpan Profil" class="btn btn-sm btn-danger">
				  		</div>
				  	</form>
				  	<hr>
                </div>

              </div>
              <div class="header">
                <h4 class="title">Upload Foto Profil Baru</h4>
              </div>
              <div class="content">
                <div class="row">
                	<div class="col-sm-6">
                		<form method="post" action="<?php echo base_url("psep_sekolah/profil/upload_foto");?>"  enctype='multipart/form-data'>
	                		<label for="inputalamat">Pilih File :</label>
	                		<input type="file" name="foto" class="form-control">
	                		<span id="helpinputfoto" class="help-block">Maksimal ukuran file 2MB</span>
	                		<br>

	                		<input type="submit" name="upload" value="Upload Foto" class="btn btn-sm btn-danger" style="width: 100%;">
                		</form>
                	</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->

    <?php
		$this->load->view("psep_sekolah/footer");
	?>

  </div>
</div>
<?php $this->load->view("psep_sekolah/modal_ajax");;?>
</body>

<!--   Core JS Files   -->
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
<script type="text/javascript">
$(function(){
	$("#inputprovinsi").change(function(){
		idprovinsi = $(this).val();
		if(idprovinsi !== ""){
			$("#inputkota").load("ajax_kota/" + idprovinsi);
		}
	})
	$(document).ajaxSend(function(event, jqxhr, settings){
		$('#modal-loader').appendTo("body").modal('show');
	});
	$(document).ajaxSuccess(function(event, request, options){
		$('#modal-loader').modal('hide');
	});
	$(document).ajaxError(function(event, request, options){
		$('#modal-loader').modal('hide');
		$('#modal-error').appendTo("body").modal('show');
	});
});
</script>

</html>
