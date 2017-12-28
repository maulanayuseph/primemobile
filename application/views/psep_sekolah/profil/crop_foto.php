<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
$this->load->view("psep_sekolah/html_header");
?>
<link  href="<?php echo base_url("assets/js/plugins/cropper");?>/cropper.css" rel="stylesheet">
<script src="<?php echo base_url("assets/js/plugins/cropper");?>/cropper.js"></script>
<style type="text/css">
	img {
	  max-width: 100%; /* This rule is very important, please do not ignore this! */
	}
</style>
<div class="wrapper">
  <?php
	$this->load->view("psep_sekolah/sidebar");
	?>

  <div class="main-panel">
    <<?php
	$this->load->view("psep_sekolah/navbar");
	?>
    
    <div class="content">      
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="content">
                <div class="row">
                	<div class="col-sm-3">
                		<a href="<?php echo base_url('psep_sekolah/profil/upload_foto');?>">Upload Foto Lain</a>
                	</div>
					<div class="col-sm-6">
						<div>
						  <img id="image" src="<?php echo base_url('assets/uploads/foto_guru/' . $guru->foto);?>">
						</div>
						<br>
						<button class="btn btn-sm btn-danger" style="width: 100%;" id="crop-image">Crop</button>
					</div>
					<div class="col-sm-3">
                	</div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->

    <?php
	$this->load->view("psep_sekolah/footer");
	?>

  </div>
</div>
<?php $this->load->view("psep_sekolah/modal_ajax");;?>
</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>

<!--  Nestable Plugin    -->
<script src="<?php echo base_url('assets/js/plugins/nestable/jquery.nestable.js');?>"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?php echo base_url('assets/js/bootstrap-checkbox-radio-switch.js');?>"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo base_url('assets/js/bootstrap-notify.js');?>"></script>


<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>

<!-- PLUGINS FUNCTION -->
<!-- Nestable plugin  -->
<script type="text/javascript">
$(function(){
var console = window.console || { log: function () {} };
var URL = window.URL || window.webkitURL;
$('#image').cropper({
  aspectRatio: 1 / 1,
  crop: function(e) {
    // Output the result data for cropping image.
    console.log(e.x);
    console.log(e.y);
    console.log(e.width);
    console.log(e.height);
    console.log(e.rotate);
    console.log(e.scaleX);
    console.log(e.scaleY);
  }
});

$("#crop-image").click(function(){
	var $image = $('#image');
	var uploadedImageType = 'image/jpeg';
	var $this = $(this);
    var cropper = $image.data('cropper');
    var cropped;
    var $target;
    var result;

    cropped = cropper.cropped;
    opsi = {};
    opsi.fillColor = '#fff';
    result = $image.cropper("getCroppedCanvas");
    kodegambar = result.toDataURL(uploadedImageType)
    console.log(kodegambar);
    $.ajax({
		type: 'POST',
		url: 'crop_foto_profil',
		data:{
			'kodegambar'	: kodegambar,
		}
	});
})
$(document).ajaxSend(function(event, jqxhr, settings){
	$('#modal-loader').appendTo("body").modal('show');
});
$(document).ajaxSuccess(function(event, request, options){
	$('#modal-loader').modal('hide');
	if(options.url === "crop_foto_profil"){
		if(request.responseText === "success"){
			window.location.replace("<?php echo base_url('psep_sekolah/dashboard');?>");
		}else{
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');
		}
	}
});
$(document).ajaxError(function(event, request, options){
	$('#modal-loader').modal('hide');
	$('#modal-error').appendTo("body").modal('show');
});
});
</script>

</html>
