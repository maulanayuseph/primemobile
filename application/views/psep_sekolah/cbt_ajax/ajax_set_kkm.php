<?php
if($kkm !== null){
	$nilaikkm = $kkm->ketuntasan;
}else{
	$nilaikkm = "";
}
?>
<div class="col-sm-4">
</div>
<div class="col-sm-4">
	<?php echo $kategori->nama_kategori;?>
	<br>&nbsp;
	<br><strong>Input KKM :</strong>
	<br>
	<input type="number" class="form-control" id="set-kkm" value="<?php echo $nilaikkm;?>"/>
	<br>&nbsp;
	<br>
	<button class="btn btn-sm btn-primary simpan-kkm" style="width: 100%;">Set KKM</button>
	<br>&nbsp;
	<br>
	<button class="btn btn-sm btn-danger cancel-kkm" style="width: 100%;">Kembali</button>
</div>
<div class="col-sm-4">
</div>

<script type="text/javascript">
$(function(){
	$(".cancel-kkm").click(function(){
		idtryout	= <?php echo $kategori->id_profil;?>;
		$("#mainmodalcontent").load("detail_profil/" + idtryout);
	})
	$(".simpan-kkm").click(function(){
		kkm 	= $("#set-kkm").val();
		if($.isNumeric(kkm) && kkm !== ""){
			idkategori 		= <?php echo $idkategori;?>;
			$.ajax({
				type: 'POST',
				url: 'proses_set_kkm',
				data:{
					'idkategori' 	: idkategori,
					'kkm'			: kkm,
					'idprofil'		: <?php echo $kategori->id_profil;?>
				}
			});
		}else{
			alert("KKM yang anda masukkan bukan angka");
		}
	})
})
</script>