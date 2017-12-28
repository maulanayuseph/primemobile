<?php include('header_dashboard.php'); ?>

    <div class="container-fluid akun-container">
			<div class="col-lg-12">
        <div class="row row-login well">
          <?php if(empty($_SESSION['akses']))
          { ?>
          <div class="row">
            <div class="akses-notif col-sm-12">
              <h4 class="alert alert-info">
                Kamu belum memiliki paket bimbel. Agar dapat mengakses konten premium, segera pilih paketmu 
                <a href="<?php echo base_url('user/beli')?>" class="label label-info label-lg">DI SINI</a>
              </h4>
            </div>
          </div>
          <?php 
          } ?>

          <div class="row">
            <div class="col-sm-3">
							<div class="profil-detail">
								<div class="picture">
									<?php 
										$foto = $data_user->foto ? $data_user->foto : 'default.jpg';
									?>
									<img src="<?php echo base_url('assets/uploads/foto_siswa/'.$foto);?>" width="376" height="500" alt="Foto Profil Siswa Prime Mobile" class="img-responsive">
								</div>
							</div>
						</div>
            <div class="col-sm-9">
							<div class="row ptb0rl10">
								<div class="col-sm-4 p10 bgw"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span> <strong>Nama</strong></div>
								<div class="col-sm-8 p10 bgw"><?php echo $data_user->nama_siswa ? $data_user->nama_siswa : 'No name'?></div>
							</div>
							<div class="row ptb0rl10">
								<div class="col-sm-4 p10"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <strong>Email</strong></div>
								<div class="col-sm-8 p10"><?php echo $data_user->email ? $data_user->email : '-'?></div>
							</div>
							<div class="row ptb0rl10">
								<div class="col-sm-4 p10 bgw"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <strong>Username</strong></div>
								<div class="col-sm-8 p10 bgw"><?php echo $data_user->username ? $data_user->username : '-';?></div>
							</div>
							<div class="row ptb0rl10">
								<div class="col-sm-4 p10"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> <strong>No. Telepon Siswa</strong></div>
								<div class="col-sm-8 p10"><?php echo $data_user->telepon ? $data_user->telepon : '-';?></div>
							</div>
							<div class="row ptb0rl10">
								<div class="col-sm-4 p10 bgw"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> <strong>No. Telepon Orang Tua</strong></div>
								<div class="col-sm-8 p10 bgw"><?php echo $data_user->telepon_ortu ? $data_user->telepon_ortu : '-';?></div>
							</div>
							<div class="row ptb0rl10">
								<div class="col-sm-4 p10"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> <strong>Sekolah</strong></div>
								<div class="col-sm-8 p10"><?php echo $data_user->nama_sekolah ? $data_user->nama_sekolah : '-';?></div>
							</div>
							<div class="row ptb0rl10">
								<div class="col-sm-4 p10 bgw"><span class="glyphicon glyphicon-signal" aria-hidden="true"></span> <strong>Kelas</strong></div>
								<div class="col-sm-8 p10 bgw"><?php echo $data_user->tingkatan_kelas ? $data_user->tingkatan_kelas : '-';?></div>
							</div>
							<div class="row ptb0rl10">
								<div class="col-sm-4 p10 bgw"><span class="glyphicon glyphicon-folder-close" aria-hidden="true"></span> <strong>Kurikulum</strong></div>
								<div class="col-sm-8 p10 bgw"><?php echo $data_user->kurikulum ? $data_user->kurikulum : '-';?></div>
							</div>
							<div class="row ptb0rl10">
								<div class="col-sm-12 p10">&nbsp;</div>
							</div>
						</div>
						<div class="row ptb0rl10">
							<div class="col-sm-9">&nbsp;</div>
							<div class="col-sm-3">
								<a href="<?php echo base_url('user/ubah_profil')?>" class="btn btn-warning btn-block"><span class="glyphicon glyphicon-cog"></span> Edit Profil</a>
							</div>
						</div>
					</div>
					
        </div>
      </div>        
    </div>
    
    <?php include('footer.php');?>
    
    <!-- Javascript -->
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js');?>"></script>
		
		<script src="<?php echo base_url('assets/dashboard/js/init.js');?>"></script>
		<?php include('modal_profil.php'); ?>
		
  </body>
</html>
