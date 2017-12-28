<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view('pg_admin/html_header'); ?>

<div class="wrapper">
<?php
	if($this->session->userdata("level") == "adminpa"){
		$this->load->view('pg_admin/sidebar_pa');
	}else{
		$this->load->view('pg_admin/sidebar');
	}
?>

  <div class="main-panel">
		<?php $this->load->view('pg_admin/navbar'); ?>
    
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
                <h4 class="title"><?= $judul ?></h4>
                <?php echo $this->session->flashdata('alert'); ?>
              </div>
              <div class="content">
              	<div class="row">
					<form method="post" action="<?php echo base_url("pg_admin/sekolah/proses_import_siswa");?>" enctype="multipart/form-data">
						<div class="col-sm-4" style="padding-left: 6px;">
							<strong>Pilih Provinsi</strong>
							<br>
							<select class="form-control" id="provinsi">
								<option value="0">-- Pilih Provinsi --</option>
								<?php
									foreach($select_provinsi as $pro){
										?>
										<option value="<?php echo $pro->id_provinsi;?>"><?php echo $pro->nama_provinsi;?></option>
										<?php
									}
								?>
							</select>
						</div>
						<div class="col-sm-4">
							<strong>Pilih Kota/Kabupaten</strong>
							<br>
							<select class="form-control" id="kota">
								
							</select>
						</div>
						<div class="col-sm-4">
							<strong>Pilih Sekolah</strong>
							<br>
							<select class="form-control" id="sekolah" name="sekolah" required>
								
							</select>
						</div>
						<div class="col-sm-12 text-center">
							<br>&nbsp;
						</div>
						<div class="col-sm-4">
							<strong>Pilih Kelas</strong>
							<br>
							<select class="form-control" id="kelas" name="kelas" required>
								
							</select>
						</div>
						<div class="col-sm-4">
							<strong>Pilih Tahun Ajaran</strong>
							<br>
							<select class="form-control" id="tahun" name="tahun" required>
								
							</select>
						</div>
						<div class="col-sm-4">
							<strong>File CSV Siswa</strong>
							<br>
							<input type="file" name="userfile" />
						</div>
						<div class="col-sm-12 text-center">
							<input type="submit" value="proses" class="btn btn-sm btn-primary"/>
						</div>
					</form>
				</div>
            </div>
          </div>
        </div>
        
      </div>
    </div>

		<?php $this->load->view('pg_admin/footer'); ?>

  </div>
</div>

</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-1.10.2.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="<?php echo base_url('assets/js/demo.js');?>"></script>

<!-- CUSTOM JS FUNCTION -->
<!-- Reset Form -->


<!-- PLUGINS FUNCTION -->
<!-- Chosen - select box plugin  -->
<script src="<?php echo base_url('assets/js/plugins/chosen/chosen.jquery.js');?>" type="text/javascript"></script>

<script>
$(function(){
	$("#provinsi").change(function(){
		$("#kota").load("ajax_kota/" + $(this).val());
	});
	$("#kota").change(function(){
		$("#sekolah").load("ajax_sekolah/" + $(this).val());
	});
	$("#sekolah").change(function(){
		$("#kelas").load("ajax_kelas/" + $(this).val());
		$("#tahun").load("ajax_tahun/" + $(this).val());
	});
});
</script>

</html>
