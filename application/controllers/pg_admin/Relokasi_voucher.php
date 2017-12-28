<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relokasi_voucher extends CI_Controller {

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
		$this->load->model('model_relokasi_voucher');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->model_security->is_logged_in();
  }

function index(){
	$data = array(
		'datapaket'	=> $this->model_relokasi_voucher->fetch_all_paket()
	);
	$this->load->view("pg_admin/relokasi_voucher/index", $data);
}

function proses_relokasi(){
	$params 		= $this->input->post(null, true);
	$idpaketawal 	= $params['idawal'];
	$idpaketakhir 	= $params['idakhir'];
	$jumlahrelokasi = $params['jumlah'];

	//fetch voucher by paket
	$datavoucher = $this->model_relokasi_voucher->fetch_voucher_by_paket($idpaketawal);

	$x = 1;
	foreach($datavoucher as $voucher){
		if($x <= $jumlahrelokasi){
			$this->model_relokasi_voucher->update_paket($voucher->kode_voucher, $idpaketakhir);
		}
		$x++;
	}
	redirect("pg_admin/relokasi_voucher");
}

}
?>