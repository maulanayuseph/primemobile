<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>
<div class="wrapper">
  <?php include "sidebar.php"; ?>
<?php
/*
	foreach($datakelas as $kelas){
		$jmapel[$kelas->id_kelas] = $this->model_adm->jumlah_mapel_by_kelas($kelas->id_kelas);
		
		
		$jbab[$kelas->id_kelas] = $this->model_adm->jumlah_materi_pokok_by_kelas($kelas->id_kelas);
		if(!isset($bab)){
			$bab = $jbab[$kelas->id_kelas];
		}else{
			$bab += $jbab[$kelas->id_kelas];
		}
		
		$jsubbab[$kelas->id_kelas] = $this->model_adm->jumlah_sub_bab_by_kelas($kelas->id_kelas);
		if(!isset($subbab)){
			$subbab = $jsubbab[$kelas->id_kelas];
		}else{
			$subbab += $jsubbab[$kelas->id_kelas];
		}
		
		$jlatihansoal[$kelas->id_kelas] = $this->model_adm->jumlah_latihan_soal_by_kelas($kelas->id_kelas);
		if(!isset($latihansoal)){
			$latihansoal = $jlatihansoal[$kelas->id_kelas];
		}else{
			$latihansoal += $jlatihansoal[$kelas->id_kelas];
		}
		
		$jsoal[$kelas->id_kelas] = $this->model_adm->jumlah_soal_by_kelas($kelas->id_kelas);
		if(!isset($soal)){
			$soal = $jsoal[$kelas->id_kelas];
		}else{
			$soal += $jsoal[$kelas->id_kelas];
		}
		
		$jvideo[$kelas->id_kelas] = $this->model_adm->jumlah_pembahasan_video_by_kelas($kelas->id_kelas);
		if(!isset($video)){
			$video = $jvideo[$kelas->id_kelas];
		}else{
			$video += $jvideo[$kelas->id_kelas];
		}
	}
	*/
	
?>
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
				<div class="row">
					<div class="col-sm-6">
						<strong>Kelas Tujuan :</strong>
						<br>
						<select class="form-control" id="kelas">
							<option value="0">-- Pilih Kelas --</option>
							<?php
								foreach($datakelas as $kelas){
									?>
									<option value="<?php echo $kelas->id_kelas;?>"><?php echo $kelas->alias_kelas;?></option>
									<?php
								}
							?>
						</select>
					</div>
					<div class="col-sm-6">
					<strong>Mata Pelajaran :</strong>
						<br>
						<select class="form-control" id="mapel">
							<option value="0">-- Pilih Mata Pelajaran --</option>
						</select>
					</div>
					<div class="col-sm-12" id="daftar-soal">

					</div>
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



<!-- MODAL UNTUK lihat SOAL ESSAI -->
<!-- Modal -->
<div class="modal fade" id="modalsoal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
      </div>
      <div class="modal-body" id="kontensoal" style="height: 80vh; overflow-y: scroll;">
        ...
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
<!--  Datatables Plugin -->
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>
<script>
$(function(){
	$("#kelas").change(function(){
		$("#mapel").load("banksoal/pilihmapel/" + $(this).val());
	})
	$("#mapel").change(function(){
		$("#daftar-soal").load("error_duplikasi/ajax_soal/" + $(this).val());
	})

	$(document).ajaxSend(function(event, jqxhr, settings){
		$('#text-load').html('Mencari Soal Hasil Duplikasi');
		$('#modal-loader').appendTo("body").modal('show');
	});
	$(document).ajaxSuccess(function(event, request, options){
		$('#modal-loader').modal('hide');
	});
	$(document).ajaxError(function(event, request, options){
		$('#modal-loader').modal('hide');
		$('#modal-error').appendTo("body").modal('show');
	})
});
</script>
</html>
