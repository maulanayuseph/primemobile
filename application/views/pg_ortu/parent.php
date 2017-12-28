<?php include('header_dashboard.php'); ?>

<div class="container-fluid akun-container">
<div class="col-lg-12">
	<form>
	<div class="agcu-welcome">
		<h3>Data Orang Tua</h3><hr />
		<table class="table table-striped">
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td><?php echo $infoortu->nama_ortu; ?></td>
			</tr>
			<tr>
				<td>Telepon</td>
				<td>:</td>
				<td><?php echo $infoortu->telepon_ortu; ?></td>
			</tr>
			<tr>
				<td>E-Mail</td>
				<td>:</td>
				<td><?php echo $infoortu->email_ortu; ?></td>
			</tr>
			<tr>
				<td>Username</td>
				<td>:</td>
				<td><?php echo $infoortu->username; ?></td>
			</tr>
		</table>
		<a class="btn btn-primary" href="<?php echo base_url() ?>parents/edit_profil/<?php echo $infoortu->id_ortu; ?>">Edit</a>
	</div>
	</form>
</div>
</div>


<?php include('footer.php'); ?>

  <script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>
  
  <script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>"></script>
  <script type="text/javascript" charset="utf-8">
    $(window).load(function(){
 
    });
  </script>
  </body>
</html>
