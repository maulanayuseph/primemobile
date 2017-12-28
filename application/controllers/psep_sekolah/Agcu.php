<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agcu extends CI_Controller {

	public function __construct()
	{
    parent::__construct();
			
		//check user session

		//load library in construct. Construct method will be run everytime the controller is called 
		//This library will be auto-loaded in every method in this controller. 
		//So there will be no need to call the library again in each method. 
		$this->load->library('form_validation');
		$this->load->helper('alert_helper');
		$this->load->model('model_adm');
		$this->load->model('model_psep');
		$this->load->model('model_dashboard');
		$this->load->model('model_agcu');
		$this->load->model('model_lstest');
		$this->load->model('model_pg');
		$this->load->model('model_security');
		$this->model_security->psep_sekolah_is_logged_in();
	}

public function report_siswa(){
	$idpsep = $this->session->userdata('idpsepsekolah');
	$idsekolah = $this->session->userdata('idsekolah');
	$carisekolah = $this->model_psep->cari_sekolah_by_login($idpsep);
	
	$data = array(
		'navbar_title' 	=> "Academic General Check Up",
		'active'		=> "agcu",
		'datakelas'		=> $this->model_psep->cari_kelas_by_jenjang($carisekolah->jenjang),
		'kelasparalel'		=> $this->model_psep->fetch_kelas_paralel_by_sekolah($idsekolah),
		'datatahunajaran'	=> $this->model_psep->fetch_tahun_ajaran_by_sekolah($idsekolah),
		'sekolah'		=> $this->model_psep->fetch_sekolah_by_id($idsekolah),
		'dataprofil'	=> $this->model_psep->fetch_profil_agcu_by_jenjang($carisekolah->jenjang)
	);
	
	$this->load->view('psep_sekolah/report_siswa', $data);
}

function ajax_siswa_by_jenjang($kelas){
	$idsekolah = $this->session->userdata('idsekolah');
	
	$carisiswa = $this->model_psep->cari_siswa_by_kelas($kelas, $idsekolah);
	
	$no = 1;
	foreach($carisiswa as $siswa){
	?>
		<tr>
			<td><?php echo $no;?></td>
			<td><?php echo $siswa->nama_siswa;?></td>
			<td><?php echo $siswa->alias_kelas;?></td>
			<td><a href="<?php echo base_url("psep_sekolah/agcu/siswa/".$siswa->id_siswa);?>">Report AGCU</a></td>
		</tr>
	<?php
	$no++;
	}
}

function siswa($idprofil, $idsiswa){
	$idsekolah = $this->session->userdata('idsekolah');
	$infosiswa = $this->model_dashboard->get_info_siswa($idsiswa);
	$carikelas = $this->model_dashboard->get_kelas($idsiswa);
	$kelas = $carikelas->kelas;
	
	$kategoridiagnostic = $this->model_agcu->get_diagnosticby_profil($idprofil);
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
	
	if(empty($hasil)){
		$hasil = 0;
	}
	
	$v1 = $hasil[11] + $hasil[12] + $hasil[13] + $hasil[14] + $hasil[15] + $hasil[16] + $hasil[17] + $hasil[18] + $hasil[19] + $hasil[20];
	
	$a1 = $hasil[21] + $hasil[22] + $hasil[23] + $hasil[24] + $hasil[25] + $hasil[26] + $hasil[27] + $hasil[28] + $hasil[29] + $hasil[30] + $hasil[31];
	
	$k1 = $hasil[21] + $hasil[22] + $hasil[23] + $hasil[24] + $hasil[25] + $hasil[26] + $hasil[27] + $hasil[28] + $hasil[29] + $hasil[30] + $hasil[31];
	
	//echo $hasil[11];
	
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
	
	if(!isset($v2)){
		$v2 = 0;
	}
	if(!isset($a2)){
		$a2 = 0;
	}
	if(!isset($k2)){
		$k2 = 0;
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
	
	if(empty($data_eq)){
		$skor_aq = 0;
		$skor_eq = 0;
		$skor_am = 0;
	}else{
		$skor_aq = $data_eq->skor_aq;
		$skor_eq = $data_eq->skor_eq;
		$skor_am = $data_eq->skor_am;
	}
	
	if($skor_aq < 7){
		$analisis_aq = "Mudah gelisah, bingung dan sering cemas - Sering kehilangan rasa humor - Menyalahkan diri sendiri terhadap berbagai kegagalan - Analisisnya dangkal ";
	}elseif($skor_aq <= 11){
		$analisis_aq = "Daya tahan emosi dalam menghadapi cobaan cenderung kurang berkembang - Mudah kehilangan ketenangan - Sering kecewa terhadap kesalahan sendiri - Mudah kehilangan keseimbangan emosi ";
	}elseif($skor_aq <= 21){
		$analisis_aq = "Daya tahan emosi dalam menghadapi cobaan cenderung berkembang - Peningkatan daya tahan emosi tergantung lingkungan - Perlu melatih ketenangan ";
	}elseif($skor_aq <= 26){
		$analisis_aq = "Daya tahan emosi dalam menghadapi cobaan cukup baik - Terkadang menyerah tapi jarang mengalami kebingungan - Mempunyai ketenangan yang tidak mudah goyah - Tetap mampu mengambil keputusan yang akurat";
	}elseif($skor_aq <= 32){
		$analisis_aq = "Daya tahan emosi dalam menghadapi cobaan sangat tinggi - Tidak akan stress kecuali kondisi sangat tragis - Mempunyai ketenangan yang sangat kuat - Tetap berorientasi pada tujuan";
	}
	
	if($skor_eq < 7){
		$analisis_eq = "Tidak mampu memahami dinamika kelompok - Kesulitan memahami perasaan orang lain - Kurang kemauan untuk membantu kesulitan orang lain - Sering tegang menghadapi tekanan ";
	}elseif($skor_eq <= 11){
		$analisis_eq = "Cenderung menolak perubahan - Kurang mampu mengendalikan perasaan - Cenderung egois - Selalu mengambil untung di setiap kesempatan - Kurang luwes dalam bergaul ";
	}elseif($skor_eq <= 21){
		$analisis_eq = "Memiliki keterbukaan terhadap perubahan lingkungan - Memiliki semangat yang cukup baik - Mampu mendeteksi perasaan dan perspektif orang lain ";
	}elseif($skor_eq <= 26){
		$analisis_eq = "Mampu menyemangati dirinya dan orang lain - Memiliki toleransi terhadap kekurangan orang lain - Mampu memelihara norma kejujuran dan integritas - Memiliki teknik persuasi yang baik ";
	}elseif($skor_eq <= 32){
		$analisis_eq = "Memiliki rasa empati yang tinggi pada kesulitan orang lain - Mempu mengendalikan perasaannya - memiliki semangat yang tinggi dalam kondisi apapun";
	}
	
	if($skor_am < 7){
		$analisis_am = "Tidak ada kemauan untuk berprestasi - Merasa yakin bahwa prestasinya selama ini sudah cukup - Tidak pernah instrospeksi diri ";
	}elseif($skor_am <= 11){
		$analisis_am = "Jarang mendapatkan atau menginginkan prestasi tertentu - Tidak ada semangat bersaing - Biasanya menginginkan hasil seketika - Biasanya menjadi trouble maker";
	}elseif($skor_am <= 21){
		$analisis_am = "Tidak ada prestasi yang istimewa - Kurang semangat bersaing - Cepat puas terhadap hasil yang diperoleh - Hanya berorientasi pada melaksanakan instruksi dengan benar ";
	}elseif($skor_am <= 26){
		$analisis_am = "Memiliki kecenderungan high achiever dan rasa percaya diri cukup - Memiliki misi yang jelas dan terukur - Mampu memberi penghargaan terhadap hasil karya orang lain ";
	}elseif($skor_am <= 32){
		$analisis_am = "High achiever, penuh rasa percaya diri dan optimis - Punya misi yang jelas untuk jangka panjang - Memiliki apresiasi yang tinggi terhadap hasil karya orang lain";
	}
	
	$data = array(
	'navbar_links' 	=> $this->model_pg->get_navbar_links(),
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
	'idsiswa'				=> $idsiswa,
	'sekolah'				=> $this->model_psep->fetch_sekolah_by_id($idsekolah)
	);
	$this->load->view('psep_sekolah/agcu_siswa', $data);
}

function rekap(){
	$idpsep = $this->session->userdata('idpsepsekolah');
	$idsekolah = $this->session->userdata('idsekolah');
	$carisekolah = $this->model_psep->cari_sekolah_by_login($idpsep);
	
	$data = array(
		'navbar_title' 	=> "Academic General Check Up",
		'active'		=> "agcu",
		'datakelas'		=> $this->model_psep->cari_kelas_by_jenjang($carisekolah->jenjang),
		'kelasparalel'		=> $this->model_psep->fetch_kelas_paralel_by_sekolah($idsekolah),
		'datatahunajaran'	=> $this->model_psep->fetch_tahun_ajaran_by_sekolah($idsekolah)
	);
	
	$this->load->view('psep_sekolah/rekap_agcu_pilih_kelas', $data);
}

function rekap_detail(){
	$kelas = $this->input->get('kelas');
	$tahun = $this->input->get('tahun');
	$profil = $this->input->get('profil');
	$idsekolah = $this->session->userdata('idsekolah');
	
	//cek dulu apakah get id kelas benar2 ada di tabel kelas_paralel, dan milik sekolah yang bersangkutan
	$apakahadakelasparalel = $this->model_psep->fetch_kelas_paralel_by_id($kelas, $idsekolah);
	
	//jika empty, redirect kembali ke halaman pilih kelas
	if(empty($apakahadakelasparalel)){
		redirect("psep_sekolah/agcu/report_siswa");
	}
	
	//cek juga apakah id tahun ajaran benar2 milik sekolah yang bersangkutan, cek di tabel tahun_ajaran
	$apakahtahunajaranada = $this->model_psep->fetch_tahun_ajaran_by_id($tahun, $idsekolah);
	//jika empty, redirect kembali ke halaman pilih kelas
	if(empty($apakahtahunajaranada)){
		redirect("psep_sekolah/agcu/report_siswa");
	}
	
	$datakelas = $this->model_psep->fetch_kelas_paralel_by_id($kelas, $idsekolah);
	
	$idpsep = $this->session->userdata('idpsepsekolah');
	$carisekolah = $this->model_psep->cari_sekolah_by_login($idpsep);
	
	$idsekolah 		= $this->session->userdata('idsekolah');
	
	//BATASI HANYA SISWA YANG SUDAH MELAKUKAN AGCU, KALAU GAK DIBATASI, PERHITUNGAN AKAN ERROR!!!
	//##################################################
	//##################################################
	//##################################################
	
	//$carisiswa 		= $this->model_psep->cari_siswa_by_kelas($kelas, $idsekolah);
	//ganti dengan cari siswa by kelas paralel bawah ini
	$carisiswa 		= $this->model_psep->fetch_siswa_by_kelasparalel_and_tahunajaran($idsekolah, $kelas, $tahun);
	
	
	//hitung siswa diganti dengan perhitungan masing2 siswa yang sudah mengerjakan agcu di dalam foreach carisiswa
	//$hitungsiswa  	= $this->model_psep->hitung_siswa_by_kelas($kelas, $idsekolah);
	
	$kategoridiagnostic	= $this->model_agcu->get_diagnosticby_profil($profil);
	$datasoal			= $this->model_agcu->fetch_soal();
	$datajumlahsoal		= $this->model_agcu->get_jumlahsoal();
	
	//data soal dibawah ini harus diganti dengan data soal benar per kelas paralel
	//$datasoalbenar 		= $this->model_agcu->get_jumlah_benar_by_kelas_sekolah($kelas, $idsekolah);
	$datasoalbenar		= $this->model_psep->get_jumlah_soal_benar_by_kelas_paralel($kelas);
	
	$hitungsiswa = 0;
	foreach($carisiswa as $siswa){
		$hitungsiswa += 1;
		// cari dulu apakah siswa sudah melakukan agcu dengan menghitung dan membandingkan soal agcu dengan soal yang ada di tabel hasil
		
		//cari jumlah total soal diagnostic dulu
		//gak efektif ternyata
		//$jumlahsoaldiagnostic = $this->model_psep->hitung_soal_diagnostic($datakelas->id_kelas);
		
		//cari jumlah soal per kategori diagnostic saja,
		$caridiagnostic = $this->model_psep->fetch_diagnostic_by_kelas($datakelas->id_kelas);
		
		foreach($caridiagnostic as $diag){
			$hitungsoaldiagnostic = $this->model_psep->hitung_soal_diagnostic_by_kategori($diag->id_diagnostic);
			
			$jumlahsoaldiagnostic = $this->model_psep->hitung_soal_diagnostic_by_kategori($diag->id_diagnostic);
			
			$jumlahterjawabsiswa = $this->model_psep->hitung_soal_diagnostic_terjawab_by_kategori_and_siswa($diag->id_diagnostic, $siswa->id_siswa);
				
				$sudahmengerjakandiagnostic = "ya";
				if($jumlahsoaldiagnostic !== $jumlahterjawabsiswa){
					if($sudahmengerjakandiagnostic == "ya"){
						$sudahmengerjakandiagnostic = "tidak";
					}
				}
		}
		
		//cari eq siswa
		//cari ls siswa
		$hitungsoaleqterjawab = $this->model_psep->hitung_jumlah_soal_terjawab_eq_siswa($siswa->id_siswa);
		$hitungsoallsterjawab = $this->model_psep->hitung_jumlah_soal_terjawab_ls_siswa($siswa->id_siswa);
		
		//if(isset($sudahmengerjakandiagnostic) and $sudahmengerjakandiagnostic == "ya" and $hitungsoaleqterjawab == "1" and $hitungsoallsterjawab == "50"){
		if($hitungsoallsterjawab == 50){
			
			$learning[$siswa->id_siswa] = $this->hitung_learning_style($siswa->id_siswa);
			
			if($learning[$siswa->id_siswa] == "V"){
					if(!isset($v)){
						$v = 1;
					}else{
						$v += 1;
					}
			}
			if($learning[$siswa->id_siswa] == "A"){
					if(!isset($a)){
						$a = 1;
					}else{
						$a += 1;
					}
			}
			if($learning[$siswa->id_siswa] == "K"){
					if(!isset($k)){
						$k = 1;
					}else{
						$k += 1;
					}
			}
			if($learning[$siswa->id_siswa] == "VA"){
					if(!isset($va)){
						$va = 1;
					}else{
						$va += 1;
					}
			}
			if($learning[$siswa->id_siswa] == "VK"){
					if(!isset($vk)){
						$vk = 1;
					}else{
						$vk += 1;
					}
			}
			if($learning[$siswa->id_siswa] == "AK"){
					if(!isset($ak)){
						$ak = 1;
					}else{
						$ak += 1;
					}
			}
			if($learning[$siswa->id_siswa] == "VAK"){
					if(!isset($vak)){
						$vak = 1;
					}else{
						$vak += 1;
					}
			}
		}
	}
	
	if(!isset($v)){
		$v = 0;
	}
	if(!isset($a)){
		$a = 0;
	}
	if(!isset($k)){
		$k = 0;
	}
	if(!isset($va)){
		$va = 0;
	}
	if(!isset($vk)){
		$vk = 0;
	}
	if(!isset($ak)){
		$ak = 0;
	}
	if(!isset($vak)){
		$vak = 0;
	}
	if($hitungsiswa > 0){
		$prosentasev 	= $v/$hitungsiswa * 100;
		$prosentasea 	= $a/$hitungsiswa * 100;
		$prosentasek 	= $k/$hitungsiswa * 100;
		$prosentaseva 	= $va/$hitungsiswa * 100;
		$prosentasevk 	= $vk/$hitungsiswa * 100;
		$prosentaseak 	= $ak/$hitungsiswa * 100;
		$prosentasevak 	= $vak/$hitungsiswa * 100;
	}else{
		$prosentasev 	= 0;
		$prosentasea 	= 0;
		$prosentasek 	= 0;
		$prosentaseva 	= 0;
		$prosentasevk 	= 0;
		$prosentaseak 	= 0;
		$prosentasevak 	= 0;
	}
	
	
	foreach($carisiswa as $siswa){
		$hitungsoaleqterjawab = $this->model_psep->hitung_jumlah_soal_terjawab_eq_siswa($siswa->id_siswa);
		
		if($hitungsoaleqterjawab == "1"){
			$nilaiaq[$siswa->id_siswa] = $this->hitung_aq($siswa->id_siswa);
			if($nilaiaq[$siswa->id_siswa] == "rendah"){
				if(!isset($aqrendah)){
					$aqrendah = 1;
				}else{
					$aqrendah += 1;
				}
			}elseif($nilaiaq[$siswa->id_siswa] == "ratabawah"){
				if(!isset($aqratabawah)){
					$aqratabawah = 1;
				}else{
					$aqratabawah += 1;
				}
			}elseif($nilaiaq[$siswa->id_siswa] == "rata"){
				if(!isset($aqrata)){
					$aqrata = 1;
				}else{
					$aqrata += 1;
				}
			}elseif($nilaiaq[$siswa->id_siswa] == "rataatas"){
				if(!isset($aqrataatas)){
					$aqrataatas = 1;
				}else{
					$aqrataatas += 1;
				}
			}elseif($nilaiaq[$siswa->id_siswa] == "tinggi"){
				if(!isset($aqtinggi)){
					$aqtinggi = 1;
				}else{
					$aqtinggi += 1;
				}
			}
		}
	}
	
	foreach($carisiswa as $siswa){
		$hitungsoaleqterjawab = $this->model_psep->hitung_jumlah_soal_terjawab_eq_siswa($siswa->id_siswa);
		
		if($hitungsoaleqterjawab == "1"){
			$nilaieq[$siswa->id_siswa] = $this->hitung_eq($siswa->id_siswa);
			if($nilaieq[$siswa->id_siswa] == "rendah"){
				if(!isset($eqrendah)){
					$eqrendah = 1;
				}else{
					$eqrendah += 1;
				}
			}elseif($nilaieq[$siswa->id_siswa] == "ratabawah"){
				if(!isset($eqratabawah)){
					$eqratabawah = 1;
				}else{
					$eqratabawah += 1;
				}
			}elseif($nilaieq[$siswa->id_siswa] == "rata"){
				if(!isset($eqrata)){
					$eqrata = 1;
				}else{
					$eqrata += 1;
				}
			}elseif($nilaieq[$siswa->id_siswa] == "rataatas"){
				if(!isset($eqrataatas)){
					$eqrataatas = 1;
				}else{
					$eqrataatas += 1;
				}
			}elseif($nilaieq[$siswa->id_siswa] == "tinggi"){
				if(!isset($eqtinggi)){
					$eqtinggi = 1;
				}else{
					$eqtinggi += 1;
				}
			}
		}
	}
	
	foreach($carisiswa as $siswa){
		$hitungsoaleqterjawab = $this->model_psep->hitung_jumlah_soal_terjawab_eq_siswa($siswa->id_siswa);
		
		if($hitungsoaleqterjawab == "1"){
			$nilaiam[$siswa->id_siswa] = $this->hitung_am($siswa->id_siswa);
			if($nilaiam[$siswa->id_siswa] == "rendah"){
				if(!isset($amrendah)){
					$amrendah = 1;
				}else{
					$amrendah += 1;
				}
			}elseif($nilaiam[$siswa->id_siswa] == "ratabawah"){
				if(!isset($amratabawah)){
					$amratabawah = 1;
				}else{
					$amratabawah += 1;
				}
			}elseif($nilaiam[$siswa->id_siswa] == "rata"){
				if(!isset($amrata)){
					$amrata = 1;
				}else{
					$amrata += 1;
				}
			}elseif($nilaiam[$siswa->id_siswa] == "rataatas"){
				if(!isset($amrataatas)){
					$amrataatas = 1;
				}else{
					$amrataatas += 1;
				}
			}elseif($nilaiam[$siswa->id_siswa] == "tinggi"){
				if(!isset($amtinggi)){
					$amtinggi = 1;
				}else{
					$amtinggi += 1;
				}
			}
		}
	}
	
	if(!isset($aqrendah)){
		$aqrendah = 0;
	}
	if(!isset($aqratabawah)){
		$aqratabawah = 0;
	}
	if(!isset($aqrata)){
		$aqrata = 0;
	}
	if(!isset($aqrataatas)){
		$aqrataatas = 0;
	}
	if(!isset($aqtinggi)){
		$aqtinggi = 0;
	}
	
	if(!isset($eqrendah)){
		$eqrendah = 0;
	}
	if(!isset($eqratabawah)){
		$eqratabawah = 0;
	}
	if(!isset($eqrata)){
		$eqrata = 0;
	}
	if(!isset($eqrataatas)){
		$eqrataatas = 0;
	}
	if(!isset($eqtinggi)){
		$eqtinggi = 0;
	}
	
	if(!isset($amrendah)){
		$amrendah = 0;
	}
	if(!isset($amratabawah)){
		$amratabawah = 0;
	}
	if(!isset($amrata)){
		$amrata = 0;
	}
	if(!isset($amrataatas)){
		$amrataatas = 0;
	}
	if(!isset($amtinggi)){
		$amtinggi = 0;
	}
	
	if($hitungsiswa > 0){
		$persenaqrendah 		= $aqrendah / $hitungsiswa * 100;
		$persenaqratabawah 		= $aqratabawah / $hitungsiswa * 100;
		$persenaqrata 			= $aqrata / $hitungsiswa * 100;
		$persenaqrataatas 		= $aqrataatas / $hitungsiswa * 100;
		$persenaqtinggi 		= $aqtinggi / $hitungsiswa * 100;
		
		$perseneqrendah 		= $eqrendah / $hitungsiswa * 100;
		$perseneqratabawah 		= $eqratabawah / $hitungsiswa * 100;
		$perseneqrata 			= $eqrata / $hitungsiswa * 100;
		$perseneqrataatas 		= $eqrataatas / $hitungsiswa * 100;
		$perseneqtinggi 		= $eqtinggi / $hitungsiswa * 100;
		
		$persenamrendah 		= $amrendah / $hitungsiswa * 100;
		$persenamratabawah 		= $amratabawah / $hitungsiswa * 100;
		$persenamrata 			= $amrata / $hitungsiswa * 100;
		$persenamrataatas 		= $amrataatas / $hitungsiswa * 100;
		$persenamtinggi 		= $amtinggi / $hitungsiswa * 100;
	}else{
		$persenaqrendah 		= 0;
		$persenaqratabawah 		= 0;
		$persenaqrata 			= 0;
		$persenaqrataatas 		= 0;
		$persenaqtinggi 		= 0;
		
		$perseneqrendah 		= 0;
		$perseneqratabawah 		= 0;
		$perseneqrata 			= 0;
		$perseneqrataatas 		= 0;
		$perseneqtinggi 		= 0;
		
		$persenamrendah 		= 0;
		$persenamratabawah 		= 0;
		$persenamrata 			= 0;
		$persenamrataatas 		= 0;
		$persenamtinggi 		= 0;

	}
	
	
	$data = array(
		'navbar_title' 			=> "Academic General Check Up",
		'active'				=> "agcu",
		'kategoridiagnostic'	=> $kategoridiagnostic,
		'datajumlahsoal'		=> $datajumlahsoal,
		'datasoal'				=> $datasoal,
		'datasoalbenar'			=> $datasoalbenar,
		'jumlahsiswa'			=> $hitungsiswa,
		'prosentasev'			=> $prosentasev,
		'prosentasea'			=> $prosentasea,
		'prosentasek'			=> $prosentasek,
		'prosentaseva'			=> $prosentaseva,
		'prosentasevk'			=> $prosentasevk,
		'prosentaseak'			=> $prosentaseak,
		'prosentasevak'			=> $prosentasevak,
		'datasekolah'			=> $carisekolah,
		'datakelas'				=> $datakelas,
		'persenaqrendah'		=> $persenaqrendah,
		'persenaqratabawah'		=> $persenaqratabawah,
		'persenaqrata'			=> $persenaqrata,
		'persenaqrataatas'		=> $persenaqrataatas,
		'persenaqtinggi'		=> $persenaqtinggi,
		'perseneqrendah'		=> $perseneqrendah,
		'perseneqratabawah'		=> $perseneqratabawah,
		'perseneqrata'			=> $perseneqrata,
		'perseneqrataatas'		=> $perseneqrataatas,
		'perseneqtinggi'		=> $perseneqtinggi,
		'persenamrendah'		=> $persenamrendah,
		'persenamratabawah'		=> $persenamratabawah,
		'persenamrata'			=> $persenamrata,
		'persenamrataatas'		=> $persenamrataatas,
		'persenamtinggi'		=> $persenamtinggi
	);
	$this->load->view("psep_sekolah/rekap_agcu_detail", $data);
	//echo $kelas;
}

function hitung_learning_style($idsiswa){
	//ERROR JIKA SISWA BELUM MELAKUKAN AGCU
	$infosiswa = $this->model_dashboard->get_info_siswa($idsiswa);
	$carikelas = $this->model_dashboard->get_kelas($idsiswa);
	$kelas = $carikelas->kelas;
	
	$kategoridiagnostic = $this->model_agcu->get_diagnosticbykelas($kelas);
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
	
	for($x = 1; $x<=50; $x++){
		if(!isset($hasil[$x])){
			$hasil[$x] = 0;
		}
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
	
	if(!isset($v1)){
		$v1 = 0;
	}
	if(!isset($a1)){
		$a1 = 0;
	}
	if(!isset($k1)){
		$k1 = 0;
	}
	if(!isset($v2)){
		$v2 = 0;
	}
	if(!isset($a2)){
		$a2 = 0;
	}
	if(!isset($k2)){
		$k2 = 0;
	}
	
	$totalv = $v1 + $v2;
	$totala = $a1 + $a2;
	$totalk = $k1 + $k2;
	
	$karakteristikv = '';
	$karakteristika = '';
	$karakteristikk = '';
	
	
	if($totalv > $totala and $totalv > $totalk){
		return "V";
	}elseif($totala > $totalv and $totala > $totalk){
		return "A";
	}elseif($totalk > $totalv and $totalk > $totala){
		return "K";
	}elseif($totalv == $totala and $totalv > $totalk){
		return "VA";
	}elseif($totalv == $totalk and $totalv > $totala){
		return "VK";
	}elseif($totala == $totalk and $totala > $totalv){
		return "AK";
	}elseif($totalv == $totala and $totalv == $totalk){
		return "VAK";
	}
}

function hitung_aq($idsiswa){
	$data_eq = $this->model_agcu->get_eq($idsiswa);
	
	if($data_eq->skor_aq < 7){
		return "rendah";
	}elseif($data_eq->skor_aq <= 11){
		return "ratabawah";
	}elseif($data_eq->skor_aq <= 21){
		return "rata";
	}elseif($data_eq->skor_aq <= 26){
		return "rataatas";
	}elseif($data_eq->skor_aq <= 32){
		return "tinggi";
	}
	
}

function hitung_eq($idsiswa){
	$data_eq = $this->model_agcu->get_eq($idsiswa);
	
	if($data_eq->skor_eq < 7){
		return "rendah";
	}elseif($data_eq->skor_eq <= 11){
		return "ratabawah";
	}elseif($data_eq->skor_eq <= 21){
		return "rata";
	}elseif($data_eq->skor_eq <= 26){
		return "rataatas";
	}elseif($data_eq->skor_eq <= 32){
		return "tinggi";
	}
}
function hitung_am($idsiswa){
	$data_eq = $this->model_agcu->get_eq($idsiswa);
	
	if($data_eq->skor_am < 7){
		return "rendah";
	}elseif($data_eq->skor_am <= 11){
		return "ratabawah";
	}elseif($data_eq->skor_am <= 21){
		return "rata";
	}elseif($data_eq->skor_am <= 26){
		return "rataatas";
	}elseif($data_eq->skor_am <= 32){
		return "tinggi";
	}
}

function ajax_siswa($idkelasparalel, $idtahunajaran, $profil){
	//echo "heheheh";
	$idsekolah = $this->session->userdata('idsekolah');
	
	if($profil !== "0"){
		if($idkelasparalel !== "0" and $idtahunajaran !== "0"){

			$infokelas = $this->model_psep->fetch_kelas_paralel_by_id($idkelasparalel, $idsekolah);

			$datasiswa = $this->model_psep->fetch_siswa_by_kelasparalel_and_tahunajaran($idsekolah, $idkelasparalel, $idtahunajaran);
			
			$no = 1;
			foreach($datasiswa as $siswa){
				$datadiagnostic = $this->model_agcu->get_diagnosticby_profil($profil);
				foreach($datadiagnostic as $diagnostic){
					$jumlahsoaldiagnostic = $this->model_psep->hitung_soal_diagnostic_by_kategori($diagnostic->id_diagnostic);
					
					$jumlahterjawabsiswa = $this->model_psep->hitung_soal_diagnostic_terjawab_by_kategori_and_siswa($diagnostic->id_diagnostic, $siswa->id_siswa);
					
					$sudahmengerjakandiagnostic = "ya";
					if($jumlahsoaldiagnostic !== $jumlahterjawabsiswa){
						if($sudahmengerjakandiagnostic == "ya"){
							$sudahmengerjakandiagnostic = "tidak";
						}
					}
				}
				
				$hitungsoaleqterjawab = $this->model_psep->hitung_jumlah_soal_terjawab_eq_siswa($siswa->id_siswa);
				$hitungsoallsterjawab = $this->model_psep->hitung_jumlah_soal_terjawab_ls_siswa($siswa->id_siswa);
			?>
				<tr>
					<td><?php echo $no;?></td>
					<td><?php echo $siswa->nama_siswa;?></td>
					<td><?php echo $siswa->alias_kelas;?> - <?php echo $siswa->kelas_paralel;?></td>
					<td><?php echo $siswa->tahun_ajaran;?></td>
					<td>
						<?php
							if(isset($sudahmengerjakandiagnostic) and $sudahmengerjakandiagnostic == "ya"){
						?>
						<i class="fa fa-check" aria-hidden="true" style="color: green;"></i>
						<?php
							}else{
						?>
						<i class="fa fa-remove" aria-hidden="true" style="color: red;"></i>
						<?php
							}
						?>
					</td>
					<td>
						<?php
							if($hitungsoaleqterjawab == "1"){
						?>
						<i class="fa fa-check" aria-hidden="true" style="color: green;"></i>
						<?php
							}else{
						?>
						<i class="fa fa-remove" aria-hidden="true" style="color: red;"></i>
						<?php
							}
						?>
					</td>
					<td>
						<?php
							if($hitungsoallsterjawab == "50"){
						?>
						<i class="fa fa-check" aria-hidden="true" style="color: green;"></i>
						<?php
							}else{
						?>
						<i class="fa fa-remove" aria-hidden="true" style="color: red;"></i>
						<?php
							}
						?>
					</td>
					<td style="text-align: center;">
						<?php
							if(isset($sudahmengerjakandiagnostic) and $sudahmengerjakandiagnostic == "ya" and $hitungsoaleqterjawab == "1" and $hitungsoallsterjawab == "50"){
						?>
						<a href="<?php echo base_url("psep_sekolah/agcu/siswa/". $profil . "/" . $siswa->id_siswa);?>" class="btn btn-sm btn-success"><i class="fa fa-newspaper-o" aria-hidden="true"></i></a>
						<a href="<?php echo base_url("psep_sekolah/agcu/download/". $profil . "/" .$siswa->id_siswa);?>" class="btn btn-sm btn-primary" target="_BLANK"><i class="fa fa-print" aria-hidden="true"></i></a>
						<?php
							}else{
						?>
						-
						<?php
							}
						?>
					</td>
				</tr>
			<?php
			$no++;
			}
		}elseif($idkelasparalel !== "0" and $idtahunajaran == "0"){
			$datasiswa = $this->model_psep->fetch_siswa_by_kelasparalel($idsekolah, $idkelasparalel, $idtahunajaran);
			
			$no = 1;
			foreach($datasiswa as $siswa){
				$datadiagnostic = $this->model_psep->fetch_diagnostic_by_kelas($siswa->id_kelas);
				foreach($datadiagnostic as $diagnostic){
					$jumlahsoaldiagnostic = $this->model_psep->hitung_soal_diagnostic_by_kategori($diagnostic->id_diagnostic);
					
					$jumlahterjawabsiswa = $this->model_psep->hitung_soal_diagnostic_terjawab_by_kategori_and_siswa($diagnostic->id_diagnostic, $siswa->id_siswa);
					
					$sudahmengerjakandiagnostic = "ya";
					if($jumlahsoaldiagnostic !== $jumlahterjawabsiswa){
						if($sudahmengerjakandiagnostic == "ya"){
							$sudahmengerjakandiagnostic = "tidak";
						}
					}
				}
				
				$hitungsoaleqterjawab = $this->model_psep->hitung_jumlah_soal_terjawab_eq_siswa($siswa->id_siswa);
				$hitungsoallsterjawab = $this->model_psep->hitung_jumlah_soal_terjawab_ls_siswa($siswa->id_siswa);
			?>
				<tr>
					<td><?php echo $no;?></td>
					<td><?php echo $siswa->nama_siswa;?></td>
					<td><?php echo $siswa->alias_kelas;?> - <?php echo $siswa->kelas_paralel;?></td>
					<td><?php echo $siswa->tahun_ajaran;?></td>
					<td>
						<?php
							if(isset($sudahmengerjakandiagnostic) and $sudahmengerjakandiagnostic == "ya"){
						?>
						<i class="fa fa-check" aria-hidden="true" style="color: green;"></i>
						<?php
							}else{
						?>
						<i class="fa fa-remove" aria-hidden="true" style="color: red;"></i>
						<?php
							}
						?>
					</td>
					<td>
						<?php
							if($hitungsoaleqterjawab == "1"){
						?>
						<i class="fa fa-check" aria-hidden="true" style="color: green;"></i>
						<?php
							}else{
						?>
						<i class="fa fa-remove" aria-hidden="true" style="color: red;"></i>
						<?php
							}
						?>
					</td>
					<td>
						<?php
							if($hitungsoallsterjawab == "50"){
						?>
						<i class="fa fa-check" aria-hidden="true" style="color: green;"></i>
						<?php
							}else{
						?>
						<i class="fa fa-remove" aria-hidden="true" style="color: red;"></i>
						<?php
							}
						?>
					</td>
					<td style="text-align: center;">
						<?php
							if(isset($sudahmengerjakandiagnostic) and $sudahmengerjakandiagnostic == "ya" and $hitungsoaleqterjawab == "1" and $hitungsoallsterjawab == "50"){
						?>
						<a href="<?php echo base_url("psep_sekolah/agcu/siswa/". $profil . "/".$siswa->id_siswa);?>" class="btn btn-sm btn-success"><i class="fa fa-newspaper-o" aria-hidden="true"></i></a>
						<a href="<?php echo base_url("psep_sekolah/agcu/download/". $profil . "/" .$siswa->id_siswa);?>" class="btn btn-sm btn-primary" target="_BLANK"><i class="fa fa-print" aria-hidden="true"></i></a>
						<?php
							}else{
						?>
						-
						<?php
							}
						?>
					</td>
				</tr>
			<?php
			$no++;
			}
		}elseif($idkelasparalel == "0" and $idtahunajaran !== "0"){
			/*
			$datasiswa = $this->model_psep->fetch_siswa_by_tahunajaran($idsekolah, $idkelasparalel, $idtahunajaran);
			
			$no = 1;
			foreach($datasiswa as $siswa){
				$datadiagnostic = $this->model_psep->fetch_diagnostic_by_kelas($siswa->id_kelas);
				foreach($datadiagnostic as $diagnostic){
					$jumlahsoaldiagnostic = $this->model_psep->hitung_soal_diagnostic_by_kategori($diagnostic->id_diagnostic);
					
					$jumlahterjawabsiswa = $this->model_psep->hitung_soal_diagnostic_terjawab_by_kategori_and_siswa($diagnostic->id_diagnostic, $siswa->id_siswa);
					
					$sudahmengerjakandiagnostic = "ya";
					if($jumlahsoaldiagnostic !== $jumlahterjawabsiswa){
						if($sudahmengerjakandiagnostic == "ya"){
							$sudahmengerjakandiagnostic = "tidak";
						}
					}
				}
				
				$hitungsoaleqterjawab = $this->model_psep->hitung_jumlah_soal_terjawab_eq_siswa($siswa->id_siswa);
				$hitungsoallsterjawab = $this->model_psep->hitung_jumlah_soal_terjawab_ls_siswa($siswa->id_siswa);
			?>
				<tr>
					<td><?php echo $no;?></td>
					<td><?php echo $siswa->nama_siswa;?></td>
					<td><?php echo $siswa->alias_kelas;?> - <?php echo $siswa->kelas_paralel;?></td>
					<td><?php echo $siswa->tahun_ajaran;?></td>
					<td>
						<?php
							if(isset($sudahmengerjakandiagnostic) and $sudahmengerjakandiagnostic == "ya"){
						?>
						<i class="fa fa-check" aria-hidden="true" style="color: green;"></i>
						<?php
							}else{
						?>
						<i class="fa fa-remove" aria-hidden="true" style="color: red;"></i>
						<?php
							}
						?>
					</td>
					<td>
						<?php
							if($hitungsoaleqterjawab == "1"){
						?>
						<i class="fa fa-check" aria-hidden="true" style="color: green;"></i>
						<?php
							}else{
						?>
						<i class="fa fa-remove" aria-hidden="true" style="color: red;"></i>
						<?php
							}
						?>
					</td>
					<td>
						<?php
							if($hitungsoallsterjawab == "50"){
						?>
						<i class="fa fa-check" aria-hidden="true" style="color: green;"></i>
						<?php
							}else{
						?>
						<i class="fa fa-remove" aria-hidden="true" style="color: red;"></i>
						<?php
							}
						?>
					</td>
					<td style="text-align: center;">
						<?php
							if(isset($sudahmengerjakandiagnostic) and $sudahmengerjakandiagnostic == "ya" and $hitungsoaleqterjawab == "1" and $hitungsoallsterjawab == "50"){
						?>
						<a href="<?php echo base_url("psep_sekolah/agcu/siswa/".$siswa->id_siswa);?>" class="btn btn-sm btn-success"><i class="fa fa-newspaper-o" aria-hidden="true"></i></a>
						<a href="<?php echo base_url("psep_sekolah/agcu/download/".$siswa->id_siswa);?>" class="btn btn-sm btn-primary" target="_BLANK"><i class="fa fa-print" aria-hidden="true"></i></a>
						<?php
							}else{
						?>
						-
						<?php
							}
						?>
					</td>
				</tr>
			<?php
			$no++;
			}
			*/
		}
	}
	
}

function download($idprofil, $idsiswa){
	$infosiswa = $this->model_dashboard->get_info_siswa($idsiswa);
	$carikelas = $this->model_dashboard->get_kelas($idsiswa);
	$kelas = $carikelas->kelas;
	
	$kategoridiagnostic = $this->model_agcu->get_diagnosticby_profil($idprofil);
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
	
	if(empty($hasil)){
		$hasil = 0;
	}
	
	$v1 = $hasil[11] + $hasil[12] + $hasil[13] + $hasil[14] + $hasil[15] + $hasil[16] + $hasil[17] + $hasil[18] + $hasil[19] + $hasil[20];
	
	$a1 = $hasil[21] + $hasil[22] + $hasil[23] + $hasil[24] + $hasil[25] + $hasil[26] + $hasil[27] + $hasil[28] + $hasil[29] + $hasil[30] + $hasil[31];
	
	$k1 = $hasil[21] + $hasil[22] + $hasil[23] + $hasil[24] + $hasil[25] + $hasil[26] + $hasil[27] + $hasil[28] + $hasil[29] + $hasil[30] + $hasil[31];
	
	//echo $hasil[11];
	
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
	
	if(!isset($v2)){
		$v2 = 0;
	}
	if(!isset($a2)){
		$a2 = 0;
	}
	if(!isset($k2)){
		$k2 = 0;
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
	
	if(empty($data_eq)){
		$skor_aq = 0;
		$skor_eq = 0;
		$skor_am = 0;
	}else{
		$skor_aq = $data_eq->skor_aq;
		$skor_eq = $data_eq->skor_eq;
		$skor_am = $data_eq->skor_am;
	}
	
	if($skor_aq < 7){
		$analisis_aq = "Mudah gelisah, bingung dan sering cemas - Sering kehilangan rasa humor - Menyalahkan diri sendiri terhadap berbagai kegagalan - Analisisnya dangkal ";
	}elseif($skor_aq <= 11){
		$analisis_aq = "Daya tahan emosi dalam menghadapi cobaan cenderung kurang berkembang - Mudah kehilangan ketenangan - Sering kecewa terhadap kesalahan sendiri - Mudah kehilangan keseimbangan emosi ";
	}elseif($skor_aq <= 21){
		$analisis_aq = "Daya tahan emosi dalam menghadapi cobaan cenderung berkembang - Peningkatan daya tahan emosi tergantung lingkungan - Perlu melatih ketenangan ";
	}elseif($skor_aq <= 26){
		$analisis_aq = "Daya tahan emosi dalam menghadapi cobaan cukup baik - Terkadang menyerah tapi jarang mengalami kebingungan - Mempunyai ketenangan yang tidak mudah goyah - Tetap mampu mengambil keputusan yang akurat";
	}elseif($skor_aq <= 32){
		$analisis_aq = "Daya tahan emosi dalam menghadapi cobaan sangat tinggi - Tidak akan stress kecuali kondisi sangat tragis - Mempunyai ketenangan yang sangat kuat - Tetap berorientasi pada tujuan";
	}
	
	if($skor_eq < 7){
		$analisis_eq = "Tidak mampu memahami dinamika kelompok - Kesulitan memahami perasaan orang lain - Kurang kemauan untuk membantu kesulitan orang lain - Sering tegang menghadapi tekanan ";
	}elseif($skor_eq <= 11){
		$analisis_eq = "Cenderung menolak perubahan - Kurang mampu mengendalikan perasaan - Cenderung egois - Selalu mengambil untung di setiap kesempatan - Kurang luwes dalam bergaul ";
	}elseif($skor_eq <= 21){
		$analisis_eq = "Memiliki keterbukaan terhadap perubahan lingkungan - Memiliki semangat yang cukup baik - Mampu mendeteksi perasaan dan perspektif orang lain ";
	}elseif($skor_eq <= 26){
		$analisis_eq = "Mampu menyemangati dirinya dan orang lain - Memiliki toleransi terhadap kekurangan orang lain - Mampu memelihara norma kejujuran dan integritas - Memiliki teknik persuasi yang baik ";
	}elseif($skor_eq <= 32){
		$analisis_eq = "Memiliki rasa empati yang tinggi pada kesulitan orang lain - Mempu mengendalikan perasaannya - memiliki semangat yang tinggi dalam kondisi apapun";
	}
	
	if($skor_am < 7){
		$analisis_am = "Tidak ada kemauan untuk berprestasi - Merasa yakin bahwa prestasinya selama ini sudah cukup - Tidak pernah instrospeksi diri ";
	}elseif($skor_am <= 11){
		$analisis_am = "Jarang mendapatkan atau menginginkan prestasi tertentu - Tidak ada semangat bersaing - Biasanya menginginkan hasil seketika - Biasanya menjadi trouble maker";
	}elseif($skor_am <= 21){
		$analisis_am = "Tidak ada prestasi yang istimewa - Kurang semangat bersaing - Cepat puas terhadap hasil yang diperoleh - Hanya berorientasi pada melaksanakan instruksi dengan benar ";
	}elseif($skor_am <= 26){
		$analisis_am = "Memiliki kecenderungan high achiever dan rasa percaya diri cukup - Memiliki misi yang jelas dan terukur - Mampu memberi penghargaan terhadap hasil karya orang lain ";
	}elseif($skor_am <= 32){
		$analisis_am = "High achiever, penuh rasa percaya diri dan optimis - Punya misi yang jelas untuk jangka panjang - Memiliki apresiasi yang tinggi terhadap hasil karya orang lain";
	}
	
	$data = array(
	'navbar_links' 	=> $this->model_pg->get_navbar_links(),
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
	'idsiswa'				=> $idsiswa
	);
	
	$this->load->library('pdf');
	
	$html = $this->load->view('psep_sekolah/pdf_agcu', $data, true);
	
	$this->pdf->pdf_create($html,url_title("Academic General Check Up",'-',TRUE),'A4','potrait');
}



}