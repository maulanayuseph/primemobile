<?php

class Final_qc extends CI_Controller{
function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('alert_helper');
		$this->load->model('model_adm');
		$this->load->model('model_pembayaran');
		$this->load->model('model_paket');
		$this->load->model('model_tryout');
		$this->load->model('model_banksoal');
		$this->load->model('model_security');
		$this->load->model('model_rekap');
		$this->load->model('model_kurikulum');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->model_security->is_logged_in();
	}

function dashboard(){
	$data = array(
		'navbar_title' 	=> "Dashboard",
		'datakelas'		=> $this->model_banksoal->get_kelas()
	);

	$this->load->view('pg_admin/dashboard_final_qc', $data);
}


}