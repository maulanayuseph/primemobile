<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>
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
  <?php include "sidebar.php"; ?>

  <div class="main-panel">
    <?php include "navbar.php"; ?>
    
    <div class="content">      
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
                <h4 class="title">Report CBT</h4>
                <p class="category">Laporan Peringkat CBT dan Analisis Butir Soal</p>
              </div>
              <div class="content">
                <div class="row">
					<form action="<?php echo base_url("psep_sekolah/cbt/abs");?>" method="get"> 
					<?php echo $this->session->flashdata('alert'); ?>
					<div class="col-md-3">
						<select id="profilcbt" name="profil" class="form-control">
							<option value="0" selected>-- Pilih Profil CBT --</option>
							<?php
								foreach($datacbt as $cbt){
									?>
									<option value="<?php echo $cbt->id_tryout;?>"><?php echo $cbt->nama_profil;?></option>
									<?php
								}
							?>
						</select>
					</div>
					<div class="col-md-3">
						<select class="form-control" id="kelas" name="kelas">
							<option value="0">-- Pilih Kelas --</option>
						</select>
					</div>
					<div class="col-md-3">
						<select class="form-control" id="tahunajaran" name="tahun">
							<option value="0">-- Pilih Tahun Ajaran --</option>
							<?php
								foreach($tahunajaran as $tahun){
									?>
									<option value="<?php echo $tahun->id_tahun_ajaran;?>"><?php echo $tahun->tahun_ajaran;?></option>
									<?php
								}
							?>
						</select>
					</div>
					<div class="col-md-3">
						<input type="submit" value="Analisis Butir Soal" class="btn btn-primary"/>
					</div>
					</form>
					<div class="col-md-12">
					<p>&nbsp;
					<table class="table table-bordered table-striped">
						<thead id="listkategori">
								
						</thead>
						<tbody id="listperingkat">
							
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

<!-- PLUGINS FUNCTION -->
 <!-- Nestable plugin  -->


</html>
