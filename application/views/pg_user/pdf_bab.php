<!DOCTYPE html>
<html>
<head>
  <title><?php echo $list_pokok->nama_materi_pokok;?></title>
  <style type="text/css">
    #head-logo{
      padding: 0px 20px;
      width:100%;
    }
    #outtable{
      padding: 10px 20px 20px 20px;
      border:0px solid #e3e3e3;
      width:100%;
			font-family: 'Helvetica';
    }
		h3{margin:0px;}
		hr{margin:10px 0px;}
		p{line-height:26px;text-align:justify;}
		.clearfix{clear:both;}
  </style>
</head>
<body>
	<div id="head-logo"><img src="assets/dashboard/images/logo-red.png"></div>
	<div id="outtable">
		<div >
			<div class="row" style="margin-bottom:30px;">
				<div class="col-lg-12"><center><h2><?php echo $list_pokok->nama_materi_pokok;?></h2></center></div>
				<p><?php echo $list_pokok->deskripsi_materi_pokok; ?></p>
			</div>
			<div class="clearfix"></div>
			<?php
			foreach ($list_sub as $sub)
			{ 
				if($sub->materi_pokok_id == $list_pokok->id_materi_pokok)
				{
					if($sub->kategori=="1") //Teks
					{ 
			?>
					<h3><?php echo ucwords(strtolower($sub->nama_sub_materi));?></h3>
					<hr>
					<?php
					$data = $this->model_pg->get_konten_by_id($sub->id_konten);
					echo '<p>'.html_entity_decode(preg_replace("/&#?[a-z0-9]+;/i","",str_replace('http://primemobile.co.id/','',$data->isi_materi))).'</p>';
					?>
					<br />
					<div class="clearfix"></div>
			<?php
					}
				}
			} 
			?>
		</div>
	</div>
</body>
</html>