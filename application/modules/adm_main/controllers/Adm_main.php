<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adm_main extends CI_Controller {

	public function __construct()
  {
    parent::__construct();
	//$this->load->model('model_user_dashboard');
	$this->load->model('adm_main_model');
	$this->load->helper(array('form', 'url'));
  }

function index(){
	if ($this->input->server('PHP_AUTH_USER') !== "primegeneration" and $this->input->server('PHP_AUTH_PW') !== "f3b04d48cc4e00abb8327f6d4642f6d6") {
	    header('HTTP/1.0 401 Unauthorized');
		header('HTTP/1.1 401 Unauthorized');
		header('WWW-Authenticate: Basic realm="Masukkan autentikasi untuk melakukan akses ke manajemen Prime Mobile"');
		echo '<div style="position: fixed;top: 50%;left: 50%;margin-top: -100px;margin-left: -100px;width: 100%;">';
		echo '<img src="'. adm_asset .'images/logo-red.png" class="logo" alt="logo"><p>&nbsp;</p><p>Sorry :(</p>';
		echo '</div>';
	    exit;
	} else {
		if($this->session->userdata('admlevel') !== null){
			redirect("adm_main/redirect_dashboard");
			return true;
		}
	    $data = array(
			'title'			=> "Content Management System Login",	
			'content'		=> "adm_main/index",
			'headerassets'	=> "adm_main/headerassets",
			'footerassets'	=> "adm_main/footerassets"
		);
		$this->load->view("template_admin/template_adm", $data);
	}
}

function login_auth(){
	$params 	= $this->input->post(null, true);
	$username 	= $params['username'];
	$password 	= $params['password'];

	$this->load->library('form_validation');
	$this->form_validation->set_rules('username', 'Username', 'required');
	$this->form_validation->set_rules('password', 'Password', 'required');
	if ($this->form_validation->run() == FALSE){
		$respon = array(
			'sid'			=> $this->security->get_csrf_hash(),
			'keterangan'	=> "Username dan password harus diisi!",
			'status'		=> "failed"
		);
		$data = json_encode($respon);
		echo $data;
	}else{
		//cari apakah username ada
		$cekusername = $this->adm_main_model->fetch_login_adm_by_username($username);
		if($cekusername !== null){
			//cekapakah password sesuai
			$ceklogin = $this->adm_main_model->fetch_login_adm_by_username_and_password($username, md5($password));
			if($ceklogin !== null){
				$this->session->set_userdata('idlogin', $ceklogin->id_adm);
				$this->session->set_userdata('admlevel', $ceklogin->level);
				$respon = array(
					'sid'			=> $this->security->get_csrf_hash(),
					'keterangan'	=> "YEEEAH!",
					'status'		=> "success"
				);
				$data = json_encode($respon);
				echo $data;
				return true;
			}else{
				$respon = array(
					'sid'			=> $this->security->get_csrf_hash(),
					'keterangan'	=> "Password yang anda masukkan salah!",
					'status'		=> "failed"
				);
				$data = json_encode($respon);
				echo $data;
				return true;
			}
		}else{
			$respon = array(
				'sid'			=> $this->security->get_csrf_hash(),
				'keterangan'	=> "Username yang anda masukkan tidak terdaftar!",
				'status'		=> "failed"
			);
			$data = json_encode($respon);
			echo $data;
			return true;
		}
	}
}

function refresh_csrf(){
	echo $this->security->get_csrf_hash();
}


function redirect_dashboard(){
	if($this->session->userdata('admlevel') == null){
		redirect("pm_admin");
		return true;
	}
	if($this->session->userdata('admlevel') == "superadmin"){
		redirect('adm_dashboard/superadmin');
	}else{
		echo $this->session->userdata('admlevel') . ";level ini belum memiliki dashboard <a href='".base_url('adm_main/logout')."'>Log Out</a>";
	}
}

function logout(){
	$this->session->sess_destroy();
	redirect("pm_admin");
}


}
?>