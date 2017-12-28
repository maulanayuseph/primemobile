<table class="display table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th style="width: 10px;">#</th>
			<th class="text-center">Kategori</th>
			<th class="text-center">Operasi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$x = 1;
			foreach($datakategori as $kategori){
				?>
				<tr>
					<td><?php echo $x;?></td>
					<td>
						<?php echo $kategori->atribut;?>
					</td>
					<td class="text-center">
						<?php
							if($kategori->id_login == $this->session->userdata('idpsepsekolah')){
								?>
								<button class='btn btn-sm btn-danger edit' id="edit-<?php echo $kategori->id_atribut;?>"  data-toggle="modal" data-target="#mainmodal" >Edit</button>
								<button class='btn btn-sm btn-danger hapus' id="hapus-<?php echo $kategori->id_atribut;?>">Hapus</button>
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