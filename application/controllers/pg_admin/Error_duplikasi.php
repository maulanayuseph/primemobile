<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error_duplikasi extends CI_Controller {

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
		$this->load->model('model_duplikat');
		$this->load->model('model_security');
		$this->model_security->is_logged_in();
  }

function index(){
	$data = array(
		"datakelas"		=> $this->model_adm->fetch_all_kelas()
	);
	$this->load->view("pg_admin/cek_duplikasi", $data);
}

function ajax_soal($idmapel){
	$data = array(
		"datasoal"	=> $this->model_duplikat->fetch_soal_by_mapel($idmapel)
	);
	$this->load->view("pg_admin/duplikat_ajax_komparasi_soal", $data);
}

function ajax_komparasi($idsoal, $idsoalsumber){
	$data = array(
		"soaltujuan"	=> $this->model_adm->fetch_soal_by_id($idsoal),
		"soalsumber"	=> $this->model_adm->fetch_soal_by_id($idsoalsumber)
	);
	$this->load->view("pg_admin/duplikat_ajax_komparasi_soal_detail", $data);
}


}