<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {

	public function __construct()
  {
    parent::__construct();
		
		//check user session

		//load library in construct. Construct method will be run everytime the controller is called 
		//This library will be auto-loaded in every method in this controller. 
		//So there will be no need to call the library again in each method. 
		$this->load->library('form_validation');
		$this->load->helper('alert_helper');
		$this->load->model('model_kurikulum');
		$this->load->model('model_adm');
		$this->load->model('model_banksoal');
		$this->load->model('model_atribut');
		$this->load->model('model_history');
		$this->load->model('model_security');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->model_security->is_logged_in();
  }
 
function ajax_dashboard(){
	$data = array(
		"datahistory"	=> $this->model_history->fetch_all_history_dashboard()
	);
	$this->load->view("pg_admin/history/ajax_dashboard", $data);
}

function detail_soal($idsoal){
	$data = array(
		"datahistory"	=> $this->model_history->fetch_history_by_soal($idsoal),
		"soal"			=> $this->model_adm->fetch_soal_by_id($idsoal)
	);
	$this->load->view("pg_admin/history/detail_soal", $data);
}

function ajax_history_by_id($idhistory){
	$data = array(
		"soal"	=> $this->model_history->fetch_history_by_idhistory($idhistory)
	);
	$this->load->view("pg_admin/history/ajax_history_detail", $data);
}

function history_by_adm($idadm){
	
}

function history_by_tanggal($startdate, $enddate){
	
}


}
?>