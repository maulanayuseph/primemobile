<!DOCTYPE html>

<html lang="en">

	<head>

		<title>Pekerjaan Rumah | Prime Mobile - Cara belajar masa kini</title>

			

			<!-- Meta Tags -->

	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	    <meta name="description" content="">

	    <meta name="keywords" content="">

	    <meta name="author" content="">

	    <meta name="viewport" content="width=device-width, initial-scale=1">

	    

	    <!-- Icon -->

	    <link rel="shortcut icon" href="<?php echo base_url('assets/pg_user/images/icons/favicon.ico');?>">

	    <link rel="icon" sizes="130x128" href="<?php echo base_url('assets/pg_user/images/icons/favicon.ico');?>">

	    <link rel="apple-touch-icon" sizes="130x128" href="<?php echo base_url('assets/pg_user/images/icons/favicon.ico');?>">



			<!-- Stylesheets -->

	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/bootstrap.css');?>">
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom.css');?>">
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom-2.css');?>">
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/main.css');?>">
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/edit.css');?>">
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/jPaginator.css');?>">

			

			<!-- Needed for Video Player -->

			<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/shaka-player.js');?>"></script>

			<script>

			  function supports_media_source()

			  {

			      "use strict";

			      var hasWebKit = (window.WebKitMediaSource !== null && window.WebKitMediaSource !== undefined),

			          hasMediaSource = (window.MediaSource !== null && window.MediaSource !== undefined);

			      return (hasWebKit || hasMediaSource);

			  }

			</script>



	</head>

	<body onload="JavaScript:connect(); myFunction();" style="background-color: #f7304b;">

		<style>
			.no-js #loader { display: none;  }
			.js #loader { display: block; position: absolute; left: 100px; top: 0; }
			.se-pre-con {
				position: fixed;
				left: 0px;
				top: 0px;
				width: 100%;
				height: 100%;
				z-index: 9999;
				background: url('<?php echo base_url('assets/img/preloading.gif') ?>') center no-repeat #fff;
			}
		</style>

		<div class="se-pre-con"></div>

		<div class="header">

			<!-- Navbar  -->

			<?php include('header_latihan.php'); ?>

		</div>

		<!-- /Header -->



    <?php include "modal_pembahasan.php"; ?>

		

		<!-- Page Body -->

		<div class="page-body latihan-soal" style="background-color: #f7304b; margin-bottom: 50px;">

			<div class="soal-header" style="background-color: white;">
				<br>&nbsp;
				<strong>Pekerjaan Rumah / Tugas</strong>
				<br><strong><?php echo $infopr->nama_pr; ?><strong>
				<br><strong>Deadline : <?php echo $infopr->deadline; ?><strong>
				<div class="keterangan-wrapper">
				<ul class="keterangan">
					<li>
						<button id="save" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span></button>
						<button class="btn btn-primary" data-toggle="modal" data-target="#modalconfirm"><span class="glyphicon glyphicon-send" aria-hidden="true"></span></button> <input type="hidden" id="hasil_ajax" />
						<br>&nbsp;
					</li>
				</ul></div>
				
			</div>
				<div class="wrapper-soal">
					<div class="container">
						
						<form id="form_soal" method="post" action="<?php echo base_url('pr/penilaian_eksak')?>">
							<br>&nbsp;
							<div id="alert_simpan">
							</div>
							<div class="tab-content">
							
							<?php

							$no = 1; 
							$idsiswa 	= $this->session->userdata('id_siswa');
							foreach ($data_soal as $item) 

							{ 
							?>
							<div id="item_soal_<?php echo $no;?>" class="tab-pane fade">
								<div class="col-sm-12">
									<?php echo $item->soal;?>
								</div>
								<div class="col-sm-12">
									<textarea class="tinymce_textarea classjawaban_<?php echo $no;?>" id="jawaban_<?php echo $item->id_soal_essai;?>" name="jawaban[]">
									<?php
									//cari apakah sudah dijawab
									$carijawab = $this->model_pr->fetch_terjawab($infopr->id_pr, $item->id_soal_essai, $idsiswa);
									
									if($carijawab !== null){
										echo $carijawab->jawaban;
									}
									?>
									</textarea>
								</div>
							</div>
							<?php

							$no++; 

							} ?>

							
						<textarea id="stopwatch" name="lamapengerjaan" style="display: none;"></textarea>
							<div class="row">
								<input type="hidden" name="idpr" id="id_pr" value="<?php echo $infopr->id_pr;?>" />
								
								<button style="display:none;" type="submit" name="submit_form_soal" id="submit_form_soal" value="submit">SUBMIT</button>

							</div>
							</div>
						</form>



					</div>
					<div class="soal-pagination">

						<nav class="text-center">

						  <ul id="toggle_soal" class="pagination custom-pagination" style="overflow-x: scroll">

						    <?php 

						    $no = 1;

						    foreach ($data_soal as $page)
						    { 
							?>
						    	<li>
								<a data-toggle="tab" href="#item_soal_<?php echo $no;?>" id="toggle_item_soal_<?php echo $no;?>"><?php echo $no;?>
								</a>
								</li>
						    <?php 
								$no++;
						  	} ?>

						  </ul>

						</nav>

					</div>
				</div>

		</div>

		<!-- /Page Body -->

		<!-- Footer -->

		<?php include('footer_latihan.php'); ?>

		<!-- /Footer -->

		

	  <!-- Javascript -->

    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>

    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>

    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/npm.js');?>"></script>

    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/retina.min.js');?>"></script>

    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js');?>"></script>


    </script>

