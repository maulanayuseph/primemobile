<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
//include "html_header.php"; 
$this->load->view("psep_sekolah/html_header");
?>
<script>
/*
$(function(){
	$("#kelas").change(function(){
		$("#listsiswa").load("ajax_siswa_by_jenjang/" + $("#kelas").val());
	});
});
*/
</script>

<script>
$(function(){
	$("#profilcbt").change(function(){

		//$("#listperingkat").load("cbt/ajax_peringkat/" + $("#profilcbt").val());
		$("#listkategori").load("cbt/listkategori/" + $("#profilcbt").val());
		$("#kelas").load("cbt/ajax_kelas_by_profil/" + $("#profilcbt").val());
	});

	$("#kelas").change(function(){
		tahunajaran = $("#tahunajaran").val();
		kelas 		= $(this).val();
		if(tahunajaran !== 0 && kelas !== 0){
			$("#listperingkat").load("cbt/ajax_peringkat_by_kelas/" + $("#profilcbt").val() + "/" + $(this).val() + "/" + tahunajaran);
		}else{
			$("#listperingkat").load("cbt/ajax_peringkat/" + $("#profilcbt").val());
		}
	});

	$("#tahunajaran").change(function(){
		kelas 		= $("#kelas").val();
		tahunajaran = $(this).val();
		if(kelas !== 0 && tahunajaran !== 0){
			$("#listperingkat").load("cbt/ajax_peringkat_by_kelas/" + $("#profilcbt").val() + "/" + kelas + "/" + $(this).val());
		}else{
			$("#listperingkat").load("cbt/ajax_peringkat/" + $("#profilcbt").val());
		}
	})
});
</script>

