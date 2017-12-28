<!DOCTYPE html>
<html>
<head>
  <title><?= $title ?></title>
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
		h2{margin:20px 0px 0px 0px;}
		hr{margin:10px 0px;}
		p{line-height:26px;text-align:justify;}
		.clearfix{clear:both;}
  </style>
</head>
<body>
	<div id="head-logo"><img src="assets/dashboard/images/logo-red.png"></div>
	<div id="outtable">
		<h2><?= $title ?><h2>
		<hr>
		<p><?php echo html_entity_decode(preg_replace("/&#?[a-z0-9]+;/i","",str_replace('http://primemobile.co.id/','',$data->isi_materi))) ?></p>
	</div>
</body>
</html>