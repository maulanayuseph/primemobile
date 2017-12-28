<?php
if($config->akses_start == "0000-00-00 00:00:00"){
	$tglaksesstart = "";
	$aksesjammulai = "00";
	$aksesmenitmulai = "00";
}else{
	$aksesstart = new DateTime($config->akses_start);
	$aksesstart = new DateTime(date_format($aksesstart, 'Y-m-d H:i:s'));

	$tglaksesstart = date_format($aksesstart, 'y-m-d');
	$aksesjammulai = date_format($aksesstart, 'H');
	$aksesmenitmulai = date_format($aksesstart, 'i');
}


if($config->akses_end == "0000-00-00 00:00:00"){
	$tglaksesend = "";
	$aksesjamend = "00";
	$aksesmenitend = "00";
}else{
	$aksesend = new DateTime($config->akses_end);
	$aksesend = new DateTime(date_format($aksesend, 'Y-m-d H:i:s'));

	$tglaksesend = date_format($aksesend, 'y-m-d');
	$aksesjamend = date_format($aksesend, 'H');
	$aksesmenitend = date_format($aksesend, 'i');
}

if($config->bahas_start == "0000-00-00 00:00:00"){
	$tglbahas = "";
	$jambahas = "00";
	$menitbahas = "00";
}else{
	$bahas = new DateTime($config->bahas_start);
	$bahas = new DateTime(date_format($bahas, 'Y-m-d H:i:s'));

	$tglbahas = date_format($bahas, 'y-m-d');
	$jambahas = date_format($bahas, 'H');
	$menitbahas = date_format($bahas, 'i');
}
?>

<div class="col-sm-2">
</div>
<div class="col-sm-8">
	<div class="col-sm-12 text-center">
		<strong>Akses Pengerjaan Tugas</strong>
	</div>
	<div class="col-sm-6">
		<br>&nbsp;
		<strong>Tgl Mulai :</strong>
		<input type="text" id="datepicker" class="form-control" value="<?php echo $tglaksesstart;?>"/>
	</div>
	<div class="col-sm-6">
		<br>&nbsp;
		<strong>Jam Mulai :</strong>
		<br>
		<select id='jam-mulai'>
			<?php
				for($x = 0; $x < 23; $x++){
					$jam = str_pad($x, 2, '0', STR_PAD_LEFT);
					if($jam == $aksesjammulai){
						$select = "selected";
					}else{
						$select = "";
					}
					?>
					<option value="<?php echo $jam;?>" <?php echo $select;?>><?php echo $jam;?></option>
					<?php
				}
			?>
		</select> : 
		<select id='menit-mulai'>
			<?php
			for($x = 0; $x < 60; $x++){
				$menit = str_pad($x, 2, '0', STR_PAD_LEFT);
				if($menit == $aksesmenitmulai){
					$select = "selected";
				}else{
					$select = "";
				}
				?>
				<option value="<?php echo $menit;?>" <?php echo $select;?>><?php echo $menit;?></option>
				<?php
			}
			?>
		</select>
	</div>
	<div class="col-sm-12">
	</div>
	<div class="col-sm-6">
		<br>&nbsp;
		<strong>Tgl Akhir :</strong>
		<input type="text" id="datepicker2" class="form-control" value="<?php echo $tglaksesend;?>"/>
	</div>
	<div class="col-sm-6">
		<br>&nbsp;
		<strong>Jam Akhir :</strong>
		<br>
		<select id='jam-akhir'>
			<?php
				for($x = 0; $x < 23; $x++){
					$jam = str_pad($x, 2, '0', STR_PAD_LEFT);
					if($jam == $aksesjamend){
						$select = "selected";
					}else{
						$select = "";
					}
					?>
					<option value="<?php echo $jam;?>" <?php echo $select;?>><?php echo $jam;?></option>
					<?php
				}
			?>
		</select> : 
		<select id='menit-akhir'>
			<?php
			for($x = 0; $x < 60; $x++){
				$menit = str_pad($x, 2, '0', STR_PAD_LEFT);
				if($menit == $aksesmenitend){
					$select = "selected";
				}else{
					$select = "";
				}
				?>
				<option value="<?php echo $menit;?>" <?php echo $select;?>><?php echo $menit;?></option>
				<?php
			}
			?>
		</select>
	</div>
	<div class="col-sm-12 text-center">
		<br>&nbsp;
		<br>
		<strong>Akses Pembahasan</strong>
	</div>
	<div class="col-sm-6">
		<br>&nbsp;
		<strong>Tgl :</strong>
		<input type="text" id="datepicker3" class="form-control" value="<?php echo $tglbahas;?>"/>
	</div>
	<div class="col-sm-6">
		<br>&nbsp;
		<strong>Jam :</strong>
		<br>
		<select id='jam-bahas'>
			<?php
				for($x = 0; $x < 23; $x++){
					$jam = str_pad($x, 2, '0', STR_PAD_LEFT);
					if($jam == $jambahas){
						$select = "selected";
					}else{
						$select = "";
					}
					?>
					<option value="<?php echo $jam;?>" <?php echo $select;?>><?php echo $jam;?></option>
					<?php
				}
			?>
		</select> : 
		<select id='menit-bahas'>
			<?php
			for($x = 0; $x < 60; $x++){
				$menit = str_pad($x, 2, '0', STR_PAD_LEFT);
				if($menit == $menitbahas){
					$select = "selected";
				}else{
					$select = "";
				}
				?>
				<option value="<?php echo $menit;?>" <?php echo $select;?>><?php echo $menit;?></option>
				<?php
			}
			?>
		</select>
	</div>
	<div class="col-sm-12">
		&nbsp;
		<button class="btn btn-sm btn-danger" id="simpan-jadwal" style="width: 100%;">Simpan Jadwal</button>
	</div>
