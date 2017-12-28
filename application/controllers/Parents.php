<?php

class Parents extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('alert_helper');
		$this->load->model('model_adm');
		$this->load->model('model_pembayaran');
		$this->load->model('model_paket');
		$this->load->model('model_tryout');
		$this->load->model('model_banksoal');
		$this->load->model('model_parent');
		$this->load->model('model_dashboard');
		$this->load->model('model_security');
		$this->load->model('model_bonus');
		$this->load->model('model_agcu');		
		$this->load->model('model_eqtest');
		$this->load->model('model_lstest');
		$this->load->model('model_rencana_belajar');
		$this->load->model('model_pg');
		$this->load->model('model_psep');
		$this->load->model('model_pr');
	}

	function index(){
		$idsiswa = $this->session->userdata('id_siswa');
		
		if($idsiswa == ""){
			redirect('login');
		}
		$infosiswa = $this->model_dashboard->get_info_siswa($idsiswa);
		
		
		//cek apakah siswa sudah mempunyai ortu??
		//***************************************
		$cariortu = $this->model_parent->cari_ortu_by_idsiswa($idsiswa);
		
		if($cariortu > 0){
			//jika siswa sudah memiliki ortu
			$data = array(
				'infosiswa'		=> $infosiswa,
				'infoortu'		=> $this->model_parent->get_ortu($idsiswa)
			);
			$this->load->view('pg_user/parent', $data);
		}elseif($cariortu == 0){
			//jika siswa tidak memiliki ortu
			$data = array(
				'infosiswa'	=> $infosiswa
			);
			$this->load->view('pg_user/parent_form', $data);
		}
		//end cek
		//***************************************
	}

	function prosesdaftar(){
		$params = $this->input->post(null, true);
		
		$idsiswa 	= $this->session->userdata('id_siswa');
		$nama 		= $params['nama'];
		$email 		= $params['email'];
		$telepon 	= $params['telepon'];
		$username 	= $params['username'];
		$password 	= $params['password'];
		
		$daftar = $this->model_parent->daftar($idsiswa, $nama, $email, $telepon, $username, $password);
		
		redirect('parents');
	}

	function edit($idparent){
		
		$idsiswa = $this->session->userdata('id_siswa');
		
		if($idsiswa == ""){
			redirect('login');
		}
		$infosiswa = $this->model_dashboard->get_info_siswa($idsiswa);
		
		$dataortu = $this->model_parent->get_parent($idparent);
		
		$data = array(
			'dataortu'	=> $dataortu,
			'infosiswa'	=> $infosiswa		
		);
		$this->load->view('pg_user/parent_edit', $data);
		
	}

	function prosesedit(){
		$params = $this->input->post(null, true);
		$idsiswa = $this->session->userdata('id_siswa');
		
		$idortu		= $params['idparent'];
		$nama		= $params['nama'];
		$email		= $params['email'];
		$telepon	= $params['telepon'];
		$username	= $params['username'];
		$password	= $params['password'];

		//cari 
		
		$daftar = $this->model_parent->edit($idortu, $nama, $email, $telepon, $username, $password);
		redirect('parents');
	}

	function edit_profil($idparent){
		$this->model_security->parent_logged_in();

		$dataortu = $this->model_parent->get_parent($idparent);
		
		$data = array(
			'infoortu'	=> $this->model_parent->get_parent($_SESSION['id_ortu']),
			'dataortu'	=> $dataortu
		);
		$this->load->view('pg_ortu/parent_edit', $data);
		
	}

	function proseseditprofil(){
		$params = $this->input->post(null, true);
		$idsiswa = $_SESSION['id_ortu_siswa'];
		
		$idortu		= $params['idparent'];
		$nama		= $params['nama'];
		$email		= $params['email'];
		$telepon	= $params['telepon'];
		$username	= $params['username'];
		$password	= $params['password'];
		
		$daftar = $this->model_parent->edit($idortu, $nama, $email, $telepon, $username, $password);
		redirect('parents/profil');
	}

	function dashboard(){
		$this->model_security->parent_logged_in();

		

		$idsiswa = $_SESSION['id_ortu_siswa'];
		
		$carikelas = $this->model_dashboard->get_kelas($idsiswa);
		$kelas = $carikelas->kelas;
		//cari tahun ajaran siswa
		$tahunajaransiswa = $this->model_psep->fetch_tahun_ajaran_siswa($idsiswa, $carikelas->kelas);
		//end cari tahun ajaran siswa
		
		//untuk keperluan AGCU
		$infosiswa = $this->model_dashboard->get_info_siswa($idsiswa);
		$carikelas = $this->model_dashboard->get_kelas($idsiswa);
		$kelas = $carikelas->kelas;

		//fungsi tambahan
		//##################
		//##################
		//##################
		$tanggalsekarang = $tanggalsekarang = date('Y-m-d');

		$kelasaktif = $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);

		if($infosiswa->kurikulum !== ""){
			$cariagcuaktif = $this->model_agcu->fetch_agcu_aktif($kelasaktif->id_kelas, $infosiswa->kurikulum, $tanggalsekarang);
			if($cariagcuaktif !== null){
				$profildiagnostic 		= $cariagcuaktif->id_profil_diagnostic;
				$jumlahsoaldiagnostic 	= $this->model_agcu->get_jumlah_soal_diagnostic_by_profil($cariagcuaktif->id_profil_diagnostic);
		
				$jumlahsoaldikerjakan 	= $this->model_agcu->get_jumlah_soal_diagnostic_dikerjakan_by_profil($idsiswa, $cariagcuaktif->id_profil_diagnostic);
			}else{
				$profildiagnostic 	 	= 0;
				$jumlahsoaldiagnostic 	= 1;
				$jumlahsoaldikerjakan 	= 0;
			}
		}else{
			$profildiagnostic 	 	= 0;
			$jumlahsoaldiagnostic 	= 1;
			$jumlahsoaldikerjakan 	= 0;
		}
		//end fungsi tambahan
		//##################
		//##################
		//##################
		
		$cek_eq = $this->model_agcu->cek_eq($idsiswa);
		$cek_ls = $this->model_agcu->cek_ls($idsiswa);
			
		if($cek_eq == 0){
			$hasileq = 0;
		}else{
			$hasileq = 1;
		}
		
		if($cek_ls == 50){
			$hasills = 1;
		}else{
			$hasills = 0;
		}
		//end untuk keperluan agcu
		

		//fungsi tambahan
		//end fungsi tambahan
		$data = array(
			'quote' 			=> $this->model_bonus->fetch_random_quote(),
			'infoortu'			=> $this->model_parent->get_parent($_SESSION['id_ortu']),
			'infosiswa'			=> $infosiswa,
			'tahunajaran'		=> $tahunajaransiswa,
			'hasileq'				=> $hasileq,
			'hasills'				=> $hasills,
			'profildiagnostic'		=> $profildiagnostic,
			'jumlahsoaldiagnostic'	=> $jumlahsoaldiagnostic,
			'jumlahsoaldikerjakan'	=> $jumlahsoaldikerjakan
		);
		
		if($tahunajaransiswa !== null){
			$data['datapr'] = $this->model_psep->fetch_pr_by_kelas_and_tahun_ajaran($tahunajaransiswa->id_kelas_paralel, $tahunajaransiswa->id_tahun_ajaran);
		}
		
		$this->load->view('pg_ortu/dashboard_parent', $data);
	}

	/*
	function profil($idkelas){
		$cariprofil = $this->model_dashboard->get_profil_by_kelas($idkelas);
		
		echo '<option value="">--- Pilih Profil Try Out ---</option>';
		foreach($cariprofil as $profil){
			echo "
				<option value='".$profil->id_tryout."'>".$profil->nama_profil."</option>
			";
		}
	}
	*/

	function profil(){
		$this->model_security->parent_logged_in();

		$data = array(
			'infoortu'	=> $this->model_parent->get_parent($_SESSION['id_ortu'])
		);

		$this->load->view('pg_ortu/parent', $data);
	}

	function aktivitas_siswa(){
		$this->model_security->parent_logged_in();
		$id = $_SESSION['id_ortu_siswa'];
		$data = array(
		'navbar_title'		=> "Log Akses Siswa",
		'page_title' 		=> "Detail Log Siswa",
		'form_action' 		=> current_url() . "?id=$id",
		'data_siswa' 		=> $this->model_adm->fetch_siswa_by_id($id),
		'log_teks' 			=> $this->model_adm->track_akses_by_id($id, 1), // 1=teks 
		'log_video' 		=> $this->model_adm->track_akses_by_id($id, 2), // 2=video 
		'log_soal' 			=> $this->model_adm->track_akses_soal_by_id($id), // 3=soal 
		'group_log_teks' => $this->model_adm->group_akses_by_id($id, 1),
		'group_log_video' => $this->model_adm->group_akses_by_id($id, 2),
		'group_log_soal' => $this->model_adm->group_akses_soal_by_id($id),
		'akses_terakhir' 	=> $this->model_adm->last_akses_by_id($id),
		'infoortu'	=> $this->model_parent->get_parent($_SESSION['id_ortu'])
		);

		//Redirect to siswa if id is not exist
		if(!$id)
		{
			redirect('pg_admin/log');
		}
		else 
		{
			$this->load->view('pg_ortu/log_detail', $data);
		}
	}

	public function log_by_date()
	{
		$id_siswa = $this->input->post('id');
		$log_date_start = $this->input->post('log_date_start');
		$log_date_end = $this->input->post('log_date_end');
		
		if($id_siswa && $log_date_start && $log_date_end) {
			$date_start = date('Ym', strtotime($log_date_start));
			$date_end = date('Ym', strtotime($log_date_end));
			
			$group_teks = $this->model_adm->group_akses_by_id($id_siswa, 1, $date_start, $date_end);
			$group_video = $this->model_adm->group_akses_by_id($id_siswa, 2, $date_start, $date_end);
			$group_soal = $this->model_adm->group_akses_soal_by_id($id_siswa, $date_start, $date_end);
			
			$ranged_data = array('data_teks'=>'', 'data_video'=>'', 'data_soal'=>'','count_teks'=>0,'count_video'=>0,'count_soal'=>0 
				);
			foreach ($group_teks as $teks) {
				$ranged_data['data_teks'] .= 
				"<tr>".
          "<td>".$teks['alias_kelas']."</td>".
          "<td>".$teks['nama_mapel']."</td>".
          "<td class='text-center'>".$teks['jumlah_akses']." x</td>".
        "</tr>";
				$ranged_data['count_teks'] += $teks['jumlah_akses'];
			}
			foreach ($group_video as $video) {
				$ranged_data['data_video'] .= 
				"<tr>".
          "<td>".$video['alias_kelas']."</td>".
          "<td>".$video['nama_mapel']."</td>".
          "<td class='text-center'>".$video['jumlah_akses']." x</td>".
        "</tr>";
				$ranged_data['count_video'] += $video['jumlah_akses'];
			}
			foreach ($group_soal as $soal) {
				$ranged_data['data_soal'] .= 
				"<tr>".
          "<td>".$soal['alias_kelas']."</td>".
          "<td>".$soal['nama_mapel']."</td>".
          "<td class='text-center'>".$soal['jumlah_akses']." x</td>".
        "</tr>";
				$ranged_data['count_soal'] += $soal['jumlah_akses'];
			}

			echo json_encode($ranged_data);
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}

	function tryout(){
		$this->model_security->parent_logged_in();

		$idsiswa 	= $_SESSION['id_ortu_siswa'];

		$tanggalsekarang = date('Y-m-d');
		$kelasaktif = $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);
		
		$data = array(
			'kelasaktif'			=> $kelasaktif,
			'datacbtreg' 			=> $this->model_tryout->fetch_cbt_reguler(),
			'infoortu'				=> $this->model_parent->get_parent($_SESSION['id_ortu']),
			'tipeview'				=> 'analisa'
		);
		$this->load->view('pg_ortu/pilih_tryout', $data);
	}

	function skor(){
		$this->model_security->parent_logged_in();

		$idsiswa 	= $_SESSION['id_ortu_siswa'];

		$tanggalsekarang = date('Y-m-d');
		$kelasaktif = $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);
		
		$data = array(
			'kelasaktif'			=> $kelasaktif,
			'datacbtreg' 			=> $this->model_tryout->fetch_cbt_reguler(),
			'infoortu'				=> $this->model_parent->get_parent($_SESSION['id_ortu']),
			'tipeview'				=> 'peringkat'
		);
		$this->load->view('pg_ortu/pilih_tryout', $data);
	}

	function report_cbt($idprofil=0, $tipereport='', $ispdf=''){
		$this->model_security->parent_logged_in();
		
		$idsiswa 	= $_SESSION['id_ortu_siswa'];

		if($idprofil == "0"){
			redirect('parents/dashboard');
		}
		
		$aliaskelas = $this->model_dashboard->kelas_by_profil($idprofil);		
				
		$carikelas 	= $this->model_dashboard->get_kelas($idsiswa);
		$kelas 		= $carikelas->kelas;
		
		$cariidkelas	= $this->model_dashboard->get_idkelas_byprofil($idprofil);
		
		if($cariidkelas->id_kelas == ""){
			redirect('parents/dashboard');
		}
		
		$idkelas = $cariidkelas->id_kelas;
		$infosiswa = $this->model_dashboard->get_info_siswa($idsiswa);
		
		$data = array(
			'infosiswa'			=> $infosiswa,
			'analisis_mapel_lama'	=> $this->model_dashboard->get_analisis_mapel_byprofil($idsiswa, $idprofil),
			'analisis_waktu'	=> $this->model_dashboard->get_analisis_waktu_byprofil($idsiswa, $idprofil),
			'kategori'			=> $this->model_dashboard->get_kategori_tryout_byprofil($idprofil),
			'kelas'				=> $kelas,
			'analisis_topik'	=> $this->model_dashboard->get_analisis_topik_2($idsiswa),
			'kelasaktif'		=> $this->model_dashboard->get_kelas_aktif($idsiswa, date('Y-m-d')),
			'aliaskelas'		=> $aliaskelas,
			'totalpeserta'		=> $this->model_dashboard->peserta_tryout($idkelas),
			'totalsoal'			=> $this->model_dashboard->total_soal_byprofil($idprofil),
			'jumlahbenar'		=> $this->model_dashboard->jumlah_benar($idsiswa, $idprofil),
			'dataperingkatlama'	=> $this->model_dashboard->peringkat($idprofil),
			'dataperingkat'		=> $this->model_dashboard->peringkat($idprofil),
			'analisis_mapel' 	=> $this->model_dashboard->analisis_mapel_by_profil_siswa($idsiswa, $idprofil),
			'infoortu'			=> $this->model_parent->get_parent($_SESSION['id_ortu']),
			'ispdf'				=> $ispdf,
			'idprofil'			=> $idprofil,
			'tipereport'		=> $tipereport,
			'judul'				=> 'CBT REPORT '.strtoupper($infosiswa->nama_siswa)
		);
		
		if ($ispdf > 0){
			$this->load->library('pdf');
	 
			$html = $this->load->view('pg_ortu/report_cbt', $data, true);
			echo $html;
			
			//$this->pdf->pdf_create($html,url_title('agcu-report-'.$infosiswa->nama_siswa,'-',TRUE),'A4','potrait');
		} else {
			$this->load->view('pg_ortu/report_cbt', $data);
		}
	}
	
	function report_agcu($ispdf=0, $idprofildiagnostic){
		$this->model_security->parent_logged_in();
		
		$idsiswa = $_SESSION['id_ortu_siswa'];
		
		$infosiswa 	= $this->model_dashboard->get_info_siswa($idsiswa);
		$carikelas 	= $this->model_dashboard->get_kelas($idsiswa);
		$kelas 		= $carikelas->kelas;
		
		$kategoridiagnostic = $this->model_agcu->get_diagnosticby_profil($idprofildiagnostic);
		$datasoal = $this->model_agcu->get_jumlahsoal();
		
		$jumlahbenar = $this->model_agcu->get_jumlah_benar($idsiswa);
		
		$jumlahhasil = $this->model_agcu->get_jumlah_hasil();
		$jumlahbenarhasil = $this->model_agcu->get_jumlah_benar_hasil();
		
		$analisistopik = $this->model_agcu->get_analisis_topik($idsiswa);
		
		
		$skor = $this->model_lstest->skor($idsiswa);
		$hasildiagnostic = $this->model_agcu->get_ordered_hasildiagnostic();
		$peringkatsiswa = $this->model_agcu->get_peringkatsiswabykelas($kelas);
		
		foreach($skor as $dataskor){
			$hasil[$dataskor->no] = $dataskor->skor;
		}
		
		$v1 = $hasil[11] + $hasil[12] + $hasil[13] + $hasil[14] + $hasil[15] + $hasil[16] + $hasil[17] + $hasil[18] + $hasil[19] + $hasil[20];
		
		$a1 = $hasil[21] + $hasil[22] + $hasil[23] + $hasil[24] + $hasil[25] + $hasil[26] + $hasil[27] + $hasil[28] + $hasil[29] + $hasil[30] + $hasil[31];
		
		$k1 = $hasil[21] + $hasil[22] + $hasil[23] + $hasil[24] + $hasil[25] + $hasil[26] + $hasil[27] + $hasil[28] + $hasil[29] + $hasil[30] + $hasil[31];
		
		$no = 1;
		for($i=1; $i<=50; $i++){
			if($hasil[$no] == "V"){
				if(!isset($v2)){
					$v2 = 1;
				}else{
					$v2 += 1;
				}
			}
			$no++;
		}
		
		$x = 1;
		for($i=1; $i<=50; $i++){
			if($hasil[$x] == "A"){
				if(!isset($a2)){
					$a2 = 1;
				}else{
					$a2 += 1;
				}
			}
			$x++;
		}
		
		$y = 1;
		for($i=1; $i<=50; $i++){
			if($hasil[$y] == "K"){
				if(!isset($k2)){
					$k2 = 1;
				}else{
					$k2 += 1;
				}
			}
			$y++;
		}
		
		$totalv = $v1 + $v2;
		$totala = $a1 + $a2;
		$totalk = $k1 + $k2;
		
		$karakteristikv = '';
		$karakteristika = '';
		$karakteristikk = '';
		
		
		if($totalv > $totala and $totalv > $totalk){
			$dominasi = "V";
			$karakteristik = 'Rapi dan teratur - Berbicara dengan cepat - Mampu membuat rencana dan mengatur jangka panjang dengan baik - Teliti dan rinci - Mementingkan penampilan - Lebih mudah mengingat apa yang dilihat daripada apa yang didengar - Mengingat sesuatu berdasarkan asosiasi visual - Memiliki kemampuan mengeja huruf dengan sangat baik - Biasanya tidak mudah terganggu oleh keributan atau suara berisik ketika sedang belajar - Sulit menerima instruksi verbal (oleh karena itu seringkali ia minta instruksi secara tertulis) - Merupakan pembaca yang cepat dan tekun - Lebih suka membaca daripada dibacakan - Dalam memberikan respon terhadap segala sesuatu, ia selalu bersikap waspada, membutuhkan penjelasan menyeluruh tentang tujuan dan berbagai hal lain yang berkaitan - Jika sedang berbicara di telpon ia suka membuat coretan - coretan tanpa arti selama berbicara - Lupa menyampaikan pesan verbal kepada orang lain - Sering menjawab pertanyaan dengan jawaban singkat " ya" atau "tidak” - Lebih suka mendemonstrasikan sesuatu daripada berpidato/ berceramah - Lebih tertarik pada bidang seni (lukis, pahat, gambar) dari pada musik - Sering kali mengetahui apa yang harus dikatakan, tetapi tidak pandai menulis kandalam kata - kata - Kadang-kadang kehilangan konsentrasi ketika mereka ingin memperhatikan';
			
			$saran = 'Buatlah Peta Konsep pelajaran dengan mulai dari tema besar di tengah halaman, menggunakan kata - kata penting, menggunakan simbol, warna, kata, gambar yang mencolok dan lakukan ini dengan gayamu sendiri - Dalam mencatat pelajaran, gunakan tanda - tanda, gambar dan warna untuk menandai hal - hal penting agar dapat dengan mudah dilihat lagi jika akan mempelajarinya dilain waktu - Untuk membantu mengingat apa yang baru dibaca dan didengar , duduklah dengan santai dan bayangkan dalam pikiran apa yang baru dibaca/didengar';
		}elseif($totala > $totalv and $totala > $totalk){
			$dominasi = "A";
			$karakteristik = 'Sering berbicara sendiri ketika sedang bekerja (belajar) - Mudah terganggu oleh keributan atau suara berisik - Menggerakan bibir dan menguc apkan tulisan di buku ketika membaca - Lebih senang mendengarkan (dibacakan) daripada membaca - Jika membaca maka lebih senang membaca dengan suara keras - Dapat mengulangi atau menirukan nada, irama dan warna suara - Mengalami kesulitan untuk menuliskan s esuatu, tetapi sangat pandai dalam bercerita - Berbicara dalam irama yang terpola dengan baik - berbicara dengan sangat fasih - Lebih menyukai seni musik dibandingkan seni yang lainnya - Belajar dengan mendengarkan dan mengingat apa yang didiskusikan darip ada apa yang dilihat - Senang berbicara, berdiskusi dan menjelaskan sesuatu secara panjang lebar - Mengalami kesulitan jika harus dihadapkan pada tugas - tugas yang berhubungan dengan visualisasi - Lebih pandai mengeja atau mengucapkan kata - kata dengan keras daripada menuliskannya - Lebih suka humor atau gurauan lisan daripada membaca buku humor/komik';
			
			$saran = 'Bacalah pelajaran dengan cara baca yang dramatis - Cobalah menyanyikannya dengan irama iklan atau musik - Merangkum pelajaran dengan diucapkan lantang atau direkam dalam kaset / CD dan didengarkan menggunakan walkman saat ke sekolah -  Saat membaca dengan lantang, perhatikan intonasi, penekanan khusus, cobalah berbisik dan cobalah untuk memejamkan mata untuk belajar membayangkan apa yang dibaca';
		}elseif($totalk > $totalv and $totalk > $totala){
			$dominasi = "K";
			$karakteristik = 'Berbicara dengan perlahan - Menanggapi perhatian fisik - Menyentuh orang lain untuk mendapatkan perhatian mereka - Berdiri dekat ketika sedang berbicara dengan orang lain - Banyak gerak fisik -  Memiliki perkembangan awal otot-otot yang besar - Belajar melalui praktek langsung atau manipulasi - Menghafalkan sesuatu dengan cara berjalan atau melihat langsung - Menggunakan jari untuk menunjukka apa yang dibaca ketika sedang membaca - Banyak menggunakan bahasa tubuh (non verbal) - Tidak dapat duduk diam di suatu tempat untuk waktu yang lama - Sulit membaca peta kecuali ia memang pernah ke tempat tersebut - Menggunakan ka ta - kata yang mengandung aksi - Pada umumnya tulisannya jelek - Menyukai kegiatan atau permainan yang menyibukkan (secara fisik) - Ingin melakukan segala sesuatu';
			
			$saran = 'Cobalah belajar dalam kelompok untuk membentuk suasana bermain peran dari pelajaran yang dibahas - Tulislah poin - poin penting dari pelajaran dalam bentuk kartu - kartu yang disusun secara logis -  Buatlah semacam percobaan atau model dari apa yang sedang kamu pelajari - Libatkan tubuh dalam belajar dengan mencoba meniru apa yang dipelajari dengan gaya guru saat menyampaikan materi - Setiap kali membaca atau mendengarkan seseorang berbicara, bangkitlah untuk sedikit bergerak setiap 15 - 20 menit sekali';
		}elseif($totalv == $totala and $totalv > $totalk){
			$dominasi = "VA";
			$karakteristik = 'Rapi dan teratur - Berbicara dengan c epat - Mampu membuat rencana dan mengatur jangka panjang dengan baik - Teliti dan rinci - Mementingkan penampilan - Lebih mudah mengingat apa yang dilihat daripada apa yang didengar - Mengingat sesuatu berdasarkan asosiasi visual - Memiliki kemampuan menge ja huruf dengan sangat baik - Biasanya tidak mudah terganggu oleh keributan atau suara berisik ketika sedang belajar - Sulit menerima instruksi verbal (oleh karena itu seringkali ia minta instruksi secara tertulis) - Merupakan pembaca yang cepat dan tekun - Lebih suka membaca daripada dibacakan - Dalam memberikan respon terhadap segala sesuatu, ia selalu bersikap waspada , membutuhkan penjelasan menyeluruh tentang tujuan dan berbagai hal lain yang berkaitan - Jika sedang berbicara di telpon ia suka membuat c oretan - coretan tanpa arti selama berbicara - Lupa menyampaikan pesan verbal kepada orang lain - Sering menjawab pertanyaan dengan jawaban singkat "ya" atau "tidak” - Lebih suka mendemonstrasikan sesuatu daripada berpidato/ berceramah - Lebih tertarik pada bidang seni (lukis, pahat, gambar) dari pada musik - Sering kali menegtahui apa yang harus dikatakan, tetapi tidak pandai menuliskan dalam kata - kata - Kadang - kadang kehilangan konsentrasi ketika mereka ingin memperhatikan - Sering berbicara sendiri ketika sedang bekerja (belajar) - Mudah terganggu oleh keributan atau suara berisik - Menggerakan bibir dan mengucapkan tulisan di buku ketika membaca - Lebih senang mendengarkan (dibacakan) daripada membaca - Jika membaca maka lebih senang membaca dengan suara k eras - Dapat mengulangi atau menirukan nada, irama dan warna suara - Mengalami kesulitan untuk menuliskan sesuatu, tetapi sangat pandai dalam bercerita - Berbicara dalam irama yang terpola dengan baik - berbicara dengan sangat fasih - Lebih menyukai seni m usik dibandingkan seni yang lainnya - Belajar dengan mendengarkan dan mengingat apa yang didiskusikan daripada apa yang dilihat - Senang berbicara, berdiskusi dan menjelaskan sesuatu secara panjang lebar - Mengalami kesulitan jika harus dihadapkan pada tug as - tugas yang berhubungan dengan visualisasi - Lebih pandai mengeja atau mengucapkan kata - kata dengan keras daripada menuliskannya - Lebih suka humor atau gurauan lisan daripada membaca buku humor/komik.';
			
			$saran = 'Buatlah Peta Konsep pelajaran dengan mulai dari tema besar di tengah halaman, menggunakan kata - kata penting, menggunakan simbol, warna, kata, gambar yang mencolok dan lakukan ini dengan gayamu sendiri - Dalam mencatat pelajaran, gunakan tanda - tanda, gambar dan warna untuk menandai hal - hal penting agar dapat dengan mudah dilihat lagi jika akan mempelajarinya dilain waktu - Untuk membantu mengingat apa yang baru dibaca dan didengar , duduklah dengan santai dan bayangkan dalam pikiran apa yang baru dibaca/didengar - Bacalah pelajaran dengan cara baca yang dramatis - Cobalah menyanyikannya dengan irama iklan atau musik - Merangkum pelajaran dengan diucapkan lantang atau direkam dalam kaset / CD dan didengarkan menggunakan walkman saat ke sekolah -  Saat membaca dengan lantang, perhatikan intonasi, penekanan khusus, cobalah berbisik dan cobalah untuk memejamkan mata untuk belajar membayangkan apa yang dibaca';
		}elseif($totalv == $totalk and $totalv > $totala){
			$dominasi = "VK";
			$karakteristik = 'Rapi dan teratur - Berbicara dengan cepat - Mampu membuat rencana dan mengatur jangka panjang dengan baik - Teliti dan rinci - Mementingkan penampilan - Lebih mudah mengingat apa yang dilihat daripada apa yang didengar - Mengingat sesuatu berdasarkan asosiasi visual - Memiliki kemampuan mengeja huruf dengan sangat baik - Biasanya tidak mudah terganggu oleh keributan atau suara berisik ketika sedang belajar - Sulit menerima instruksi verbal (oleh karena itu seringkali ia minta instruksi secara tertulis) - Merupakan pembaca yang cepat dan tekun - Lebih suka membaca daripada dibacakan - Dalam memberikan respon terhadap segala sesuatu, ia selalu bersikap waspada, membutuhkan penjelasan menyeluruh tentang tujuan dan berbagai hal lain yang berkaitan - Jika sedang berbicara di telpon ia suka membuat coretan - coretan tanpa arti selama berbicara - Lupa menyampaikan pesan verbal kepada orang lain - Sering menjawab pertanyaan dengan jawaban singkat " ya" atau "tidak” - Lebih suka mendemonstrasikan sesuatu daripada berpidato/ berceramah - Lebih tertarik pada bidang seni (lukis, pahat, gambar) dari pada musik - Sering kali mengetahui apa yang harus dikatakan, tetapi tidak pandai menulis kandalam kata - kata - Kadang-kadang kehilangan konsentrasi ketika mereka ingin memperhatikan - Berbicara dengan perlahan - Menanggapi perhatian fisik - Menyentuh orang lain untuk mendapatkan perhatian mereka - Berdiri dekat ketika sedang berbicara dengan orang lain - Banyak gerak fisik -  Memiliki perkembangan awal otot-otot yang besar - Belajar melalui praktek langsung atau manipulasi - Menghafalkan sesuatu dengan cara berjalan atau melihat langsung - Menggunakan jari untuk menunjukka apa yang dibaca ketika sedang membaca - Banyak menggunakan bahasa tubuh (non verbal) - Tidak dapat duduk diam di suatu tempat untuk waktu yang lama - Sulit membaca peta kecuali ia memang pernah ke tempat tersebut - Menggunakan ka ta - kata yang mengandung aksi - Pada umumnya tulisannya jelek - Menyukai kegiatan atau permainan yang menyibukkan (secara fisik) - Ingin melakukan segala sesuatu';
			
			$saran = 'Buatlah Peta Konsep pelajaran dengan mulai dari tema besar di tengah halaman, menggunakan kata - kata penting, menggunakan simbol, warna, kata, gambar yang mencolok dan lakukan ini dengan gayamu sendiri - Dalam mencatat pelajaran, gunakan tanda - tanda, gambar dan warna untuk menandai hal - hal penting agar dapat dengan mudah dilihat lagi jika akan mempelajarinya dilain waktu - Untuk membantu mengingat apa yang baru dibaca dan didengar , duduklah dengan santai dan bayangkan dalam pikiran apa yang baru dibaca/didengar - Cobalah belajar dalam kelompok untuk membentuk suasana bermain peran dari pelajaran yang dibahas - Tulislah poin - poin penting dari pelajaran dalam bentuk kartu - kartu yang disusun secara logis -  Buatlah semacam percobaan atau model dari apa yang sedang kamu pelajari - Libatkan tubuh dalam belajar dengan mencoba meniru apa yang dipelajari dengan gaya guru saat menyampaikan materi - Setiap kali membaca atau mendengarkan seseorang berbicara, bangkitlah untuk sedikit bergerak setiap 15 - 20 menit sekali';
		}elseif($totala == $totalk and $totala > $totalv){
			$dominasi = "AK";
			$karakteristik = 'Sering berbicara sendiri ketika sedang bekerja (belajar) - Mudah terganggu oleh keributan atau suara berisik - Menggerakan bibir dan menguc apkan tulisan di buku ketika membaca - Lebih senang mendengarkan (dibacakan) daripada membaca - Jika membaca maka lebih senang membaca dengan suara keras - Dapat mengulangi atau menirukan nada, irama dan warna suara - Mengalami kesulitan untuk menuliskan s esuatu, tetapi sangat pandai dalam bercerita - Berbicara dalam irama yang terpola dengan baik - berbicara dengan sangat fasih - Lebih menyukai seni musik dibandingkan seni yang lainnya - Belajar dengan mendengarkan dan mengingat apa yang didiskusikan darip ada apa yang dilihat - Senang berbicara, berdiskusi dan menjelaskan sesuatu secara panjang lebar - Mengalami kesulitan jika harus dihadapkan pada tugas - tugas yang berhubungan dengan visualisasi - Lebih pandai mengeja atau mengucapkan kata - kata dengan keras daripada menuliskannya - Lebih suka humor atau gurauan lisan daripada membaca buku humor/komik - Berbicara dengan perlahan - Menanggapi perhatian fisik - Menyentuh orang lain untuk mendapatkan perhatian mereka - Berdiri dekat ketika sedang berbicara dengan orang lain - Banyak gerak fisik -  Memiliki perkembangan awal otot-otot yang besar - Belajar melalui praktek langsung atau manipulasi - Menghafalkan sesuatu dengan cara berjalan atau melihat langsung - Menggunakan jari untuk menunjukka apa yang dibaca ketika sedang membaca - Banyak menggunakan bahasa tubuh (non verbal) - Tidak dapat duduk diam di suatu tempat untuk waktu yang lama - Sulit membaca peta kecuali ia memang pernah ke tempat tersebut - Menggunakan ka ta - kata yang mengandung aksi - Pada umumnya tulisannya jelek - Menyukai kegiatan atau permainan yang menyibukkan (secara fisik) - Ingin melakukan segala sesuatu';
			
			$saran = 'Bacalah pelajaran dengan cara baca yang dramatis - Cobalah menyanyikannya dengan irama iklan atau musik - Merangkum pelajaran dengan diucapkan lantang atau direkam dalam kaset / CD dan didengarkan menggunakan walkman saat ke sekolah -  Saat membaca dengan lantang, perhatikan intonasi, penekanan khusus, cobalah berbisik dan cobalah untuk memejamkan mata untuk belajar membayangkan apa yang dibaca - Cobalah belajar dalam kelompok untuk membentuk suasana bermain peran dari pelajaran yang dibahas - Tulislah poin - poin penting dari pelajaran dalam bentuk kartu - kartu yang disusun secara logis -  Buatlah semacam percobaan atau model dari apa yang sedang kamu pelajari - Libatkan tubuh dalam belajar dengan mencoba meniru apa yang dipelajari dengan gaya guru saat menyampaikan materi - Setiap kali membaca atau mendengarkan seseorang berbicara, bangkitlah untuk sedikit bergerak setiap 15 - 20 menit sekali';
		}elseif($totalv == $totala and $totalv == $totalk){
			$dominasi = "VAK";
			$karakteristik = 'Rapi dan teratur - Berbicara dengan c epat - Mampu membuat rencana dan mengatur jangka panjang dengan baik - Teliti dan rinci - Mementingkan penampilan - Lebih mudah mengingat apa yang dilihat daripada apa yang didengar - Mengingat sesuatu berdasarkan asosiasi visual - Memiliki kemampuan menge ja huruf dengan sangat baik - Biasanya tidak mudah terganggu oleh keributan atau suara berisik ketika sedang belajar - Sulit menerima instruksi verbal (oleh karena itu seringkali ia minta instruksi secara tertulis) - Merupakan pembaca yang cepat dan tekun - Lebih suka membaca daripada dibacakan - Dalam memberikan respon terhadap segala sesuatu, ia selalu bersikap waspada , membutuhkan penjelasan menyeluruh tentang tujuan dan berbagai hal lain yang berkaitan - Jika sedang berbicara di telpon ia suka membuat c oretan - coretan tanpa arti selama berbicara - Lupa menyampaikan pesan verbal kepada orang lain - Sering menjawab pertanyaan dengan jawaban singkat "ya" atau "tidak” - Lebih suka mendemonstrasikan sesuatu daripada berpidato/ berceramah - Lebih tertarik pada bidang seni (lukis, pahat, gambar) dari pada musik - Sering kali menegtahui apa yang harus dikatakan, tetapi tidak pandai menuliskan dalam kata - kata - Kadang - kadang kehilangan konsentrasi ketika mereka ingin memperhatikan<br>
			Sering berbicara sendiri ketika sedang bekerja (belajar) - Mudah terganggu oleh keributan atau suara berisik - Menggerakan bibir dan mengucapkan tulisan di buku ketika membaca - Lebih senang mendengarkan (dibacakan) daripada membaca - Jika membaca maka lebih senang membaca dengan suara k eras - Dapat mengulangi atau menirukan nada, irama dan warna suara - Mengalami kesulitan untuk menuliskan sesuatu, tetapi sangat pandai dalam bercerita - Berbicara dalam irama yang terpola dengan baik - berbicara dengan sangat fasih - Lebih menyukai seni m usik dibandingkan seni yang lainnya - Belajar dengan mendengarkan dan mengingat apa yang didiskusikan daripada apa yang dilihat - Senang berbicara, berdiskusi dan menjelaskan sesuatu secara panjang lebar - Mengalami kesulitan jika harus dihadapkan pada tug as - tugas yang berhubungan dengan visualisasi - Lebih pandai mengeja atau mengucapkan kata - kata dengan keras daripada menuliskannya - Lebih suka humor atau gurauan lisan daripada membaca buku humor/komik.<br>
			Berbicara dengan perlahan - Menanggapi perhatian fisik - Menyentuh orang lain untuk mendapatkan perhatian mereka - Berdiri dekat ketika sedang berbicara dengan orang lain - Banyak gerak fisik -  Memiliki perkembangan awal otot-otot yang besar - Belajar melalui praktek langsung atau manipulasi - Menghafalkan sesuatu dengan cara berjalan atau melihat langsung - Menggunakan jari untuk menunjukka apa yang dibaca ketika sedang membaca - Banyak menggunakan bahasa tubuh (non verbal) - Tidak dapat duduk diam di suatu tempat untuk waktu yang lama - Sulit membaca peta kecuali ia memang pernah ke tempat tersebut - Menggunakan ka ta - kata yang mengandung aksi - Pada umumnya tulisannya jelek - Menyukai kegiatan atau permainan yang menyibukkan (secara fisik) - Ingin melakukan segala sesuatu';
			
			$saran = 'Buatlah Peta Konsep pelajaran dengan mulai dari tema besar di tengah halaman, menggunakan kata - kata penting, menggunakan simbol, warna, kata, gambar yang mencolok dan lakukan ini dengan gayamu sendiri - Dalam mencatat pelajaran, gunakan tanda - tanda, gambar dan warna untuk menandai hal - hal penting agar dapat dengan mudah dilihat lagi jika akan mempelajarinya dilain waktu - Untuk membantu mengingat apa yang baru dibaca dan didengar , duduklah dengan santai dan bayangkan dalam pikiran apa yang baru dibaca/didengar<br>
			Bacalah pelajaran dengan cara baca yang dramatis - Cobalah menyanyikannya dengan irama iklan atau musik - Merangkum pelajaran dengan diucapkan lantang atau direkam dalam kaset / CD dan didengarkan menggunakan walkman saat ke sekolah -  Saat membaca dengan lantang, perhatikan intonasi, penekanan khusus, cobalah berbisik dan cobalah untuk memejamkan mata untuk belajar membayangkan apa yang dibaca<br>
			Cobalah belajar dalam kelompok untuk membentuk suasana bermain peran dari pelajaran yang dibahas - Tulislah poin - poin penting dari pelajaran dalam bentuk kartu - kartu yang disusun secara logis -  Buatlah semacam percobaan atau model dari apa yang sedang kamu pelajari - Libatkan tubuh dalam belajar dengan mencoba meniru apa yang dipelajari dengan gaya guru saat menyampaikan materi - Setiap kali membaca atau mendengarkan seseorang berbicara, bangkitlah untuk sedikit bergerak setiap 15 - 20 menit sekali';
		}
		
		$data_eq = $this->model_agcu->get_eq($idsiswa);
		
		if($data_eq->skor_aq < 7){
			$analisis_aq = "Mudah gelisah, bingung dan sering cemas - Sering kehilangan rasa humor - Menyalahkan diri sendiri terhadap berbagai kegagalan - Analisisnya dangkal ";
		}elseif($data_eq->skor_aq <= 11){
			$analisis_aq = "Daya tahan emosi dalam menghadapi cobaan cenderung kurang berkembang - Mudah kehilangan ketenangan - Sering kecewa terhadap kesalahan sendiri - Mudah kehilangan keseimbangan emosi ";
		}elseif($data_eq->skor_aq <= 21){
			$analisis_aq = "Daya tahan emosi dalam menghadapi cobaan cenderung berkembang - Peningkatan daya tahan emosi tergantung lingkungan - Perlu melatih ketenangan ";
		}elseif($data_eq->skor_aq <= 26){
			$analisis_aq = "Daya tahan emosi dalam menghadapi cobaan cukup baik - Terkadang menyerah tapi jarang mengalami kebingungan - Mempunyai ketenangan yang tidak mudah goyah - Tetap mampu mengambil keputusan yang akurat";
		}elseif($data_eq->skor_aq <= 32){
			$analisis_aq = "Daya tahan emosi dalam menghadapi cobaan sangat tinggi - Tidak akan stress kecuali kondisi sangat tragis - Mempunyai ketenangan yang sangat kuat - Tetap berorientasi pada tujuan";
		}
		
		if($data_eq->skor_eq < 7){
			$analisis_eq = "Tidak mampu memahami dinamika kelompok - Kesulitan memahami perasaan orang lain - Kurang kemauan untuk membantu kesulitan orang lain - Sering tegang menghadapi tekanan ";
		}elseif($data_eq->skor_eq <= 11){
			$analisis_eq = "Cenderung menolak perubahan - Kurang mampu mengendalikan perasaan - Cenderung egois - Selalu mengambil untung di setiap kesempatan - Kurang luwes dalam bergaul ";
		}elseif($data_eq->skor_eq <= 21){
			$analisis_eq = "Memiliki keterbukaan terhadap perubahan lingkungan - Memiliki semangat yang cukup baik - Mampu mendeteksi perasaan dan perspektif orang lain ";
		}elseif($data_eq->skor_eq <= 26){
			$analisis_eq = "Mampu menyemangati dirinya dan orang lain - Memiliki toleransi terhadap kekurangan orang lain - Mampu memelihara norma kejujuran dan integritas - Memiliki teknik persuasi yang baik ";
		}elseif($data_eq->skor_eq <= 32){
			$analisis_eq = "Memiliki rasa empati yang tinggi pada kesulitan orang lain - Mempu mengendalikan perasaannya - memiliki semangat yang tinggi dalam kondisi apapun";
		}
		
		if($data_eq->skor_am < 7){
			$analisis_am = "Tidak ada kemauan untuk berprestasi - Merasa yakin bahwa prestasinya selama ini sudah cukup - Tidak pernah instrospeksi diri ";
		}elseif($data_eq->skor_am <= 11){
			$analisis_am = "Jarang mendapatkan atau menginginkan prestasi tertentu - Tidak ada semangat bersaing - Biasanya menginginkan hasil seketika - Biasanya menjadi trouble maker";
		}elseif($data_eq->skor_am <= 21){
			$analisis_am = "Tidak ada prestasi yang istimewa - Kurang semangat bersaing - Cepat puas terhadap hasil yang diperoleh - Hanya berorientasi pada melaksanakan instruksi dengan benar ";
		}elseif($data_eq->skor_am <= 26){
			$analisis_am = "Memiliki kecenderungan high achiever dan rasa percaya diri cukup - Memiliki misi yang jelas dan terukur - Mampu memberi penghargaan terhadap hasil karya orang lain ";
		}elseif($data_eq->skor_am <= 32){
			$analisis_am = "High achiever, penuh rasa percaya diri dan optimis - Punya misi yang jelas untuk jangka panjang - Memiliki apresiasi yang tinggi terhadap hasil karya orang lain";
		}
		
		$data = array(
		'infosiswa'				=> $infosiswa,
		'kategoridiagnostic'	=> $kategoridiagnostic,
		'hasildiagnostic'		=> $hasildiagnostic,
		'peringkatsiswa'		=> $peringkatsiswa,
		'datasoal'				=> $datasoal,
		'jumlahbenar'			=> $jumlahbenar,
		'jumlahhasil'			=> $jumlahhasil,
		'jumlahbenarhasil'		=> $jumlahbenarhasil,
		'analisistopik'			=> $analisistopik,
		'totalv' 				=> $totalv,
		'totala' 				=> $totala,
		'totalk' 				=> $totalk,
		'dominasi'				=> $dominasi,
		'karakteristik'			=> $karakteristik,
		'saran'					=> $saran,
		'data_eq'				=> $this->model_agcu->get_eq($idsiswa),
		'analisis_aq'			=> $analisis_aq,
		'analisis_eq'			=> $analisis_eq,
		'analisis_am'			=> $analisis_am,
		'infoortu'				=> $this->model_parent->get_parent($_SESSION['id_ortu']),
		'ispdf'					=> $ispdf,
			'judul'				=> 'AGCU REPORT '.strtoupper($infosiswa->nama_siswa)
		);

		if ($ispdf > 0){
			$this->load->library('pdf');
	 
			$html = $this->load->view('pg_ortu/report_agcu', $data, true);
			echo $html;
			
			//$this->pdf->pdf_create($html,url_title('agcu-report-'.$infosiswa->nama_siswa,'-',TRUE),'A4','potrait');
		} else {
			$this->load->view('pg_ortu/report_agcu', $data);
		}
	}

