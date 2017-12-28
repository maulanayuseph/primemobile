<div class="row">
	<div class="col-sm-4">
	</div>
	<div class="col-sm-4">
		<strong>Nama Kurikulum :</strong>
		<br>
		<input type="text" id="input-kurikulum" class="form-control" />
		<br>&nbsp;
		<br>
		<button class="btn btn-sm btn-danger" id="btn-tambah" style="width: 100%;">Tambah Kurikulum</button>
	</div>
	<div class="col-sm-4">
	</div>
</div>

<script type="text/javascript">
$(function(){
	$("#btn-tambah").click(function(){
		kurikulum 	= $("#input-kurikulum").val();

		if(kurikulum !== ""){
			$.ajax({
				type: 'POST',
				url: 'manajemen_kurikulum/proses_tambah',
				data:{
					'kurikulum'	: kurikulum
				}
			});
		}else{
			alert("Lengkapi form sebelum menambah kurikulum");
		}
	})
})	
</script>