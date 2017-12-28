<div class="row">
  <div class="col-md-6">
	  <div class="panel panel-default">
		  <div class="panel-body">
			<?php echo $soal->isi_soal;?>
			<br><strong>Bobot :</strong>
			<br>
			<?php
			if($soal->bobot == 1){
				echo "mudah";
			}elseif($soal->bobot == 2){
				echo "sedang";
			}elseif($soal->bobot == 3){
				echo "sulit";
			}
			
			?>
		  </div>
	  </div>
	  <div class="panel panel-default">
		  <div class="panel-body">
			<b>Pembahasan Teks :</b>
			<br>&nbsp;
			<?php echo $soal->pembahasan;?>
			<b>Pembahasan Video :</b>
			<br>&nbsp;
			<?php echo $soal->pembahasan_video;?>
		  </div>
	  </div>
  </div>
  <div class="col-md-6">
	<div class="panel panel-default">
	  <div class="panel-body">
		<?php
			if($soal->kunci_jawaban == 1){
				?>
				<div class="alert alert-success" role="alert"><b>A.</b><?php echo $soal->jawab_1;?></div>
				<?php
			}else{
				?>
				<div class="alert alert-danger" role="alert"><b>A.</b><?php echo $soal->jawab_1;?></div>
				<?php
			}
		?>
		<?php
			if($soal->kunci_jawaban == 2){
				?>
				<div class="alert alert-success" role="alert"><b>B.</b><?php echo $soal->jawab_2;?></div>
				<?php
			}else{
				?>
				<div class="alert alert-danger" role="alert"><b>B.</b><?php echo $soal->jawab_2;?></div>
				<?php
			}
		?>
		<?php
			if($soal->kunci_jawaban == 3){
				?>
				<div class="alert alert-success" role="alert"><b>C.</b><?php echo $soal->jawab_3;?></div>
				<?php
			}else{
				?>
				<div class="alert alert-danger" role="alert"><b>C.</b><?php echo $soal->jawab_3;?></div>
				<?php
			}
		?>
		<?php
			if($soal->kunci_jawaban == 4){
				?>
				<div class="alert alert-success" role="alert"><b>D.</b><?php echo $soal->jawab_4;?></div>
				<?php
			}else{
				?>
				<div class="alert alert-danger" role="alert"><b>D.</b><?php echo $soal->jawab_4;?></div>
				<?php
			}
		?>
		<?php
			if(!empty($soal->jawab_5)){
				if($soal->kunci_jawaban == 5){
					?>
					<div class="alert alert-success" role="alert"><b>E.</b><?php echo $soal->jawab_5;?></div>
					<?php
				}else{
					?>
					<div class="alert alert-danger" role="alert"><b>E.</b><?php echo $soal->jawab_5;?></div>
					<?php
				}
			}
		?>
	  </div>
	</div>
  </div>
</div>