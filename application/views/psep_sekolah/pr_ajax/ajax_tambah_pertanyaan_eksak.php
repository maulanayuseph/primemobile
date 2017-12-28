<div class="row">
	<div class="col-md-12">
		<input type="hidden" id="idintrosoal" value="<?php echo $idintrosoal;?>" />
		<label>Pertanyaan<span class="text-danger">*</span></label>
		<textarea class="tinymce_textarea">
		</textarea>
		<label>Jawaban<span class="text-danger">*</span></label>
		<input type="text" id="jawaban" class="form-control" />
		<br>
		<br>
		<button type="button" style="float: right;" type="submit" class="btn btn-primary btn-sm" id="simpanintro">Simpan Perubahan</button>
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
	$("#simpanintro").click(function(e){
		idintrosoal		= $("#idintrosoal").val();
		//tinyMCE.triggerSave();
		pertanyaan		= tinyMCE.activeEditor.getContent();
		jawaban			= $("#jawaban").val();
		
		$.ajax({
			type: 'POST',
			url: '../ajax_proses_tambah_pertanyaan_eksak',
			data:{
				'idintrosoal' 	: idintrosoal,
				'pertanyaan'	: pertanyaan,
				'jawaban'		: jawaban
			}
		});
	});
	
	$(document).ajaxSend(function(event, jqxhr, settings){
		if(settings.url === "../ajax_proses_tambah_pertanyaan_eksak"){
			$('#text-load').html('Menyimpan pertanyaan');
			$('#modal-loader').appendTo("body").modal('show');
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		if(options.url === "../ajax_proses_tambah_pertanyaan_eksak"){
			//$('#modal-loader').modal('hide');
			//console.log(options.data);
			datasoal = options.data;
			idawal = datasoal.split("&");
			idsoal = idawal[0].split("=");
			idintrosoal = idsoal[1];
			console.log(idintrosoal);
			$("#soal").load("../ajax_daftar_soal/" + <?php echo $idpr;?>);
			$('#modaledit').modal('hide');
		}
	});
	$(document).ajaxError(function(event, request, options){
		if(options.url === "../ajax_proses_tambah_pertanyaan_eksak"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
	})
});
</script>