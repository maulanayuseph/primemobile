<?php include('header_dashboard.php'); ?>

    <div class="container-fluid akun-container">
			<div class="col-lg-12">
        <div class="row">
          <div class="col-md-6">
            <?php echo $this->session->flashdata('alert'); ?>
          </div>
        </div>           
				<div class="row well">
          <div class="col-md-12" style="margin-bottom: 20px;">
						<h4>Silahkan Masukkan Voucher dan Nomor Aktivasi anda di sini</h4>
					</div>
          <div class="col-md-4">
            <form role="form" action="<?php echo base_url('user/do_aktivasi')?>" method="post">
              <div class="form-group">
                <input type="text" name="kode_voucher" id="kode_voucher" class="form-control" placeholder="Masukkan Kode Voucher" maxlength="20" required='required'>
              </div>
              <div class="form-group">
                <input type="text" name="kode_aktivasi" id="kode_aktivasi" class="form-control" placeholder="Masukkan Nomor Aktivasi" maxlength="20" required='required'>
              </div>
              <div class="form-group">
                <select data-placeholder="Pilih Kelas..." name="kelas" id="kelas" class="form-control">
                  <option value="0" disabled selected>Pilih kelas...</option>
                  <?php 
                  foreach ($select_options as $item) { ?>
                    <option value="<?php echo $item->id_kelas ?>" <?= $this->session->userdata('kelas') == $item->id_kelas ? 'selected' : '' ?>> <?php echo $item->alias_kelas ?> </option>
                  <?php } ?>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <br>
            <?php echo form_error('kode_voucher', '<div class="text-danger">', '</div>'); ?>
            <?php echo form_error('kelas', '<div class="text-danger">', '</div>'); ?>

            <hr>
            <p>
              Belum punya kode voucher? Beli paket <a href="<?php echo base_url('user/beli')?>">disini</a>.
            </p>
            <p>
              Butuh bantuan aktivasi voucher? Hubungi kami di <a href="mailto:cs@primegeneration.co.id">cs@primegeneration.co.id</a>
            </p>
          </div>
					<div class="col-md-8">&nbsp;</div>
        </div>           
      </div>
    </div>
    
    <?php include('footer.php');?>
    
    <!-- Javascript -->
    <!-- Javascript -->
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/npm.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/retina.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js');?>"></script>
		<script type="text/javascript">
		function isNumber(evt)
		{  
			evt = (evt) ? evt : window.event;
			var charCode = (evt.which) ? (evt.which) : evt.keyCode;
			if (charCode > 31 && (charCode < 48 || charCode > 57)) {
				return false;
			}
			return true;
		}
		</script>
		<script src="<?php echo base_url('assets/dashboard/js/init.js');?>"></script>
		<?php include('modal_profil.php'); ?>
  </body>
</html>
