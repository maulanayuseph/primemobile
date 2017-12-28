<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manajemen_tema extends CI_Controller {

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
		$this->load->model('model_manajemen_tema');
		$this->model_security->is_logged_in();
  }

function index(){
	$data = array(
		'datakurikulum'	=> $this->model_manajemen_kurikulum->fetch_all_kurikulum(),
		'datakelas'		=> $this->model_adm->fetch_all_kelas()
	);
	$this->load->view("pg_admin/Manajemen_tema/index", $data);
}

function filter_tema($idkelas = null, $idkurikulum = null){
	$data = array(
		'datatema'		=> $this->model_manajemen_tema->fetch_tema_by_kelas_and_kurikulum($idkelas, $idkurikulum)
	);
	$this->load->view("pg_admin/manajemen_tema/ajax_refresh", $data);
}

function tambah(){
	$data = array(
		'select_options_kelas'	=> $this->model_adm->fetch_all_kelas(),
		'datakurikulum'	=> $this->model_manajemen_kurikulum->fetch_all_kurikulum(),
	);
	$this->load->view("pg_admin/manajemen_tema/ajax_tambah", $data);
}

function proses_tambah(){
	$params 		= $this->input->post(null, true);
	$idkelas 		= $params['idkelas'];
	$idkurikulum 	= $params['idkurikulum'];
	$tema 			= $params['tema'];

	$this->model_manajemen_tema->tambah_tema($idkelas, $idkurikulum, $tema);

	$data = array(
		'idkelas'		=> $idkelas,
		'idkurikulum'	=> $idkurikulum
	);
	echo json_encode($data);
}

function edit($idtema){
	$data = array(
		'select_options_kelas'	=> $this->model_adm->fetch_all_kelas(),
		'datakurikulum'	=> $this->model_manajemen_kurikulum->fetch_all_kurikulum(),
		"tema"					=> $this->model_manajemen_tema->fetch_tema_by_id($idtema)
	);
	$this->load->view("pg_admin/manajemen_tema/ajax_edit", $data);
}

function proses_edit(){
	$params 		= $this->input->post(null, true);
	$idtema			= $params['idtema'];
	$idkelas		= $params['idkelas'];
	$idkurikulum	= $params['idkurikulum'];
	$tema			= $params['tema'];

	$this->model_manajemen_tema->edit_tema($idtema, $idkelas, $idkurikulum, $tema);

	$data = array(
		"idkelas"		=> $idkelas,
		"idkurikulum"	=> $idkurikulum
	);

	echo json_encode($data);
}

function proses_hapus(){
	$params 	= $this->input->post(null, true);
	$idtema		= $params['idtema'];

	$tema 		= $this->model_manajemen_tema->fetch_tema_by_id($idtema);

	$data = array(
		'idkelas'		=> $tema->id_kelas,
		'idkurikulum'	=> $tema->id_kurikulum
	);

	$this->model_manajemen_tema->hapus_tema($idtema);

	echo json_encode($data);
}

function tambah_sub_tema($idtema){
	$data = array(
		"tema"	=> $this->model_manajemen_tema->fetch_tema_by_id($idtema)
	);
	$this->load->view("pg_admin/manajemen_tema/ajax_tambah_sub_tema", $data);
}

function proses_tambah_sub_tema(){
	$params 	= $this->input->post(null, true);
	$idtema 	= $params['idtema'];
	$subtema 	= $params['subtema'];

	$this->model_manajemen_tema->tambah_sub_tema($idtema, $subtema);

	$tema 		= $this->model_manajemen_tema->fetch_tema_by_id($idtema);

	$data = array(
		'idkelas'		=> $tema->id_kelas,
		'idkurikulum'	=> $tema->id_kurikulum
	);
	echo json_encode($data);
}

function edit_sub_tema($idsubtema){
	$data = array(
		"subtema"	=> $this->model_manajemen_tema->fetch_sub_tema_by_id($idsubtema)
	);
	$this->load->view("pg_admin/manajemen_tema/ajax_edit_sub_tema", $data);
}

function proses_edit_sub_tema(){
	$params 	= $this->input->post(null, true);
	$idsubtema 	= $params['idsub'];
	$subtema 	= $params['subtema'];

	$this->model_manajemen_tema->edit_sub_tema($idsubtema, $subtema);

	$sub = $this->model_manajemen_tema->fetch_sub_tema_by_id($idsubtema);

	$data = array(
		'idkelas'		=> $sub->id_kelas,
		'idkurikulum'	=> $sub->id_kurikulum
	);

	echo json_encode($data);
}

function proses_hapus_sub_tema(){
	$params = $this->input->post(null, true);
	$idsub 	= $params['idsub'];
	$sub = $this->model_manajemen_tema->fetch_sub_tema_by_id($idsub);

	$data = array(
		'idkelas'		=> $sub->id_kelas,
		'idkurikulum'	=> $sub->id_kurikulum
	);
	$this->model_kurikulum->hapus_sub_tema($idsub);
	echo json_encode($data);
}

}
?>