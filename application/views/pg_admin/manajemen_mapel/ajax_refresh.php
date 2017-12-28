<table class="display table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th style="width: 10px;" class="text-center">#</th>
			<th class="text-center">Mata Pelajaran</th>
			<th class="text-center">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$x = 1;
		foreach($datamapel as $mapel){
			?>
			<tr>
				<td><?php echo $x;?></td>
				<td><?php echo $mapel->nama_mapel;?></td>
				<td class="text-center">
					<button class="btn btn-sm btn-warning edit-mapel" id="edit-<?php echo $mapel->id_mapel;?>" data-toggle="modal" data-target="#mainmodal">Edit</button>

					<button class="btn btn-sm btn-danger hapus-mapel" id="hapus-<?php echo $mapel->id_mapel;?>">Hapus</button>
				</td>
			</tr>
			<?php
			$x++;
		}
		?>
	</tbody>
</table>