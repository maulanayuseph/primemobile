<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manajemen_kurikulum extends CI_Controller {

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
		$this->model_security->is_logged_in();
  }

function index(){
	$data = array(
		'datakurikulum'	=> $this->model_manajemen_kurikulum->fetch_all_kurikulum()
	);
	$this->load->view("pg_admin/manajemen_kurikulum/index", $data);
}

function tambah(){
	$this->load->view("pg_admin/manajemen_kurikulum/ajax_tambah");
}

function proses_tambah(){
	$params		= $this->input->post(null, true);
	$kurikulum 	= $params['kurikulum'];

	$this->model_manajemen_kurikulum->tambah_kurikulum($kurikulum);
}

function edit($idkurikulum){
	$data = array(
		'kurikulum'	=> $this->model_manajemen_kurikulum->fetch_kurikulum_by_id($idkurikulum)
	);
	$this->load->view("pg_admin/manajemen_kurikulum/ajax_edit", $data);
}

function proses_edit(){
	$params 		= $this->input->post(null, true);
	$idkurikulum 	= $params['idkurikulum'];
	$kurikulum 		= $params['kurikulum'];

	$this->model_manajemen_kurikulum->edit_kurikulum($idkurikulum, $kurikulum);
}

function proses_hapus(){
	$params 		= $this->input->post(null, true);
	$idkurikulum	= $params['idkurikulum'];
	$this->model_manajemen_kurikulum->hapus_kurikulum($idkurikulum);
}

function refresh_kurikulum(){
	$data = array(
		'datakurikulum'	=> $this->model_manajemen_kurikulum->fetch_all_kurikulum()
	);
	$this->load->view("pg_admin/manajemen_kurikulum/ajax_refresh", $data);
}

}
?>