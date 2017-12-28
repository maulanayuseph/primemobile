<table class="table table-responsive table-bordered table-hover display">
	<thead>
		<tr>
			<th style="width: 10px;" class="text-center">#</th>
			<th class="text-center">Kurikulum</th>
			<th class="text-center">Operasi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$x = 1;
			foreach($datakurikulum as $kurikulum){
				?>
				<tr>
					<td class="text-center">
						<?php echo $x;?>
					</td>
					<td class="text-center">
						<?php echo $kurikulum->nama_kurikulum;?>
					</td>
					<td class="text-center">
						<button class="btn btn-sm btn-warning edit-kurikulum" id="edit-<?php echo $kurikulum->id_kurikulum;?>" data-toggle="modal" data-target="#mainmodal">Edit Kurikulum</button>

						<button class="btn btn-danger btn-sm hapus-kurikulum" id="hapus-<?php echo $kurikulum->id_kurikulum;?>">Hapus Kurikulum</button>
					</td>
				</tr>
				<?php
				$x++;
			}
		?>
	</tbody>
</table>