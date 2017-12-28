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

<div class="container-fluid akun-container" style="padding: 90px 10% 50px;">
	 <div class="content">
		<div class="tabel-analisa waktu" style="overflow: hidden;">
			<div class="title"><img src="<?php echo base_url('assets/dashboard/images/file.png'); ?>">Pencapaian Belajar Siswa</div>
		</div>
	</div>	
	<div class="row">
		<div class="col-lg-12" id="content-rencana">
			<?php
			if($mapeltersimpan !== null){
				foreach($mapeltersimpan as $mapel){
					?>
					<div class="col-sm-12 seleksi-saved-mapel" id="mapel-<?php echo $mapel->id_mapel;?>" role="button">
						<div class="col-sm-8" id="mapel-<?php echo $mapel->id_mapel;?>">
							<h4 id="mapel-<?php echo $mapel->id_mapel;?>"><?php echo $mapel->nama_mapel;?></h4>
						</div>
						<div class="col-sm-4 col-btn-mulai" id="mapel-<?php echo $mapel->id_mapel;?>">
							<button class="btn btn-default" id="mapel-<?php echo $mapel->id_mapel;?>">
								Lihat Pencapaian
							</button>
						</div>
					</div>
					<?php
				}
			}else{
				?>
				<br>Siswa belum menyusun rencana belajar
				<?php
			}
			?>
			
		</div>
	</div>
	
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
<?php $this->load->view("pg_ortu/modal_ajax");?>
<?php include('footer.php'); ?>

   <script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>
  
  <script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>"></script>
  <script src="<?php echo base_url('assets/dashboard/js/init.js');?>"></script>
  
  <!-- JS Function for this view -->
 	<script type="text/javascript" src="<?php echo base_url("assets/pg_ortu/js/pencapaian_belajar.js");?>"></script>


  </body>
</html>
