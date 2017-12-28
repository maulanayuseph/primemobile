<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wilayah extends CI_Controller {

	public function __construct()
  {
    parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('alert_helper');
		$this->load->model('model_adm');
		$this->load->model('model_security');
		$this->load->model('model_wilayah');
		$this->load->model('model_adm_event');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->model_security->is_logged_in();
  }


function index(){
	$data = array(
		'datawilayah'	=> $this->model_wilayah->fetch_all_wilayah()
	);
	$this->load->view("pg_admin/wilayah/index", $data);
}

function proses_tambah_wilayah(){
	$params 		= $this->input->post(null, true);
	$namawilayah	= $params['namawilayah'];

	$this->model_wilayah->insert_wilayah($namawilayah);

	redirect('pg_admin/wilayah');
}

function edit_wilayah($idwilayah){
	$data = array(
		'wilayah'	=> $this->model_wilayah->fetch_wilayah_by_id($idwilayah)
	);
	$this->load->view("pg_admin/wilayah/edit_wilayah", $data);
}

function proses_edit_wilayah(){
	$params 		= $this->input->post(null, true);
	$idwilayah 		= $params['idwilayah'];
	$namawilayah	= $params['namawilayah'];

	$this->model_wilayah->edit_wilayah($idwilayah, $namawilayah);
	redirect('pg_admin/wilayah');
}

function hapus_wilayah($idwilayah){
	$this->model_wilayah->hapus_wilayah($idwilayah);
	$this->model_wilayah->hapus_wilayah_x_kota_by_wilayah($idwilayah);
	redirect("pg_admin/wilayah");
}

function kota_wilayah($idwilayah){
	$data = array(
		'datakota'	=> $this->model_wilayah->fetch_kota_by_wilayah($idwilayah),
		'wilayah'	=> $this->model_wilayah->fetch_wilayah_by_id($idwilayah),
		"dataprovinsi"	=> $this->model_adm_event->fetch_provinsi()
	);
	$this->load->view("pg_admin/wilayah/manage_kota", $data);
}

function ajax_kota_by_provinsi($idprovinsi, $idwilayah){
	$data = array(
		'datakota'		=> $this->model_adm_event->fetch_kota_by_provinsi($idprovinsi),
		'idwilayah'		=> $idwilayah,
		'idprovinsi'	=> $idprovinsi
	);
	$this->load->view("pg_admin/wilayah/ajax_kota_by_provinsi", $data);
}

function ajax_tambah_kota(){
	$params			= $this->input->post(null, true);
	$idkota 		= $params['idkota'];
	$idwilayah 		= $params['idwilayah'];

	//cek dulu apakah kota sudah ada di wilayah_x_kota
	$cekkota 		= $this->model_wilayah->count_kota_by_wilayah($idkota);

	if($cekkota > 0){
		$data = array(
			'data'				=> $this->model_wilayah->fetch_kota_and_wilayah($idkota),
			'wilayahtujuan'		=> $idwilayah,
			'status'			=> 'failed'
		);
		$result = json_encode($data);
		echo $result;
	}else{
		$this->model_wilayah->insert_kota_by_wilayah($idkota, $idwilayah);

		$data = array(
			'data'				=> $this->model_wilayah->fetch_kota_and_wilayah($idkota),
			'wilayahtujuan'		=> $idwilayah,
			'status'			=> 'success'
		);
		$result = json_encode($data);
		echo $result;
	}
}

function ajax_tambah_kota_bypass(){
	$params			= $this->input->post(null, true);
	$idkota 		= $params['idkota'];
	$idwilayah 		= $params['idwilayah'];

	$this->model_wilayah->hapus_kota($idkota);

	$this->model_wilayah->insert_kota_by_wilayah($idkota, $idwilayah);

	$data = array(
		'data'		=> $this->model_wilayah->fetch_kota_and_wilayah($idkota),
		'status'	=> 'success'
	);
	$result = json_encode($data);
	echo $result;
}

function refresh_kota_wilayah($idwilayah){
	$data = array(
		'datakota'	=> $this->model_wilayah->fetch_kota_by_wilayah($idwilayah),
		'wilayah'	=> $this->model_wilayah->fetch_wilayah_by_id($idwilayah)
	);
	$this->load->view("pg_admin/wilayah/ajax_refresh_kota_wilayah", $data);
}

function hapus_kota(){
	$params		= $this->input->post(null, true);
	$idkota		= $params['idkota'];
	$idwilayah	= $params['idwilayah'];

	$data = array(
		'data'		=> $this->model_wilayah->fetch_kota_and_wilayah($idkota),
		'status'	=> 'success'
	);
	$result = json_encode($data);

	$this->model_wilayah->hapus_kota($idkota);

	echo $result;
}

function insert_all_kota(){
	$params		= $this->input->post(null, true);
	$idprovinsi = $params['idprovinsi'];
	$idwilayah 	= $params['idwilayah'];

	$datakota 	= $this->model_adm_event->fetch_kota_by_provinsi($idprovinsi);

	foreach($datakota as $kota){
		$cekkota 		= $this->model_wilayah->count_kota_by_wilayah($kota->id_kota);
		if($cekkota > 0){
			$this->model_wilayah->hapus_kota($kota->id_kota);
			$this->model_wilayah->insert_kota_by_wilayah($kota->id_kota, $idwilayah);
		}else{
			$this->model_wilayah->insert_kota_by_wilayah($kota->id_kota, $idwilayah);
		}
	}
	$data = array(
		'idwilayah'	=> $idwilayah,
		'status'	=> 'success'
	);
	$result = json_encode($data);
	echo $result;
}

}
?>