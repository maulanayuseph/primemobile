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
    
    <link href="<?php echo base_url('assets/dashboard/css/style.css');?>" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/edit.css');?>">
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/style.css');?>">

    

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
	.daftar-list li {
	   list-style: none;
  }
	</style>

  </head>

  <body>

    <header>

      <!-- nav bar -->

        <?php include('header.php'); ?>

        <div class="mapel-header" style="margin-top:60px;">

          <h3 class="mapel-title" style="font-size: 20px;">

          <?php echo  (isset($header->alias_kelas)?$header->alias_kelas:'') ?>

        </h3>
        <h2 class="mapel-title">
        	<?php echo (isset($header->nama_mapel) ? $header->nama_mapel : ''); ?>
        </h2>

        </div>

    </header>

      <!-- apa kata -->

    

    <!-- <div class="container topic">

      <div class="row">

        <h4 class="topic-title">TOPIK</h4>

        <ul class="topic-item">

        <?php foreach ($table_data as $materi) {

        ?>

           <li><a href="<?php echo base_url('materi/tabel_konten_detail/'.$materi->id_materi_pokok)?>"><?php echo $materi->nama_materi_pokok ?></a></li>

        <?php

        }

        ?>                     

        </ul>

      </div>            

    </div> -->

    

    <!-- <div class="materi-detail">

      <div class="container">

        <div class="row">

          <h3 class="topic-title"><?php echo $header->nama_mapel ?></h3>

          <div class="col-sm-5">

            <img class="img-responsive" src="<?php echo base_url().'assets/js/plugins/kcfinder/upload/images/'.$header->gambar_mapel;?>" width="412" height="200" alt="Thumbnail Mata Pelajaran">

          </div>

          <div class="col-sm-7 right-materi">

            <p><?php echo $header->deskripsi_mapel; ?></p>

          </div>

        </div>            

      </div>

    </div> -->


    <div class="container-fluid daftar-isi konten-wrapper">

      <!-- <h3 class="text-center topic-title">Daftar Isi</h3> -->

      <?php  foreach ($table_data as $materi) { ?>

      <div class="row daftar-item">

        <div class="left">

          <div class="materi-thumb">

            <div class="thumb-container"> 

              <img src="<?php echo base_url('assets/pg_user/images/custom/earth.jpg');?>" width="600" height="738" alt="Gambar Materi" class="img-responsive">

            </div>

          </div>

          <div class="materi-daftar">

            <a href="../tabel_konten_detail/<?php echo $materi->id_materi_pokok; ?>"><h4 class="daftar-title"><?php echo $materi->nama_materi_pokok ?></h4></a>

            <p class="daftar-desc"><?php echo $materi->deskripsi_materi_pokok ?></p>

          </div>

        </div>

        <div class="right">

           <?php
           $i = 1;  
           foreach ($list_data as $list_sub) { 

            if($list_sub->materi_pokok_id == $materi->id_materi_pokok) 

            { ?>

            <div class="col-sm-6 col-xs-12" style="margin-bottom: 15px;"> 
			<?php
            if($list_sub->kategori == 3){
            	echo strtoupper($list_sub->nama_sub_materi);
            }else{
                echo ucwords(strtolower($list_sub->nama_sub_materi));
            }
            ?>
            </div>

            <?php 
				$i++;
				if ($i == 3){
					echo '<div class="clearfix"></div>';
					$i = 1;
				}
            }

          } 
          ?>

		  <?php /*
          <ul class="daftar-list">

           <?php  foreach ($list_data as $list_sub) { 

            if($list_sub->materi_pokok_id == $materi->id_materi_pokok) 

            { ?>

            <li> <?php
            if($list_sub->kategori == 3){
            	echo strtoupper($list_sub->nama_sub_materi);
            }else{
                echo ucwords(strtolower($list_sub->nama_sub_materi));
            }
            ?></li>

            <?php 

            }

          } ?>

          </ul>
		  */ ?>

        </div>

      </div>

      <?php } ?>

    </div>



    <!-- IBNU -->

    <section class="section video">

      <!-- contoh video -->

      <div class="container-fluid video-materi">

        <!-- <h2 class="section-title"><?php echo $header->nama_mapel ?></h2> -->

          <?php 

          $num_video = 0;

          if(!empty($video_demo)) 

          { 

            foreach ($video_demo as $video) {

            $num_video++;

            ?>

            <div class="video-container">

              <a href="#" class="modal-demo-video" id="demo-<?php echo $video->id_sub_materi?>" data-toggle="modal" data-target="#videoDemoModal" data-source="<?php echo $video->video_materi; ?>">

               <img src="<?php echo base_url('assets/pg_user/images/video-thumbs/Kelas6SD-Bahasa Indonesia-MemahamiTeks.jpg');?>" width="285" height="212" class="img-responsive"> 

              </a>

              <span class="text-center"><?php echo $video->nama_sub_materi?></span>

            </div>

            <?php 

            }

          }


            ?>

            <div class="col-sm-4"><!-- aslinya class video-container-->

               <video controls alt="Matematika Kelas 6 SD" src="<?php echo base_url('assets/uploads/sample/MTK10_8.3.mp4');?>" style="width: 100%;"></video>

              <div class="text-center">
                <h4>Matematika Kelas 10</h4>
                Pembahasan Fungsi Limit
              </div>

            </div>
			<div class="col-sm-4">

               <video controls alt="Matematika Kelas 6 SD" src="<?php echo base_url('assets/uploads/sample/FIS8-6.10.mp4');?>" style="width: 100%;"></video>

              <div class="text-center">
                <h4>Fisika Kelas 8</h4>
                Pembahasan bunyi
              </div>

            </div>
			<div class="col-sm-4">

               <video controls alt="Matematika Kelas 6 SD" src="<?php echo base_url('assets/uploads/sample/BIO11-14.1.mp4');?>" style="width: 100%;"></video>

              <div class="text-center">
                <h4>Biologi Kelas 11</h4>
                Pembahasan sistem pertahanan tubuh
              </div>

            </div>			

  
          

      </div>
