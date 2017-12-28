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
    
    <style>
    	#isi_materi img{
    		width: auto;
    	}
    </style>
  </head>
  <body>
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
                <a href="<?php echo base_url('materi/tabel_konten_detail/'.$data->materi_pokok_id.'#pokok_'.$data->materi_pokok_id)?>" class="arrow-prev">
                  <span class="arrow"></span>
                </a>
                <h5><?php echo $header->nama_mapel ?></h5>
                <h4><?php echo $data->nama_materi_pokok?></h4>
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
                        { echo "<a href=".base_url('materi/konten_teks/'.$konten_lain->id_konten)." id='link_teks-".$konten_lain->id_konten."' onclick='$(judul_materi).animatescroll({ padding:80 });'>"; }
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
              { 
                $next_url = "#";
                if($next->kategori == "1") { $next_url = base_url('materi/konten_teks/'.$next->id_konten); }
                if($next->kategori == "2") { $next_url = base_url('materi/konten_video/'.$next->id_konten); }
                if($next->kategori == "3") { $next_url = base_url('materi/latihan/index/'.$next->id_sub_materi); }
                ?>
              <!-- <a href="<?php echo base_url('materi/tabel_konten_detail/'.$next->id_materi_pokok.'#pokok_'.$next->id_materi_pokok)?>" class="btn btn-default next-konten"> -->
              <a href="<?php echo $next_url;?>" class="btn btn-default next-konten">
                <h6>Bab Selanjutnya</h6>
                <p><?php echo $next->nama_materi_pokok?></p>
                <span class="arrow-next"><span class="arrow"></span></span>
              </a>
              <?php 
              } ?>

            </div>
        </div>
      </div>

      <div class="subs-left">
        <div id="ajax-loading" class="col-xs-12 col-md-12 text-center" style="display:none; padding-top:60px;"> 
          <img src="<?php echo base_url('assets/img/ajax-loading2.gif')?>" alt="Loading..."></img>
        </div>
          <h3 class="center-title" id="judul_materi"><?php echo $data->nama_sub_materi?></h3>
        
        <?php 
        if(($data->status_materi == 0) OR ($allow_akses == TRUE))
        { ?>
          <div id="isi_materi">
            <?php echo html_entity_decode($data->isi_materi)?>
          </div>
		  <hr>
		  <div id="lnk_download"><a href="<?php echo base_url('materi_download/download_materi/'.$data->id_konten)?>" class="btn btn-primary" target="_blank"><span class="glyphicon glyphicon-save" aria-hidden="true"></span></a></div>
        <?php
        } 

        else 
        { ?>
          <div id="isi_materi" class="text-center">
            <center><img src="<?php echo base_url('assets/pg_user/images/custom/sorry.jpg');?>" width="368" height="273" alt="Notifikasi Pembayaran" class="img-responsive"></center>
            <br>
            <p>
              Anda perlu melakukan registrasi dan aktivasi untuk mengakses konten PrimeMobile. Daftarkan akun anda <a href="http://primemobile.co.id/signup">di sini</a>
            </p>
          </div>
        <?php
        } ?>

      </div>
    </div>
    
    
    <?php include('footer.php'); ?>
    
    <!-- Javascript -->
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-scrolltofixed.js');?>"></script>
    
    <!-- Menu Toggle Script -->
    <script>
      $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
      });
    </script>
    
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
    
<!--
    <script>
      $('#sidebar').affix({
          offset: {
            top: 345,
            bottom: 333
          }
      });
    </script>
-->

    <script type="text/javascript">
      //Show/Hide loading image (.gif) on AJAX process
      $(document).ready(function(){
        $(document).ajaxStart(function(){
          $('#judul_materi').hide();
          $('#isi_materi').hide();
          $("#ajax-loading").show();
          // $("#ajax-loading").fadeIn(100);
        });
        $(document).ajaxComplete(function(){
          // $("#ajax-loading").css("display", "none");
          $("#ajax-loading").fadeOut(100);
        });
      });
    </script>

    <script type="text/javascript">
      //Ajax function trigger
      $(document).ready(function(){
        $("[id^=link_teks-]").click(function(e){
          e.preventDefault();
          var target = e.length > 0 ? e : e.target.id;
          
          ajaxChangeContent(target); 
        });
      });

      //Ajax request to Change Content
      function ajaxChangeContent(target)
      {
        var value = target.split('-');
        
        $.ajax({
          url: "<?=base_url('materi/ajax_change_content');?>",
          type: 'post',
          dataType: 'json',
          data: { 'id': value[1], 'tipe':'teks' },

          success:function(data, status){
            console.log('\ntipe: '+value[0]+ ', id: '+value[1]);
            console.log("\nStatusChangeContent: " + status + "\nDATA: " + data.judul_materi);

            // JSON.parse(data);
            $('#judul_materi').html(data.judul_materi);
            $('#isi_materi').html(data.isi_materi);
            $('#lnk_download').html(data.lnk_download);
            $("#judul_materi").fadeIn(700); 
            $("#isi_materi").fadeIn(700); 
            $("#lnk_download").fadeIn(700); 
         },
          error: function(xhr, desc, err) {
            console.log(xhr);
            console.log("Details: " + desc + "\nError:" + err);
          }
        });

      }
    </script>
    
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/animatescroll.js');?>"></script>
		
  </body>
</html>
