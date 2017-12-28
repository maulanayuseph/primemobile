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
	
	$("#mapel-old").change(function(){
		kurikulum 	= $("#kurikulum-old").val();
		idmapel 	= $(this).val();
		if(kurikulum !== "" && idkelas !== ""){
			$.ajax({
				type: 'POST',
				url: 'ajax_bab_by_kurikulum',
				data:{
					'key'		: key,
					'idmapel'	: idmapel,
					'kurikulum'	: kurikulum
				}
			})
		}
	})

	$("#mapok-old").change(function(){
		idmapok 	= $(this).val();
		kurikulum 	= $("#kurikulum-old").val();
		if(idmapok !== "" && kurikulum !== ""){
			$.ajax({
				type: 'POST',
				url: 'ajax_sub_materi',
				data:{
					'key'		: key,
					'kurikulum'	: kurikulum,
					'idmapok'	: idmapok
				}
			})
		}
	})


	$('#sub-materi-old').on('click', '#buat-bab', function(){
		
	})

	$(document).ajaxSend(function(event, jqxhr, settings){
		$("#modal-loader").modal("show");
	});
	$(document).ajaxSuccess(function(event, request, options){
		if(options.url !== "../adm_main/refresh_csrf"){
			$.ajax({
				type: 'GET',
				url: '../adm_main/refresh_csrf'
			});
		}else if(options.url === "../adm_main/refresh_csrf"){
			$("#key").val(request.responseText);
			$('#modal-loader').modal('hide');
		}else{
			$('#modal-loader').modal('hide');
		}

		if(options.url === "ajax_mapel_by_kelas_old"){
			$("#mapel-old").html(request.responseText);
		}
		if(options.url === "ajax_bab_by_kurikulum"){
			$("#mapok-old").html(request.responseText);
		}
		if(options.url === "ajax_sub_materi"){
			$("#sub-materi-old").html(request.responseText);
		}
	});
	$(document).ajaxError(function(event, request, options){
		$('#modal-loader').modal('hide');
		$('#modal-error').modal('show');
	});
})