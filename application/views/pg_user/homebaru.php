<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prime Mobile - MEMBUAT KAMU JUARA!</title>
    <meta name="Description" content="Prime Mobile adalah sebuah layanan bimbingan belajar online atau e-learning berbasis teknologi yang dibuat oleh Prime Genration" />
    <meta name="Keywords" content="belajar online, e-learning, bimbel, bimbingan, belajar, bimbingan belajar, ujian online, uts, uas, semester, sbmptn, snmptn, sd, smp, sma, video tutorial, pembahasan soal, analisis butir soal" />
	
    <link rel="icon" href="<?php echo base_url('assets/dashboard/images/icon-red.png');?>">
		
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/bootstrap.css');?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/custom.css');?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/edit.css');?>">
	
    <link href="<?php echo base_url('assets/dashboard/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/dashboard/css/style.css');?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/style.css');?>">

	   <link rel="stylesheet" href="<?php echo base_url('assets/dashboard/maximage/lib/css/jquery.maximage.css');?>" type="text/css" media="screen" title="CSS" charset="utf-8" />

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/main.css');?>">
	
	<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/shaka-player.js');?>" defer></script>
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    
    <!-- ANALYTICS -->
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-93257814-1', 'auto');
	  ga('send', 'pageview');
	
	</script>
<!-- end ANALYTICS -->
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1434517826569899'); // Insert your pixel ID here.
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1434517826569899&ev=PageView&noscript=1"
/></noscript>
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->
	<style>
		.video{
			background: none;
			padding: 0px;
		}
		.materi-content .caption p,
		.home-slider .caption p{
			color: white;
		}
		.reason-wrapper > p{
			color: black;
		}
		p{
			color: black;
		}
	</style>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
<script>
$(function(){
	$("#pilihprovinsi").change(function(){
		$("#pilihkota").load("signup/kota/" + $("#pilihprovinsi").val());
	});
	
	$("#pilihkota").change(function(){
		$("#btnTambahSekolah").prop('disabled', false);
		$("#pilihsekolah").load("signup/sekolah/" + $("#pilihkota").val());
	});
	
	$("#simpansekolahbaru").click(function(){
		$("#pilihsekolah").html("<option value='sekolahbaru'>"+ $("#sekolahbaru").val()+ "</option>");
	});
	
	$("#pilihsekolah").change(function(){
		$("#kelas").load("signup/kelas/" + $("#pilihsekolah").val());
	});
});
</script>
	<script>
    function initPlayer() {
        // Install polyfills for legacy browser support.
        shaka.polyfill.installAll();

        // Find the Shaka Player video element.
        var video = document.getElementById('video');

        // Construct a Player to wrap around it.
        var player = new shaka.player.Player(video);

        // Attach the player to the window so that it can be easily debugged.
        window.player = player;

        // Listen for errors from the Player.
        player.addEventListener('error', function(event) {
          console.error(event);
          });

        // Construct a DashVideoSource to represent the DASH manifest.
        var mpdUrl = 'http://45.64.97.197:1935/TestVOD/mp4:BI4-1.01.mp4/manifest.mpd';
        var estimator = new shaka.util.EWMABandwidthEstimator();
        var source = new shaka.player.DashVideoSource(mpdUrl, null, estimator);

        // Load the source into the Player.
        player.load(source);
    }
    document.addEventListener('DOMContentLoaded', initPlayer);
</script>
<script>
    function initPlayer() {
        // Install polyfills for legacy browser support.
        shaka.polyfill.installAll();

        // Find the Shaka Player video element.
        var video = document.getElementById('video2');

        // Construct a Player to wrap around it.
        var player = new shaka.player.Player(video);

        // Attach the player to the window so that it can be easily debugged.
        window.player = player;

        // Listen for errors from the Player.
        player.addEventListener('error', function(event) {
          console.error(event);
          });

        // Construct a DashVideoSource to represent the DASH manifest.
        var mpdUrl = 'http://45.64.97.197:1935/TestVOD/_definst_/mp4:(17). 7 SMP KIMIA/2. UNSUR, SENYAWA DAN CAMPURAN/KIM1-07 (08).mp4/manifest.mpd';
        var estimator = new shaka.util.EWMABandwidthEstimator();
        var source = new shaka.player.DashVideoSource(mpdUrl, null, estimator);

        // Load the source into the Player.
        player.load(source);
    }
    document.addEventListener('DOMContentLoaded', initPlayer);
