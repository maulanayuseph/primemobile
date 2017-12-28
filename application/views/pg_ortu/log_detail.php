<?php include('header_dashboard.php'); ?>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css">
<div class="container-fluid akun-container">
	<div class="col-md-4">
	<div class="card card-user">
	  <div class="image" style="background:#e85860"></div>
	  <div class="content">
		<div class="author">
		<?php
		  $src = base_url('assets/uploads/foto_siswa').'/';
		?>
		<a href="javascript:void(0)">
		  <img class="avatar border-gray" src="<?php echo $data_siswa->foto ? $src."$data_siswa->foto" : $src.'default.jpg' ?>" alt="..."/>
		  <h4 class="title"><?php echo $data_siswa->nama_siswa;?><br/>
			 <small><?php echo $data_siswa->email;?></small>
		  </h4>
		</a>
		</div>
		<hr><br>
		<div class="form-group text-center">
		  <label>Akses Terakhir</label>
		  <p class="description"><?php echo date("d M Y | H:i", strtotime($akses_terakhir))?></p>
		</div>
		<div class="form-group text-center">
		  <label>Jumlah Akses Bulan <?php echo date('F');?></label>
		  <p class="description"><?php echo (count($log_teks) + count($log_video) + count($log_soal))?> kali</p>
		</div>
	  </div>
	</div>
  </div>
  <div class="col-md-offset-1 col-md-7">
	<div id="chart-container"></div>
  </div>
  
  <div class="col-md-12">
	<form action="<?php echo base_url('parents/log_by_date')?>" method="post" name="formAksesDate">
	  <div class="form-group well">
		<label><strong>Range Tanggal</strong>
		  <br>Lihat riwayat akses berdasarkan bulan</label>
		<div class="input-daterange input-group" id="input-daterange">
		  <input type="text" class="input form-control" name="log_date_start" value="<?php echo date('F Y');?>"/>
		  <span class="input-group-addon">s/d</span>
		  <input type="text" class="input form-control" name="log_date_end" value="<?php echo date('F Y');?>"/>
		  <div class="input-group-btn">
			<button type="submit" name="submitAksesDate" class="btn btn-default"><i class="glyphicon glyphicon-th-list"></i> Tampilkan</button>
		  </div>
		</div>
	  </div>
	</form>
  </div>
  <div class="col-md-12">
	<div class="panel panel-primary">
		<ul class="nav nav-tabs nav-justified">
		  <li class="panel-heading active"><a data-toggle="tab" href="#home">Teks</a></li>
		  <li class="panel-heading"><a data-toggle="tab" href="#menu1">Video</a></li>
		  <li class="panel-heading"><a data-toggle="tab" href="#menu2">Latihan Soal</a></li>
		</ul>
	  <div class="panel-body">
		<div class="tab-content">
		  <div id="home" class="tab-pane fade in active">
			<label><strong>Materi Teks</strong>
			  <br>Bulan <span class="label_bulan"><?php echo date('F Y')?></span></label>
			<div class="table-responsive">
			  <table class="table table-hover">
				<thead>
				  <tr>
					<th>Kelas</th>
					<th>Mapel</th>
					<th class="text-center">Jumlah Akses</th>
				  </tr>
				</thead>
				<tbody id="data_teks">
				  <?php
				  foreach ($group_log_teks as $teks) 
				  { ?>
				  <tr>
					<td><?php echo $teks['alias_kelas'];?></td>
					<td><?php echo $teks['nama_mapel'];?></td>
					<td class="text-center"><?php echo $teks['jumlah_akses'];?> x</td>
				  </tr>
				  <?php 
				  } ?>
				</tbody>
			  </table>
			</div>
		  </div>
		  <div id="menu1" class="tab-pane fade">
			<label><strong>Materi Video</strong>
			  <br>Bulan <span class="label_bulan"><?php echo date('F Y')?></span></label>
			<div class="table-responsive">
			  <table class="table table-hover">
				<thead>
				  <tr>
					<th>Kelas</th>
					<th>Mapel</th>
					<th class="text-center">Jumlah Akses</th>
				  </tr>
				</thead>
				<tbody id="data_video">
				  <?php
				  foreach ($group_log_video as $video) 
				  { ?>
				  <tr>
					<td><?php echo $video['alias_kelas'];?></td>
					<td><?php echo $video['nama_mapel'];?></td>
					<td class="text-center"><?php echo $video['jumlah_akses'];?> x</td>
				  </tr>
				  <?php 
				  } ?>
				</tbody>
			  </table>
			</div>
		  </div>
		  <div id="menu2" class="tab-pane fade">
			<label><strong>Latihan Soal</strong>
			  <br>Bulan <span class="label_bulan"><?php echo date('F Y')?></span></label>
			<div class="table-responsive">
			  <table class="table table-hover">
				<thead>
				  <tr>
					<th>Kelas</th>
					<th>Mapel</th>
					<th class="text-center">Jumlah Akses</th>
				  </tr>
				</thead>
				<tbody id="data_soal">
				  <?php
				  foreach ($group_log_soal as $soal) 
				  { ?>
				  <tr>
					<td><?php echo $soal['alias_kelas'];?></td>
					<td><?php echo $soal['nama_mapel'];?></td>
					<td class="text-center"><?php echo $soal['jumlah_akses'];?> x</td>
				  </tr>
				  <?php 
				  } ?>
				</tbody>
			  </table>
			</div>
		  </div>
		</div>
	  </div>
	</div>
  </div>
