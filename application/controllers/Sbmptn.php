<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Sbmptn extends CI_Controller {



	public function __construct()

  {

    parent::__construct();

		//load library in construct. Construct method will be run everytime the controller is called 

		//This library will be auto-loaded in every method in this controller. 

		//So there will be no need to call the library again in each method. 

		$this->load->library('form_validation');

		$this->load->helper('alert_helper');

		$this->load->model('model_pg');

		$this->load->model('model_paket');

		$this->load->model('model_voucher');

		$this->load->model('model_pembayaran');
		
		$this->load->model('model_dashboard');
		$this->load->model('model_signup');
		$this->load->model('model_poin');
		$this->load->model('model_bonus');
		$this->load->model('model_tryout');
		$this->load->model('model_psep');
		$this->load->model('model_pr');
		$this->load->model('model_rencana_belajar');
		$this->load->model('model_sbmptn');
		$this->load->model('model_fronttryout');
		$this->load->model('model_psep_uss');
		$this->load->model('model_pr');

  }



public function index(){
	$id_siswa = isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : 0;
	if(empty($this->session->userdata('akses'))){
		$datapembelian = $this->model_pembayaran->get_tagihan_by_siswa($id_siswa);
		if(empty($datapembelian)){
			redirect("user/aktivasi");
		}else{
			redirect("user/buylist");
		}
	}
	
	$idsiswa = $this->session->userdata('id_siswa');
	
	if($idsiswa == ""){
		redirect('login');
	}
	$infosiswa = $this->model_dashboard->get_info_siswa($idsiswa);
	
	$carikelas = $this->model_dashboard->get_kelas($idsiswa);
	$kelas = $carikelas->kelas;
	
	
	$cariaktivasi = $this->model_dashboard->cari_aktivasi($idsiswa);
	
	$carimapel = $this->model_dashboard->get_mapel_by_kelas($kelas);
	
	$akses = $this->session->userdata('akses');
		$tanggalsekarang = date('Y-m-d');
		if(array_key_exists('premium', $akses)){
			$kelasaktif = $this->model_dashboard->get_kelas_premium();
		}else{
			$kelasaktif = $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);
		}
	if($cariaktivasi == 0){
		$statussiswa = 'tidak_aktif';
	}else{
		$statussiswa = 'aktif';
	}
	//END UPDATE 20 OKTOBER 2016
	//#####################################

	$data = array(
		'infosiswa'				=> $infosiswa,
		'datamapel'				=> $carimapel,
		'kelasaktif'			=> $kelasaktif,
		'status_siswa'			=> $statussiswa, //update 20 oktober 2016
		'select_provinsi'		=> $this->model_signup->get_provinsi(),
		'navbar_links' 			=> $this->model_pg->get_navbar_links()
	);
	
	$this->load->view('pg_user/sbmptn_index', $data);
}

function pilih_paket(){
	$idsiswa = isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : 0;
	$infosiswa = $this->model_dashboard->get_info_siswa($idsiswa);
	$carikelas = $this->model_dashboard->get_kelas($idsiswa);
	$kelas = $carikelas->kelas;

	$tahunajaransiswa = $this->model_psep->fetch_tahun_ajaran_siswa($idsiswa, $carikelas->kelas);
	$data = array(
		'infosiswa'				=> $infosiswa,
		'navbar_links' 			=> $this->model_pg->get_navbar_links(),
		'carimapel'				=> $this->model_dashboard->get_mapel_by_kelas($kelas),
		'tahunajaran'			=> $tahunajaransiswa,
		'datapaket'				=> $this->model_sbmptn->fetch_paket_sbmptn()
	);
	
	$this->load->view('pg_user/sbmptn_paket', $data);
}