function pencapaian_belajar(){
	$idsiswa 	= $_SESSION['id_ortu_siswa'];
	$carikelas = $this->model_dashboard->get_kelas($idsiswa);
	
	$tanggalsekarang = date('Y-m-d');

	$kelasaktif = $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);

	if($kelasaktif->id_kelas == 6){
		$datamapelun = $this->model_dashboard->get_mapel_by_kelas(39);
	}elseif($kelasaktif->id_kelas == 6){
		$datamapelun = $this->model_dashboard->get_mapel_by_kelas(41);
	}elseif($kelasaktif->id_kelas == 19){
		$datamapelun = $this->model_dashboard->get_mapel_by_kelas(42);
	}elseif($kelasaktif->id_kelas == 20){
		$datamapelun = $this->model_dashboard->get_mapel_by_kelas(43);
	}else{
		$datamapelun = null;
	}

	$data = array(
		'infoortu'			=> $this->model_parent->get_parent($_SESSION['id_ortu']),
		'materibelajar'		=> $this->model_rencana_belajar->fetch_materi_belajar($idsiswa, $carikelas->kelas),
		'mapeltersimpan'	=> $this->model_rencana_belajar->fetch_mapel_by_materi_tersimpan($idsiswa),
		'datamapelun'			=> $datamapelun,
	);
	
	$this->load->view('pg_ortu/pencapaian_belajar', $data);
}

