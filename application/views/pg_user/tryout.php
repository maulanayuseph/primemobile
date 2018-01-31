<!DOCTYPE html>

<html lang="en">

	<head>

		<title>Latihan Soal | Prime Mobile - Cara belajar masa kini</title>

			

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
            
            <form id="form_soal" method="post" action="<?php echo base_url('tryout/penilaian')?>">
            
			<div class="soal-header">

				<h2>Try Out</h2>
				<h1><?php echo $infotryout->nama_kategori; ?></h1>
				<div id="simpanwaktu">
				</div>
				<div class="keterangan-wrapper">
				<ul class="keterangan">
					<li><span class="circle-icon"></span>&nbsp;</li>
					<li><span id="time">00:00</span></li>
					<li><button type="submit" name="submit_form_soal" id="submit_form_soal" value="submit" onclick="return confirm('Apakah anda yakin untuk menyelesaikan tes?')" style="color: black;">Selesaikan Tes</button></li>
					<li><button type="submit" name="submit_form_soal" id="submit_form_soal_force" value="submit" style="color: black; display: none;" >Selesaikan Tes</button></li>
				</ul></div>
			</div>

			


				<div class="wrapper-soal">

					<div class="container">

						

							<div class="tab-content">

							<?php

							$no = 1; 

							foreach ($data_soal as $item) 

							{ 
							if(isset($terjawab)){
								foreach($terjawab as $sudah_jawab){
									if($sudah_jawab->id_soal == $item->id_banksoal){
										$sudah_dijawab[$item->id_banksoal] = $sudah_jawab->terjawab;
									}
								}
							}
							?>

								<div id="item_soal_<?php echo $no;?>" class="tab-pane fade">

									<div class="row equal-row item-soal">

										<div class="col-sm-4 equal-col soal">

												<?php echo $item->pertanyaan ? html_entity_decode($item->pertanyaan) : '';?>

										</div>

										<div class="col-sm-8 equal-col jawaban">
											<h5><span class="glyphicon glyphicon-menu-hamburger"></span>Pilih jawabanmu</h5>
											<input type="radio" class="pilihan_jawaban" name="pilihan_jawaban<?php echo $no;?>" id="opt-a_<?php echo $no;?>" value="<?php echo $item->id_banksoal; ?>-1" 
											<?php 
												if(isset($sudah_dijawab[$item->id_banksoal])){
													if($sudah_dijawab[$item->id_banksoal] == 1){
														echo "checked";
													}
												}
											?>
											>

											<label for="opt-a_<?php echo $no;?>" class="label-opt"> 

												<span class="opt-id"><p>A</p></span> 

												<span class="opt"><?php echo $item->jawab_1 ? html_entity_decode($item->jawab_1) : ''?></span>

											</label>



											<input type="radio" class="pilihan_jawaban" name="pilihan_jawaban<?php echo $no;?>" id="opt-b_<?php echo $no;?>" value="<?php echo $item->id_banksoal; ?>-2"
											<?php 
												if(isset($sudah_dijawab[$item->id_banksoal])){
													if($sudah_dijawab[$item->id_banksoal] == 2){
														echo "checked";
													}
												}
											?>
											>

											<label for="opt-b_<?php echo $no;?>" class="label-opt"> 

												<span class="opt-id"><p>B</p></span> <span class="opt"><?php echo $item->jawab_2 ? html_entity_decode($item->jawab_2) : ''?></span> 

											</label>

											

											<input type="radio" class="pilihan_jawaban" name="pilihan_jawaban<?php echo $no;?>" id="opt-c_<?php echo $no;?>" value="<?php echo $item->id_banksoal; ?>-3"
											<?php 
												if(isset($sudah_dijawab[$item->id_banksoal])){
													if($sudah_dijawab[$item->id_banksoal] == 3){
														echo "checked";
													}
												}
											?>
											>

											<label for="opt-c_<?php echo $no;?>" class="label-opt"> 

												<span class="opt-id"><p>C</p></span> <span class="opt"><?php echo $item->jawab_3 ? html_entity_decode($item->jawab_3) : ''?></span>

											</label>



											<input type="radio" class="pilihan_jawaban" name="pilihan_jawaban<?php echo $no;?>" id="opt-d_<?php echo $no;?>" value="<?php echo $item->id_banksoal; ?>-4"
											<?php 
												if(isset($sudah_dijawab[$item->id_banksoal])){
													if($sudah_dijawab[$item->id_banksoal] == 4){
														echo "checked";
													}
												}
											?>
											>

											<label for="opt-d_<?php echo $no;?>" class="label-opt"> 

												<span class="opt-id"><p>D</p></span> <span class="opt"><?php echo $item->jawab_4 ? html_entity_decode($item->jawab_4) : ''?></span>

											</label>

											<?php if($item->jawab_5 !== ""){
												?>

											<input type="radio" class="pilihan_jawaban" name="pilihan_jawaban<?php echo $no;?>" id="opt-e_<?php echo $no;?>" value="<?php echo $item->id_banksoal; ?>-5"
											<?php 
												if(isset($sudah_dijawab[$item->id_banksoal])){
													if($sudah_dijawab[$item->id_banksoal] == 5){
														echo "checked";
													}
												}
											?>
											>

											<label for="opt-e_<?php echo $no;?>" class="label-opt"> 

												<span class="opt-id"><p>E</p></span> <span class="opt"><?php echo $item->jawab_5 ? html_entity_decode($item->jawab_5) : ''?></span>

											</label>
											<?php
											}
											?>


											<div class="row" >

												<div class="col-md-12">

													<span class="btn btn-info next_soal hidden" id="next_soal_<?php echo $no;?>" >Selanjutnya <i class="glyphicon glyphicon-chevron-right"></i></span>

													
												</div>

											</div>



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
								if(isset($sudah_dijawab[$page->id_banksoal])){
							?>
								<li class="benar">
								<a data-toggle="tab" href="#item_soal_<?php echo $no;?>" id="toggle_item_soal_<?php echo $no;?>" style="background-color: green;">
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

	

    <!-- NEEDED FOR SHAKA PLAYER -->

    <!-- Menu Toggle Script -->

		<script>

		$("#menu-toggle").click(function(e) {

			e.preventDefault();

			$("#wrapper").toggleClass("toggled");

		});

		</script>

		

		<script>

	    if ( supports_media_source() ) {

        supported.style.display="";

        videoObj.style.display="";

	    }

	    else {

        notsupported.style.display="";

	    }

			var video;

			var player;

			var source; 

			var estimator;



	    function connect(data = null)

	    {

        if(connectObj.textContent == "Stop") 

				{

					dashStop();

					connectObj.textContent = "Start";

					statusStr.textContent = "Disconnected";

      	}

        else 

        {

        	

	        connectObj.textContent = "Stop";

	        statusStr.textContent = "Playing";

	        

	        if ( video == null )

	        { video = document.querySelector("video"); }



	        if ( player == null )

	        { player = new shaka.player.Player(video); }



	        // Attach the player to the window so that it can be easily debugged.

	        window.player = player;



	        // Listen for errors from the Player.

	        player.addEventListener('error', failed );



	        // Construct a DashVideoSource to represent the DASH manifest.

	        //var mpdUrl = 'http://turtle-tube.appspot.com/t/t2/dash.mpd';

	        if ( estimator != null ) { estimator=null; }

	          estimator = new shaka.util.EWMABandwidthEstimator();



	        if ( source != null )

	        { source = null; }



	      	if (data !== null)

        	{

		        // source = new shaka.player.DashVideoSource("<?php //echo $data->video_materi ? $data->video_materi : '';?>", null, estimator);

		        // source = new shaka.player.DashVideoSource("http://45.64.97.197:1935/TestVOD/mp4:soal16.mp4/manifest.mpd", null, estimator);

		        source = new shaka.player.DashVideoSource(data, null, estimator);



		        // Load the source into the Player.

		        player.load(source);

		      }

    		}

	    }



			function failed(e)

			{

				var done = false;

				if ( e.detail == 'Error: Network failure.' )

				{

					statusStr.textContent = 'Network Connection Failed.';

					done = true;

				}

				

				if ( e.detail.status!=200 && done == false )

        {

					switch ( e.detail.status )

					{

					case 404:

						statusStr.textContent = e.detail.url+' not found.';

					break;

					

					default:

	          statusStr.textContent = 'Error '+e.detail.status+' for '+e.detail.url;

					break;

        	}

				}

			}



			function dashStop()

			{

				if(player!=null)

				{

					player.unload();

				}

				connectObj.textContent = "Start";

				statusStr.textContent = "Disconnected";

			}



    </script>

    <!-- /NEEDED FOR SHAKA PLAYER -->





    <script type="text/javascript">

    	$(document).ready(function(){

    		//set default selected soal

    		$("#toggle_soal li a")[0].click();

    	

    		$("input.pilihan_jawaban").click(function(e){

    			console.log(e.target.value);

    		});



    		$('.next_soal').click(function(){

    			var next = $('#toggle_soal > .active').next('li').find('a');

    			if(next.length > 0) {

    				next.trigger('click');

    			}

    			else {

    				// $('#form_soal').submit();

    				$('#submit_form_soal').click();

    				console.log('form_soal submitted');

    			}



    		});



    		$("a.modal-pembahasan").click(function(e){

    			e.preventDefault();

    			var target = $(e.currentTarget),

          action = target.data('action');

          //call ajax function to send value to server

          ajaxFetchPembahasan(action);

          

          console.log(action);

    		});



    	});

    </script>



    <script type="text/javascript">

    	$(document).ready(function(){

    		//set default selected soal

    		$("#toggle_soal li a")[0].click();

    	

    		$("input.pilihan_jawaban").click(function(e){

    			var action = e.target.value || null;

    			var id_opt = e.target.id || null;

  				var disableRadio = (e.target.name);
  				//disabling other button

  				//$(this).siblings('input[name='+ disableRadio +']').prop('disabled', true);

  				$(this).siblings('input[name='+ disableRadio +']').addClass('disabled');



  				//call ajax method to verify answer

    			if(action !== null) {

    				ajaxCheckJawaban(action, id_opt);

    			}

    			console.log(action, id_opt);

    		});



    		$("a.modal-pembahasan").click(function(e){

    			e.preventDefault();

    			

    			var target = $(e.currentTarget),

          action = target.data('action') || null;

          //call ajax function to send value to server

          if(action !== null){

          	ajaxFetchPembahasan(action);

          }

          console.log(action);

    		});



    		$('#pembahasanVideoModal').on('shown.bs.modal', function () {

					// var video = $("#videoObj");

					// video.paused ? video.get(0).play() : video.get(0).pause();

    			// connect();

					// $("#videoObj").get(0).play();

				})



				$('#pembahasanVideoModal').on('hidden.bs.modal', function () {

					// var video = $("#videoObj");

					// video.paused ? video.get(0).play() : video.get(0).pause();

					$("#videoObj").get(0).pause();

    			// connect();

				})



				$('#changeSource').click(function (e){

    			source = new shaka.player.DashVideoSource("http://45.64.97.197:1935/TestVOD/mp4:sample.mp4/manifest.mpd", null, estimator);

	        // Load the source into the Player.

	        player.load(source);

				});



				$('#pauseVideo').click(function (e){

					// var vid = document.getElementById("videoObj"); 

					// vid.pause();

					$("#videoObj").get(0).pause();

				});



				$('#playVideo').click(function (e){

					$("#videoObj").get(0).play();

				});



    	});

    </script>



    <script type="text/javascript">

    	function ajaxCheckJawaban(action, id_opt)

    	{
    		var value = action.split('-');
    		var id_opt = id_opt.split('_');
			
			
			$("#next_soal_" + id_opt[1]).removeClass('hidden');   		
			$("#pembahasan" + id_opt[1]).removeClass('hidden');   

				$.post("<?=base_url('tryout/ajax_check_jawaban');?>",

				{

					id: value[0], jawaban: value[1], waktu: document.getElementById("stopwatch").innerHTML

				},

				function(data, status){

    			console.log('\nid: '+value[0]+ ', jawaban: '+value[1]);
				console.log("StatusCheckJawaban: " + status + "\nDATA: " + data);
				$("#toggle_item_soal_" + id_opt[1]).parent('li').addClass('benar');
				$("#toggle_item_soal_" + id_opt[1]).html("<i class='glyphicon glyphicon-ok'></i>"); 
				$("#toggle_item_soal_" + id_opt[1]).css("background-color", "green"); 

					if(data == "benar")
					{
						var skor = $("#textSkor").val() || 0;
						skor = parseInt(skor, 10);
						$("#textSkor").val(skor+=1);  		
					}else if(data == "benarselesai"){
						var skor = $("#textSkor").val() || 0;
						skor = parseInt(skor, 10);
						$("#textSkor").val(skor+=1);
	
						$('.next_soal').html("Selesai <i class='glyphicon glyphicon-chevron-right'></i>");
					}else if(data == "salahselesai"){
						$('.next_soal').html("Selesai <i class='glyphicon glyphicon-chevron-right'></i>");
					}

      	});	    		

    	}

    </script>



    <script type="text/javascript">

    	function ajaxFetchPembahasan(action)

    	{

    		var value = action.split('-');

    		$.post("<?=base_url('tryout/ajax_fetch_pembahasan');?>",

    		{

    			id: value[0], tipe: value[1]

    		},

    		function(data, status){

    			console.log('\nid: '+value[0]+ ', tipe: '+value[1]);

          console.log("\nStatusFetchPembahasan: " + status + "\nDATA: " + data);



          if(value[1] == 'teks')

          {

          	$('#konten_pembahasan_teks').html(data);

          }

          else if(value[1] == 'video')

          {

						connect(data);

          }

      	});

    	}

    </script>

<script src="https://www.gstatic.com/firebasejs/4.9.0/firebase.js"></script>
<script>
// Initialize Firebase
var config = {
  apiKey: "AIzaSyCy6BjwXzz92ob2uzaq9PauFN03kKmAbqM",
  authDomain: "prime-mobile-fc14d.firebaseapp.com",
  databaseURL: "https://prime-mobile-fc14d.firebaseio.com",
  projectId: "prime-mobile-fc14d",
  storageBucket: "prime-mobile-fc14d.appspot.com",
  messagingSenderId: "787216888776"
};
firebase.initializeApp(config);


</script>

<?php

if(isset($elapsed_time)){
	$waktu = ($durasi->durasi) - $elapsed_time->elapsed_time;
	$timer = $waktu * 60000;
}else{
	$waktu = $durasi->durasi;
	$timer = $waktu * 60000;
}
?>

<script>



function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);
}

