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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/main.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/edit.css');?>">
    
  </head>
  <body>
    <header>
      <!-- nav bar -->
      <?php include('header_dynamic.php');?>
      
      <div class="search-wrap">
        <div class="container">
          <form name="search_form" id="search_form" action="<?=base_url('pencarian/cari');?>" method="get" class="form-inline">
            <div class="form-group">
              <input type="text" name="key" id="key" class="form-control" placeholder="Masukkan kata kunci...">
            </div>
            <button class="btn btn-default" type="submit">Cari</button>
          </form>
        </div>
      </div>
    </header>
    <section class="page">
      <!-- apa kata -->
      <div class="container">
        <?php
        if(isset($_GET['key']))
          {?>
          <div class="page-title">
            <h3>Hasil Pencarian untuk "<?php echo $_GET['key']; ?>"</h3>
            <p class="text-mute"><i>Ditemukan <?php echo $total_rows?> hasil</i></p>
          </div>
        <?php 
          } ?>

        <?php 
          $get = $_GET;
          if(isset($get['tipe'])) 
            { unset($get['tipe']); }
          
          $get = '?'.http_build_query($get);
        ?>

        <ul class="list-inline nav-searching">
          <li class="<?php echo (empty($_GET['tipe'])) ? 'active' : ''?>">
            <a href="<?php echo base_url().'pencarian/cari'.$get;?>">Semua</a>
          </li>
          <li class="<?php echo (isset($_GET['tipe']) && $_GET['tipe'] == 'teks') ? 'active' : ''?>">
            <a href="<?php echo base_url().'pencarian/cari'.$get.'&tipe=teks';?>">Materi Teks</a>
          </li>
          <li class="<?php echo (isset($_GET['tipe']) && $_GET['tipe'] == 'video') ? 'active' : ''?>">
            <a href="<?php echo base_url().'pencarian/cari'.$get.'&tipe=video';?>">Materi Video</a>
          </li>
        </ul>
        
        <div id="search_result_all">
          <?php 
          if(!empty($search_result))
            {
              $img_default = base_url('assets/img/no-image.jpg'); 
              foreach ($search_result as $item) 
              {
                $img_materi = base_url().'assets/js/plugins/kcfinder/upload/images/'.$item['gambar_materi']
                ?>
                
                <div class="row page-result">
                  <div class="col-sm-3 text-center">
                    <img src="<?php echo (!empty($item['gambar_materi']) ? $img_materi : $img_default) ;?>" class="" style="height:150px;"></img>
                  </div>
                  <div class="col-sm-9">
                    <h4>
                      <?php
                      if($item['kategori'] == 1) { ?>
                        <a href="<?php echo base_url('materi/konten_teks/'.$item['id_konten'])?>"><?php echo $item['nama_sub_materi']?></a>
                      <?php
                      } else if($item['kategori'] == 2) { ?>
                        <a href="<?php echo base_url('materi/konten_video/'.$item['id_konten'])?>"><?php echo $item['nama_sub_materi']?></a>
                      <?php 
                      } else if($item['kategori'] == 3) { ?>
                        <a href="<?php echo base_url('latihan/index/'.$item['id_sub_materi'])?>"><?php echo $item['nama_sub_materi']?></a>
                      <?php
                      } ?>
                    </h4>
                    <p><?php echo $item['nama_materi_pokok']?></p>
                    <p><?php echo $item['nama_mapel']?></p>
                    <p><?php echo $item['alias_kelas']?></p>
                  </div>
                </div>

              <?php
              }
            }
          ?>
        </div> <!-- /#search_result_all -->

        <div class="col-sm-12 search-pagination">
          <nav class="text-center">
            <?php echo isset($pagination) ? $pagination : ''; ?>
          </nav>
        </div>

      </div>  <!-- /container -->      
    </section>
    
    <?php include('footer.php');?>
    
    <!-- Javascript -->
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>
      <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>
      <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/npm.js');?>"></script>
      <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/retina.min.js');?>"></script>
      <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js');?>"></script>
  
    <script type="text/javascript">
      $('#search_form').submit(function(e){
        // e.preventDefault();
        // ajax_search();
      });
    </script>

    <script type="text/javascript">
      function ajax_search()
      {
        var key = $('#kata_kunci').val();
        console.log(key);
        $.ajax({
          url: "<?=base_url('pencarian/ajax_search');?>",
          type: 'post',
          // dataType: 'json',
          data: { 'key': key },
          success: function(data, status) {
            $('#search_result_all').html(data);
          },
          error: function(xhr, desc, err) {
            console.log(xhr);
            console.log("Details: " + desc + "\nError:" + err);
          }
        });
      }
    </script>
  </body>
</html>
