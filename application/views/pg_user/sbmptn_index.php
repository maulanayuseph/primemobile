<?php
include('header_dashboard.php');
?>


<div class="container-fluid akun-container">
<div class="col-lg-12 text-center">	
	<h1>
		TRY OUT CBT
		<br>SELEKSI BERSAMA MASUK PERGURUAN TINGGI NEGERI
		<br>SBMPTN TAHUN 2017
	</h1>
	<br>&nbsp;
	<br>
	
	<a href="<?php echo base_url('sbmptn/pilih_paket');?>" class="btn btn-primary">
		Mulai Try Out
	</a>
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
