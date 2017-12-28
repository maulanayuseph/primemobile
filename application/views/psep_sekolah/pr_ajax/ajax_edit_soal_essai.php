<div class="row">
	<input type="hidden" id="idsoalessai" value="<?php echo $soal->id_soal_essai;?>" />
	<div class="form-group">
		<div class="col-md-12">
			<label>Soal<span class="text-danger">*</span></label>
			<textarea><?php echo $soal->soal;?></textarea>
		</div>
	</div>
	<div class="col-sm-12">
	<br>&nbsp;
	</div>
	<div class="col-md-12" style="text-align: right;">
		<button id="simpan-soal" class="btn btn-primary">Simpan Soal</button>
	</div>
</div>
<form method="post" enctype='multipart/form-data' id="frmupload">
	<input name="filegambar" type="file" id="filegambar" onchange="" style="display:none;">
</form>
<script>
$(function(){
tinymce.init({
    selector: 'textarea',
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
});
  </script>
  
<script>
$(function(){
	$("#simpan-soal").click(function(){
		idsoal		= $("#idsoalessai").val();
		soal		= tinyMCE.activeEditor.getContent();
		$.ajax({
			type: 'POST',
			url: '../ajax_proses_edit_soal_essai',
			data:{
				'idsoal'		: idsoal,
				'soal' 			: soal
			}
		});
	});
	
	$(document).ajaxSend(function(event, jqxhr, settings){
		if(settings.url === "../ajax_proses_edit_soal_essai"){
			$('#text-load').html('Menyimpan soal');
			$('#modal-loader').appendTo("body").modal('show');
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		if(options.url === "../ajax_proses_edit_soal_essai"){
			console.log(request.responseText);
			obj = JSON.parse(request.responseText);
			//$("#td-soal-" + obj['id_soal_essai']).html("<p><strong>Pertanyaan :</strong></p>" + obj['soal'] + "<p><strong>Jawaban :</strong></p>" + obj['jawaban']);
			$("#isi-soal-" + obj['id_soal_essai']).html(obj['soal']);
			$("#isi-jawaban-" + obj['id_soal_essai']).html(obj['jawaban']);
			$('#modaledit').modal('hide');
			$('#modal-loader').modal('hide');
		}
	});
	$(document).ajaxError(function(event, request, options){
		if(options.url === "../ajax_proses_edit_soal_essai"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
	})
  });
  </script>