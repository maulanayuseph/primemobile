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
        <?php echo $this->session->flashdata('alert'); ?>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
              	<div class="col-sm-6">
              		<h4 class="title">Komentar Soal</h4>
              	</div>
                <div class="col-sm-6" style="text-align: right;">
              		<a href="<?php echo base_url('pg_admin/komentar/detail');?>" target="_BLANK">Lihat Rekap Komentar</a>
              	</div>
              </div>
              <div class="content">
				<div class="row">
					<div class="col-sm-12">
						&nbsp;
					</div>
					<div class="col-sm-3">
						<select class="form-control" id="filter-kelas">
							<option value="">-- Filter Kelas --</option>
							<?php
								foreach($datakelas as $kelas){
									?>
									<option value="<?php echo $kelas->id_kelas;?>"><?php echo $kelas->alias_kelas;?></option>
									<?php
								}
							?>
						</select>
					</div>
					<div class="col-sm-3">
						<select class="form-control" id="filter-mapel">
							<option value="">-- Filter Mapel --</option>
						</select>
					</div>
					<div class="col-sm-3">
						<select class="form-control" id="filter-flag">
							<option value="0">Un-Flagged</option>
							<option value="1">Flagged</option>
						</select>
					</div>
					<div class="col-sm-3">
						<button class="btn btn-sm btn-danger" id="filter-komentar">Filter Komentar</button>
					</div>
					<div class="col-sm-12">
						&nbsp;
					</div>
					<div class="col-sm-12" id="list-komentar">

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

<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-loader" style="display: none;">
  Launch demo modal
</button>

<!-- Modal untuk loading ajax -->
<div class="modal fade" id="modal-loader" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <img src="<?php echo base_url("assets/img/rolling.gif");?>"/>
		<p> Harap Tunggu, Sedang Proses :)
      </div>
    </div>
  </div>
</div>


<!-- MODAL UNTUK view soal -->
<div class="modal fade" id="modal-komentar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <strong>Soal</strong>
      </div>
      <div class="modal-body" id="konten-modal-komentar">
    	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>
<!-- END MODAL  view soal -->

<!-- Modal untuk error ajax -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-error" style="display: none;">
  Launch demo modal
</button>
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
<!-- end modal error ajax --> 

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
	$("#filter-kelas").change(function(){
		idkelas = $(this).val();
		if(idkelas !== ""){
			$("#filter-mapel").load("komentar/filter_mapel/" + idkelas);
		}
	})
	
	$("#filter-komentar").click(function(){
		idmapel = $("#filter-mapel").val();
		flag 	= $("#filter-flag").val();

		if(idmapel !== ""){
			$("#list-komentar").load("komentar/filter_komentar/" + idmapel + "/" + flag);
		}else{
			alert("Lengkapi filter sebelum menampilkan komentar");
		}
	})

	$(document).ajaxSend(function(event, jqxhr, settings){
		alamat 			= settings.url;
		alamatfilter 	= alamat.substring(0, 24);
		if(alamatfilter === "komentar/filter_komentar"){
			$("#modal-loader").modal("show");
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		alamat 			= options.url;
		alamatfilter 	= alamat.substring(0, 24);
		if(alamatfilter === "komentar/filter_komentar"){
			$("#modal-loader").modal("hide");
		}
	});
	$(document).ajaxError(function(event, request, options){
		alamat 			= options.url;
		alamatfilter 	= alamat.substring(0, 24);
		if(alamatfilter === "komentar/filter_komentar"){
			$("#modal-loader").modal("hide");
			$("#modal-error").modal("show");
		}
	});
})
</script>
</html>
