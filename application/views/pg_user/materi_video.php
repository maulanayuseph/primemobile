<?php //echo $data->video_materi ? $data->video_materi : '';?>
<!DOCTYPE html>
<html lang="en">
	<head>    
		<title>Prime Mobile - Cara Belajar Masa Kini</title>
		
		<!-- Meta Tags -->
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- Icon -->
		<link rel="icon" href="<?php echo base_url('assets/dashboard/images/icon-red.png');?>">
		<link rel="icon" sizes="130x128" href="<?php echo base_url('assets/dashboard/images/icon-red.png');?>" >
		<link rel="apple-touch-icon" sizes="130x128" href="<?php echo base_url('assets/dashboard/images/icon-red.png');?>" >
		
		<!-- Stylesheets -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/bootstrap.css');?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/main.css');?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom.css');?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom-3.css');?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/simple-sidebar.css');?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/edit.css');?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/style.css');?>">
		
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
	<body onload="JavaScript:connect()">
		<header class="header">
			<!-- nav bar -->
				 <?php include('header.php'); ?>
				<div class="mapel-header" style="margin-top: 60px;">
            <h2 class="mapel-title"><?php echo $header->nama_mapel." ".$header->alias_kelas ?></h2>
        </div>
		</header>
			<!-- apa kata -->
		
    	<div class="desc-content">
			<?php include('modal_akses_materi.php'); ?>
		</div>

		<div class="mapel-subs">
			<div class="subs-right mapel-rightbar">
			    <div class="content-rightbar">
                    <div id="listbar" class="subs-konten desc-content">
                    	<div class="subject-title">
			                <span class="arrow-prev"><span class="arrow"></span></span>
			                <h5>MATEMATIKA</h5>
			                <h4><?php echo $data->nama_sub_materi?></h4>
			             </div>
                        
				          <ul>
				          <?php
				            foreach ($sidebar as $konten_lain) 
				            { ?>
				            <li>
				              <span class="materi-sep"></span>
				              <?php
				              switch($konten_lain->kategori)
				              {
				                case 1 : 
				                	if(($konten_lain->status_materi == 0) OR ($allow_akses == TRUE))
				            				{ echo "<a href=".base_url('materi/konten_teks/'.$konten_lain->id_konten)." id='link_teks-".$konten_lain->id_konten."'>"; }
				            			else
				            				{ echo '<a href="#" data-toggle="modal" data-target="#myModal">'; }
				                	echo "<span class='icon-teks'></span> "; 	
				                  break;
				                case 2 : 
				                	if(($konten_lain->status_materi == 0) OR ($allow_akses == TRUE))
				                		{ echo "<a href=".base_url('materi/konten_video/'.$konten_lain->id_konten)." id='link_video-".$konten_lain->id_konten."'>"; }
				                	else 
				            				{ echo '<a href="#" data-toggle="modal" data-target="#myModal">'; }
				                	echo "<span class='icon-video'></span> ";
				                 	break;
				                case 3 : 
				                	if(($konten_lain->status_materi == 0) OR ($allow_akses == TRUE))
				                		{ echo "<a href=".base_url('latihan/index/'.$konten_lain->sub_materi_id).">"; }
				                	else
				            				{ echo '<a href="#" data-toggle="modal" data-target="#myModal">'; }
				              		echo "<span class='icon-tugas'></span> ";
				                 	break;
				                default : echo "Materi Teks";
				                  break;
				              }
				              echo $konten_lain->nama_sub_materi ?>
				              </a>
				            </li>
				            <?php } ?>
				          </ul>
          
					      <?php if($next) 
					      { ?>
					      <a href="<?php echo base_url('materi/tabel_konten_detail/'.$next->id_materi_pokok)?>" class="btn btn-default next-konten">
			                <h6>Bab Selanjutnya</h6>
			                <p><?php echo $next->nama_materi_pokok?></p>
			                <span class="arrow-next"><span class="arrow"></span></span></a>
					      <?php 
					      } ?>

				    </div>
			    </div>           
            </div>

            <div class="subs-left video">
				<!-- <h3 class="center-title" id="judul_materi"><?php echo $data->nama_sub_materi?></h3> -->
				<?php 
		        if(($data->status_materi == 0) OR ($allow_akses == TRUE))
		        { ?>
							<div class="embed-responsive embed-responsive-16by9">
								<div id="player"></div>
								<video id="videoObj" x-webkit-airplay="allow" controls alt="Example File" width="630" height="354" autoplay></video>
								<p>
								<input style="display: none;" id="connectStr" size = "56" type="text" placeholder="" value="http://localhost:1935/vod/mp4:test123.mp4/manifest.mpd"/>
								<button style="display: none;" id="connectObj" type="button" style="width:80px" onclick="JavaScript:connect()">Start</button>
								<label style="display: block;" id="statusStr" size = "100" type="text" placeholder="" value="">Disconnected</label>
							</div>
						<?php
		        } 

		        else 
		        { ?>
		          <div id="isi_materi" class="text-center">
		            <img src="<?php echo base_url('assets/pg_user/images/icon/paid-notif.png');?>" width="468" height="216" alt="Notifikasi Pembayaran" class="img-responsive">
		            <br>
		            <p>
		              Maaf... Konten ini khusus untuk premium member. Silahkan memilih paket dengan harga mulai Rp 124.000,-
		              <br>
		              Ingin menjadi premium member? silahkan daftar <a href="user_beli_notlog.html" class="link-login">disini</a>.
		            </p>
		          </div>
		        <?php
		        } ?>
			
				<div class="content-video">
					<h4><?php echo $data->nama_sub_materi?></h4>
					<p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel 
					velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit 
					consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet 
					nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec 
					tellus a odio tincidunt auctor a ornare odio. </p>
				</div>
			</div>
		</div>


		<!-- <div class="mapel-subs">
			<div class="subs-left">
				<h3 class="center-title" id="judul_materi"><?php echo $data->nama_sub_materi?></h3>
				<?php 
        if(($data->status_materi == 0) OR ($allow_akses == TRUE))
        { ?>
					<div class="embed-responsive embed-responsive-16by9">
						<div id="player"></div>
						<video id="videoObj" x-webkit-airplay="allow" controls alt="Example File" width="630" height="354" autoplay></video>
						<p>
						<input style="display: none;" id="connectStr" size = "56" type="text" placeholder="" value="http://localhost:1935/vod/mp4:test123.mp4/manifest.mpd"/>
						<button style="display: none;" id="connectObj" type="button" style="width:80px" onclick="JavaScript:connect()">Start</button>
						<label style="display: block;" id="statusStr" size = "100" type="text" placeholder="" value="">Disconnected</label>
					</div>
				<?php
        } 

        else 
        { ?>
          <div id="isi_materi" class="text-center">
            <img src="<?php echo base_url('assets/pg_user/images/icon/paid-notif.png');?>" width="468" height="216" alt="Notifikasi Pembayaran" class="img-responsive">
            <br>
            <p>
              Maaf... Konten ini khusus untuk premium member. Silahkan memilih paket dengan harga mulai Rp 124.000,-
              <br>
              Ingin menjadi premium member? silahkan daftar <a href="user_beli_notlog.html" class="link-login">disini</a>.
            </p>
          </div>
        <?php
        } ?>
			
			</div>

			<div class="subs-right mapel-rightbar">
			    <div class="content-rightbar">
                    <div id="listbar" class="subs-konten desc-content">
                        <h4><?php echo $data->nama_sub_materi?></h4>
          <ul>
          <?php
            foreach ($sidebar as $konten_lain) 
            { ?>
            <li>
              <span class="materi-sep"></span>
              <?php
              switch($konten_lain->kategori)
              {
                case 1 : 
                	if(($konten_lain->status_materi == 0) OR ($allow_akses == TRUE))
            				{ echo "<a href=".base_url('materi/konten_teks/'.$konten_lain->id_konten)." id='link_teks-".$konten_lain->id_konten."'>"; }
            			else
            				{ echo '<a href="#" data-toggle="modal" data-target="#myModal">'; }
                	echo "<span class='icon-teks'></span> "; 	
                  break;
                case 2 : 
                	if(($konten_lain->status_materi == 0) OR ($allow_akses == TRUE))
                		{ echo "<a href=".base_url('materi/konten_video/'.$konten_lain->id_konten)." id='link_video-".$konten_lain->id_konten."'>"; }
                	else 
            				{ echo '<a href="#" data-toggle="modal" data-target="#myModal">'; }
                	echo "<span class='icon-video'></span> ";
                 	break;
                case 3 : 
                	if(($konten_lain->status_materi == 0) OR ($allow_akses == TRUE))
                		{ echo "<a href=".base_url('latihan/index/'.$konten_lain->sub_materi_id).">"; }
                	else
            				{ echo '<a href="#" data-toggle="modal" data-target="#myModal">'; }
              		echo "<span class='icon-tugas'></span> ";
                 	break;
                default : echo "Materi Teks";
                  break;
              }
              echo $konten_lain->nama_sub_materi ?>
              </a>
            </li>
            <?php } ?>
          </ul>
          
          <?php if($next) 
          { ?>
          <a href="<?php echo base_url('materi/tabel_konten_detail/'.$next->id_materi_pokok)?>" class="btn btn-default">Berikutnya : <?php echo $next->nama_materi_pokok?></a>
          <?php 
          } ?>

				    </div>
			    </div>
            </div>
		</div> -->
		
		<?php include('footer.php'); ?>
		
		<!-- Javascript -->
		<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-scrolltofixed.js');?>"></script>
		
        <!-- Scroll to Fixed -->
        <script type="text/javascript">
            $('#listbar').scrollToFixed({
            marginTop: $('.header').outerHeight() - 250,
            limit: function() {
                var limit = $('.footer').offset().top - $('#listbar').outerHeight(true) - 10;
                return limit;
            },
            zIndex: 999,
            removeOffsets: true
        });
        $('#fixednav').scrollToFixed();
        </script>
		
		<!-- Menu Toggle Script -->
		<script>
		$("#menu-toggle").click(function(e) {
			e.preventDefault();
			$("#wrapper").toggleClass("toggled");
		});
		</script>
		
		<script type="text/javascript">
      //Ajax function trigger
      $(document).ready(function(){
        $("[id^=link_video-]").click(function(e){
          e.preventDefault();
          var target = e.length > 0 ? e : e.target.id;
          
          ajaxChangeContentVideo(target); 
        });
      });

      //Ajax request to Change Content Video
      function ajaxChangeContentVideo(target)
      {
        var value = target.split('-');
        
        $.ajax({
          url: "<?=base_url('materi/ajax_change_content');?>",
          type: 'post',
          dataType: 'json',
          data: { 'id': value[1], 'tipe':'video' },

          success:function(data, status){
            console.log('\nid_1: '+value[0]+ ', id_2: '+value[1]);
            console.log("\nStatusChangeContent: " + status + "\nDATA: " + data.judul_materi);
            
            $('#judul_materi').html(data.judul_materi);

						dashStop();
            
            if ( estimator != null )
						{ estimator=null; }
						estimator = new shaka.util.EWMABandwidthEstimator();

						if ( source != null )
						{ source = null; }
						source = new shaka.player.DashVideoSource(data.video_materi, null, estimator);

						// Load the source into the Player.
						player.load(source);

          },
          error: function(xhr, desc, err) {
            console.log(xhr);
            console.log("Details: " + desc + "\nError:" + err);
          }
        });

      }
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

			function connect()
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
					if ( estimator != null )
					{ estimator=null; }
					
					estimator = new shaka.util.EWMABandwidthEstimator();

					if ( source != null )
					{ source = null; }

					source = new shaka.player.DashVideoSource("<?php echo $data->video_materi ? $data->video_materi : '';?>", null, estimator);
					// source = new shaka.player.DashVideoSource("http://45.64.97.197:1935/TestVOD/mp4:soal16.mp4/manifest.mpd", null, estimator);

					// Load the source into the Player.
					player.load(source);
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
			     		// statusStr.textContent = e.detail.url+' not found.';
							statusStr.textContent = 'Video not found.';
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
				{ player.unload(); }
			
				connectObj.textContent = "Start";
				statusStr.textContent = "Connecting...";
			}
		</script>
			
	</body>
</html>
