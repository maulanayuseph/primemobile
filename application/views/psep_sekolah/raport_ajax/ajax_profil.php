<table class="table display table-bordered table-striped">
	<thead>
		<th style="width: 10px;" class="text-center">#</th>
		<th class="text-center">Kelas</th>
		<th class="text-center">Tahun Ajaran</th>
		<th class="text-center">Semester</th>
		<th class="text-center">Operasi</th>
	</thead>
	<tbody>
		<?php
			$x = 1;
			foreach($dataprofil as $profil){
				?>
				<tr>
				<td><?php echo $x;?></td>
				<td><a href="<?php echo base_url("psep_sekolah/raport/detail/" . $profil->id_profil_raport);?>"><?php echo $profil->alias_kelas;?></a></td>
				<td class="text-center"><?php echo $profil->tahun_ajaran;?></td>
				<td class="text-center">Semester <?php echo $profil->semester;?></td>
				<td class="text-center">
					
					<button class="btn btn-sm btn-danger">Edit</button>
					<button class="btn btn-sm btn-danger">Hapus</button>
				</td>
				</tr>
				<?php
				$x++;
			}
		?>
	</tbody>

<script>
$(function(){
	$('table.display').DataTable();
});
</script>