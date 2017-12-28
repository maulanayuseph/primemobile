<table class="display table table-bordered table-striped">
	<thead>
		<tr>
			<th style="width: 10px;">No.</th>
			<th class="text-center">Mapel</th>
			<th class="text-center">Operasi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$x = 1;
			foreach($assignmapel as $mapel){
				?>
				<tr>
					<td><?php echo $x;?></td>
					<td>
						<?php echo $mapel->alias_kelas;?> - <?php echo $mapel->nama_mapel;?>
					</td>
					<td class="text-center">
						<button class="btn btn-sm btn-danger hapus" id="hapus-<?php echo $mapel->id_mapel;?>">Hapus</button>
					</td>
				</tr>
				<?php
				$x++;
			}
		?>
	</tbody>
</table>

<script type="text/javascript">
$(function(){
	$('table.display').DataTable();
})
</script>