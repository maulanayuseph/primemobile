$(document).ready(function(){
	//klik function jangan pakai yang ini kalau classnya ganti masih tetep disa dieksekusi
	/*
	$(".select_bab_k13").click(function(e) {
		idmentah 	= e.target.id;
		idsplit 	= idmentah.split("-");
		kurikulum 	= idsplit[0];
		idmapok 	= idsplit[2];
		$.ajax({
			type: 'POST',
			url: '../ajax_rencana/simpan_mapok',
			data:{
				'idmapok' 	: idmapok,
				'kurikulum'	: kurikulum,
				'tombol'	: idsplit[1]
			}
		});
	});
	*/
	$(".buka-modal-rencana").click(function(){
		kurikulum 	= $("#kurikulum-siswa").val();
		if(kurikulum === ""){
			$('#modalrencana').on('shown.bs.modal', function (e) {
			  $('#modalrencana').modal('hide');
			  $('#modal-error-kurikulum').modal('show');
			})
		}else{
			$('#modalrencana').on('shown.bs.modal', function (e) {
			  	if(kurikulum === "K-13"){
					$('a[href="#tabk13"]').tab('show');
					//alert(kurikulum);
				}else if(kurikulum === "KTSP"){
					$('a[href="#tabktsp"]').tab('show');
					//alert(kurikulum);
				}else if(kurikulum === "K-13 REVISI"){
					//alert("K-13 REVII");
					$('a[href="#tabk13rev"]').tab('show');
				}
			})
		}
	});

	$(".ul-panel-kiri-bab").on("click", ".select_bab_k13", function(e){
		idmentah 	= $(this).attr("id");
		idsplit 	= idmentah.split("-");
		kurikulum 	= idsplit[0];
		idmapok 	= idsplit[2];
		$.ajax({
			type: 'POST',
			url: '../ajax_rencana/simpan_mapok',
			data:{
				'idmapok' 	: idmapok,
				'kurikulum'	: kurikulum,
				'tombol'	: idsplit[1]
			}
		});
	});
	$(".ul-panel-kanan-bab").on("click", ".select_bab_k13", function(e){
		idmentah 	= $(this).attr("id");
		idsplit 	= idmentah.split("-");
		kurikulum 	= idsplit[0];
		idmapok 	= idsplit[2];
		$.ajax({
			type: 'POST',
			url: '../ajax_rencana/simpan_mapok',
			data:{
				'idmapok' 	: idmapok,
				'kurikulum'	: kurikulum,
				'tombol'	: idsplit[1]
			}
		});
		
	});
	//ini unselect tapi kok yang ke eksekusi yang select?
	/*
	$(".unselect_bab_k13").click(function(e) {
		idmentah 	= e.target.id;
		idsplit 	= idmentah.split("-");
		kurikulum 	= idsplit[0];
		idmapok 	= idsplit[2];
		$.ajax({
			type: 'POST',
			url: '../ajax_rencana/hapus_rencana',
			data:{
				'idmapok' 	: idmapok,
				'kurikulum'	: kurikulum,
				'tombol'	: idsplit[1]
			}
		});
	});
	*/
	$(".ul-panel-kiri-bab").on("click", ".unselect_bab_k13", function(e){
		idmentah 	= $(this).attr("id");
		idsplit 	= idmentah.split("-");
		kurikulum 	= idsplit[0];
		idmapok 	= idsplit[2];
		$.ajax({
			type: 'POST',
			url: '../ajax_rencana/hapus_rencana',
			data:{
				'idmapok' 	: idmapok,
				'kurikulum'	: kurikulum,
				'tombol'	: idsplit[1]
			}
		});
	});
	$(".ul-panel-kanan-bab").on("click", ".unselect_bab_k13", function(e){
		idmentah 	= $(this).attr("id");
		idsplit 	= idmentah.split("-");
		kurikulum 	= idsplit[0];
		idmapok 	= idsplit[2];
		$.ajax({
			type: 'POST',
			url: '../ajax_rencana/hapus_rencana',
			data:{
				'idmapok' 	: idmapok,
				'kurikulum'	: kurikulum,
				'tombol'	: idsplit[1]
			}
		});
	});
	
	//aksi ketika tombol mapel tersimpan di klik
	$("#halamanrencana").on("click", ".seleksi-saved-mapel", function(e){
		//alert("hehehehe");
		//id cuman nangkep dari class seleksi-saved-mapel, konten yang didalamnya kalo di klik ya gak bisa nangkep id'nya.. :(
		id		= $(this).attr("id");
		idsplit	= id.split("-");
		idmapel	= idsplit[1];
		
		/*
		$.ajax({
			type: 'POST',
			url: '../ajax_rencana/fetch_mapok',
			data:{
				'action' 	: "fetch_mapok",
				'mapok'		: idmapel
			}
		});
		*/
		$("#halamanrencana").load("../ajax_rencana/fetch_mapok", "action=fetch_mapok&idmapel=" + idmapel);
	});
	
	
	$(document).ajaxSend(function(event, jqxhr, settings){
		//settings data hanya berlaku untuk post. untuk .load tidak bisa, jadi harus dibuat if
		if(settings.data != null){
			pecahdata = settings.data.split('&');
			//alert(pecahdata);
			//alert(pecahdata);
			//load untuk select
			if(pecahdata[2] == 'tombol=accor' || pecahdata[2] == 'tombol=panel' && settings.url == '../ajax_rencana/simpan_mapok'){
				//dapatkan id dari tombol accordion materi pokok
				id 				= pecahdata[0].split("=");
				kurikulumbtn	= pecahdata[1].split("=");
				tombolaccor		= kurikulumbtn[1] + "-" + "accor" + "-" + id[1];
				tombolpanel		= kurikulumbtn[1] + "-" + "panel" + "-" + id[1];
				//alert(idtombol);
				//tampilkan animasi loading ?tambahkan class disabled-bab-kiri biar tombol accor tidak bisa di klik
				$("#" + tombolaccor).addClass("disabled-bab-kiri");
				$("#" + tombolpanel).addClass("disabled-bab-kiri");
				
				$("#halamanrencana").html("<div class='col-sm-12'><div class='load-rencana'></div></div>");
			}
			//load untuk unselect
			if(pecahdata[2] == 'tombol=accor' || pecahdata[2] == 'tombol=panel' && settings.url == '../ajax_rencana/hapus_rencana'){
				//dapatkan id dari tombol accordion materi pokok
				id 				= pecahdata[0].split("=");
				kurikulumbtn	= pecahdata[1].split("=");
				tombolaccor		= kurikulumbtn[1] + "-" + "accor" + "-" + id[1];
				tombolpanel		= kurikulumbtn[1] + "-" + "panel" + "-" + id[1];
				//alert(idtombol);
				//tampilkan animasi loading ?tambahkan class disabled-bab-kiri biar tombol accor tidak bisa di klik
				$("#" + tombolaccor).addClass("disabled-bab-kiri");
				$("#" + tombolpanel).addClass("disabled-bab-kiri");
				
				$("#halamanrencana").html("<div class='col-sm-12'><div class='load-rencana'></div></div>");
			}
			if(pecahdata[0] == 'action=fetch_mapok'){
				$("#halamanrencana").html("<div class='col-sm-12'><div class='load-rencana'></div></div>");
			}
		}
		
		console.log(settings.url);
	});
	
	//FUNGSI AJAX JIKA PROSES SUKSES DI EKSEKUSI
	//options disini sama dengan settings yang ada di ajaxsend (parameter ke 3)
	$(document).ajaxSuccess(function(event, request, options){
		//console.log(options);
		//settings data hanya berlaku untuk post. untuk .load tidak bisa, jadi harus dibuat if
		if(options.data != null){
			pecahdata = options.data.split('&');
			//alert(pecahdata[2]);
			//untuk select
			if((pecahdata[2] == 'tombol=accor' || pecahdata[2] == 'tombol=panel') && options.url == '../ajax_rencana/simpan_mapok'){
				//dapatkan id dari tombol accordion materi pokok
				id 				= pecahdata[0].split("=");
				kurikulumbtn	= pecahdata[1].split("=");
				tombolaccor		= kurikulumbtn[1] + "-" + "accor" + "-" + id[1];
				tombolpanel		= kurikulumbtn[1] + "-" + "panel" + "-" + id[1];
				//alert(idtombol);
				//hentikan animasi loading dan kasih tanda di tombol bahwa materi pokok sudah tersimpan
				$("#" + tombolaccor).removeClass("disabled-bab-kiri");
				$("#" + tombolpanel).removeClass("disabled-bab-kiri");
				
				if(request.responseText === "gagal psep"){
					$("#modal-error-aktivasi").modal("show");
				}else if(request.responseText === "sukses"){
					$("#" + tombolaccor).removeClass("select_bab_k13");
					$("#" + tombolaccor).addClass("unselect_bab_k13");
					$("#" + tombolpanel).removeClass("select_bab_k13");
					$("#" + tombolpanel).addClass("unselect_bab_k13");
					
					//tambahkan prepend checklist di masing2 tombol
					$("#" + tombolaccor).prepend('<span class="glyphicon glyphicon-ok" id="ok-kiri-k13-' + id[1] + '" aria-hidden="true"></span> ');
					$("#" + tombolpanel).prepend('<span class="glyphicon glyphicon-ok" id="ok-kanan-k13-' + id[1] + '" aria-hidden="true"></span> ');
				}
				//refresh tampilan rencana belajar untuk mengecek apakah ada rencana belajar tersimpan atau tidak
				$("#halamanrencana").load("../ajax_rencana/refresh_rencana");
				//console.log("hahahaa");
			}
			//untuk unselect
			if((pecahdata[2] == 'tombol=accor' || pecahdata[2] == 'tombol=panel') && options.url == '../ajax_rencana/hapus_rencana'){
				//dapatkan id dari tombol accordion materi pokok
				id 				= pecahdata[0].split("=");
				kurikulumbtn	= pecahdata[1].split("=");
				tombolaccor		= kurikulumbtn[1] + "-" + "accor" + "-" + id[1];
				tombolpanel		= kurikulumbtn[1] + "-" + "panel" + "-" + id[1];
				//alert(idtombol);
				//hentikan animasi loading dan kasih tanda di tombol bahwa materi pokok sudah tersimpan
				$("#" + tombolaccor).removeClass("disabled-bab-kiri");
				$("#" + tombolaccor).addClass("select_bab_k13");
				$("#" + tombolaccor).removeClass("unselect_bab_k13");
				$("#" + tombolpanel).removeClass("disabled-bab-kiri");
				$("#" + tombolpanel).addClass("select_bab_k13");
				$("#" + tombolpanel).removeClass("unselect_bab_k13");
				
				//remove prepend checklist
				//alert("#ok-k13-" + id[1]);
				$("#ok-kiri-k13-" + id[1]).remove();
				$("#ok-kanan-k13-" + id[1]).remove();
				
				//refresh tampilan rencana belajar untuk mengecek apakah ada rencana belajar tersimpan atau tidak
				$("#halamanrencana").load("../ajax_rencana/refresh_rencana");
				//console.log("hahahaa");
			}
			if(pecahdata[0] == 'action=fetch_mapok'){
				alert("sdasdasd");
			}
		}
	})
	//error handler jika fungsi ajax gagal
	$(document).ajaxError(function(){
		$('#modalrencanaerror').modal('show');
	})
	
})