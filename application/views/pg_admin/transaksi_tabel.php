<?php

defined('BASEPATH') OR exit('No direct script access allowed');

?>



<?php include "html_header.php"; ?>



<div class="wrapper">

  <?php include "sidebar.php"; ?>



  <div class="main-panel">

    <?php include "navbar.php"; ?>

    

    <div class="content">      

      <div class="container-fluid">

        <?php echo $this->session->flashdata('alert'); ?>



        <div class="row">

          <div class="col-md-12">

            <div class="card">

              <div class="header">

								<div class="row">

									<div class="col-md-9 col-xs-12">

										<h4 class="title">Transaksi Pembelian</h4>

										<p class="category">Daftar Transaksi Pembelian Voucher</p>

									</div>

									<div class="col-md-3 col-xs-12">

										<a class="btn btn-default btn-block" href="<?php echo base_url('pg_admin/transaksi/tambah'); ?>" style="margin-top:10px;"><i class="glyphicon glyphicon-plus"></i> Tambah Transaksi</a>
										<a class="btn btn-default btn-block" href="<?php echo base_url('pg_admin/transaksi/tambah_psep'); ?>" style="margin-top:10px;"><i class="glyphicon glyphicon-plus"></i> Tambah Transaksi PSEP</a>
									</div>

								</div>

              </div>

              <div class="content">

								<?php if ($this->session->flashdata('sukses') != ''){ ?>

								<div style="margin-bottom:15px;"><div class="label label-success"><?php echo $this->session->flashdata('sukses'); ?></div></div>

								<?php } ?>



								<ul class="nav nav-tabs">

									<li class="active"><a data-toggle="tab" href="#tab0" onclick="ajaxtabs(0);">Registered User</a></li>

									<li><a data-toggle="tab" href="#tab1" onclick="ajaxtabs(1);">Not Registered User</a></li>

									<li><a data-toggle="tab" href="#tab2" onclick="ajaxtabs(2);">Sekolah</a></li>

									<li><a data-toggle="tab" href="#tab3" onclick="ajaxtabs(3);">Indihome</a></li>

									<li><a data-toggle="tab" href="#tab4" onclick="ajaxtabs(4);">Demo</a></li>

								</ul>



								<div class="tab-content">

									<div id="tab0" class="tab-pane fade in active">

										<div id="ajaxpage0">

											<?php include "transaksi_tabel_ajax.php"; ?>

										</div>

									</div>

									<div id="tab1" class="tab-pane fade ">

										<div id="ajaxpage1">

										</div>

									</div>

									<div id="tab2" class="tab-pane fade ">

										<div id="ajaxpage2">

										</div>

									</div>

									<div id="tab3" class="tab-pane fade ">

										<div id="ajaxpage3">

										</div>

									</div>

									<div id="tab4" class="tab-pane fade ">

										<div id="ajaxpage4">

										</div>

									</div>

								</div>



								<div class="table-responsive">

								</div>

              </div>

            </div>

          </div>

        </div>

      </div> 

    </div> <!-- end .content -->



  </div> <!-- end .main-panel -->

</div>



<?php include "alert_file_bukti.php"; ?>



<?php include "alert_email_modal.php"; ?>



</body>



<!--   Core JS Files   -->

<script src="<?php echo base_url('assets/js/jquery-1.10.2.js" type="text/javascript');?>"></script>

<script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>



<!--  Checkbox, Radio & Switch Plugins -->

<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>



<!--  Datatables Plugin -->

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>



<!--  Notifications Plugin    -->

<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>



<!-- Progress -->

<script src="<?= base_url('assets/js/nprogress.js')?>" ></script>



<!-- JS Function for this Modal -->

<script type="text/javascript">

  $('#file_bukti_modal').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget) // Button that triggered the modal

    var rownumber = button.data('number') // Extract info from data-* attributes

    var gambar = button.attr('value')

    $("#gambar").attr("src", gambar);

  })

  $('#insert_email_modal').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget) // Button that triggered the modal

    var rownumber = button.data('number') // Extract info from data-* attributes

    var id = button.attr('value')

    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).

    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

    var modal = $(this)

    modal.find('.number').text("#" + rownumber + "?")

    modal.find('input[name=hidden_row_id]').val(id)

  })

</script>



<script>

function toggle(source) {

  checkboxes = document.getElementsByName('check[]');

  for(var i=0, n=checkboxes.length;i<n;i++) {

    checkboxes[i].checked = source.checked;

  }

}

</script>



<script type="text/javascript">

	function ajaxtabs(tab)

	{  

		var urlLink = "<?php echo base_url().'pg_admin/transaksi/tabel_ajax/'; ?>" + tab;

		$.ajax({

			url:urlLink,

			beforeSend: function() {

				NProgress.start();

			},

			success:function(data) { 

				NProgress.done();

				$("#ajaxpage" + tab).html(data);

			}

		});

		return false;

	}

	function ajaxpage0(urlLink)

	{  

		$.ajax({

			url:urlLink,

			beforeSend: function() {

				NProgress.start();

			},

			success:function(data) {

				NProgress.done(); 

				$("#ajaxpage0").html(data);

			}

		});

		return false;

	}

	function ajaxpage1(urlLink)

	{  

		$.ajax({

			url:urlLink,

			beforeSend: function() {

				NProgress.start();

			},

			success:function(data) {

				NProgress.done(); 

				$("#ajaxpage1").html(data);

			}

		});

		return false;

	}

	function ajaxpage2(urlLink)

	{  

		$.ajax({

			url:urlLink,

			beforeSend: function() {

				NProgress.start();

			},

			success:function(data) {

				NProgress.done(); 

				$("#ajaxpage2").html(data);

			}

		});

		return false;

	}

	function ajaxpage3(urlLink)

	{  

		$.ajax({

			url:urlLink,

			beforeSend: function() {

				NProgress.start();

			},

			success:function(data) {

				NProgress.done(); 

				$("#ajaxpage3").html(data);

			}

		});

		return false;

	}

	function ajaxpage4(urlLink)

	{  

		$.ajax({

			url:urlLink,

			beforeSend: function() {

				NProgress.start();

			},

			success:function(data) {

				NProgress.done(); 

				$("#ajaxpage4").html(data);

			}

		});

		return false;

	}

</script>



</html>

