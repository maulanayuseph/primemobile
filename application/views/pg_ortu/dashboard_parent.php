<?php include('header_dashboard.php'); ?>
<style>
.dashboard-icon span { font-size:30px; }
.dashboard-icon { color:#fff; font-size:20px; }
.dashboard-icon:hover { color:#810000; }
.box-icon { border: solid 1px #ddd; padding:10px;background-image: url(<?php echo base_url()?>assets/dashboard/images/profileBar.jpg);background-position:center;background-size:cover;}
.padding-lr10 {padding: 0px 10px;}
</style>
<script>
  function supports_media_source()
  {
      "use strict";
      var hasWebKit = (window.WebKitMediaSource !== null && window.WebKitMediaSource !== undefined),
          hasMediaSource = (window.MediaSource !== null && window.MediaSource !== undefined);
      return (hasWebKit || hasMediaSource);
  }
</script>
<?php

$x = 0;
$y = 0;

if($jumlahsoaldiagnostic !== 1 and $jumlahsoaldikerjakan !== 0){
	foreach($jumlahsoaldiagnostic as $jumlahsoal){
		foreach($jumlahsoaldikerjakan as $jumlahdikerjakan){
			if($jumlahdikerjakan->id_diagnostic == $jumlahsoal->id_diagnostic){
				if($jumlahsoal->jumlah_soal == $jumlahdikerjakan->jumlah){
					$iddiagnostic[$jumlahsoal->id_diagnostic] = 'selesai';
					$y += 1;
				}
			}
		}
		$x += 1;
	}
	if($x == $y){
		$statdiag = 'selesai';
	}else{
		$statdiag = 'tidak selesai';
	}
}else{
	$statdiag = 'tidak selesai';
}

?>
<div class="container-fluid akun-container" style="padding: 90px 10% 50px;">
	<a href="<?php echo base_url("parents/aktivitas_siswa");?>" class="dashboard-icon">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="box-icon">
			<center><span class="fa fa-pie-chart"></span><br/> AKTIVITAS SISWA</center>
		</div>
	</div>
	</a>
	
	<a href="<?php echo base_url("parents/tryout");?>" class="dashboard-icon">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="box-icon">
			<center><span class="fa fa-line-chart"></span><br/> ANALISIS CBT</center>
		</div>
	</div>
	</a>
	
	<a href="<?php echo base_url("parents/skor");?>" class="dashboard-icon">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="box-icon">
			<center><span class="fa fa-graduation-cap"></span><br/> PERINGKAT CBT</center>
		</div>
	</div>
	</a>
	
	<div class="clearfix"></div>
	<div style="margin-top:20px;"></div>
	
	<?php
		if($statdiag == 'selesai' and $hasileq == 1 and $hasills == 1){
	?>
	<a href="<?php echo base_url("parents/report_agcu/0/" . $profildiagnostic);?>" class="dashboard-icon">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="box-icon">
			<center><span class="fa fa-stethoscope"></span><br/> AGCU Report</center>
		</div>
	</div>
	</a>
	<?php
		}else{
			?>
	<a href="#" class="dashboard-icon" data-toggle="modal" data-target="#myModal">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="box-icon">
			<center><span class="fa fa-stethoscope"></span><br/> AGCU Report</center>
		</div>
	</div>
	</a>
			<?php
		}
	?>
	
	<a href="<?php echo base_url("parent/pencapaian_belajar");?>" class="dashboard-icon">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="box-icon">
			<center><span class="fa fa-check" aria-hidden="true"></span>
			<br/> Pencapaian Belajar</center>
		</div>
	</div>
	</a>
	
	<?php
	if($tahunajaran !== null){
		if($datapr !== null){
	?>
	<a href="<?php echo base_url("parents/pekerjaan_rumah");?>" class="dashboard-icon">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="box-icon">
			<center><span class="fa fa-file-text-o" aria-hidden="true"></span>
			<br/> Pekerjaan Rumah</center>
		</div>
	</div>
	</a>
	<?php
		}
	}
	?>
</div>

<div class="container-fluid akun-container" style="padding-top:0px;">
	<div class="col-lg-12">	
     <div class="akun-slider">
      <div class="content">
        <h5>Ir.H.Heppy Trenggono, M.Kom</h5>
        <p>Orang tua, seperti apapun keadaan mereka, tetap saja merupakan kunci sukses yang paling berharga</p>
        <a href="">SELENGKAPNYA <span class="glyphicon glyphicon-chevron-right"></span></a>
      </div>
      <img class="slider" src="<?php echo base_url('assets/dashboard/images/slide.jpg');?>">
     </div> 

    </div>
</div>

<?php include('footer.php'); ?>

   <script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>
  
  <script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>"></script>
  <script src="<?php echo base_url('assets/dashboard/js/init.js');?>"></script>
  
  <!-- JS Function for this Modal -->
 <!-- MODAL JIKA BELUM MELENGKAPI AGCU -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <h4>Hasil AGCU tidak bisa dilihat sebelum siswa selesai mengerjakan tes</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
  </body>
</html>
