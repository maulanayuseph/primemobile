<div class="col-md-4">
	<div class="card card-user">
		<div class="image">
			<img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."/>
		</div>
		<div class="content">
			<div class="author">
				 <?php
				 if($guru->foto_crop !== ""){
					 ?>
					 <img class="avatar border-gray" src="<?php echo $guru->foto_crop;?>" alt="..."/>
					 <?php
				 }else{
					 ?>
					 <img class="avatar border-gray" src="<?php echo base_url("assets/pg_user/images/custom/am.jpg");?>" alt="..."/>
					 <?php
				 }
				 ?>
				  <h4 class="title"><?php echo $guru->nama;?><br />
				  	<br>
					 <small>&nbsp;
						<?php
							echo $sekolah->nama_sekolah;
						?>&nbsp;
					 </small>
					 <br>
					 <br>
				  </h4>
			</div>
			<table class="table table-striped">
				<tr>
					<td>Email</td>
					<td> : </td>
					<td><?php echo $guru->email;?></td>
				</tr>
				<tr>
					<td>HP</td>
					<td> : </td>
					<td><?php echo $guru->hp;?></td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td> : </td>
					<td><?php echo $guru->alamat;?></td>
				</tr>
			</table>
			<p class="description">
				
			</p>
		</div>
		<hr>
		<div class="text-center">
			<a href="<?php echo base_url("psep_sekolah/profil/edit_profil");?>" class="btn btn-simple"><i class="fa fa-pencil" aria-hidden="true"></i></a>
		</div>
	</div>
</div>

<div class="col-md-8">
	<div class="row">
	
		<a href="<?php echo base_url("psep_sekolah/siswa");?>">
		<div class="col-md-4">
			<div class="card hover-menu-dashboard">
				<div class="header text-center">
					<h3 class="title"><i class="fa fa-user" aria-hidden="true"></i></h3>
				</div>
				<div class="content">
					<div class="row">
						<div class="col-sm-12 text-center">
							<strong>Siswa</strong>
						</div>
					</div>
				</div>
			</div>
		</div>
		</a>
		
		<a href="<?php echo base_url("psep_sekolah/agcu/report_siswa");?>">
		<div class="col-md-4">
			<div class="card hover-menu-dashboard">
				<div class="header text-center">
					<h3 class="title"><i class="fa fa-quote-right" aria-hidden="true"></i></h3>
				</div>
				<div class="content">
					<div class="row">
						<div class="col-sm-12 text-center">
							<strong>Report AGCU</strong>
						</div>
					</div>
				</div>
			</div>
		</div>
		</a>
		
		<a href="<?php echo base_url("psep_sekolah/agcu/report_siswa");?>">
		<div class="col-md-4">
			<div class="card hover-menu-dashboard">
				<div class="header text-center">
					<h3 class="title"><i class="fa fa-list-ol" aria-hidden="true"></i></h3>
				</div>
				<div class="content">
					<div class="row">
						<div class="col-sm-12 text-center">
							<strong>Report CBT</strong>
						</div>
					</div>
				</div>
			</div>
		</div>
		</a>
		
		<a href="<?php echo base_url("psep_sekolah/agcu/silabus");?>">
		<div class="col-md-4">
			<div class="card hover-menu-dashboard">
				<div class="header text-center">
					<h3 class="title"><i class="fa fa-tasks" aria-hidden="true"></i></h3>
				</div>
				<div class="content">
					<div class="row">
						<div class="col-sm-12 text-center">
							<strong>Silabus</strong>
						</div>
					</div>
				</div>
			</div>
		</div>
		</a>
		
		<a href="<?php echo base_url("psep_sekolah/pr");?>">
		<div class="col-md-4">
			<div class="card hover-menu-dashboard">
				<div class="header text-center">
					<h3 class="title"><i class="fa fa-tasks" aria-hidden="true"></i></h3>
				</div>
				<div class="content">
					<div class="row">
						<div class="col-sm-12 text-center">
							<strong>Tugas Siswa</strong>
						</div>
					</div>
				</div>
			</div>
		</div>
		</a>
	</div>
</div>