</div>

<?php include('footer.php'); ?>

   <script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>
  
  <script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>"></script>
  <script src="<?php echo base_url('assets/dashboard/js/init.js');?>"></script>
  
  <!-- JS Function for this Modal -->
 <!--   Core JS Files   -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>


<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo base_url('assets/js/light-bootstrap-dashboard.js');?>"></script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="<?php echo base_url()?>/assets/js/plugins/highcharts/themes/dark-unica.js"></script>


<!-- PLUGINS FUNCTION -->
<!-- Needed for Highcharts plugin -->
<script type="text/javascript">
  $(function () {
    $(document).ready(function () {
        // Build the chart
      $('#chart-container').highcharts({
          chart: {
              plotBackgroundColor: null,
              plotBorderWidth: null,
              plotShadow: false,
              type: 'pie'
          },
          title: {
              text: <?php echo "'Grafik akses ".$data_siswa->nama_siswa."'";?>
          },
          subtitle: {
              text: <?php echo "'".date('F Y')."'";?>
          },
          tooltip: {
              // pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
              pointFormat: '{series.name}: <b>{point.y} kali</b>'
          },
          plotOptions: {
              pie: {
                  allowPointSelect: true,
                  cursor: 'pointer',
                  dataLabels: {
                      enabled: true,
                      format: '{series.name}: <b>{point.y} kali</b>'
                  },
                  showInLegend: true
              }
          },
          series: [{
              name: 'Akses',
              colorByPoint: true,
              data: [
              {
                  name: 'Materi Teks',
                  y: <?php echo count($log_teks)?>,
                  // sliced: true,
                  // selected: true
              }, {
                  name: 'Materi Video',
                  y: <?php echo count($log_video)?>,
              }, {
                  name: 'Latihan Soal',
                  y: <?php echo count($log_soal)?>,
              }]
          }]
        });

        $('#input-daterange').datepicker({
          format: "MM yyyy",
          startView: 1,
          minViewMode: 1,
          maxViewMode: 2,
          todayBtn: "linked",
          // language: "id"
        });

        $('button[name^=submitAksesDate]').click(function(e) {
          e.preventDefault();
          var dateStart = $('input[name^=log_date_start]').val();
          var dateEnd = $('input[name^=log_date_end]').val();
          // console.log(dateStart +' - '+ dateEnd + ' ' + $('form[name^=formAksesDate]').attr('action'));
          
          $.ajax({
            url: $('form[name^=formAksesDate]').attr('action'),
            type: 'POST',
            dataType: 'json',
            data: { id:<?php echo $_SESSION['id_ortu_siswa'];?>, log_date_start:dateStart, log_date_end:dateEnd },
            success: function(response) {
              $('.label_bulan').text(dateStart +' - '+ dateEnd);
              $('#data_teks').html(response.data_teks);
              $('#data_video').html(response.data_video);
              $('#data_soal').html(response.data_soal);

              var chart = $('#chart-container').highcharts();
              chart.series[0].setData([response.count_teks, response.count_video, response.count_soal]);
              chart.setTitle(null, { text: dateStart +' - '+ dateEnd});
              // chart.redraw();
            }
          });
        })
      });
    });
</script>
  </body>
</html>
