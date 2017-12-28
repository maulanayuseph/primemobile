<?php
if($mapeltersimpan !== null){
	?>
	<button class="btn btn-danger btn-tambah-rencana-dash buka-modal-rencana" id="tambah-materi" data-toggle="modal" data-target="#modalrencana">
	TAMBAH RENCANA BELAJAR
	</button>
	<?php
	foreach($mapeltersimpan as $mapel){
		?>
		<div class="col-sm-12 seleksi-saved-mapel" id="mapel-<?php echo $mapel->id_mapel;?>" role="button">
			<div class="col-sm-8" id="mapel-<?php echo $mapel->id_mapel;?>">
				<h4 id="mapel-<?php echo $mapel->id_mapel;?>"><?php echo $mapel->nama_mapel;?></h4>
			</div>
			<div class="col-sm-4 col-btn-mulai" id="mapel-<?php echo $mapel->id_mapel;?>">
				<button class="btn btn-default" id="mapel-<?php echo $mapel->id_mapel;?>">
					Mulai Belajar
				</button>
			</div>
		</div>
		<?php
	}
}else{
	include('rencana_belajar.php');
}
?>