<script src="<?php echo base_url('assets/js/plugins/tinymce/tinymce.min.js');?>" type="text/javascript"></script>
 <script type="text/javascript">
  tinymce.init({
    selector: '.tinymce_textarea',
    skin: 'lightgray',
    menubar: false,
	max_height : 300,
    plugins: [
        "eqneditor advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
        "table contextmenu directionality emoticons paste textcolor responsivefilemanager",
        "code fullscreen youtube autoresize"
      ],
    toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent table | fullscreen" ,
    toolbar2: "| fontsizeselect | styleselect | link unlink anchor | eqneditor image media youtube | forecolor backcolor | responsivefilemanager | code",
    extended_valid_elements: "+iframe[src|width|height|name|align|class]",
    image_advtab: true,
    fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
    relative_urls: false,
    remove_script_host: false,

		//Filemanager
		external_filemanager_path: "<?php echo base_url();?>assets/js/plugins/filemanager/",
		filemanager_title: "Data Filemanager" ,
		external_plugins: { "filemanager" : "<?php echo base_url();?>assets/js/plugins/filemanager/plugin.min.js" },
	 
    //integrating tinymce 4 and kcfinder
    file_browser_callback: function(field, url, type, win) {
      console.log("<?php echo base_url();?>" + 'assets/js/plugins/kcfinder/browse.php?opener=tinymce4&field=' + field + '&type=' + type);
      tinyMCE.activeEditor.windowManager.open({
          file:  "<?php echo base_url();?>" + 'assets/js/plugins/kcfinder/browse.php?opener=tinymce4&field=' + field + '&type=' + type,
          title: 'KCFinder',
          width: 700,
          height: 250,
          inline: true,
          close_previous: false
      }, {
          window: win,
          input: field
      });
      return false;
    }
  });
  </script>
<script>
	$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");
		$("#toggle_soal li a")[0].click();
	});
