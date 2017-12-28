<?php
class Raport extends CI_Controller{
function __construct(){
	parent::__construct();
	$this->load->library('form_validation');
	$this->load->helper('alert_helper');
	$this->load->model('model_adm');
	$this->load->model('model_security');
	$this->load->model('model_psep');
	$this->load->model('model_banksoal');
	$this->load->model('model_pr');
	$this->load->model('model_dashboard');
	$this->load->model('model_pg');
	$this->load->model('model_materi_urutan');
	$this->load->model('model_silabus');
	$this->load->model('model_raport');
	
	$this->model_security->psep_sekolah_is_logged_in();
}

function index(){
	$sekolah = $this->model_psep->fetch_sekolah_by_id($this->session->userdata('idsekolah'));
	$data = array(
		"sekolah" 		=> $this->model_psep->fetch_sekolah_by_id($this->session->userdata('idsekolah')),
		"dataprofil"	=> $this->model_raport->fetch_all_profil_by_sekolah($this->session->userdata('idsekolah'))
	);
	$this->load->view("psep_sekolah/raport", $data);
}

function tambah_profil(){
	$sekolah = $this->model_psep->fetch_sekolah_by_id($this->session->userdata('idsekolah'));
	$data = array(
		"datakelas"		=> $this->model_adm->fetch_kelas_by_jenjang($sekolah->jenjang),
		"tahunajaran"	=> $this->model_psep->fetch_tahun_ajaran_by_sekolah($this->session->userdata('idsekolah'))
	);
	$this->load->view("psep_sekolah/raport_ajax/ajax_tambah_profil", $data);
}

function proses_tambah_profil(){
	$params = $this->input->post(null, true);
	$kelas 		= $params['kelas'];
	$tahun 		= $params['tahun'];
	$semester 	= $params['semester'];

	//cek dulu apakah raport dengan config tersebut sudah ada
	$cek = $this->model_raport->cek_raport($kelas, $tahun, $semester);

	if($cek == 0){
		$this->model_raport->tambah_profil($kelas, $tahun, $semester);
		echo "sukses tambah profil";
	}else{
		echo "profil sudah ada";
	}
}

function refresh_profil(){
	$data = array(
		"dataprofil"	=> $this->model_raport->fetch_all_profil_by_sekolah($this->session->userdata('idsekolah'))
	);
	$this->load->view("psep_sekolah/raport_ajax/ajax_profil", $data);
}

function detail($idprofil){
	//cek kebenaran profil. apakah benar milik sekolah tersebut
	$cek = $this->model_raport->cek_kebenaran($idprofil);
	if($cek == 0){
		redirect("psep_sekolah/raport");
	}
	$sekolah = $this->model_psep->fetch_sekolah_by_id($this->session->userdata('idsekolah'));
	$profil = $this->model_raport->fetch_profil_by_id($idprofil);
	$data = array(
		"sekolah" 	=> $this->model_psep->fetch_sekolah_by_id($this->session->userdata('idsekolah')),
		"profil"	=> $this->model_raport->fetch_profil_by_id($idprofil),
		"datamapel"	=> $this->model_silabus->fetch_mapel_by_kelas_and_sekolah($profil->id_kelas, $this->session->userdata('idsekolah'))
	);
	$this->load->view("psep_sekolah/raport_detail_profil", $data);
}

function edit_profil($idprofil){
	$data = array(
		"profil"	=> $this->model_raport->fetch_profil_by_id($idprofil)
	);
	$this->load->view("psep_sekolah/ajax_profil/ajax_edit_profil", $data);
}

function 
}
?>