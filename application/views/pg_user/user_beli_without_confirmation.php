<?php include('header_dashboard.php'); ?>

	<div class="container-fluid akun-container">
		<div class="col-lg-12 well">
      <form action="<?php echo base_url().'user/do_beli' ;?>" method="post">
        <div class="pay-list">
          <h3>PAKET REGULER</h3>
          <div class="table-responsive bayar-table">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Kode</th>
                  <th>Pilihan Voucher</th>
                  <th>Harga Satuan</th>
                </tr>
              </thead>

              <tbody>
                <?php
                $jml_paket = 10;
                foreach ($data_reguler as $item) 
                { ?>

                <tr>
                  <td><?php echo $item->kode_paket;?></td>
                  <td>Reguler <?php echo $item->durasi;?> bulan</td>
                  <td>Rp <?php echo number_format($item->harga);?>-</td>
                </tr>
                <?php
                } ?>
              </tbody>
            </table>
          </div>
        
          <hr>

	  <? /*
          <h3 class="text-blue">Paket Premium</h3>
          <div class="table-responsive bayar-table blue">
            <table class="table table-striped">
               <thead>
                <tr>
                  <th>Kode</th>
                  <th>Pilihan Voucher</th>
                  <th>Harga Satuan</th>
                  <th>Jumlah</th>
                </tr>
              </thead>

              <tbody>
               <?php
                foreach ($data_premium as $item) 
                { ?>
                <tr>
                  <td><?php echo $item->kode_paket;?></td>
                  <td>Premium <?php echo $item->durasi;?> bulan</td>
                  <td>Rp <?php echo number_format($item->harga);?>-</td>
                  <td>
                    <select class="option-style" name="paket_<?php echo $item->id_paket;?>">
                     <option value="">0</option>
                      <?php for($jml=1; $jml<=$jml_paket; $jml++)
                      { ?>
                        <option value="<?php echo $jml;?>"><?php echo $jml;?></option>
                      <?php 
                      } ?>
                    </select> buah
                  </td>
                </tr>
                <?php
                } ?>
              </tbody>
            </table>
          </div>
          */ ?>
        </div>

        

        <div class="pay-method">
          <div class="row">
            <div class="col-sm-12 center">
              <h3>Cara Pembelian Voucher</h3>
              <div class="col-sm-12" style="text-align: left;">
				<ol>
					<li>Lakukan pembayaran ke rekening <b>Bank Mandiri : 0700007446284 a.n PT. Prima Generasi Bimbingan belajar</b>
					<br>&nbsp;
					</li>
					<li>Setelah anda melakukan pembayaran, kirim email ke : konfirmasi@primemobile.co.id dengan menyebutkan informasi sebagai berikut disertai dengan bukti transfer
						<ul>
							<li>Nama lengkap</li>
							<li>Nomor Handphone</li>
							<li>Email</li>
							<li>Jumlah transfer (Lampirkan bukti transfer)</li>
							<li>Keterangan voucher yang dibeli<br>&nbsp;</li>
							
							<li>Contoh email konfirmasi: 
								<br>David Hermawan
								<br>08123456789 
								<br>david@gmail.com 
								<br>Rp. 650.000,-
								<br>Voucher 1 bulan (2 item), Voucher 3 bulan (1 item)
							</li>
						</ul>
						<br>&nbsp;
					</li>
					<li>
						Sales admin kami akan mengirimkan kode aktivasi ke email anda setelah melakukan verifikasi
					</li>
				</ol>
			  </div>
            </div>
          </div>


		<!--
          <div class="row">
            <div class="col-sm-12">
              <br> <br>
              <button type="submit" name="pembayaran_submit" value="submit" class="btn btn-success btn-bayar">Konfirmasi Pembelian <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></button>
            </div>

          </div>
		-->
        </div>

      </form>
    
		</div>
	</div>

    <!-- <section class="page"> -->

      <!-- apa kata -->

      <!-- <div class="container">

        <?php echo $this->session->flashdata('alert'); ?>



        <div class="row">

          

          <form action="<?php echo base_url().'user/do_beli' ;?>" method="post">

            <div class="col-md-6 pay-list">

              <h3>Paket Reguler</h3>

              <div class="table-responsive">

                <table class="table table-striped">

                  <thead>

                    <tr>

                      <th>Kode</th>

                      <th>Pilihan Voucher</th>

                      <th>Harga Satuan</th>

                      <th>Jumlah</th>

                    </tr>

                  </thead>

                  <tbody>

                    <?php

                    $jml_paket = 10;

                    foreach ($data_reguler as $item) 

                    { ?>

                    <tr>

                      <td><?php echo $item->kode_paket;?></td>

                      <td>Reguler <?php echo $item->durasi;?> bulan</td>

                      <td>Rp <?php echo number_format($item->harga);?>-</td>

                      <td>

                        <select name="paket_<?php echo $item->id_paket;?>">

                          <option value="">0</option>

                          <?php for($jml=1; $jml<=$jml_paket; $jml++)

                          { ?>

                            <option value="<?php echo $jml;?>"><?php echo $jml;?></option>

                          <?php 

                          } ?>

                        </select> buah

                      </td>

                    </tr>

                    <?php

                    } ?>

                  </tbody>

                </table>

              </div>

              

              <hr>



              <h3>Paket Premium</h3>

              <div class="table-responsive">

                <table class="table table-striped">

                   <thead>

                    <tr>

                      <th>Kode</th>

                      <th>Pilihan Voucher</th>

                      <th>Harga Satuan</th>

                      <th>Jumlah</th>

                    </tr>

                  </thead>

                  <tbody>

                   <?php

                    foreach ($data_premium as $item) 

                    { ?>

                    <tr>

                      <td><?php echo $item->kode_paket;?></td>

                      <td>Premium <?php echo $item->durasi;?> bulan</td>

                      <td>Rp <?php echo number_format($item->harga);?>-</td>

                      <td>

                        <select name="paket_<?php echo $item->id_paket;?>">

                          <option value="">0</option>

                          <?php for($jml=1; $jml<=$jml_paket; $jml++)

                          { ?>

                            <option value="<?php echo $jml;?>"><?php echo $jml;?></option>

                          <?php 

                          } ?>

                        </select> buah



                      </td>

                    </tr>

                    <?php

                    } ?>

                  </tbody>

                </table>

              </div>

            </div>

            

            <div class="col-md-6 pay-method">

              <div class="row">

                <div class="col-sm-12">

                  <h3>Metode Pembayaran</h3>

                  <div class="pay-rek">

                    <label for="metodePembayaran1">

                      <img src="<?php echo base_url('assets/pg_user/images/icon/icon-atm.png');?>" width="256" height="256" alt="Indomaret Logo" class="img-responsive">

                      <div class="panel panel-default">

                        <div class="panel-body">

                          <ul>

                            <li>Transfer via bank BCA, Mandiri, atau BRI</li>

                            <li>Konfirmasi secara online</li>

                            <li>Kode voucher dikirim setelah proses konfirmasi</li>

                          </ul>

                        </div>

                      </div>

                    </label>

                    <div class="radio">

                      <input type="radio" name="metode_pembayaran" id="metodePembayaran1" value="1" aria-label="Transfer via Bank" checked>

                    </div>

                  </div>

                  <div class="pay-indo">

                    <label for="metodePembayaran2">

                    <img src="<?php echo base_url('assets/pg_user/images/icon/indomaret_logo.png');?>" width="306" height="106" alt="Indomaret Logo" class="img-responsive">

                      <div class="panel panel-default">

                        <div class="panel-body">

                          <ul>

                            <li>Bayar di Indomaret dengan menunjukkan slip pemesanan atau kode referensi</li>

                            <li>Kode voucher dikirim setelah proses pembayaran</li>

                          </ul>

                        </div>

                      </div>

                    </label>

                    <div class="radio">

                      <input type="radio" name="metode_pembayaran" id="metodePembayaran2" value="2" aria-label="Indomaret">

                    </div>

                  </div>

                </div>

              </div>



              <div class="row">

                <div class="col-sm-12">

                  <br> <br>

                  <button type="submit" name="pembayaran_submit" value="submit" class="btn btn-success">Konfirmasi Pembelian <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></button>

                </div>

              </div>

            </div>

          </form>



        </div>

      </div>        

    </section> -->

    

    <?php include('footer.php');?>

    

    <!-- Javascript -->

    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-1.11.3.min.js');?>"></script>

    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/bootstrap.min.js');?>"></script>

    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/npm.js');?>"></script>

    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/retina.min.js');?>"></script>

    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/megamenu.js');?>"></script>

		<script src="<?php echo base_url('assets/dashboard/js/init.js');?>"></script>
		
		<?php include('modal_profil.php'); ?>

  </body>

</html>

