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

	<body onload="JavaScript:connect(); myFunction();">

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

		<div class="page-body latihan-soal">
			<form id="form_soal" method="post" action="<?php echo base_url('pr/penilaian_eksak')?>">
			
			<div class="soal-header">

				<h2>Pekerjaan Rumah</h2>
				<h3><?php echo $infopr->nama_pr; ?></h3>
				<div class="keterangan-wrapper">
				<ul class="keterangan">
					<li>
						<!--
						<button type="button" id="save" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span></button>
						-->
						<button type="submit" name="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-send" aria-hidden="true"></span></button>
					</li>
				</ul></div>
			</div>

			


				<div class="wrapper-soal">

					<div class="container">
							<div id="alert_simpan">
							</div>
							<div class="tab-content">

							<?php

							$no = 1; 

							foreach ($data_soal as $item) 

							{ 
							?>
							<div id="item_soal_<?php echo $no;?>" class="tab-pane fade">
								<div class="col-sm-12">
									<br>&nbsp;
								</div>
								<div class="col-sm-6">
									<div class="panel panel-default">
										<div class="panel-body">
											<?php echo $item->intro_soal;?>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<?php
										//cari pertanyaan dari intro soal
										$caritanya = $this->model_psep->fetch_soal_by_intro($item->id_intro_soal);
										
										foreach($caritanya as $tanya){
											$cariterjawab = $this->model_pr->fetch_terjawab_by_soal($tanya->id_soal_eksak,  $this->session->userdata('id_siswa'));
											
											if($cariterjawab !== null){
												if($cariterjawab->checked == 1){
													?>
													<div class="panel panel-default">
														<div class="panel-body">
														<div class="col-sm-12">
														<?php echo $tanya->pertanyaan;?>
														</div>
														<div class="col-sm-12">
															<div id="answer_group_<?php echo $tanya->id_soal_eksak;?>" class="form-group
															<?php
															if($cariterjawab->status == 1){
																echo "has-success";
															}else{
																echo "has-error";
															}
															?>
															">
																<label class="control-label" for="<?php echo $tanya->id_soal_eksak;?>" id="label_tanya_<?php echo $tanya->id_soal_eksak;?>">
																<?php
																if($cariterjawab->status == 1){
																	echo "BENAR!";
																}else{
																	echo "SALAH!";
																}
																?>
																</label>
																<input name="jawaban<?php echo $tanya->id_soal_eksak;?>"type="text" id="<?php echo $tanya->id_soal_eksak;?>" class="form-control jawaban<?php echo $tanya->id_intro_soal;?>" value="<?php echo $cariterjawab->terjawab;?>"/>
															</div>
														</div>
														</div>
													</div>
													<?php
												}else{
													?>
													<div class="panel panel-default">
														<div class="panel-body">
														<div class="col-sm-12">
														<?php echo $tanya->pertanyaan;?>
														</div>
														<div class="col-sm-12">
															<div id="answer_group_<?php echo $tanya->id_soal_eksak;?>" class="form-group">
																<label class="control-label" for="<?php echo $tanya->id_soal_eksak;?>" id="label_tanya_<?php echo $tanya->id_soal_eksak;?>"></label>
																<input name="jawaban<?php echo $tanya->id_soal_eksak;?>"type="text" id="<?php echo $tanya->id_soal_eksak;?>" class="form-control jawaban<?php echo $tanya->id_intro_soal;?>" value="<?php echo $cariterjawab->terjawab;?>"/>
															</div>
														</div>
														</div>
													</div>
													<?php
												}
											}else{
												?>
												<div class="panel panel-default">
													<div class="panel-body">
													<div class="col-sm-12">
													<?php echo $tanya->pertanyaan;?>
													</div>
													<div class="col-sm-12">
														<div id="answer_group_<?php echo $tanya->id_soal_eksak;?>" class="form-group">
															<label class="control-label" for="<?php echo $tanya->id_soal_eksak;?>" id="label_tanya_<?php echo $tanya->id_soal_eksak;?>"></label>
															<input name="jawaban<?php echo $tanya->id_soal_eksak;?>"type="text" id="<?php echo $tanya->id_soal_eksak;?>" class="form-control jawaban<?php echo $tanya->id_intro_soal;?>"/>
														</div>
													</div>
													</div>
												</div>
												<?php
											}
										}
									?>
									<div class="col-xs-12">
										<strong>Kesempatan Cek jawaban : 
										<span id="kontencek<?php echo $item->id_intro_soal;?>">
										<?php
											$carikesempatan = $this->model_pr->fetch_kesempatan_eksak($this->session->userdata('id_siswa'), $item->id_intro_soal);
											if($carikesempatan !== null){
												if($carikesempatan->kesempatan == 0){
													echo $carikesempatan->kesempatan;
												}else{
													echo $carikesempatan->kesempatan - 1;
												}
											}else{
												echo 3;
											}
										?>
										</span>
										</strong>
									</div>
									<div class="col-xs-12" id="alert_<?php echo $item->id_intro_soal;?>">
									
									</div>
									<div class="col-xs-6">
										<button id="opsi_<?php echo $item->id_intro_soal;?>" type="button" class="cek_jawaban btn btn-primary">Cek Jawaban</button>
									</div>
									<div class="col-xs-6" style="text-align: right;">
										<button id="opsi_<?php echo $item->id_intro_soal;?>" type="button" class="simpan_jawaban btn btn-primary">Simpan Jawaban</button>
									</div>
								</div>
							</div>
							<?php

							$no++; 

							} ?>

							
						<textarea id="stopwatch" name="lamapengerjaan" style="display: none;"></textarea>
							<div class="row">

								<input type="hidden" placeholder="skor" id="textSkor" name="skor" value="0"/>
								
								<button style="display:none;" type="submit" name="submit_form_soal" id="submit_form_soal" value="submit">SUBMIT</button>

							</div>
							</div>
						



					</div>

				</div>
				</form>
				

				<div class="container">

					<div class="soal-pagination">

						<nav class="text-center">

						  <ul id="toggle_soal" class="pagination custom-pagination" style="overflow-x: scroll">

						    <?php 

						    $no = 1;

						    foreach ($data_soal as $page) 

						    { ?>
							<?php 
								if(isset($sudah_dijawab[$page->id_intro_soal])){
							?>
								<li class="benar">
								<a data-toggle="tab" href="#item_soal_<?php echo $no;?>" id="toggle_item_soal_<?php echo $no;?>">
								<i class='glyphicon glyphicon-ok'></i>
								</a>
								</li>
							<?php
								}else{
							?>
						    	<li>
								<a data-toggle="tab" href="#item_soal_<?php echo $no;?>" id="toggle_item_soal_<?php echo $no;?>"><?php echo $no;?>
								
								</a>
								</li>
						    <?php 
								}
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

<script>
$(document).ready(function(){
	$(".cek_jawaban").click(function(e){
		var id_soal = e.target.id || null;
		//alert(id_soal);
		var value = id_soal.split("_");
		// Get data as array, ['Jon', 'Mike']
		var jawaban = $('.jawaban' + value[1]).map(function(){ 
			return this.id + "_" + this.value; 
		}).get();
		console.log(jawaban);
		for(i = 0; i < jawaban.length; i++ ){
			var splitjawab = jawaban[i].split("_");
			if (splitjawab[1] == "") {
				//alert("Tidak dapat memeriksa jawaban, isi semua kolom jawaban!");
				$('#kontenmodal').html("Tidak dapat memeriksa jawaban, isi semua kolom jawaban!");
				$('#modalalertpr').modal('show');
				return false;
			}
		}
		$.ajax({
			type: 'POST',
			url: '../ajax_cek_kesempatan_eksak',
			data: {
				'idsoal' : value[1]
				// other data
			},
			success: function(result) {
				//console.log(result);
				
				if(result > 0){
					$('#kontencek' + value[1]).html(parseInt(result) - 1);
					$.ajax({
						type: 'POST',
						url: '../ajax_cek_jawaban_eksak',
						data: {
							'jawaban[]': jawaban,
							'idsoal' : value[1]
							// other data
						},
						success: function(result) {
							//console.log(result);
							var apakahlogin = result.substr(0, 9);
							if(apakahlogin == "<!DOCTYPE"){
								window.location.replace("<?php echo base_url("login");?>");
								return false;
							}
							var rawhasil = result.split(";");
							
							for(i = 0; i < rawhasil.length; i++){
								var hasiljawab = rawhasil[i].split("_");
								for(x = 0; x < hasiljawab.length; x++){
									if(hasiljawab[1] == "benar"){
										$("#answer_group_" + hasiljawab[0]).removeClass("has-success");
										$("#answer_group_" + hasiljawab[0]).removeClass("has-error");
										
										$("#answer_group_" + hasiljawab[0]).addClass("has-success");
										$("#label_tanya_" + hasiljawab[0]).html("BENAR!");
									}else{
										$("#answer_group_" + hasiljawab[0]).removeClass("has-success");
										$("#answer_group_" + hasiljawab[0]).removeClass("has-error");
										
										$("#answer_group_" + hasiljawab[0]).addClass("has-error");
										$("#label_tanya_" + hasiljawab[0]).html("SALAH!");
									}
								}
							}
						}
					});
				}else{
					$('#kontenmodal').html("Anda sudah menggunakan fasilitas cek jawaban sebanyak 3X, anda tidak dapat menggunakan fasilitas cek jawaban lagi");
					$('#modalalertpr').modal('show');
				}
			}
		});
	});
	$(".simpan_jawaban").click(function(e){
		var id_soal = e.target.id || null;
		//alert(id_soal);
		var value = id_soal.split("_");
		// Get data as array, ['Jon', 'Mike']
		var jawaban = $('.jawaban' + value[1]).map(function(){ 
			return this.id + "_" + this.value; 
		}).get();
		
		$('#alert_' + value[1]).html("<div class='alert alert-success' role='alert'>Mohon tunggu...<div>");
		
		console.log(jawaban);
		for(i = 0; i < jawaban.length; i++ ){
			var splitjawab = jawaban[i].split("_");
			if (splitjawab[1] == "") {
				//alert("Tidak dapat memeriksa jawaban, isi semua kolom jawaban!");
				$('#kontenmodal').html("Tidak dapat menyimpan jawaban, isi semua kolom jawaban!");
				$('#modalalertpr').modal('show');
				return false;
			}
		}
		$.ajax({
			type: 'POST',
			url: '../ajax_save_jawaban_eksak',
			data: {
				'jawaban[]': jawaban,
				'idsoal' : value[1]
				// other data
			},
			success: function(result) {
				//console.log(result);
				var apakahlogin = result.substr(0, 9);
				if(apakahlogin == "<!DOCTYPE"){
					window.location.replace("<?php echo base_url("login");?>");
					return false;
				}
				var rawhasil = result.split(";");
				
				for(i = 0; i < rawhasil.length; i++){
					var hasiljawab = rawhasil[i].split("_");
					for(x = 0; x < hasiljawab.length; x++){
						if(hasiljawab[1] == "benar"){
							$('#alert_' + value[1]).html("<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Jawaban berhasil Disimpan<div>");
						}else{
							$('#alert_' + value[1]).html("<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Jawaban berhasil Disimpan<div>");
						}
					}
				}
			}
		});
	});
});
</script>

<script>
$(document).ready(function(){
	$("#save").click(function(e){
		tinyMCE.triggerSave();
		
		//NOTIFIKASI DAN ANIMASI DOT KETIKA PROSES SIMPAN
		$("#alert_simpan").html('Mohon tunggu, sedang menyimpan pekerjaan<span id="wait"></span>');
	
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
				timeout: 5000,
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
				$("#alert_simpan").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Sukses!</strong> Pekerjaan berhasil disimpan</div>');
				//setTimeout($("#alert_simpan").html(''), 5000);
			}else if($('#hasil_ajax').val() == "gagal"){
				$("#alert_simpan").html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error!</strong> Gagal menyimpan pekerjaan</div>');
				//setTimeout($("#alert_simpan").html(''), 5000);
			}
		});
	})
});
</script>



<script>
	$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");
		$("#toggle_soal li a")[0].click();
	});
</script>

<div class="modal fade" id="modalalertpr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body" id="kontenmodal">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

	</body>

</html>
