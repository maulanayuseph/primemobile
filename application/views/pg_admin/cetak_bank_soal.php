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

 <title><?php echo $title;?></title>

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
	<div style="text-align: center; font-weight: bold;">
		BANK SOAL
		<br><?php echo $infobank->alias_kelas . " " . $infobank->nama_mapel . " - " . $infobank->nama_kategori;?>
	</div>
	
<table>
	<?php
		$x = 1;
		foreach($datasoal as $soal){
			?>
			
			<tr>
				<td width="0.5cm" valign="top"><strong><p><?php echo $x;?>. </p></strong></td>
				<td colspan="2" width="15cm">
				<strong>Topik : <?php echo $soal->topik;?></strong>
				<br><?php echo html_entity_decode($soal->pertanyaan);?></td>
			</tr>
			<tr>
				<td></td>
				<td style="width: 0.5cm;" valign="top"><strong>A.</strong></td>
				<td valign="top"><?php echo html_entity_decode($soal->jawab_1);?></td>
			</tr>
			<tr>
				<td></td>
				<td width="0.5cm" valign="top"><strong>B.</strong></td>
				<td valign="top"><?php echo html_entity_decode($soal->jawab_2);?></td>
			</tr>
			<tr>
				<td></td>
				<td width="0.5cm" valign="top"><strong>C.</strong></td>
				<td valign="top"><?php echo html_entity_decode($soal->jawab_3);?></td>
			</tr>
			<tr>
				<td></td>
				<td width="0.5cm" valign="top"><strong>D.</strong></td>
				<td valign="top"><?php echo html_entity_decode($soal->jawab_4);?></td>
			</tr>
			<tr>
				<td></td>
				<td width="0.5cm" valign="top"><strong>E.</strong></td>
				<td valign="top"><?php echo html_entity_decode($soal->jawab_5);?></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2">
				<strong>Kunci Jawaban :
				<?php 
				if($soal->kunci == 1){
					echo "A";
				}elseif($soal->kunci == 2){
					echo "B";
				}elseif($soal->kunci == 3){
					echo "C";
				}elseif($soal->kunci == 4){
					echo "D";
				}elseif($soal->kunci == 5){
					echo "E";
				}
				?>
				</strong>
				</td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2">
				<p><strong>Bobot Soal : </strong><?php echo html_entity_decode($soal->bobot_soal);?>
				</td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2">
				<p><strong>Pembahasan Teks : </strong><?php echo html_entity_decode($soal->pembahasan_teks);?>
				</td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2">
				<p><strong>Pembahasan Video :</strong><?php echo $soal->pembahasan_video;?>
				<hr>
				</td>
			</tr>
			<?php
			$x++;
		}
	?>
</table>
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