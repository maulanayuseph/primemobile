<table class="table display table-responsive table-striped table-bordered">
	<thead>
		<tr>
			<th class="text-center" style="width: 10px;">#</th>
			<th class="text-center">Username</th>
			<th class="text-center">Jumlah Soal</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$x = 1;
			foreach($datapenulis as $penulis){
				?>
					<tr>
						<td class="text-center"><?php echo $x;?></td>
						<td><?php echo $penulis->username;?></td>
						<td class="text-center"><?php echo $penulis->jumlah_soal;?></td>
					</tr>
				<?php
				$x++;
			}
		?>
	</tbody>
</table>

<script>
$(document).ready(function() {
    $('table.display').DataTable();
} );
</script>