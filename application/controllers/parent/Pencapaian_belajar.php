<?php

class pencapaian_belajar extends CI_Controller{
	
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

function fetch_mapok(){
	$params 			= $this->input->get(null, true);
	$idmapel 			= $params['idmapel'];
	$idsiswa 			= $_SESSION['id_ortu_siswa'];
	$tanggalsekarang 	= date('Y-m-d');
	
	$carikelas 			= $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);
	
	$materibelajar = $this->model_rencana_belajar->fetch_rencana_belajar_by_mapel($idmapel, $idsiswa);
	
	$pencapaian = 0;
	if($materibelajar !== null){
	    foreach($materibelajar as $materi){
    		$carisubmateri = $this->model_rencana_belajar->fetch_sub_by_materi_pokok_and_kurikulum($materi->id_materi_pokok, $materi->rencana_kurikulum);
    		
    		foreach($carisubmateri as $sub){
    			$cekpencapaian = $this->model_rencana_belajar->cek_pencapaian($this->session->userdata("id_siswa"), $sub->id_sub_materi);
    			if($cekpencapaian > 0){
    				$pencapaian += 1;
    			}
    		}
    	}
	}
	$data = array(
		'materibelajar'	=> $this->model_rencana_belajar->fetch_rencana_belajar_by_mapel($idmapel, $idsiswa),
		'infomapel'			=> $this->model_dashboard->get_info_mapel($idmapel),
		'jumlahkonten'		=> $this->model_rencana_belajar->get_jumlah_konten_belajar($idmapel, $idsiswa),
		//'pencapaian'		=> $this->model_rencana_belajar->get_pencapaian_siswa_by_mapel($idmapel, $idsiswa)
		'pencapaian'		=> $pencapaian
	);
	
	$this->load->view("pg_ortu/ajax_pencapaian_belajar/bab_tersimpan", $data);
	//echo $idmapel;
	//$mapoktersimpan
}

function refresh_rencana(){
	$idsiswa 	= $_SESSION['id_ortu_siswa'];
	$mapelsiswa	= $this->model_rencana_belajar->fetch_mapel_by_materi_tersimpan($idsiswa);
	
	$tanggalsekarang = date('Y-m-d');
	$carikelas = $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);
	$kelas = $carikelas->id_kelas;
	
	$data = array(
		"mapeltersimpan"	=> $this->model_rencana_belajar->fetch_mapel_by_materi_tersimpan_and_kelas_aktif($idsiswa, $kelas)

	);
	//$this->load->view("pg_user/ajax_mapel_siswa");
	//cek jumlah rencana apakah lebih dari 0
	//$cekrencana = $this->model_rencana_belajar->cek_rencana_siswa();
	///echo "hahhahaha";
	$this->load->view("pg_ortu/ajax_pencapaian_belajar/ajax_mapel_siswa", $data);
}
}
?>