function ajax_loader(){
	$this->load->view("pg_user/ajax_loader");
}

function ajax_materi_tersimpan_by_mapel($idmapel){
	$idsiswa 			= $_SESSION['id_ortu_siswa'];
	$carimapok 			= $this->model_rencana_belajar->fetch_rencana_belajar_by_mapel($idmapel, $idsiswa);
	
	$data = array(
		'datamapel'			=> $this->model_rencana_belajar->fetch_mapel_by_materi_tersimpan($idsiswa),
		'jumlahkonten'		=> $this->model_rencana_belajar->get_jumlah_konten_belajar($idmapel, $idsiswa),
		'pencapaian'		=> $this->model_rencana_belajar->get_pencapaian_siswa_by_mapel($idmapel, $idsiswa),
		'datamapok'	=> $carimapok,
		'infomapel'			=> $this->model_dashboard->get_info_mapel($idmapel)
	);

	$this->load->view("pg_ortu/ajax_materi_pokok_tersimpan", $data);
}

function ajax_rencana_belajar_awal(){
	$idsiswa 			= $this->session->userdata('id_ortu_siswa');
	$carikelas 			= $this->model_dashboard->get_info_siswa($idsiswa);
	$data = array(
		'materibelajar'			=> $this->model_rencana_belajar->fetch_materi_belajar($idsiswa, $carikelas->kelas),
		'mapeltersimpan'		=> $this->model_rencana_belajar->fetch_mapel_by_materi_tersimpan($idsiswa)
	);
	$this->load->view("pg_ortu/ajax_rencana_belajar", $data);
}

