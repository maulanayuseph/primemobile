<div class="row">
	<div class="col-sm-2">
	</div>
	<div class="col-sm-8">
		<strong>Kelas :</strong>
		<select class="form-control" id="input-kelas-tema">
			<option value="">--- Pilih Kelas ---</option>
			<?php 
			foreach ($select_options_kelas as $item) { 
			?>
				<option value="<?php echo $item->id_kelas;?>" > <?php echo $item->alias_kelas; ?> </option>
			<?php
				}
			?>
		</select>
		<br>&nbsp;
		<br><strong>Tema : </strong>
		<input type='text' id="input-tema" class="form-control" />
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
		idkelas 	= $("#input-kelas-tema").val();
		tema 		= $("#input-tema").val();
		if(tema !== "" && idkelas !== ""){
			$.ajax({
				type: 'POST',
				url: 'kurikulum/proses_tambah_tema',
				data:{
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