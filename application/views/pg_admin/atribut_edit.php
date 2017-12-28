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
                <h4 class="title">Manajemen Atribut</h4>
              </div>
              <div class="content">
				<div class="row">
					<div class="col-sm-4">
						<form action="<?php echo base_url("pg_admin/atribut/proses_edit");?>" method="post">
							<input type="hidden" name="idatribut" value="<?php echo $atribut->id_atribut;?>">
							<strong>Edit Atribut</strong>
							<br>
							<br>
							Nama Atribut
							<br><input type="text" class="form-control" name="atribut"  value="<?php echo $atribut->atribut;?>"/>
							<br>
							<br>
							Induk Atribut
							<br>
							<select class="form-control" name="parent">
								<option value=" value="<?php echo $atribut->parent;?>"">
								<?php
									$cariparent = $this->model_atribut->fetch_atribut_by_id($atribut->parent);
									
									if(isset($cariparent)){
										echo $cariparent->atribut;
										
									}else{
										echo "None";
									}
								?>
								</option>
								<option value="0">None</option>
								<?php
									foreach($parentatribut as $parent){
										if($parent->id_atribut !== $atribut->id_atribut){
											?>
											<option value="<?php echo $parent->id_atribut;?>"><?php echo$parent->atribut;?></option>
											<?php
										}
									}
								?>
							</select>
							<i>Atribut memiliki hierarki. Contoh : anda dapat menambahkan atribut Ujian Nasional 2015 dan Ujian Nasional 2016 yang berinduk di Ujian Nasional. Pilih none jika anda memilih atribut ini sebagai induk</i>
							
							<br>
							<br>
							<button class="btn btn-sm btn-primary" style="width: 100%;" id="tambahatribut">Edit Atribut</button>
						</form>
					</div>
				</div>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->
    <?php include "footer.php"; ?>

  </div>
</div>


</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-1.10.2.js" type="text/javascript');?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<!--<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script> -->

<!-- Bootstrap Switch Plugin -->
<script src="<?php echo base_url('assets/js/plugins/bootstrap-switch/bootstrap-switch.min.js');?>"></script>

<!-- Progress -->
<script src="<?= base_url('assets/js/nprogress.js')?>" ></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>

</html>
