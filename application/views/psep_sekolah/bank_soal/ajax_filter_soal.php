<table class="table display table-striped table-bordered">
	<thead>
		<tr>
			<th style="width: 10px;">#</th>
			<th class="text-center">Topik</th>
			<th class="text-center">Soal</th>
			<th class="text-center">Operasi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$x = 1;
		foreach($datasoal as $soal){
			?>
			<tr>
				<td><?php echo $x;?></td>
				<td><?php echo $soal->topik;?></td>
				<td><?php echo $soal->pertanyaan;?></td>
				<td class="text-center">
					<?php
						if($soal->id_login == $this->session->userdata('idpsepsekolah')){
							?>
							<a href="<?php echo base_url("psep_sekolah/bank_soal/edit_soal/" . $soal->id_banksoal);?>" class="btn btn-sm btn-danger">Edit</a>

							<button class="btn btn-sm btn-danger hapus" id="hapus-<?php echo $soal->id_banksoal;?>">Hapus</button>
							<?php
						}
					?>
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