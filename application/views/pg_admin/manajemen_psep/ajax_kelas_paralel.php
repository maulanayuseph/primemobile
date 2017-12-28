<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th style="width: 10px;">#</th>
			<th class="text-center">Kelas</th>
			<th class="text-center">Kelas Paralel</th>
			<th class="text-center">Operasi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$x = 1;
			foreach($datakelas as $kelas){
				?>
				<tr>
					<th><?php echo $x;?></th>
					<th><?php echo $kelas->alias_kelas;?></th>
					<th class="text-center"><?php echo $kelas->kelas_paralel;?></th>
					<th class="text-center">
						<button class="edit-kelas btn btn-sm btn-warning" id="edit-kelas-<?php echo $kelas->id_kelas_paralel;?>" data-toggle="modal" data-target="#mainmodal"><i class="fa fa-pencil" aria-hidden="true"></i></button>
						<button class="btn btn-sm btn-danger hapus-kelas" id="hapus-kelas-<?php echo $kelas->id_kelas_paralel;?>">
							<i class="fa fa-times" aria-hidden="true"></i>
						</button>
					</th>
				</tr>
				<?php
				$x++;
			}
		?>
	</tbody>
</table>