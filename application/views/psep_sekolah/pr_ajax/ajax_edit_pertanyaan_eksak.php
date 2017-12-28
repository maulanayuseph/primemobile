<div class="row">
	<div class="col-md-12">
		<input type="hidden" id="idpertanyaan" value="<?php echo $tanya->id_soal_eksak;?>" />
		<label>Pertanyaan<span class="text-danger">*</span></label>
		<textarea class="tinymce_textarea" name="pertanyaan"><?php echo $tanya->pertanyaan;?>
		</textarea>
		<label>Jawaban<span class="text-danger">*</span></label>
		<input type="text" id="jawaban" class="form-control" value="<?php echo $tanya->jawaban;?>"/>
		<button id="simpan-pertanyaan" class="btn btn-primary" style="float: right;">Simpan Pertanyaan</button>
		
		<form method="post" enctype='multipart/form-data' id="frmupload">
			<input name="filegambar" type="file" id="filegambar" onchange="" style="display:none;">
		</form>
	</div>
</div>

<script type="text/javascript">
  tinymce.init({
    selector: '.tinymce_textarea',
    skin: 'lightgray',
    menubar: false,
    plugins: [
        "eqneditor advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
        "table contextmenu directionality emoticons paste textcolor",
        "code fullscreen youtube autoresize"
      ],
    toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent table | fullscreen" ,
    toolbar2: "| fontsizeselect | styleselect | link unlink anchor | eqneditor image media youtube | forecolor backcolor | code",
    extended_valid_elements: "+iframe[src|width|height|name|align|class]",
    image_advtab: true,
    fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
    relative_urls: false,
    remove_script_host: false,
	
	file_picker_callback: function(callback, value, meta) {
      if (meta.filetype == 'image') {
        $('#filegambar').trigger('click');
        $('#filegambar').on('change', function() {
		  
          var path = "<?php echo base_url('assets/uploads/materi') ?>/";
		  var fileInput = document.getElementById('filegambar');   
		  var filename = fileInput.files[0].name;
		  filename = filename.replace(/ /g, "_");
		  fullpath = path + filename;

		  var url = "<?php echo base_url('pg_admin/upload_gambar') ?>";

		  $.ajax({
				type: "POST",
				url: url,
				data: new FormData($('#frmupload')[0]),
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					$('#text-load').html('Proses Upload Gambar');
					$('#modal-loader').appendTo("body").modal('show');
				},
				success: function(data){
					$('#modal-loader').modal('hide');
					callback(fullpath);
				}
		  });

        });
      }
    },
  });
  </script>
  
  <script>
$(function(){
	$("#simpan-pertanyaan").click(function(e){
		idpertanyaan		= $("#idpertanyaan").val();
		//tinyMCE.triggerSave();
		pertanyaan		= tinyMCE.activeEditor.getContent();
		jawaban		= $("#jawaban").val();
		//console.log(idintrosoal);
		//console.log(introsoal);
		//alert(introsoal);
		//alert(rawid);
		//$("#konten-edit").load("../ajax_edit_intro/" + idintro);
		$.ajax({
			type: 'POST',
			url: '../ajax_proses_edit_pertanyaan_eksak',
			data:{
				'idpertanyaan' 	: idpertanyaan,
				'pertanyaan'	: pertanyaan,
				'jawaban'		: jawaban
			}
		});
	});
	
	$(document).ajaxSend(function(event, jqxhr, settings){
		if(settings.url === "../ajax_proses_edit_pertanyaan_eksak"){
			$('#text-load').html('Menyimpan pertanyaan');
			$('#modal-loader').appendTo("body").modal('show');
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		if(options.url === "../ajax_proses_edit_pertanyaan_eksak"){
			$('#modaledit').modal('hide');
			$('#modal-loader').modal('hide');
			datasoal = options.data;
			idawal = datasoal.split("&");
			idsoal = idawal[0].split("=");
			idpertanyaan = idsoal[1];
			console.log(idpertanyaan);
			console.log(request.responseText)
			obj = JSON.parse(request.responseText);
			$("#pertanyaan-" + obj['id_soal_eksak']).html(obj['pertanyaan']);
			$("#jawaban-" + obj['id_soal_eksak']).html(obj['jawaban']);
		}
	});
	$(document).ajaxError(function(event, request, options){
		if(options.url === "../ajax_proses_edit_pertanyaan_eksak"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
	})
});
</script>