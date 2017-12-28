<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>

<div class="wrapper">
  <?php include "sidebar_penulis.php"; ?>

  <div class="main-panel">
    <?php include "navbar.php"; ?>
    
    <div class="content">      
      <div class="container-fluid">
        <?php echo $this->session->flashdata('alert'); ?>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
                <h4 class="title">Manajemen Soal</h4>
                <p class="category"></p>
              </div>
              <div class="content">
				<div class="row" style="text-align: right;">
					<div class="col-sm-12">
						<a class="btn btn-sm btn-primary" href="<?php echo base_url("pg_admin/latihansoal/manajemen/tambah_soal?id=" . $idsub);?>"><i class="fa fa-plus" aria-hidden="true"></i></a>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th class="text-center" style="width: 20px;">No.</th>
									<th class="text-center">Soal</th>
									<th class="text-center">Operasi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$x = 1;
									foreach($datasoal as $soal){
										?>
										<tr>
											<td class="text-center" ><?php echo $x; ?></td>
											<td>
												<?php
													echo html_entity_decode($soal->isi_soal);
												?>
											</td>
											<td class="text-center" >
												<a class="btn btn-sm btn-primary" href="<?php echo base_url("pg_admin/latihansoal/manajemen/ubah_soal?id=" . $soal->id_soal);?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
												
												<button class="btn btn-sm btn-success lihat-soal" id="soal-<?php echo $soal->id_soal;?>" data-toggle="modal" data-target="#modal-soal"><i class="fa fa-eye" aria-hidden="true"></i></button>
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

    <?php include "footer.php"; ?>

  </div>
</div>

<!-- MODAL LOADER -->
<!--################-->
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
<!-- END MODAL LOADER -->
<!--################-->

<!-- MODAL lihat soal -->
<!--################-->
<div class="modal fade" id="modal-soal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Soal</h4>
		</div>
		<div class="modal-body" style="height: 80vh; overflow-y: scroll;" id="isi-soal">
			
		</div>
    </div>
  </div>
</div>
<!-- END MODAL lihat soal -->
<!--################-->


<!-- MODAL error -->
<!--################-->
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
<!-- END MODAL error -->
<!--################-->
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

<script>
$(function(){
	$(".lihat-soal").click(function(e){
		idbutton 	= e.target.id;
		idsplit		= idbutton.split("-");
		idsoal		= idsplit[1];
		$("#isi-soal").load("../ajax_lihat_soal/" + idsoal);
	});
	
	$(document).ajaxSend(function(event, jqxhr, settings){
		console.log(settings.url);
		alamat 		= settings.url;
		urllihat		= alamat.substring(0, 18);
		//console.log(urlpasti);
		if(urllihat === "../ajax_lihat_soal"){
			$('#text-load').html('memuat soal');
			$('#modal-loader').appendTo("body").modal('show');
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		console.log(options.url);
		alamat 		= options.url;
		urllihat	= alamat.substring(0, 18);
		//console.log(urlpasti);
		if(urllihat === "../ajax_lihat_soal"){
			$('#modal-loader').modal('hide');
		}
	});
	$(document).ajaxError(function(event, request, options){
		console.log(options.url);
		alamat 		= options.url;
		urllihat	= alamat.substring(0, 18);
		//console.log(urlpasti);
		if(urllihat === "../ajax_lihat_soal"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
	});
});
</script>

</html>
