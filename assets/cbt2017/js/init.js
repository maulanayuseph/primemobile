$(document).ready(function(){
	$("#regdaftar").click(function(){
		nama		= $("#regnama").val();
		email		= $("#regemail").val();
		hp			= $("#reghp").val();
		username	= $("#regusername").val();
		password	= $("#regpassword").val();
		repassword	= $("#regrepassword").val();

		if(password === repassword){
			if(nama !== "" && email !== "" && hp !== "" && username !== "" && password !== ""){
				if(isEmail(email)){
					//cek dulu apakah username dan password sudah ada yang memiliki
					$.ajax({
						type: 'POST',
						url: 'existing_user',
						data:{
							'username' 		: username,
							'email' 		: email
						}
					});
				}else{
					$("#pesan-error").html("Email yang dimasukkan tidak valid");
					$("#modal-error").modal("show");
				}
			}else{
				$("#pesan-error").html("Form pendaftaran belum lengkap");
				$("#modal-error").modal("show");
			}
		}else{
			$("#pesan-error").html("Password yang anda masukkan tidak sama");
			$("#modal-error").modal("show");
		}
	})

	function isEmail(email) {
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		return regex.test(email);
	}

	$('#reghp').on('keydown', function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110,190])||/65|67|86|88/.test(e.keyCode)&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});


	$('#mainmodalcontent').on('change', '#regprovinsi', function(){
		$("#regkota").load("filter_kota/" + $(this).val());
	});

	$('#mainmodalcontent').on('change', '#regkota', function(){
		$("#regsekolah").load("filter_sekolah/" + $(this).val() + "/" + $("#regjenjang").val());
	});

	$('#mainmodalcontent').on('change', '#regjenjang', function(){
		$("#regsekolah").load("filter_sekolah/" + $("#regkota").val() + "/" + $("#regjenjang").val());
	});

	$('#mainmodalcontent').on("click", "#submitsekolah", function(){
		if($('#regsekolahbaru').val() !== ""){
			tipesekolah = "baru";
			sekolah = $("#regsekolahbaru").val();
		}else{
			tipesekolah = "lama";
			sekolah = $("#regsekolah").val();
		}
		kota 	= $("#regkota").val();
		jenjang = $("#regjenjang").val();
		if(sekolah !== "" && kota !== "" && jenjang !== ""){
			$.ajax({
				type: 'POST',
				url: 'set_sekolah',
				data:{
					'tipesekolah'	: tipesekolah,
					'idkota'		: kota,
					'sekolah' 		: sekolah
				}
			});
		}else{
			$("#pesan-error").html("Lengkapi form sekolah sebelum menyelesaikan pendaftaran");
			$("#modal-error").modal("show");
		}
	})

	$('#mainmodalcontent').on("click", "#tidakketemusekolah", function(){
		$('.sekolah-baru').css('display', 'inline');
		$('.cancel-sekolah-baru').css('display', 'inline');
		$('#regsekolah').css('display', 'none');
	})
	$('#mainmodalcontent').on("click", "#cancelsekolahbaru", function(){
		$('.sekolah-baru').css('display', 'none');
		$('.cancel-sekolah-baru').css('display', 'none');
		$('#regsekolahbaru').val("");
		$('#regsekolah').css('display', 'inline');
	})
	//AJAX HANDLER
	//######################
	//######################
	//######################
	$(document).ajaxSend(function(event, jqxhr, settings){
		alamat = settings.url;
		if(settings.url === "existing_user"){
			$("#text-load").html("Sedang melakukan validasi data, jangan tutup halaman");
			$("#modal-loader").modal("show");
		}
		if(settings.url === "proses_register_event"){
			$("#text-load").html("Sedang melakukan validasi data, jangan tutup halaman");
			$("#modal-loader").modal("show");
		}
		if(settings.url === "register_sekolah"){
			$("#text-load").html("Memuat registrasi sekolah");
		}
		if(settings.url === "set_sekolah"){
			$("#text-load").html("Menyimpan sekolah");
			$("#modal-loader").modal("show");
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		if(options.url === "existing_user"){

			obj = JSON.parse(request.responseText);
			email 		= parseInt(obj['email']);
			username 	= parseInt(obj['username']);
			if(email > 0 && username > 0){
				$("#modal-loader").modal("hide");
				$("#pesan-error").html("Email dan Username yang anda daftarkan sudah ada yang memiliki, silahkan memakai username dan email lain");
				$("#modal-error").modal("show");
			}else if(email > 0 && username == 0){
				$("#modal-loader").modal("hide");
				$("#pesan-error").html("Email yang anda daftarkan sudah ada yang memiliki, silahkan memakai email lain");
				$("#modal-error").modal("show");
			}else if(email == 0 && username > 0){
				$("#modal-loader").modal("hide");
				$("#pesan-error").html("Username yang anda daftarkan sudah ada yang memiliki, silahkan memakai username lain");
				$("#modal-error").modal("show");
			}else{
				idpaket 	= 26;
				idevent 	= 1;
				nama		= $("#regnama").val();
				email		= $("#regemail").val();
				hp			= $("#reghp").val();
				username	= $("#regusername").val();
				password	= $("#regpassword").val();

				$.ajax({
					type: 'POST',
					url: 'proses_register_event',
					data:{
						'idpaket' 	: idpaket,
						'idevent' 	: idevent,
						'nama'		: nama,
						'email'		: email,
						'hp'		: hp,
						'username'	: username,
						'password'	: password
					}
				});
			}
		}
		if(options.url === "proses_register_event"){

			obj = JSON.parse(request.responseText);
			status = obj['status'];
			if(status === "success"){
				$("#mainmodal").modal("show");

				$("#mainmodalcontent").load("register_sekolah");
			}else{
				$("#modal-loader").modal("hide");
				$("#pesan-error").html("Terjadi kesalahan, periksa koneksi atau ulangi kembali");
				$("#modal-error").modal("show");
			}
		}
		if(options.url === "register_sekolah"){
			$("#modal-loader").modal("hide");
		}
		if(options.url === "set_sekolah"){
			$("#text-load").html("Mengalihkan halaman");
			$.ajax({
				type: 'POST',
				url: '../login/do_login',
				data:{
					'akses'		: 'siswa',
					'username'	: $("#regusername").val(),
					'password'	: $("#regpassword").val()
				}
			});
		}
		if(options.url === "../login/do_login"){
			window.location.href = "../user/dashboard";
		}
	});
	$(document).ajaxError(function(event, request, options){
		if(options.url === "existing_user"){
			$("#modal-loader").modal("hide");

			$("#pesan-error").html("Terjadi kesalahan, periksa koneksi atau ulangi kembali");
			$("#modal-error").modal("show");
		}
		if(options.url === "proses_register_event"){
			$("#modal-loader").modal("hide");

			$("#pesan-error").html("Terjadi kesalahan, periksa koneksi atau ulangi kembali");
			$("#modal-error").modal("show");
		}
		if(options.url === "set_sekolah"){
			$("#modal-loader").modal("hide");

			$("#pesan-error").html("Terjadi kesalahan, periksa koneksi atau ulangi kembali");
			$("#modal-error").modal("show");
		}
		if(options.url === "../login/do_login"){
			$("#modal-loader").modal("hide");

			$("#pesan-error").html("Terjadi kesalahan, periksa koneksi atau ulangi kembali");
			$("#modal-error").modal("show");
		}
	});
	//END AJAX HANDLER
	//######################
	//######################
	//######################
})