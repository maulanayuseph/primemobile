$(function(){
	key			= $("#key").val();

	$("#kelas-old").change(function(){
		idkelas 	= $(this).val();
		kurikulum 	= $("#kurikulum-old").val();
		if(idkelas !== "" && kurikulum !== ""){
			$.ajax({
				type: 'POST',
				url: 'ajax_mapel_by_kelas_old',
				data:{
					'key'		: key,
					'idkelas'	: idkelas
				}
			});
		}
	})

	$("#kurikulum-old").change(function(){
		idkelas 	= $("#kelas-old").val();
		kurikulum 	= $(this).val();
		if(idkelas !== "" && kurikulum !== ""){
			$.ajax({
				type: 'POST',
				url: 'ajax_mapel_by_kelas_old',
				data:{
					'key'		: key,
					'idkelas'	: idkelas
				}
			})
		}
	});

	$("#proses-mass").click(function(){
		kurikulumold 	= $("#kurikulum-old").val();
		mapelold 		= $("#mapel-old").val();
		kelasnew		= $("#kelas-new").val();
		kurikulumnew 	= $("#kurikulum-new").val();
		mapelnew 		= $("#mapel-new").val();
		if(kurikulumold !== "" && mapelold !== "" && kelasnew !== "" && kurikulumnew !== "" && mapelnew !== ""){
			$.ajax({
				type: 'POST',
				url: 'proses_mass_migrasi',
				data:{
					'key'			: key,
					'kurikulumold'	: kurikulumold,
					'mapelold'		: mapelold,
					'kelasnew'		: kelasnew,
					'kurikulumnew'	: kurikulumnew,
					'mapelnew'		: mapelnew
				}
			})
		}else{
			alert("lengkapi form sebelum melakukan proses migrasi");
		}
	})
	

	$(document).ajaxSend(function(event, jqxhr, settings){
		$("#modal-loader").modal("show");
	});
	$(document).ajaxSuccess(function(event, request, options){
		if(options.url === "../adm_main/refresh_csrf"){
			$("#key").val(request.responseText);
			$('#modal-loader').modal('hide');
		}else if(options.url !== "proses_transfer_bab"){
			$('#modal-loader').modal('hide');
		}

		if(options.url === "ajax_mapel_by_kelas_old"){
			$("#mapel-old").html(request.responseText);
		}
		if(options.url === "proses_mass_migrasi"){
			alert("Migrasi Berhasil!");
		}
		
	});
	$(document).ajaxError(function(event, request, options){
		$('#modal-loader').modal('hide');
		$('#modal-error').modal('show');
	});
})