window.onload = function () {
	var firebaseElapsed = firebase.database().ref().child('elapsed_time/siswa_' + <?php echo $this->session->userdata("id_siswa");?> + '/' + <?php echo $infotryout->id_kategori ;?> + '/elapsed_time');

	firebaseElapsed.once('value', function(datasnapshot){
		console.log(datasnapshot);
		if(datasnapshot.val() === null){
			var firebaseRef   = firebase.database().ref();
			firebaseRef.child('elapsed_time/siswa_' + <?php echo $this->session->userdata("id_siswa");?> + '/' + <?php echo $infotryout->id_kategori ;?> + '/elapsed_time').set(0);
			var elapsed 	= 0;
			var durasi 		= parseInt(<?php echo $durasi->durasi;?>);
			var penghitung 	= parseInt(durasi * 1000);
		}else{
			//$("#heading").html(datasnapshot.val());
			var elapsed 	= parseInt(datasnapshot.val());
			var durasi 		= parseInt(<?php echo $durasi->durasi;?>) - parseInt(datasnapshot.val());
			var penghitung 	= parseInt(durasi * 1000);
		}
		var fiveMinutes = durasi,
	    display = document.querySelector('#time');
	    startTimer(fiveMinutes, display);
		
		setInterval(function () {document.getElementById("submit_form_soal_force").click();}, penghitung);
		
		//COUNT UUUUUUUUUUP
		var timerVar = setInterval(countTimer, 1000);

		if(elapsed > 0){
			var totalSeconds = (elapsed * 60) - 1;
		}else{
			var totalSeconds = -1;
		}
		<?php
		/*
		if(isset($elapsed_time)){
			$countdetik = (round($elapsed_time->elapsed_time) * 60)-1;
			echo "var totalSeconds = ".$countdetik.";";
		}else{
			echo "var totalSeconds = -1;";
		}
		*/
		?>

		function countTimer() {
		++totalSeconds;
		var hour = Math.floor(totalSeconds /3600);
		var minute = Math.floor((totalSeconds - hour*3600)/60);
		var seconds = totalSeconds - (hour*3600 + minute*60);

		var firebaseElapsed = firebase.database().ref().child('elapsed_time/siswa_' + <?php echo $this->session->userdata("id_siswa");?> + '/' + <?php echo $infotryout->id_kategori ;?> + '/elapsed_time');
		firebaseElapsed.once('value', function(datasnapshot){
			console.log(datasnapshot);
			if(datasnapshot.val() === null){
				var firebaseRef   = firebase.database().ref();
				firebaseRef.child('elapsed_time/siswa_' + <?php echo $this->session->userdata("id_siswa");?> + '/' + <?php echo $infotryout->id_kategori ;?> + '/elapsed_time').set(0);
			}else{
				elapsed = parseInt(datasnapshot.val()) + 1;
				var firebaseRef   = firebase.database().ref();
				firebaseRef.child('elapsed_time/siswa_' + <?php echo $this->session->userdata("id_siswa");?> + '/' + <?php echo $infotryout->id_kategori ;?> + '/elapsed_time').set(elapsed);
				//$("#heading").html(datasnapshot.val());
			}
		})

		document.getElementById("stopwatch").innerHTML = hour + ":" + minute + ":" + seconds;
		}
		// END COUNT UUUUUUUUUUP
	})
};
</script>

<?php
$no = 1; 

foreach ($data_soal as $item){
?>
<div class="modal fade" id="myModal<?php echo $no;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Pembahasan</h4>
      </div>
      <div class="modal-body">
        <video class="img-responsive" id="video2" x-webkit-airplay="allow" controls alt="Example File" src="<?php echo base_url('assets/uploads/'.$item->pembahasan_video);?>"></video>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<?php
$no++;
}
?>

<?php
foreach($data_soal as $item){
?>
<div class="modal fade" id="myModal<?php echo $no;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Pembahasan</h4>
      </div>
      <div class="modal-body">
        <?php echo $item->pembahasan_teks; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<?php
$no++;
}
?>

<script>
	$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");
		setInterval(function () {
			$(function(){
				//$("#simpanwaktu").load("../simpanwaktu/");
			});
		}, 1000);
	});
</script>

	</body>

</html>
