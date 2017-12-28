<?php
include('header_dashboard.php');
?>



<div class="container-fluid akun-container">
<div class="col-lg-12 text-center">	
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="row">
				<?php
					if($tahunajaran !== null){
						//cari jadwal sbmptn
						$carikelasparalel = $this->model_pr->fetch_kelas_siswa($this->session->userdata("id_siswa"));
						if($carikelasparalel !== null){
							foreach($carikelasparalel as $kelassiswa){
								//cari jadwal sbmptn
								$fetchpaket = $this->model_psep_uss->fetch_uss_berlangsung($kelassiswa->id_kelas_paralel, $kelassiswa->id_tahun_ajaran);
								
								if($fetchpaket !== null){
									foreach($fetchpaket as $paket){
										?>
										<div class="col-lg-12">
											
										</div>
										<div class="col-sm-6" style="text-align: left;">
											<h4><?php echo $paket->nama_paket_sbmptn;?></h4>
										</div>
										<div class="col-sm-6" style="text-align: right;">
											<a class="btn btn-primary" href="<?php echo base_url("sbmptn/set_prodi/" . $paket->id_paket_sbmptn);?>">Mulai ></a>
										</div>
										<?php
									}
								}
							}
						}
					}else{
						foreach($datapaket as $paket){
							?>
							<div class="col-lg-12">
								<img src="<?php echo base_url("assets/uploads/banner/banner simulasi sbmptn.jpg");?>" class="img img-responsive"/>
								<br>&nbsp;
							</div>
							<div class="col-sm-6" style="text-align: left;">
								<h4><?php echo $paket->nama_paket_sbmptn;?></h4>
							</div>
							<div class="col-sm-6" style="text-align: right;">
								<a class="btn btn-primary" href="<?php echo base_url("sbmptn/set_prodi/" . $paket->id_paket_sbmptn);?>">Mulai ></a>
							</div>
							<?php
						}
					}
				?>
			</div>
		</div>
	</div>
</div>
</div>

<?php include('footer.php'); ?>

   <script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>
  
  <script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>"></script>
  <script src="<?php echo base_url('assets/dashboard/js/init.js');?>"></script>
  
 

    

  <script type="text/javascript" charset="utf-8">
    $(window).load(function(){
 
    });
  </script>
  
  <?php include('modal_profil.php'); ?>

  </body>
</html>
