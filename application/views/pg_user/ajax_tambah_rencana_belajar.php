<script>
$(function(){
	$("#kembalirencanabelajar").click(function() {
		$("#content-rencana").load("ajax_rencana_belajar_awal");
	});
	$("#simpan-rencana").click(function(){
		$("#content-rencana").load("ajax_simpan_rencana_belajar/" + encodeURI($("#rencanabaru").val()));
	});
});
</script>
<div class="col-md-3 hidden-xs">
</div>
<div class="col-md-6 col-xs-12">
<div class="panel panel-default">
  <div class="panel-heading">Buat Rencana Belajar Baru</div>
  <div class="panel-body panel-tambah-rencana">
	
	<div class="col-sm-2">
	<img src="<?php echo base_url("assets/pg_user/images/materi-thumbs/man-reading.png");?>" style="width: 44px; height: auto; margin: 0 auto;"/>
	<br>&nbsp;
	</div>
	<div class="col-sm-10">
	Masukkan judul rencana belajar anda, kemudian klik <b>Lanjut </b> untuk mulai memilih Bab pelajaran mana saja yang akan anda gunakan sebagai rencana belajar
	</div>
	<div class="col-sm-12">
	<br>&nbsp;
    <input type="text" class="form-control" id="rencanabaru"/>
	</div>
	<div class="col-sm-12">
	<br>&nbsp;
	</div>
	<div class="col-sm-6 col-xs-12 col-btn-kembali">
		<button class="btn btn-sm btn-primary" id="kembalirencanabelajar"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Kembali</button>
	</div>
	<div class="col-sm-6 col-xs-12 col-btn-lanjut">
		<button class="btn btn-sm btn-success" style="float: right;" id="simpan-rencana">Lanjut <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></button>
	</div>
  </div>
</div>
</div>
<div class="col-md-3 hidden-xs">
</div>