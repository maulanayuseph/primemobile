<?php $this->load->view("dashboard/header");?>
<div class="container kontainer-utama">
	<div class="row">
		<div class="col-md-12">
			<div class="col col-banner-user" style="background-image: url('<?php echo base_url('assets/user_dashboard/images/savana.jpg');?>')">

				<div class="ProfileCanopy-avatar">
					<div class="ProfileAvatar">
						<img class="ProfileAvatar-image" src="<?php echo base_url('assets/user_dashboard/images/dPEGczEK_400x400.jpg');?>"/>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="col col-bottom-banner">
			</div>
		</div>
	</div>
	<div class="row row-materi">
		<div class="col-md-3">
			<div class="col-md-12 card left-col">
				<div class="col-lg-12 col-bio">
					<span class="nama">Fajar Trio Wijanarko</span>
					<br>
					<br>
					<div class="bio-desc"><i class="fa fa-location-arrow" aria-hidden="true"></i> <span>Kediri, Jawa Timur</span></div>
					<div class="bio-desc"><i class="fa fa-university" aria-hidden="true"></i> <span>SMAN 1 Kediri</span></div>
				</div>
				<div class="col-lg-12">
					<ul class="nav flex-column">
						<li class="nav-item">
							<a class="nav-link" href="#"><i class="fa fa-book" aria-hidden="true"></i> Materi</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#"><i class="fa fa-pencil" aria-hidden="true"></i> Pengujian Eksternal</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#"><i class="fa fa-briefcase" aria-hidden="true"></i> Tugas Sekolah <span class="badge badge-primary badge-pill">5</span></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#"><i class="fa fa-hourglass-start" aria-hidden="true"></i> CBT</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#"><i class="fa fa-street-view" aria-hidden="true"></i> Penilaian Diri</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#"><i class="fa fa-lock" aria-hidden="true"></i> Bonus</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card center-col">
				<div class="card-header">
					<h5><i class="fa fa-book" aria-hidden="true"></i> Materi Prime Mobile</h5>
				</div>
				<div class="card-body card-body-materi">
					<nav class="nav nav-tabs" id="myTab" role="tablist">
						<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><i class="fa fa-bookmark-o" aria-hidden="true"></i> Materi Saya</a>
						<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fa fa-server" aria-hidden="true"></i> Semua Materi</a>
						<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false"><i class="fa fa-clock-o" aria-hidden="true"></i> Riwayat</a>
					</nav>
					<div class="tab-content" id="nav-tabContent">
						<div class="tab-pane fade show active text-center" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
							<h5>Ayo pilih materi dan mulai belajar!</h5>
							Prime Mobile memiliki beragam konten pembelajaran untuk membantumu belajar!
							<br>
							<br>
							<button role="button" class="btn btn-primary">Pilih Materi</button>
						</div>
						<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
						<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="card right-col">
				<div class="card-header">
					<h5><i class="fa fa-trophy" aria-hidden="true"></i> High Score</h5>
				</div>
				<div class="card-body card-body-materi">
					<ul class="list-group">
						<li class="list-group-item text-center">
							<img src="<?php echo base_url("assets/user_dashboard/images/avatar.png");?>" alt="..." class="img-thumbnail thumbnail-menu">
							<br>Fajar Trio Wijanarko<br>12.000 Poin
						</li>
						<li class="list-group-item text-center">
							<img src="<?php echo base_url("assets/user_dashboard/images/avatar.png");?>" alt="..." class="img-thumbnail thumbnail-menu">
							<br>Untoro Hadi Suharto<br>10.000 Poin
						</li>
						<li class="list-group-item text-center">
							<img src="<?php echo base_url("assets/user_dashboard/images/avatar.png");?>" alt="..." class="img-thumbnail thumbnail-menu">
							<br>Priyoga Ahmad Ridwanto<br>9.000 Poin
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view("dashboard/footer");?>