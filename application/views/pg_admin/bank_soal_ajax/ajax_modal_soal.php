<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8" />
 <link rel="shortcut icon" href="<?php echo base_url('assets/pg_user/images/icon/favicon.ico');?>" >
    <link rel="icon" sizes="130x128" href="<?php echo base_url('assets/pg_user/images/icon/favicon.ico');?>" >
    <link rel="apple-touch-icon" sizes="130x128" href="<?php echo base_url('assets/pg_user/images/icons/favicon.ico');?>" >
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

 <title>Prime Mobile Admin Dashboard</title>

 <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <meta name="viewport" content="width=device-width" />


  <!-- Bootstrap core CSS     -->
  <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" />

  <!-- Animation library for notifications   -->
  <link href="<?php echo base_url('assets/css/animate.min.css');?>" rel="stylesheet"/>

  <!--  Light Bootstrap Table core CSS    -->
  <link href="<?php echo base_url('assets/css/light-bootstrap-dashboard.css');?>" rel="stylesheet"/>

  
  <!--  CSS for BintangSekolah PG_Admin  -->
  <link href="<?php echo base_url('assets/css/pg_admin.css" rel="stylesheet');?>" />
  
  <link href="<?php echo base_url('assets/js/jquery-ui/jquery-ui.css" rel="stylesheet');?>" />


  <!--     Fonts and icons     -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
  <link href="<?php echo base_url('assets/css/pe-icon-7-stroke.css" rel="stylesheet');?>" />

  <!-- ADDITIONAL -->
  <!--  Chosen Select Box Plugin CSS    -->
  <link href="<?php echo base_url('assets/css/plugins/chosen.css');?>" rel="stylesheet"/>
  
  <!--  Awseomplate Plugin CSS  -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/pg_user/css/awesomplete.css');?>" />
  
  <!--  Datatables (Bootstrap) Plugin CSS    -->
  <link href="<?php echo base_url('assets/css/plugins/dataTables.bootstrap.min.css');?>" rel="stylesheet"/>
  
  <!--  Nestable (JQuery) Plugin CSS    -->
  <link href="<?php echo base_url('assets/css/plugins/nestable.css');?>" rel="stylesheet"/>
  
  <!--  Bootstrap Switch Plugin CSS    -->
  <link href="<?php echo base_url('assets/css/plugins/bootstrap-switch.min.css');?>" rel="stylesheet"/>
  
  <!-- Progress -->
  <link href="<?php echo base_url('assets/css/nprogress.css'); ?>" rel='stylesheet' />
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

  <!--   Core JS Files   -->
 <script src="<?php echo base_url('assets/js/jquery-1.10.2.js" type="text/javascript');?>"></script>
  
  <script src="<?php echo base_url('assets/js/jquery-ui/jquery-ui.js');?>">
  </script>

<script type="text/javascript" async
  src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=TeX-MML-AM_CHTML">
</script>
<script type="text/x-mathjax-config">
    MathJax.Hub.Config({
        tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}
    });
</script>
</head>
<body>
<div class="content">
<div class="container-fluid">
<div class="row">
	<div class="col-sm-12">
	<p><?php echo html_entity_decode($data->pertanyaan); ?></p>
	<p>&nbsp;</p>
	<table class="table table-bordered table-striped">
		<tr>
			<td style="width: 5px;"><b>A.</b></td>
			<td>
				<?php
				echo html_entity_decode($data->jawab_1);
				?>
			</td>
		</tr>
		<tr>
			<td><b>B.</b></td>
			<td>
				<?php
				echo html_entity_decode($data->jawab_2);
				?>
			</td>
		</tr>
		<tr>
			<td><b>C.</b></td>
			<td>
				<?php
				echo html_entity_decode($data->jawab_3);
				?>
			</td>
		</tr>
		<tr>
			<td><b>D.</b></td>
			<td>
				<?php
				echo html_entity_decode($data->jawab_4);
				?>
			</td>
		</tr>
		<tr>
			<td><b>E.</b></td>
			<td>
				<?php
				echo html_entity_decode($data->jawab_5);
				?>
			</td>
		</tr>
		<tr>
			<td>Kunci Jawaban</td>
			<td>
				<b>
				<?php
					if($data->kunci == 1){
						echo "A";
					}elseif($data->kunci == 2){
						echo "B";
					}elseif($data->kunci == 3){
						echo "C";
					}elseif($data->kunci == 4){
						echo "D";
					}elseif($data->kunci == 5){
						echo "E";
					}
				?>
				</b>
			</td>
		</tr>
		<tr>
			<td>Pembahasan</td>
			<td>
				<?php 
					echo html_entity_decode($data->pembahasan_teks);
				?>
			</td>
		</tr>
	</table>
	</div>
</div>
</div>
</div>
<script>
$(document).ready(function(){
   $('img').each(function(){
       var alt = $(this).attr('alt');
       var src = $(this).attr('src');
       alamatlatex = src.substring(0, 37);
       alamatlatex2 = src.substring(0, 36);
       var element = this;
       if(alamatlatex === "https://latex.codecogs.com/gif.latex?"){
       	latex = src.substring(37);
       	$.ajax({
			type: 'POST',
			url: '../../../latex/replace_space',
			data:{
				'latex'	: latex
			},
			success: function(data) {
				//alert(data);
				var newAlt = "$"+ data +"$";
				//alert(newAlt);
       			$(element).replaceWith(newAlt);
			},
		});
    }
    if(alamatlatex2 === "http://latex.codecogs.com/gif.latex?"){
    	latex = src.substring(36);
       	$.ajax({
			type: 'POST',
			url: '../../../latex/replace_space',
			data:{
				'latex'	: latex
			},
			success: function(data) {
				//alert(data);
				var newAlt = "$"+ data +"$";
				//alert(newAlt);
       			$(element).replaceWith(newAlt);
			},
		});
    }
    });
});
</script>

</body>
</html>