function set_prodi($idpaket){
	if($idpaket == null){
		redirect("sbmptn/pilih_paket");
	}
	
	$idsiswa = isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : 0;
	
	//cek apakah siswa sudah set prodi
	$cekprodi = $this->model_sbmptn->cek_set_prodi_by_paket($idpaket, $idsiswa);
	if($cekprodi > 0){
		redirect("sbmptn/pilih_tes/" . $idpaket);
	}
	
	
	$infosiswa = $this->model_dashboard->get_info_siswa($idsiswa);
	$carikelas = $this->model_dashboard->get_kelas($idsiswa);
	$kelas = $carikelas->kelas;
	
	$data = array(
		'infosiswa'				=> $infosiswa,
		'navbar_links' 			=> $this->model_pg->get_navbar_links(),
		'carimapel'				=> $this->model_dashboard->get_mapel_by_kelas($kelas),
		'idpaket'				=> $idpaket,
		'datapanlok'			=> $this->model_sbmptn->fetch_panlok(),
		'dataptn'				=> $this->model_sbmptn->fetch_ptn()
	);
	
	$this->load->view('pg_user/sbmptn_set_prodi', $data);
}

function ajax_ptn_by_panlok($idpanlok){
	$cariptn = $this->model_sbmptn->fetch_ptn_by_panlok($idpanlok);
	
	echo "<option value=''>-- Pilih PTN --</option>";
	
	foreach($cariptn as $ptn){
		?>
		<option value='<?php echo $ptn->id_ptn;?>'><?php echo $ptn->nama_ptn;?></option>
		<?php
	}
}

function ajax_prodi_by_ptn($idptn){
	$cariprodi = $this->model_sbmptn->fetch_prodi_by_ptn($idptn);
	
	echo "<option value='0'>-- Pilih Program Studi --</option>";
	
	foreach($cariprodi as $prodi){
		?>
		<option value='<?php echo $prodi->id_prodi;?>'><?php echo $prodi->nama_prodi;?> (<?php echo $prodi->kelompok;?>)</option>
		<?php
	}
}

function proses_prodi(){
	$params 	= $this->input->post(null, true);
	$idsiswa 	= $this->session->userdata("id_siswa");
	$idpaket	= $params['paket'];
	$panlok		= $params['panlok'];
	$prodi1		= $params['prodi1'];
	$prodi2		= $params['prodi2'];
	$prodi3		= $params['prodi3'];
	
	if(($prodi1 == $prodi2) or ($prodi1 == $prodi3) or ($prodi2 == $prodi3)){
		alert_error("Error", "Program Studi tidak boleh dipilih dua kali");
		redirect("sbmptn/set_prodi/" . $idpaket);
	}
	
	//insert prodi1
	$this->model_sbmptn->insert_set_prodi($idpaket, $idsiswa, $prodi1);
	//insert prodi2
	$this->model_sbmptn->insert_set_prodi($idpaket, $idsiswa, $prodi2);
	//insert prodi3
	$this->model_sbmptn->insert_set_prodi($idpaket, $idsiswa, $prodi3);
	
	redirect("sbmptn/pilih_tes/" . $idpaket);
}

