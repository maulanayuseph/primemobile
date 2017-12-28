<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8" />
 <link rel="icon" type="image/png" href="assets/img/favicon.ico">
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

 <title>Light Bootstrap Dashboard by Creative Tim</title>

 <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <meta name="viewport" content="width=device-width" />


  <!-- Bootstrap core CSS     -->
  <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" />

  <!-- Animation library for notifications   -->
  <link href="<?php echo base_url('assets/css/animate.min.css');?>" rel="stylesheet"/>

  <!--  Light Bootstrap Table core CSS    -->
  <link href="<?php echo base_url('assets/css/light-bootstrap-dashboard.css');?>" rel="stylesheet"/>

  
  <!--  CSS for BintangSekolah PG_Admin  -->
  <link href="<?php echo base_url('assets/css/pg_admin.css" rel="stylesheet');?>" />


  <!--     Fonts and icons     -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
  <link href="<?php echo base_url('assets/css/pe-icon-7-stroke.css" rel="stylesheet');?>" />

  <!-- ADDITIONAL -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css">

</head>
<body>

<!-- Needed to override default css for Eternicode's Datepicker -->
<style type="text/css">
.datepicker.dropdown-menu {
  opacity: 100;
  display: block;
  visibility: visible;
}
</style>

<div class="wrapper">
  <?php include "sidebar.php"; ?>

  <div class="main-panel">
    <?php include "navbar.php"; ?>
    
    <div class="content">      
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="header">
                <h4 class="title">Detail Log Akses</h4>
                <p class="category">Detail riwayat akses siswa</p>
              </div>
              <div class="content">
                <div class="row">
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
                </div>

                <br>
                <div class="row">
                  <div class="col-md-12">
                    <form action="<?php echo base_url('pg_admin/log/log_by_date')?>" method="post" name="formAksesDate">
                      <div class="form-group well">
                        <label><strong>Range Tanggal</strong>
                          <br>Lihat riwayat akses berdasarkan bulan</label>
                        <div class="input-daterange input-group" id="input-daterange">
                          <input type="text" class="input-sm form-control" name="log_date_start" value="<?php echo date('F Y');?>"/>
                          <span class="input-group-addon">s/d</span>
                          <input type="text" class="input-sm form-control" name="log_date_end" value="<?php echo date('F Y');?>"/>
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

              </div>
            </div>
          </div>
        </div>
      </div> <!-- end .container-fluid -->
    </div> <!-- end .content -->

    <?php include "footer.php"; ?>

  </div>
</div>

</body>

<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/jquery-1.10.2.js" type="text/javascript');?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js" type="text/javascript');?>"></script>
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
            data: { id:<?php echo $_GET['id'];?>, log_date_start:dateStart, log_date_end:dateEnd },
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

</html>
