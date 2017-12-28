<?php 
/**
* 
*/
class Stok extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('paginasi');
		$this->load->helper('alert_helper');
		$this->load->model('model_adm');
		$this->load->model('model_transaksi');
		$this->load->model('model_paket');
		$this->load->model('model_security');
		$this->load->model('model_transaksi');
		$this->load->model('model_stok');
		$this->model_security->is_logged_in();
	}

	function index(){
		$data = array(
			'table_data'				=> $this->model_stok->get_paket_stok(),
		);

		$this->load->view('pg_admin/stok_tabel', $data);
	}

}