function pilih_tes($idpaket){
	//cek apakah siswa sudah set prodi
	$idsiswa 	= $this->session->userdata("id_siswa");
	$cekprodi = $this->model_sbmptn->cek_set_prodi_by_paket($idpaket, $idsiswa);
	if($cekprodi == 0){
		redirect("sbmptn/set_prodi/" . $idpaket);
	}
		
	$idsiswa 	= isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : 0;
	$infosiswa 	= $this->model_dashboard->get_info_siswa($idsiswa);
	$carikelas 	= $this->model_dashboard->get_kelas($idsiswa);
	$kelas 		= $carikelas->kelas;
	
	$setprodi = $this->model_sbmptn->fetch_set_prodi_by_paket($idpaket, $idsiswa);
	
	//cari apakah siswa masuk saintek, soshum atau saintek
	$kelompok = null;
	foreach($setprodi as $prodi){
		if($prodi->kelompok == 'SAINTEK'){
			if($kelompok == null){
				$kelompok = 'SAINTEK';
			}elseif($kelompok == 'SAINTEK'){
				$kelompok = 'SAINTEK';
			}elseif($kelompok == 'SOSHUM'){
				$kelompok = 'CAMPURAN';
			}
		}elseif($prodi->kelompok == 'SOSHUM'){
			if($kelompok == null){
				$kelompok = 'SOSHUM';
			}elseif($kelompok == 'SOSHUM'){
				$kelompok = 'SOSHUM';
			}elseif($kelompok == 'SAINTEK'){
				$kelompok = 'CAMPURAN';
			}
		}
	}
	
	$data = array(
		'infosiswa'			=> $infosiswa,
		'navbar_links' 		=> $this->model_pg->get_navbar_links(),
		'carimapel'			=> $this->model_dashboard->get_mapel_by_kelas($kelas),
		'paket'				=> $this->model_sbmptn->fetch_paket_by_id($idpaket),
		'setprodi'			=> $this->model_sbmptn->fetch_set_prodi_by_paket($idpaket, $idsiswa),
		'testpa'			=> $this->model_sbmptn->fetch_profil_by_jenis_and_paket($idpaket, "tpa"),
		'testkdu'			=> $this->model_sbmptn->fetch_profil_by_jenis_and_paket($idpaket, "tkdu"),
		'kelompok'			=> $kelompok
	);
	
	
	if($kelompok == "SAINTEK"){
		$data['tessaintek'] = $this->model_sbmptn->fetch_profil_by_jenis_and_paket($idpaket, "tkd_saintek");
	}elseif($kelompok == "SOSHUM"){
		$data['tessoshum'] = $this->model_sbmptn->fetch_profil_by_jenis_and_paket($idpaket, "tkd_soshum");
	}elseif($kelompok == 'CAMPURAN'){
		$data['tessaintek'] = $this->model_sbmptn->fetch_profil_by_jenis_and_paket($idpaket, "tkd_saintek");
		$data['tessoshum'] = $this->model_sbmptn->fetch_profil_by_jenis_and_paket($idpaket, "tkd_soshum");
	}
	
	$this->load->view('pg_user/sbmptn_pilih_tes', $data);
	
}

function mulai($id_sub_materi){
	$idsiswa = $this->session->userdata('id_siswa');
	
	if($idsiswa == ""){
		redirect('login');
	}
	
	//$cariwaktu 		= $this->model_dashboard->cari_waktu($id_sub_materi, $idsiswa);
	
	if(isset($_SESSION['benar'])){
		unset($_SESSION['benar']);
	}
	if(isset($_SESSION['salah'])){
		unset($_SESSION['salah']);
	}
	//set session kategori_tryout
	if(isset($_SESSION['id_kategori'])){
		unset($_SESSION['id_kategori']);
	}
	$_SESSION['id_kategori'] = $id_sub_materi;
	//set session jumlah soal untuk cek selesai
	if(isset($_SESSION['jumlah_soal'])){
		unset($_SESSION['jumlah_soal']);
	}
	if(isset($_SESSION['sudah_dikerjakan'])){
		unset($_SESSION['sudah_dikerjakan']);
	}
	
	$cariwaktu 		= $this->model_fronttryout->cari_waktu($id_sub_materi, $idsiswa);
	
	if($cariwaktu !== 0){
		$data = array(
			'navbar_links' 	=> $this->model_fronttryout->get_navbar_links(),
			'data_soal'		=> $this->model_fronttryout->fetch_soal_by_kategori($id_sub_materi),
			'durasi'		=> $this->model_fronttryout->get_timer($id_sub_materi),
			'infotryout'	=>$this->model_fronttryout->get_info_tryout($id_sub_materi),
			'terjawab' 		=> $this->model_fronttryout->cari_terjawab($id_sub_materi, $idsiswa),
			'elapsed_time' 	=> $this->model_fronttryout->cari_waktu($id_sub_materi, $idsiswa)
		);
		$_SESSION['sudah_dikerjakan'] = $this->model_fronttryout->jumlah_terjawab($id_sub_materi, $idsiswa);
	}else{
		$data = array(
			'navbar_links' 	=> $this->model_fronttryout->get_navbar_links(),
			'data_soal'		=> $this->model_fronttryout->fetch_soal_by_kategori($id_sub_materi),
			'durasi'		=> $this->model_fronttryout->get_timer($id_sub_materi),
			'infotryout'	=>$this->model_fronttryout->get_info_tryout($id_sub_materi)
		);	
		$_SESSION['sudah_dikerjakan'] = 0;
	}
	
	$carijumlahsoal = $this->model_fronttryout->jumlah_soal($id_sub_materi);
	$_SESSION['jumlah_soal'] = $carijumlahsoal;
	
	

	$session = array(
		'data_latihan' => array(
			'sedang_mengerjakan' 	=> true,
			'skor'					=> 0,
			'id_materi'				=> $id_sub_materi
		),

		'kunci_soal' => $this->model_fronttryout->fetch_array_id_soal($id_sub_materi) 
		);
	$this->session->set_userdata($session);
	session_write_close();


	if((!$id_sub_materi) OR (!$_SESSION['data_latihan']['sedang_mengerjakan'])){
		//Redirect history back -1
		redirect($_SERVER['HTTP_REFERER']);
	}


	$this->load->view('pg_user/sbmptn', $data);
}

