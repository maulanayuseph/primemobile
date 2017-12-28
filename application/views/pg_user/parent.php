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
	<form action="<?php echo base_url('parents/prosesdaftar'); ?>" method="post">
	<div class="agcu-welcome">
		<table class="table table-striped">
			<tr>
				<td>Nama Orang Tua</td>
				<td>:</td>
				<td><?php echo $infoortu->nama_ortu; ?></td>
			</tr>
			<tr>
				<td>Telepon</td>
				<td>:</td>
				<td><?php echo $infoortu->telepon; ?></td>
			</tr>
			<tr>
				<td>E-Mail</td>
				<td>:</td>
				<td><?php echo $infoortu->email; ?></td>
			</tr>
			<tr>
				<td>Username</td>
				<td>:</td>
				<td><?php echo $infoortu->username; ?></td>
			</tr>
		</table>
		<a class="btn btn-primary" href="parents/edit/<?php echo $infoortu->id_ortu; ?>">Edit</a>
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