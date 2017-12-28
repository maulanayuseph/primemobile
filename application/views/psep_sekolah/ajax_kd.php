<div class="row">
	<div class="col-sm-6">
		<select class="form-control" id="kelas-kd">
			<option value="0">--- Pilih Kelas ---</option>
			<?php
				foreach($datakelas as $kelas){
					?>
					<option value="<?php echo $kelas->id_kelas;?>"><?php echo $kelas->alias_kelas;?></option>
					<?php
				}
			?>
		</select>
	</div>
	<div class="col-sm-6">
	</div>
	<div class="col-sm-6">
	</div>
	<div class="col-sm-6">
	</div>
	
</div>