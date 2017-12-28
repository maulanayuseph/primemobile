<table class="table display table-bordered table-striped">
	<thead>
		<tr>
			<th style="width: 10px;">#</th>
			<th>Sub Bab</th>
			<th>Operasi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$x = 1;
			foreach($datasub as $sub){
				?>
					<tr>
						<td><?php echo $x;?></td>
						<td><?php echo $sub->nama_psep_sub_bab;?></td>
						<td></td>
					</tr>
				<?php
			}
		?>
	</tbody>
</table>
<script>
$(document).ready(function() {
    $('table.display').DataTable();
});
</script>