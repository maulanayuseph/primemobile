<?php

class Agcu extends CI_Controller{
	
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
		$this->model_security->parent_logged_in();
	}

function index(){
	$idsiswa = $_SESSION['id_ortu_siswa'];
	//untuk keperluan AGCU
	$infosiswa = $this->model_dashboard->get_info_siswa($idsiswa);
	$carikelas = $this->model_dashboard->get_kelas($idsiswa);
	$kelas = $carikelas->kelas;

	$data = array(
		'infoortu'			=> $this->model_parent->get_parent($_SESSION['id_ortu']),
		'infosiswa'			=> $infosiswa,
		'listagcu'	=> $this->model_parent->fetch_agcu_by_kelas_and_kurikulum($kelas, $infosiswa->kurikulum)
	);
	$this->load->view("pg_ortu/agcu_index", $data);
}

}
?>