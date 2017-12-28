<div class="col-md-4">
            <div class="card" style="background-color: #15c154;">
              <div class="content" style="text-align: right;">
				<h4 style="color: white;">
				<?php
					$approved = $this->model_kurikulum->hitung_soal_by_status(10);
					
					echo $approved;
				?> Soal 
				</h4>
				<div class="footer">
					<hr>
					<div class="stats" style="color: white;">
						Disetujui
					</div>
				</div>
              </div>
            </div>
          </div>
		  
		  <div class="col-md-4">
            <div class="card" style="background-color: #d9f442;">
              <div class="content" style="text-align: right;">
				<h4 style="color: black;">
				<?php echo $jumlahsoal;?> Soal 
				</h4>
				<div class="footer">
					<hr>
					<div class="stats" style="color: black;">
						Menunggu Approval
					</div>
				</div>
              </div>
            </div>
          </div>
		  
		  <div class="col-md-4">
            <div class="card" style="background-color: #af2121;">
              <div class="content" style="text-align: right;">
				<h4 style="color: white;">
				<?php
					$bahastidaklengkap = $this->model_kurikulum->hitung_soal_by_status(2);
					
					echo $bahastidaklengkap;
				?> Soal 
				</h4>
				<div class="footer">
					<hr>
					<div class="stats" style="color: white;">
						Pembahasan Tidak Lengkap
					</div>
				</div>
              </div>
            </div>
          </div>
		  
		  <div class="col-md-4">
            <div class="card" style="background-color: #af2121;">
              <div class="content" style="text-align: right;">
				<h4 style="color: white;">
				<?php
					$belumbobot = $this->model_kurikulum->hitung_soal_by_status(3);
					
					echo $belumbobot;
				?> Soal 
				</h4>
				<div class="footer">
					<hr>
					<div class="stats" style="color: white;">
						Belum ada Pembobotan
					</div>
				</div>
              </div>
            </div>
          </div>
		  
		  <div class="col-md-4">
            <div class="card" style="background-color: #af2121;">
              <div class="content" style="text-align: right;">
				<h4 style="color: white;">
				<?php
					$soalbingung = $this->model_kurikulum->hitung_soal_by_status(4);
					
					echo $soalbingung;
				?> Soal 
				</h4>
				<div class="footer">
					<hr>
					<div class="stats" style="color: white;">
						Membingungkan
					</div>
				</div>
              </div>
            </div>
          </div>
		  
		  <div class="col-md-4">
            <div class="card" style="background-color: #af2121;">
              <div class="content" style="text-align: right;">
				<h4 style="color: white;">
				<?php
					$soaldobel = $this->model_kurikulum->hitung_soal_by_status(5);
					
					echo $soaldobel;
				?> Soal 
				</h4>
				<div class="footer">
					<hr>
					<div class="stats" style="color: white;">
						Dobel
					</div>
				</div>
              </div>
            </div>
          </div>
		  
		  <div class="col-md-4">
            <div class="card" style="background-color: #af2121;">
              <div class="content" style="text-align: right;">
				<h4 style="color: white;">
				<?php
					$tidaklayak = $this->model_kurikulum->hitung_soal_by_status(6);
					
					echo $tidaklayak;
				?> Soal 
				</h4>
				<div class="footer">
					<hr>
					<div class="stats" style="color: white;">
						Tidak Layak
					</div>
				</div>
              </div>
            </div>
          </div>
		  
		  <div class="col-md-4">
            <div class="card" style="background-color: #af2121;">
              <div class="content" style="text-align: right;">
				<h4 style="color: white;">
				<?php
					$belumqc = $this->model_kurikulum->hitung_soal_by_status(8);
					
					echo $belumqc;
				?> Soal 
				</h4>
				<div class="footer">
					<hr>
					<div class="stats" style="color: white;">
						Belum QC Tentor
					</div>
				</div>
              </div>
            </div>
          </div>
		  
		  <div class="col-md-4">
            <div class="card" style="background-color: #af2121;">
              <div class="content" style="text-align: right;">
				<h4 style="color: white;">
				<?php
					$pindah = $this->model_kurikulum->hitung_soal_by_status(7);
					
					echo $pindah;
				?> Soal 
				</h4>
				<div class="footer">
					<hr>
					<div class="stats" style="color: white;">
						Perlu Dipindah
					</div>
				</div>
              </div>
            </div>
          </div>