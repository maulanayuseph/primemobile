<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap_penulis extends CI_Controller {

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
		$this->load->model('model_author');
		$this->load->model('model_security');
		$this->model_security->is_logged_in();
  }

function index(){
	$this->load->view("pg_admin/author/rekap");
}

function ajax_rekap_penulis($startdate = null, $enddate =  null){
	if($startdate !== null and $enddate !== null){
		$data = array(
			'datapenulis' => $this->model_author->fetch_rekap_author($startdate, $enddate)
		);
		$this->load->view("pg_admin/author/ajax_rekap_penulis", $data);
	}
}


}
?>