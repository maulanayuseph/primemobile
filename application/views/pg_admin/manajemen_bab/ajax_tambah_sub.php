<div class="row">
	<div class="col-sm-4">
	</div>
	<div class="col-sm-4">
		<strong>Kelas :</strong>
		<br><?php echo $bab->alias_kelas;?>
		<br>&nbsp;
		<br><strong>Kurikulum :</strong>
		<br><?php echo $bab->nama_kurikulum;?>
		<br>&nbsp;
		<br><strong>Mata Pelajaran : </strong>
		<br><?php echo $bab->nama_mapel;?>
		<br>&nbsp;
		<br><strong>Bab : </strong>
		<br><?php echo $bab->nama_materi_pokok;?>
		<br>&nbsp;
		<br><strong>Sub Bab : </strong>
		<br><input type="text" id="input-sub" class="form-control"/>
		<br>&nbsp;
		<br><button class="btn btn-sm btn-danger" id="simpan-sub" style="width: 100%;">Tambah Sub Bab</button>
	</div>
	<div class="col-sm-4">
	</div>
</div>

<script type="text/javascript">
$("#simpan-sub").click(function(){
	subbab = $("#input-sub").val();
	if(subbab === ""){
		alert("Lengkapi form sebelum menambahkan sub bab!");
	}else{
		$.ajax({
			type: 'POST',
			url: 'manajemen_bab/proses_tambah_sub_bab',
			data:{
				'idbab'		: <?php echo $bab->id_materi_pokok;?>,
				'subbab'	: subbab
			}
		});
	}
})
</script>