public function penilaian(){
	$submit = $_POST['submit_form_soal'];
	if(!$submit){	
		redirect($_SERVER['HTTP_REFERER']);
	}	

	$skor = $this->input->post('skor');
	
	
	
	$id_sub_materi = $_SESSION['data_latihan']['id_materi'] ? $_SESSION['data_latihan']['id_materi'] : 0;

	$jumlah_soal = $this->model_fronttryout->jumlah_soal($id_sub_materi);

	if(($jumlah_soal > 0) && ($skor > 0)){
		$final_skor = round(((100/$jumlah_soal) * $skor), 1);
	}
	else{
		$final_skor = 0;
	}
	
	
	//identifikasi masing2 input untuk submit ke tabel analisis
	//***********************
	//***********************
	$datakategori = $this->model_fronttryout->get_ketuntasan($id_sub_materi);
	
	$ketuntasan = $datakategori->ketuntasan;
	$jumlahsoal = $datakategori->jumlah_soal;
	
	
	$idsiswa = $this->session->userdata('id_siswa');
	//UPDATE 21 OKTOBER 2016
	//#################################
	$benar = $this->model_fronttryout->get_benar_by_kategori($id_sub_materi, $idsiswa);
	$salah = $this->model_fronttryout->get_salah_by_kategori($id_sub_materi, $idsiswa);
	//END UPDATE 21 OKTOBER 2016
	//#################################
	$skorpersen = ($benar / $jumlahsoal) * 100;
	
	if($skorpersen >= $ketuntasan ){
		$tuntas = 1;
	}else{
		$tuntas = 0;
	}
	
	$carianalisispelajaran = $this->model_fronttryout->carianalisispelajaran($id_sub_materi, $idsiswa);
	
	if($carianalisispelajaran > 0){
		$inputanalisis = $this->model_fronttryout->editanalisispelajaran($id_sub_materi, $idsiswa, $benar, $salah, $final_skor, $skorpersen, $tuntas);
	}else{
		$inputanalisis = $this->model_fronttryout->inputanalisispelajaran($id_sub_materi, $idsiswa, $benar, $salah, $final_skor, $skorpersen, $tuntas);
	}
	
	
	//analisis waktu
	//$durasiasli = $this->transformTime(str_pad($datakategori->durasi, 2, '0', STR_PAD_LEFT));
	
	$durasiasli = date('H:i:s', mktime(0,str_pad($datakategori->durasi, 2, '0', STR_PAD_LEFT)));
	
	$lama = $this->input->post('lamapengerjaan');
	
	$carianalisiswaktu = $this->model_fronttryout->carianalisiswaktu($id_sub_materi, $idsiswa);
	
	$average = $this->average_time($lama, $jumlahsoal);
	
	if($carianalisiswaktu > 0){
		$inputanalisiswaktu = $this->model_fronttryout->editanalisiswaktu($id_sub_materi, $idsiswa, $durasiasli, $lama, $average);
	}else{
		$inputanalisiswaktu = $this->model_fronttryout->inputanalisiswaktu($id_sub_materi, $idsiswa, $durasiasli, $lama, $average);
	}
	//end analisis
	//***********************
	//***********************
	
	
	//$durasiselesai = $this->transformTime();
	
	//DETERMINE RANKING SISWA ---------------
	if(isset($_SESSION['id_kategori'])) {
		$ranking = 0;
		$ranking_siswa = array();
		$data_ranking = $this->model_fronttryout->get_analisis_topik_ranking($_SESSION['id_kategori'], 3); //limit = 3
		foreach ($data_ranking as $rank) {
			$ranking_siswa[] = $rank->id_siswa;
		}
		if(in_array($idsiswa, $ranking_siswa)) {
			$ranking = array_search($idsiswa, $ranking_siswa)+1;
		}
		switch ($ranking) {
			case 1:
			    $addpoin = $this->model_poin->add_poin_siswa($_SESSION['id_siswa'], 'ranking_1');
				break;
			case 2:
			    $addpoin = $this->model_poin->add_poin_siswa($_SESSION['id_siswa'], 'ranking_2');
				break;
			case 3:
			    $addpoin = $this->model_poin->add_poin_siswa($_SESSION['id_siswa'], 'ranking_3');
				break;
			default:
				break;
		}
		//echo "RANKING: ".$ranking;
	}
	//END DETERMINE RANKING SISWA ---------------
	
	$_SESSION['data_latihan']['skor'] = $skor;
	
	
	$cariskor 		= $this->model_dashboard->cari_skor($id_sub_materi, $idsiswa);
	$cariskorsalah 	= $this->model_dashboard->cari_skor_salah($id_sub_materi, $idsiswa);
	
	$salah 		= $cariskorsalah * -1;
	$skorakhir 	= ($cariskor * 4) + $salah;
	//$total 		= $tryout->jumlah_soal * 4;
	
	//$skorakhir = $this->model_fronttryout->hitung_skor_akhir($id_sub_materi, $idsiswa);
	$jumlahbobot = $this->model_fronttryout->jumlah_bobot($id_sub_materi, $idsiswa);
	
	$data = array(
		'navbar_links' 	=> $this->model_pg->get_navbar_links(),
		'skor'			=> $skorakhir,
		'jumlahbobot'	=> $jumlahbobot,
		'tuntas'		=> $tuntas,
		'jumlahbenar'	=> $cariskor,
		'jumlahsalah'	=> $cariskorsalah
	);
	unset($_SESSION['benar']);
	unset($_SESSION['salah']);
	unset($_SESSION['id_kategori']);
	
	$this->load->view('pg_user/sbmptn_selesai', $data);
}

