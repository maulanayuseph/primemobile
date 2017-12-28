$(function(){
	$("#content-rencana").on("click", ".seleksi-saved-mapel", function(e){
		
		id		= $(this).attr("id");
		idsplit	= id.split("-");
		idmapel	= idsplit[1];

		$("#content-rencana").load("pencapaian_belajar/fetch_mapok", "action=fetch_mapok&idmapel=" + idmapel);
	});

	$("#content-rencana").on("click", "#kembalirencanabelajar", function() {
		$("#content-rencana").load("pencapaian_belajar/refresh_rencana");
	});

	$(document).ajaxSend(function(event, jqxhr, settings){
	alamat 				= settings.url;
	alamatfetchmapok 	= alamat.substring(0, 30);
	alamatkembali 		= alamat.substring(0, 34);
		if(alamatfetchmapok === "pencapaian_belajar/fetch_mapok"){
			$("#text-load").html("Memproses pencapaian belajar");
			$("#modal-loader").modal("show");
		}
		if(alamatkembali === "pencapaian_belajar/refresh_rencana"){
			$("#text-load").html("Memproses pencapaian belajar");
			$("#modal-loader").modal("show");
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		alamat 			= options.url;
		alamatfetchmapok 	= alamat.substring(0, 30);
		alamatkembali 		= alamat.substring(0, 34);
		if(alamatfetchmapok === "pencapaian_belajar/fetch_mapok"){
			$("#modal-loader").modal("hide");
		}
		if(alamatkembali === "pencapaian_belajar/refresh_rencana"){
			$("#modal-loader").modal("hide");
		}
	});
	$(document).ajaxError(function(event, request, options){
		alamat 			= options.url;
		alamatfetchmapok 	= alamat.substring(0, 30);
		alamatkembali 		= alamat.substring(0, 34);
		if(alamatfetchmapok === "pencapaian_belajar/fetch_mapok"){
			$("#modal-loader").modal("hide");
			$("#modal-error").modal("show");
		}
		if(alamatkembali === "pencapaian_belajar/refresh_rencana"){
			$("#modal-loader").modal("hide");
			$("#modal-error").modal("show");
		}
	});
})