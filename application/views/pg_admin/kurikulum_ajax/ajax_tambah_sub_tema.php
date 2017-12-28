<div class="row">
	<div class="col-sm-2">
	</div>
	<div class="col-sm-8">
		<strong>Kelas : </strong>
		<br><?php echo $tema->alias_kelas;?>
		<br>&nbsp;
		<br><strong>Tema :</strong>
		<br><?php echo $tema->tema;?>
		<br>&nbsp;
		<br><strong>Tambah Sub Tema :</strong>
		<br><input type="text" id="input_sub_tema" class="form-control" />
		<br>&nbsp;
		<br>
		<button class="btn btn-danger btn-sm" style="width: 100%;" id="btn-simpan-sub">Simpan Sub Tema</button>
	</div>
	<div class="col-sm-2">
	</div>
</div>

<script type="text/javascript">
$(function(){
	$("#btn-simpan-sub").click(function(){
		idtema 		= <?php echo $tema->id_tema;?>;
		subtema 	= $("#input_sub_tema").val();

		if(subtema !== ""){
			$.ajax({
				type: 'POST',
				url: 'kurikulum/proses_tambah_sub_tema',
				data:{
					'idtema'	: idtema,
					'subtema'	: subtema
				}
			});
		}else{
			alert("Lengkapi form sebelum menyimpan!");
		}
	})
})
</script>