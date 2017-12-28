<?php
foreach($datasubbab as $sub){
	?>
		<tr>
			<td>
				<?php echo $sub->nama_sub_materi;?>
			</td>
			<td>
				<?php
					if($sub->k_13_revisi == "1"){
						$k13rev = "checked";
					}else{
						$k13rev = "";
					}
					if($sub->kurikulum == "KTSP"){
						?>
						<div class="col-sm-4">
							<input type="checkbox" class="set_k13" id="sub-k13-<?php echo $sub->id_sub_materi;?>" /> K-13
						</div>
						<div class="col-sm-4">
							<input type="checkbox" class="set_k13_revisi" id="sub-k13revisi-<?php echo $sub->id_sub_materi;?>" <?php echo $k13rev;?>/> K-13 Revisi
						</div>
						<div class="col-sm-4">
							<input type="checkbox" class="set_ktsp" id="sub-ktsp-<?php echo $sub->id_sub_materi;?>" checked/> KTSP
						</div>
						<?php
					}elseif($sub->kurikulum == "K-13"){
						?>
						<div class="col-sm-4">
							<input type="checkbox" class="set_k13" id="sub-k13-<?php echo $sub->id_sub_materi;?>" checked/> K-13
						</div>
						<div class="col-sm-4">
							<input type="checkbox" class="set_k13_revisi" id="sub-k13revisi-<?php echo $sub->id_sub_materi;?>" <?php echo $k13rev;?>/> K-13 Revisi
						</div>
						<div class="col-sm-4">
							<input type="checkbox" class="set_ktsp" id="sub-ktsp-<?php echo $sub->id_sub_materi;?>"/> KTSP
						</div>
						<?php
					}elseif($sub->kurikulum == "KTSP, K-13"){
						?>
						<div class="col-sm-4">
							<input type="checkbox" class="set_k13" id="sub-k13-<?php echo $sub->id_sub_materi;?>" checked/> K-13
						</div>
						<div class="col-sm-4">
							<input type="checkbox" class="set_k13_revisi" id="sub-k13revisi-<?php echo $sub->id_sub_materi;?>" <?php echo $k13rev;?>/> K-13 Revisi
						</div>
						<div class="col-sm-4">
							<input type="checkbox" class="set_ktsp" id="sub-ktsp-<?php echo $sub->id_sub_materi;?>" checked/> KTSP
						</div>
						<?php
					}else{
						?>
						<div class="col-sm-4">
							<input type="checkbox" class="set_k13" id="sub-k13-<?php echo $sub->id_sub_materi;?>"/> K-13
						</div>
						<div class="col-sm-4">
							<input type="checkbox" class="set_k13_revisi" id="sub-k13revisi-<?php echo $sub->id_sub_materi;?>" <?php echo $k13rev;?>/> K-13
						</div>
						<div class="col-sm-4">
							<input type="checkbox" class="set_ktsp" id="sub-ktsp-<?php echo $sub->id_sub_materi;?>"/> KTSP
						</div>
						<?php
					}
				?>
			</td>
		</tr>
	<?php
}
?>


<script>
$(function(){
	$(".set_k13").click(function(){
		rawid 		= $(this).attr("id");
		splitid		= rawid.split("-");
		idsub 		= splitid[2];

		if(document.getElementById(rawid).checked){
			if(document.getElementById("sub-ktsp-" + idsub).checked && document.getElementById(rawid).checked){
				//alert("BOTH");
				kurikulum = "KTSP, K-13";
			}else{
				//alert("K-13");
				kurikulum = "K-13";
			}
		}else{
			if(document.getElementById("sub-ktsp-" + idsub).checked){
				//alert("KTSP");
				kurikulum = "KTSP";
			}else{
				kurikulum = "";
			}
		}
		$.ajax({
			type: 'POST',
			url: 'kurikulum/set_kurikulum',
			data:{
				'idsub' 	: idsub,
				'kurikulum'	: kurikulum,
				'button'	: rawid
			}
		});
	});

	$(".set_k13_revisi").click(function(){
		rawid 		= $(this).attr("id");
		splitid		= rawid.split("-");
		idsub 		= splitid[2];

		if(document.getElementById(rawid).checked){
			k13rev = 1;
		}else{
			k13rev = 0;
		}
		$.ajax({
			type: 'POST',
			url: 'kurikulum/set_k13_revisi',
			data:{
				'idsub' 	: idsub,
				'k13rev'	: k13rev,
				'button'	: rawid
			}
		});
	});

	$(".set_ktsp").click(function(){
		rawid 		= $(this).attr("id");
		splitid		= rawid.split("-");
		idsub 		= splitid[2];

		if(document.getElementById(rawid).checked){
			if(document.getElementById("sub-k13-" + idsub).checked && document.getElementById(rawid).checked){
				//alert("BOTH");
				kurikulum = "KTSP, K-13";
			}else{
				//alert("K-13");
				kurikulum = "KTSP";
			}
		}else{
			if(document.getElementById("sub-k13-" + idsub).checked){
				//alert("KTSP");
				kurikulum = "K-13";
			}else{
				kurikulum = "";
			}
		}
		$.ajax({
			type: 'POST',
			url: 'kurikulum/set_kurikulum',
			data:{
				'idsub' 	: idsub,
				'kurikulum'	: kurikulum,
				'button'	: rawid
			}
		});
	});


	
	$(document).ajaxSend(function(event, jqxhr, settings){
		if(settings.url === "kurikulum/set_kurikulum"){
			$('#text-load').html('Menyimpan Kurikulum');
			$('#modal-loader').appendTo("body").modal('show');
		}
		if(settings.url === "kurikulum/set_k13_revisi"){
			$('#text-load').html('Menyimpan Kurikulum');
			$('#modal-loader').appendTo("body").modal('show');
		}
	});
	$(document).ajaxSuccess(function(event, request, options){
		if(options.url === "kurikulum/set_kurikulum"){
			$('#modal-loader').modal('hide');
		}

		if(options.url === "kurikulum/set_k13_revisi"){
			$('#modal-loader').modal('hide');
		}
	});
	$(document).ajaxError(function(event, request, options){
		if(options.url === "kurikulum/set_kurikulum"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');

			//console.log(options.data("button"));
			parameterdata 	= options.data;
			spliturl 		= parameterdata.split("&");
			splitbtn		= spliturl[2].split("=");
			tombol			= splitbtn[1];
			//alert(tombol);
			if(document.getElementById(tombol).checked){
				$('#' + tombol).attr('checked', false);
			}else{
				$('#' + tombol).attr('checked', true);
			}
		}
		if(options.url === "kurikulum/set_k13_revisi"){
			$('#modal-loader').modal('hide');
			$('#modal-error').appendTo("body").modal('show');

			//console.log(options.data("button"));
			parameterdata 	= options.data;
			spliturl 		= parameterdata.split("&");
			splitbtn		= spliturl[2].split("=");
			tombol			= splitbtn[1];
			//alert(tombol);
			if(document.getElementById(tombol).checked){
				$('#' + tombol).attr('checked', false);
			}else{
				$('#' + tombol).attr('checked', true);
			}
		}
	})
});
</script>