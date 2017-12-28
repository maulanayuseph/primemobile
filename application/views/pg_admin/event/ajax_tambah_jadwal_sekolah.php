<div class="col-sm-3">
</div>
<div class="col-sm-6">
	<div class="col-sm-12">
		<strong>Provinsi Sekolah :</strong>
		<br>
		<select class="form-control" id="set-provinsi">
			<option value=''>-- Pilih Provinsi Sekolah --</option>
			<?php
				foreach($dataprovinsi as $provinsi){
					?>
					<option value="<?php echo $provinsi->id_provinsi;?>"><?php echo $provinsi->nama_provinsi;?></option>
					<?php
				}
			?>
		</select>
		<br>
		<br>
		<strong>Kota Sekolah :</strong>
		<select class="form-control" id="set-kota">
			<option value="">-- Pilih Kota Sekolah --</option>
		</select>
		<br>
		<br>
		<strong>Sekolah :</strong>
		<select class="form-control" id="set-sekolah">
			<option value="">-- Pilih Sekolah --</option>
		</select>
	</div>
	<div class="col-sm-6">
		<br>&nbsp;
		<strong>Tgl Mulai :</strong>
		<input type="text" id="datepicker" class="form-control" />
	</div>
	<div class="col-sm-6">
		<br>&nbsp;
		<strong>Jam Mulai :</strong>
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
	</div>
	<div class="col-sm-6">
		<br>&nbsp;
		<strong>Tgl Akhir :</strong>
		<input type="text" id="datepicker2" class="form-control" />
	</div>
	<div class="col-sm-6">
		<br>&nbsp;
		<strong>Jam Akhir :</strong>
		<br>
		<select id='jam-akhir'>
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
		<select id='menit-akhir'>
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
		<button class="btn btn-sm btn-danger" id="simpan-jadwal" style="width: 100%;">Simpan Jadwal</button>
	</div>
</div>
<div class="col-sm-3">
</div>
<script type="text/javascript">
$(function(){
	$("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
	$("#datepicker2").datepicker({ dateFormat: 'yy-mm-dd' });
	$("#set-provinsi").change(function(){
		$("#set-kota").load("../ajax_kota_by_provinsi/" + $(this).val());
	});
	$("#set-kota").change(function(){
		$("#set-sekolah").load("../ajax_sekolah_by_kota/" + $(this).val() + "/" + <?php echo $profil->id_kelas;?>);
	});

	$("#simpan-jadwal").click(function(){
		idevent 	= <?php echo $event->id_event;?>,
		idprofil 	= <?php echo $profil->id_tryout;?>,
		idsekolah 	= $("#set-sekolah").val();

		tanggalmulai 	= $("#datepicker").val();
		jam_mulai 		= $("#jam-mulai").val();
		menit_mulai		= $("#menit-mulai").val();
		startdate		= tanggalmulai + " " + jam_mulai + ":" + menit_mulai + ":00";

		tanggalakhir 	= $("#datepicker2").val();
		jam_akhir 		= $("#jam-akhir").val();
		menit_akhir		= $("#menit-akhir").val();
		enddate			= tanggalakhir + " " + jam_akhir + ":" + menit_akhir + ":00";

		if(idsekolah !== "" && tanggalmulai !== "" && tanggalakhir !== ""){
			$.ajax({
				type: 'POST',
				url: '../proses_tambah_jadwal',
				data:{
					'idevent'	: idevent,
					'idsekolah'	: idsekolah,
					'idprofil'	: idprofil,
					'startdate'	: startdate,
					'enddate'	: enddate
				}
			});
		}else{
			alert("Lengkapi form jadwal sebelum simpan");
		}
	})
})
</script>