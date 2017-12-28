<div class="row">
	<div class="col-sm-4">
	</div>
	<div class="col-sm-4">
		<strong>Kelas : </strong>
		<br><?php echo $tema->alias_kelas;?>
		<br><strong>Kurikulum : </strong>
		<br><?php echo $tema->nama_kurikulum;?>
		<br><strong>Tema :</strong>
		<br><?php echo $tema->tema;?>
		<br>&nbsp;
		<br><strong>Tambah Sub Tema :</strong>
		<br><input type="text" id="input_sub_tema" class="form-control" />
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
		idtema 		= <?php echo $tema->id_tema;?>;
		subtema 	= $("#input_sub_tema").val();

		if(subtema !== ""){
			$.ajax({
				type: 'POST',
				url: 'manajemen_tema/proses_tambah_sub_tema',
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