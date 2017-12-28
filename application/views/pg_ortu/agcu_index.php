<?php include('header_dashboard.php'); ?>
<style>
.dashboard-icon span { font-size:30px; }
.dashboard-icon { color:#fff; font-size:20px; }
.dashboard-icon:hover { color:#810000; }
.box-icon { border: solid 1px #ddd; padding:10px;background-image: url(<?php echo base_url()?>assets/dashboard/images/profileBar.jpg);background-position:center;background-size:cover;}
.padding-lr10 {padding: 0px 10px;}
</style>
<div class="container-fluid akun-container" style="padding: 90px 10% 50px;">
	<?php
		foreach($listagcu as $agcu){
			?>
			<div class="mapel-container">
				<div class="content">
					<div class="title text-center">
						<h5><?php echo $agcu->nama_profil_diagnostic;?></h5>
						<br>
						<a href="<?php echo base_url("parents/report_agcu/0/" . $agcu->id_profil_diagnostic);?>" class="btn btn-sm btn-danger" style="width: 100%;">Lihat Hasil AGCU</a>
					</div>
				</div>
			</div>
			<?php
		}
	?>
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
