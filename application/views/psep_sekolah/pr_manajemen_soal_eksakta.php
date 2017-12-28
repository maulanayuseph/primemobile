<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php include "html_header.php"; ?>
<script>
$(function(){
	$("#sumber").change(function(){
		$("#manage").load("../ajax_manage/" + $("#sumber").val());
	});
	
	var max_fields      = 10; //maximum input boxes allowed
    //var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    //var add_button      = $(".add_field_button"); //Add button ID
   
    var x = 1; //initlal text box count
    $(".add_field_button").click(function(){ //on add input button click
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
			var content;
			$.get('../ajax_append_soal', function(data){
				content= data;
				//$('#result').prepend(content);
				$(".input_fields_wrap").append(content);
			});
             //add input box
        }
    });
   
    $(".input_fields_wrap").on("click",".remove_field", function(){ //user click on remove text
		$(this).parent('div').remove(); x--;
    })
});
</script>

<div class="wrapper">
  <?php include "sidebar.php"; ?>

  <div class="main-panel">
    <?php include "navbar.php"; ?>
    
    <div class="content">      
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
                <h4 class="title">Pekerjaan Rumah <?php echo $sekolah->nama_sekolah;?></h4>
              </div>
              <div class="content">
                <div class="row">
					<form action="<?php echo base_url("psep_sekolah/pr/proses_tambah_soal_eksakta");?>" method="post">
					<input type="hidden" value="<?php echo $infopr->id_pr;?>" name="idpr"/>
					<div class="col-md-6">
						<table class="table table-striped">
							<tr>
								<td>Nama PR</td>
								<td>:</td>
								<td><?php echo $infopr->nama_pr;?></td>
							</tr>
							<tr>
								<td>Kelas</td>
								<td>:</td>
								<td><?php echo $infopr->kelas_paralel;?></td>
							</tr>
							<tr>
								<td>Tahun Ajaran</td>
								<td>:</td>
								<td><?php echo $infopr->tahun_ajaran;?></td>
							</tr>
							<tr>
								<td>Tanggal Penyelesaian</td>
								<td>:</td>
								<td><?php echo $infopr->deadline;?></td>
							</tr>
						</table>
					</div>
					<div class="form-group">
						<div class="col-md-12">
							<label>Pendahuluan Soal<span class="text-danger">*</span></label>
							<textarea class="tinymce_textarea" name="intro">
							</textarea>
						</div>
					</div>
					
					<div class="input_fields_wrap">
						<div class="form-group">
							<div class="col-md-6">
								<label>Pertanyaan 1<span class="text-danger">*</span></label>
								<textarea class="tinymce_textarea" name="pertanyaan[]">
								</textarea>
								<label>Jawaban 1<span class="text-danger">*</span></label>
								<input type="text" name="jawaban[]" class="form-control" placeholder="jawaban 1"/>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<label>&nbsp;</label><br>
						<button type="button" class="btn btn-primary add_field_button">+</button>
					</div>
					<div class="col-md-12" style="text-align: right;">
						<input type="submit" class="btn btn-primary" value="Tambah Soal"/>
					</div>
					</form>
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


<!--  Datatables Plugin -->
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
 <script type="text/javascript" src="<?php echo base_url('assets/js/plugins.js');?>"></script>

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

<script src="<?php echo base_url('assets/js/plugins/tinymce/tinymce.min.js');?>" type="text/javascript"></script>
 <script type="text/javascript">
  tinymce.init({
    selector: '.tinymce_textarea',
    skin: 'lightgray',
    menubar: false,
	max_height : 300,
    plugins: [
        "eqneditor advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
        "table contextmenu directionality emoticons paste textcolor responsivefilemanager",
        "code fullscreen youtube autoresize"
      ],
    toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent table | fullscreen" ,
    toolbar2: "| fontsizeselect | styleselect | link unlink anchor | eqneditor image media youtube | forecolor backcolor | responsivefilemanager | code",
    extended_valid_elements: "+iframe[src|width|height|name|align|class]",
    image_advtab: true,
    fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
    relative_urls: false,
    remove_script_host: false,

		//Filemanager
		external_filemanager_path: "<?php echo base_url();?>assets/js/plugins/filemanager/",
		filemanager_title: "Data Filemanager" ,
		external_plugins: { "filemanager" : "<?php echo base_url();?>assets/js/plugins/filemanager/plugin.min.js" },
	 
    //integrating tinymce 4 and kcfinder
    file_browser_callback: function(field, url, type, win) {
      console.log("<?php echo base_url();?>" + 'assets/js/plugins/kcfinder/browse.php?opener=tinymce4&field=' + field + '&type=' + type);
      tinyMCE.activeEditor.windowManager.open({
          file:  "<?php echo base_url();?>" + 'assets/js/plugins/kcfinder/browse.php?opener=tinymce4&field=' + field + '&type=' + type,
          title: 'KCFinder',
          width: 700,
          height: 250,
          inline: true,
          close_previous: false
      }, {
          window: win,
          input: field
      });
      return false;
    }
  });
  </script>
<script>
$(function(){
$("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
});
</script>
</html>
