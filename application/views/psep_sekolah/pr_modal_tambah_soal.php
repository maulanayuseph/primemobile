<div class="row">
<?php
if($infopr->tipe == 1){
	?>
	<div class="col-md-6">
		<select class="form-control" id="sumber" name="sumber" required>
			<option value="0">-- Pilih Sumber Soal --</option>
			<option value="1">Latihan Soal</option>
			<option value="2">Bank Soal Prime Mobile</option>
			<option value="3">Bank Soal Sekolah</option>
		</select>
	</div>
	<div class="col-md-6" id="manage">
	</div>
	<div class="col-md-12">
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th style="width: 20px;" class="text-center">No.</th>
					<th class="text-center">Soal</th>
					<th class="text-center">Kunci</th>
					<th class="text-center">
						Insert
					</th>
				</tr>
			</thead>
			<tbody id="daftarsoal">
			
			</tbody>
		</table>
	</div>
	<script>
	$(function(){
		$("#sumber").change(function(){
			$("#manage").load("../ajax_manage/" + $("#sumber").val() + "/" + <?php echo $infopr->id_pr;?>);
			//alert(<?php echo $infopr->id_pr;?>);
		});
	});
	</script>
	<?php
}elseif($infopr->tipe == 2){
?>
<script>
$(function(){
	$("#sumber").change(function(){
		$("#manage").load("../ajax_manage/" + $("#sumber").val());
	});
	
	var max_fields      = 10; //maximum input boxes allowed
    //var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    //var add_button      = $(".add_field_button"); //Add button ID
   
    var x = 1; //initlal text box count
    $(".add_field_button").click(function(){ //on add input button click
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
			var content;
			$.get('../ajax_append_soal', function(data){
				content= data;
				//$('#result').prepend(content);
				$(".input_fields_wrap").append(content);
			});
             //add input box
        }
    });
   
    $(".input_fields_wrap").on("click",".remove_field", function(){ //user click on remove text
		$(this).parent('div').remove(); x--;
    })
});
</script>
<form action="<?php echo base_url("psep_sekolah/pr/proses_tambah_soal_eksakta");?>" method="post">
	<input type="hidden" value="<?php echo $infopr->id_pr;?>" name="idpr"/>
	<div class="form-group">
		<div class="col-md-12">
			<label>Pendahuluan Soal<span class="text-danger">*</span></label>
			<textarea class="tinymce_textarea" name="intro">
			</textarea>
		</div>
	</div>
	
	<div class="input_fields_wrap">
		<div class="form-group">
			<div class="col-md-6">
				<label>Pertanyaan 1<span class="text-danger">*</span></label>
				<textarea class="tinymce_textarea" name="pertanyaan[]">
				</textarea>
				<label>Jawaban 1<span class="text-danger">*</span></label>
				<input type="text" name="jawaban[]" class="form-control" placeholder="jawaban 1"/>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<label>&nbsp;</label><br>
		<button type="button" class="btn btn-primary add_field_button">+</button>
	</div>
	<div class="col-md-12" style="text-align: right;">
		<input type="submit" class="btn btn-primary" value="Tambah Soal"/>
	</div>
	<form method="post" enctype='multipart/form-data' id="frmupload">
		<input name="filegambar" type="file" id="filegambar" onchange="" style="display:none;">
	</form>
	</form>
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
<?php
}elseif($infopr->tipe == 3){
	?>
	<input type="hidden" value="<?php echo $infopr->id_pr;?>" id="idpr"/>
	<div class="form-group">
		<div class="col-md-12">
			<label>Soal<span class="text-danger">*</span></label>
			<textarea class="tinymce_textarea" id="soal">
			</textarea>
		</div>
	</div>
	
	<div class="input_fields_wrap">
		<div class="form-group">
			<div class="col-md-12">
				<label>Jawaban<span class="text-danger">*</span></label>
				<textarea class="tinymce_textarea" id="jawaban">
				</textarea>
			</div>
		</div>
	</div>
	<div class="col-sm-12">
	<br>&nbsp;
	</div>
	<div class="col-md-12" style="text-align: right;">
		<button class="btn btn-primary" id="tambah-soal">Tambah Soal</button>
	</div>
<form method="post" enctype='multipart/form-data' id="frmupload">
	<input name="filegambar" type="file" id="filegambar" onchange="" style="display:none;">
</form>
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
	$("#tambah-soal").click(function(){
		idpr		= $("#idpr").val();
		soal		= tinyMCE.get('soal').getContent();
		jawaban		= tinyMCE.get('jawaban').getContent();
		$.ajax({
			type: 'POST',
			url: '../ajax_proses_tambah_soal_essai',
			data:{
				'idpr'			: idpr,
				'soal' 			: soal,
				'jawaban'		: jawaban
			}
		});
	});
	
	$(document).ajaxSend(function(event, jqxhr, settings){
		if(settings.url === "../ajax_proses_tambah_soal_essai"){
			$('#text-load').html('Menyimpan soal');
			$('#modal-loader').appendTo("body").modal('show');
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		if(options.url === "../ajax_proses_tambah_soal_essai"){
			$("#soal").load("../ajax_daftar_soal/" + <?php echo $infopr->id_pr;?>);
			$('#modal-soal').modal('hide');
		}
	});
	$(document).ajaxError(function(event, request, options){
		if(options.url === "../ajax_proses_tambah_soal_essai"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
	})
});
 </script>
	<?php
}
?>
</div>