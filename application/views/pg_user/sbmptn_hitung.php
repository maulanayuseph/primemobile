<?php
//cari kelompok tes

foreach($setprodi as $prodi){
	//deklarasi N
	for($i=1; $i<=10; $i++){
		$N[$prodi->id_set_prodi][$i] = 0;
	}
	//echo $prodi->kelompok;
	$k[$prodi->id_set_prodi] = $prodi->kelompok;
	$carisiswa = $this->model_sbmptn->fetch_set_kelompok_hasil($prodi->kelompok);
	//$jumlahsiswa[$prodi->id_set_prodi] = count($carisiswa);
	$jumlahsiswa = 0;
	foreach($carisiswa as $siswa){
		$jumlahsiswa += 1;
		//echo $siswa->id_siswa;
		//cari apakah siswa sudah melakukan keseluruhan test
		
		//pertama cek status TPA siswa
		if($testpa !== null){
			$caritryout = $this->model_sbmptn->get_tryout_by_profil2($testpa->id_tryout);
			
			$y = 1;
			foreach($caritryout as $tryout){
				//cari apakah siswa sudah mengerjakan seluruh test TPA
				$cek[$siswa->id_siswa][$y] = $this->model_sbmptn->cek_tuntas_siswa($siswa->id_siswa, $tryout->id_kategori);
				
				$y++;
			}
			if(isset($cek[$siswa->id_siswa][1]) and isset($cek[$siswa->id_siswa][2]) and isset($cek[$siswa->id_siswa][3])){
    			if($cek[$siswa->id_siswa][1] == 1 and $cek[$siswa->id_siswa][2] == 1 and $cek[$siswa->id_siswa][3] == 1){
    				$statustpasiswa[$siswa->id_siswa] = "selesai";
    			}else{
    				$statustpasiswa[$siswa->id_siswa] = "belum";
    			}
			}else{
			   $statustpasiswa[$siswa->id_siswa] = "belum"; 
			}
		}
		//hasil cek adalah $statustpasiswa[$siswa->id_siswa]
		//end cek status TPA SISWA
		
		//kedua cek status TKDU siswa
		if($testkdu !== null){
			//cari kategori tryout yang ada
			$caritryout = $this->model_sbmptn->get_tryout_by_profil2($testkdu->id_tryout);
			
			$y = 1;
			foreach($caritryout as $tryout){
				//cari apakah siswa sudah mengerjakan seluruh test TKDU
				$cektkdu[$siswa->id_siswa][$y] = $this->model_sbmptn->cek_tuntas_siswa($siswa->id_siswa, $tryout->id_kategori);
				
				$y++;
			}
			if(isset($cektkdu[$siswa->id_siswa][1]) and isset($cektkdu[$siswa->id_siswa][2]) and isset($cektkdu[$siswa->id_siswa][3])){
    			if($cektkdu[$siswa->id_siswa][1] == 1 and $cektkdu[$siswa->id_siswa][2] == 1 and $cektkdu[$siswa->id_siswa][3] == 1){
    				$statustkdusiswa[$siswa->id_siswa] = "selesai";
    			}else{
    				$statustkdusiswa[$siswa->id_siswa] = "belum";
    			}
			}else{
			   $statustkdusiswa[$siswa->id_siswa] = "belum"; 
			}
		}
		//hasil cek adalah $statustkdusiswa[$siswa->id_siswa]
		//end cek status TKDU siswa
		
		//ketiga, cek ketuntasan tes berdasarkan kelompok
		if($k[$prodi->id_set_prodi] == "SAINTEK"){
			if($tessaintek !== null){
				//cari kategori tryout yang ada
				$caritryout = $this->model_sbmptn->get_tryout_by_profil2($tessaintek->id_tryout);
				
				$y = 1;
				foreach($caritryout as $tryout){
					//cari apakah siswa sudah mengerjakan seluruh test TKD
					$cektkd[$siswa->id_siswa][$y] = $this->model_sbmptn->cek_tuntas_siswa($siswa->id_siswa, $tryout->id_kategori);
					
					$y++;
				}
				if(isset($cektkd[$siswa->id_siswa][1]) and isset($cektkd[$siswa->id_siswa][2]) and isset($cektkd[$siswa->id_siswa][3])){
    				if($cektkd[$siswa->id_siswa][1] == 1 and $cektkd[$siswa->id_siswa][2] == 1 and $cektkd[$siswa->id_siswa][3] == 1){
    					$statustkdsiswa[$siswa->id_siswa] = "selesai";
    				}else{
    					$statustkdsiswa[$siswa->id_siswa] = "belum";
    				}
				}else{
    			   $statustkdsiswa[$siswa->id_siswa] = "belum"; 
    			}
			}
		}elseif($k[$prodi->id_set_prodi] == "SOSHUM"){
			if($tessoshum !== null){
				//cari kategori tryout yang ada
				$caritryout = $this->model_sbmptn->get_tryout_by_profil2($tessoshum->id_tryout);
				
				$y = 1;
				foreach($caritryout as $tryout){
					//cari apakah siswa sudah mengerjakan seluruh test TKD
					$cektkd[$siswa->id_siswa][$y] = $this->model_sbmptn->cek_tuntas_siswa($siswa->id_siswa, $tryout->id_kategori);
					
					$y++;
				}
				if(isset($cektkd[$siswa->id_siswa][1]) and isset($cektkd[$siswa->id_siswa][2]) and isset($cektkd[$siswa->id_siswa][3])){
    				if($cektkd[$siswa->id_siswa][1] == 1 and $cektkd[$siswa->id_siswa][2] == 1 and $cektkd[$siswa->id_siswa][3] == 1){
    					$statustkdsiswa[$siswa->id_siswa] = "selesai";
    				}else{
    					$statustkdsiswa[$siswa->id_siswa] = "belum";
    				}
				}else{
    			   $statustkdsiswa[$siswa->id_siswa] = "belum"; 
    			}
			}
		}
		//end cek status TKD saintek/soshum siswa
		
		//MULAI PERHITUNGAN NILAI MASING2 TES SISWA JIKA SUDAH MENYELESAIKAN SEMUA TES
		if($statustpasiswa[$siswa->id_siswa] == "selesai" and $statustkdusiswa[$siswa->id_siswa] == "selesai" and $statustkdsiswa[$siswa->id_siswa] == "selesai"){
			//cari nilai TPA
			//***************
			$caritryout = $this->model_sbmptn->get_tryout_by_profil2($testpa->id_tryout);
			
			$a = 1;
			foreach($caritryout as $tryout){
				$benar 					= $this->model_dashboard->cari_skor($tryout->id_kategori, $siswa->id_siswa);
				$salah 					= $this->model_dashboard->cari_skor_salah($tryout->id_kategori, $siswa->id_siswa);
				$salah 					= $salah * -1;
				
				$nilaitpa[$prodi->id_set_prodi][$siswa->id_siswa][$a]			= ($benar * 4) + $salah;
				
				///echo "<br>" . $prodi->id_set_prodi . "." . $siswa->id_siswa . "." . $a . " " . $nilaitpa[$prodi->id_set_prodi][$siswa->id_siswa][$a];
				$a++;
			}
			//End  nilai TPA
			//***************
			
			//cari nilai TKDU
			//***************
			$caritryout = $this->model_sbmptn->get_tryout_by_profil2($testkdu->id_tryout);
			
			$a = 4;
			foreach($caritryout as $tryout){
				$benar 					= $this->model_dashboard->cari_skor($tryout->id_kategori, $siswa->id_siswa);
				$salah 					= $this->model_dashboard->cari_skor_salah($tryout->id_kategori, $siswa->id_siswa);
				$salah 					= $salah * -1;
				
				$nilaitkdu[$prodi->id_set_prodi][$siswa->id_siswa][$a]			= ($benar * 4) + $salah;
				
				///echo "<br>" . $prodi->id_set_prodi . "." . $siswa->id_siswa . "." . $a . " " . $nilaitkdu[$prodi->id_set_prodi][$siswa->id_siswa][$a];
				$a++;
			}
			//End  nilai TKDU
			//***************
			
			//cari nilai TKD
			//***************
			if($k[$prodi->id_set_prodi] == "SAINTEK"){
				$caritryout = $this->model_sbmptn->get_tryout_by_profil2($tessaintek->id_tryout);
			
				$a = 7;
				foreach($caritryout as $tryout){
					$benar 					= $this->model_dashboard->cari_skor($tryout->id_kategori, $siswa->id_siswa);
					$salah 					= $this->model_dashboard->cari_skor_salah($tryout->id_kategori, $siswa->id_siswa);
					$salah 					= $salah * -1;
					
					$nilaitkd[$prodi->id_set_prodi][$siswa->id_siswa][$a]			= ($benar * 4) + $salah;
					
					///echo "<br>" . $prodi->id_set_prodi . "." . $siswa->id_siswa . "." . $a . " " . $nilaitkd[$prodi->id_set_prodi][$siswa->id_siswa][$a];
					$a++;
				}
			}elseif($k[$prodi->id_set_prodi] == "SOSHUM"){
				$caritryout = $this->model_sbmptn->get_tryout_by_profil2($tessoshum->id_tryout);
			
				$a = 7;
				foreach($caritryout as $tryout){
					$benar 					= $this->model_dashboard->cari_skor($tryout->id_kategori, $siswa->id_siswa);
					$salah 					= $this->model_dashboard->cari_skor_salah($tryout->id_kategori, $siswa->id_siswa);
					$salah 					= $salah * -1;
					
					$nilaitkd[$prodi->id_set_prodi][$siswa->id_siswa][$a]			= ($benar * 4) + $salah;
					
					///echo "<br>" . $prodi->id_set_prodi . "." . $siswa->id_siswa . "." . $a . " " . $nilaitkd[$prodi->id_set_prodi][$siswa->id_siswa][$a];
					$a++;
				}
			}
			//End  nilai TKD
			//***************
			
			for($a=1;$a<=3;$a++){
				//$N[$prodi->id_set_prodi][$i] = 0;
				//echo "<br>yang di jumlah untuk N" . $i;
				$N[$prodi->id_set_prodi][$a] += $nilaitpa[$prodi->id_set_prodi][$siswa->id_siswa][$a];
				//echo "n" . $i . " = " . $N[$prodi->id_set_prodi][][$i];
			}
			for($b=4;$b<=6;$b++){
				$N[$prodi->id_set_prodi][$b] += $nilaitkdu[$prodi->id_set_prodi][$siswa->id_siswa][$b];
			}
			for($c=7;$c<=10;$c++){
				$N[$prodi->id_set_prodi][$c] += $nilaitkd[$prodi->id_set_prodi][$siswa->id_siswa][$c];
			}
			
		}
		//END
		//$N[$prodi->id_set_prodi][1] = 0;
		//$N[$prodi->id_set_prodi][1] += $nilaitpa[$prodi->id_set_prodi][$siswa->id_siswa][1];
		
		//$N1 = 0;
		//$N1 += $nilaitpa[$prodi->id_set_prodi][$siswa->id_siswa][1];
		
		
		//echo $statustkdsiswa[$siswa->id_siswa] . " ";
	}
	if($statustpasiswa[$this->session->userdata('id_siswa')] !== "selesai" and $statustkdusiswa[$this->session->userdata('id_siswa')] !== "selesai" and $statustkdsiswa[$this->session->userdata('id_siswa')] !== "selesai"){
		for($i = 1; $i <= 10; $i++){
			$N[$prodi->id_set_prodi][$i] = 0;
		}
	}
	///echo "<br>N1 = " . $N[$prodi->id_set_prodi][1];
	///echo "<br>N2 = " . $N[$prodi->id_set_prodi][2];
	///echo "<br>N3 = " . $N[$prodi->id_set_prodi][3];
	///echo "<br>N4 = " . $N[$prodi->id_set_prodi][4];
	///echo "<br>N5 = " . $N[$prodi->id_set_prodi][5];
	///echo "<br>N6 = " . $N[$prodi->id_set_prodi][6];
	///echo "<br>N7 = " . $N[$prodi->id_set_prodi][7];
	///echo "<br>N8 = " . $N[$prodi->id_set_prodi][8];
	///echo "<br>N9 = " . $N[$prodi->id_set_prodi][9];
	///echo "<br>N10 = " . $N[$prodi->id_set_prodi][10];
	
	for($i=1; $i<=3; $i++){
		if(!isset($nilaitpa[$prodi->id_set_prodi][$this->session->userdata('id_siswa')][$i])){
			$nilaitpa[$prodi->id_set_prodi][$this->session->userdata('id_siswa')][$i] = 0;
		}
		$Na[$prodi->id_set_prodi][$i] = number_format(($nilaitpa[$prodi->id_set_prodi][$this->session->userdata('id_siswa')][$i] - ($N[$prodi->id_set_prodi][$i] / $jumlahsiswa))*($nilaitpa[$prodi->id_set_prodi][$this->session->userdata('id_siswa')][$i] - ($N[$prodi->id_set_prodi][$i] / $jumlahsiswa)), 2, ".","");
		///echo "<br>Na".$i." = " . $Na[$prodi->id_set_prodi][$i];
	}
	for($i=4; $i<=6; $i++){
		$Na[$prodi->id_set_prodi][$i] = number_format(($nilaitkdu[$prodi->id_set_prodi][$this->session->userdata('id_siswa')][$i] - ($N[$prodi->id_set_prodi][$i] / $jumlahsiswa))*($nilaitkdu[$prodi->id_set_prodi][$this->session->userdata('id_siswa')][$i] - ($N[$prodi->id_set_prodi][$i] / $jumlahsiswa)), 2, ".","");
		
		///echo "<br>Na".$i." = " . $Na[$prodi->id_set_prodi][$i];
	}
	for($i=7; $i<=10; $i++){
		$Na[$prodi->id_set_prodi][$i] =  number_format(($nilaitkd[$prodi->id_set_prodi][$this->session->userdata('id_siswa')][$i] - ($N[$prodi->id_set_prodi][$i] / $jumlahsiswa))*($nilaitkd[$prodi->id_set_prodi][$this->session->userdata('id_siswa')][$i] - ($N[$prodi->id_set_prodi][$i] / $jumlahsiswa)), 2, ".","");
		///echo "<br>Na".$i." = " . $Na[$prodi->id_set_prodi][$i];
	}
	
	if($statustpasiswa[$this->session->userdata('id_siswa')] !== "selesai" and $statustkdusiswa[$this->session->userdata('id_siswa')] !== "selesai" and $statustkdsiswa[$this->session->userdata('id_siswa')] !== "selesai"){
		$NM[$prodi->id_set_prodi] = 0;
	}else{
		$NM[$prodi->id_set_prodi] = 0;
		for($i = 1; $i <= 3; $i++){
			$NM[$prodi->id_set_prodi] += $nilaitpa[$prodi->id_set_prodi][$this->session->userdata('id_siswa')][$i];
		}
		for($i = 4; $i <= 6; $i++){
			$NM[$prodi->id_set_prodi] += $nilaitkdu[$prodi->id_set_prodi][$this->session->userdata('id_siswa')][$i];
		}
		for($i = 7; $i <= 10; $i++){
			$NM[$prodi->id_set_prodi] += $nilaitkd[$prodi->id_set_prodi][$this->session->userdata('id_siswa')][$i];
		}
	}
	
	$jumlahN[$prodi->id_set_prodi] = 0;
	for($i=1; $i<=10; $i++){
		$jumlahN[$prodi->id_set_prodi] += $Na[$prodi->id_set_prodi][$i];
	}
	///echo "<br>jumlah N : ".$jumlahN[$prodi->id_set_prodi];
	
	if($jumlahN[$prodi->id_set_prodi] == 0){
	    $akarjumlahpernminsatu[$prodi->id_set_prodi] = 1;
	}else{
	    $akarjumlahpernminsatu[$prodi->id_set_prodi] = number_format(sqrt($jumlahN[$prodi->id_set_prodi]/($jumlahsiswa - 1)), 2, ".","");
	}
	
	///echo "<br>jumlah per n min satu : ".$akarjumlahpernminsatu[$prodi->id_set_prodi];
	
	for($i=1; $i<=3; $i++){
		if($N[$prodi->id_set_prodi][$i] !== 0){
			$nceeb[$prodi->id_set_prodi][$i] = number_format(500+(($nilaitpa[$prodi->id_set_prodi][$this->session->userdata('id_siswa')][$i] - ($N[$prodi->id_set_prodi][$i] / $jumlahsiswa)) / $akarjumlahpernminsatu[$prodi->id_set_prodi]) * 100, 2, ".","");
		}else{
			$nceeb[$prodi->id_set_prodi][$i] = 0;
		}
		///echo "<br>NCEEB" . $i ." = " . $nceeb[$prodi->id_set_prodi][$i];
	}
	for($i=4; $i<=6; $i++){
		if($N[$prodi->id_set_prodi][$i] !== 0){
			$nceeb[$prodi->id_set_prodi][$i] = number_format(500+( ($nilaitkdu[$prodi->id_set_prodi][$this->session->userdata('id_siswa')][$i] - ($N[$prodi->id_set_prodi][$i] / $jumlahsiswa)) / $akarjumlahpernminsatu[$prodi->id_set_prodi]) * 100, 2, ".","");
		}else{
			$nceeb[$prodi->id_set_prodi][$i] = 0;
		}
		///echo "<br>NCEEB" . $i ." = " . $nceeb[$prodi->id_set_prodi][$i];
	}
	for($i=7; $i<=10; $i++){
		if($N[$prodi->id_set_prodi][$i] !== 0){
			$nceeb[$prodi->id_set_prodi][$i] = number_format(500+( ($nilaitkd[$prodi->id_set_prodi][$this->session->userdata('id_siswa')][$i] - ($N[$prodi->id_set_prodi][$i] / $jumlahsiswa)) / $akarjumlahpernminsatu[$prodi->id_set_prodi]) * 100, 2, ".","");
		}else{
			$nceeb[$prodi->id_set_prodi][$i] = 0;
		}
		///echo "<br>NCEEB" . $i ." = " . $nceeb[$prodi->id_set_prodi][$i];
	}
	
	
	
	$jumlahnceeb[$prodi->id_set_prodi] = 0;
	for($i=1; $i<=10; $i++){
		$nceebsepuluhpersen[$prodi->id_set_prodi][$i] = number_format($nceeb[$prodi->id_set_prodi][$i] * (10/100), 2, ".","");
		///echo"<br>NCEEB * 10%" . $i ." = " . $nceebsepuluhpersen[$prodi->id_set_prodi][$i];
		
		$jumlahnceeb[$prodi->id_set_prodi] += $nceebsepuluhpersen[$prodi->id_set_prodi][$i];
	}
	///echo "<br>jumlah NCEEB setelah 10% = " . number_format($jumlahnceeb[$prodi->id_set_prodi], 2, ".","");
	
	
}

?>
