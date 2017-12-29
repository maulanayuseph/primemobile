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
		idkelas 		= $("#kelas-new").val();
		kurikulumold 	= $("#kurikulum-old").val();
		idkurikulum		= $("#kurikulum-new").val();
		idmapel 		= $("#mapel-new").val();
		bab 			= $("#proof-bab").val();
		idmapok 		= $("#mapok-old").val();

		if(idkelas !== "" && idkurikulum !== "" && idmapel !== "" && idmapok !== ""){
			$.ajax({
				type: 'POST',
				url: 'ajax_cek_transfer_bab',
				data:{
					'key'			: key,
					'idkelas'		: idkelas,
					'idkurikulum'	: idkurikulum,
					'idmapel'		: idmapel,
					'bab'			: bab,
					'idmapok'		: idmapok,
					'kurikulumold'	: kurikulumold
				}
			})
		}else{
			alert("Pilih Kelas, Kurikulum dan Mapel tujuan sebelum membuat bab baru");
		}
	})

	$("#mainmodalcontent").on('click', '.btn-proses-transfer-bab', function(){
		idmapok			= $("#mapok-old").val();
		namabab			= $("#proof-bab").val();
		idmapel			= $("#mapel-new").val();
		idkelas			= $("#kelas-new").val();
		idkurikulum		= $("#kurikulum-new").val();
		kurikulum 		= $("#kurikulum-old").val();

		$.ajax({
			type	: 'POST',
			url		: 'proses_transfer_bab',
			data	:{
				'key'			: key,
				'idmapok'		: idmapok,
				'namabab'		: namabab,
				'idmapel'		: idmapel,
				'idkelas'		: idkelas,
				'idkurikulum'	: idkurikulum,
				'kurikulum'		: kurikulum
			}
		})
	})

	$("#mapel-new").change(function(){
		idmapel 	= $(this).val();
		idkelas 	= $("#kelas-new").val();
		idkurikulum = $("#kurikulum-new").val();
		if(idmapel !== "" && idkelas !== "" && idkurikulum !== ""){
			$.ajax({
				type	: 'POST',
				url		: 'ajax_bab',
				data	:{
					'key'			: key,
					'idkelas'		: idkelas,
					'idmapel'		: idmapel,
					'idkurikulum'	: idkurikulum
				}
			})
		}
	})

	$("#kelas-new").change(function(){
		idmapel 	= $("#mapel-new").val();
		idkelas 	= $(this).val();
		idkurikulum = $("#kurikulum-new").val();
		if(idmapel !== "" && idkelas !== "" && idkurikulum !== ""){
			$.ajax({
				type	: 'POST',
				url		: 'ajax_bab',
				data	:{
					'key'			: key,
					'idkelas'		: idkelas,
					'idmapel'		: idmapel,
					'idkurikulum'	: idkurikulum
				}
			})
		}
	})

	$("#kurikulum-new").change(function(){
		idmapel 	= $("#mapel-new").val();
		idkelas 	= $("#kelas-new").val();
		idkurikulum = $(this).val();
		if(idmapel !== "" && idkelas !== "" && idkurikulum !== ""){
			$.ajax({
				type	: 'POST',
				url		: 'ajax_bab',
				data	:{
					'key'			: key,
					'idkelas'		: idkelas,
					'idmapel'		: idmapel,
					'idkurikulum'	: idkurikulum
				}
			})
		}
	})

	$('#sub-materi-old').on('click', '.buat-sub', function(){
		rawid 			= $(this).attr("id");
		idsplit			= rawid.split("-");
		idsubmateri 	= idsplit[2];
		idbab 			= $("#bab-new").val();
		idkelas 		= $("#kelas-new").val();
		idkurikulum 	= $("#kurikulum-new").val();

		if(idbab !== "" && idkelas !== "" && idkurikulum !== ""){
			$("#mainmodal").modal("show");
			$.ajax({
				type	: 'POST',
				url		: 'ajax_cek_buat_sub',
				data	:{
					'key'			: key,
					'idsubmateri'	: idsubmateri,
					'idbab'			: idbab,
					'idkelas'		: idkelas,
					'idkurikulum'	: idkurikulum
				}
			})
		}else{
			alert("Pilih bab tujuan");
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
		if(options.url === "ajax_bab_by_kurikulum"){
			$("#mapok-old").html(request.responseText);
		}
		if(options.url === "ajax_sub_materi"){
			$("#sub-materi-old").html(request.responseText);
		}
		if(options.url === "ajax_cek_transfer_bab"){
			$("#mainmodal").modal("show");
			$("#mainmodaltitle").html("Konfirmasi Transfer Bab");
			$("#mainmodalcontent").html(request.responseText);
		}
		if(options.url === "proses_transfer_bab"){
			alert("TRANSFER BAB BERHASIL !")
			idmapel 	= $("#mapel-new").val();
			idkelas 	= $("#kelas-new").val();
			idkurikulum = $("#kurikulum-new").val();
			if(idmapel !== "" && idkelas !== "" && idkurikulum !== ""){
				$.ajax({
					type	: 'POST',
					url		: 'ajax_bab',
					data	:{
						'key'			: key,
						'idkelas'		: idkelas,
						'idmapel'		: idmapel,
						'idkurikulum'	: idkurikulum
					}
				})
			}
		}
		if(options.url === "ajax_bab"){
			$("#mainmodaltitle").html("Konfirmasi Pembuatan Sub Bab");
			$("#bab-new").html(request.responseText);
		}
		if(options.url === "ajax_cek_buat_sub"){
			$("#mainmodalcontent").html(request.responseText);
		}
	});
	$(document).ajaxError(function(event, request, options){
		$('#modal-loader').modal('hide');
		$('#modal-error').modal('show');
	});
})