<!-- video ditiadakan dulu
      <div class="container-fluid video-detail">
        <div class="left">
          <h5>Judul Video</h5>
          <p>Deskripsi video pada konten materi, deskripsi video Deskripsi video pada konten materi, deskripsi video. Deskripsi video pada konten materi, deskripsi video.</p>
        </div>
        <img src="<?php echo base_url('assets/pg_user/images/custom/videoPicture.jpg');?>" width="285" height="212" class="img-responsive right">
      </div>
      -->
    </section>

    <section class="konten-quote">
      <!-- <div class="quotation">
        <h5>Preparing to study physics</h5>
        <p>In most physics courses, you'll need a bit of math to succeed. See what you should do to prepare for your upcoming physics class. In most physics courses, you'll need a bit of math to succeed. See what you should do to prepare for your upcoming physics class.</p>
      </div> -->
      <ul class="quote-wrapper">
        <li></li>
        <li><h5>QUOTES</h5>
            <p>"Bermimpilah tentang apa yang ingin kamu impikan, pergilah ke tempat-tempat kamu 
            ingin pergi, jadilah seperti yang kamu inginkan, karena kamu hanya memiliki satu kehidupan 
            dan satu kesempatan untuk melakukan hal-hal yang ingin kamu lakukan." </p>  
            <h6>“Happy Trenggono”</h6>
        </li>
        <li></li>
      </ul>
    </section>


  <!-- /IBNU -->

    

    

    

    <?php include('modal_demo_video.php');?>

    <?php include('footer.php');?>

    

    <!-- Javascript -->

    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>

    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>

    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js');?>"></script>

    <script>

    $(document).ready(function() {
        $('.navhome').hover( function() {
            //$(this).css({'background-color':'#ffffff'});
          //}, function() {
            //$('.hover-img', this).animate({top:'100%'}, 'fast');
          });
      });
    </script>

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



      function connect(src = null)

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



          if (src !== null)

          {

            // source = new shaka.player.DashVideoSource("<?php //echo $data->video_materi ? $data->video_materi : '';?>", null, estimator);

            // source = new shaka.player.DashVideoSource("http://45.64.97.197:1935/TestVOD/mp4:soal16.mp4/manifest.mpd", null, estimator);

            source = new shaka.player.DashVideoSource(src, null, estimator);



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

          console.log("player: " + player);

          player.unload();

        }

        connectObj.textContent = "Start";

        statusStr.textContent = "Disconnected";

      }



    </script>

    <!-- /NEEDED FOR SHAKA PLAYER -->



    <script type="text/javascript">

      function playVideo() {

          var video = $("#videoObj");

          // video.paused ? video.get(0).play() : video.get(0).pause();

          video.get(0).play();

          console.log("(onPlay) isPaused: " + video.get(0).paused)

      }        



      function pauseVideo() {

          var video = $("#videoObj");

          // video.paused ? video.get(0).play() : video.get(0).pause();

          video.get(0).pause();

          console.log("(onPause) isPaused: " + video.get(0).paused)

      }



      $("#videoDemoModal").on("shown.bs.modal", function(e){

        var video = $("#videoObj");

        console.log('$videoDemoModal shown');

        // if(video.get(0).paused == true){

          playVideo();

        // }

      })



      $("#videoDemoModal").on("hidden.bs.modal", function(e){

        var video = $("#videoObj");

        console.log('#videoDemoModal hidden');

        // if(video.get(0).paused == false){

          pauseVideo();

        // }

      })        



      $(document).ready(function(){

        var video = $("#videoObj");

        var id = null;

        

        $(".modal-demo-video").on("click", function(e) 

        {

          if(id == null)

          { id = $(this).attr("id"); }



          var element = $(this);

          var src = element.data("source");

          console.log("ID: " + id);



          if(source == null) {

            connect(src);

            console.log("(onClick) isPaused: " + video.get(0).paused);

          }

          else if(id !== $(this).attr('id')) {

            console.log(id + " !== " +$(this).attr('id'));

            id = $(this).attr('id'); //update the id value

            dashStop();

            connect(src);

          } 

        })



        console.log("(onStart) isPaused: " + video.get(0).paused);    



      });

    </script>

    

  </body>

</html>
