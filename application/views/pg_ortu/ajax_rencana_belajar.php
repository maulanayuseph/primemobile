<script>
$(function(){
	$("#btn-tambah-rencana").click(function() {
		$("#content-rencana").load("ajax_tambah_materi");
	});
	$(".btn-pilihmateri").click(function() {
		$("#content-rencana").load("ajax_loader");
		$("#content-rencana").load("ajax_materi_tersimpan_by_mapel/" + $(this).attr('id'));
	});
});
</script>
<p>&nbsp;
<?php
if($materibelajar == null){
	?>
	<img src="<?php echo base_url("assets/pg_user/images/think.png");?>" class="img-tambah-materi center-block">
	<br>Siswa belum menyusun rencana belajar
	<?php
}else{
	foreach($mapeltersimpan as $mapel){
	?>
	<div class='mapel-container'>
		<div class='content'>
				<h4><?php echo $mapel->nama_mapel ;?></h4>
			<button class='btn btn-danger btn-pilihmateri' style='float: right; margin: 15px 0;' id='<?php echo $mapel->id_mapel;?>'>Lihat Materi</button>
		</div>
	</div>
	<?php
	}
}
?>