<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class manajemen_mapel extends CI_Controller {

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
		$this->load->model('model_kurikulum');
		$this->load->model('model_atribut');
		$this->load->model('model_security');
		$this->load->model('model_manajemen_kurikulum');
		$this->load->model('model_manajemen_mapel');
		$this->model_security->is_logged_in();
  }

function index(){
	$data = array(
		"datakelas"		=> $this->model_adm->fetch_all_kelas(),
		"datakurikulum"	=> $this->model_manajemen_kurikulum->fetch_all_kurikulum()
	);
	$this->load->view("pg_admin/manajemen_mapel/index", $data);
}

function tambah(){
	$data = array(
		"datakelas"		=> $this->model_adm->fetch_all_kelas(),
		"datakurikulum"	=> $this->model_manajemen_kurikulum->fetch_all_kurikulum()
	);
	$this->load->view("pg_admin/manajemen_mapel/ajax_tambah", $data);
}

function proses_tambah(){
	$params 		= $this->input->post(null, true);
	$idkelas 		= $params['idkelas'];
	$idkurikulum 	= $params['idkurikulum'];
	$mapel 			= $params['mapel'];

	$this->model_manajemen_mapel->tambah_mapel($idkelas, $idkurikulum, $mapel);

	$data = array(
		'idkelas'		=> $idkelas,
		'idkurikulum'	=> $idkurikulum
	);

	echo json_encode($data);
}

function edit($idmapel){
	$data = array(
		"mapel"		=> $this->model_manajemen_mapel->fetch_mapel_by_id($idmapel),
		"datakelas"		=> $this->model_adm->fetch_all_kelas(),
		"datakurikulum"	=> $this->model_manajemen_kurikulum->fetch_all_kurikulum()
	);
	$this->load->view("pg_admin/manajemen_mapel/ajax_edit", $data);
}

function proses_edit(){
	$params 		= $this->input->post(null, true);
	$idmapel 		= $params["idmapel"];
	$idkelas 		= $params['idkelas'];
	$idkurikulum 	= $params['idkurikulum'];
	$mapel 			= $params['mapel'];

	$this->model_manajemen_mapel->edit_mapel($idmapel, $idkelas, $idkurikulum, $mapel);

	$data = array(
		'idkelas'		=> $idkelas,
		'idkurikulum'	=> $idkurikulum
	);

	echo json_encode($data);
}

function proses_hapus(){
	$params 	= $this->input->post(null, true);
	$idmapel	= $params['idmapel'];

	$mapel 		= $this->model_manajemen_mapel->fetch_mapel_by_id($idmapel);

	$data = array(
		"idkelas"		=> $mapel->kelas_id,
		"idkurikulum"	=> $mapel->id_kurikulum
	);
	$this->model_manajemen_mapel->hapus_mapel($idmapel);

	echo json_encode($data);
}

function filter_mapel($idkelas = null, $idkurikulum =  null){
	$data = array(
		'datamapel'	=> $this->model_manajemen_mapel->fetch_mapel_by_filter($idkelas, $idkurikulum)
	);
	$this->load->view("pg_admin/manajemen_mapel/ajax_refresh", $data);
}

}
?>