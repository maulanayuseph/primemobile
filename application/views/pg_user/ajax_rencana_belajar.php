<style>
	.no-js #loader { display: none;  }
	.js #loader { display: block; position: absolute; left: 100px; top: 0; }
	.se-pre-con {
		width: 100%;
		display: none;
		height: 100%;
		position: absolute;
		z-index: 9999;
		background: url('<?php echo base_url('assets/img/ajax-loading.gif') ?>') center no-repeat #ebeaea;
		transition: .5s;
	}
</style>
<script>
$(document).ready(function(){
    $(document).ajaxStart(function(){
        $(".se-pre-con").css("display", "block");
    });
    $(document).ajaxComplete(function(){
        $(".se-pre-con").css("display", "none");
    });
});
</script>
<script>
$(function(){
	$("#btn-tambah-rencana").click(function() {
		$("#content-rencana").load("ajax_tambah_materi");
	});
	$(".btn-pilihmateri").click(function() {
		$("#content-rencana").load("ajax_materi_tersimpan_by_mapel/" + $(this).attr('id'));
	});
});
</script>
<div class="se-pre-con"></div>
<button class="btn btn-primary" id="btn-tambah-rencana"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Tambah Rencana Belajar</button>
<p>&nbsp;
<?php
if($materibelajar == null){
	?>
	<img src="<?php echo base_url("assets/pg_user/images/tambah materi.png");?>" class="img img-responsive">
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