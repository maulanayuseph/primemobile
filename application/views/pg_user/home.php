<!DOCTYPE html>
<html lang="en">
  <head>    
    <title>Prime Mobile - Cara belajar masa kini</title>
    
    <!-- Meta Tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Icon -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/pg_user/images/icon/favicon.ico');?>" >
    <link rel="icon" sizes="130x128" href="<?php echo base_url('assets/pg_user/images/icon/favicon.ico');?>" >
    <link rel="apple-touch-icon" sizes="130x128" href="<?php echo base_url('assets/pg_user/images/icons/favicon.ico');?>" >
    
    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/bootstrap.css')?>" >
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/main.css');?>" >
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom.css');?>" >
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/edit.css');?>" >
     
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
  <body>
    <header>
      <div class="hero-wrap">
      <!-- nav bar -->
        <?php include('header.php'); ?>
        
        <div class="hero">        
          <div class="container">
            <div class="jumbotron">
              <h1>Materi Belajar Online<br>Kapan dan Dimana Saja.</h1>
              <p>Bingung mencari materi pelajaran dan soal buat ujian nasional dan persiapan sbmptn? Jangan khawatir, karena Prime Mobile menyediakan semua bahan materi yang kamu butuhkan.</p>
              <?php if(!isset($_SESSION['id_siswa'])) 
              { ?>
              <?php echo $this->session->flashdata('alert'); ?>
              <button type="button" class="btn btn-lg btn-warning" id="btn-start">
                  MULAI BELAJAR &nbsp;&nbsp;<span class="glyphicon glyphicon-arrow-right"></span>
              </button>
              <form action="<?php echo base_url('home/do_login'); ?>" method="post" class="form-start" id="login-start" style="display:none;">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <input type="text" name="username" class="form-control form-custom" placeholder="Username/Email" >
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-custom" placeholder="Password" >
                    </div>
                    <button type="submit" name="submitButton" class="btn btn-full-width">LOGIN</button>
                  </div>
              </form>
              <?php 
              } ?>
            </div>
          </div>
        </div>
      </div>
    </header>
      
    <section class="section keunggulan">
      <!-- mengapa -->  
      <div class="container">
          <h2 class="section-title">Mengapa Belajar Online di Prime Mobile?</h1>
        <div class="col-sm-3">
          <div class="col-sm-3">
            <img src="<?php echo base_url('assets/pg_user/images/icon/icon-jam.png')?>">
          </div>
          <div class="col-sm-9">
            <h4>Belajar 24 jam</h4>
            <p>Belajar online kapan saja dan dimana saja. Baik dari komputer, laptop, tablet maupun handphone kamu.</p>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="col-sm-3">
            <img src="<?php echo base_url('assets/pg_user/images/icon/icon-materi.png')?>">
          </div>
          <div class="col-sm-9">
          <h4>Materi Lengkap</h4>
          <p>Mulai dari materi SD hingga SBMPTN. Mulai dari fisika, matematika, bahasa, biologi, dan sebagainya.</p>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="col-sm-3">
            <img src="<?php echo base_url('assets/pg_user/images/icon/icon-kuis.png')?>">
          </div>
          <div class="col-sm-9">
          <h4>Kuis dan Latihan </h4>
          <p>Ingin menguji kemampuanmu? Ikuti latihan dan kuis disetiap materi. Lengkap beserta video penjabaran dan ulasan. </p>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="col-sm-3">
            <img src="<?php echo base_url('assets/pg_user/images/icon/icon-mudah.png')?>">
          </div>
          <div class="col-sm-9">
          <h4>Mudah dan Menyenangkan</h4>
          <p>Belajar mandiri secara online akan meningkatkan fokus dan pemahaman akan materi tanpa gangguan.</p>
          </div>
        </div>
      </div>
    </section>
    
    <section class="section materi">
      <!-- apa saja -->
      <div class="container">
        <h2 class="section-title materi-title">Apa Saja Materi di Prime Mobile?</h2>
        <ul class="nav nav-tabs nav-materi">
          <li class="active"><a data-toggle="tab" href="#menu0">Matematika</a></li>
          <li><a data-toggle="tab" href="#menu1">Fisika</a></li>
          <li><a data-toggle="tab" href="#menu2">Sejarah</a></li>
          <li><a data-toggle="tab" href="#menu3">Bahasa</a></li>
          <li><a data-toggle="tab" href="#menu4">Kimia</a></li>
        </ul>

        <div class="tab-content">
          <div id="menu0" class="tab-pane fade in active">
            <div class="table-responsive">
              <table class="table table-responsive tabel-materi">
                <thead>
                  <tr>
                    <th>SD</th>
                    <th>SMP</th>
                    <th>SMA</th>
                    <th>SBMPTN</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Matematika Kelas 1</td>
                    <td>Matematika Kelas 7</td>
                    <td>Matematika Kelas 10</td>
                    <td>SBMPTN Matematika</td>
                  </tr>
                  <tr>
                    <td>Matematika Kelas 2</td>
                    <td>Matematika Kelas 8</td>
                    <td>Matematika Kelas 11</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Matematika Kelas 3</td>
                    <td>Matematika Kelas 9</td>
                    <td>Matematika Kelas 12</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Matematika Kelas 4</td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Matematika Kelas 5</td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Matematika Kelas 6</td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div id="menu1" class="tab-pane fade">
            <div class="table-responsive">
              <table class="table tabel-materi">
                <thead>
                  <tr>
                    <th>SD</th>
                    <th>SMP</th>
                    <th>SMA</th>
                    <th>SBMPTN</th>
                  </tr>
                </thead>
                <tbody>
                <tr>
                  <td>Fisika Kelas 4</td>
                  <td>Fisika Kelas 7</td>
                  <td>Fisika Kelas 11</td>
                  <td>SBMPTN Fisika</td>
                </tr>
                <tr>
                  <td>Fisika Kelas 5</td>
                  <td>Fisika Kelas 8</td>
                  <td>Fisika Kelas 12</td>
                  <td></td>
                </tr>
                <tr>
                  <td>Fisika Kelas 6</td>
                  <td>Fisika Kelas 9</td>
                  <td></td>
                  <td></td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div id="menu2" class="tab-pane fade">
          <div class="table-responsive">
          <table class="table tabel-materi">
            <thead>
              <tr>
                <th>SD</th>
                <th>SMP</th>
                <th>SMA</th>
                <th>SBMPTN</th>
              </tr>
            </thead>
            <tbody>
            <tr>
              <td>Sejarah Kelas 4</td>
              <td>Sejarah Kelas 7</td>
              <td>Sejarah Kelas 11</td>
              <td>SBMPTN Sejarah</td>
            </tr>
            <tr>
              <td>Sejarah Kelas 5</td>
              <td>Sejarah Kelas 8</td>
              <td>Sejarah Kelas 12</td>
              <td></td>
            </tr>
            <tr>
              <td>Sejarah Kelas 6</td>
              <td>Sejarah Kelas 9</td>
              <td></td>
              <td></td>
            </tr>
            </tbody>
          </table>
          </div>
          </div>
          <div id="menu3" class="tab-pane fade">
          <div class="table-responsive">
          <table class="table tabel-materi">
            <thead>
              <tr>
                <th>SD</th>
                <th>SMP</th>
                <th>SMA</th>
                <th>SBMPTN</th>
              </tr>
            </thead>
            <tbody>
            <tr>
              <td>Bahasa Indonesia Kelas 1</td>
              <td>Bahasa Indonesia Kelas 7</td>
              <td>Bahasa Indonesia Kelas 10</td>
              <td>SBMPTN Bahasa Indonesia </td>
            </tr>
            <tr>
              <td>Bahasa Indonesia Kelas 2</td>
              <td>Bahasa Indonesia Kelas 8</td>
              <td>Bahasa Indonesia Kelas 11</td>
              <td></td>
            </tr>
            <tr>
              <td>Bahasa Indonesia Kelas 3</td>
              <td>Bahasa Indonesia Kelas 9</td>
              <td>Bahasa Indonesia Kelas 12</td>
              <td></td>
            </tr>
            <tr>
              <td>Bahasa Indonesia Kelas 4</td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>Bahasa Indonesia Kelas 5</td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>Bahasa Indonesia Kelas 6</td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            </tbody>
          </table>
            </div>
          </div>
          <div id="menu4" class="tab-pane fade">
          <div class="table-responsive">
          <table class="table tabel-materi">
            <thead>
              <tr>
                <th>SMP</th>
                <th>SMA</th>
                <th>SBMPTN</th>
              </tr>
            </thead>
            <tbody>
            <tr>
              <td>Kimia Kelas 7</td>
              <td>Kimia Kelas 10</td>
              <td>SBMPTN Kimia</td>
            </tr>
            <tr>
              <td>Kimia Kelas 8</td>
              <td>Kimia Kelas 11</td>
              <td></td>
            </tr>
            <tr>
              <td>Kimia Kelas 9</td>
              <td>Kimia Kelas 12</td>
              <td></td>
            </tr>
            </tbody>
          </table>
            </div>
          </div>
        </div>
      </div>  
    </section>
    
     <section class="section video">
      <!-- contoh video -->
      <div class="container">
        <h2 class="section-title">Contoh Video Prime Mobile</h2>
        <?php 
          $num_video = 0;
          if(!empty($video_demo)) 
          { 
            foreach ($video_demo as $video) {
            $num_video++;
            ?>
            <div class="col-sm-6 col-md-3 video-container">
              <a href="#" class="modal-demo-video" id="demo-<?php echo $video->id_sub_materi?>" data-toggle="modal" data-target="#videoDemoModal" data-source="<?php echo $video->video_materi; ?>">
                 <img src="<?php echo base_url('assets/pg_user/images/video-thumbs/Kelas6SD-Bahasa Indonesia-MemahamiTeks.jpg');?>" width="285" height="212" class="img-responsive"> 
              </a>
              <span class="text-center">
                <?php echo $video->nama_mapel." ".$video->alias_kelas?></span>
              </span>
            </div>
            <?php 
            }
          }
          
          for ($i=$num_video; $i < 4 ; $i++) { 
            ?>
            <div class="col-sm-6 col-md-3 video-container">
               <img src="<?php echo base_url('assets/img/no-video.jpg');?>" width="285" height="212" class="img-responsive"> 
              <span class="text-center">Belum ada video</span>
            </div>    
            <?php
          } 
          ?>
        </div>
      </div>    
    </section>
    
    <!-- modal youtube 1 -->
     <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Kelas 8 SMP - Biologi</h4><p><a id="pause-button" href="#">Pause</a>
              </div>
              <div class="modal-body">
                <div class="embed-responsive embed-responsive-16by9">
                   <iframe src="https://www.youtube.com/embed/CopycK8QQ9A?enablejsapi=1&html5=1" frameborder="0" allowfullscreen class="embed-responsive-item" id="video"></iframe>
                   
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-warning" id="stop" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
    </div>
    
    <!-- modal youtube 2 -->
     <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Kelas 7 SMP - Matematika</h4>
              </div>
              <div class="modal-body">
                <div class="embed-responsive embed-responsive-16by9">
                   <iframe src="https://www.youtube.com/embed/9afVdiPno2U?enablejsapi=1&html5=1" frameborder="0" allowfullscreen class="embed-responsive-item" id="video2"></iframe>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-warning" id="stop" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
    </div>
    
    <!-- modal youtube 3 -->
     <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Ujian Nasional Kimia SMA</h4>
              </div>
              <div class="modal-body">
                <div class="embed-responsive embed-responsive-16by9">
                   <iframe src="https://www.youtube.com/embed/OBU6XnkHn8Y?enablejsapi=1&html5=1" frameborder="0" allowfullscreen class="embed-responsive-item" id="video3"></iframe>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-warning" id="stop" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
    </div>
    
    <!-- modal youtube 4 -->
     <div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Biologi Kelas 8 SMP</h4>
              </div>
              <div class="modal-body">
                <div class="embed-responsive embed-responsive-16by9">
                   <iframe src="https://www.youtube.com/embed/SXKxKoEphvM?enablejsapi=1&html5=1" frameborder="0" allowfullscreen class="embed-responsive-item" id="video4"></iframe>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-warning" id="stop" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
    </div>

    <section class="section testimoni">
      <!-- apa kata -->
      <div class="container">
        <h2 class="section-title">Apa Kata Mereka?</h2>
        <div class="col-md-4 testimonial">
          <div class="foto-profil img-circle">
            <img src="<?php echo base_url('assets/pg_user/images/foto-siswa/irfan.jpg')?>" width="65" height="65" alt="Foto Profil Siswa Prime Mobile" class="img-responsive">
          </div>
          <h4>Muhammad Irfan</h4>
          <h4 class="sub">SMKN 5 Blitar</h4>
          <p>Alhamdulillah. Setelah mengikuti materi online di Prime Mobile, saya berhasil lulus ujian nasional 2015 dengan nilai memuaskan.</p>
        </div>
        <div class="col-md-4 testimonial">
          <div class="foto-profil img-circle">
            <img src="<?php echo base_url('assets/pg_user/images/foto-siswa/yunita.png')?>" width="400" height="599" alt="Foto Profil Siswa Prime Mobile" class="img-responsive">
          </div>    
          <h4>Yunita Rachma</h4>
          <h4 class="sub">SMA Islam Lampung</h4>
          <p>Materi dan Simulasi soal SBMPTN yang saya pelajari di Prime Mobile sangat membantu saya lulus ujian masuk di fakultas kedokteran ITB. Thanks!</p>
        </div>
        <div class="col-md-4 testimonial">
          <div class="foto-profil img-circle">    
            <img src="<?php echo base_url('assets/pg_user/images/foto-siswa/ilham.jpg')?>" width="375" height="500" alt="Foto Profil Siswa Prime Mobile" class="img-responsive">
          </div>
          <h4>Ilham Komarudin</h4>
          <h4 class="sub">Institut Teknologi Surabaya</h4>
          <p>Kursus online dengan materi dan tampilan terbaik yang pernah saya ikuti selama ini. Maju terus Prime Mobile, cerdaskan anak bangsa.</p>
        </div>
      </div>        
    </section>
    
    <?php include('modal_demo_video.php');?>
    <?php include('footer.php');?>
    
    <!-- Javascript -->
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/form-validator/formValidation.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/form-validator/bootstrap.js');?>"></script>
    
    <script type="text/javascript">
        $('#btn-start').click(function(){
            $('#login-start').show();
            $('#btn-start').hide();
        });
    </script>

    <script type="text/javascript">
    $(document).ready(function() {
     $('#login-start')
     .formValidation({
        icon: {
          valid: 'glyphicon glyphicon-ok',
          invalid: 'glyphicon glyphicon-remove',
          validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
          username: {
            validators: {
              notEmpty: {
                  message: 'Username harus diisi'
              },
              regexp: {
                  regexp: /^[a-zA-Z0-9_@\.]+$/,
                  message: 'Username hanya dapat berisi huruf, angka, titik, dan underscore'
              }
            }
          },
          password: {
            validators: {
              notEmpty: {
                  message: 'Password harus diisi'
              }
            }
          }
        }
      });
    });
    </script>

    <script>
      if ( supports_media_source() ) {
        // supported.style.display="";
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
          
      }        

      function pauseVideo() {
          var video = $("#videoObj");
          // video.paused ? video.get(0).play() : video.get(0).pause();
          video.get(0).pause();
          
      }

      $("#videoDemoModal").on("shown.bs.modal", function(e){
        var video = $("#videoObj");
        
        // if(video.get(0).paused == true){
          playVideo();
        // }
      })

      $("#videoDemoModal").on("hidden.bs.modal", function(e){
        var video = $("#videoObj");
        
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
          

          if(source == null) {
            connect(src);
            
          }
          else if(id !== $(this).attr('id')) {
            
            id = $(this).attr('id'); //update the id value
            dashStop();
            connect(src);
          } 
        })

        

      });
    </script>

  </body>
</html>