<div class="wrapper">
  <?php
  //include "sidebar.php"; 
  $this->load->view("psep_sekolah/sidebar");
  ?>

  <div class="main-panel">
    <?php
    //include "navbar.php"; 
    $this->load->view("psep_sekolah/navbar");
    ?>
    
    <div class="content">      
      <div class="container-fluid">
        <div class="row">
		
		  <div class="col-md-3">
		  	<div class="card">
		  		<div class="header">
	                <h5 class="title text-center">Tambah Kategori</h5>
	            </div>
	            <div class="content">
	                <div class="row">
	                	<div class="col-sm-12">
							<input type="text" id="input-kategori" class="form-control" placeholder="Masukkan Judul Kategori">
							<br>
							<button class="btn btn-sm btn-danger" id="submit-kategori" style="width: 100%;">Tambah Kategori</button>
	                	</div>
	                </div>
	            </div>
		  	</div>
		  </div>

		  <div class="col-sm-9">
		  	<div class="card">
	            <div class="content">
	                <div class="row">
	                	<div class="col-sm-12" id="list-kategori">
	                		<table class="display table table-striped table-bordered table-hover">
	                			<thead>
	                				<tr>
	                					<th style="width: 10px;">#</th>
	                					<th class="text-center">Kategori</th>
	                					<th class="text-center">Operasi</th>
	                				</tr>
	                			</thead>
	                			<tbody>
	                				<?php
	                					$x = 1;
		                				foreach($datakategori as $kategori){
		                					?>
		                					<tr>
		                						<td><?php echo $x;?></td>
		                						<td>
		                							<?php echo $kategori->atribut;?>
		                						</td>
		                						<td class="text-center">
		                							<?php
		                								if($kategori->id_login == $this->session->userdata('idpsepsekolah')){
		                									?>
		                									<button class='btn btn-sm btn-danger edit' id="edit-<?php echo $kategori->id_atribut;?>"  data-toggle="modal" data-target="#mainmodal" >Edit</button>
		                									<button class='btn btn-sm btn-danger hapus' id="hapus-<?php echo $kategori->id_atribut;?>">Hapus</button>
		                									<?php
		                								}
		                							?>
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
    //include "footer.php";
    $this->load->view("psep_sekolah/footer");
    ?>
	
  </div>
</div>
<?php $this->load->view("psep_sekolah/modal_ajax");?>
</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-1.10.2.js" type="text/javascript');?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>

<!--  Nestable Plugin    -->
<script src="<?php echo base_url('assets/js/plugins/nestable/jquery.nestable.js');?>"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>

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

	$("#list-kategori").on('click', '.edit', function(){
		rawid 		= $(this).attr('id');
		idsplit 	= rawid.split("-");
		idkategori 	= idsplit[1];
		$.ajax({
			type: 'POST',
			url: 'ajax_edit_kategori',
			data:{
				'idkategori'	: idkategori
			}
		})
	})

	$("#list-kategori").on('click', '.hapus', function(){
		rawid 		= $(this).attr('id');
		idsplit 	= rawid.split("-");
		idkategori 	= idsplit[1];
		if(confirm("Hapus Kategori ?")){
			$.ajax({
				type: 'POST',
				url: 'ajax_hapus_kategori',
				data:{
					'idatribut'	: idkategori
				}
			})
		}
	})

	$("#mainmodalcontent").on('click', '.submit-simpan', function(){
		atribut 	= $('#edit-kategori').val();
		idatribut 	= $('#id-kategori').val();
		if(atribut !== "" && idatribut !== ""){
			$.ajax({
				type: 'POST',
				url: 'ajax_proses_edit_kategori',
				data:{
					'atribut'	: atribut,
					'idatribut'	: idatribut
				}
			})
		}else{
			alert("Nama kategori tidak boleh kosong!");
		}
	})

	$("#submit-kategori").click(function(){
		kategori 	= $("#input-kategori").val();
		if(kategori !== ""){
			$.ajax({
				type: 'POST',
				url: 'ajax_tambah_kategori',
				data:{
					'kategori'	: kategori
				}
			})
		}else{
			alert("lengkapi form!");
		}
	})

	$(document).ajaxSend(function(event, jqxhr, settings){
		$("#modal-loader").modal("show");
	});
	$(document).ajaxSuccess(function(event, request, options){
		if(options.url === "ajax_tambah_kategori" || options.url === "ajax_proses_edit_kategori" || options.url === "ajax_hapus_kategori"){
			
		}else{
			$('#modal-loader').modal('hide');
		}
		if(options.url === "ajax_tambah_kategori"){
			obj = JSON.parse(request.responseText);
			if(obj['status'] === "success"){
				$("#input-kategori").val("");
				$("#list-kategori").load("ajax_refresh_kategori");
			}else{
				$('#modal-loader').modal('hide');
				$('#modal-error').appendTo("body").modal('show');
			}
		}
		if(options.url === "ajax_edit_kategori"){
			if(request.responseText !== "failed"){
				$("#mainmodalcontent").html(request.responseText);
				$("#mainmodaltitle").html("Edit Kategori");
			}else{
				alert("Anda tidak memiliki hak untuk melakukan edit kategori ini!");
			}
		}
		if(options.url === "ajax_proses_edit_kategori"){
			obj = JSON.parse(request.responseText);
			if(obj['status'] === "success"){
				$("#mainmodal").modal("hide");
				$("#list-kategori").load("ajax_refresh_kategori");
			}else{
				$('#modal-loader').modal('hide');
				$('#modal-error').appendTo("body").modal('show');
			}
		}
		if(options.url === "ajax_hapus_kategori"){
			obj = JSON.parse(request.responseText);
			if(obj['status'] === "success"){
				$("#list-kategori").load("ajax_refresh_kategori");
			}else{
				$('#modal-loader').modal('hide');
				$('#modal-error').appendTo("body").modal('show');
			}
		}
	});
	$(document).ajaxError(function(event, request, options){
		$('#modal-loader').modal('hide');
		$('#modal-error').appendTo("body").modal('show');
		if(options.url === "ajax_edit_kategori"){
			$("#mainmodal").modal("hide");
		}
	});
})
</script>
</html>
