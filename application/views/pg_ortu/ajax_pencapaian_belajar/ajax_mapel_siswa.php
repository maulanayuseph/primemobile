<?php
if($mapeltersimpan !== null){
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
	echo "Siswa belum menyusun perencanaan belajar";
}
?>