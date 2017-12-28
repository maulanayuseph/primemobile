<input type="hidden" id="edit-idtema" value="<?php echo $tema->id_tema;?>" />
<div class="row">
	<div class="col-sm-2">
	</div>
	<div class="col-sm-8">
		<strong>Kelas :</strong>
		<select class="form-control" id="edit-kelas-tema">
			<option value="">--- Pilih Kelas ---</option>
			<?php 
			foreach ($select_options_kelas as $item) { 
			?>
				<option value="<?php echo $item->id_kelas;?>" <?php echo $item->id_kelas == $tema->id_kelas ? 'selected' : '';?>> <?php echo $item->alias_kelas; ?> </option>
			<?php
				}
			?>
		</select>
		<br>&nbsp;
		<br><strong>Tema : </strong>
		<input type='text' id="edit-tema" class="form-control" value="<?php echo $tema->tema;?>"/>
		<br>&nbsp;
		<br>
		<button class="btn btn-danger btn-sm" style="width: 100%;" id="btn-simpan-tema">Simpan Tema</button>
	</div>
	<div class="col-sm-2">
	</div>
</div>

<script type="text/javascript">
$(function(){
	$("#btn-simpan-tema").click(function(){
		idkelas 	= $("#edit-kelas-tema").val();
		tema 		= $("#edit-tema").val();
		idtema 		= $("#edit-idtema").val();
		if(tema !== "" && idkelas !== ""){
			$.ajax({
				type: 'POST',
				url: 'kurikulum/proses_edit_tema',
				data:{
					'idtema'	: idtema,
					'idkelas' 	: idkelas,
					'tema'		: tema
				}
			});
		}else{
			alert("Lengkapi form tema sebelum menyimpan!");
		}
	})
})
</script>