public function transformTime($min){
$ctime = DateTime::createFromFormat('i', $min);
$ntime = $ctime->format('H:i:s');
return $ntime;
}

function average_time($total, $count, $rounding = 0) {
    $total = explode(":", strval($total));
    if (count($total) !== 3) return false;
    $sum = $total[0]*60*60 + $total[1]*60 + $total[2];
    $average = $sum/(float)$count;
    $hours = floor($average/3600);
    $minutes = floor(fmod($average,3600)/60);
    $seconds = number_format(fmod(fmod($average,3600),60),(int)$rounding);
    return $hours.":".$minutes.":".$seconds;
}

public function validasi_akses_siswa($id_kelas){
	$allow_akses = FALSE;

	if(isset($_SESSION['akses'])){
		$akses = $this->session->userdata('akses');
		if(array_key_exists('premium', $akses)){
			// echo "Premium ADA!";
			$allow_akses = TRUE;
		}else if(array_key_exists('reguler', $akses)){
			$data_mapel = $id_kelas;
			if(in_array($data_mapel, $akses['reguler'])){
				// echo "$data_mapel ADA!";
				$allow_akses = TRUE;
			}else{
				// echo "$data_mapel GAK ADA!";
				$allow_akses = FALSE;
			}
		}else{
			// echo "Reguler GAK ADA!";
			$allow_akses = FALSE;
		}
	}
	return $allow_akses;
}

