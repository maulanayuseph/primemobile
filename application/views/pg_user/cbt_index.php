<?php include('header_dashboard.php'); ?>
    <div class="container-fluid akun-container">
	<div class="col-lg-12">
	
		<div class="panel panel-default">
		  <div class="panel-heading heading-list-cbt text-center">
			<h3 class="panel-title">CBT CONTEST</h3>
		  </div>
		  <div class="panel-body body-cbt-list">
			<?php
				foreach($kelasaktif as $kelas){
					foreach($data_profil as $profil){
						if($profil->id_kelas == $kelas->id_kelas and $profil->status == 1){
							?>
							<img src="<?php echo base_url('assets/uploads/banner/'.$profil->banner);?>" class="img img-responsive"/>
							<div class="row contest-desc">
								<div class="col-lg-3 col-md-3 col-sm-3" style="padding-top: 7px; padding-bottom: 7px;">
								Biaya : Rp. <?php echo $profil->biaya; ?>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4" style="padding-top: 7px; padding-bottom: 7px;">
								Tanggal Pelaksanaan : 
								<?php
								$originalDate = $profil->tgl_acara;
								$newDate = date("d M Y", strtotime($originalDate));
								echo $newDate;
								?>
								</div>
								<div class="col-lg-5 col-md-5 col-sm-5">
									<button class="btn btn-danger" style="float: right; margin-left: 20px;" data-dismiss="modal">
										Tutup
									</button>
									<a href="cbt/cbt-detail/<?php; echo $profil->id_tryout;?>" class="btn btn-primary" style="float: right;">
										Daftar Sekarang
									</a>
								</div>
							</div>
							<?php
						}
					}
				}
			?>
		  </div>
		</div>
		
    </div>
</div>

<?php include('modal_unlock_bonus.php');?>
  <?php include('modal_video_motivasi.php');?>
<?php include('footer.php'); ?>

   <script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>
  
  <script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>"></script>
  <script src="<?php echo base_url('assets/dashboard/js/init.js');?>"></script>
  
 
  
  <?php include('modal_aktivasi_agcu.php'); ?>
  <?php include('modal_profil.php'); ?>

  </body>
</html>