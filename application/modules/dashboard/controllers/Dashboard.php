<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
  {
    parent::__construct();
	$this->load->model('model_user_dashboard');
  }

function index(){
	$data = array(
		'infosiswa' => $this->model_user_dashboard->get_info_siswa($this->session->userdata("idsiswa"))
	);
	$this->load->view('dashboard/index', $data);
}
}
?>