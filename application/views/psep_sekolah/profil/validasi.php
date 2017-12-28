<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
$this->load->view("psep_sekolah/html_header");
?>
<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<form method="post" action="<?php echo base_url('psep_sekolah/profil/proses_validasi');?>" enctype='multipart/form-data'>
		  <div class="modal-body">
		  	<div class="row">
		  		<div class="col-sm-12">
		  			<p>Terima kasih telah menggunakan layanan PSEP Prime Mobile. Silahkan isi data diri di bawah ini untuk validasi dan pelengkap profil guru sebelum masuk ke sistem PSEP</p>
		    		<hr>
		  		</div>
		  		<div class="col-sm-12">
		  			<?php echo $this->session->flashdata('alert'); ?>
		  		</div>
		  		<div class="col-sm-6">
		  			<div class="form-group">
						<label for="inputnama">Nama :</label>
						<input type="text" name="nama" class="form-control" id="inputnama" placeholder="Nama" required>
					</div>
					<div class="form-group">
						<label for="inputemail">Email :</label>
						<input type="text" name="email" class="form-control" id="inputemail" placeholder="Email" required>
					</div>
					<div class="form-group">
						<label for="inputhp">HP :</label>
						<input type="text" name="hp" class="form-control" id="inputhp" placeholder="08123456789" required>
					</div>
		  		</div>
		  		<div class="col-sm-6">
		  			<div class="form-group">
						<label for="inputprovinsi">Provinsi :</label>
						<select id="inputprovinsi" name="provinsi" class="form-control" required>
							<option value="">-- Pilih Provinsi --</option>
							<?php
								foreach ($dataprovinsi as $provinsi) {
									?>
									<option value="<?php echo $provinsi->id_provinsi;?>"><?php echo $provinsi->nama_provinsi;?></option>
									<?php
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="inputkota">Kota / Kabupaten :</label>
						<select id="inputkota" name="kota" class="form-control" required>
							<option value="">-- Pilih Kota --</option>
						</select>
					</div>
					<div class="form-group">
						<label for="inputalamat">Alamat :</label>
						<textarea id="inputalamat" name="alamat" class="form-control" required=""></textarea>
					</div>
		  		</div>
		  		<div class="col-sm-12">
		  			<div class="form-group">
						<label for="inputfoto">Foto :</label>
						<input type="file" name="foto" class="form-control" id="inputfoto" aria-describedby="helpinputfoto" required>
						<span id="helpinputfoto" class="help-block">Maksimal ukuran file 2MB</span>
					</div>
		  		</div>
		  	</div>

		  </div>
		  <div class="modal-footer">
		    <input type="submit" class="btn btn-primary" value="Simpan Profil"/>
		  </div>
		</form>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<?php $this->load->view("psep_sekolah/modal_ajax");;?>
</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>


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
