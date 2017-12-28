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
					<div class="col-sm-6">
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
							<strong>Pilih Kelas</strong>
							<br>
							<select class="form-control" id="kelas" name="kelas" required>
								<option value=''>-- Pilih Kelas --</option>
							</select>
						</div>

						<div class="col-sm-12">
							<strong>Pilih Tahun Ajaran</strong>
							<br>
							<select class="form-control" id="tahun" name="tahun" required>
								<option value=''>-- Pilih Tahun Ajaran --</option>
							</select>
						</div>
					</div>
					
					<div class="col-sm-6">
						<div class="col-sm-12">
							<strong>Tipe Aktivasi</strong>
							<br>
							<select id="tipeaktivasi" class="form-control" required>
								<option value="0">Full Akses</option>
								<option value="1">PSEP Terbatas</option>
								<option value="2">Aktivasi Event</option>
							</select>
						</div>
						<div class="col-sm-12">
							<strong>Dealer penerbit aktivasi</strong>
							<?php
								//var_dump($datadealer['data']);
							?>
							<br>
							<select class="form-control" id="dealer">
								<option value="">-- Pilih Dealer --</option>
								<?php
									foreach($datadealer['data'] as $dealer){
										?>
										<option value="<?php echo $dealer['id_dealer'];?>"><?php echo $dealer['nama_dealer'];?></option>
										<?php
									}
								?>
							</select>
						</div>

						<div class="col-sm-12">
							<strong>Input ID Penerbitan Voucher</strong>
							<br>
							<select id="idpembeliandealer" class="form-control" required>
								<option value=''>-- Pilih Kode Penjualan --</option>
							</select>
						</div>
						<div class="col-sm-12" id="pilihevent" style="display: none;">
							<strong>Pilih event yang sedang berlangsung : </strong>
							<?php
								//var_dump($datadealer['data']);
							?>
							<br>
							<select class="form-control" id="event">
								<option value="0">-- Pilih Event --</option>
								<?php
									foreach($dataevent as $event){
										?>
										<option value="<?php echo $event->id_event;?>"><?php echo $event->nama_event;?></option>
										<?php
									}
								?>
							</select>
						</div>
						<div class="col-sm-12">
							<br>
							<button class="btn btn-sm btn-danger periksa-voucher" style="width: 100%;">Periksa Voucher Terpakai</button>
						</div>
					</div>
					
					<div class="col-sm-12">
							<br>&nbsp;
						</div>
					<div class="col-sm-12 text-center">
						<button class="btn btn-sm btn-primary" style="width: 100%;" id="proses-aktivasi">Proses Aktivasi</button>
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

<?php 
$this->load->view("pg_admin/modal_ajax");
?>

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
		$("#kota").load("../sekolah/ajax_kota/" + $(this).val());
	});
	$("#kota").change(function(){
		$("#sekolah").load("../sekolah/ajax_sekolah/" + $(this).val());
	});

	$("#dealer").change(function(){
		tipe 		= $("#tipeaktivasi").val();
		if(tipe == 0){
			$("#idpembeliandealer").load("../sekolah/ajax_pembelian_dealer/" + $(this).val());
		}else if(tipe == 1){
			$("#idpembeliandealer").load("../sekolah/ajax_approval_psep/" + $(this).val());
		}else if(tipe == 2){
			$("#idpembeliandealer").load("../sekolah/ajax_penjualan_event/" + $(this).val());
		}
	});

	$("#sekolah").change(function(){
		$("#kelas").load("../sekolah/ajax_kelas/" + $(this).val());
		$("#tahun").load("../sekolah/ajax_tahun/" + $(this).val());
	});

	$("#proses-aktivasi").click(function(){
		sekolah 	= $("#sekolah").val();
		kelas 		= $("#kelas").val();
		tahun 		= $("#tahun").val();
		tipe 		= $("#tipeaktivasi").val();
		iddealer 	= $("#dealer").val();
		idpembelian = $("#idpembeliandealer").val();
		idevent 	= $("#event").val();

		if(tipe == 2 && idevent == 0){
			proses = "no";
		}else if(tipe == 2 && idevent !== 0){
			proses = "yes";
		}

		if(sekolah !== "" && kelas !== "" && tahun !== "" && idpembelian !== "" && proses !== "no"){
			$.ajax({
				type: 'POST',
				url: 'proses_aktivasi_psep',
				data:{
					'sekolah'		: sekolah,
					'kelas'			: kelas,
					'tahun'			: tahun,
					'tipe'			: tipe,
					'iddealer'		: iddealer,
					'idpembelian'	: idpembelian,
					'tipe'			: tipe,
					'idevent'		: idevent
				}
			});
		}else{
			alert("LENGKAPI FORM!!");
		}
	})

	$("#tipeaktivasi").change(function(){
		tipe = $(this).val();
		if(tipe === '2'){
			$("#pilihevent").css("display", "block");
		}else{
			$("#pilihevent").css("display", "none");
		}
	})

	$(".periksa-voucher").click(function(){
		idpembelian = $("#idpembeliandealer").val();
		tipe 		= $("#tipeaktivasi").val();
		iddealer 	= $("#dealer").val();
		if(idpembelian == ""){
			alert("Pilih kode penerbitan voucher sebelum memeriksa ketersediaan");
		}else{
			window.open('detail_penerbitan/' + iddealer + '/' + tipe +'/' + idpembelian, '_blank');
		}
	})
	$(document).ajaxSend(function(event, jqxhr, settings){
		alamat 			= settings.url;
		if(settings.url === "proses_aktivasi_psep"){
			$("#modal-loader").modal("show");
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		alamat 			= options.url;
		if(options.url === "proses_aktivasi_psep"){
			$("#modal-loader").modal('hide');

			obj = JSON.parse(request.responseText);
			if(obj['status'] === "success"){
				alert("SUKSES");
				window.location.replace("daftar_siswa");
			}else if(obj['status'] === "failed"){
				if(obj['message'] === "sekolah tidak sama"){
					alert("Sekolah tidak sama dengan approval aktivasi, aktivasi tidak bisa dilanjutkan");
				}else{
					alert("ERROR!");
				}
			}
		}
	});
	$(document).ajaxError(function(event, request, options){
		alamat 			= options.url;
		if(options.url === "proses_aktivasi_psep"){
			$("#modal-loader").modal("hide");
			$("#modal-error").modal("show");
		}
	});
});
</script>

</html>
