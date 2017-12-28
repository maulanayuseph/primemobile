<script>
$(function(){
	$(".tbl-bab").click(function() {
		$("#bab-tersimpan").load("ajax_loader");
		$("#bab-tersimpan").load("ajax_simpan_bab/" + $(this).attr('id'));
		$(this).removeClass('btn-success');
		$(this).addClass('btn-danger');
		$(this).html("<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>");
		
		$(this).removeClass('tbl-bab').addClass('hps-bab');
	});
	$(".hps-bab").click(function() {
		$("#bab-tersimpan").load("ajax_loader");
		$("#bab-tersimpan").load("ajax_hapus_bab/" + $(this).attr('id'));
		$(this).removeClass('btn-danger');
		$(this).addClass('btn-success');
		$(this).html("<span class='glyphicon glyphicon-plus' aria-hidden='true'></span>");
	});
});
</script>
<div class="panel panel-default" style="">
  <div class="panel-body" style="background-color: #88b0ef; height: 400px; overflow-y: auto;">
    <?php
		foreach($databab as $bab){
			?>
				<div class="panel panel-default">
				  <div class="panel-body">
					<div class="col-sm-6">
						<?php echo $bab->nama_materi_pokok;?>
					</div>
					<div class="col-sm-6" style="text-align: right;">
						<?php
							$cari = $this->model_rencana_belajar->cari_materi($this->session->userdata('id_siswa'), $bab->id_materi_pokok);
							
							if($cari > 0){
								?>
								<button class="btn btn-sm btn-danger hps-bab" id="<?php echo $bab->id_materi_pokok;?>"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
								<?php
							}else{
								?>
								<button class="btn btn-sm btn-success tbl-bab" id="<?php echo $bab->id_materi_pokok;?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
								<?php
							}
						?>
						
					</div>
				  </div>
				</div>
			<?php
		}
	?>
  </div>
</div>