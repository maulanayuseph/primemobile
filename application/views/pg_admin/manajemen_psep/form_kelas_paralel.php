<form action="<?php echo base_url('pg_admin/akun_psep/proses_kelas_paralel');?>" method="post">
	<table class="table table-striped table-hover table-bordered">
		<?php
			foreach($datakelas as $kelas){
				?>
				<tr>
					<td><?php echo $kelas->alias_kelas;?></td>
					<td><input type="text" name="kelas[<?php echo $kelas->id_kelas;?>]" class="form-control"></td>
				</tr>
				<?php
			}
		?>
	</table>
</form>