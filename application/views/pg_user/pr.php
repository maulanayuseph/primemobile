<?php
include('header_dashboard.php');
?>


    <div class="container-fluid akun-container">
	<div class="col-lg-12">	
		<!-- SPACE UNTUK MEMUNCULKAN PR -->
		<!-- ########################## -->
		<!-- ########################## -->
		<?php
		if($tahunajaran !== null){
			if($datapr !== null){
			?>
				<div class="content">
					<div class="tabel-analisa waktu">
						<div class="title"><img src="<?php echo base_url('assets/dashboard/images/file.png'); ?>">Pekerjaan Rumah</div>
					</div>
				</div>
				<div class="row">
				<div class="col-lg-12">
			<?php
				foreach($datapr as $pr){
					?>
						<div class="mapel-container">
							<div class="content">
								<h4><?php echo $pr->nama_pr;?></h4>
								<table class="table table-striped">
									<tbody>
										<tr>
											<td>Jumlah Soal</td>
											<td>:</td>
											<td>
											<?php
												$jumlahsoal = $this->model_pr->jumlah_soal($pr->id_pr);
												echo $jumlahsoal;
											?>
											</td>
										</tr>
										<tr>
											<td>Batas Submit</td>
											<td>:</td>
											<td><?php echo $pr->deadline;?></td>
										</tr>
									</tbody>
								</table>
								<?php
									$tanggalsekarang = date('Y-m-d');
									$caristatuspr = $this->model_pr->fetch_status_pr($pr->id_pr, $this->session->userdata('id_siswa'));
									if($pr->deadline >= $tanggalsekarang){
										if($caristatuspr == null){
											?>
											<a class="btn btn-primary btn-kelas" style="float: right; margin: 15px 0;" href="<?php echo  base_url("pr/mulai/".$pr->id_pr);?>">Kerjakan PR</a>
											<?php
										}else{
											if($caristatuspr->status == 0){
												?>
												<a class="btn btn-warning btn-kelas" style="float: right; margin: 15px 0;" href="<?php echo  base_url("pr/mulai/".$pr->id_pr);?>">Lanjutkan PR</a>
												<?php
											}else{
												?>
												<a class="btn btn-success btn-kelas" style="float: right; margin: 15px 0;" href="<?php echo  base_url("pr/statistik/".$pr->id_pr);?>">Lihat Penilaian</a>
												<?php
											}
										}
									}else{
										if($caristatuspr !== null and $caristatuspr->status == 1){
											?>
											<a class="btn btn-success btn-kelas" style="float: right; margin: 15px 0;" href="<?php echo  base_url("pr/statistik/".$pr->id_pr);?>">Lihat Penilaian</a>
											<?php
										}
									}
								?>
							</div>
						</div>
					<?php
				}
				?>
				</div>
				</div>
			<?php	
			}

		}
		?>
		<!-- ########################## -->
		<!-- ########################## -->
		<!-- END SPACE UNTUK MEMUNCULKAN PR -->
</div>
</div>

<?php include('modal_unlock_bonus.php');?>
  <?php include('modal_video_motivasi.php');?>
