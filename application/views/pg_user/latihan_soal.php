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
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom-2.css?v=1.1');?>">
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/main.css');?>">
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/edit.css');?>">
<!--	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/jPaginator.css');?>">-->
		
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/owlcarousel/owl.carousel.css');?>">
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/owlcarousel/owl.theme.css');?>">
        
    	<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/login_aktif.js');?>"></script>
	<!--JW PLAYER-->
	<!--
    	<script src="https://content.jwplatform.com/libraries/mH6Uk56U.js"></script>
    	
    	
    	<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/jwplayer/jwplayer.js');?>"></script>
	<script>jwplayer.key="Ic3NNMq+3taBJdInK8pP5X/S6a0EOedsDvHeRA==";</script>
	-->
	
	<script src="//content.jwplatform.com/libraries/DbXZPMBQ.js"></script>
	<script src="https://developer.jwplayer.com/js/developer.js"></script>
    	
    	
        <!-- Modernizr -->
        <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/modernizr.custom.js');?>"></script>
        
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
			<style>
			    .video{
			        padding-bottom: 0px;
			    }
			    .soalnav{
			        background: none;
			    }
			    @media(min-width: 768px){
			        .btn-bahas{
			            width: 100%;
			        }
			        .btn-bahas .modal-pembahasan {
			            width: 100%;
			            border-radius: 0px;
			        }
			    }
			</style>
	</head>
	<?php 
				if (isset($_SESSION['akses'])){
					if (count($_SESSION['akses']) > 0){
						if (isset($_SESSION['akses']['reguler'])){
							$paketaktif = $_SESSION['akses']['reguler'][0]; 
						} else if (isset($_SESSION['akses']['premium'])){
							$paketaktif = $_SESSION['akses']['premium'][0]; 
						}
					} else {
						$paketaktif = 0;
					}
				} else {
					$paketaktif = 0;
				}
				?>
	<body onload="JavaScript:connect();">
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
		<div class="page-body latihan-soal" style="background-color: #f2f2f2;">
			<div class="soal-header">
					<!-- <h2><?php echo $header->nama_sub_materi; ?></h2> -->
					<div class="keterangan-wrapper">
						<?php $jml_soal = count($data_soal); ?>
					<ul class="keterangan">
						<li><span class="circle-icon"></span>Soal <span id="soal_number">1</span> dari <b><?php echo $jml_soal?></b></li>
						<li class="hidden">00:15</li>
						<li style="text-align: center;"><b><?php echo $header->nama_sub_materi; ?></b></li>
						<!--
						<li>
						Pembahasan : <button class="btn btn-text"><span class="glyphicon glyphicon-file"></span>Teks</button><button class="btn btn-video"><span class="glyphicon glyphicon-play-circle"></span>Video</button>
						</li>
						-->
					</ul></div>
			</div>
			
			<?php
  		if(($header->status_materi == 0) OR ($allow_akses == TRUE) || ($infolatihan->id_kelas == 38 && $paketaktif == 19) || ($infolatihan->id_kelas == 37 && $paketaktif == 20)|| ($infolatihan->id_kelas == 39 && $paketaktif == 6) || ($infolatihan->id_kelas == 42 && $paketaktif == 19) || ($infolatihan->id_kelas == 43 && $paketaktif == 20) || ($infolatihan->id_kelas == 41 && $paketaktif == 9) || ($infolatihan->id_kelas == 39 && $paketaktif == 6))
			{ ?>
				<div class="wrapper-soal">
					<div class="container soal-container">
						<form id="form_soal" method="post" action="<?php echo base_url('latihan/penilaian')?>">
							<div class="btn btn-success" id="playCorrect" style="display:none;">TRY Play</div>				
							<div class="btn btn-danger" id="playFalse" style="display:none;">TRY Play</div>				
							<div class="tab-content">
							<style>table {width:100% !important;} .soal > p > img {max-width:100% !important;}</style>
							<?php
							$no = 1; 
							foreach ($data_soal as $item)
							{ ?>
								<div id="item_soal_<?php echo $no;?>" class="tab-pane fade">
								    <div class="row equal-row item-soal">
										<div class="col-sm-4 equal-col soal">
												<?php echo $item->isi_soal ? html_entity_decode($item->isi_soal) : '';?>
												<hr>
												<br>
												<a class="kirim-komentar" id="komentar-<?php echo $item->id_soal;?>" role="button"  data-toggle="modal" data-target="#modal-komentar">
												<span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Komentar
												</a>
												<hr>
												<div class="btn-group btn-bahas hidden" id="bahas_<?php echo $no;?>">
												 <?php 
                                                if(!empty($item->pembahasan)) { ?> 
                                                <a data-toggle="modal" data-target="#pembahasanModal" class="modal-pembahasan btn btn-success btnbahasteks" data-action="<?php echo $item->id_soal;?>-teks"><span class="glyphicon glyphicon-file"></span> <span class="teks">Teks Pembahasan</span></a>
                                                <?php
                                                } 

                                                if(!empty($item->pembahasan_video)) { ?>
                                                <a data-toggle="modal" data-target="#pembahasanVideoModal" class="modal-pembahasan btn btn-warning btnbahasvid" data-action="<?php echo $item->id_soal;?>-video"><i class="glyphicon glyphicon-play-circle"></i> <span class="teks">Video Pembahasan</span></a>
                                                <?php 
                                                } 
                                                ?>
                                                </div>
										</div>
										<div class="col-sm-8 equal-col jawaban">
											<h5><span class="glyphicon glyphicon-menu-hamburger"></span>Pilih jawabanmu</h5>
											<input type="radio" class="pilihan_jawaban" name="pilihan_jawaban<?php echo $no;?>" id="opt-a_<?php echo $no;?>" value="<?php echo $item->id_soal; ?>-1">
											<label for="opt-a_<?php echo $no;?>" class="label-opt"> 
												<span class="opt-id"><p>A</p></span> 
												<span class="opt"><?php echo $item->jawab_1 ? html_entity_decode($item->jawab_1) : ''?></span>
											</label>

											<input type="radio" class="pilihan_jawaban" name="pilihan_jawaban<?php echo $no;?>" id="opt-b_<?php echo $no;?>" value="<?php echo $item->id_soal; ?>-2">
											<label for="opt-b_<?php echo $no;?>" class="label-opt"> 
												<span class="opt-id"><p>B</p></span> <span class="opt"><?php echo $item->jawab_2 ? html_entity_decode($item->jawab_2) : ''?></span> 
											</label>
											
											<input type="radio" class="pilihan_jawaban" name="pilihan_jawaban<?php echo $no;?>" id="opt-c_<?php echo $no;?>" value="<?php echo $item->id_soal; ?>-3">
											<label for="opt-c_<?php echo $no;?>" class="label-opt"> 
												<span class="opt-id"><p>C</p></span> <span class="opt"><?php echo $item->jawab_3 ? html_entity_decode($item->jawab_3) : ''?></span>
											</label>

											<input type="radio" class="pilihan_jawaban" name="pilihan_jawaban<?php echo $no;?>" id="opt-d_<?php echo $no;?>" value="<?php echo $item->id_soal; ?>-4">
											<label for="opt-d_<?php echo $no;?>" class="label-opt"> 
												<span class="opt-id"><p>D</p></span> <span class="opt"><?php echo $item->jawab_4 ? html_entity_decode($item->jawab_4) : ''?></span>
											</label>

											<?php if(!empty($item->jawab_5))
											{ ?>
											<input type="radio" class="pilihan_jawaban" name="pilihan_jawaban<?php echo $no;?>" id="opt-e_<?php echo $no;?>" value="<?php echo $item->id_soal; ?>-5">
											<label for="opt-e_<?php echo $no;?>" class="label-opt"> 
												<span class="opt-id"><p>E</p></span> <span class="opt"><?php echo $item->jawab_5 ? html_entity_decode($item->jawab_5) : ''?></span>
											</label>
											<?php 
											} ?>
                                            
                                            <div class="row btn-pembahasan">
                                                <div class="col-md-12">
                                                    <span class="btn btn-info next_soal hidden" id="next_soal_<?php echo $no;?>" >Selanjutnya <i class="glyphicon glyphicon-chevron-right"></i></span>

                                                    <div class="pull-right">
                                                    <?php 
                                                    //if(empty($item->pembahasan) && empty($item->pembahasan_video)) 
                                                        //{ echo "<span class='text-muted'><em>Pembahasan tidak tersedia</em></span>"; }
                                                    //else 
                                                        //{ echo "<h4>Pembahasan:</h4>"; } 
                                                    ?>
                                                        <div class="btn-group btn-bahas hidden" id="bahas_<?php echo $no;?>">
                                                            <?php 
                                                            if(!empty($item->pembahasan)) { ?> 
                                                            <a data-toggle="modal" data-target="#pembahasanModal" class="modal-pembahasan btn btn-success btnbahasteks" data-action="<?php echo $item->id_soal;?>-teks"><span class="glyphicon glyphicon-file"></span> <span class="teks">Teks</span></a>
                                                            <?php
                                                            } 

                                                            if(!empty($item->pembahasan_video)) { ?>
                                                            <a data-toggle="modal" data-target="#pembahasanVideoModal" class="modal-pembahasan btn btn-warning btnbahasvid" data-action="<?php echo $item->id_soal;?>-video"><i class="glyphicon glyphicon-play-circle"></i> <span class="teks">Video</span></a>
                                                            <?php 
                                                            } 
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
										</div>
									</div>
								</div>
							<?php
							$no++; 
							} ?>
							
                            <div class="modal fade show-answer" id="correct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog modal-correct" role="document">
                                <div class="modal-content correct-state">
                                  <div class="modal-body correct-top">
                                    <div class="correct-top">
                                      <img src="<?php echo base_url('assets/pg_user/images/icon/Test-Check.png')?>" width="127" height="126" alt="Icon Latihan Soal" class="img-responsive">
                                      <p class="answer-status">Jawaban Benar</p>
                                      <audio id="trueaudio">
                                        <source src="<?php echo base_url('assets/pg_user/sounds/correct.ogg')?>" type="audio/ogg">
                                        <source src="<?php echo base_url('assets/pg_user/sounds/correct.mp3')?>" type="audio/mpeg">
                                        <source src="<?php echo base_url('assets/pg_user/sounds/correct.m4a')?>" type="audio/mp4">
                                        <source src="<?php echo base_url('assets/pg_user/sounds/correct.wav')?>" type="audio/wav">
                                        Your browser does not support the audio element.
                                      </audio>
                                    </div>
                                    <div class="form-inline reward">
                                      <div class="form-group">
                                        <img src="<?php echo base_url('assets/pg_user/images/icon/Test-Coin.png')?>" width="127" height="126" alt="Icon Latihan Soal" class="img-responsive">
                                      </div>
                                      <div class="form-group">
                                        <p class="reward-value"><?php echo isset($poin) ? $poin : ''?></p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                            <div class="modal fade show-answer" id="wrong" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content wrong-state">
                                  <div class="modal-body">
                                    <img src="<?php echo base_url('assets/pg_user/images/icon/Test-Close.png')?>" width="127" height="126" alt="Icon Latihan Soal" class="img-responsive">
                                    <p class="answer-status">Jawaban Salah</p>
                                    <audio id="falseaudio">
                                        <source src="<?php echo base_url('assets/pg_user/sounds/false.ogg')?>" type="audio/ogg">
                                        <source src="<?php echo base_url('assets/pg_user/sounds/false.mp3')?>" type="audio/mpeg">
                                        <source src="<?php echo base_url('assets/pg_user/sounds/false.m4a')?>" type="audio/mp4">
                                        <source src="<?php echo base_url('assets/pg_user/sounds/false.wav')?>" type="audio/wav">
                                        Your browser does not support the audio element.
                                    </audio>
                                  </div>
                                </div>
                              </div>
                            </div>
							
							</div>
							<div class="row">
								<input type="hidden" placeholder="skor" id="textSkor" name="skor" value="0"/>
								<!-- <input type="hidden" placeholder="answer" id="textAnswer" name="answer" value=""/> -->
								<button style="display:none;" type="submit" name="submit_form_soal" id="submit_form_soal" value="submit">SUBMIT</button>
							</div>
						</form>

					</div>
				</div>
				
				<div class="soalnav">
                    <div class="container" style="background-color: rgba(255,255,255,0.6); border: 1px solid #a8a8a8; border-radius: 20px; margin-bottom: 20px;">
                       <div class="row">
                            <div id="pagination" class="soal-pagination">
                                <nav class="text-center pagination-wrapper">
                                  <div id="toggle_soal" class="pagination custom-pagination owl-carousel">
<!--                                        <li id="max_backward"></li>-->
<!--	                                    <li id="over_backward"></li>-->
                                    <!-- <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                      <span class="sr-only">Previous</span>
                                    </a> -->
                                    <?php 
                                    $no = 1;
                                    foreach ($data_soal as $page) { ?>
                                        
                                        <span><a class="tekan-page" data-toggle="tab" href="#item_soal_<?php echo $no;?>" id="toggle_item_soal_<?php echo $no;?>" data-nosoal="<?php echo $no;?>"><?php echo $no;?></a></span>
                                        <?php $no++; 
                                    } ?>
                                    <!-- <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                      <span class="sr-only">Next</span>
                                    </a> -->
<!--                                        <li id="over_forward"></li>-->
<!--                                        <li id="max_forward"></li>-->
                                  </div>
                                </nav>
                            </div>
                       </div>
                    </div>
				</div>
			<?php
			} 
			
			else 
			{ ?>
			<div class="wrapper-soal">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 text-center">
							<br>
			        <img src="<?php echo base_url('assets/pg_user/images/icon/paid-notif.png');?>" width="468" height="216" alt="Notifikasi Pembayaran" class="img-responsive">
			        <br>
			        <p>
			          Maaf... Konten ini khusus untuk premium member. Silahkan memilih paket dengan harga mulai Rp 150.000,-
			          <br>
			          Ingin menjadi premium member? silahkan daftar <a href="<?php echo base_url('signup'); ?>" class="link-login">disini</a>.
			        </p>
			      </div>
					</div>
		    </div>
		  </div>
			<?php
			} ?> 
		</div>

		<!-- /Page Body -->

		<!-- Footer -->
		<?php include('footer_latihan.php'); ?>
		<!-- /Footer -->
		
	  <!-- Javascript -->
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-scrolltofixed.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/owlcarousel/owl.carousel.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/login_aktif.js');?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.soalnav').scrollToFixed( {
                bottom: 0,
                limit: function() {
                    var limit = $('.footer').offset().top - $('.soalnav').outerHeight(true) - 10;
                    return limit;
                },
                removeOffsets: true 
            });
        });
    </script>    
    <script>
    	$(window).load(function() {
    		// Animate loader off screen
    		$(".se-pre-con").fadeOut("slow");
    	});
    </script>
    <script type="text/javascript">
	    $(document).ready(function() {
		  var owl = $("#toggle_soal");
		  owl.owlCarousel ({
		  	  afterAction: afterAction,
		  	  pagination: false,
		      items : 10, //10 items above 1000px browser width
		      itemsDesktop : [1000,8], //5 items between 1000px and 901px
		      itemsDesktopSmall : [900,5], // betweem 900px and 601px
		      itemsTablet: [600,5], //2 items between 600 and 0
		      itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
		  });

		  function afterAction(){
		  	$(".owl-item").find("a").unbind();

		    var length = this.owl.owlItems.length;
		    var visibles = this.owl.visibleItems;

		    var startIndex = visibles[0];
		    var lastIndex = visibles[visibles.length - 1];
		    var start = ((startIndex - visibles.length) < 0) ? 0 : (startIndex - visibles.length) ;
	    	var end = lastIndex;
		    
		    $(".owl-item").eq(startIndex).find("a").on("mouseup", function(e) {
		    	owl.trigger('owl.goTo', start, true);
		    });
		    $(".owl-item").eq(lastIndex).find("a").on("mouseup", function(e) {
		    	owl.trigger('owl.goTo', end, true);
		    });
		  }
		});
    </script>
    
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
    		$("#toggle_soal a")[0].click();
            
            /* ganti nomor soal gak fungsi ini
    		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
			  var target = $(this).attr("href"); // activated tab
			  var no = target.split('_');
			  //console.log(no[no.length-1]);
			  $("#soal_number").html(no[no.length-1]);
			});
            */
            //GANTI YANG INI AJA, BIAR SOAL KE YANG DI ATAS BISA GANTI
            $(".owl-wrapper").on("click", ".tekan-page", function(){
                idraw = $(this).attr("id");
                idsplit = idraw.split('_');
                $("#soal_number").html(idsplit[3]);
            })
            
    		$("[id*='item_soal_']").hasClass("active", function(e) {
    			console.log('AWAWAW' + e.target);
    		});
    	
    		$("input.pilihan_jawaban").click(function(e){
    			// console.log(e.target.value);
    		});

    		$('.next_soal').click(function(e){
    			var target = $(e.target).attr("id"); // activated tab
			  	var no = target.split('_');
			  	var index = parseInt(no[no.length-1]) + 1;
    			var next = $("#toggle_item_soal_"+index);
    			if(next.length > 0) {
    				next.trigger('click');
    			}
    			else {
    				$('#submit_form_soal').click();
    			}

    		});

    		$("a.modal-pembahasan").click(function(e){
    			e.preventDefault();
    			var target = $(e.currentTarget),
          action = target.data('action');
          //call ajax function to send value to server
          ajaxFetchPembahasan(action);
          
          // console.log(action);
    		});

    	});
    </script>

    <script type="text/javascript">
    	$(document).ready(function(){
    		var initSound = 0;
    		$(".pilihan_jawaban").on("click", function(){
            	if(initSound == 0) {
	            	var taudio = document.getElementById("trueaudio");
	            	var faudio = document.getElementById("falseaudio");
	            	faudio.volume = 0.0; taudio.volume = 0.0;
	            	faudio.play(); taudio.play();
	            	initSound = 1;
            	}
    		});
    		//set default selected soal
    		$("#toggle_soal a")[0].click();
    	
    		$("input.pilihan_jawaban").click(function(e){
    			var action = $(this).val() || null;
    			var id_opt = $(this).attr("id") || null;
  				var disableRadio = (e.target.name);
  				
  				//disabling other button
  				$(this).siblings('input[name='+ disableRadio +']').prop('disabled', true);
  				$(this).prop('disabled', true);
  				$(this).siblings('input[name='+ disableRadio +']').addClass('disabled');
                
  				//call ajax method to verify answer
  				//cek dulu apakah radio sudak tercek
    			if(action !== null) {
    				ajaxCheckJawaban(action, id_opt);
    			}
    			// console.log(action, id_opt);
    		});

    		$("a.modal-pembahasan").click(function(e){
    			e.preventDefault();
    			
    			var target = $(e.currentTarget),
          action = target.data('action') || null;
          //call ajax function to send value to server
          if(action !== null){
          	ajaxFetchPembahasan(action);
          }
          // console.log(action);
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
					//$("#videoObj").get(0).pause();
					$('#konten_pembahasan_video').html("");
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
    
    <!-- Sound Function for All Version Browser -->
    <script type="text/javascript">
           function Sound(source,volume,loop){
                this.source=source;
                this.volume=volume;
                this.loop=loop;
                var son;
                this.son=son;
                this.finish=false;
                this.stop=function()
                {
                    document.body.removeChild(this.son);
                }
                this.start=function()
                {
                    if(this.finish)return false;
                    this.son=document.createElement("embed");
                    this.son.setAttribute("src",this.source);
                    this.son.setAttribute("hidden","true");
                    this.son.setAttribute("volume",this.volume);
                    this.son.setAttribute("autostart","true");
                    this.son.setAttribute("loop",this.loop);
                    document.body.appendChild(this.son);
                }
                this.remove=function()
                {
                    document.body.removeChild(this.son);
                    this.finish=true;
                }
                this.init=function(volume,loop)
                {
                    this.finish=false;
                    this.volume=volume;
                    this.loop=loop;
                }
            }
       </script>
       
    <!-- Cek Jawaban -->
    <script type="text/javascript">
    	$("#playCorrect").on("click", function() {
            var taudio = document.getElementById("trueaudio");
            taudio.volume = 1.0;
            taudio.play();
    	});
    	$("#playFalse").on("click", function() {
            var faudio = document.getElementById("falseaudio");
            faudio.volume = 1.0;
            faudio.play();
    	});
    		
    	function ajaxCheckJawaban(action, id_opt)
    	{
    		var value   = action.split('-');
    		var id_opt  = id_opt.split('_');
			var skor    = $("#textSkor").val() || 0;

				$.post("<?=base_url('latihan/ajax_check_jawaban');?>",
				{
					id: value[0], jawaban: value[1]
				},
				function(data, status){
    			// console.log('\nid: '+value[0]+ ', jawaban: '+value[1]);
          // console.log("StatusCheckJawaban: " + status + "\nDATA: " + data);

					$("#next_soal_" + id_opt[1]).removeClass('hidden');   		
					$("#bahas_" + id_opt[1]).removeClass('hidden');   		
					
					if(data == "benar")
					{
						skor = parseInt(skor, 10);
						$("#textSkor").val(skor+=1);
                        $("#playCorrect").click();
                        
						$("#toggle_item_soal_" + id_opt[1]).parent('span').addClass('benar');   		
						$("#toggle_item_soal_" + id_opt[1]).html("<i class='glyphicon glyphicon-ok'></i>");
                        $('#correct').modal('show');
                        setTimeout(function(){
                            $('.correct-state').addClass('animated');
                            $('.correct-state').addClass('tada');
                        }, 500);
                        setTimeout(function(){
                            $('.correct-top').addClass('animated');
                            $('.correct-top').addClass('flash');
                            $('.reward').addClass('animated');
                            $('.reward').addClass('flash');
                        }, 1500);
                        setTimeout(function(){
                            $('#correct').modal('hide');
                        }, 2500);
					}
					else if(data == "salah")
					{
                        $("#playFalse").click();
                        
						$("#toggle_item_soal_" + id_opt[1]).parent('span').addClass('salah');   		
						$("#toggle_item_soal_" + id_opt[1]).html("<i class='glyphicon glyphicon-remove'></i>");   		
                        $('#wrong').modal('show');
                        setTimeout(function(){
                            $('.wrong-state').addClass('animated');
                            $('.wrong-state').addClass('shake');
                        }, 500);
                        setTimeout(function(){
                            $('#wrong').modal('hide');
                        }, 2500);
					}
      	});	    		
    	}
    </script>

    <script type="text/javascript">
    	function ajaxFetchPembahasan(action)
    	{
    		var value = action.split('-');
    		    //preloading
				if(value[1] == 'teks')
				{
					$('#konten_pembahasan_teks').html('<div style="text-align:center"><img src="<?php echo base_url('assets/img/preloading-1.gif') ?>"></div>');
				}
				else if(value[1] == 'video')
				{
					$('#konten_pembahasan_video').html('<div style="text-align:center"><img src="<?php echo base_url('assets/img/preloading-1.gif') ?>"></div>');
				}
					
    		$.post("<?=base_url('latihan/ajax_fetch_pembahasan');?>",
    		{
    			id: value[0], tipe: value[1]
    		},
    		function(data, status){
    			// console.log('\nid: '+value[0]+ ', tipe: '+value[1]);
          // console.log("\nStatusFetchPembahasan: " + status + "\nDATA: " + data);

          if(value[1] == 'teks')
          {
          	$('#konten_pembahasan_teks').html(data);
          }
          else if(value[1] == 'video')
          {
		$('#konten_pembahasan_video').html(data);
		//connect(data);
          }
      	});
    	}
    </script>
    
    <script type="text/javascript">
        $("ul.pagination li:nth-child(5n)").click(function(){
            
        });
    </script>
    
<!--    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jPaginator.js');?>"></script>-->
    <script type="text/javascript">
		// Initial call
		//$(document).ready(function(){
		     
		        /*
		    $("#pagination").jPaginator({ 
                nbPages:10,
		        nbVisible:10,
		        marginPx:3,
		        length:8,
                overBtnLeft:'#over_backward', 
		        overBtnRight:'#over_forward', 
		        maxBtnLeft:'#max_backward', 
		        maxBtnRight:'#max_forward'
                onPageClicked: function(a,num) { 
		            $("#page").html("Page "+num); 
		        }
		    });
                */
		     
		//});
		  
		</script>

<script type="text/javascript">
$(function(){
	$(".kirim-komentar").click(function(){
		rawid 	= $(this).attr("id");
		idsplit	= rawid.split("-");
		idsoal 	= idsplit[1];
		$("#konten-modal-komentar").load("../komentar/" + idsoal);
	})

	$(document).ajaxSend(function(event, jqxhr, settings){
		alamat 				= settings.url;
		alamatloadkomentar 	= alamat.substring(0,11);
		if(alamatloadkomentar === "../komentar"){
			$("#modal-loader").modal("show");
			$("#text-load").html("Memuat komentar");
		}
		if(settings.url === "../submit_komentar"){
			$("#modal-loader").modal("show");
			$("#text-load").html("Mengirim komentar");
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		alamat 				= options.url;
		alamatloadkomentar 	= alamat.substring(0,11);
		if(alamatloadkomentar === "../komentar"){
			$("#modal-loader").modal("hide");
		}
		if(options.url === "../submit_komentar"){
			$("#modal-loader").modal("hide");
			$("#modal-komentar").modal("hide");
		}
	});
	$(document).ajaxError(function(event, request, options){
		alamat 				= options.url;
		alamatloadkomentar 	= alamat.substring(0,11);
		if(alamatloadkomentar === "../komentar"){
			$("#modal-loader").modal("hide");
			$("#modal-komentar").modal("hide");
			$("#modal-error").modal("show");
		}
		if(options.url === "../submit_komentar"){
			$("#modal-loader").modal("hide");
			$("#modal-error").modal("show");
		}

	});

	$('#modal-loader').on('hidden.bs.modal', function () {
	  $("body").css("padding-right", "0px;");
	})
	$('#modal-komentar').on('hidden.bs.modal', function () {
	  $("body").css("padding-right", "0px;");
	})
})
</script>
	</body>
</html>