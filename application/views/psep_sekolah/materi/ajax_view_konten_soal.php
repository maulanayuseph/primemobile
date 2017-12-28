<div class="header">
    <h4 class="title text-center"><?php echo $konten->nama_sub_materi;?></h4>
</div>
<div class="content">
    <div class="row">
    	<div class="col-sm-12">
    		<table class="table table-hover">
    			<thead>
    				<tr>
    					<th style="width: 10px;">No.</th>
    					<th>Soal</th>
    					<th>Kunci Jawaban</th>
    				</tr>
    			</thead>
    			<tbody>
    				<?php
					$x=1;
					foreach($datasoal as $soal){
						?>
						<tr>
							<td style="vertical-align: top;">
								<?php echo $x;?>
							</td>
							<td>
								<div class="panel panel-default">
									<div class="panel-body">
										<?php echo $soal->isi_soal;?>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-body">
										<div class="col-md-12">
											<strong>Pilihan Jawaban : </strong>
										</div>
										<div class="col-md-6">
											A. <?php echo $soal->jawab_1;?>
										</div>
										<div class="col-md-6">
											B. <?php echo $soal->jawab_2;?>
										</div>
										<div class="col-md-12">
											&nbsp;
										</div>
										<div class="col-md-6">
											C. <?php echo $soal->jawab_3;?>
										</div>
										<div class="col-md-6">
											D. <?php echo $soal->jawab_4;?>
										</div>
										<div class="col-md-6">
											E. <?php echo $soal->jawab_5;?>
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-body">
										<div class="col-md-12">
											<strong>Pembahasan : </strong>
										</div>
										<div class="col-md-12">
											<?php echo $soal->pembahasan;?>
										</div>
									</div>
								</div>
							</td>
							<td class="text-center">
								<?php
								if($soal->kunci_jawaban == 1){
									?>
									<strong>A</strong>
									<?php
								}elseif($soal->kunci_jawaban == 2){
									?>
									<strong>B</strong>
									<?php
								}elseif($soal->kunci_jawaban == 3){
									?>
									<strong>C</strong>
									<?php
								}elseif($soal->kunci_jawaban == 4){
									?>
									<strong>D</strong>
									<?php
								}elseif($soal->kunci_jawaban == 5){
									?>
									<strong>E</strong>
									<?php
								}
								?>
							</td>
						</tr>
						<?php
						$x++;
					}
					?>
    			</tbody>
    		</table>
    	</div>
    </div>
</div>