</div>
<div class="col-sm-2">
</div>

<script>
$(function(){
$("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
$("#datepicker2").datepicker({ dateFormat: 'yy-mm-dd' });
$("#datepicker3").datepicker({ dateFormat: 'yy-mm-dd' });

$("#simpan-jadwal").click(function(){
	tanggalmulaiakses 	= $("#datepicker").val();
	tanggalakhirakses 	= $("#datepicker2").val();
	tanggalbahas 		= $("#datepicker3").val();
	jamstartakses		= $("#jam-mulai").val();
	menitstartakses		= $("#menit-mulai").val();
	jamendakses			= $("#jam-akhir").val();
	menitendakses		= $("#menit-akhir").val();
	jambahas 			= $("#jam-bahas").val();
	menitbahas 			= $("#menit-bahas").val();
	if(tanggalmulaiakses === "" || tanggalakhirakses === "" || tanggalbahas === ""){
		alert("Lengkapi form sebelum menyimpan jadwal");
	}else{
		$.ajax({
			type: 'POST',
			url: '../proses_set_jadwal',
			data:{
				'id_config_pr'	: <?php echo $config->id_config_pr;?>,
				'akses_start' 	: tanggalmulaiakses + " " + jamstartakses + ":" + menitstartakses + ":00",
				'akses_end'		: tanggalakhirakses + " " + jamendakses + ":" + menitendakses + ":00",
				'bahas_start'	: tanggalbahas + " " + jambahas + ":" + menitbahas + ":00"
			}
		});
	}
})

$(document).ajaxSend(function(event, jqxhr, settings){
	if(settings.url === "../proses_set_jadwal"){
		$('#text-load').html('Set Jadwal');
		$('#modal-loader').appendTo("body").modal('show');
	}
});
$(document).ajaxSuccess(function(event, request, options){
	
});
$(document).ajaxError(function(event, request, options){
	if(options.url === "../proses_set_jadwal"){
		$('#modal-loader').modal('hide');
		$('#modal-error').appendTo("body").modal('show');
	}
});

});
</script>