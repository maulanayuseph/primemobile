<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th class="text-center">Mapel</th>
			<th class="text-center">Assign</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($datamapel as $mapel){
				?>
				<tr>
					<td><?php echo $mapel->nama_mapel;?></td>
					<td class="text-center">
						<button class="btn btn-sm btn-danger assign" id="assign-<?php echo $mapel->id_mapel;?>">Assign >></button>
					</td>
				</tr>
				<?php
			}
		?>
	</tbody>
</table>