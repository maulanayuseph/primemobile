<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas_paralel extends CI_Controller {

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
		$this->load->model('model_security');
		$this->load->model('model_psep');
		$this->model_security->psep_sekolah_is_logged_in();
	}

function index(){
	$idsekolah = $this->session->userdata('idsekolah');
	$sekolah = $this->model_psep->fetch_sekolah_by_id($idsekolah);
	$data = array(
		'navbar_title' 		=> "Kelas paralel",
		'datakelas'			=> $this->model_adm->fetch_kelas_by_jenjang($sekolah->jenjang),
		'kelasparalel'		=> $this->model_psep->fetch_kelas_paralel_by_sekolah($idsekolah),
		'sekolah'			=> $this->model_psep->fetch_sekolah_by_id($idsekolah)
		);
	$this->load->view('psep_sekolah/kelas_paralel', $data);
}

function proses_tambah(){
	$params 		= $this->input->post(null, true);
	$idsekolah 		= $this->session->userdata('idsekolah');
	
	$idkelas 		= $params['kelas'];
	$kelasparalel 	= $params['kelasparalel'];
	
	$this->model_psep->tambah_kelas_paralel($idsekolah, $idkelas, $kelasparalel);
	
	redirect("psep_sekolah/kelas_paralel");
}

function edit($idkelasparalel){
	$idsekolah = $this->session->userdata('idsekolah');
	$sekolah = $this->model_psep->fetch_sekolah_by_id($idsekolah);
	$data = array(
		'navbar_title'		=> 'Kelas paralel',
		'datakelas'			=> $this->model_adm->fetch_kelas_by_jenjang($sekolah->jenjang),
		'sekolah'			=> $this->model_psep->fetch_sekolah_by_id($idsekolah),
		'kelasparalel'		=> $this->model_psep->fetch_kelas_paralel_by_id($idkelasparalel)
	);
	$this->load->view("psep_sekolah/kelas_paralel_edit", $data);
}

function proses_edit(){
	$params 		= $this->input->post(null, true);
	$idsekolah 		= $this->session->userdata('idsekolah');
	$idkelasparalel = $params['idkelasparalel'];
	$idkelas 		= $params['kelas'];
	$kelasparalel 	= $params['kelasparalel'];
	
	$this->model_psep->edit_kelas_paralel($idkelasparalel, $idsekolah, $idkelas, $kelasparalel);
	
	redirect("psep_sekolah/kelas_paralel");
}

function hapus($idkelasparalel){
	$hapus = $this->model_psep->hapus_kelas_paralel($idkelasparalel);
	redirect("psep_sekolah/kelas_paralel");
}

}