<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>

<div class="wrapper">
  <?php include "sidebar.php"; ?>

  <div class="main-panel">
    <?php include "navbar.php"; ?>
    
    <div class="content">      
      <div class="container-fluid">
	  
        <div class="row">
        	<div class="col-sm-12">
        		<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalbanksoal" style="width: 100%;" id="tambah-bank">Tambah Bank Soal</button>
        	</div>
        	<div class="col-sm-12">
        		&nbsp;
        	</div>
			<div class="col-sm-12" style="text-align: right;">
				<button class="btn btn-sm btn-primary" data-toggle="collapse" data-target="#filter-bank-soal" aria-expanded="false" aria-controls="filter-bank-soal">Filter Bank Soal <i class="fa fa-caret-square-o-right" aria-hidden="true"></i></button>
			</div>
			<div class="col-sm-12">
        		&nbsp;
        	</div>
        	<div class="col-sm-12">
        		<div class="collapse" id="filter-bank-soal">
				  <div class="well">
				  	<div class="row">
					    <div class="col-sm-4">
					    	<select class="form-control" id="filter-kelas">
					    		<option value="">-- Pilih Kelas --</option>
					    		<?php
					    			foreach($datakelas as $kelas){
					    				?>
					    				<option value="<?php echo $kelas->id_kelas;?>"><?php echo $kelas->alias_kelas;?></option>
					    				<?php
					    			}
					    		?>
					    	</select>
					    </div>
					    <div class="col-sm-4">
							<select class="form-control" id="filter-mapel" required>
								<option value="">-- Pilih Mata Pelajaran --</option>
							</select>
						</div>
						<div class="col-sm-4">
							<select class="form-control" id="filter-tahun" required>
								<option value="">-- Pilih Tahun Ajaran --</option>
								<?php
									foreach($tahunajaran as $tahun){
										?>
										<option value="<?php echo $tahun->id_tahun_ajaran;?>"><?php echo $tahun->tahun_ajaran;?></option>
										<?php
									}
								?>
							</select>
						</div>
						<div class="col-sm-12">
							&nbsp;
						</div>
						<div class="col-sm-4">
							<select class="form-control" id="filter-bab" required>
								<option value="">-- Pilih Bab --</option>
							</select>
						</div>
						<div class="col-sm-4">
							<select class="form-control" id="filter-sub" name="idsub" required>
								<option value="">-- Pilih Sub Bab --</option>
							</select>
						</div>
						<div class="col-sm-4">
							<button class="btn btn-sm btn-primary" style="width: 100%;" id="submit-filter"><i class="fa fa-search" aria-hidden="true"></i> Filter Pencarian</button>
						</div>
					</div>
				  </div>
				</div>
        	</div>

        	<div class="col-sm-12" id="daftar-soal">

        	</div>
        </div>
		
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->

    <?php include "footer.php"; ?>

  </div>
</div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="modalbanksoal" id="modalbanksoal" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red;"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="label-modal-bank-soal">&nbsp;</h4>
		</div>
		<div class="modal-body" id="konten-modal" style="max-height: 80vh; overflow-y: scroll;">
		</div>
    </div>
  </div>
</div>

<!-- MODAL LOADING AJAX -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-loader" style="display: none;">
  Launch demo modal
</button>

<!-- Modal untuk loading ajax -->
<div class="modal fade" id="modal-loader" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <img src="<?php echo base_url("assets/img/rolling.gif");?>"/>
		<p id="text-load"> Memproses</p>
      </div>
    </div>
  </div>
</div>
<!-- END MODAL LOADING AJAX -->

<!-- MODAL ERROR AJAX -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-error" style="display: none;">
  Launch demo modal
</button>

<!-- Modal untuk error ajax -->
<div class="modal fade" id="modal-error" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
		<p>Terjadi kesalahan, periksa koneksi atau ulangi lagi
      </div>
	  <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- END MODAL ERROR AJAX -->
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

<!--  Datatables Plugin -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>

<script src="<?php echo base_url('assets/js/plugins/tinymce/tinymce.min.js');?>" type="text/javascript"></script>
<script>
$(function(){
	$("#tambah-bank").click(function(){
		$("#konten-modal").load("bank_soal/tambah_bank_soal");
	});

	$("#submit-filter").click(function(){
		kelas 	= $("#filter-kelas").val();
		mapel 	= $("#filter-mapel").val();
		tahun 	= $("#filter-tahun").val();
		bab 	= $("#filter-bab").val();
		sub 	= $("#filter-sub").val();

		$.ajax({
			type: 'POST',
			url: 'bank_soal/filter',
			data:{
				'kelas'		: kelas,
				'mapel'		: mapel,
				'tahun'		: tahun,
				'bab'		: bab,
				'sub'		: sub
			}
		});
	})

	$(document).ajaxSend(function(event, jqxhr, settings){
		alamat 			= settings.url;
		urltambahbank	= alamat.substring(0, 26);
		if(urltambahbank === "bank_soal/tambah_bank_soal"){
			$('#text-load').html('Memuat Editor Bank Soal');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(settings.url === "bank_soal/filter"){
			$('#text-load').html('Mencari Bank Soal');
			$('#modal-loader').appendTo("body").modal('show');
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		alamat 			= options.url;
		urltambahbank	= alamat.substring(0, 26);
		if(urltambahbank === "bank_soal/tambah_bank_soal"){
			$('#modal-loader').modal('hide');
			$("#label-modal-bank-soal").html("BUAT BANK SOAL BARU");
		}
		if(options.url === "bank_soal/filter"){
			$('#modal-loader').modal('hide');
			$("#daftar-soal").html(request.responseText);
		}
	});
	$(document).ajaxError(function(event, request, options){
		alamat 			= options.url;
		urltambahbank	= alamat.substring(0, 26);
		if(urltambahbank === "bank_soal/tambah_bank_soal"){
			$('#modal-loader').modal('hide');
			$('#modalbanksoal').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
	});

})
</script>

</html>
