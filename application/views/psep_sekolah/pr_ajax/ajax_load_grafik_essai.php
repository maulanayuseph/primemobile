<canvas id="donatbenarsalah" style="width: 100%; height: 400px;">
</canvas>
<p>&nbsp;
<table class="table table-striped">
	<tr>
		<td>Jumlah Soal</td>
		<td>:</td>
		<td><?php echo count($data_soal);?></td>
	</tr>
	<tr>
		<td>Jumlah Benar</td>
		<td>:</td>
		<td><?php echo $jumlahbenarsiswa;?></td>
	</tr>
	<tr>
		<td>Nilai</td>
		<td>:</td>
		<td>
		<?php
			if($jumlahbenarsiswa > 0){
				$nilai = ($jumlahbenarsiswa / $jumlahsoal) * 100;
			}else{
				$nilai = 0;
			}
			echo $nilai;
		?>
		</td>
	</tr>
</table>
<script>
var ctx = document.getElementById("donatbenarsalah");
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: [
        "Jawaban Benar",
        "Jawaban Salah"
    ],
    datasets: [
        {
            data: [<?php echo $jumlahbenarsiswa;?>, <?php echo $jumlahsoal - $jumlahbenarsiswa;?>],
            backgroundColor: [
                "#36A2EB",
                "#B5B5B5"
            ],
            hoverBackgroundColor: [
                "#36A2EB",
                "#B5B5B5"
            ]
        }]
    }
});
</script>