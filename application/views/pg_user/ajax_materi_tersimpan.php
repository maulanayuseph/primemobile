<?php
foreach($datamapel as $mapel){
	?>
	<div class="col-sm-4">
	<div class="panel panel-default">
	  <div class="panel-heading"><?php echo $mapel->nama_mapel;?></div>
	  <div class="panel-body">
		<?php
			foreach($materitersimpan as $materi){
				if($materi->mapel_id == $mapel->id_mapel){
					?>
					<div class="alert alert-success"><?php echo $materi->nama_materi_pokok;?></div>
					<?php
				}
			}
		?>
	  </div>
	</div>
	</div>
	<?php
}
?>