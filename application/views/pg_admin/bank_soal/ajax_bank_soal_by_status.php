<table class="table display table-striped table-borderd table-hover">
	<thead>
		<tr>
			<th style="width: 10px;">#</th>
			<th class="text-center">Soal</th>
			<th class="text-center">Topik</th>
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
					<td>
						<?php
							echo html_entity_decode($soal->pertanyaan);
						?>
					</td>
					<td>
						<?php
							echo html_entity_decode($soal->topik);
						?>
					</td>
					<td class="text-center">
						<a href="<?php echo base_url("pg_admin/banksoal/ajax_view_soal/" . $soal->id_banksoal);?>" target="_BLANK" class='btn btn-sm btn-danger'><i class="fa fa-eye" aria-hidden="true"></i></a>
						<a href="<?php echo base_url("pg_admin/banksoal/edit/" . $soal->id_banksoal);?>" target="_BLANK" class='btn btn-sm btn-danger'><i class="fa fa-pencil" aria-hidden="true"></i></a>
						<?php
							if($this->session->userdata('level') == "adminqc"){
								?>
								<button class="btn btn-sm btn-danger approve" id="approve-<?php echo $soal->id_banksoal;?>"><i class="fa fa-check" aria-hidden="true"></i></button>
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