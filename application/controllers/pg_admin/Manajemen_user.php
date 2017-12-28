<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manajemen_user extends CI_Controller {

	public function __construct()
  {
    parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('alert_helper');
		$this->load->model('model_adm');
		$this->load->model('model_security');
		$this->load->model('model_psep');
		$this->load->model('model_kesiswaan');
		$this->load->model('model_voucher');
		$this->load->model('model_pg');
		$this->load->model('model_aktivasi_psep');
		$this->load->model('model_manajemen_user');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->model_security->is_logged_in();
  }

function index(){
	$this->load->view("pg_admin/manajemen_user/index");
}

function search(){
	$params 	= $this->input->get();
	$where 		= $params['where'];
	$keyword 	= $params["keyword"];

	if($where == null or $keyword == null){
		redirect("pg_admin/manajemen_user");
	}

	if($where == "kode_voucher"){
		$where = "paket_aktif.kode_voucher";
	}
	$data = array(
		'datasiswa' => $this->model_manajemen_user->search($where, $keyword)
	);

	$this->load->view("pg_admin/manajemen_user/search_result", $data);
}

function reset_password(){
	$params 	= $this->input->post(null, true);
	$idlogin 	= $params['idlogin'];

	$this->model_manajemen_user->reset_password($idlogin);
}

function reset_login($idsiswa){
	$data = array(
		'timestamp'	=> 0
	);
	$this->db->where("id_siswa", $idsiswa);
	$this->db->update("login_aktif", $data);

}


function mass_reset_pass($idsekolah){
	$datasiswa = $this->model_manajemen_user->fetch_siswa_by_sekolah($idsekolah);

	foreach($datasiswa as $siswa){
		$this->model_manajemen_user->custom_reset_password($siswa->id_login, "FOkYansdiO");
	}
}
}
?>