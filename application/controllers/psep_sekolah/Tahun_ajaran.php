<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tahun_ajaran extends CI_Controller {

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

public function index(){
	$idsekolah = $this->session->userdata('idsekolah');
	$data = array(
		'navbar_title' 		=> "Tahun Ajaran",
		'datatahunajaran'	=> $this->model_psep->fetch_tahun_ajaran_by_sekolah($idsekolah),
		'sekolah'			=> $this->model_psep->fetch_sekolah_by_id($idsekolah)
		);
	$this->load->view('psep_sekolah/tahun_ajaran', $data);
}

function proses_tambah(){
	$params 		= $this->input->post(null, true);
	$idsekolah 		= $this->session->userdata('idsekolah');
	$tahun 			= $params['tahun'];
	
	$tambah = $this->model_psep->tambah_tahun_ajaran($idsekolah, $tahun);
	redirect("psep_sekolah/tahun_ajaran");
}

function edit($idtahunajaran){
	$idsekolah = $this->session->userdata('idsekolah');
	$data = array(
		'navbar_title'		=> " Tahun Ajaran",
		'datatahunajaran'	=> $this->model_psep->fetch_tahun_ajaran_by_id($idtahunajaran, $idsekolah),
		'sekolah'			=> $this->model_psep->fetch_sekolah_by_id($idsekolah)
	);
	$this->load->view('psep_sekolah/tahun_ajaran_edit', $data);
}

function proses_edit(){
	$params 		= $this->input->post(null, true);
	$idsekolah 		= $this->session->userdata('idsekolah');
	$idtahunajaran	= $params['idtahunajaran'];
	$tahun 			= $params['tahun'];
	
	$edit = $this->model_psep->edit_tahun_ajaran($idtahunajaran, $tahun);
	redirect("psep_sekolah/tahun_ajaran");
}

function hapus($idtahunajaran){
	$hapus = $this->model_psep->hapus_tahun_ajaran($idtahunajaran);
	redirect("psep_sekolah/tahun_ajaran");
}

}