</script>

  </head>

  <body>
    <?php include('header.php'); ?>

    <section class="home-slider">
      <div class="bungkus-slide">
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		  <!-- Indicators -->
		  <ol class="carousel-indicators">
			<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			<li data-target="#carousel-example-generic" data-slide-to="1"></li>
			<li data-target="#carousel-example-generic" data-slide-to="2"></li>
			<li data-target="#carousel-example-generic" data-slide-to="3"></li>
		  </ol>

		  <!-- Wrapper for slides -->
		  <div class="carousel-inner" role="listbox">
			<div class="item active slide-1">
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 kolom">
					<h1><b>BELAJAR ONLINE dengan <br>PRIME MOBILE </b></h1>
					<h2><b>MEMBUAT KAMU JUARA!</b></h2>
					<p>Mudahnya belajar dengan Primemobile.co.id bisa dimana saja, kapan saja dengan materi terlengkap dan terjamin kualitasnya. Penyajian yang asyik dan menarik <br>versi TEXT dan VIDEO</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<a class="btn btn-mulai" href="login">Mulai Belajar</a>
				</div>
			</div>
			<div class="item slide-2">
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 kolom" style="left: 5%;">
					<h1><b>KEKUATAN PRIME MOBILE ..?</b></h1>
					<h2><b>ADA DI KONTEN ..!</b></h2>
					<p>- Memuat rangkuman materi yang harus dikuasai oleh siswa untuk kepentingan US/M, UN/USBN dan SBMPTN<br/>
					  - Dilengkapi dengan puluhan ribu soal yang berkualitas prediktif yang disiapkan oleh tim Research & Development (secara khusus dan selalu up to date sesuai kepentingan siswa)<br/>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<a class="btn btn-mulai" href="login">Mulai Belajar</a>
				</div>
			</div>
			<div class="item slide-3">
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 kolom">
					<h1 style="position: relative; top: -50px;"><b>PRIME MOBILE, </b></h1>
					<h2 style="position: relative; top: -50px;"><b>Dibutuhkan bagi</b></h2>
					<p style="position: relative; top: -50px;">- Siswa SD, SMP, SMA<br/>
					  - Orang tua<br/>
					  - Sekolah<br/>
					  - Lembaga Pendikan Formal dan non Formal.<br/>
					  (Home Schooling, Boarding schooling dll).</br></p>
					<h2 style="position: relative; top: -25px;"><b>Kapan dan Dimana Saja.</b></h2>
					<p>&nbsp;</p>
					<a class="btn btn-mulai" href="login">Mulai Belajar</a>
				</div>
			</div>
			<div class="item slide-4">
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 kolom" style="left: 3%;">
					<h1><b>Mau Lolos SNMPTN.. <br>Atau SBMPTN ?</b></h1>
					<h2><b>Pastikan dengan Prime Mobile...!</b></h2>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
				</div>
			</div>

		  </div>

		  <!-- Controls -->
		  <a class="left carousel-control hidden-xs" href="#carousel-example-generic" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control hidden-xs" href="#carousel-example-generic" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		  </a>
		</div>
	  </div>
    </section>
    
    <section id="reason-page" class="reason-wrapper">
      <h4>Mengapa Belajar Online dengan <span class="red">Prime Mobile?</span></h4>
      <p>Prime Mobile memberikan solusi kesulitan belajar & siap menghantar sukses kalian untuk <b>US/M, US, SBMPTN</b> (Dengan fitur yang lengkap, materi dan soal-soal yang prediktif)!</p>
      <div class="reason-container">
        <div class="reason-content">
          <div class="left"><img src="<?php echo base_url('assets/pg_user/images/custom/why1.jpg');?>"></div>
          <div class="right">
            <h6><b>Belajar 24 jam</b></h6>
            <p>Kalian siswa kelas (4,5,6 SD/ MI,  7,8,9 SMP/MTs, 10,11,12 SMA/MA) Sukses UTS , UAS, US/M, UN/USBN dan SBMPTN, dapat  Kalian persiapkan setiap hari 24 jam non stop. Dengan cara belajar lebih mudah menyenangkan, kapan saja dan dimana saja.</p>
          </div>
        </div>

        <div class="reason-content2">
          <div class="left"><img src="<?php echo base_url('assets/pg_user/images/custom/why2.jpg');?>"></div>
          <div class="right">
            <h6><b>Materi Berkualitas dan Soal-soal Prediktif</b></h6>
            <p>Prime Mobile memuat rangkuman materi yang harus / wajib dikuasai oleh siswa (kelas 4 sampai dengan kelas 12) untuk kepentingan Sukses UTS , UAS, US/M, UN/USBN dan  SBMPTN.  Di lengkapi dengan puluhan ribu soal yang prediktif beserta  pembahasan yang terstruktur dan jelas (teks maupun video) </p>
          </div>
        </div>

        <div class="reason-content">
          <div class="left"><img src="<?php echo base_url('assets/pg_user/images/custom/why3.jpg');?>"></div>
          <div class="right">
            <h6><b>Kuis dan Latihan</b></h6>
            <p>Ingin menguji kemampuanmu? Ikuti latihan soal disetiap
            Sub-Bab dan Bab. Lengkap beserta video
            penjabaran dan ulasan.</p>
          </div>
        </div>
      </div>
    </section>
    
    <section class="materi-wrapper">
      <h4>Apa Saja Materi di <b>Prime Mobile?</b></h4>
      <div class="materi-container">
        <div class="materi-content">
          <center><img src="<?php echo base_url('assets/dashboard/images/sd.jpg');?>" style="width:60%;"></center>
          <div class="caption text-center">
            <h6>SD/MI</h6>
            <p class="text-center">Matematika Kelas 4 - 6<br/>
            IPA Kelas 4 - 6<br/>
            Bahasa Indonesia Kelas 4 - 6<br/>
            IPS Kelas 4 - 6<br/>
           </p>
            <a href="">Lebih Lengkap</a>
          </div>
        </div>

        <div class="materi-content">
          <center><img src="<?php echo base_url('assets/dashboard/images/smp.jpg');?>" style="width:60%;"></center>
          <div class="caption text-center">
            <h6>SMP/MTs</h6>
            <p class="text-center">Matematika Kelas 7 - 9<br/>
            Fisika Kelas 7 - 9<br/>
            Kimia Kelas 7 - 9<br/>
            Biologi Kelas 7 - 9<br/>
            Bahasa Indonesia Kelas 7 - 9<br/>
            Bahasa Inggris Kelas 7 - 9</p>
            <a href="">Lebih Lengkap</a>
          </div>
        </div>

        <div class="materi-content">
          <center><img src="<?php echo base_url('assets/dashboard/images/sma.jpg');?>" style="width:60%;"></center>
          <div class="caption text-center">
            <h6>SMA/MA</h6>
            <p class="text-center">Matematika Kelas 10 - 12<br/>
            Fisika Kelas 10 - 12<br/>
            Kimia Kelas 10 - 12<br/>
            Biologi Kelas 10 - 12<br/>
            B. Indonesia Kelas 10 - 12<br/>
            B. Inggris Kelas 10 - 12<br/>
            Geografi Kelas 10 - 12<br/>
            Sejarah Kelas 10 - 12<br/>
            Sosiologi Kelas 10 - 12</p>

            <a href="">Lebih Lengkap</a>
          </div>
        </div>
	
	<!--
        <div class="materi-content">
          <img src="<?php echo base_url('assets/dashboard/images/smk.jpg');?>">
          <div class="caption text-center">
            <h6>SMK</h6>
            <p class="text-center">Matematika Kelas 10 - 12<br/>
            Fisika Kelas 10 - 12<br/>
            B. Inggris Kelas 10 - 12<br/>
            B. Indonesia Kelas 10 - 12<br/>
            Fisika Kelas 10 - 12<br/>
            Kimia Kelas 10 - 12<br/>
            Biologi Kelas 10 - 12</p>
            <a href="">Lebih Lengkap</a>
          </div>
        </div>
        -->
        
      </div>
    </section>
    <section class="home-video-wrapper">
      <h4>Bimbingan Belajar Online <span class="red">Integrative Pertama di Indonesia</span></h4>
      <h5>Satu-satunya Bimbingan Belajar Online yang terintegrasi dengan semua komponen pembelajaran</h5>
      <div class="home-video-container">
        <div class="home-video">
          <div class="content">
            <h2>Materi SD/MI Kelas 4, 5, 6</h2>
            <p>Dapatkan akses penuh 4 mata pelajaran ( Matematika,
            IPA, Bahasa Indonesia dan IPS ),
            3216 topik dan 19.600 soal-soal latihan, TryOut dan
            Soal US/M terdahulu ( 2009 - 2016 ).</p>
            <p class="comment">“saya bisa belajar lewat HP, loh... kan ada Prime Mobile, jadi bisa belajar setiap saat”</p>
            <div class="user">
			
              <img class="picture" src="<?php echo base_url('assets/dashboard/images/profile.jpg');?>">
              <div class="name">
                <h5>Widyawati</h5>
                <h6>Siswa SDN Tegalrejo 3 Yogyakarta</h6>
              </div>
            </div>
          </div>
          <a href="#" data-toggle="modal" data-target="#modalvideo1"><img src="<?php echo base_url('assets/img/poster1.png');?>" class="video" /></a>
		  <!--
          <video class="video" controls alt="Bahasa Indonesia Kelas 6 SD" src="<?php echo base_url('assets/uploads/sample/BIND6-7.1.mp4');?>" poster="<?php echo base_url('assets/img/poster1.png');?>"></video>
		  -->
          <!--<video class="video" id="video" x-webkit-airplay="allow" controls alt="Example File" src="http://45.64.97.197:1935/TestVOD/mp4:BI4-1.01.mp4/manifest.mpd"></video>-->
        </div>

        <div class="home-video2">
          <div class="content">
            <h2>Materi SMP/MTs Kelas 7, 8, 9</h2>
            <p>Dapatkan akses penuh 8 mata pelajaran ( Matematika,
            Fisika, Kimia, Biologi, Bahasa Inggris, Bahasa Indonesia, Ekonomi, Sejarah, dan Geografi ),
            4213 topik dan 21.100 soal-soal latihan, TryOut dan
            Soal UN terdahulu ( 2009 - 2016 ).</p>
            <p class="comment">“Tidak pernah merasa belajar senyaman ini. Penjelasan
            tentor Prime Mobile sangat jelas membantu pendampingan belajar
            guru- guru di sekolah. Materi belajar bisa
            dipelajari berulang-ulang”</p>
            <div class="user">
              <img class="picture" src="<?php echo base_url('assets/dashboard/images/profile.jpg');?>">
              <div class="name">
                <h5>Tasya</h5>
                <h6>Siswi SMP Al-Azhar Yogyakarta</h6>
              </div>
            </div>
          </div>
          <a href="#" data-toggle="modal" data-target="#modalvideo2"><img src="<?php echo base_url('assets/img/poster2.png');?>" class="video" /></a>
		  <!--
          <video class="video" controls alt="Matematika Kelas 9 SMP" src="<?php echo base_url('assets/uploads/sample/MTK9-9.1.mp4');?>" poster="<?php echo base_url('assets/img/poster2.png');?>"></video>
		  -->
          <!--<video class="video" id="video2" x-webkit-airplay="allow" controls alt="Example File" src="http://45.64.97.197:1935/TestVOD/mp4:BI4-1.01.mp4/manifest.mpd"></video>-->
        </div>
      </div>
      <div class="home-video-container">
        <div class="home-video">
          <div class="content">
            <h2>Materi SMA/MA Kelas 10, 11, 12</h2>
            <p>Dapatkan akses penuh materi dan soal-soal latihan lengkap dengan pembahasan (teks dan video) untuk UTS, UAS, UN dan SBMPTN.</p>
            <p class="comment">“dari Prime Mobile aku bisa dapatkan materi yang berkualitas apalagi soal-soal SBMPTN-nya, prediktif banget, keren!”</p>
            <div class="user">
			
              <img class="picture" src="<?php echo base_url('assets/dashboard/images/profile.jpg');?>">
              <div class="name">
                <h5>Misaki</h5>
                <h6>Siswi SMAN 8 Yogyakarta</h6>
              </div>
            </div>
          </div>
          <a href="#" data-toggle="modal" data-target="#modalvideo3"><img src="<?php echo base_url('assets/img/poster3.png');?>" class="video" /></a>
		  <!--
          <video class="video" controls alt="KIMIA Kelas 10 SMA" src="<?php echo base_url('assets/uploads/sample/KIM10-7.5.mp4');?>" poster="<?php echo base_url('assets/img/poster3.png');?>"></video>
		  -->
          <!--<video class="video" id="video" x-webkit-airplay="allow" controls alt="Example File" src="http://stream.primemobile.co.id:1935/TestVOD/mp4:BI4-1.01.mp4/manifest.mpd"></video>-->
        </div>

    </section>

    <section class="home-question-wrapper">
      <h4><span class="red">Pertanyaan</span> yang Sering Diajukan</h4>
      <div id="myCarousel" class="carousel slide home-question-container" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
          <div class="home-question item active">
            <h6>Apa manfaat riil Prime Mobile bagi siswa secara akademis ?</h6>
            <p>Belajar dengan Prime Mobile sangat bermanfaat membantu penguasaan teori dasar pelajaran dan membantu meningkatkan kompetensi akademik. Dengan mempelajari teori dan banyak berlatih mengerjakan soal, kompetensi akademik siswa : (C1) ingatan, (C2) pemahaman, (C3) aplikasi, (C4) analisa, (C5) sintesa dan (C6) evaluasi akan selalu terasah.</p>
          </div>
		  <div class="home-question item">
			<h6>Apa keunggulan Prime Mobile ?</h6>
			<p>Keunggulan belajar dengan Prime Mobile adalah berisi materi-materi must know (wajib diketahui) oleh siswa . Materi must know dari KTSP maupun Kurikulum 2013 ada dalam Prime Mobile ini dalam bentuk irisan maupun gabungan dari kurikulum yang berlaku. Sehingga Prime Mobile adalah satu2nya media belajar online yang dikemas untuk bisa meningkatkan prestasi siswa sekolah dengan KTSP maupun Kurikulum 2013</p>
		  </div>
		  <div class="home-question item">
			<h6>Apa isi / content Prime Mobile ?</h6>
			<p>Secara akademis Prime Mobile berisi Materi semua kebutuhan siswa Indonesia untuk berprestasi, mulai dari kelas 4 SD sampai dengan 12 SMA yakni berupa :</p>
			<ol>
				<li style="color: white;">Materi Teori  Dasar pilihan</li>
				<li style="color: white;">Latihan soal per Sub Bab Materi</li>
				<li style="color: white;">Video Pembelajaran per bab</li>
				<li style="color: white;">Pembahasan Teks per sub bab</li>
			</ol>
			<p style="color: white;">
			Sehingga siswa secara akademik akan terbantu kebutuhannya dengan belajar lewat Prime Mobile dan bisa diakses kapanpun selama 24 jam</p>
		  </div>
		  <div class="home-question item">
			<h6>Siapa yang membutuhkan Prime Mobile ?</h6>
			<p>Prime Mobile dibutuhkan untuk siswa ( kelas 4-6 SD/MI/sederajat, kelas 7-9 SMP/MTs / sederajat , kelas 10-12 SMA/MA/ sederajat ), yang ingin memastikan diri dalam menguasai materipelajaran, menguasasi berbagai jenis soal dan ingin sukses dalam ujian evaluasi maupun seleksi.</p>
		  </div>
		  <div class="home-question item">
			<h6>Untuk menghadapi kesiapan siswa apa yang disediakan oleh Prime Mobile ?</h6>
			<p>Prime Mobile menyiapkan para siswa untuk berprestasi bersama guru dan orang tua serta siap menghadapi segala evaluasi, seperti : <b>UTS, UAS, US/M, UN, SNMPTN-SBMPTN</b></p>
		  </div>
		  <div class="home-question item">
			<h6>Apakah Prime Mobile bisa membantu siswa dalam mempersiapkan SBMPTN ?</h6>
			<p>Dalam Prime Mobile kalian bisa mendapatkan soal-soal SBMPTN tahun-tahun sebelumnya lengkap dengan pembahasannya. Prime Mobile juga menyediakan soal-soal prediktif yang akan muncul di SBMPTN juga lengkap dengan pembahasannya.
