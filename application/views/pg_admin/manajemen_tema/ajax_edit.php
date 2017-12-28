<div class="row">
	<div class="col-sm-4">
	</div>
	<div class="col-sm-4">
		<strong>Kelas :</strong>
		<select class="form-control" id="input-kelas-tema">
			<option value="">--- Pilih Kelas ---</option>
			<?php 
			foreach ($select_options_kelas as $item) { 
			?>
				<option value="<?php echo $item->id_kelas;?>" <?php echo $tema->id_kelas == $item->id_kelas ? "selected" : ""?>> <?php echo $item->alias_kelas; ?> </option>
			<?php
				}
			?>
		</select>
		<br>&nbsp;
		<br>
		<strong>Kurikulum :</strong>
		<br>
		<select class="form-control" id="tambah-kurikulum">
			<option value="">-- Pilih Kurikulum --</option>
			<?php
				foreach($datakurikulum as $kurikulum){
					?>
					<option value="<?php echo $kurikulum->id_kurikulum;?>" <?php echo $tema->id_kurikulum == $kurikulum->id_kurikulum ? "selected": "";?>><?php echo $kurikulum->nama_kurikulum;?></option>
					<?php
				}
			?>
		</select>
		<br>&nbsp;
		<br><strong>Tema : </strong>
		<input type='text' id="input-tema" class="form-control" value="<?php echo $tema->tema;?>"/>
		<br>&nbsp;
		<br>
		<button class="btn btn-danger btn-sm" style="width: 100%;" id="btn-simpan-tema">Edit Tema</button>
	</div>
	<div class="col-sm-4">
	</div>
</div>

<script type="text/javascript">
$(function(){
	$("#btn-simpan-tema").click(function(){
		idkelas 	= $("#input-kelas-tema").val();
		tema 		= $("#input-tema").val();
		kurikulum 	= $("#tambah-kurikulum").val();
		if(tema !== "" && idkelas !== "" && kurikulum !== ""){
			$.ajax({
				type: 'POST',
				url: 'manajemen_tema/proses_edit',
				data:{
					'idtema'		: <?php echo $tema->id_tema;?>,
					'idkelas' 		: idkelas,
					'idkurikulum'	: kurikulum,
					'tema'			: tema
				}
			});
		}else{
			alert("Lengkapi form tema sebelum menyimpan!");
		}
	})
})
</script>