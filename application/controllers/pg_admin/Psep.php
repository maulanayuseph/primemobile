<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Psep extends CI_Controller {

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
		$this->load->model('model_kesiswaan');
		$this->load->model('model_voucher');
		$this->load->model('model_pg');
		$this->load->model('model_pa');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->model_security->is_logged_in();
  }

function pengajuan(){
	$url = "http://dealership.primemobile.co.id/api/all_dealer";
	$data = array(
		'select_provinsi' 	=> $this->model_adm->fetch_options_provinsi(),
		'judul'				=> "Pengajuan Aktivasi PSEP",
		'datadealer'		=> json_decode($this->curl_get_contents($url), true),
		'datapaket'			=> $this->model_pa->fetch_paket_psep()
	);
	$this->load->view("pg_admin/psep/pengajuan_form", $data);
}

function daftar_pengajuan(){
	$data = array(
		'judul'	=> 'Daftar Pengajuan Aktivasi PSEP',
	);
	$this->load->view("pg_admin/psep/daftar_pengajuan", $data);
}


function curl_get_contents($url){
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}
}
?>