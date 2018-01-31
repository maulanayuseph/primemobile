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
              	<div class="row">
              	<div class="col-sm-6">
              		<h4 class="title"><?= $judul ?></h4>
              	</div>
                <div class="col-sm-6" style="text-align: right;">
                	<a class="btn btn-sm btn-success" href="<?php echo base_url("pg_admin/sekolah/aktivasi_psep");?>">+ Aktivasi Siswa PSEP</a>
                </div>
                <?php echo $this->session->flashdata('alert'); ?>
                </div>
              </div>
              <div class="content">
              	<div class="row">
              		<form method="post" action="<?php echo base_url("pg_admin/sekolah/download_akun");?>" target="_BLANK">
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
						&nbsp;
						<br>
						<input type="submit" class="btn btn-danger btn-sm" style="width: 100%;" value="Download Excel"/>
					</div>
					<div class="col-sm-12">
						&nbsp;
					</div>
					</form>
					<div class="col-sm-12" id="daftar-siswa">

					</div>
				</div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
		<?php $this->load->view('pg_admin/footer'); ?>
  </div>
</div>
<?php $this->load->view("pg_admin/modal_ajax");?>
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

<!--  Datatables Plugin -->

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>
<!-- PLUGINS FUNCTION -->
<!-- Chosen - select box plugin  -->
<script src="<?php echo base_url('assets/js/plugins/chosen/chosen.jquery.js');?>" type="text/javascript"></script>

<script>
$(function(){
	$("#provinsi").change(function(){
		$("#kota").load("../sekolah/ajax_kota/" + $(this).val());
	});
	$("#kota").change(function(){
		$("#sekolah").load("../sekolah/ajax_sekolah/" + $(this).val());
	});
	$("#sekolah").change(function(){
		$("#kelas").load("../sekolah/ajax_kelas/" + $(this).val());
		$("#tahun").load("../sekolah/ajax_tahun/" + $(this).val());
	});
	$("#kelas").change(function(){
		idsekolah 		= $("#sekolah").val();
		idkelasparalel 	= $("#kelas").val();
		idtahunajaran 	= $("#tahun").val();
		$("#daftar-siswa").load("../sekolah/ajax_daftar_siswa/" + idsekolah + "/" + idkelasparalel + "/" + idtahunajaran)
	});
	$("#tahun").change(function(){
		idsekolah 		= $("#sekolah").val();
		idkelasparalel 	= $("#kelas").val();
		idtahunajaran 	= $("#tahun").val();
		$("#daftar-siswa").load("../sekolah/ajax_daftar_siswa/" + idsekolah + "/" + idkelasparalel + "/" + idtahunajaran)
	});

	$("#daftar-siswa").on("click", ".hapus-siswa", function(){
		rawid 		= $(this).attr('id');
		idsplit		= rawid.split("-");
		idsiswa 	= idsplit[1];
		namasiswa 	= $("#nama-" + idsiswa).html();
		if(confirm("Apakah anda yakin menghapus siswa " + namasiswa + "? semua informasi login siswa akan terhapus dan tidak dapat dikembalikan")){
			$.ajax({
				type: 'POST',
				url: '../sekolah/hapus_siswa',
				data:{
					'idsiswa'	: idsiswa
				}
			});
		}
	})

	$("#daftar-siswa").on("click", "#suspend", function(){
		idsekolah 		= $("#sekolah").val();
		idkelasparalel 	= $("#kelas").val();
		idtahunajaran 	= $("#tahun").val();
		if(confirm("Suspend Semua Siswa di Dalam Kelas ? Operasi Ini Tidak Bisa Dibatalkan. ")){
			$.ajax({
				type: 'POST',
				url: '../sekolah/ajax_suspend_kelas',
				data:{
					'idsekolah'			: idsekolah,
					'idkelasparalel'	: idkelasparalel,
					'idtahunajaran'		: idtahunajaran
				},
				beforeSend: function(){
					$("#modal-loader").modal('show');
				},
				success: function(response){
					$("#modal-loader").modal('hide');
					$("#daftar-siswa").load("../sekolah/ajax_daftar_siswa/" + idsekolah + "/" + idkelasparalel + "/" + idtahunajaran)
				}
			})
		}
	})

	$(document).ajaxSend(function(event, jqxhr, settings){
		if(settings.url === "../sekolah/hapus_siswa"){
			$("#modal-loader").modal('show');
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		if(options.url === "../sekolah/hapus_siswa"){
			idsekolah 		= $("#sekolah").val();
			idkelasparalel 	= $("#kelas").val();
			idtahunajaran 	= $("#tahun").val();
			$("#daftar-siswa").load("../sekolah/ajax_daftar_siswa/" + idsekolah + "/" + idkelasparalel + "/" + idtahunajaran);
			$("#modal-loader").modal('hide');
		}
	});
	$(document).ajaxError(function(event, request, options){
		if(options.url === "../sekolah/hapus_siswa"){
			$("#modal-loader").modal('hide');
			$("#modal-error").modal('show');
		}
	});
});
</script>

</html>
