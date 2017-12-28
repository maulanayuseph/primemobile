<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends CI_Controller {

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
		$this->load->model('model_psep');
		$this->load->model('model_dashboard');
		$this->load->model('model_agcu');
		$this->load->model('model_lstest');
		$this->load->model('model_pg');
		$this->load->model('model_security');
		$this->model_security->psep_sekolah_is_logged_in();
	}
	
function index(){
	$idsekolah = $this->session->userdata('idsekolah');
	$data = array(
		'navbar_title' 	=> "Manajemen Guru",
		'active'		=> "guru",
		'sekolah'		=> $this->model_psep->fetch_sekolah_by_id($idsekolah),
		'dataguru'		=> $this->model_psep->fetch_all_guru($idsekolah)
	);
	
	$this->load->view("psep_sekolah/guru", $data);
}

function tambah(){
	$idpsep = $this->session->userdata('idpsepsekolah');
	$carisekolah = $this->model_psep->cari_sekolah_by_login($idpsep);
	$data = array(
		'navbar_title' 	=> "Register  Guru",
		'active'		=> "guru",
		'sekolah'		=> $carisekolah,
		'datakelas'		=> $this->model_psep->cari_kelas_by_jenjang($carisekolah->jenjang)
	);
	
	$this->load->view("psep_sekolah/guru_form", $data);
}

function proses_tambah(){
	$params 		= $this->input->post(null, true);
	$idsekolah 		= $this->session->userdata('idsekolah');
	
	
	$nama 		= $params['nama'];
	$email 		= $params['email'];
	$username 	= $params['username'];
	$password 	= $params['password'];
	$repassword = $params['repassword'];
	
	if($password !== $repassword){
		alert_error("Gagal Register", "Password tidak sama");
		redirect("psep_sekolah/guru/tambah");
	}else{
		
		$cariuserpass = $this->model_adm->cari_user_psep_sekolah($username, $password);
		
		if($cariuserpass === FALSE){
			$tipe 		 	= $this->cek_tipe($_FILES['identitas']['type']);
		
			if($tipe !== false){
				$img_path	 	= "assets/uploads/identitas/";
				$namafile		= md5($nama).md5(time()).$tipe;
				
				
				$config['upload_path']		= $img_path;
				$config['allowed_types']    = 'gif|jpg|png';
				$config['file_name'] 		= $namafile;
				
				$this->load->library('upload', $config);
				$this->upload->do_upload('identitas');
				
				$result = $this->model_psep->tambah_guru(
				$idsekolah, $nama, $email, $username, $password, $namafile);
				
				redirect('psep_sekolah/guru');
			}else{
				alert_error("Gagal Register", "Format file identitas tidak dikenal (gunakan file berformat .jpg/.jpeg/.png)");
				redirect("psep_sekolah/guru/tambah");
			}
		}else{
			alert_error("Gagal Register", "Username Sudah ada yang memakai, pakai username yang lain!");
			redirect("psep_sekolah/guru/tambah");
		}
	}
}

private function cek_tipe($tipe){

	if ($tipe == 'image/jpeg') 

		{ return ".jpg"; }

	

	else if($tipe == 'image/png') 

		{ return ".png"; }

	

	else 

		{ return false; }

}
}
?>