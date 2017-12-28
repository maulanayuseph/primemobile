<?php
	foreach($databab as $mapok){
		?>
		<div class="alert alert-info" role="alert">
		<div class="row">
			<div class="col-sm-6">
			<?php echo $mapok->nama_materi_pokok;?>
			</div>
		
			<div class="col-sm-6">
				<div class="progress">
				  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
					60%
				  </div>
				</div>
				<a href="../materi/tabel_konten_detail/<?php echo $mapok->id_materi_pokok;?>" class="btn btn-success" style="width: 100%;">Mulai Belajar</a>
			</div>
		</div>
		</div>
		<?php
	}
?>