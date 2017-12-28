<!DOCTYPE html>
<html lang="en">
    <head>    
        <title>Prime Generation Integrative Online Learning</title>
        
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
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/bootstrap.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/main.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/simple-sidebar.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/edit.css');?>">
        
    </head>
    <body>
      <header>
			<!-- nav bar -->
  			  <?php include('header_dynamic.php'); ?>
  				<div class="mapel-header">
  			        <h2 class="mapel-title">
                  <?php echo (isset($header->nama_mapel) ? $header->nama_mapel : '') ." ". (isset($header->alias_kelas)?$header->alias_kelas:''); ?>
                </h2>
  				</div>
  		</header>
			<!-- apa kata -->
		
        <div class="container topic">
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
        </div>
        
        <!-- <div class="materi-detail">
            <div class="container">
                <div class="row">
                    <h3 class="topic-title"><?php //echo $header->nama_mapel ?></h3>
                    <div class="col-sm-5">
                        <img class="img-responsive" src="<?php //echo base_url().'assets/js/plugins/kcfinder/upload/images/'.$header->gambar_mapel;?>" width="412" height="200" alt="Thumbnail Mata Pelajaran">
                    </div>
                    <div class="col-sm-7 right-materi">
                        <p><?php //echo $header->deskripsi_mapel; ?></p>
                    </div>
                </div>            
            </div>
        </div> -->

        <!-- IBNU -->
        <section class="section video">
          <!-- contoh video -->
          <div class="container video-materi">
              <h2 class="section-title"><?php echo $header->nama_mapel ?></h2>
              <div class="col-sm-6 col-md-3 video-container">
                  <a href="#" class="" data-toggle="modal" data-target="#myModal">
                     <img src="<?php echo base_url('assets/pg_user/images/video-thumbs/1.png');?>" width="285" height="212" class="img-responsive"> 
                  </a>
                <span>Biologi Kelas 8 SMP</span>
            </div>
            <div class="col-sm-6 col-md-3 video-container">
                <a href="#" class="" data-toggle="modal" data-target="#myModal2">
                   <img src="<?php echo base_url('assets/pg_user/images/video-thumbs/2.png');?>" width="285" height="212" class="img-responsive"> 
                </a>
               <span>Matematika Kelas 7 SMP</span>
            </div>
            <div class="col-sm-6 col-md-3 video-container">
                <a href="#" class="" data-toggle="modal" data-target="#myModal3">
                   <img src="<?php echo base_url('assets/pg_user/images/video-thumbs/3.png');?>" width="285" height="212" class="img-responsive"> 
                </a>
               <span>Ujian Nasional Kimia SMA</span>
            </div>
            <div class="col-sm-6 col-md-3 video-container">
                <a href="#" class="" data-toggle="modal" data-target="#myModal4">
                  <img src="<?php echo base_url('assets/pg_user/images/video-thumbs/4.png');?>" width="285" height="212" class="img-responsive"> 
                </a>
               <span>Biologi Kelas 8 SMP</span>
            </div>
          </div>
      
          <!-- modal youtube 1 -->
     <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Kelas 8 SMP - Biologi</h4>
              </div>
              <div class="modal-body">
                <div class="embed-responsive embed-responsive-16by9">
                   <iframe src="https://www.youtube.com/embed/CopycK8QQ9A?enablejsapi=1&version=3&playerapiid=ytplayer" frameborder="0" allowfullscreen class="embed-responsive-item" id="video"></iframe>
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
                   <iframe src="https://www.youtube.com/embed/9afVdiPno2U?enablejsapi=1&version=3&playerapiid=ytplayer" frameborder="0" allowfullscreen class="embed-responsive-item" id="video"></iframe>
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
                   <iframe src="https://www.youtube.com/embed/OBU6XnkHn8Y?enablejsapi=1&version=3&playerapiid=ytplayer" frameborder="0" allowfullscreen class="embed-responsive-item" id="video"></iframe>
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
                   <iframe src="https://www.youtube.com/embed/SXKxKoEphvM?enablejsapi=1&version=3&playerapiid=ytplayer" frameborder="0" allowfullscreen class="embed-responsive-item" id="video"></iframe>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-warning" id="stop" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
    </div>
    <!-- /IBNU -->
        
        <div class="container daftar-isi">
            <h3 class="text-center topic-title">Daftar Isi</h3>
            <?php  foreach ($table_data as $materi) { ?>
            <div class="row daftar-item">
                <div class="col-xs-12">
                    <div class="materi-thumb">
                        <div class="thumb-container"> 
                            <img src="<?php echo base_url('assets/pg_user/images/materi-thumbs/man-reading.png');?>" width="600" height="738" alt="Gambar Materi" class="img-responsive">
                        </div>
                    </div>
                    <div class="materi-daftar">
                        <h4 class="daftar-title"><?php echo $materi->nama_materi_pokok ?></h4>
                        <p class="daftar-desc"><?php echo $materi->deskripsi_materi_pokok ?></p>
                    </div>
                    <ul class="daftar-list">
			         <?php  foreach ($list_data as $list_sub) { 
                        if($list_sub->materi_pokok_id == $materi->id_materi_pokok) 
                        { ?>
                        <li><?php echo $list_sub->nama_sub_materi;?></li>
			            <?php 
                        }
                    } ?>
                    </ul>
                </div>
            </div>
            <?php } ?>
        </div>
        
        <?php include('footer.php');?>
        
        <!-- Javascript -->
        <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js');?>"></script>
		
		<!-- Menu Toggle Script -->
		<script>
		$("#menu-toggle").click(function(e) {
			e.preventDefault();
			$("#wrapper").toggleClass("toggled");
		});
		</script>
   
        <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-scrolltofixed.js');?>"></script>
        <script type="text/javascript">
            $('#fixednav').scrollToFixed();
        </script>
    
        
    </body>
</html>