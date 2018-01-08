$(function(){
	key			= $("#key").val();

	$("#kelas").change(function(){
		idkelas 	= $(this).val();
		if(idkelas === ""){
			$("#kurikulum").html('<option value="">-- Pilih Kurikulum --</option>');
			$("#mapel").html('<option value="">-- Pilih Mata Pelajaran --</option>');
			$("#bab").html('<option value="">-- Pilih Bab --</option>');
		}else{
			$("#kurikulum").html('<option value="">-- Pilih Kurikulum --</option>');
			$("#mapel").html('<option value="">-- Pilih Mata Pelajaran --</option>');
			$("#bab").html('<option value="">-- Pilih Bab --</option>');
			$.ajax({
				type: 'POST',
				url: 'ajax_kur_kelas',
				data:{
					'key'			: key,
					'idkelas'		: idkelas
				},
				success: function(response){
					$("#kurikulum").html(response);
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
			$("#mapel").html('<option value="">-- Pilih Mata Pelajaran --</option>');
			$("#bab").html('<option value="">-- Pilih Bab --</option>');
			$.ajax({
				type: 'POST',
				url: 'ajax_kur_mapel',
				data:{
					'key'			: key,
					'idkelas'		: idkelas,
					'idkurikulum'	: idkurikulum
				},
				success: function(response){
					$("#mapel").html(response);
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
			$("#bab").html('<option value="">-- Pilih Bab --</option>');
			$.ajax({
				type: 'POST',
				url: 'ajax_kur_bab',
				data:{
					'key'			: key,
					'idmapel'		: idmapel,
					'idkelas'		: idkelas,
					'idkurikulum'	: idkurikulum
				},
				success: function(response){
					$("#bab").html(response);
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
		idkelas = $(this).val();
		if(idkelas === ""){
			$("#select-kurikulum-tambah-mapel").html('<option value="">-- Pilih Kurikulum --</option>');
		}else{
			$.ajax({
				type: 'POST',
				url: 'ajax_kur_kelas',
				data:{
					'key'			: key,
					'idkelas'		: idkelas
				},
				success: function(response){
					$("#select-kurikulum-tambah-mapel").html(response);
				}
			})
		}
	})

	$("#select-kelas-tambah-bab").change(function(){
		idkelas = $(this).val();
		if(idkelas === ""){
			$("#select-kurikulum-tambah-bab").html('<option value="">-- Pilih Kurikulum --</option>');
			$("#select-mapel-tambah-bab").html('<option value="">-- Pilih Mata Pelajaran --</option>');
		}else{
			$.ajax({
				type: 'POST',
				url: 'ajax_kur_kelas',
				data:{
					'key'			: key,
					'idkelas'		: idkelas
				},
				success: function(response){
					$("#select-kurikulum-tambah-bab").html(response);
				}
			})
		}
	})

	$("#select-kurikulum-tambah-bab").change(function(){
		idkurikulum = $(this).val();
		idkelas 	= $('#select-kelas-tambah-bab').val();
		if(idkurikulum === ""){
			$("#select-mapel-tambah-bab").html('<option value="">-- Pilih Mata Pelajaran --</option>');
		}else{
			$.ajax({
				type: 'POST',
				url: 'ajax_kur_mapel',
				data:{
					'key'			: key,
					'idkelas'		: idkelas,
					'idkurikulum'	: idkurikulum
				},
				success: function(response){
					$("#select-mapel-tambah-bab").html(response);
				}
			})
		}
	})

	$("#select-mapel-tambah-bab").change(function(){
		idmapel		= $(this).val();
		$.ajax({
			type: 'POST',
			url: 'ajax_bab_by_mapel',
			data:{
				'key'			: key,
				'idmapel'		: idmapel
			},
			success: function(response){
				$("#kol-tambah-bab").html(response);
				$("#select-bab-tambah-bab").chosen();
			}
		})
	})

	$("#hapus-kurkelas").click(function(){
		idkelas		= $("#kelas").val();
		idkurikulum	= $("#kurikulum").val();
		if(idkelas !== "" && idkurikulum !== ""){
			$.ajax({
				type: 'POST',
				url: 'cek_hapus_kur_kelas_mapel',
				data:{
					'key'			: key,
					'idkelas'		: idkelas,
					'idkurikulum'	: idkurikulum
				},
				success: function(response){
					$('#modal-loader').on('hidden.bs.modal', function (e) {
						$(".modal-hapus").modal("show");
						$("#konten-cek-hapus").html(response);
					})
				}
			})
		}else{
			alert("Pilih Kelas dan Kurikulum!");
		}
	})

	$("#hapus-kurmapel").click(function(){
		idkelas		= $("#kelas").val();
		idkurikulum	= $("#kurikulum").val();
		idmapel		= $("#mapel").val();
		if(idkelas !== "" && idkurikulum !== "" && idmapel !== ""){
			$.ajax({
				type: 'POST',
				url: 'cek_hapus_kur_mapel_mapel',
				data:{
					'key'			: key,
					'idkelas'		: idkelas,
					'idkurikulum'	: idkurikulum,
					'idmapel'		: idmapel
				},
				success: function(response){
					$('#modal-loader').on('hidden.bs.modal', function (e) {
						$(".modal-hapus").modal("show");
						$("#konten-cek-hapus").html(response);
					})
				}
			})
		}else{
			alert("Pilih Mata Pelajaran");
		}
	})

	$("#hapus-kurbab").click(function(){
		idkelas		= $("#kelas").val();
		idkurikulum	= $("#kurikulum").val();
		idbab 		= $("#bab").val();
		if(idkelas !== "" && idkurikulum !== "" && idbab !== ""){
			$.ajax({
				type: 'POST',
				url: 'cek_hapus_kur_bab_mapel',
				data:{
					'key'			: key,
					'idkelas'		: idkelas,
					'idkurikulum'	: idkurikulum,
					'idbab'			: idbab
				},
				success: function(response){
					$('#modal-loader').on('hidden.bs.modal', function (e) {
						$(".modal-hapus").modal("show");
						$("#konten-cek-hapus").html(response);
					})
				}
			})
		}else{
			alert("Pilih Bab");
		}
	})

	$('#list-sub').on('submit', '#form-tambah-sub', function(event){
		event.preventDefault();
		$.ajax({
			type: 'POST',
			url: 'proses_tambah_kur_sub',
			data: $(this).serialize(),
			success: function(response){
				if(response === "sukses"){
					$('#modal-loader').on('hidden.bs.modal', function (e) {
						$("#modal-tambah-sub").modal("hide");
					})
					$('#modal-tambah-sub').on('hidden.bs.modal', function (e) {
						load_sub();
					})
				}else{
					$('#modal-loader').modal('hide');
					$('#modal-loader').on('hidden.bs.modal', function (e) {
						$('#modal-error').modal('show');
					})
				}
			}
		})
	})

	$('#kol-tambah-bab').on('click', '.tambah-input-bab', function(){
		$('#kol-input-bab-baru').css('display', 'block');
		$("#select-bab-exist").css('display', 'none');
	})

	$('#kol-tambah-bab').on('click', '.batal-input-bab', function(){
		$('#input-bab-baru').val('');
		$('#kol-input-bab-baru').css('display', 'none');
		$("#select-bab-exist").css('display', 'block');
	})

	$("#list-sub").on('click', '.input-sub-baru', function(){
		$('.col-exist-sub').css('display', 'none');
		$('.col-new-sub').css('display', 'block');
	})

	$("#list-sub").on('click', '.batal-sub-baru', function(){
		$('#input-sub-baru').val("");
		$('.col-exist-sub').css('display', 'block');
		$('.col-new-sub').css('display', 'none');
	})

	$("#list-sub").on('click', '.tambah-judul', function(){
		rawid 		= $(this).attr("id");
		idsplit 	= rawid.split("-");
		idkursub 	= idsplit[1];
		$("#tambah-judul-idkursub").val(idkursub);
		$("#modal-tambah-judul").modal("show");
	})

	$(document).ajaxSend(function(event, jqxhr, settings){
		$("#modal-loader").modal("show");
	});
	$(document).ajaxSuccess(function(event, request, options){
		if(options.url !== "ajax_urut_sub"){
			$('#modal-loader').modal('hide');
		}
		if(options.url === "ajax_kur_sub"){
			$("#list-sub").html(request.responseText);
			$("#select-tambah-sub").chosen();
		}
		if(options.url === "ajax_urut_sub"){
			load_sub();
		}
	});
	$(document).ajaxError(function(event, request, options){
		$('#modal-loader').modal('hide');
		$('#modal-loader').on('hidden.bs.modal', function (e) {
			$('#modal-error').modal('show');
		})
	});
})