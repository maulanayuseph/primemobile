<html>
<head>
</head>

<body>
	<h1>Duplikat Latihan Soal 3</h1>
	<p>di fitur duplikat 3 ini, semua latihan soal dari ID sub materi awal akan di duplikat ke ID sub materi tujuan dan soal2 yang ada di ID sub materi tujuan akan dihapus sebelumnya
	<form action="<?php echo base_url('pg_admin/copy_soal/proses_copy3');?>" method="post">
	<table>
		<tr>
			<td>ID Sub Materi Awal</td>
			<td><input type="text" name="idawal" required/></td>
		</tr>
		<tr>
			<td>ID Sub Materi Tujuan</td>
			<td><input type="text" name="idtujuan" required/></td>
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