<?php include('header_dashboard.php'); ?>

<script>
$(function(){
	$("#profil-tryout").change(function(){
		$("#list-profil").load("listprofil/" + $("#profil-tryout").val());
	});
	setInterval(function () {
	        $("#list-profil").load("listprofil/" + $("#profil-tryout").val());
	    },30000);
});
</script>


    <div class="hasil-wrapper">
	
	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="margin-top: 20px; margin-bottom: 20px;">
	<select class="form-control" id="profil-tryout">
		<option value="0">Pilih Profil Tryout...</option>
		<?php
			foreach($dataprofil as $profil){
		?>
			<option value="<?php echo $profil->id_tryout; ?>"><?php echo $profil->nama_profil; ?></option>
		<?php
			}
		?>
	</select>
	</div>
	
      <table class="table">
			<thead>
				<tr>
					<th style="text-align: center; width: 10px;">No.</th>
					<th style="text-align: center;">Foto</th>
					<th style="text-align: center;">Nama</th>
					<th style="text-align: center;">Sekolah</th>
					<th style="text-align: center;">Waktu</th>
					<th style="text-align: center;">Nilai</th>
					<th style="text-align: center;">Skor</th>
				</tr>
			</thead>
			<tbody id="list-profil">
				
			</tbody>
		</table>
    </div>
    <?php include('footer.php');?>


  <script src="js/jquery1.11.0.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/init.js"></script>
  <script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>
  
  <script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>"></script>
  <script type="text/javascript" charset="utf-8">
    $(window).load(function(){
 
    });
  </script>
  
  <!-- import chart.js -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/Chart.js');?>"></script>
    
    <!-- Menu Toggle Script -->
    <script type="text/javascript">
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
    </script>
    
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/jquery-scrolltofixed.js');?>"></script>
    <script type="text/javascript">
        $('#fixednav').scrollToFixed();
        $('#sidebar').scrollToFixed({
            marginTop: $('.header').outerHeight() - 250,
            limit: function() {
                var limit = $('.footer').offset().top - $('#sidebar').outerHeight(true) - 10;
                return limit;
            },
            zIndex: 999,
            removeOffsets: true
        });
    </script>
    
    <script type="text/javascript" src="<?php echo base_url('assets/pg_user/js/animatescroll.js');?>"></script>
    
	<script>
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: [
        "Soal Selesai",
        "Sisa Soal"
    ],
    datasets: [
        {
            data: [<?php echo $jumlahbenar->jumlah_benar;?>, <?php echo $totalsoal->jumlah_soal - $jumlahbenar->jumlah_benar;?>],
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
<script>
var ctx = document.getElementById("grafik");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
        <?php
			foreach($analisis_mapel as $statmapel){
				echo '"'.$statmapel->nama_kategori.'",';
			}
		?>
    ],
    datasets: [
        {
			label: "Skor",
            data: [
			<?php
			foreach($analisis_mapel as $statmapel){
				echo $statmapel->skor.",";
			}
			?>
			],
        }]
    }
});
</script>
  </body>
</html>