</script>
<script>
$(document).ready(function(){
	$("#save").click(function(e){
		tinyMCE.triggerSave();
		
		//NOTIFIKASI DAN ANIMASI DOT KETIKA PROSES SIMPAN
		$("#alert_simpan").html('<div class="alert alert-success" role="alert">Mohon tunggu, sedang menyimpan tugas<span id="wait"></span></div>');
		
		window.dotsGoingUp = true;
		var dots = window.setInterval( function() {
		var wait = document.getElementById("wait");
		if ( window.dotsGoingUp ) 
			wait.innerHTML += ".";
		else {
			wait.innerHTML = wait.innerHTML.substring(1, wait.innerHTML.length);
			if ( wait.innerHTML === "")
				window.dotsGoingUp = true;
		}
		if ( wait.innerHTML.length > 9 )
			window.dotsGoingUp = false;
		}, 100);
		//END NOTIFIKASI DAN ANIMASI DOT
		
		$('#hasil_ajax').val('');
		for(i = 1; i <= <?php echo $no-1;?>; i++){
			idpr = $('#id_pr').val();
			rawidsoal = $('.classjawaban_' + i).attr('id');
			idsoal = rawidsoal.split("_");
			var jawaban = $('#jawaban_' + idsoal[1]).val();
			//alert(idsoal[1] + " " + jawaban);
			//simpan_jawaban(idpr, idsoal[1], jawaban);
			//result = 0;
			$.ajax({
				type: 'POST',
				url: '../ajax_save_jawaban_essai',
				data: {
					'idpr': idpr,
					'idsoal' : idsoal[1],
					'jawaban' : jawaban
					// other data
				},
				success: function(data) {
					//alert(data);
					//console.log(result);
					if($('#hasil_ajax').val() == ""){
						$('#hasil_ajax').val('berhasil');
					}else if($('#hasil_ajax').val() == "berhasil"){
						$('#hasil_ajax').val('berhasil');
					}else if($('#hasil_ajax').val() == "gagal"){
						$('#hasil_ajax').val('gagal');
					}
				},
				error: function(xhr, textStatus, errorThrown){
					//alert(data);
					//console.log(result);
					if($('#hasil_ajax').val() == ""){
						$('#hasil_ajax').val('gagal');
					}else if($('#hasil_ajax').val() == "berhasil"){
						$('#hasil_ajax').val('gagal');
					}else if($('#hasil_ajax').val() == "gagal"){
						$('#hasil_ajax').val('gagal');
					}
				}
			});
		}
		$(document).ajaxStop(function() {
			if($('#hasil_ajax').val() == "berhasil"){
				$("#alert_simpan").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Sukses!</strong> Tugas berhasil disimpan</div>');
				//setTimeout($("#alert_simpan").html(''), 5000);
			}else if($('#hasil_ajax').val() == "gagal"){
				$("#alert_simpan").html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error!</strong> Gagal menyimpan tugas</div>');
				//setTimeout($("#alert_simpan").html(''), 5000);
			}
		});
	})
	
	$("#submitugas").click(function(e){
		 window.onbeforeunload=null;
		 tinyMCE.triggerSave();
		//NOTIFIKASI DAN ANIMASI DOT KETIKA PROSES SIMPAN
		$("#alert_simpan").html('<div class="alert alert-success" role="alert">Mohon tunggu, sedang menyimpan tugas<span id="wait"></span></div>');
		
		/*
		window.dotsGoingUp = true;
		var dots = window.setInterval( function() {
		var wait = document.getElementById("wait");
		if ( window.dotsGoingUp ) 
			wait.innerHTML += ".";
		else {
			wait.innerHTML = wait.innerHTML.substring(1, wait.innerHTML.length);
			if ( wait.innerHTML === "")
				window.dotsGoingUp = true;
		}
		if ( wait.innerHTML.length > 9 )
			window.dotsGoingUp = false;
		}, 100);
		*/
		//END NOTIFIKASI DAN ANIMASI DOT
		
		$('#hasil_ajax').val('');
		for(i = 1; i <= <?php echo $no-1;?>; i++){
			idpr = $('#id_pr').val();
			rawidsoal = $('.classjawaban_' + i).attr('id');
			idsoal = rawidsoal.split("_");
			var jawaban = $('#jawaban_' + idsoal[1]).val();

			//alert(idsoal[1] + " " + jawaban);
			//simpan_jawaban(idpr, idsoal[1], jawaban);
			//result = 0;
			
			$.ajax({
				type: 'POST',
				url: '../ajax_save_jawaban_essai',
				data: {
					'idpr': idpr,
					'idsoal' : idsoal[1],
					'jawaban' : jawaban,
					'selesai' : 'selesai'
					// other data
				},
				success: function(data) {
					//alert(data);
					//console.log(result);
					if($('#hasil_ajax').val() == ""){
						$('#hasil_ajax').val('berhasil');
					}else if($('#hasil_ajax').val() == "berhasil"){
						$('#hasil_ajax').val('berhasil');
					}else if($('#hasil_ajax').val() == "gagal"){
						$('#hasil_ajax').val('gagal');
					}
				},
				error: function(xhr, textStatus, errorThrown){
					//alert(data);
					//console.log(result);
					if($('#hasil_ajax').val() == ""){
						$('#hasil_ajax').val('gagal');
					}else if($('#hasil_ajax').val() == "berhasil"){
						$('#hasil_ajax').val('gagal');
					}else if($('#hasil_ajax').val() == "gagal"){
						$('#hasil_ajax').val('gagal');
					}
				}
			});
		}
		$(document).ajaxStop(function() {
			if($('#hasil_ajax').val() == "berhasil"){
				$("#alert_simpan").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Sukses!</strong> Submit tugas berhasil! silahkan tunggu, sedang mengalihkan halaman...</div>');
				//setTimeout($("#alert_simpan").html(''), 5000);
				
				window.location.replace("<?php echo base_url('user/dashboard');?>");
			}else if($('#hasil_ajax').val() == "gagal"){
				$("#alert_simpan").html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error!</strong> Submit tugas gagal! Silahkan coba kembali</div>');
				//setTimeout($("#alert_simpan").html(''), 5000);
			}
		});
	})
});
</script>

<script>

window.onbeforeunload = function (e) {
	
    e = e || window.event;
    // For IE and Firefox prior to version 4
    if (e) {
        e.returnValue = "yakin?";
    }
    // For Safari
    return "yakin?";
};
</script>

<!-- Modal -->
<div class="modal fade" id="modalconfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        Apakah anda yakin untuk menyelesaikan tugas, dan melakukan submit?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="submitugas">Submit</button>
      </div>
    </div>
  </div>
</div>
	</body>

</html>
