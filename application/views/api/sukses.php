<html>
	 <head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>API Information</title>

		<link href="<?php echo base_url('assets/dashboard/css/bootstrap.min.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/dashboard/css/style.css');?>" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
		</script>
	</head>
	
	<body>
		<div class="container">
			<div class="row">
				<h3>Informasi Pelanggan Indihome</h3>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Nomor Indihome</th>
							<th>Nama</th>
							<th>Alamat</th>
							<th>No. HP</th>
							<th>Email</th>
							<th>AddOn</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
							<tr>
								<td><?php echo $table_data->no_indihome;?></td>
								<td><?php echo $table_data->nama;?></td>
								<td><?php echo $table_data->alamat;?></td>
								<td><?php echo $table_data->hp;?></td>
								<td><?php echo $table_data->email;?></td>
								<td><?php echo $table_data->addon;?></td>
								<td>Sukses</td>
							</tr>
					</tbody>
				</table>
				<h3>Informasi login</h3>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Nomor Indihome</th>
							<th>Username</th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach($info_login as $login){
						?>
							<tr>
								<td><?php echo $login->no_indihome;?></td>
								<td><?php echo substr($login->username,0,5)."*****";?></td>
							</tr>
						<?php
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>