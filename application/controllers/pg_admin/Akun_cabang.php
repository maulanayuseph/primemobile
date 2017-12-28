<?php

class Akun_cabang extends CI_Controller{
function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('alert_helper');
		$this->load->model('model_adm');
		$this->load->model('model_pembayaran');
		$this->load->model('model_paket');
		$this->load->model('model_tryout');
		$this->load->model('model_psep');
		$this->load->model('model_sbmptn');
		$this->load->model('model_security');
		$this->model_security->is_logged_in();
	}

function index(){
	$data = array(
		'navbar_title' 	=> "Akun Cabang",
		'judul'			=> "Manajemen PSEP Cabang",
		'select_provinsi' 	=> $this->model_adm->fetch_options_provinsi()
	);
	$this->load->view("pg_admin/cabang", $data);
}

}
?>