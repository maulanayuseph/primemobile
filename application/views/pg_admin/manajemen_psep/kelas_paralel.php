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
						<h4 class="title">Otomatisasi Kelas Paralel</h4>
              		</div>
              	</div>
              </div>
              <div class="content">
				<div class="row">
					<div class="col-sm-6">
						<div class="col-sm-12 text-center">
							<h4>Kelas Paralel</h4>
						</div>
						<div class="col-sm-12">
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
						<div class="col-sm-12">
							<strong>Pilih Kota/Kabupaten</strong>
							<br>
							<select class="form-control" id="kota">
								<option value=''>-- Pilih Kota/Kabupaten --</option>
							</select>
						</div>
						<div class="col-sm-12">
							<strong>Pilih Sekolah</strong>
							<br>
							<select class="form-control" id="sekolah" name="sekolah" required>
								<option value=''>-- Pilih Sekolah --</option>
							</select>
						</div>
						<div class="col-sm-12">
							<strong>Nama Kelas Paralel Baru :</strong>
							<br>
							<input type="text" name="input-kelas" class="form-control">
						</div>
						<div class="col-sm-12">
							<button class="btn btn-danger btn-sm tambah-kelas" style="width: 100%;">Tambah Kelas Paralel</button>
						</div>
						<div class="col-sm-12">
							<br>&nbsp;
						</div>
						<div class="col-sm-12" id="daftar-kelas-paralel">
						</div>
					</div>
					<div class="col-sm-6">
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
	$("#provinsi").change(function(){
		$("#kota").load("../sekolah/ajax_kota/" + $(this).val());
	});
	$("#kota").change(function(){
		$("#sekolah").load("../sekolah/ajax_sekolah/" + $(this).val());
	});

	$("#sekolah").change(function(){
		idsekolah = $(this).val();
		if(idsekolah !== ""){
			$("#daftar-kelas-paralel").load("../akun_psep/ajax_kelas_paralel/" + idsekolah);
		}
	})

	$("#daftar-kelas-paralel").on('click', '.edit-kelas', function(){
		$("#mainmodaltitle").html("Edit Kelas");
		$("#mainmodalcontent").html("asadasdasd");
	})
})
</script>

</html>
