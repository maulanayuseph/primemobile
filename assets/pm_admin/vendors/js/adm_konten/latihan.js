$(function(){
	key			= $("#key").val();

	/* TINYMCE INIT */
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
		toolbar2: "| fontsizeselect | styleselect | link unlink anchor | image youtube | forecolor backcolor | code",
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
					success: function(data){
						NProgress.done(); 
						callback(fullpath);
					}
			  });

		    });
		  }
		}
	});
	/* end tinymce ini */

	kategorinotif 	= $("#kategori-notif").val();
	pesannotif 		= $("#pesan-notif").val();

	if(kategorinotif === "success"){
		console.log(pesannotif);
		new PNotify({
		    title: 'Success!',
		    text: pesannotif,
		    type: 'success',
		    styling: 'bootstrap3'
		});
	}else if(kategorinotif === "error"){
		console.log(pesannotif);
		new PNotify({
		    title: 'Oh No!',
		    text: pesannotif,
		    type: 'error',
		    styling: 'bootstrap3'
		});
	}

	$('#grouping').on('click', '.expand-group', function(){
		rawid 	= $(this).attr("id");
		idsplit = rawid.split("-");
		idgroup	= idsplit[1];

		if($("#expanded-" + idgroup).css('display') === "none" && $("#expanded-" + idgroup).html() === ""){
			//console.log($("#expanded-" + idgroup).html());
			$.ajax({
				type: 'POST',
				url: 'ajax_expand_group_latihan',
				data:{
					'key'			: key,
					'idgroup'		: idgroup
				},
				success: function(response){
					$("#expanded-" + idgroup).html(response);
					$("#expanded-" + idgroup).css('display', 'block');
				}
			})
		}else if($("#expanded-" + idgroup).css('display') === "none" && $("#expanded-" + idgroup).html() !== ""){
			$("#expanded-" + idgroup).css('display', 'block');
		}else{
			$("#expanded-" + idgroup).css('display', 'none');
		}
	})

	$("#select-indikator").chosen();

	$(document).ajaxSend(function(event, jqxhr, settings){
		$("#modal-loader").modal("show");
	});
	$(document).ajaxSuccess(function(event, request, options){
		$('#modal-loader').modal('hide');
	});
	$(document).ajaxError(function(event, request, options){
		$('#modal-loader').modal('hide');
		$('#modal-loader').on('hidden.bs.modal', function (e) {
			$('#modal-error').modal('show');
		})
	});
})