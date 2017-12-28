<?php include('header_dashboard.php'); ?>

<?php
$x = 0;
$y = 0;
foreach($jumlahsoaldiagnostic as $jumlahsoal){
	foreach($jumlahsoaldikerjakan as $jumlahdikerjakan){
		if($jumlahdikerjakan->id_diagnostic == $jumlahsoal->id_diagnostic){
			if($jumlahsoal->jumlah_soal == $jumlahdikerjakan->jumlah){
				$iddiagnostic[$jumlahsoal->id_diagnostic] = 'selesai';
				$y += 1;
			}
		}
	}
	$x += 1;
}
if($x == $y){
	$statdiag = 'selesai';
}else{
	$statdiag = 'tidak selesai';
}
?>
    <div class="container-fluid agcu-container">
      <div class="agcu-welcome">
        <div class="content">
          <h4>Selamat Datang, <?php echo $infosiswa->nama_siswa; ?></h4>
          <p>Ketahui tipe kepribadian, kondisi psikologis, potensi akademik dan minat belajar anda dengan mengikuti Academic General Check Up (AGCU) Test. Dengan mengikuti AGCU test, anda akan mendapatkan saran metode belajar yang sesuai dengan tipe kepribadian yang anda miliki. </p>
			<?php
				if($statdiag == 'selesai' and $hasileq == 1 and $hasills == 1){
			?>
			<a href="<?php echo base_url();?>agcutest/statistik_by_profil/<?php echo $idprofildiagnostic;?>" class="btn btn-primary">Lihat Statistik Nilai</a>
			<?php
				}else{
			?>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Lihat Statistik Nilai</button>
			<?php
				}
			?>
        </div>
        <img class="image" src="<?php echo base_url('assets/dashboard/images/why2.jpg'); ?>" style="float: right;">
      </div>

     <div class="agcu-box-wrapper">
      <div class="content">
        <h6>Diagnostic Test</h6>
        <p>Diagnostic Test bertujuan untuk mengetahui kemampuan akademik siswa</p>
      </div>
	  
	  <?php foreach($kategoridiagnostic as $diagnostic){
		?>
		<div class="agcu-box-container">
        <div class="header">
		<?php
			foreach($datasoal as $soal){
				if($soal->id_diagnostic == $diagnostic->id_diagnostic){
					echo $soal->jumlah;
				}
			}
		?> Soal
		</div>
        <div class="content">
          <div class="title">
            <h5><?php echo $diagnostic->alias_kelas; ?></h5>
            <h3><?php echo $diagnostic->nama_kategori; ?></h3>
            <br>Durasi : <?php echo $diagnostic->durasi ;?> Menit
			
			
			<br>Ketuntasan : <?php echo $diagnostic->ketuntasan ;?>%
          </div>
		  <?php
			if(isset($iddiagnostic[$diagnostic->id_diagnostic])){	
		?>
			<a class="btn btn-default btn-agcu">Selesai</a>
		<?php
			}else{
		?>
			<a href="<?php echo base_url("agcutest/mulaidiagnostic");?>/<?php echo $diagnostic->id_diagnostic;?>" class="btn btn-default btn-agcu">Mulai Test</a>
		<?php
			}
		?>
          
        </div>
      </div>
		<?php
	  }
		?>
     </div>
     <div class="agcu-content">
      <h4>Psychology Potential Test</h4>
      <p>Psychology Potential Test bertujuan untuk mengetahui kemampuan siswa untuk menerima, menilai, mengelola, serta mengontrol emosi dirinya dan orang lain di sekitarnya, mengetahui kesiapan siswa dalam menghadapi tantangan, dan mengetahui seberapa besar motivasi berprestasi siswa</p>
      <?php
			if($hasileq == 0){
		?>
		<a href="<?php echo base_url('agcutest/mulaieqtest');?>" class="btn btn-danger">Mulai Test</a>
		<?php
			}else{
		?>
		<a class="btn btn-success">Selesai</a>
		<?php
			}
		?>
     </div>
     <div class="agcu-content">
      <h4>Learning Style Test</h4>
      <p>Learning Style Test bertujuan untuk mengetahui cara siswa dalam menangkap stimulus atau informasi, cara mengingat, berpikir, dan memecahkan persoalan</p>
      <?php
			if($hasills == 0){
		?>
		<a href="<?php echo base_url('agcutest/mulailstest');?>" class="btn btn-danger">Mulai Test</a>
		<?php
			}else{
		?>
		<a class="btn btn-success">Selesai</a>
		<?php
			}
		?>
     </div>

     
    </div>
    <?php include('footer.php');?>


  <script src="js/jquery1.11.0.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/init.js"></script>
  <div id="edit-profile" class="edit-profile-wrapper">
    <div class="edit-profile-container">
      <div class="header"><img src="images/logo.png"></div>
      <h4>Lengkapi Profil Anda</h4><a href="javascript:;" class="close"><span class="glyphicon glyphicon-remove"></span></a>
      <form id="edit-profile-form" class="edit-profile-form">
        <div class="form-group">
          <div class="label-style required">Nama</div>
          <input class="input-style form-control" type="text" id="name" name="name" placeholder="Nama">
        </div>
        <div class="form-group">
          <div class="label-style">Tanggal Lahir</div>
          <input class="input-style form-control" type="text" id="datebirth" name="datebirth" placeholder="Tanggal Lahir">
        </div>
        <div class="form-group">
          <div class="label-style">Nomor HP</div>
          <input class="input-style form-control" type="text" id="phone" name="phone" placeholder="Nomor HP">
        </div>
        <div class="form-group">
          <div class="label-style required">Email</div>
          <input class="input-style form-control" type="text" id="email" name="email" placeholder="Email">
        </div>
        <div class="form-group">
          <div class="label-style required">Jenis Kelamin</div>
          <select class="form-control input-style" id="gender" name="gender">
              <option value="laki">Laki - laki</option><option value="perempuan">Perempuan</option>               
          </select>
        </div>
        <div class="form-group">
          <div class="label-style required">Alamat (Domisili)</div>
          <input class="input-style form-control" type="text" id="address" name="address" placeholder="Alamat">
        </div>
        <div class="form-group">
          <div class="label-style required">Kelas/Tingkat</div>
          <input class="input-style form-control" type="text" id="class" name="class" placeholder="KELAS XI IPA">
        </div>
        <div class="form-group">
          <div class="label-style required">Sekolah</div>
          <input class="input-style form-control" type="text" id="school" name="school" placeholder="Sekolah">
        </div>
        <div class="form-group">
          <div class="label-style">Ganti Foto</div>
          <input class="input-style" type="file" id="exampleInputFile">
        </div>
        <div class="form-group">
          <div class="label-style">&nbsp;</div>
          <div class="input-style form-thanks">Thank you for submitting your booking with us, this is not a confirmation for your booking, our reservation staff will contact you through your email within 24 hours. Please also check your SPAM or JUNK mail.</div>
        </div>
        <div class="form-group">
          <div class="label-style">&nbsp;</div>
          <button name="csubmit" type="submit" class="btn btn-primary">Submit</button>&nbsp;<button id="Rreset" name="rreset" type="reset" class="btn btn-warning">Reset</button>
        </div>
      </form>
    </div>
  </div>
  
  <script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>
  
  <script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>"></script>
  <script type="text/javascript" charset="utf-8">
    $(window).load(function(){
 
    });
  </script>
  <!-- MODAL JIKA BELUM MELENGKAPI AGCU -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <h4>Anda harus melengkapi semua test untuk melihat statistik nilai</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
  </body>
</html>