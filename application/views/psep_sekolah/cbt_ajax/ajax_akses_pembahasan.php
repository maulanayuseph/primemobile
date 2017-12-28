<div class="col-sm-3">
</div>
<div class="col-sm-6">
	<div class="col-sm-12">
		<strong>Kelas :</strong>
		<select class="form-control" id="bahas-kelas">
			<option value="">-- Pilih Kelas --</option>
			<?php
				foreach($datakelas as $kelas){
					?>
					<option value="<?php echo $kelas->id_kelas_paralel;?>"><?php echo $kelas->kelas_paralel;?></option>
					<?php
				}
			?>
		</select>
		<br>&nbsp;
		<strong>Tahun Ajaran :</strong>
		<select class="form-control" id="bahas-tahun">
			<option value="">-- Pilih Tahun Ajaran --</option>
			<?php
				foreach($tahunajaran as $tahun){
					?>
					<option value="<?php echo $tahun->id_tahun_ajaran;?>"><?php echo $tahun->tahun_ajaran;?></option>
					<?php
				}
			?>
		</select>
	</div>
	<siv class="col-sm-12 text-center">
		<br>
		<strong>Akses Pembahasan</strong>
	</siv>
	<div class="col-sm-6">
		<br>&nbsp;
		<strong>Tgl Buka Akses :</strong>
		<input type="text" id="datepicker" class="form-control" />
	</div>
	<div class="col-sm-6">
		<br>&nbsp;
		<strong>Jam Buka Akses :</strong>
		<br>
		<select id='jam-mulai'>
			<option value="00">00</option>
			<option value="01">01</option>
			<option value="02">02</option>
			<option value="03">03</option>
			<option value="04">04</option>
			<option value="05">05</option>
			<option value="06">06</option>
			<option value="07">07</option>
			<option value="08">08</option>
			<option value="09">09</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
			<option value="13">13</option>
			<option value="14">14</option>
			<option value="15">15</option>
			<option value="16">16</option>
			<option value="17">17</option>
			<option value="18">18</option>
			<option value="19">19</option>
			<option value="20">20</option>
			<option value="21">21</option>
			<option value="22">22</option>
			<option value="23">23</option>
		</select> : 
		<select id='menit-mulai'>
			<?php
			for($x = 0; $x < 60; $x++){
				$menit = str_pad($x, 2, '0', STR_PAD_LEFT);
				?>
				<option value="<?php echo $menit;?>"><?php echo $menit;?></option>
				<?php
			}
			?>
		</select>
	</div>
	<div class="col-sm-12">
		&nbsp;
		<button class="btn btn-sm btn-danger" id="simpan-bahas" style="width: 100%;">Simpan Akses Pembahasan</button>
	</div>
</div>
<div class="col-sm-3">
</div>

<script type="text/javascript">
$(function(){
$("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });

$("#simpan-bahas").click(function(){
	idtryout		= <?php echo $idtryout;?>;
	kelas 			= $("#bahas-kelas").val();
	tahun 			= $("#bahas-tahun").val();
	tanggalmulai 	= $("#datepicker").val();
	jam_mulai 		= $("#jam-mulai").val();
	menit_mulai		= $("#menit-mulai").val();
	startdate		= tanggalmulai + " " + jam_mulai + ":" + menit_mulai + ":00";

	$.ajax({
			type: 'POST',
			url: 'proses_akses_pembahasan',
			data:{
				'idtryout'	: idtryout,
				'kelas'		: kelas,
				'tahun'		: tahun,
				'startdate'	: startdate
			}
		});
})
})
</script>

