<button class="btn btn-sm btn-danger insert-all" style="width: 100%;" id="all-provinsi-<?php echo $idprovinsi;?>">Insert All >></button>
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th style="width: 10px;">#</th>
			<th class="text-center">Kota</th>
			<th class="text-center">Insert</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$x = 1;
			foreach($datakota as $kota){
				?>
				<tr>
					<td><?php echo $x;?></td>
					<td><?php echo $kota->nama_kota;?></td>
					<td class="text-center">
						<button class="btn btn-sm btn-danger insert-kota" id="kota-<?php echo $kota->id_kota;?>">Insert >></button>
					</td>
				</tr>
				<?php
				$x++;
			}
		?>
	</tbody>
</table>