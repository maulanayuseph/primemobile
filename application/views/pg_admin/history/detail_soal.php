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
<?php $this->load->view("pg_admin/html_header");?>
<div class="wrapper">
  <?php $this->load->view("pg_admin/sidebar");?>

  <div class="main-panel">
   <?php $this->load->view("pg_admin/navbar");?>
    
    <div class="content">      
      <div class="container-fluid">
        <?php echo $this->session->flashdata('alert'); ?>
		
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<strong>Penulis : </strong> <?php echo $soal->username;?>
						<br><strong>Soal :</strong>
						<br><?php echo html_entity_decode($soal->isi_soal);?>
						<br>&nbsp;
						<br><strong>Bobot :</strong>
						<br>
						<?php 
							if($soal->bobot == 1){
								echo "Mudah";
							}elseif($soal->bobot == 2){
								echo "Sedang";
							}elseif($soal->bobot == 3){
								echo "Sulit";
							}
						?>
						
						<br>&nbsp;
						<br><strong>Kunci Jawaban : </strong>
						<?php echo $soal->kunci_jawaban;?>
						
						<br>&nbsp;
						<br><strong>A.</strong>
						<br><?php echo html_entity_decode($soal->jawab_1);?>
						
						<br>&nbsp;
						<br><strong>B.</strong>
						<br><?php echo html_entity_decode($soal->jawab_2);?>
						
						<br>&nbsp;
						<br><strong>C.</strong>
						<br><?php echo html_entity_decode($soal->jawab_3);?>
						
						<br>&nbsp;
						<br><strong>D.</strong>
						<br><?php echo html_entity_decode($soal->jawab_4);?>
						
						<br>&nbsp;
						<br><strong>E.</strong>
						<br><?php echo html_entity_decode($soal->jawab_5);?>
						
						<br>&nbsp;
						<br><strong>Pembahasan : </strong>
						<br><?php echo html_entity_decode($soal->pembahasan);?>
						
						<br>&nbsp;
						<br><strong>Video : </strong>
						<br><?php echo $soal->pembahasan_video;?>
						
						<br>&nbsp;
						<br><strong>Status : </strong>
						<br>
						<?php
						if($soal->status == 0){
							echo "Waiting Approval";
						}elseif($soal->status == 1){
							echo "Approved";
						}elseif($soal->status == 10){
							echo "Approved";
						}elseif($soal->status == 2){
							echo "Pembahasan tidak lengkap";
						}elseif($soal->status == 3){
							echo "Belum ada pembobotan";
						}elseif($soal->status == 4){
							echo "Soal membingungkan";
						}elseif($soal->status == 5){
							echo "Soal double (perlu dihapus)";
						}elseif($soal->status == 6){
							echo "Soal tidak layak (perlu dihapus)";
						}elseif($soal->status == 7){
							echo "Pindah soal";
						}elseif($soal->status == 8){
							echo "Soal belum di QC Tentor";
						}elseif($soal->status == 9){
							echo "Video Salah";
						}
						?>
					</div>
				</div>
			</div>
			
			<div class="col-sm-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<table class="table display table-striped table-bordered">
							<thead>
								<tr>
									<th>History</th>
								</tr>
							</thead>
							<tbody>
							<?php
								foreach($datahistory as $history){
									?>
										<tr>
											<td>
												<i><?php echo $history->timestamp;?></i> - <strong><?php echo $history->username;?></strong>
												<ul>
													<?php
														if($history->soal_before !== $history->soal_after){
															echo "<li>Mengubah Isi Soal</li>";
														}
													?>
													<?php
														if($history->jawab_1_before !== $history->jawab_1_after){
															echo "<li>Mengubah Opsi Jawaban A</li>";
														}
													?>
													<?php
														if($history->jawab_2_before !== $history->jawab_2_after){
															echo "<li>Mengubah Opsi Jawaban B</li>";
														}
													?>
													
													<?php
														if($history->jawab_3_before !== $history->jawab_3_after){
															echo "<li>Mengubah Opsi Jawaban C</li>";
														}
													?>
													<?php
														if($history->jawab_4_before !== $history->jawab_4_after){
															echo "<li>Mengubah Opsi Jawaban D</li>";
														}
													?>
													<?php
														if($history->jawab_5_before !== $history->jawab_5_after){
															echo "<li>Mengubah Opsi Jawaban E</li>";
														}
													?>
													<?php
														if($history->bobot_before !== $history->bobot_after){
															echo "<li>Mengubah Bobot Soal</li>";
														}
													?>
													<?php
														if($history->pembahasan_before !== $history->pembahasan_after){
															echo "<li>Mengubah Pembahasan Teks</li>";
														}
													?>
													
													<?php
														if($history->pembahasan_video_before !== $history->pembahasan_video_after){
															echo "<li>Mengubah Pembahasan Video</li>";
														}
													?>
													<?php
														if($history->status_before !== $history->status_after){
															echo "<li>Mengubah Status Soal</li>";
														}
													?>
													<?php
														if($history->status_after == 1){
															echo "<li>Approval Soal</li>";
														}
													?>
												</ul>
												<button class="btn btn-sm btn-primary lihat-history" style="width: 100%;" id="history-<?php echo $history->id_qc_history;?>" data-toggle="modal" data-target="#modalsoal">Lihat Perubahan</button>
											</td>
										</tr>
									<?php
								}
							?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->

    <?php $this->load->view("pg_admin/footer");?>

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
      <div class="modal-body" id="isi-history" style="height: 400px; overflow-y: scroll;">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end modal untuk menampilkan soal -->
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
	$(document).ready(function() {
		$('table.display').DataTable({
			"order": [[ 0, "desc" ]]
		});
	} );
});
</script>


<script>
$(function(){
	$(".lihat-history").click(function(){
		rawid 	= $(this).attr('id');
		idsplit = rawid.split("-");
		idhistory 	= idsplit[1];
		//alert(rawid);
		$("#isi-history").load("../ajax_history_by_id/" + idhistory);
	});
	$(document).ajaxSend(function(event, jqxhr, settings){
		alamat 		= settings.url;
		urllihat	= alamat.substring(0, 21);
		if(urllihat === "../ajax_history_by_id"){
			$('#text-load').html('memuat soal');
			$('#modal-loader').appendTo("body").modal('show');
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		alamat 		= options.url;
		urllihat	= alamat.substring(0, 21);
		if(urllihat === "../ajax_history_by_id"){
			$('#modal-loader').modal('hide');
		}
	});
	$(document).ajaxError(function(event, request, options){
		alamat 		= options.url;
		urllihat	= alamat.substring(0, 21);
		if(urllihat === "../ajax_history_by_id"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
			$('#modalsoal').modal('hide');
		}
	});
})
</script>
 
  <!--  Notifications Plugin    -->
  <script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>

</html>