function pekerjaan_rumah(){
	$idsiswa 			= $this->session->userdata('id_ortu_siswa');
	$infosiswa 			= $this->model_dashboard->get_info_siswa($idsiswa);
	$carikelas 			= $this->model_dashboard->get_kelas($idsiswa);
	$tahunajaransiswa 	= $this->model_psep->fetch_tahun_ajaran_siswa($idsiswa, $carikelas->kelas);
	
	$data = array(
		'infoortu'				=> $this->model_parent->get_parent($_SESSION['id_ortu']),
		'infosiswa'				=> $infosiswa,
		'navbar_links' 			=> $this->model_pg->get_navbar_links(),
		'tahunajaran'			=> $tahunajaransiswa,
		'datapr'				=> $this->model_psep->fetch_pr_by_kelas_and_tahun_ajaran($tahunajaransiswa->id_kelas_paralel, $tahunajaransiswa->id_tahun_ajaran)
	);
	
	$this->load->view("pg_ortu/pr", $data);
}

function statistik_pr($idpr){
	$idsiswa 	= $this->session->userdata('id_ortu_siswa');
	$cekpr 		= $this->model_pr->fetch_status_pr($idpr, $idsiswa);
	
	if($cekpr == null){
		redirect("parents");
	}else{
		if($cekpr->status == 0){
			redirect("parents");
		}
	}
	
	$jumlahsoal	 	= $this->model_pr->jumlah_soal($idpr);
	$jumlahbenar 	= $this->model_pr->jumlah_benar_by_siswa_and_pr($idpr, $idsiswa);
	
	if($jumlahbenar > 0){
	    $nilai = ($jumlahbenar / $jumlahsoal) * 100;
	}else{
	    $nilai = 0;
	}
	
	
	$infosiswa 			= $this->model_dashboard->get_info_siswa($idsiswa);
	$carikelas 			= $this->model_dashboard->get_kelas($idsiswa);
	$tahunajaransiswa 	= $this->model_psep->fetch_tahun_ajaran_siswa($idsiswa, $carikelas->kelas);
	$data = array(
		'infoortu'		=> $this->model_parent->get_parent($_SESSION['id_ortu']),
		'infosiswa'		=> $infosiswa,
		'navbar_links' 	=> $this->model_pg->get_navbar_links(),
		'tahunajaran'	=> $tahunajaransiswa,
		'infopr'		=> $this->model_pr->get_info_pr($idpr),
		'jumlahsoal'	=> $jumlahsoal,
		'jumlahbenar'	=> $jumlahbenar,
		'nilai'			=> $nilai
	);
	$this->load->view("pg_ortu/pr_statistik", $data);
}

