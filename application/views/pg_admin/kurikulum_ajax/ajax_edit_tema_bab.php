<div class="row">
	<div class="col-sm-2">
	</div>
	<div class="col-sm-8">
		<strong>Bab : </strong>
		<br><?php echo $bab->nama_materi_pokok;?>
		<br>&nbsp;
		<br><strong>Tema : </strong>
		<br>
		<select class="form-control" id="select-tema-bab">
			<option value="0">-- Pilih Tema --</option>
			<?php
				foreach($datatema as $tema){
					?>
					<option value="<?php echo $tema->id_tema;?>" <?php echo $tema->id_tema == $bab->id_tema ? 'selected':'';?>><?php echo $tema->tema;?></option>
					<?php
				}
			?>
		</select>
		<br>&nbsp;
		<br>
		<button class="btn btn-sm btn-danger" style="width: 100%;" id="simpan-bab-tema">Simpan Tema Bab</button>
	</div>
	<div class="col-sm-2">
	</div>
</div>

<script type="text/javascript">
$(function(){
	$("#simpan-bab-tema").click(function(){
		idmapok		= <?php echo $bab->id_materi_pokok;?>;
		tema 		= $("#select-tema-bab").val();
		$.ajax({
			type: 'POST',
			url: 'kurikulum/proses_edit_tema_bab',
			data:{
				'idmapok' 	: idmapok,
				'tema'		: tema
			}
		})
	})
})
</script>