<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>
<script>
$(function(){
	$("#kelas").change(function(){
		$("#mapel").load("banksoal/ajax_mapel/" + $("#kelas").val());
	});
	$("#mapel").change(function(){
		$("#list-soal").load("banksoal/ajax_soal/" + $("#kelas").val() + "/" + $("#mapel").val());
		$("#list_modal").load("banksoal/ajax_soal_modal/" + $("#kelas").val() + "/" + $("#mapel").val());
		$("#kategori").load("banksoal/ajax_kategori/" + $("#mapel").val());
	});
	$("#kategori").change(function(){
		$("#list-soal").load("banksoal/ajax_soal_by_kategori/" + $("#kategori").val());
		$("#list_modal").load("banksoal/ajax_soal_modal_by_kategori/" + $("#kategori").val());
	});
	/*
	$("#cetakbank").click(function(){
		//alert($("#kategori").val());
		if($("#kategori").val() == ""){
			alert("Pilih Kategori Bank Soal");
		}else{
			var win = window.open('<?php echo base_url("pg_admin/banksoal/cetak/");?>' + "/" + $("#kategori").val(), '_blank');
			if(win){
				win.focus();
			} else {
				//Browser has blocked it
				alert('Please allow popups for this website');
			}
		}
	});
	*/
	$("#cetakbank").change(function(){
		valcetak = $(this).val();
		if($("#kategori").val() == ""){
			alert("Pilih Kategori Bank Soal");
		}else{
			if(valcetak === "full"){
				var win = window.open('<?php echo base_url("pg_admin/banksoal/cetak/");?>' + "/" + $("#kategori").val(), '_blank');
				if(win){
					win.focus();
				} else {
					//Browser has blocked it
					alert('Please allow popups for this website');
				}
			}else if(valcetak === "nobahas"){
				var win = window.open('<?php echo base_url("pg_admin/banksoal/cetaknobahas/");?>' + "/" + $("#kategori").val(), '_blank');
				if(win){
					win.focus();
				} else {
					//Browser has blocked it
					alert('Please allow popups for this website');
				}
			}
		}
		$(this).html('<option>-- Pilih Opsi Cetak --</option><option value="full">Cetak Lengkap</option><option value="nobahas">Cetak Tanpa Pembahasan</option>');
	})
});
</script>
<div class="wrapper">
  <?php include "sidebar.php"; ?>

  <div class="main-panel">
    <?php include "navbar.php";?>
    
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
              </div>
              <div class="content">
				<a class="btn btn-primary" href="banksoal/tambah">Tambah Bank Soal</a>
                <!-- TABLE UNTUK BANK SOAL -->
				<div  class="table-responsive">
				<table class="table table-stripped">
					<tr>
					<td>
						<select id="kelas" class="form-control">
							<option value="">Pilih Kelas...</option>
							  <?php 
							  foreach ($select_options_kelas as $item) { 
							  ?>
							  <option value="<?php echo $item->id_kelas;?>" > <?php echo $item->alias_kelas; ?> </option>
							  <?php } ?>
						</select>
					</td>
					<td>
						<select id="mapel" class="form-control">
							<option value="">Pilih Mata Pelajaran...</option>
						</select>
					</td>
					<td>
						<select id="kategori" class="form-control">
							<option value="">Pilih Kategori...</option>
						</select>
					</td>
					<td>
						<!-- <button class="btn btn-primary" id="cetakbank">Print Bank Soal</button> -->
						<select class="form-control" id="cetakbank">
							<option>-- Pilih Opsi Cetak --</option>
							<option value="full">Cetak Lengkap</option>
							<option value="nobahas">Cetak Tanpa Pembahasan</option>
						</select>
					</td>
					</tr>
				</table>
				</div>
				<div class="table-responsive">
					<table id="my_datatable" class="table table-striped table-hover">
						<thead>
							<tr>
								<th style="width: 10px;">No.</th>
								<th>Topik</th>
								<th>Pembahasan</th>
								<th>Pelajaran</th>
								<th>Tipe Soal</th>
								<th>Bobot Soal</th>
								<th>Kunci Jawaban</th>
								<th>Operasi</th>
							</tr>
						</thead>
						<tbody id="list-soal">
							
						</tbody>
					</table>
				</div>
				<!-- END TABLE BANK SOAL -->

				
                <div class="footer">
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>

    <?php include "footer.php"; ?>

  </div>
</div>



<div id="list_modal">

</div>

<div class="modal fade" id="modalbanksoal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body" id="konten-modal">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
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





</html>