public function ajax_check_jawaban(){
	$result 	= "No data";
	$id_soal 	= $this->input->post('id');
	$jawaban 	= $this->input->post('jawaban');
	
	$idkategori = $_SESSION['id_kategori'];
	$idsiswa = $this->session->userdata('id_siswa');
	
	$str_time = $this->input->post('waktu');

	sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);

	$time_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
	
	$waktu = $time_seconds / 60;
	
	if(!empty($id_soal) && !empty($jawaban)){
		$kunci_soal = $this->session->userdata('kunci_soal');
		foreach ($kunci_soal as $item){
			if($item['id_banksoal'] == $id_soal){
				if($item['kunci'] == $jawaban){
					
					//SET POIN SISWA
					if($_SESSION['id_siswa']) {
		      			$addpoin = $this->model_poin->add_poin_siswa($_SESSION['id_siswa'], 'jawaban_benar');
					}
					
					
					
					//input analisis topik
					$carianalisistopik = $this->model_fronttryout->carianalisistopik($idkategori, $idsiswa, $id_soal);
					if($carianalisistopik > 0){
						$inputanalisistopik = $this->model_fronttryout->editanalisistopik($idkategori, $idsiswa, $id_soal, 1, $jawaban, $waktu);
					}else{
						$inputanalisistopik = $this->model_fronttryout->inputanalisistopik($idkategori, $idsiswa, $id_soal, 1, $jawaban, $waktu);
						$_SESSION['sudah_dikerjakan'] += 1;
					}
					if($_SESSION['jumlah_soal'] == $_SESSION['sudah_dikerjakan']){
						$result = "benarselesai";
					}else{
						$result = "benar";
					}
				}else{
					
					
					//input analisis topik
					$carianalisistopik = $this->model_fronttryout->carianalisistopik($idkategori, $idsiswa, $id_soal);
					if($carianalisistopik > 0){
						$inputanalisistopik = $this->model_fronttryout->editanalisistopik($idkategori, $idsiswa, $id_soal, 0, $jawaban, $waktu);
					}else{
						$inputanalisistopik = $this->model_fronttryout->inputanalisistopik($idkategori, $idsiswa, $id_soal, 0, $jawaban, $waktu);
						$_SESSION['sudah_dikerjakan'] += 1;
					}
					if($_SESSION['jumlah_soal'] == $_SESSION['sudah_dikerjakan']){
						$result = "salahselesai";
					}else{
						$result = "salah";
					}
				}
			}

		}
	}
	echo $result;
}
function pembahasan($id_sub_materi){
	$idsiswa = $this->session->userdata('id_siswa');
	
	if($idsiswa == ""){
		redirect('login');
	}
	
	$data = array(
		'navbar_links' 	=> $this->model_fronttryout->get_navbar_links(),
		'data_soal'		=> $this->model_fronttryout->fetch_soal_by_kategori($id_sub_materi),
		'durasi'		=> $this->model_fronttryout->get_timer($id_sub_materi)
	);

	$this->load->view('pg_user/pembahasan_tryout', $data);
}

