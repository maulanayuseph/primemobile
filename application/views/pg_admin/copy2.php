<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script>
$(function(){
	$("#kelas").change(function(){
		$("#mapel").load("../banksoal/ajax_mapel/" + $("#kelas").val());
	});
	$("#mapel").change(function(){
		$("#materipokok").load("ajax_materi_pokok/" + $("#mapel").val());
	});
});
</script>
</head>

<body>
	<h1>Duplikat Latihan Soal</h1>
	<form action="<?php echo base_url('pg_admin/copy_soal/proses_copy2');?>" method="post">
	<table>
		<tr>
			<td>Kelas</td>
			<td>
				<select id="kelas" required>
					<option value="">Pilih Kelas ...</option>
					<?php
						foreach($datakelas as $kelas){
					?>
						<option value="<?php echo $kelas->id_kelas;?>"><?php echo $kelas->alias_kelas;?></option>
					<?php
						}
					?>
					
				</select>
			</td>
		</tr>
		<tr>
			<td>Kelas</td>
			<td>
				<select id="mapel" required>
					<option value="">Pilih Mapel ...</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Materi Pokok</td>
			<td>
				<select id="materipokok" name="materipokok" required>
					<option value="">Pilih Materi Pokok...</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Nama Latihan Soal</td>
			<td><input type="text" name="latihansoal" required/></td>
		</tr>
		<tr>
			<td>ID Latihan Soal Materi Awal</td>
			<td><input type="text" name="idawal" required/></td>
		</tr>
		<tr>
			<td><input type="submit" value="Duplikasi" /></td>
			<td></td>
		</tr>
	</table>
	</form>
</form>
</body>
</html>