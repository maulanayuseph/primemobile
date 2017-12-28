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
    
  </head>
  <body>
    <header class="header">
      <!-- nav bar -->
         <?php include('header.php'); ?>
        <div class="mapel-header" style="margin-top:60px;">
            <h2 class="mapel-title"><?php echo $header->nama_mapel." ".$header->alias_kelas ?></h2>
        </div>
    </header>

    <!-- Table of Content -->
	<?php if($this->session->userdata('id_siswa') !== null and isset($jumlahmateribelajar) and $jumlahmateribelajar== 0){
		?>
		<div id="content-sidebar" class="tableofcontent-wrapper">
			<div class="row text-center">
			<img src="<?php echo base_url("assets/pg_user/images/think.png");?>" class="img-tambah-materi center-block">
			
			<h5>Anda belum menyusun rencana belajar untuk mata pelajaran ini. Susun rencana belajar anda di <a href="<?php echo base_url("user/dashboard");?>">Dashboard</a></h5>
			</div>
		</div>
		<?php
		//echo $_SESSION['akses']['reguler'][0];
	}else{
		?>
    <div id="content-sidebar" class="tableofcontent-wrapper">
        <div class="tableofcontent">
            <div class="table-sidebar">
                <div id="sidebar" class="left-side">
                <!--<h3><?php echo isset($data->nama_materi_pokok)?$data->nama_materi_pokok:'Judul Materi Pokok' ?></h3>-->
                    <h4>KONTEN BAB</h4>
                    <ul class="nav nav-pills nav-stacked">
                    <?php foreach ($data as $list_side_pokok) {
                            if($list_side_pokok->mapel_id == $header->id_mapel)
                            {
                      ?>
                        <li role="presentation">
                            <? /* <a data-toggle="pill" href="#" onclick="$('#pokok_<?php echo $list_side_pokok->id_materi_pokok?>').animatescroll();"><?php echo $list_side_pokok->nama_materi_pokok;?></a> */ ?>
                            <a data-toggle="pill" href="#" onclick="$('.desc-content').hide();$('#div_<?php echo $list_side_pokok->id_materi_pokok?>').toggle('slow');$('#div_<?php echo $list_side_pokok->id_materi_pokok?>').animatescroll({ padding:40 });"><?php echo $list_side_pokok->nama_materi_pokok;?></a>
                        </li>
                      <?php
                            }
                        }?>
                    </ul>
                </div>
            </div>
      
      <div class="table-desc">
        <?php
        foreach ($list_pokok as $pokok)
        if($pokok->mapel_id == $header->id_mapel)
        {
          { ?>
            <div class="desc-content" id="div_<?php echo $pokok->id_materi_pokok; ?>" <?= $pokok->id_materi_pokok == $this->uri->segment(3) ? "style='display:block;'" : "style='display:none;'" ?>>
              <div class="content-target" id="pokok_<?php echo $pokok->id_materi_pokok; ?>"></div>
			  <div class="row" style="margin-bottom:10px;">
				<div class="col-lg-9"><h3><?php echo $pokok->nama_materi_pokok;?></h3></div>
				<div class="col-lg-3" style="text-align: right;">
				<?php if (isset($_SESSION['akses'])){ ?>
					<?php if (count($_SESSION['akses']) > 0){ ?>
					<a href="<?php echo base_url('materi_download/download_bab/'.$pokok->id_materi_pokok)?>" class="btn btn-primary" target="_blank"><span class="glyphicon glyphicon-save" aria-hidden="true"></span></a>
					<?php } ?>
				<?php } ?>
				</div>
				<p><?php echo $pokok->deskripsi_materi_pokok; ?></p>
              </div>
			  <div class="clearfix"></div>
			  <ul>
              <?php
              foreach ($list_sub as $sub)
              { 
                if($sub->materi_pokok_id == $pokok->id_materi_pokok)
                {
                  if($sub->kategori=="1") //Teks
                  { ?>
                  <li>
                    <span class="materi-sep"></span>
                     <?php 
                    if(($sub->status_materi == 0) OR ($allow_akses == TRUE)) { // If konten is 'Free' ?>
                      <a href="<?php echo base_url().'materi/konten_teks/'.$sub->id_konten;?>">
                    <?php
                    } else { ?>
                      <a href="#" data-toggle="modal" data-target="#myModal">
                    <?php 
                    } ?>
                      <span class="icon-teks"></span><?php echo ucwords(strtolower($sub->nama_sub_materi));?>
                    </a>
                  </li>
                  <?php
                  }

                  if($sub->kategori=="2") //Video
                  { ?>
                  <li>
                    <span class="materi-sep"></span>
                    <?php 
                    if(($sub->status_materi == 0) OR ($allow_akses == TRUE)) { // If konten is 'Free' ?>
                      <a href="<?php echo base_url().'materi/konten_video/'.$sub->id_konten;?>" >
                    <?php
                    } else { ?>
                      <a href="#" data-toggle="modal" data-target="#myModal">
                    <?php 
                    } ?>
                      <span class="icon-video"></span><?php echo ucwords(strtolower($sub->nama_sub_materi));?>
                    </a>
                  </li>
                  <?php
                  }

                  if($sub->kategori=="3") //Soal
                  { ?>
                  <li style="padding-left: 50px !important;">
                    <span class="materi-sep"></span>
                    <?php 
                    if(($sub->status_materi == 0) OR ($allow_akses == TRUE)) { // If konten is 'Free' ?>
                      <a href="<?php echo base_url().'latihan/index/'.$sub->id_sub_materi;?>" >
                    <?php
                    }elseif(($header->id_kelas == 38 && $paketaktif == 19) || ($header->id_kelas == 37 && $paketaktif == 20)){
						?>
							<a href="<?php echo base_url().'latihan/index/'.$sub->id_sub_materi;?>" >
						<?php
					} else { ?>
                      <a href="#" data-toggle="modal" data-target="#myModal">
                    <?php 
                    } ?>
                      <span class="icon-tugas"></span><?php echo strtoupper($sub->nama_sub_materi);?>
                    </a>
                  </li>
                  <?php
                  }
                  
                  //jika id = 4 (tryout)
				  if($sub->kategori=="4") //Soal

                  { ?>

                  <li>

                    <span class="materi-sep"></span>

                    <?php 

                    if(($sub->status_materi == 0) OR ($allow_akses == TRUE)) { // If konten is 'Free' ?>

                      <a href="<?php echo base_url().'tryout/index/'.$sub->id_sub_materi;?>" >

                    <?php

                    } else { ?>

                      <a href="#" data-toggle="modal" data-target="#myModal">

                    <?php 

                    } ?>

                      <span class="icon-tugas"></span><?php echo $sub->nama_sub_materi;?>

                    </a>

                  </li>

                  <?php

                  }
				  //end tampil tryout
                }
              } ?>
              </ul>
                
            </div>
            
            <?php include('modal_akses_materi.php'); ?>
          <?php
          } 
        } ?>

    
      </div>
    </div> 

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
      </div>       
    <?php
	}
	?>
    <?php include('footer.php');?>
    
    <!-- Javascript -->
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js');?>"></script>
    
    <!-- Menu Toggle Script -->
    <script type="text/javascript">
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
    </script>
    
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-scrolltofixed.js');?>"></script>
    <script type="text/javascript">
        $('#fixednav').scrollToFixed();
        $('#sidebar').scrollToFixed({
            marginTop: $('.header').outerHeight() - 250,
            limit: function() {
                var limit = $('.footer').offset().top - $('#sidebar').outerHeight(true) - 10;
                return limit;
            },
            zIndex: 999,
            removeOffsets: true
        });
    </script>
    
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/animatescroll.js');?>"></script>
    
  </body>
</html>
