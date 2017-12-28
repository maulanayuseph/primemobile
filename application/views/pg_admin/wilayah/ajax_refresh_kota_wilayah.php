<table class="table display table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th style="width: 10px;">#</th>
			<th class="text-center">Kota</th>
			<th class="text-center">Operasi</th>
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
						<button class="btn btn-sm btn-danger hapus-kota" id="kota-<?php echo $wilayah->id_wilayah;?>-<?php echo $kota->id_kota;?>">Hapus Kota</button>
					</td>
				</tr>
				<?php
				$x++;
			}
		?>
	</tbody>
</table>