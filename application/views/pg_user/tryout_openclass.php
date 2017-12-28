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
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

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

		<div class="header">

			<!-- Navbar  -->

			<?php include('header_latihan.php'); ?>

		</div>

		<!-- /Header -->



    <?php include "modal_pembahasan_tryout.php"; ?>

		

		<!-- Page Body -->

		<div class="page-body latihan-soal">

			<div class="soal-header">

					<h2>Try Out - Open Class</h2>
					<div class="keterangan-wrapper">
					<ul class="keterangan">
						<li>&nbsp;</li>
						<li>&nbsp;</li>
					</ul></div>
			</div>

			


				<div class="wrapper-soal">

					<div class="container">

						<form id="form_soal" method="post" action="<?php echo base_url('tryout/penilaian_openclass')?>">

							<div class="tab-content">

							<?php

							$no = 1; 
							foreach($soalsalah as $salah){
								foreach($soalopen as $item){
									if($salah->topik_salah == $item->topik){
							?>
								
								
								
								<div id="item_soal_<?php echo $no;?>" class="tab-pane fade">

									<div class="row equal-row item-soal">

										<div class="col-sm-4 equal-col soal">
											<h5><span class="glyphicon glyphicon-menu-hamburger"></span>Pilih jawabanmu</h5>
												<?php echo $item->pertanyaan ? html_entity_decode($item->pertanyaan) : '';?>

										</div>

										<div class="col-sm-8 equal-col jawaban">

											<input type="radio" class="pilihan_jawaban" name="pilihan_jawaban<?php echo $no;?>" id="opt-a_<?php echo $no;?>" value="<?php echo $item->id_banksoal; ?>-1">

											<label for="opt-a_<?php echo $no;?>" class="label-opt"> 

												<span class="opt-id"><p>A</p></span> 

												<span class="opt"><?php echo $item->jawab_1 ? html_entity_decode($item->jawab_1) : ''?></span>

											</label>



											<input type="radio" class="pilihan_jawaban" name="pilihan_jawaban<?php echo $no;?>" id="opt-b_<?php echo $no;?>" value="<?php echo $item->id_banksoal; ?>-2">

											<label for="opt-b_<?php echo $no;?>" class="label-opt"> 

												<span class="opt-id"><p>B</p></span> <span class="opt"><?php echo $item->jawab_2 ? html_entity_decode($item->jawab_2) : ''?></span> 

											</label>

											

											<input type="radio" class="pilihan_jawaban" name="pilihan_jawaban<?php echo $no;?>" id="opt-c_<?php echo $no;?>" value="<?php echo $item->id_banksoal; ?>-3">

											<label for="opt-c_<?php echo $no;?>" class="label-opt"> 

												<span class="opt-id"><p>C</p></span> <span class="opt"><?php echo $item->jawab_3 ? html_entity_decode($item->jawab_3) : ''?></span>

											</label>



											<input type="radio" class="pilihan_jawaban" name="pilihan_jawaban<?php echo $no;?>" id="opt-d_<?php echo $no;?>" value="<?php echo $item->id_banksoal; ?>-4">

											<label for="opt-d_<?php echo $no;?>" class="label-opt"> 

												<span class="opt-id"><p>D</p></span> <span class="opt"><?php echo $item->jawab_4 ? html_entity_decode($item->jawab_4) : ''?></span>

											</label>



											<?php if($item->jawab_5 !== ""){
											?>
											<input type="radio" class="pilihan_jawaban" name="pilihan_jawaban<?php echo $no;?>" id="opt-e_<?php echo $no;?>" value="<?php echo $item->id_banksoal; ?>-5">

											<label for="opt-e_<?php echo $no;?>" class="label-opt"> 

												<span class="opt-id"><p>E</p></span> <span class="opt"><?php echo $item->jawab_5 ? html_entity_decode($item->jawab_5) : ''?></span>

											</label>
											<?php
											}
											?>



											<div class="row" >

												<div class="col-md-12">
													<input id="urlvideo-<?php echo $no;?>" type="hidden" value="<?php echo $item->pembahasan_video;?>" />
													<span class="btn btn-info next_soal hidden" id="next_soal_<?php echo $no;?>" >Selanjutnya <i class="glyphicon glyphicon-chevron-right"></i></span>

													<?php
													if($item->pembahasan_video !== ""){
													?>
													<a class="btn btn-info hidden" id="pembahasan-<?php echo $no;?>" data-toggle="modal" data-target="#pembahasanVideoModal">Pembahasan Video<i class="glyphicon glyphicon-chevron-right"></i></a>
													<?php
													}
													?>
													<?php
													if($item->pembahasan_teks !== ""){
													?>
													<a class="btn btn-info hidden" id="pembahasan_teks<?php echo $no;?>" data-toggle="modal" data-target="#bahasteks<?php echo $no;?>">Pembahasan Teks<i class="glyphicon glyphicon-chevron-right"></i></a>
													<?php
													}
													?>
												</div>

											</div>



										</div>

									</div>

								</div>
								
								
							<?php
									
									}
								}
								$no++; 
							}
							
							?>

							</div>
						
							<div class="row">

								<input type="hidden" placeholder="skor" id="textSkor" name="skor" value="0"/>
								
								<button style="display:none;" type="submit" name="submit_form_soal" id="submit_form_soal" value="submit">SUBMIT</button>

							</div>

						</form>



					</div>

				</div>

				

				<div class="container">

					<div class="soal-pagination">

						<nav class="text-center">

						  <ul id="toggle_soal" class="pagination custom-pagination">

						    <?php 

						    $no = 1;

						    foreach ($soalsalah as $page) 

						    { ?>

						    	<li><a data-toggle="tab" href="#item_soal_<?php echo $no;?>" id="toggle_item_soal_<?php echo $no;?>"><?php echo $no;?></a></li>

						    <?php $no++; 

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

        //supported.style.display="";

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
		for(i=1; i <= 100; i++){
			$("#pembahasan-"+i).click(function(){
				shaka.polyfill.installAll();
				
				var thisId = this.id;
				var splitId = thisId.split("-");
				var alamatvideo = splitId[1];
				var video = document.getElementById('bahasvideo');
				var player = new shaka.player.Player(video);
				window.player = player;
				player.addEventListener('error', function(event) {
				  console.error(event);
				  });
				alamat = document.getElementById("urlvideo-"+alamatvideo).value;
				var mpdUrl = alamat;
				var estimator = new shaka.util.EWMABandwidthEstimator();
				var source = new shaka.player.DashVideoSource(mpdUrl, null, estimator);

				player.load(source);
			});
		}	
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

  				$(this).siblings('input[name='+ disableRadio +']').prop('disabled', true);

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

					$("#bahasvideo").get(0).pause();

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

					$("#bahasvideo").get(0).pause();

				});



				$('#playVideo').click(function (e){

					$("#bahasvideo").get(0).play();

				});



    	});

    </script>



    <script type="text/javascript">

    	function ajaxCheckJawaban(action, id_opt)

    	{

    		var value = action.split('-');

    		var id_opt = id_opt.split('_');



				$.post("<?=base_url('tryout/ajax_jawaban_open_class');?>",

				{

					id: value[0], jawaban: value[1]

				},

				function(data, status){

    			console.log('\nid: '+value[0]+ ', jawaban: '+value[1]);

          console.log("StatusCheckJawaban: " + status + "\nDATA: " + data);



					$("#next_soal_" + id_opt[1]).removeClass('hidden');   		
					$("#pembahasan-" + id_opt[1]).removeClass('hidden');   		
					$("#pembahasan_teks" + id_opt[1]).removeClass('hidden');  
					

					if(data == "benar")
					{

						var skor = $("#textSkor").val() || 0;

						skor = parseInt(skor, 10);

						$("#textSkor").val(skor+=1);

						$("#toggle_item_soal_" + id_opt[1]).parent('li').addClass('benar');   		

						$("#toggle_item_soal_" + id_opt[1]).html("<i class='glyphicon glyphicon-ok'></i>");   		

					}

					else if(data == "salah")

					{

						$("#toggle_item_soal_" + id_opt[1]).parent('li').addClass('salah');   		

						$("#toggle_item_soal_" + id_opt[1]).html("<i class='glyphicon glyphicon-remove'></i>");   		

					}else if(data == "benarselesai"){
						var skor = $("#textSkor").val() || 0;

						skor = parseInt(skor, 10);

						$("#textSkor").val(skor+=1);

						$("#toggle_item_soal_" + id_opt[1]).parent('li').addClass('benar');   		

						$("#toggle_item_soal_" + id_opt[1]).html("<i class='glyphicon glyphicon-ok'></i>");
						
						$('.next_soal').html("Selesai <i class='glyphicon glyphicon-chevron-right'></i>");
					}else if(data == "salahselesai"){
						$("#toggle_item_soal_" + id_opt[1]).parent('li').addClass('salah');   		

						$("#toggle_item_soal_" + id_opt[1]).html("<i class='glyphicon glyphicon-remove'></i>");
						
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
<?php
$no = 1; 
foreach($soalsalah as $salah){
	foreach($soalopen as $item){
		if($salah->topik_salah == $item->topik){
?>
<div id="bahasteks<?php echo $no;?>" class='modal fade modal-center' role="dialog" tab-index='-1' aria-hidden='true' aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success">        
        <div class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </div>
        <h4 class="modal-title" id="pembahasan_label"><i class="glyphicon glyphicon-info-sign text-success"></i> Pembahasan (Teks)</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div id="konten_pembahasan_teks">
            <?php echo $item->pembahasan_teks; ?>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <a class="btn btn-default" data-dismiss="modal">Tutup</a>
      </div>
    </div>
  </div>
</div>
<?php
		}
	}
$no++;
}
?>

	</body>

</html>