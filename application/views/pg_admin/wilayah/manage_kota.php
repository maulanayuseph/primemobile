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
						<h4 class="title">Manage Kota <?php echo $wilayah->nama_wilayah;?></h4>
              		</div>
              	</div>
              </div>
              <div class="content">
				<div class="row">
					<div class="col-sm-6">
						<select class="form-control" id="filter-provinsi">
							<option value="">-- Filter Provinsi --</option>
							<?php
								foreach($dataprovinsi as $provinsi){
									?>
									<option value="<?php echo $provinsi->id_provinsi;?>"><?php echo $provinsi->nama_provinsi;?></option>
									<?php
								}
							?>
						</select>
						<br>&nbsp;
						<div class="col-sm-12" id="data-kota">
						</div>
					</div>
					<div class="col-sm-6 data-kota-wilayah">
						<table class="table display table-bordered table-striped table-hover">
							<thead>
								<tr>
									<th style="width: 10px;">#</th>
									<th class="text-center">Kota</th>
									<th class="text-center">Operasi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$x = 1;
									foreach($datakota as $kota){
										?>
										<tr>
											<td><?php echo $x;?></td>
											<td id="nama-kota-<?php echo $kota->id_kota;?>"><?php echo $kota->nama_kota;?></td>
											<td class="text-center">
												<button class="btn btn-sm btn-danger hapus-kota" id="kota-<?php echo $wilayah->id_wilayah;?>-<?php echo $kota->id_kota;?>">Hapus Kota</button>
											</td>
										</tr>
										<?php
										$x++;
									}
								?>
							</tbody>
						</table>
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
<script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>

<!--  Nestable Plugin    -->
<script src="<?php echo base_url('assets/js/plugins/nestable/jquery.nestable.js');?>"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>


<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>



<script type="text/javascript">
$(function(){

$("#filter-provinsi").change(function(){
	idprovinsi = $(this).val();
	if(idprovinsi !== ""){
		$("#data-kota").load("../ajax_kota_by_provinsi/" + idprovinsi + "/" + <?php echo $wilayah->id_wilayah;?>);
	}
})

$('#data-kota').on('click', '.insert-kota', function(){
	rawid 		= $(this).attr('id');
	idsplit		= rawid.split("-");
	idkota 		= idsplit[1];
	idwilayah 	= <?php echo $wilayah->id_wilayah;?>;

	$.ajax({
		type: 'POST',
		url: '../ajax_tambah_kota',
		data:{
			'idkota'	: idkota,
			'idwilayah'	: idwilayah
		}
	});
})

$('.data-kota-wilayah').on('click', '.hapus-kota', function(){
	rawid 		= $(this).attr('id');
	idsplit 	= rawid.split("-");
	idwilayah	= idsplit[1];
	idkota 		= idsplit[2];
	namakota 	= $("#nama-kota-" + idkota).html();
	if(confirm("Lanjutkan hapus "+ namakota +" dari wilayah?")){
		$.ajax({
			type: 'POST',
			url: '../hapus_kota',
			data:{
				'idkota'	: idkota,
				'idwilayah'	: idwilayah
			}
		});
	}
})

$('#data-kota').on('click', '.insert-all', function(){
	rawid 		= $(this).attr('id');
	idsplit 	= rawid.split("-");
	idprovinsi 	= idsplit[2];
	idwilayah 	= <?php echo $wilayah->id_wilayah;?>;

	$.ajax({
		type: 'POST',
		url: '../insert_all_kota',
		data:{
			'idprovinsi'	: idprovinsi,
			'idwilayah'		: idwilayah
		}
	});
})

$(document).ajaxSend(function(event, jqxhr, settings){
	alamat 			= settings.url;
	alamatrefresh 	= alamat.substring(0, 23);
	if(alamatrefresh !== "../refresh_kota_wilayah"){
		$("#modal-loader").modal("show");
	}
});
$(document).ajaxSuccess(function(event, request, options){
	$("#modal-loader").modal("hide");
	if(options.url === "../ajax_tambah_kota"){
		obj = JSON.parse(request.responseText);
		if(obj['status'] === "success"){
			idwilayah 	= obj['data']['id_wilayah'];
			idkota 		= obj['data']['id_kota'];
			$('.data-kota-wilayah').load("../refresh_kota_wilayah/" + idwilayah);
		}else{
			idkota 				= obj['data']['id_kota'];
			namakota 			= obj['data']['nama_kota'];
			namawilayah 		= obj['data']['nama_wilayah'];
			idwilayahtujuan		= obj['wilayahtujuan'];
			namawilayahtujuan	= "<?php echo $wilayah->nama_wilayah;?>";
			if(confirm('Kota ' + namakota + ' sudah berada di ' + namawilayah + '. Pindahkan kota ke ' + namawilayahtujuan + ' ?')){
				$.ajax({
					type: 'POST',
					url: '../ajax_tambah_kota_bypass',
					data:{
						'idkota'	: idkota,
						'idwilayah'	: idwilayahtujuan
					}
				});
			}
		}
	}
	if(options.url === "../ajax_tambah_kota_bypass"){
		obj = JSON.parse(request.responseText);
		if(obj['status'] === "success"){
			idwilayah 	= obj['data']['id_wilayah'];
			idkota 		= obj['data']['id_kota'];
			$('.data-kota-wilayah').load("../refresh_kota_wilayah/" + idwilayah);
		}
	}
	if(options.url === "../hapus_kota"){
		obj = JSON.parse(request.responseText);
		if(obj['status'] === "success"){
			idwilayah 	= obj['data']['id_wilayah'];
			idkota 		= obj['data']['id_kota'];
			$('.data-kota-wilayah').load("../refresh_kota_wilayah/" + idwilayah);
		}
	}
	if(options.url === "../insert_all_kota"){
		obj = JSON.parse(request.responseText);
		if(obj['status'] === "success"){
			idwilayah 	= obj['idwilayah'];
			$('.data-kota-wilayah').load("../refresh_kota_wilayah/" + idwilayah);
		}
	}
});
$(document).ajaxError(function(event, request, options){
	$("#modal-loader").modal("hide");
	$("#modal-error").modal("show");
});

})
</script>

</html>
