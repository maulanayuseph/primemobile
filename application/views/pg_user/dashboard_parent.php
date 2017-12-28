<?php include('header_dashboard.php'); ?>
<script>
$(function(){
	$("#kelas").change(function(){
		$("#profil").load("profil/" + $("#kelas").val());
	});
	$("#profil").change(function(){
		$("#tryout").load("tryout/" + $("#profil").val());
	});
	$("#pilihkelas").change(function(){
		$("#pilihmapel").load("pilihmapel/" + $("#pilihkelas").val());
	});
	$("#pilihmapel").change(function(){
		$("#materi").load("materi/" + $("#pilihmapel").val());
	});
});
</script>

    <div class="container-fluid akun-container">
	<div class="col-lg-12">
	  <div class="agcu-welcome">
        <div class="content">
          <h4>Selamat Datang, <?php echo $infosiswa->nama_siswa; ?></h4>
          <p>Ketahui tipe kepribadian, kondisi psikologis, potensi akademik dan minat belajar siswa dengan meilhat analisis Academic General Check Up (AGCU) Test. Dengan mengikuti AGCU test, siswa akan mendapatkan saran metode belajar yang sesuai dengan tipe kepribadian yang anda miliki. </p>
          <a href="../agcutest" class="btn btn-primary">Lihat Analisis Siswa</a>
        </div>
        <img class="image" src="<?php echo base_url('assets/dashboard/images/why2.jpg'); ?>" style="float: right;">
      </div>
	  <p>&nbsp;
        
	
	<div class="col-lg-12">
	  <div class="tabel-analisa waktu">
	  <div class="title"><img src="<?php echo base_url('assets/dashboard/images/file.png'); ?>">Try Out | <a href="../user/liveskor">Lihat Rangking Siswa</a></div>
	  </div>
	</div>
	<form action="statistiknilai" method="get">
	<div class="col-lg-12">
      <div class="profile-option">
        <div class="title">PILIH KELAS</div>
        <select class="form-control" id="kelas">
			<option value="semua">--- Pilih Kelas ---</option>
          <?php
			foreach($kelasaktif as $kelas){
		?>
			<option value="<?php echo $kelas->id_kelas; ?>"><?php echo $kelas->alias_kelas; ?></option>
		<?php
			}
		  ?>
        </select>
      </div>
	  <div class="profile-option">
        <div class="title">PROFIL TRYOUT</div>
        <select class="form-control" id="profil" name="profil" required>
			<option value="">--- Pilih Profil Tryout---</option>
        </select>
      </div>
	  <input class="btn btn-danger" type="submit" value="Lihat Statistik" />
	 </div>
	 </form>
	  <div class="col-lg-12"><p>&nbsp;</div>
	
     <div class="mapel-wrapper" id="tryout">
     </div>
	 
	
	
     <div class="akun-slider">
      <div class="content">
        <h5>HEPPY TRENGGONO</h5>
        <p>LorenThis is Photoshop's version  of Lorem Ipsum. 
        Proin gravida nibh vel velit auctor aliquet. Aenean 
        sollicitudin, lorem quis bibendum auctor, nisi elit 
        consequat ipsum,</p>
        <a href="">SELENGKAPNYA <span class="glyphicon glyphicon-chevron-right"></span></a>
      </div>
      <img class="slider" src="<?php echo base_url('assets/dashboard/images/slide.jpg');?>">
     </div> 

     <div class="akun-video">
    </div>


  <script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>
  
  <script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>"></script>
  <script type="text/javascript" charset="utf-8">
    $(window).load(function(){
 
    });
  </script>
  </body>
</html>