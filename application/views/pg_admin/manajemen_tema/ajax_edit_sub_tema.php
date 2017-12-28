<div class="row">
	<div class="col-sm-4">
	</div>
	<div class="col-sm-4">
		<strong>Kelas : </strong>
		<br><?php echo $subtema->alias_kelas;?>
		<br>&nbsp;
		<br><strong>Kurikulum :</strong>
		<br><?php echo $subtema->nama_kurikulum;?>
		<br>&nbsp;
		<br><strong>Tema :</strong>
		<br><?php echo $subtema->tema;?>
		<br>&nbsp;
		<br><strong>Tambah Sub Tema :</strong>
		<br><input type="text" id="input_sub_tema" class="form-control" value="<?php echo $subtema->sub_tema;?>"/>
		<br>&nbsp;
		<br>
		<button class="btn btn-danger btn-sm" style="width: 100%;" id="btn-simpan-sub">Simpan Sub Tema</button>
	</div>
	<div class="col-sm-4">
	</div>
</div>

<script type="text/javascript">
$(function(){
	$("#btn-simpan-sub").click(function(){
		idsub 		= <?php echo $subtema->id_sub_tema;?>;
		subtema 	= $("#input_sub_tema").val();

		if(subtema !== ""){
			$.ajax({
				type: 'POST',
				url: 'manajemen_tema/proses_edit_sub_tema',
				data:{
					'idsub'		: idsub,
					'subtema'	: subtema
				}
			});
		}else{
			alert("Lengkapi form sebelum menyimpan!");
		}
	})
})
</script>