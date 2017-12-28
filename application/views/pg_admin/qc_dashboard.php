<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script>
setInterval(function(){
   //window.location.reload(1);
   $("#data-quality").load("reload_dashboard");
   $("#data-history").load("../history/ajax_dashboard");
}, 5000);
</script>
<?php include "html_header.php"; ?>
<div class="wrapper">
  <?php include "sidebar.php"; ?>

  <div class="main-panel">
    <?php include "navbar.php"; ?>
    
    <div class="content">      
      <div class="container-fluid">
        <?php echo $this->session->flashdata('alert'); ?>
		
		<div class="col-sm-8">
			<div class="row">
				<div class="col-sm-12 text-center">
					<div class="card" style="padding-top: 5px; padding-bottom: 5px;">
						<strong>Statistik Soal</strong>
					</div>
				</div>
			</div>
			<div class="row" id="data-quality">
			  <div class="col-md-4">
				<div class="card" style="background-color: #15c154;">
				  <div class="content" style="text-align: right;">
					<h4 style="color: white;">
					<?php
						$approved = $this->model_kurikulum->hitung_soal_by_status(10);
						
						echo $approved;
					?> Soal 
					</h4>
					<div class="footer">
						<hr>
						<div class="stats" style="color: white;">
							Disetujui
						</div>
					</div>
				  </div>
				</div>
			  </div>
			  
			  <div class="col-md-4">
				<div class="card" style="background-color: #d9f442;">
				  <div class="content" style="text-align: right;">
					<h4 style="color: black;">
					<?php echo $jumlahsoal;?> Soal 
					</h4>
					<div class="footer">
						<hr>
						<div class="stats" style="color: black;">
							Menunggu Approval
						</div>
					</div>
				  </div>
				</div>
			  </div>
			  
			  <div class="col-md-4">
				<div class="card" style="background-color: #af2121;">
				  <div class="content" style="text-align: right;">
					<h4 style="color: white;">
					<?php
						$bahastidaklengkap = $this->model_kurikulum->hitung_soal_by_status(2);
						
						echo $bahastidaklengkap;
					?> Soal 
					</h4>
					<div class="footer">
						<hr>
						<div class="stats" style="color: white;">
							Pembahasan Tidak Lengkap
						</div>
					</div>
				  </div>
				</div>
			  </div>
			  
			  <div class="col-md-4">
				<div class="card" style="background-color: #af2121;">
				  <div class="content" style="text-align: right;">
					<h4 style="color: white;">
					<?php
						$belumbobot = $this->model_kurikulum->hitung_soal_by_status(3);
						
						echo $belumbobot;
					?> Soal 
					</h4>
					<div class="footer">
						<hr>
						<div class="stats" style="color: white;">
							Belum ada Pembobotan
						</div>
					</div>
				  </div>
				</div>
			  </div>
			  
			  <div class="col-md-4">
				<div class="card" style="background-color: #af2121;">
				  <div class="content" style="text-align: right;">
					<h4 style="color: white;">
					<?php
						$soalbingung = $this->model_kurikulum->hitung_soal_by_status(4);
						
						echo $soalbingung;
					?> Soal 
					</h4>
					<div class="footer">
						<hr>
						<div class="stats" style="color: white;">
							Membingungkan
						</div>
					</div>
				  </div>
				</div>
			  </div>
			  
			  <div class="col-md-4">
				<div class="card" style="background-color: #af2121;">
				  <div class="content" style="text-align: right;">
					<h4 style="color: white;">
					<?php
						$soaldobel = $this->model_kurikulum->hitung_soal_by_status(5);
						
						echo $soaldobel;
					?> Soal 
					</h4>
					<div class="footer">
						<hr>
						<div class="stats" style="color: white;">
							Dobel
						</div>
					</div>
				  </div>
				</div>
			  </div>
			  
			  <div class="col-md-4">
				<div class="card" style="background-color: #af2121;">
				  <div class="content" style="text-align: right;">
					<h4 style="color: white;">
					<?php
						$tidaklayak = $this->model_kurikulum->hitung_soal_by_status(6);
						
						echo $tidaklayak;
					?> Soal 
					</h4>
					<div class="footer">
						<hr>
						<div class="stats" style="color: white;">
							Tidak Layak
						</div>
					</div>
				  </div>
				</div>
			  </div>
			  
			  <div class="col-md-4">
				<div class="card" style="background-color: #af2121;">
				  <div class="content" style="text-align: right;">
					<h4 style="color: white;">
					<?php
						$belumqc = $this->model_kurikulum->hitung_soal_by_status(8);
						
						echo $belumqc;
					?> Soal 
					</h4>
					<div class="footer">
						<hr>
						<div class="stats" style="color: white;">
							Belum QC Tentor
						</div>
					</div>
				  </div>
				</div>
			  </div>
			  
			  <div class="col-md-4">
				<div class="card" style="background-color: #af2121;">
				  <div class="content" style="text-align: right;">
					<h4 style="color: white;">
					<?php
						$pindah = $this->model_kurikulum->hitung_soal_by_status(7);
						
						echo $pindah;
					?> Soal 
					</h4>
					<div class="footer">
						<hr>
						<div class="stats" style="color: white;">
							Perlu Dipindah
						</div>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		</div>
		
		<div class="col-sm-4">
			<div class="row">
				<div class="col-sm-12 text-center">
					<div class="card" style="padding-top: 5px; padding-bottom: 5px;">
						<strong>Aktivitas QC</strong>
					</div>
				</div>
			</div>
			<div class="row" id="data-history" style="height: 800px; overflow-y: scroll;">
			
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
		<p> Loading Data
      </div>
    </div>
  </div>
</div>

<!-- modal untuk menampilkan soal -->
<div id="viewmodalsoal">

</div>
<!-- Modal -->
<div class="modal fade" id="modalsoal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" id="isi-soal" style="height: 400px; overflow-y: scroll;">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end modal untuk menampilkan soal -->
<?php include "alert_modal.php"; ?>
</body>

 <!--   Core JS Files   -->
 <script src="<?php echo base_url('assets/js/jquery-1.10.2.js" type="text/javascript');?>"></script>
 <script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>

 <!--  Checkbox, Radio & Switch Plugins -->
 <script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>

 <!--  Datatables Plugin -->
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>
 
<script>
$(document).ready(function() {
    //$('table.display').DataTable();
	
	$(".lihat-soal").click(function(e){
		var soal = e.target.id;
		var idsoal = soal.split("-");
		$("#isi-soal").load("quality/ajax_lihat_soal/" + idsoal[1]);
	})
	
	//$("#ajax_overview").load("quality/ajax_overview/" + $("#bab").val());
	
	//$("#list-eval").load("quality/ajax_list_eval/");
	
	$(document).ready(function() {
		//$('table.display').DataTable();
	} );
});
 </script>
 
  <!--  Notifications Plugin    -->
  <script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>

</html>
