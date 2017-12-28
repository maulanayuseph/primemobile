<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pr extends CI_Controller {

	public function __construct()

  {
    parent::__construct();

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
		$this->load->model('model_fronttryout');
		$this->load->model('model_pr');
		$this->load->model('model_security');
		$this->model_security->siswa_logged_in();
		$this->model_security->activation_security();
  }

function index(){
	$idsiswa 			= $this->session->userdata('id_siswa');
	$infosiswa 			= $this->model_dashboard->get_info_siswa($idsiswa);
	$carikelas 			= $this->model_dashboard->get_kelas($idsiswa);
	$tahunajaransiswa 	= $this->model_psep->fetch_tahun_ajaran_siswa($idsiswa, $carikelas->kelas);
	
	$data = array(
		'infosiswa'				=> $infosiswa,
		'navbar_links' 			=> $this->model_pg->get_navbar_links(),
		'tahunajaran'			=> $tahunajaransiswa,
		'datapr'				=> $this->model_psep->fetch_pr_by_kelas_and_tahun_ajaran($tahunajaransiswa->id_kelas_paralel, $tahunajaransiswa->id_tahun_ajaran)
	);
	
	$this->load->view("pg_user/pr", $data);
}

function mulai($idpr){
	$idsiswa = $this->session->userdata('id_siswa');
	//cari status pr, apakah sudah dikerjakan apa belum, kalau sudah, redirect ke dashboard 
	$caristatus = $this->model_pr->fetch_status_pr_siswa($idpr, $idsiswa);

	if($caristatus !== null){
		if($caristatus->status == 1){
			redirect("user/dashboard");
		}
	}

	$insertstatuspr = $this->model_pr->insert_status_belum($idpr, $idsiswa);
	if(isset($_SESSION['benar'])){
		unset($_SESSION['benar']);
	}
	if(isset($_SESSION['salah'])){
		unset($_SESSION['salah']);
	}
	//set session kategori_tryout
	if(isset($_SESSION['id_pr'])){
		unset($_SESSION['id_pr']);
	}
	$_SESSION['id_pr'] = $idpr;
	//set session jumlah soal untuk cek selesai
	if(isset($_SESSION['jumlah_soal'])){
		unset($_SESSION['jumlah_soal']);
	}
	if(isset($_SESSION['sudah_dikerjakan'])){
		unset($_SESSION['sudah_dikerjakan']);
	}
	
	$data = array(
		'navbar_links' 	=> $this->model_fronttryout->get_navbar_links(),
		'data_soal'		=> $this->model_pr->fetch_soal_by_pr($idpr),
		'infopr'	=> $this->model_pr->get_info_pr($idpr)
	);
	
	//cari apakah pr sudah ada yang terjawab
	$terjawab = $this->model_pr->cari_terjawab($idpr, $idsiswa);
	if($terjawab !== null){
		$data['terjawab'] = $terjawab;
		$_SESSION['sudah_dikerjakan'] = $this->model_pr->jumlah_terjawab($idpr, $idsiswa);
	}else{
		$_SESSION['sudah_dikerjakan'] = 0;
	}
	
	$carijumlahsoal = $this->model_pr->jumlah_soal($idpr);
	$_SESSION['jumlah_soal'] = $carijumlahsoal;
	
	$session = array(
			'data_latihan' 			=> array(
			'sedang_mengerjakan' 	=> true,
			'skor'					=> 0,
			'id_materi'				=> $idpr
		),
		'kunci_soal' => $this->model_pr->fetch_array_id_soal($idpr) 
		);
		
	$this->session->set_userdata($session);
	session_write_close();
	
	if((!$idpr) OR (!$_SESSION['data_latihan']['sedang_mengerjakan'])){
		//Redirect history back -1
		redirect("pr");
	}
	
	$this->load->view('pg_user/pr_mulai', $data);
}

function ajax_check_jawaban(){
	//echo "hehehehe";
	$result 	= "No data";
	$id_soal 	= $this->input->post('id');
	$jawaban 	= $this->input->post('jawaban');
	
	$idpr = $_SESSION['id_pr'];
	$idsiswa = $this->session->userdata('id_siswa');
	
	//$str_time = $this->input->post('waktu');

	//sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);

	//$time_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
	
	//$waktu = $time_seconds / 60;
	
	if(!empty($id_soal) && !empty($jawaban)){
		$kunci_soal = $this->session->userdata('kunci_soal');
		foreach ($kunci_soal as $item){
			if($item['id_soal_pr'] == $id_soal){
				if($item['kunci'] == $jawaban){
					//input analisis pr
					$carianalisispr = $this->model_pr->cari_analisis_pr($idpr, $idsiswa, $id_soal);
					if($carianalisispr > 0){
						$inputanalisispr = $this->model_pr->edit_analisis_pr($idpr, $idsiswa, $id_soal, 1, $jawaban);
					}else{
						$inputanalisispr = $this->model_pr->input_analisis_pr($idpr, $idsiswa, $id_soal, 1, $jawaban);
						$_SESSION['sudah_dikerjakan'] += 1;
					}
					if($_SESSION['jumlah_soal'] == $_SESSION['sudah_dikerjakan']){
						$result = "benarselesai";
					}else{
						$result = "benar";
					}
				}else{
					//input analisis pr
					$carianalisispr = $this->model_pr->cari_analisis_pr($idpr, $idsiswa, $id_soal);
					if($carianalisispr > 0){
						$inputanalisispr = $this->model_pr->edit_analisis_pr($idpr, $idsiswa, $id_soal, 0, $jawaban);
					}else{
						$inputanalisispr = $this->model_pr->input_analisis_pr($idpr, $idsiswa, $id_soal, 0, $jawaban);
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


function penilaian(){
	if(!isset($_SESSION['id_pr'])){
		redirect("pr");
	}
	
	$idpr 		= $_SESSION['id_pr'];
	$idsiswa 	= $this->session->userdata('id_siswa');
	
	$jumlahsoal	 	= $this->model_pr->jumlah_soal($idpr);
	$jumlahbenar 	= $this->model_pr->jumlah_benar_by_siswa_and_pr($idpr, $idsiswa);
	
	$nilai = ($jumlahbenar / $jumlahsoal) * 100;
	
	$insertstatuspr = $this->model_pr->insert_status_selesai($idpr, $idsiswa);
	
	//echo $nilai;
	
	unset($_SESSION['benar']);
	unset($_SESSION['salah']);
	unset($_SESSION['id_pr']);
	
	$data = array(
		'infopr'		=> $this->model_pr->get_info_pr($idpr),
		'jumlahsoal'	=> $jumlahsoal,
		'jumlahbenar'	=> $jumlahbenar,
		'nilai'			=> $nilai
		
	);
	$this->load->view("pg_user/pr_selesai", $data);
}

function statistik($idpr){
	//cek apakah pr benar2 sudah dikerjakan oleh siswa
	$idsiswa 	= $this->session->userdata('id_siswa');
	$cekpr = $this->model_pr->fetch_status_pr($idpr, $idsiswa);
	
	if($cekpr == null){
		redirect("pr");
	}else{
		if($cekpr->status == 0){
			redirect("pr");
		}
	}
	
	$jumlahsoal	 	= $this->model_pr->jumlah_soal($idpr);
	$jumlahbenar 	= $this->model_pr->jumlah_benar_by_siswa_and_pr($idpr, $idsiswa);
	
	$nilai = ($jumlahbenar / $jumlahsoal) * 100;
	
	$infosiswa 			= $this->model_dashboard->get_info_siswa($idsiswa);
	$carikelas 			= $this->model_dashboard->get_kelas($idsiswa);
	$tahunajaransiswa 	= $this->model_psep->fetch_tahun_ajaran_siswa($idsiswa, $carikelas->kelas);
	$data = array(
		'infosiswa'		=> $infosiswa,
		'navbar_links' 	=> $this->model_pg->get_navbar_links(),
		'tahunajaran'	=> $tahunajaransiswa,
		'infopr'		=> $this->model_pr->get_info_pr($idpr),
		'jumlahsoal'	=> $jumlahsoal,
		'jumlahbenar'	=> $jumlahbenar,
		'nilai'			=> $nilai
	);
	$this->load->view("pg_user/pr_statistik", $data);
}

function mulai_eksak($idpr){

	$idsiswa = $this->session->userdata('id_siswa');
	$caristatus = $this->model_pr->fetch_status_pr_siswa($idpr, $idsiswa);

	if($caristatus !== null){
		if($caristatus->status == 1){
			redirect("user/dashboard");
		}
	}
	$insertstatuspr = $this->model_pr->insert_status_belum($idpr, $idsiswa);
	if(isset($_SESSION['benar'])){
		unset($_SESSION['benar']);
	}
	if(isset($_SESSION['salah'])){
		unset($_SESSION['salah']);
	}
	//set session kategori_tryout
	if(isset($_SESSION['id_pr'])){
		unset($_SESSION['id_pr']);
	}
	$_SESSION['id_pr'] = $idpr;
	//set session jumlah soal untuk cek selesai
	if(isset($_SESSION['jumlah_soal'])){
		unset($_SESSION['jumlah_soal']);
	}
	if(isset($_SESSION['sudah_dikerjakan'])){
		unset($_SESSION['sudah_dikerjakan']);
	}
	
	$data = array(
		'navbar_links' 	=> $this->model_fronttryout->get_navbar_links(),
		'data_soal'		=> $this->model_pr->fetch_soal_eksak_by_pr($idpr),
		'infopr'	=> $this->model_pr->get_info_pr($idpr)
	);
	
	//cari apakah pr sudah ada yang terjawab
	$terjawab = $this->model_pr->cari_terjawab($idpr, $idsiswa);
	if($terjawab !== null){
		$data['terjawab'] = $terjawab;
		$_SESSION['sudah_dikerjakan'] = $this->model_pr->jumlah_terjawab($idpr, $idsiswa);
	}else{
		$_SESSION['sudah_dikerjakan'] = 0;
	}
	
	$carijumlahsoal = $this->model_pr->jumlah_soal($idpr);
	$_SESSION['jumlah_soal'] = $carijumlahsoal;
	
	$session = array(
			'data_latihan' 			=> array(
			'sedang_mengerjakan' 	=> true,
			'skor'					=> 0,
			'id_materi'				=> $idpr
		),
		'kunci_soal' => $this->model_pr->fetch_array_id_soal($idpr) 
		);
		
	$this->session->set_userdata($session);
	session_write_close();
	
	if((!$idpr) OR (!$_SESSION['data_latihan']['sedang_mengerjakan'])){
		//Redirect history back -1
		redirect("pr");
	}
	
	$this->load->view('pg_user/pr_eksak_mulai', $data);
}

function ajax_cek_kesempatan_eksak(){
	$idsiswa	= $this->session->userdata('id_siswa');
	$params 	= $this->input->post(null, true);
	$idsoal 	= $params['idsoal'];
	
	$cekkesempatan = $this->model_pr->fetch_kesempatan_eksak($idsiswa, $idsoal);
	
	if($cekkesempatan !== null){
		if($cekkesempatan->kesempatan > 0){
			//kurangi kesempatan
			$sisakesempatan = $cekkesempatan->kesempatan - 1;
			
			$this->model_pr->insert_kesempatan_eksak($idsiswa, $idsoal, $sisakesempatan);
			
			$cekkesempatan2 = $this->model_pr->fetch_kesempatan_eksak($idsiswa, $idsoal);
			echo $cekkesempatan2->kesempatan;
		}else{
			echo $cekkesempatan->kesempatan;
		}
	}else{
		$this->model_pr->insert_kesempatan_eksak($idsiswa, $idsoal, 3);
		
		$cekkesempatan2 = $this->model_pr->fetch_kesempatan_eksak($idsiswa, $idsoal);
		echo $cekkesempatan2->kesempatan;
	}
}

function ajax_save_jawaban_eksak(){
	$idsiswa	= $this->session->userdata('id_siswa');
	$idpr		= $_SESSION['id_pr'];
	$params 	= $this->input->post(null, true);
	$jawaban 	= $params['jawaban'];
	$idsoal 	= $params['idsoal'];
	//echo "id soal : " . $idsoal . "";
	//var_dump($jawaban);
	
	$x = 0;
	foreach($jawaban as $jawab){
		//echo $jawab;
		$terjawab = explode("_", $jawab);
		$idpertanyaan = $terjawab[0];
		$terjawab = $terjawab[1];
		//echo $terjawab;
		$carijawab = $this->model_psep->fetch_pertanyaan_eksak_by_id($idpertanyaan);
		//echo $carijawab->jawaban;

		$status = "";
		if($carijawab->jawaban == $terjawab){
			//input ke analisis pr eksak
			$this->model_pr->insert_analisis_pr_eksak($idpr, $idsiswa, $idpertanyaan, $terjawab, 1);
			$status .= $idpertanyaan . "_benar;";
		}else{
			$this->model_pr->insert_analisis_pr_eksak($idpr, $idsiswa, $idpertanyaan, $terjawab, 0);
			$status .= $idpertanyaan . "_salah;";
		}
		echo $status;
	}
}

function ajax_cek_jawaban_eksak(){
	$idsiswa	= $this->session->userdata('id_siswa');
	$idpr		= $_SESSION['id_pr'];
	$params 	= $this->input->post(null, true);
	$jawaban 	= $params['jawaban'];
	$idsoal 	= $params['idsoal'];
	//echo "id soal : " . $idsoal . "";
	//var_dump($jawaban);
	
	$x = 0;
	foreach($jawaban as $jawab){
		//echo $jawab;
		$terjawab = explode("_", $jawab);
		$idpertanyaan = $terjawab[0];
		$terjawab = $terjawab[1];
		//echo $terjawab;
		$carijawab = $this->model_psep->fetch_pertanyaan_eksak_by_id($idpertanyaan);
		//echo $carijawab->jawaban;

		$status = "";
		if($carijawab->jawaban == $terjawab){
			//input ke analisis pr eksak
			$this->model_pr->insert_analisis_pr_eksak_checked($idpr, $idsiswa, $idpertanyaan, $terjawab, 1);
			$status .= $idpertanyaan . "_benar;";
		}else{
			$this->model_pr->insert_analisis_pr_eksak_checked($idpr, $idsiswa, $idpertanyaan, $terjawab, 0);
			$status .= $idpertanyaan . "_salah;";
		}
		echo $status;
	}
}

function penilaian_eksak(){
	$idsiswa 	= $this->session->userdata('id_siswa');
	$idpr 		= $_SESSION['id_pr'];
	$params 	= $this->input->post(null, true);
	
	$daftarintro = $this->model_pr->fetch_soal_eksak_by_pr($idpr);
	foreach($daftarintro as $item){
		$caritanya = $this->model_psep->fetch_soal_by_intro($item->id_intro_soal);
		
		foreach($caritanya as $tanya){
			if(isset($params['jawaban' . $tanya->id_soal_eksak])){
				$terjawab = $params['jawaban' . $tanya->id_soal_eksak];
				$carijawab = $this->model_psep->fetch_pertanyaan_eksak_by_id($tanya->id_soal_eksak);
				if($carijawab->jawaban == $terjawab){
					$this->model_pr->insert_analisis_pr_eksak($idpr, $idsiswa, $tanya->id_soal_eksak, $terjawab, 1);
				}else{
					$this->model_pr->insert_analisis_pr_eksak($idpr, $idsiswa, $tanya->id_soal_eksak, $terjawab, 0);
				}
			}
		}
	}
	
	$jumlahsoal = $this->model_pr->fetch_jumlah_soal_eksak_by_pr($idpr);
	$jumlahbenar = $this->model_pr->fetch_benar_eksak_by_siswa($idpr, $idsiswa);
	
	$nilai = $jumlahbenar / $jumlahsoal * 100;
	//echo $nilai;
	
	unset($_SESSION['benar']);
	unset($_SESSION['salah']);
	unset($_SESSION['id_pr']);
	
	$insertstatuspr = $this->model_pr->insert_status_selesai($idpr, $idsiswa);
	
	$data = array(
		'infopr'		=> $this->model_pr->get_info_pr($idpr),
		'jumlahsoal'	=> $jumlahsoal,
		'jumlahbenar'	=> $jumlahbenar,
		'nilai'			=> $nilai
		
	);
	$this->load->view("pg_user/pr_eksak_selesai", $data);
}

function statistik_eksak($idpr){
	//cek apakah pr benar2 sudah dikerjakan oleh siswa
	$idsiswa 	= $this->session->userdata('id_siswa');
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
		'infosiswa'		=> $infosiswa,
		'navbar_links' 	=> $this->model_pg->get_navbar_links(),
		'tahunajaran'	=> $tahunajaransiswa,
		'infopr'		=> $this->model_pr->get_info_pr($idpr),
		'jumlahbenar'	=> $jumlahbenar,
		'jumlahsoal'	=> $jumlahsoal,
		'nilai'			=> $nilai,
		'data_soal'		=> $this->model_pr->fetch_soal_eksak_by_pr($idpr)
	);
	
	$this->load->view("pg_user/pr_eksak_statistik", $data);
}

function mulai_essai($idpr){
	$idsiswa = $this->session->userdata('id_siswa');
	$caristatus = $this->model_pr->fetch_status_pr_siswa($idpr, $idsiswa);

	if($caristatus !== null){
		if($caristatus->status == 1){
			redirect("user/dashboard");
		}
	}
	$insertstatuspr = $this->model_pr->insert_status_belum($idpr, $idsiswa);
	if(isset($_SESSION['benar'])){
		unset($_SESSION['benar']);
	}
	if(isset($_SESSION['salah'])){
		unset($_SESSION['salah']);
	}
	//set session kategori_tryout
	if(isset($_SESSION['id_pr'])){
		unset($_SESSION['id_pr']);
	}
	$_SESSION['id_pr'] = $idpr;
	//set session jumlah soal untuk cek selesai
	if(isset($_SESSION['jumlah_soal'])){
		unset($_SESSION['jumlah_soal']);
	}
	if(isset($_SESSION['sudah_dikerjakan'])){
		unset($_SESSION['sudah_dikerjakan']);
	}
	
	$data = array(
		'navbar_links' 	=> $this->model_fronttryout->get_navbar_links(),
		'data_soal'		=> $this->model_pr->fetch_soal_essai_by_pr($idpr),
		'infopr'	=> $this->model_pr->get_info_pr($idpr)
	);
	
	//cari apakah pr sudah ada yang terjawab
	$terjawab = $this->model_pr->cari_terjawab($idpr, $idsiswa);
	if($terjawab !== null){
		$data['terjawab'] = $terjawab;
		$_SESSION['sudah_dikerjakan'] = $this->model_pr->jumlah_terjawab($idpr, $idsiswa);
	}else{
		$_SESSION['sudah_dikerjakan'] = 0;
	}
	
	$carijumlahsoal = $this->model_pr->jumlah_soal($idpr);
	$_SESSION['jumlah_soal'] = $carijumlahsoal;
	
	$session = array(
			'data_latihan' 			=> array(
			'sedang_mengerjakan' 	=> true,
			'skor'					=> 0,
			'id_materi'				=> $idpr
		),
		'kunci_soal' => $this->model_pr->fetch_array_id_soal($idpr) 
		);
		
	$this->session->set_userdata($session);
	session_write_close();
	
	if((!$idpr) OR (!$_SESSION['data_latihan']['sedang_mengerjakan'])){
		//Redirect history back -1
		redirect("pr");
	}
	
	$this->load->view('pg_user/pr_essai_mulai', $data);
}

function ajax_save_jawaban_essai(){
	$idsiswa 	= $this->session->userdata('id_siswa');
	$params 	= $this->input->post(null, true);
	$idpr 		= $params['idpr'];
	$idsoal 	= $params['idsoal'];
	$jawaban 	= $params['jawaban'];
	
	$this->model_pr->simpan_analisis_essai($idpr, $idsoal, $idsiswa, $jawaban);
	
	if(isset($params['selesai'])){
		//ganti status PR menjadi 1 (sudah selesai, tapi belum dikoreksi guru)
		$this->model_pr->set_status_essai($idpr, $idsiswa, 1);
		redirect("user/dashboard");
	}
}

function statistik_essai($idpr){
	//cek apakah pr benar2 sudah dikerjakan oleh siswa
	$idsiswa 	= $this->session->userdata('id_siswa');
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
		'infosiswa'		=> $infosiswa,
		'navbar_links' 	=> $this->model_pg->get_navbar_links(),
		'tahunajaran'	=> $tahunajaransiswa,
		'infopr'		=> $this->model_pr->get_info_pr($idpr),
		'jumlahbenar'	=> $jumlahbenar,
		'jumlahsoal'	=> $jumlahsoal,
		'nilai'			=> $nilai,
		'data_soal'		=> $this->model_pr->fetch_soal_essai_by_pr($idpr)
	);
	
	$this->load->view("pg_user/pr_essai_statistik", $data);
}
}