function openclass($idkategori){
	$idsiswa = $this->session->userdata('id_siswa');
	
	$carikelas 	= $this->model_dashboard->get_kelas($idsiswa);
	$kelas 		= $carikelas->kelas;
	if($idsiswa == ""){
		redirect('login');
	}
	
	if(isset($_SESSION['benar'])){
		unset($_SESSION['benar']);
	}
	if(isset($_SESSION['salah'])){
		unset($_SESSION['salah']);
	}
	
	if(isset($_SESSION['jumlah_soal'])){
		unset($_SESSION['jumlah_soal']);
	}
	if(isset($_SESSION['sudah_dikerjakan'])){
		unset($_SESSION['sudah_dikerjakan']);
	}
	
	
	
	$carijumlahsoal = $this->model_fronttryout->jumlah_soal_topik_salah($idkategori, $idsiswa);
	$_SESSION['jumlah_soal'] = $carijumlahsoal;
	$_SESSION['sudah_dikerjakan'] = 0;
	$_SESSION['id_kategori'] = $idkategori ;
	
	
	$kategorikelas = $this->model_fronttryout->get_kelas_by_kategori_tryout($idkategori);
	
	$data = array(
		'soalsalah'	=> $this->model_fronttryout->fetch_topik_soal_salah($idkategori, $idsiswa),
		'soalopen' 	=> $this->model_fronttryout->fetch_open_class($kategorikelas->id_kelas),
		'kelas'		=> $kategorikelas->id_kelas
	);
	
	$session = array(
		'data_latihan' => array(
			'sedang_mengerjakan' 	=> true,
			'skor'					=> 0,
			'id_materi'				=> $idkategori
		),

		'kunci_soal' => $this->model_fronttryout->fetch_array_kunci() 
		);
	$this->session->set_userdata($session);
	
	$this->load->view('pg_user/tryout_openclass', $data);
}


function ajax_jawaban_open_class(){
	$result 	= "No data";
	$id_soal 	= $this->input->post('id');
	$jawaban 	= $this->input->post('jawaban');
	//$idkategori = $_SESSION['id_kategori'];
	$idsiswa = $this->session->userdata('id_siswa');
	
	if(!empty($id_soal) && !empty($jawaban)){
		$kunci_soal = $this->session->userdata('kunci_soal');
		foreach ($kunci_soal as $item){
			if($item['id_banksoal'] == $id_soal){
				if($item['kunci'] == $jawaban){
					if(!isset($_SESSION['benar'])){
						$_SESSION['benar'] = 1;
					}else{
						$benar = $_SESSION['benar'];
						$_SESSION['benar'] = $benar + 1;
					}
					$_SESSION['sudah_dikerjakan'] += 1;
					
					if($_SESSION['jumlah_soal'] == $_SESSION['sudah_dikerjakan']){
						$result = "benarselesai";
					}else{
						$result = "benar";
					}
				}else{
					if(!isset($_SESSION['salah'])){
						$_SESSION['salah'] = 1;
					}else{
						$salah = $_SESSION['salah'];
						$_SESSION['salah'] = $salah + 1;
					}
					$_SESSION['sudah_dikerjakan'] += 1;
					
					if($_SESSION['jumlah_soal'] == $_SESSION['sudah_dikerjakan']){
						$result = "salahselesai";
					}else{
						$result = "salah";
					}
				}
			}

		}
	}
	echo $result;
}

function penilaian_openclass(){
	$submit = $_POST['submit_form_soal'];
	if(!$submit){	
		redirect($_SERVER['HTTP_REFERER']);
	}	

	$skor = $this->input->post('skor');
	
	$idsiswa = $this->session->userdata('id_siswa');
	
	$idkategori = $_SESSION['id_kategori'];
	$carijumlahsoal = $this->model_fronttryout->jumlah_soal_topik_salah($idkategori, $idsiswa);
	
	
	$data = array(
		'skor'	=> ($skor / $carijumlahsoal) * 100
	);
	
	$this->load->view('pg_user/tryout_openclass_selesai', $data);
}
function simpanwaktu(){
	$waktu = "0:0:1";
	sscanf($waktu, "%d:%d:%d", $hours, $minutes, $seconds);

	$time_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
	
	$waktu = $time_seconds / 60;
	
	$idkategori = $_SESSION['id_kategori'];
	$idsiswa = $this->session->userdata('id_siswa');
	//$simpanwaktu = $this->model_fronttryout->simpan_waktu($idkategori, $idsiswa, $waktu);
	//$angka = 256.66666666666666666 + $waktu;
	$cariwaktu = $this->model_fronttryout->cari_waktu($idkategori, $idsiswa);
	
	if($cariwaktu !== 0){
		$waktuterakhir = $cariwaktu->elapsed_time + $waktu;
		$simpanwaktu = $this->model_fronttryout->simpan_waktu($idkategori, $idsiswa, $waktuterakhir);
	}else{
		$simpanwaktu = $this->model_fronttryout->simpan_waktu($idkategori, $idsiswa, $waktu);
	}
	
	$cariwaktulagi = $this->model_fronttryout->cari_waktu($idkategori, $idsiswa);
	//$testwaktu = $cariwaktulagi->elapsed_time + $waktu;
	//echo "<p>".$waktu;
	//echo "<p>".$cariwaktulagi->elapsed_time;
}