function statistik_eksak($idpr){
	//cek apakah pr benar2 sudah dikerjakan oleh siswa
	$idsiswa 	= $this->session->userdata('id_ortu_siswa');
	$cekpr = $this->model_pr->fetch_status_pr($idpr, $idsiswa);
	
	if($cekpr == null){
		redirect("pr");
	}else{
		if($cekpr->status == 0){
			redirect("pr");
		}
	}
	
	$infosiswa 			= $this->model_dashboard->get_info_siswa($idsiswa);
	$carikelas 			= $this->model_dashboard->get_kelas($idsiswa);
	$tahunajaransiswa 	= $this->model_psep->fetch_tahun_ajaran_siswa($idsiswa, $carikelas->kelas);
	
	$jumlahsoal = $this->model_pr->fetch_jumlah_soal_eksak_by_pr($idpr);
	$jumlahbenar = $this->model_pr->fetch_benar_eksak_by_siswa($idpr, $idsiswa);
	
	$nilai = $jumlahbenar / $jumlahsoal * 100;
	
	$data = array(
		'infoortu'		=> $this->model_parent->get_parent($_SESSION['id_ortu']),
		'infosiswa'		=> $infosiswa,
		'navbar_links' 	=> $this->model_pg->get_navbar_links(),
		'tahunajaran'	=> $tahunajaransiswa,
		'infopr'		=> $this->model_pr->get_info_pr($idpr),
		'jumlahbenar'	=> $jumlahbenar,
		'jumlahsoal'	=> $jumlahsoal,
		'nilai'			=> $nilai,
		'data_soal'		=> $this->model_pr->fetch_soal_eksak_by_pr($idpr)
	);
	
	$this->load->view("pg_ortu/pr_eksak_statistik", $data);
}

