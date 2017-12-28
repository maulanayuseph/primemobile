<div class="row">
	<div class="col-sm-2">
	</div>
	<div class="col-sm-8">
		<strong>Materi Pokok : </strong>
		<br><?php echo $mapok->nama_materi_pokok;?>
		<br>&nbsp;
		<br><strong>Sub Bab : </strong>
		<br><?php echo $submateri->nama_sub_materi;?>
		<br>&nbsp;
		<br><strong>Sub Tema : </strong>
		<br>
		<select class='form-control' id="select_sub_bab_tema">
			<option value="0">-- Pilih Sub Tema --</option>
			<?php
				foreach($datasubtema as $subtema){
					?>
					<option value="<?php echo $subtema->id_sub_tema;?>"><?php echo $subtema->sub_tema;?></option>
					<?php
				}
			?>
		</select>
		<br>&nbsp;
		<br>
		<button class="btn btn-sm btn-danger simpan_sub_bab_tema" style="width:100%;">Simpan Sub Tema</button>
	</div>
	<div class="col-sm-2">
	</div>
</div>

<script type="text/javascript">
$(function(){
	$(".simpan_sub_bab_tema").click(function(){
		idsub 		= <?php echo $submateri->id_sub_materi;?>;
		idsubtema 	= $("#select_sub_bab_tema").val();

		$.ajax({
			type: 'POST',
			url: 'kurikulum/proses_edit_sub_bab_tema',
			data:{
				'idsub'		: idsub,
				'idsubtema' : idsubtema
			}
		});
	})	
})
</script>