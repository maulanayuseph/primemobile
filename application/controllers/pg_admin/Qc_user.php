<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qc_user extends CI_Controller {

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
		$this->load->model('model_qc_user');
		$this->load->model('model_security');
		$this->model_security->is_logged_in();
  }

function index(){
	$data = array(
		'dataadmin'		=> $this->model_qc_user->fetch_level_qc()
	);

	$this->load->view("pg_admin/qc_user/index", $data);
}

function tambah(){
	$data = array(
	);
	$this->load->view("pg_admin/qc_user/tambah", $data);
}


function proses_tambah(){
	$params 	= $this->input->post(null, true);
	$nama 		= $params['nama'];
	$username 	= $params['username'];
	$password 	= $params['password'];
	$repassword = $params['repassword'];

	if($password == $repassword){
		//cari apakah username sudah ada di database
		$cekusername = $this->model_qc_user->fetch_admin_by_username($username);

		if($cekusername > 0){
			alert_error("Error", "Username yang anda masukkan sudah ada yang memiliki, gunakan username lain");
			redirect("pg_admin/qc_user/tambah");
		}else{
			$tambah = $this->model_qc_user->tambah_user($nama, $username, $password);
		}
	}else{
		alert_error("Error", "Password yang anda masukkan tidak sama");
		redirect("pg_admin/qc_user/tambah");
	}
	if($tambah){
		alert_success("Success", "User barhasil ditambahkan");
		redirect("pg_admin/qc_user");
	}
}

function edit($idadmin = null){
	if($idadmin == null){
		redirect('pg_admin/qc_user');
	}
	//cek apakah user qc
	$admin = $this->model_qc_user->fetch_admin_by_id($idadmin);
	if($admin == null){
		redirect('pg_admin/qc_user');
	}
	if($admin->level !== "qc"){
		redirect('pg_admin/qc_user');
	}
	$data = array(
		'admin'		=> $admin
	);
	$this->load->view("pg_admin/qc_user/edit", $data);
}

function proses_edit(){
	$params 	= $this->input->post(null, true);
	$idadmin 	= $params['idadmin'];
	$nama 		= $params['nama'];
	$username 	= $params['username'];

	//cek dulu usernamenya ada yang punya apa tidak
	$cekusername = $this->model_qc_user->fetch_admin_by_username($username);
	if($cekusername > 0){
		alert_error("Error", "Username yang anda masukkan sudah ada yang memiliki, gunakan username lain");
		redirect("pg_admin/qc_user/edit/" . $idadmin);
	}else{
		$edit = $this->model_qc_user->edit_admin($idadmin, $nama, $username);
	}
	
	if($edit){
		alert_success("Success", "User barhasil diubah");
		redirect("pg_admin/qc_user");
	}else{
		alert_error("Error", "User gagal diubah");
		redirect("pg_admin/qc_user");
	}
}

function ubah_password($idadmin){
	if($idadmin == null){
		redirect('pg_admin/qc_user');
	}
	//cek apakah user qc
	$admin = $this->model_qc_user->fetch_admin_by_id($idadmin);
	if($admin == null){
		redirect('pg_admin/qc_user');
	}
	if($admin->level !== "qc"){
		redirect('pg_admin/qc_user');
	}
	$data = array(
		'admin'		=> $admin
	);
	$this->load->view("pg_admin/qc_user/edit_password", $data);
}

function proses_ubah_password(){
	$params 	= $this->input->post(null, true);
	$idadmin 	= $params['idadmin'];
	$password 	= $params['password'];
	$repassword = $params['repassword'];

	if($password == $repassword){
		$edit = $this->model_qc_user->edit_password($idadmin, $password);
	}else{
		alert_error("Error", "Password yang anda masukkan tidak sama");
		redirect("pg_admin/qc_user/tambah");
	}
	if($edit){
		alert_success("Success", "User barhasil diubah");
		redirect("pg_admin/qc_user");
	}else{
		alert_error("Error", "User gagal diubah");
		redirect("pg_admin/qc_user");
	}
}

function assignment_qc($idadm){
	$data = array(
		'navbar_title' 	=> "Assignment Mata Pelajaran Admin QC",
		'user'			=> $this->model_qc_user->fetch_admin_by_id($idadm),
		'datakelas'		=> $this->model_adm->fetch_all_kelas(),
		'assignmapel'	=> $this->model_qc_user->fetch_admin_x_mapel_by_admin($idadm)
	);
	$this->load->view("pg_admin/qc_user/assign", $data);
}

function ajax_mapel_by_kelas($idkelas){
	$data = array(
		'datamapel'		=> $this->model_adm->fetch_mapel_by_kelas($idkelas) 
	);
	$this->load->view("pg_admin/qc_user/ajax_mapel", $data);
}

function assign_mapel(){
	$params		= $this->input->post(null, true);
	$idadmin 	= $params['idadmin'];
	$idmapel 	= $params['idmapel'];

	//cek dulu, apakah mapel sudah ada di tabel
	$cek = $this->model_qc_user->cek_admin_x_mapel($idadmin, $idmapel);

	if($cek == 0){
		$assign = $this->model_qc_user->assign_mapel($idadmin, $idmapel);

		if($assign){
			echo "berhasil";
		}else{
			echo "gagal";
		}
	}else{
		echo "berhasil";
	}
}

function refresh_assigned($idadmin){
	$data = array(
		'assignmapel'	=> $this->model_qc_user->fetch_admin_x_mapel_by_admin($idadmin)
	);

	$this->load->view("pg_admin/qc_user/refresh_assigned", $data);
}

function hapus_assign(){
	$params		= $this->input->post(null, true);
	$idmapel 	= $params['idmapel'];
	$idadmin 	= $params['idadmin'];

	$hapus = $this->model_qc_user->hapus_assign_mapel($idadmin, $idmapel);	

	if($hapus){
		echo "berhasil";
	}else{
		echo "gagal";
	}
}

}
?>