<?php include('footer.php'); ?>

   <script src="<?php echo base_url('assets/dashboard/js/jquery1.11.0.min.js');?>"></script>
  
  <script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js');?>"></script>
  <script src="<?php echo base_url('assets/dashboard/js/init.js');?>"></script>
  
  <!-- JS Function for this Modal -->
  <script type="text/javascript">
    $('#unlockBonus_modal').on('show.bs.modal', function (event) {
      var toggle = $(event.relatedTarget) // toggle that triggered the modal
      var judulBonus = toggle.text() // Extract info from data-* attributes
      var id_bonus = toggle.data('value')
      var modal = $(this)
      modal.find('.judul_bonus').text(judulBonus)
      modal.find('input[name=hidden_row_id]').val(id_bonus)
    })
  </script>

  <script type="text/javascript">
  $(document).ready(function() {
    var form = $('#unlockBonus_form');  
    console.log(form.attr('action'));
    form.submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: form.attr('action'),
        type: 'POST',
        dataType: 'json',
        data: { 
          id_bonus: $('#hidden_row_id').val()  
        },
        success: function(response){
          $("#poinSiswa").html(response.poin);
          if(response.result != 0) {
            // fetch_select_kategori();
            // $("#tambah_kategori").val('');
            // $("#alertDangerUnlockBonus").slideUp();
            // $("#alertSuccessUnlockBonus").slideDown().delay(5000).slideUp();
            setTimeout(function() { 
              location.reload(); 
            }, 0);
          } 
          else {
            $("#alertSuccessUnlockBonus").slideUp();
            $("#msgDangerUnlockBonus").text(response.msg);
            $("#alertDangerUnlockBonus").slideDown().delay(5000).slideUp();
          }
        }
      })
    });
	<?php
	foreach($kelasaktif as $kelas){
		foreach($data_profil as $profil){
			if($profil->id_kelas == $kelas->id_kelas and $profil->status == 1){
	?>
	$('#modalcbtcontest<?php echo $profil->id_tryout; ?>').modal('show');
	<?php
			}
		}
	}
	?>
  });
  </script>

  <script>
      if ( supports_media_source() ) {
        // supported.style.display="";
        videoObj.style.display="";
      }
      else {
        notsupported.style.display="";
      }
      var video;
      var player;
      var source; 
      var estimator;

      function connect(src = null)
      {
        if(connectObj.textContent == "Stop") 
        {
          dashStop();
          connectObj.textContent = "Start";
          statusStr.textContent = "Disconnected";
        }
        else 
        {
          
          connectObj.textContent = "Stop";
          statusStr.textContent = "Playing";
          
          if ( video == null )
          { video = document.querySelector("video"); }

          if ( player == null )
          { player = new shaka.player.Player(video); }

          // Attach the player to the window so that it can be easily debugged.
          window.player = player;

          // Listen for errors from the Player.
          player.addEventListener('error', failed );

          // Construct a DashVideoSource to represent the DASH manifest.
          //var mpdUrl = 'http://turtle-tube.appspot.com/t/t2/dash.mpd';
          if ( estimator != null ) { estimator=null; }
            estimator = new shaka.util.EWMABandwidthEstimator();

          if ( source != null )
          { source = null; }

          if (src !== null)
          {
            // source = new shaka.player.DashVideoSource("<?php //echo $data->video_materi ? $data->video_materi : '';?>", null, estimator);
            // source = new shaka.player.DashVideoSource("http://45.64.97.197:1935/TestVOD/mp4:soal16.mp4/manifest.mpd", null, estimator);
            source = new shaka.player.DashVideoSource(src, null, estimator);

            // Load the source into the Player.
            player.load(source);
          }
        }
      }

      function failed(e)
      {
        var done = false;
        if ( e.detail == 'Error: Network failure.' )
        {
          statusStr.textContent = 'Network Connection Failed.';
          done = true;
        }
        
        if ( e.detail.status!=200 && done == false )
        {
          switch ( e.detail.status )
          {
          case 404:
            statusStr.textContent = e.detail.url+' not found.';
          break;
          
          default:
            statusStr.textContent = 'Error '+e.detail.status+' for '+e.detail.url;
          break;
          }
        }
      }

      function dashStop()
      {
        if(player!=null)
        {
          console.log("player: " + player);
          player.unload();
        }
        connectObj.textContent = "Start";
        statusStr.textContent = "Disconnected";
      }

    </script>
    <!-- /NEEDED FOR SHAKA PLAYER -->

    <script type="text/javascript">
      function playVideo() {
          var video = $("#videoObj");
          // video.paused ? video.get(0).play() : video.get(0).pause();
          video.get(0).play();
          console.log("(onPlay) isPaused: " + video.get(0).paused)
      }        

      function pauseVideo() {
          var video = $("#videoObj");
          // video.paused ? video.get(0).play() : video.get(0).pause();
          video.get(0).pause();
          console.log("(onPause) isPaused: " + video.get(0).paused)
      }

      $("#videoMotivasiModal").on("shown.bs.modal", function(e){
        var video = $("#videoObj");
        console.log('$videoMotivasiModal shown');
        // if(video.get(0).paused == true){
          playVideo();
        // }
      })

      $("#videoMotivasiModal").on("hidden.bs.modal", function(e){
        var video = $("#videoObj");
        console.log('#videoMotivasiModal hidden');
        // if(video.get(0).paused == false){
          pauseVideo();
        // }
      })        

      $(document).ready(function(){
        var video = $("#videoObj");
        var id = null;
        
        $(".modal-video-motivasi").on("click", function(e) 
        {
          if(id == null)
          { id = $(this).attr("id"); }

          var element = $(this);
          var src = element.data("source");

          if(source == null) {
            connect(src);
            console.log("(onClick) isPaused: " + video.get(0).paused);
          }
          else if(id !== $(this).attr('id')) {
            id = $(this).attr('id'); //update the id value
            dashStop();
            connect(src);
          } 
        })

        console.log("(onStart) isPaused: " + video.get(0).paused);    

      });
    </script>

  <script type="text/javascript" charset="utf-8">
    $(window).load(function(){
 
    });
  </script>
  
  <?php include('modal_aktivasi_agcu.php'); ?>
  <?php include('modal_profil.php'); ?>

  </body>
</html>
