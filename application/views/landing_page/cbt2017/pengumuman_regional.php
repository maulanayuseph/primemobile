
<!-- PERINGKAT REGIONAL SD -->
<div class="container">
	<div class="row konten-wrapper">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h3 class="panel-title">Peringkat Regional Kelas 6 SD</h3>
				</div>
				<div class="panel-body">
					<ul class="nav nav-tabs" role="tablist">
					<?php
						for($i = 1; $i <= 6; $i++){
							?>
							<li role="presentation"><a href="#regsd<?php echo $i;?>" aria-controls="regsd<?php echo $i;?>" role="tab" data-toggle="tab">Regional <?php echo $i;?></a></li>
							<?php
						}
					?>
					</ul>
					<div class="tab-content">
						<?php
						for($i = 1; $i <= 6; $i++){
							?>
							<div role="tabpanel" class="tab-pane" id="regsd<?php echo $i;?>">
								<div class="row">
									<div class="col-sm-12">
										<table class="table display table-bordered table-striped">
											<thead>
												<tr>
													<th>#</th>
													<th class="text-center">Nama</th>
													<th class="text-center">Sekolah</th>
													<th class="text-center">Kota - Provinsi</th>
													<th class="text-center">Matematika</th>
													<th class="text-center">Bahasa Indonesia</th>
													<th class="text-center">IPA</th>
													<th class="text-center">Jumlah Nilai</th>
													<th class="text-center">Skor</th>
												</tr>
											</thead>
											<tbody class="2besar">
												<?php
													$x = 1;
													foreach($regionalsd as $sd){
														if($sd->id_regional == $i){
														?>
														<tr>
															<td><?php echo $x;?></td>
															<td><?php echo $sd->nama;?>
																 <?php
																 	if($sd->nama == "Farras Faudy Hakim"){
																 		$juara = 'yes';
																 		echo "(Juara 1 Nasional)";
																 	}elseif($sd->nama == "Queen Audrey Jevonny"){
																 		$juara = 'yes';
																 		echo "(Juara 2 Nasional)";
																 	}else{
																 		$juara = "no";
																 	}
																 ?>
															</td>
															<td class="text-center"><?php echo $sd->sekolah;?></td>
															<td class="text-center"><?php echo $sd->kota;?> - <?php echo $sd->provinsi;?></td>
															<td class="text-center"><?php echo $sd->matematika;?></td>
															<td class="text-center"><?php echo $sd->bahasa_indonesia;?></td>
															<td class="text-center"><?php echo $sd->ipa;?></td>
															<td class="text-center"><?php echo $sd->jumlah;?></td>
															<td class="text-center"><?php echo $sd->skor;?></td>
														</tr>
														<?php
														$x++;
														}
													}
												?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END PERINGKAT REGIONAL SD-->

<!-- PERINGKAT REGIONAL SMP -->
<div class="container">
	<div class="row konten-wrapper">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h3 class="panel-title">Peringkat Regional Kelas 9 SMP</h3>
				</div>
				<div class="panel-body">
					<ul class="nav nav-tabs" role="tablist">
					<?php
						for($i = 1; $i <= 6; $i++){
							?>
							<li role="presentation"><a href="#regsmp<?php echo $i;?>" aria-controls="regsmp<?php echo $i;?>" role="tab" data-toggle="tab">Regional <?php echo $i;?></a></li>
							<?php
						}
					?>
					</ul>
					<div class="tab-content">
						<?php
						for($i = 1; $i <= 6; $i++){
							?>
							<div role="tabpanel" class="tab-pane" id="regsmp<?php echo $i;?>">
								<div class="row">
									<div class="col-sm-12">
										<table class="table display table-bordered table-striped">
											<thead>
												<tr>
													<th>#</th>
													<th class="text-center">Nama</th>
													<th class="text-center">Sekolah</th>
													<th class="text-center">Kota - Provinsi</th>
													<th class="text-center">Matematika</th>
													<th class="text-center">Bahasa Indonesia</th>
													<th class="text-center">Bahasa Inggris</th>
													<th class="text-center">IPA Terpadu</th>
													<th class="text-center">Jumlah Nilai</th>
													<th class="text-center">Skor</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$x = 1;
													foreach($regionalsmp as $smp){
														if($smp->id_regional == $i){
														?>
														<tr>
															<td><?php echo $x;?></td>
															<td><?php echo $smp->nama;?></td>
															<td class="text-center"><?php echo $smp->sekolah;?></td>
															<td class="text-center"><?php echo $smp->kota;?> - <?php echo $smp->provinsi;?></td>
															<td class="text-center"><?php echo $smp->matematika;?></td>
															<td class="text-center"><?php echo $smp->bahasa_indonesia;?></td>
															<td class="text-center"><?php echo $smp->bahasa_inggris;?></td>
															<td class="text-center"><?php echo $smp->ipa_terpadu;?></td>
															<td class="text-center"><?php echo $smp->jumlah;?></td>
															<td class="text-center"><?php echo $smp->skor;?></td>
														</tr>
														<?php
														$x++;
														}
													}
												?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END PERINGKAT REGIONAL SMP-->

<!-- PERINGKAT REGIONAL SMA IPA-->
<div class="container">
	<div class="row konten-wrapper">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h3 class="panel-title">Peringkat Regional Kelas 12 IPA</h3>
				</div>
				<div class="panel-body">
					<ul class="nav nav-tabs" role="tablist">
					<?php
						for($i = 1; $i <= 6; $i++){
							?>
							<li role="presentation"><a href="#regipa<?php echo $i;?>" aria-controls="regipa<?php echo $i;?>" role="tab" data-toggle="tab">Regional <?php echo $i;?></a></li>
							<?php
						}
					?>
					</ul>
					<div class="tab-content">
						<?php
						for($i = 1; $i <= 6; $i++){
							?>
							<div role="tabpanel" class="tab-pane" id="regipa<?php echo $i;?>">
								<div class="row">
									<div class="col-sm-12">
										<table class="table display table-bordered table-striped">
										<thead>
											<tr>
												<th>#</th>
												<th class="text-center">Nama</th>
												<th class="text-center">Sekolah</th>
												<th class="text-center">Kota - Provinsi</th>
												<th class="text-center">Matematika</th>
												<th class="text-center">Bahasa Indonesia</th>
												<th class="text-center">Bahasa Inggris</th>
												<th class="text-center">Fisika</th>
												<th class="text-center">Biologi</th>
												<th class="text-center">Kimia</th>
												<th class="text-center">Jumlah Nilai</th>
												<th class="text-center">Skor</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$x = 1;
												foreach($regionalsmaipa as $smp){
													if($smp->id_regional == $i){
													?>
													<tr>
														<td><?php echo $x;?></td>
														<td><?php echo $smp->nama;?></td>
														<td class="text-center"><?php echo $smp->sekolah;?></td>
														<td class="text-center"><?php echo $smp->kota;?> - <?php echo $smp->provinsi;?></td>
														<td class="text-center"><?php echo $smp->matematika;?></td>
														<td class="text-center"><?php echo $smp->bahasa_indonesia;?></td>
														<td class="text-center"><?php echo $smp->bahasa_inggris;?></td>
														<td class="text-center"><?php echo $smp->fisika;?></td>
														<td class="text-center"><?php echo $smp->biologi;?></td>
														<td class="text-center"><?php echo $smp->kimia;?></td>
														<td class="text-center"><?php echo $smp->jumlah;?></td>
														<td class="text-center"><?php echo $smp->skor;?></td>
													</tr>
													<?php
													$x++;
													}
												}
											?>
										</tbody>
									</table>
									</div>
								</div>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END PERINGKAT REGIONAL SMA IPA-->

<!-- PERINGKAT REGIONAL SMA IPA-->
<div class="container">
	<div class="row konten-wrapper">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h3 class="panel-title">Peringkat Regional Kelas 12 IPS</h3>
				</div>
				<div class="panel-body">
					<ul class="nav nav-tabs" role="tablist">
					<?php
						for($i = 1; $i <= 6; $i++){
							?>
							<li role="presentation"><a href="#regips<?php echo $i;?>" aria-controls="regips<?php echo $i;?>" role="tab" data-toggle="tab">Regional <?php echo $i;?></a></li>
							<?php
						}
					?>
					</ul>
					<div class="tab-content">
						<?php
						for($i = 1; $i <= 6; $i++){
							?>
							<div role="tabpanel" class="tab-pane" id="regips<?php echo $i;?>">
								<div class="row">
									<div class="col-sm-12">
										<table class="table display table-bordered table-striped">
											<thead>
												<tr>
														<th>#</th>
													<th class="text-center">Nama</th>
													<th class="text-center">Sekolah</th>
													<th class="text-center">Kota - Provinsi</th>
													<th class="text-center">Matematika</th>
													<th class="text-center">Bahasa Indonesia</th>
													<th class="text-center">Bahasa Inggris</th>
													<th class="text-center">Ekonomi</th>
													<th class="text-center">Geografi</th>
													<th class="text-center">Sosiologi</th>
													<th class="text-center">Jumlah Nilai</th>
													<th class="text-center">Skor</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$x = 1;
													foreach($regionalsmaips as $smp){
														if($smp->id_regional == $i){
														?>
														<tr>
															<td><?php echo $x;?></td>
															<td><?php echo $smp->nama;?></td>
															<td class="text-center"><?php echo $smp->sekolah;?></td>
															<td class="text-center"><?php echo $smp->kota;?> - <?php echo $smp->provinsi;?></td>
															<td class="text-center"><?php echo $smp->matematika;?></td>
															<td class="text-center"><?php echo $smp->bahasa_indonesia;?></td>
															<td class="text-center"><?php echo $smp->bahasa_inggris;?></td>
															<td class="text-center"><?php echo $smp->ekonomi;?></td>
															<td class="text-center"><?php echo $smp->geografi;?></td>
															<td class="text-center"><?php echo $smp->sosiologi;?></td>
															<td class="text-center"><?php echo $smp->jumlah;?></td>
															<td class="text-center"><?php echo $smp->skor;?></td>
														</tr>
														<?php
														$x++;
														}
													}
												?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END PERINGKAT REGIONAL SMA IPA-->