function hasil($idpaket){
	//cek apakah siswa sudah set prodi
	$idsiswa 	= $this->session->userdata("id_siswa");
	$cekprodi = $this->model_sbmptn->cek_set_prodi_by_paket($idpaket, $idsiswa);
	if($cekprodi == 0){
		redirect("sbmptn/set_prodi/" . $idpaket);
	}
		
	$idsiswa 	= isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : 0;
	$infosiswa 	= $this->model_dashboard->get_info_siswa($idsiswa);
	$carikelas 	= $this->model_dashboard->get_kelas($idsiswa);
	$kelas 		= $carikelas->kelas;
	
	$setprodi = $this->model_sbmptn->fetch_set_prodi_by_paket($idpaket, $idsiswa);
	
	//cari apakah siswa masuk saintek, soshum atau saintek
	$kelompok = null;
	foreach($setprodi as $prodi){
		if($prodi->kelompok == 'SAINTEK'){
			if($kelompok == null){
				$kelompok = 'SAINTEK';
			}elseif($kelompok == 'SAINTEK'){
				$kelompok = 'SAINTEK';
			}elseif($kelompok == 'SOSHUM'){
				$kelompok = 'CAMPURAN';
			}
		}elseif($prodi->kelompok == 'SOSHUM'){
			if($kelompok == null){
				$kelompok = 'SOSHUM';
			}elseif($kelompok == 'SOSHUM'){
				$kelompok = 'SOSHUM';
			}elseif($kelompok == 'SAINTEK'){
				$kelompok = 'CAMPURAN';
			}
		}
	}
	
	$data = array(
		'infosiswa'			=> $infosiswa,
		'navbar_links' 		=> $this->model_pg->get_navbar_links(),
		'carimapel'			=> $this->model_dashboard->get_mapel_by_kelas($kelas),
		'paket'				=> $this->model_sbmptn->fetch_paket_by_id($idpaket),
		'setprodi'			=> $this->model_sbmptn->fetch_set_prodi_by_paket($idpaket, $idsiswa),
		'testpa'			=> $this->model_sbmptn->fetch_profil_by_jenis_and_paket($idpaket, "tpa"),
		'testkdu'			=> $this->model_sbmptn->fetch_profil_by_jenis_and_paket($idpaket, "tkdu"),
		'kelompok'			=> $kelompok,
		'panlok'			=> $this->model_sbmptn->fetch_set_panlok($idpaket, $idsiswa)
	);
	
	
	if($kelompok == "SAINTEK"){
		$data['tessaintek'] = $this->model_sbmptn->fetch_profil_by_jenis_and_paket($idpaket, "tkd_saintek");
	}elseif($kelompok == "SOSHUM"){
		$data['tessoshum'] = $this->model_sbmptn->fetch_profil_by_jenis_and_paket($idpaket, "tkd_soshum");
	}elseif($kelompok == 'CAMPURAN'){
		$data['tessaintek'] = $this->model_sbmptn->fetch_profil_by_jenis_and_paket($idpaket, "tkd_saintek");
		$data['tessoshum'] = $this->model_sbmptn->fetch_profil_by_jenis_and_paket($idpaket, "tkd_soshum");
	}
	
	$this->load->view('pg_user/sbmptn_hasil', $data);
	
}
}
?>