<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uss extends CI_Controller {

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
		$this->load->model('model_tryout');
		$this->load->model('model_fronttryout');
		$this->load->model('model_security');
		$this->load->model('model_psep_cbt');
		$this->load->model('model_psep_uss');
		$this->model_security->psep_sekolah_is_logged_in();
	}



function sbmptn(){
	$idpsep = $this->session->userdata('idpsepsekolah');
	$idsekolah = $this->session->userdata('idsekolah');
	$carisekolah = $this->model_psep->cari_sekolah_by_login($idpsep);
	$data = array(
		'navbar_title' 	=> "",
		'sekolah'		=> $this->model_psep->fetch_sekolah_by_id($idsekolah),
		'datasbmptn'	=> $this->model_psep_uss->fetch_paket_sbmptn()
	);

	$this->load->view("psep_sekolah/sbmptn", $data);
}

function tambah_jadwal_sbmptn($idpaket){
	$datapaket	= $this->model_psep_uss->fetch_paket_by_id($idpaket);
	$idsekolah 	= $this->session->userdata('idsekolah');

	$datakelas 	= $this->model_psep_uss->fetch_kelas_paralel_12($idsekolah);

	$data = array(
		'idpaket'		=> $idpaket,
		'datakelas'		=> $datakelas,
		'tahunajaran'	=> $this->model_psep->fetch_tahun_ajaran_by_sekolah($idsekolah)
	);
	$this->load->view("psep_sekolah/uss_ajax/ajax_tambah_jadwal_sbmptn", $data);
}

function proses_tambah_jadwal(){
	$params 	= $this->input->post(null, true);
	$idpaket	 	= $params['idpaket'];
	$idkelasparalel = $params['kelas'];
	$idtahunajaran 	= $params['tahun'];
	$tanggalmulai	= new DateTime($params['startdate']);
	$tanggalakhir	= new DateTime($params['enddate']);
	$startdate 		= date_format($tanggalmulai, 'Y-m-d H:i:s');
	$enddate 		= date_format($tanggalakhir, 'Y-m-d H:i:s');

	//cek dulu apakah end date lebih dari startdate
	if($startdate <= $enddate){
		$this->model_psep_uss->tambah_jadwal_sbmptn($idpaket, $idkelasparalel, $idtahunajaran, $startdate, $enddate);

		$respon = array(
			'idpaket'	=> $idpaket
		);
		$data = json_encode($respon);
		echo $data;
	}else{
		echo "tanggal error";
	}
}

function proses_hapus_jadwal(){
	$params 	= $this->input->post(null, true);
	$idpaket 	= $params['idpaket'];
	$idconfig 	= $params['idconfig'];

	$respon = array(
		'idpaket'	=> $idpaket
	);

	$this->model_psep_uss->hapus_jadwal($idconfig);

	$data = json_encode($respon);
	echo $data;
}

function refresh_jadwal($idpaket){
	$idsekolah = $this->session->userdata('idsekolah');
	$data = array(
		'idpaket'		=> $idpaket,
		'datajadwal'	=> $this->model_psep_uss->fetch_jadwal_by_paket($idpaket, $idsekolah)
	);
	$this->load->view("psep_sekolah/uss_ajax/ajax_refresh", $data);
}

}
?>