Tahukah kalian bahwa pada  tahun lalu ada 85% soal-soal Prime keluar di SBMPTN , dan seluruh siswa Prime LULUS SBMPTN.</p>
		  </div>
          <div class="home-question item">
            <h6>Apakah saya bisa menggunakan smartphone untuk mengakses Prime Mobile?</h6>
            <p>Tentu saja bisa! Kamu bisa menggunakan smartphone, tablet ataupun desktop untuk mengakses Prime Mobile secara online dengan gadget apapun yang paling kamu suka untuk belajar!</p>
          </div>
        </div>

      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </section>
<!-- MODAL VIDEO 1  -->
<!-- ################  -->
<div class="modal fade" id="modalvideo1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Video Pembahasan Bahasa Indonesia Kelas 6 SD</h4>
      </div>
      <div class="modal-body">
		<video style="width: 100%;" controls alt="Bahasa Indonesia Kelas 6 SD" src="<?php echo base_url('assets/uploads/sample/BIND6-7.1.mp4');?>" poster="<?php echo base_url('assets/img/poster1.png');?>"></video>
      </div>
    </div>
  </div>
</div>
<!-- END MODAL VIDEO 1  -->
<!-- ################  -->

<!-- MODAL VIDEO 2  -->
<!-- ################  -->
<div class="modal fade" id="modalvideo2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Video Pembahasan Matematika Kelas 9 SMP</h4>
      </div>
      <div class="modal-body">
		<video style="width: 100%;" controls alt="Matematika Kelas 9 SMP" src="<?php echo base_url('assets/uploads/sample/MTK9-9.1.mp4');?>" poster="<?php echo base_url('assets/img/poster2.png');?>"></video>
      </div>
    </div>
  </div>
