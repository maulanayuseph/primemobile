<div class="row">
	<div class="col-sm-4">
	</div>
	<div class="col-sm-4">
		<strong>Nama Kurikulum :</strong>
		<br>
		<input type="text" id="input-kurikulum" class="form-control" value="<?php echo $kurikulum->nama_kurikulum;?>"/>
		<br>&nbsp;
		<br>
		<button class="btn btn-sm btn-danger" id="btn-edit" style="width: 100%;">Edit Kurikulum</button>
	</div>
	<div class="col-sm-4">
	</div>
</div>

<script type="text/javascript">
$(function(){
	$("#btn-edit").click(function(){
		idkurikulum = <?php echo $kurikulum->id_kurikulum;?>;
		kurikulum 	= $("#input-kurikulum").val();

		if(kurikulum !== ""){
			$.ajax({
				type: 'POST',
				url: 'manajemen_kurikulum/proses_edit',
				data:{
					'idkurikulum'	: idkurikulum,
					'kurikulum'		: kurikulum
				}
			});
		}else{
			alert("Nama kurikulum tidak boleh kosong");
		}
	})
})	
</script>