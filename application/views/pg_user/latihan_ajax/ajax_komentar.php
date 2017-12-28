<div class="row">
	<div class="col-sm-12">
		<form>
		<input type="radio" name="check-komentar" value="suka" /> Saya Suka
		<br>
		<br><input type="radio" name="check-komentar" value="salah" /> Ada Kesalahan
		<br>
		<br><input type="radio" name="check-komentar" value="jelas" /> Perlu Penjelasan
		<br>
		<br>Komentar :
		<textarea class="form-control" style="width: 100%; min-height: 100px;" id="input-komentar-soal"></textarea>
		<br>&nbsp;
		</form>
	</div>
	<div class="col-sm-6">
		<button class="btn btn-sm btn-primary submit-komentar" style="width:100%;">Kirim Komentar</button>
	</div>
	<div class="col-sm-6">
		<button class="btn btn-sm btn-danger tutup-komentar" style="width:100%;">Batal</button>
	</div>
</div>

<script type="text/javascript">
$(function(){
	$(".submit-komentar").click(function(){
		checked 	= $("input[name='check-komentar']:checked").val();
		komentar 	= $("#input-komentar-soal").val();
		if(checked !== undefined){
			$.ajax({
				type: 'POST',
				url: '../submit_komentar',
				data:{
					'idsoal' 	: <?php echo $idsoal;?>,
					'tipe'		: checked,
					'komentar'	: komentar
				}
			})
		}else{
			alert("Mohon lengkapi form sebelum mengirim komentar");
		}
	})
	$(".tutup-komentar").click(function(){
		$("#modal-loader").modal("hide");
		$("#modal-komentar").modal('hide');
		$("body").css("padding-right", "0px;");
	})
	$(document).ajaxSend(function(event, jqxhr, settings){
		
	});
	$(document).ajaxSuccess(function(event, request, options){
		
	});
})
</script>