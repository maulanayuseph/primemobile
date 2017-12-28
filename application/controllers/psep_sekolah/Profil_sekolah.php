<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class profil_sekolah extends CI_Controller {

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
		$this->load->model('model_psep_profil');
		$this->load->model('model_banksoal');
		$this->load->model('model_pr');
		$this->load->model('model_dashboard');
		$this->load->model('model_pg');
		$this->load->model('model_materi_urutan');
		$this->model_security->psep_sekolah_is_logged_in();
	}

	
function index(){
	$idsekolah = $this->session->userdata('idsekolah');
	$sekolah = $this->model_psep->fetch_sekolah_by_id($idsekolah);
	$data = array(
		'navbar_title' 	=> "Dashboard",
		'sekolah'		=> $sekolah	
		);


	$this->load->view('psep_sekolah/profil_sekolah', $data);
}

function proses_edit(){
	$params 	= $this->input->post(null, true);
	$idsekolah 	= $this->session->userdata('idsekolah');
	$alamat 	= $params['alamat'];
	$email 		= $params['email'];
	$telepon 	= $params['telepon'];
	$motto 		= $params['motto'];
	
	$this->model_psep_profil->edit_profil_sekolah($idsekolah, $alamat, $email, $telepon, $motto);
	
	redirect("psep_sekolah/profil_sekolah");
}

function upload_logo(){
	$idsekolah 	= $this->session->userdata('idsekolah');
	if ($_FILES['logo']['type'] == 'image/jpeg'){ 
		$tipe = ".jpg";
	}else if($_FILES['logo']['type'] == 'image/png'){
		$tipe = ".png";
	}else{
		redirect("psep_sekolah/profil_sekolah");
	}
	
	$filename = $this->session->userdata('idsekolah') . md5(time()) . $tipe;
	
	$config['upload_path']          = 'assets/uploads/logo-sekolah/';

	$config['allowed_types']        = 'gif|jpg|png';

	$config['max_size']             = 2048;

	$config['max_width']            = 1024;

	$config['max_height']           = 768;

	$config['overwrite']            = TRUE;
	
	$config['file_name']			= $filename;

	$this->load->library('upload', $config);
	
	if($this->upload->do_upload('logo')){
		$this->model_psep_profil->update_logo($idsekolah, $filename);
		redirect("psep_sekolah/profil_sekolah");
	}else{
		redirect("psep_sekolah/profil_sekolah");
	}

}

function upload_banner(){
	$idsekolah 	= $this->session->userdata('idsekolah');
	if ($_FILES['banner']['type'] == 'image/jpeg'){ 
		$tipe = ".jpg";
	}else if($_FILES['banner']['type'] == 'image/png'){
		$tipe = ".png";
	}else{
		redirect("psep_sekolah/profil_sekolah");
	}
	
	$filename = "banner-".$this->session->userdata('idsekolah') . md5(time()) . $tipe;
	
	$config['upload_path']          = 'assets/uploads/logo-sekolah/';

	$config['allowed_types']        = 'gif|jpg|png';

	$config['max_size']             = 2048;

	$config['max_width']            = 1024;

	$config['max_height']           = 768;

	$config['overwrite']            = TRUE;
	
	$config['file_name']			= $filename;

	$this->load->library('upload', $config);
	
	if($this->upload->do_upload('banner')){
		$this->model_psep_profil->update_banner($idsekolah, $filename);
		redirect("psep_sekolah/profil_sekolah");
	}else{
		redirect("psep_sekolah/profil_sekolah");
	}

}

}
