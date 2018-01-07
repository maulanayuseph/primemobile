$(function(){
	key			= $("#key").val();

	$("#kelas").change(function(){
		idkelas 	= $(this).val();
		if(idkelas === ""){
			$("#kurikulum").html('<option value="">-- Pilih Kurikulum --</option>');
			$("#mapel").html('<option value="">-- Pilih Mata Pelajaran --</option>');
			$("#bab").html('<option value="">-- Pilih Bab --</option>');
		}else{
			$.ajax({
				type: 'POST',
				url: 'ajax_kur_kelas',
				data:{
					'key'			: key,
					'idkelas'		: idkelas
				}
			})
		}
	})

	$("#kurikulum").change(function(){
		idkurikulum		= $(this).val();
		idkelas 		= $("#kelas").val();
		if(idkurikulum === ""){
			$("#mapel").html('<option value="">-- Pilih Mata Pelajaran --</option>');
			$("#bab").html('<option value="">-- Pilih Bab --</option>');
		}else{
			$.ajax({
				type: 'POST',
				url: 'ajax_kur_mapel',
				data:{
					'key'			: key,
					'idkelas'		: idkelas,
					'idkurikulum'	: idkurikulum
				}
			})
		}
	})

	$("#mapel").change(function(){
		idmapel			= $(this).val();
		idkurikulum		= $("#kurikulum").val();
		idkelas 		= $("#kelas").val();
		if(idmapel === ""){
			$("#bab").html('<option value="">-- Pilih Bab --</option>');
		}else{
			$.ajax({
				type: 'POST',
				url: 'ajax_kur_bab',
				data:{
					'key'			: key,
					'idmapel'		: idmapel,
					'idkelas'		: idkelas,
					'idkurikulum'	: idkurikulum
				}
			})
		}
	})

	$("#bab").change(function(){
		load_sub();
	})

	$("#list-sub").on('click', '.btn-urut-sub', function(){
		$('.dd').nestable();
	})

	$("#list-sub").on('change', '.dd', function(){
		console.log($('.dd').nestable('serialize'));
	})

	$("#list-sub").on('click', '.save-urutan-sub', function(){
		$("#modal-urut").modal("hide");
		$('#modal-urut').on('hidden.bs.modal', function (e) {
		  	jsonurutan = $('.dd').nestable('serialize');
			$.ajax({
				type: 'POST',
				url: 'ajax_urut_sub',
				data:{
					'key'			: key,
					'urut'			: jsonurutan
				}
			})
		})
		
	})

	function load_sub(){
		idbab 			= $("#bab").val();
		idmapel			= $("#mapel").val();
		idkelas			= $("#kelas").val();
		idkurikulum 	= $("#kurikulum").val();
		if(idbab === ""){
			$("#list-sub").html("");
		}else{
			$.ajax({
				type: 'POST',
				url: 'ajax_kur_sub',
				data:{
					'key'			: key,
					'idmapel'		: idmapel,
					'idkelas'		: idkelas,
					'idkurikulum'	: idkurikulum,
					'idbab'			: idbab
				}
			})
		}
	}

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

	$("#select-kelas-tambah-mapel").change(function(){

	})

	$(document).ajaxSend(function(event, jqxhr, settings){
		$("#modal-loader").modal("show");
	});
	$(document).ajaxSuccess(function(event, request, options){
		if(options.url !== "ajax_urut_sub"){
			$('#modal-loader').modal('hide');
		}
		if(options.url === "ajax_kur_kelas"){
			$("#kurikulum").html(request.responseText);
		}
		if(options.url === "ajax_kur_mapel"){
			$("#mapel").html(request.responseText);
		}
		if(options.url === "ajax_kur_bab"){
			$("#bab").html(request.responseText);
		}
		if(options.url === "ajax_kur_sub"){
			$("#list-sub").html(request.responseText);
		}
		if(options.url === "ajax_urut_sub"){
			load_sub();
		}
	});
	$(document).ajaxError(function(event, request, options){
		$('#modal-loader').modal('hide');
		$('#modal-urut').on('hidden.bs.modal', function (e) {
			$('#modal-error').modal('show');
		})
	});
})