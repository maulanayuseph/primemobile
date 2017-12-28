<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

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
		$this->load->model('model_security');
	}

function index(){
	$data = array(
		'title'	=> "Beranda"
	);
	$this->load->view("psep/dashboard", $data);
}
}