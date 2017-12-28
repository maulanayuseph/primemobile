<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Set_latihan extends CI_Controller {

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
		$this->load->model('model_banksoal');
		$this->load->model('model_set_latihan');
		$this->load->model('model_security');
		$this->model_security->is_logged_in();
  }

function index(){
	$data = array(
		"datakelas"	=> $this->model_banksoal->get_kelas()
	);
	$this->load->view("pg_admin/set_latihan", $data);
}

function ajax_latihan($idmapel){
	$data = array(
		"databab"	=> $this->model_set_latihan->fetch_bab_by_mapel($idmapel)
	);
	$this->load->view("pg_admin/set_latihan_ajax_latihan", $data);
}

function set_uji(){
	$params 	= $this->input->post(null, false);
	$idsub		= $params['idsub'];
	$datasub 	= $this->model_set_latihan->fetch_sub_by_id($idsub);
	
	if($datasub->tipe_latihan == 0){
		$this->model_set_latihan->set_latihan($idsub, 1);
	}else{
		$this->model_set_latihan->set_latihan($idsub, 0);
	}
}
}
?>