function statistik_essai($idpr){
	//cek apakah pr benar2 sudah dikerjakan oleh siswa
	$idsiswa 	= $this->session->userdata('id_ortu_siswa');
	$cekpr = $this->model_pr->fetch_status_pr($idpr, $idsiswa);
	
	if($cekpr == null){
		redirect("pr");
	}else{
		if($cekpr->status == 0){
			redirect("pr");
		}
	}
	
	$infosiswa 			= $this->model_dashboard->get_info_siswa($idsiswa);
	$carikelas 			= $this->model_dashboard->get_kelas($idsiswa);
	$tahunajaransiswa 	= $this->model_psep->fetch_tahun_ajaran_siswa($idsiswa, $carikelas->kelas);
	
	$jumlahsoal = $this->model_pr->fetch_jumlah_soal_essai_by_pr($idpr);
	$jumlahbenar = $this->model_pr->fetch_benar_essai_by_siswa($idpr, $idsiswa);
	
	$nilai = $jumlahbenar / $jumlahsoal * 100;
	
	$data = array(
		'infoortu'		=> $this->model_parent->get_parent($_SESSION['id_ortu']),
		'infosiswa'		=> $infosiswa,
		'navbar_links' 	=> $this->model_pg->get_navbar_links(),
		'tahunajaran'	=> $tahunajaransiswa,
		'infopr'		=> $this->model_pr->get_info_pr($idpr),
		'jumlahbenar'	=> $jumlahbenar,
		'jumlahsoal'	=> $jumlahsoal,
		'nilai'			=> $nilai,
		'data_soal'		=> $this->model_pr->fetch_soal_essai_by_pr($idpr)
	);
	
	$this->load->view("pg_ortu/pr_essai_statistik", $data);
}



}