</div>
<!-- END MODAL VIDEO 2  -->
<!-- ################  -->

<!-- MODAL VIDEO 3  -->
<!-- ################  -->
<div class="modal fade" id="modalvideo3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Video Pembahasan Kimia Kelas 10 SMA</h4>
      </div>
      <div class="modal-body">
		<video style="width: 100%;" controls alt="KIMIA Kelas 10 SMA" src="<?php echo base_url('assets/uploads/sample/KIM10-7.5.mp4');?>" poster="<?php echo base_url('assets/img/poster3.png');?>"></video>
      </div>
    </div>
  </div>
</div>
<!-- END MODAL VIDEO 3  -->
<!-- ################  -->
<div class="col-sm-12 text-center" style="position: fixed; bottom: 0px; z-index: 999999999999;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <a href="<?php echo base_url('beli-paket');?>">
  <img class="img img-responsive" src="<?php echo base_url('assets/promo/diskon70.jpg');?>" />
  </a>
</div>
    <?php include('footer.php');?>

<!-- promo -->

<!-- end promo -->
  <!--<script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>-->
  
  <script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>" defer></script>
  
  <script type="text/javascript" charset="utf-8">
    $(window).load(function(){
 
    });
  </script>
	<!--<script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/form-validator/formValidation.js');?>" defer></script>-->
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/form-validator/bootstrap.js');?>" defer></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery.steps.min.js');?>" defer></script>
    <script type="text/javascript" src="<?php echo base_url('assets/dashboard/js/init.js');?>" defer></script>
    <script type="text/javascript" src="<?php echo base_url('assets/dashboard/maximage/lib/js/jquery.maximage.min.js');?>" defer></script>
    <script type="text/javascript" src="<?php echo base_url('assets/dashboard/maximage/lib/js/jquery.cycle.all.js');?>" defer></script>
	
	
	<!-- SCRIPT UNTUK SLIDER -->
	<script type="text/javascript" charset="utf-8">
    $(window).bind("load resize", function() {
        $('.popup-materi-container .content').css({'height':$.Window.height()-250});
      
    });
    $(window).load(function() {
      $('#maximage')
        .maximage({
          cycleOptions: {
            fx:'fade',
            timeout: 6000,
        }
      });
    });

    $(document).ready(function(){
      $("#myCarousel").carousel({interval: false});
    });
  </script>
  
	<!-- END SCRIPT SLIDER -->


    <!-- Data Pribadi -->
    <script type="text/javascript">
      $(document).ready(function() {
        function adjustIframeHeight() {
          var $body   = $('body'),
            $iframe = $body.data('iframe.fv');
          if ($iframe) {
            // Adjust the height of iframe
            $iframe.height($body.height());
          }
        }

        // IMPORTANT: You must call .steps() before calling .formValidation()
        $('#profileForm')
          .steps({
            headerTag: 'h2',
            bodyTag: 'section',
            onStepChanged: function(e, currentIndex, priorIndex) {
              // You don't need to care about it
              // It is for the specific demo
              adjustIframeHeight();
            },
            // Triggered when clicking the Previous/Next buttons
            onStepChanging: function(e, currentIndex, newIndex) {
              var fv         = $('#profileForm').data('formValidation'), // FormValidation instance
                // The current step container
                $container = $('#profileForm').find('section[data-step="' + currentIndex +'"]');

              // Validate the container
              fv.validateContainer($container);

              var isValidStep = fv.isValidContainer($container);
              if (isValidStep === false || isValidStep === null) {
                // Do not jump to the next step
                return false;
              }

              return true;
            },
            // Triggered when clicking the Finish button
            onFinishing: function(e, currentIndex) {
              var fv         = $('#profileForm').data('formValidation'),
                $container = $('#profileForm').find('section[data-step="' + currentIndex +'"]');

              // Validate the last step container
              fv.validateContainer($container);

              var isValidStep = fv.isValidContainer($container);
              if (isValidStep === false || isValidStep === null) {
                return false;
              }

              return true;
            },
            onFinished: function(e, currentIndex) {
              // Uncomment the following line to submit the form using the defaultSubmit() method
              $('#profileForm').formValidation('defaultSubmit');

              // For testing purpose
              // $('#welcomeModal').modal();
            }
          })
          .formValidation({
            icon: {
              valid: 'glyphicon glyphicon-ok',
              invalid: 'glyphicon glyphicon-remove',
              validating: 'glyphicon glyphicon-refresh'
            },
          
            // This option will not ignore invisible fields which belong to inactive panels
            excluded: ':disabled',
            fields: {
              namalengkap: {
                validators: {
                  notEmpty: {
                    message: 'Nama Lengkap harus diisi'
                  }
                }
              },
              pengguna: {
                validators: {
                  notEmpty: {
                    message: 'Username harus diisi'
                  },
                  stringLength: {
                    min: 6,
                    max: 30,
                    message: 'Username minimal 6 karakter dan maksimal 30 karakter'
                  },
                  regexp: {
                    regexp: /^[a-zA-Z0-9_\.]+$/,
                    message: 'Username hanya terdiri dari alfabet, nomor, titik dan underscore'
                  },
                  remote: {
                    message: "Username telah terdaftar dalam database",
                    url: "<?php echo base_url('signup/ajax_cek_username'); ?>",
                    type: "post",
                    delay: 1000
                  }
                }
              },
              email: {
                validators: {
                  notEmpty: {
                    message: 'E-Mail harus diisi'
                  },
                  emailAddress: {
                    message: 'E-Mail tidak valid'
                  },
                  remote: {
                    message: "E-mail telah terdaftar dalam database",
                    url: "<?php echo base_url('signup/ajax_cek_email'); ?>",
                    type: "post",
                    delay: 1000
                  }
                }
              },
              nohp: {
                message: 'Nomor telepon tidak valid',
                validators: {
                  notEmpty: {
                    message: 'Nomor telepon harus diisi'
                  },
                  numeric: {
                    message: 'Nomor telepon harus berbentuk angka'
                  }
                }
              },
              nohp_ortu: {
                message: 'Nomor telepon tidak valid',
                validators: {
                  notEmpty: {
                    message: 'Nomor telepon harus diisi'
                  },
                  numeric: {
                    message: 'Nomor telepon harus berbentuk angka'
                  }
                }
              },
              katasandi: {
                validators: {
                  notEmpty: {
                    message: 'Password harus diisi'
                  },
                  different: {
                    field: 'username',
                    message: 'Password tidak boleh sama dengan nama pengguna'
                  }
                }
              },
              konfirmasi: {
                validators: {
                  notEmpty: {
                    message: 'Konfirmasi Password harus diisi'
                  },
                  identical: {
                    field: 'katasandi',
                    message: 'Konfirmasi Password harus sama dengan Password yang dimasukkan'
                  }
                }
              }
            }
          });
      });
      </script>
  </body>
</html>
