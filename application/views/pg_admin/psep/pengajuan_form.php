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
						<div class="card">
							<div class="content">
          						<div class="row">
          							<div class="col-sm-12 text-center">
          								<strong>Form Pengajuan</strong>
          								<hr>
          							</div>
          							<div class="col-sm-12">
										<strong>Provinsi Sekolah</strong>
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
										&nbsp;
									</div>
									<div class="col-sm-12">
										<strong>Kota/Kabupaten Sekolah</strong>
										<br>
										<select class="form-control" id="kota">
											
										</select>
										&nbsp;
									</div>
									<div class="col-sm-12">
										<strong>Sekolah</strong>
										<br>
										<select class="form-control" id="sekolah" name="sekolah" required>
											
										</select>
										&nbsp;
									</div>
									<div class="col-sm-12">
										<strong>Jumlah Siswa</strong>
										<br>
										<input type="number" name="jumlah-siswa" id="inputjumlahsiswa" class="form-control">
										&nbsp;
									</div>
									<div class="col-sm-12">
										<strong>Durasi Aktivasi</strong>
										<br>
										<select class="form-control" id="paket">
											<?php
												foreach($datapaket as $paket){
													?>
													<option value="<?php echo $paket->id_paket;?>"><?php echo $paket->durasi;?> Bulan</option>
													<?php
												}
											?>
										</select>
										&nbsp;
									</div>
									<div class="col-sm-12">
										<strong>Dealer</strong>
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
										&nbsp;
									</div>
									<div class="col-sm-12">
										<strong><button class="btn btn-sm btn-danger" id="cekkuota">Cek Kuota</button> : <strong></strong> <span id="sisakuota"></span></strong>
										<input type="hidden" id="kuotadealer"/>
									</div>
									<div class="col-sm-12">
										&nbsp;
									</div>
									<div class="col-sm-12">
										<button class="btn btn-sm btn-danger" id="kirim" style="width: 100%;">Kirim Pengajuan</button>
									</div>
          						</div>
          					</div>
						</div>
					</div>
					<div class="col-sm-12">
						
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

	$("#paket").change(function(){
		iddealer = $('#dealer').val();
		if(iddealer !== ""){
			$.ajax({
				type: 'GET',
				url: 'http://dealership.primemobile.co.id/api/cek_kuota_psep',
				data:{
					'dealer_id'	: iddealer
				}
			});
		}else{
			alert("Pilih dealer sebelum cek kuota");
		}
	})

	$("#dealer").change(function(){
		iddealer = $(this).val();
		if(iddealer !== ""){
			$.ajax({
				type: 'GET',
				url: 'http://dealership.primemobile.co.id/api/cek_kuota_psep',
				data:{
					'dealer_id'	: iddealer
				}
			});
		}else{
			alert("Pilih dealer sebelum cek kuota");
		}
	})

	$("#cekkuota").click(function(){
		iddealer = $('#dealer').val();
		if(iddealer !== ""){
			$.ajax({
				type: 'GET',
				url: 'http://dealership.primemobile.co.id/api/cek_kuota_psep',
				data:{
					'dealer_id'	: iddealer
				}
			});
		}else{
			alert("Pilih dealer sebelum cek kuota");
		}
	})

	$('#inputjumlahsiswa').on('keydown', function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110,190])||/65|67|86|88/.test(e.keyCode)&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});

	$("#kirim").click(function(){
		idsekolah 		= $("#sekolah").val(); 
		jumlahsiswa 	= $("#inputjumlahsiswa").val();
		idpaket 		= $("#paket").val();
		iddealer 		= $("#dealer").val();
		kuotadealer 	= $("#kuotadealer").val();

		if(kuotadealer !== "" || kuotadealer !== 0){
			jumlahsiswa 	= parseInt(jumlahsiswa);
			kuotadealer 	= parseInt(kuotadealer);
			if(jumlahsiswa <= kuotadealer){
				if(idsekolah !== "" && jumlahsiswa !== "" && iddealer !== "" && idpaket !== "" && kuotadealer !== ""){
					$.ajax({
						type: 'POST',
						url: 'http://dealership.primemobile.co.id/api/ajukan_psep',
						data:{
							'sekolah_id'	: idsekolah,
							'jumlah'		: jumlahsiswa,
							'paket_id'		: idpaket,
							'dealer_id'		: iddealer
						}
					});
				}else{
					alert("Lengkapi form sebelum mengirim pengajuan!");
				}
			}else{
				alert("Dealer tidak memiliki cukup kuota, pengajuan tidak bisa dilaksanakan, klik cek kuota untuk memeriksa ulang");
			}
		}else if(kuotadealer == 0){
			alert("Dealer tidak memiliki cukup kuota, pengajuan tidak bisa dilaksanakan, klik cek kuota untuk memeriksa ulang");
		}else{
			alert("Lengkapi form sebelum mengirim pengajuan!");
		}
	});

	$(document).ajaxSend(function(event, jqxhr, settings){
	alamat 			= settings.url;
	alamatcekkuota 	= alamat.substring(0, 65);
		if(settings.url === "http://dealership.primemobile.co.id/api/ajukan_psep"){
			$("#modal-loader").modal('show');
		}
		if(alamatcekkuota === "http://dealership.primemobile.co.id/api/cek_kuota_psep?dealer_id="){
			$("#modal-loader").modal('show');
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		alamat 			= options.url;
		alamatcekkuota 	= alamat.substring(0, 65);
		if(options.url === "http://dealership.primemobile.co.id/api/ajukan_psep"){
			$("#modal-loader").modal('hide');
			alert("SUKSES");
			window.location.replace("daftar_pengajuan");
		}
		if(alamatcekkuota === "http://dealership.primemobile.co.id/api/cek_kuota_psep?dealer_id="){
			$("#modal-loader").modal('hide');

			obj = JSON.parse(request.responseText);
			jumlahsiswa = parseInt($("#inputjumlahsiswa").val());

			balance = parseInt(obj['data'][0]['balance_kuota']);
			
			if(balance >= jumlahsiswa){
	    		$("#sisakuota").html(balance + " (Cukup)");
	    	}else{
	    		$("#sisakuota").html(balance + " (Tidak Cukup)");
	    	}
	    	$("#kuotadealer").val(balance);

			/*
			obj['data'].forEach(function(entry) {
			    if(entry['paket_id'] == $("#paket").val()){
			    	balance = parseInt(entry['balance_kuota']);
			    	if(balance >= jumlahsiswa){
			    		$("#sisakuota").html(entry['balance_kuota'] + " (Cukup)");
			    	}else{
			    		$("#sisakuota").html(entry['balance_kuota'] + " (Tidak Cukup)");
			    	}
			    	$("#kuotadealer").val(entry['balance_kuota']);
			    }
			});
			*/
		}
	});
	$(document).ajaxError(function(event, request, options){
		alamat 			= options.url;
		alamatcekkuota 	= alamat.substring(0, 65);
		if(options.url === "http://dealership.primemobile.co.id/api/ajukan_psep"){
			$("#modal-loader").modal('hide');
			alert("GAGAL");
		}
		if(alamatcekkuota === "http://dealership.primemobile.co.id/api/cek_kuota_psep?dealer_id="){
			$("#modal-loader").modal('hide');
			alert("Gagal Memeriksa Kuota atau Dealer Tidak Memiliki Kuota");

			$("#kuotadealer").val(0);
			$("#sisakuota").html(0 + " (Tidak Cukup)");
		}
	});

});
</script>

</html>
