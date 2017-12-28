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
		<div class="col-lg-12" style="text-align: center;">
			<h3>Undang orang tua anda ke Prime Mobile</h3>
			<h4>Daftarkan akun orang tua sehingga mereka dapat mendampingi belajar.</h4>
		</div>
	</div>
	<p>&nbsp;
</div>

<div class="col-lg-12">
	<form action="<?php echo base_url('parents/prosesedit'); ?>" method="post">
	<div class="agcu-welcome">
		<input type="hidden" name="idparent" value="<?php echo $dataortu->id_ortu; ?>"/>
		<p>Nama Orang Tua :
		<input type="text" name="nama" class="form-control"  value="<?php echo $dataortu->nama_ortu; ?>"/>
		<p>&nbsp;
		<p>E-mail :
		<input type="text" name="email" class="form-control" value="<?php echo $dataortu->email; ?>"/>
		<p>&nbsp;
		<p>Telepon :
		<input type="text" name="telepon" class="form-control" value="<?php echo $dataortu->telepon; ?>"/>
		<p>&nbsp;
		<p>Username :
		<input type="text" name="username" class="form-control" value="<?php echo $dataortu->username; ?>"/>
		<p>&nbsp;
		<p>Password lama :
		<input type="password" name="old-password" class="form-control"/>
		<p>&nbsp;
		<p>Password baru :
		<input type="password" name="password" class="form-control" />
		<p>Ulangi password baru :
		<input type="password" name="re-password" class="form-control" />
		<p>&nbsp;
		<p><input type="submit" class="btn btn-primary" value="SIMPAN"/>
	</div>
	</form>
</div>
<!--
<div class="col-lg-6">
	<div class="agcu-welcome">
		<div class="col-lg-6">
			<img src="<?php echo base_url('assets/pg_user/images/ortu/ortu1.png'); ?>" class="img-responsive">
		</div>
		<div class="col-lg-6">
			<h4>Pemantauan proses belajar</h4>
			<p>Tertarik untuk mengetahui proses belajar siswa? Anda dapat mengeceknya dimana saja, kapan saja!
		</div>
		<div class="col-lg-6">
			<img src="<?php echo base_url('assets/pg_user/images/ortu/ortu2.png'); ?>" class="img-responsive">
		</div>
		<div class="col-lg-6">
			<h4>Pemantauan proses belajar</h4>
			<p>Tertarik untuk mengetahui proses belajar siswa? Anda dapat mengeceknya dimana saja, kapan saja!
		</div>
	</div>
</div>
-->
</div>


  <script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>
  
  <script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>"></script>
  <script type="text/javascript" charset="utf-8">
    $(window).load(function(){
 
    });
  </script>
  </body>
</html>