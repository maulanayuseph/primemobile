<script>
$(function(){
	$(".btn-mapel").click(function() {
		$("#daftar-bab").load("ajax_bab_by_mapel/" + $(this).attr('id'));
	});
	$("#kembalirencanabelajar").click(function() {
		$("#content-rencana").load("ajax_rencana_belajar_awal");
	});
});
</script>
	<div class="tombol-atas">
		<div role="button" class="tombol-kembali" id="kembalirencanabelajar">
		<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Kembali
		</div>
		<div class="title-rencana-mapel">
		Pilih Materi Belajar
		</div>
	</div>
<div class="panel panel-default">
  <div class="panel-body panel-tambah-rencana">
	<div class="col-sm-4" style="height: 400px; overflow-y: auto;">
		<div class="list-group">
			<?php
			foreach($datamapel as $mapel){
				?>
					<button type="button" class="list-group-item btn-mapel" id="<?php echo $mapel->id_mapel;?>"><?php echo $mapel->nama_mapel;?></button>
				<?php
			}
			if(isset($datasaintek)){
				?>
				<br>
				<div class="alert alert-success" role="alert">SBMPTN SAINTEK</div>
				<?php
				foreach($datasaintek as $sain){
					?>
						<button type="button" class="list-group-item btn-mapel" id="<?php echo $sain->id_mapel;?>"><?php echo $sain->nama_mapel;?></button>
					<?php
				}
				?>
				<br>
				<div class="alert alert-success" role="alert">SBMPTN SOSHUM</div>
				<?php
				foreach($datasoshum as $soshum){
					?>
						<button type="button" class="list-group-item btn-mapel" id="<?php echo $soshum->id_mapel;?>"><?php echo $soshum->nama_mapel;?></button>
					<?php
				}
			}
			if(isset($datausm)){
				?>
				<br>
				<div class="alert alert-success" role="alert">US/M SD</div>
				<?php
				foreach($datausm as $usm){
					?>
						<button type="button" class="list-group-item btn-mapel" id="<?php echo $usm->id_mapel;?>"><?php echo $usm->nama_mapel;?></button>
					<?php
				}
				?>
				<?php
			}
			?>
		</div>
	</div>
	<div class="col-sm-8" id="daftar-bab">
		
	</div>
	<div class="col-sm-12" id="bab-tersimpan">
	</div>
  </div>
</div>
	</div>