<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adm_konten extends CI_Controller {

	public function __construct()
  {
    parent::__construct();
	//$this->load->model('model_user_dashboard');
	$this->load->model('adm_konten_model');
	$this->load->model('adm_main/adm_main_model');
	$this->load->helper(array('form', 'url'));
	$this->adm_main_model->adm_login_security();
  }

function adm_data(){
	$dataadm = $this->adm_main_model->fetch_admin_by_id($this->session->userdata('idlogin'));
	return $dataadm;
}

function kur_mapel(){
	$this->adm_main_model->security_level_superadmin();
	$data = array(
		'title'			=> 'Prime Mobile Management | Konten Mata Pelajaran',
		'content'		=> 'adm_konten/kur_mapel/kur_mapel',
		'headerassets'	=> 'adm_konten/kur_mapel/kur_mapel_headerassets',
		'footerassets'	=> 'adm_konten/kur_mapel/kur_mapel_footerassets',
		'dataadmin'		=> $this->adm_data(),
		'datakelas'		=> $this->adm_konten_model->fetch_kurikulum_x_kelas_group()
	);
	$this->load->view("template_admin/template_adm", $data);
}

}
?>