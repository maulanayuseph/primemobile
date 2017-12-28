<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adm_dashboard extends CI_Controller {

	public function __construct()
  {
    parent::__construct();
	//$this->load->model('model_user_dashboard');
	$this->load->model('adm_dashboard_model');
	$this->load->model('adm_main/adm_main_model');
	$this->load->helper(array('form', 'url'));
	$this->adm_main_model->adm_login_security();
  }

function adm_data(){
	$dataadm = $this->adm_main_model->fetch_admin_by_id($this->session->userdata('idlogin'));
	return $dataadm;
}

function superadmin(){
	$this->adm_main_model->security_level_superadmin();
	$data = array(
		'title'			=> 'Super Administrator Dashboard',
		'content'		=> 'adm_dashboard/superadmin_dashboard',
		'headerassets'	=> 'adm_dashboard/superadmin_headerassets',
		'footerassets'	=> 'adm_dashboard/superadmin_footerassets',
		'dataadmin'		=> $this->adm_data()
	);
	$this->load->view("template_admin/template_adm", $data);
}



}
?>