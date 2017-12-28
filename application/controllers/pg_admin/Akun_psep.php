<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun_psep extends CI_Controller {

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
		$this->load->model('model_kesiswaan');
		$this->model_security->is_logged_in();
  }

function sekolah(){
	$data = array(
		'navbar_title' 	=> "Manajemen Akun PSEP",
		'data_table' 	=> $this->model_adm->fetch_all_akun_sekolah()
		);

	$this->load->view('pg_admin/psep_akun_sekolah', $data);
}

function tambah_sekolah(){
	$data = array(
		'navbar_title' 	=> "Manajemen Akun PSEP",
		'dataprovinsi'	=> $this->model_adm->fetch_options_provinsi(),
		'datasekolah' 	=> $this->model_adm->fetch_all_sekolah()
		);

	$this->load->view('pg_admin/psep_akun_sekolah_form', $data);
}

function ajax_kota($idprovinsi){
	$carikota = $this->model_adm->fetch_kota_by_provinsi($idprovinsi);
	
	echo "<option value=''>-- Pilih Kota / Kabupaten --</option>";
	foreach($carikota as $kota){
		?>
		<option value="<?php echo $kota->id_kota;?>"><?php echo $kota->nama_kota;?></option>
		<?php
	}
}

function ajax_sekolah($idkota){
	$carisekolah = $this->model_adm->fetch_sekolah_by_kota($idkota);
	
	echo "<option value=''>-- Pilih Sekolah --</option>";
	foreach($carisekolah as $sekolah){
		?>
		<option value="<?php echo $sekolah->id_sekolah;?>"><?php echo $sekolah->nama_sekolah;?></option>
		<?php
	}
}

function proses_tambah_akun_sekolah(){
	$params = $this->input->post(null, true);
	
	$idsekolah 	= $params['sekolah'];
	$username 	= $params['username'];
	$password 	= $params['password'];
	$repassword = $params['repassword'];
	
	if($password !== $repassword){
		alert_error("Gagal Register", "Password tidak sama");
		redirect("pg_admin/akun_psep/tambah_sekolah");
	}
	
	$cariuserpass = $this->model_adm->cari_user_psep_sekolah($username, $password);
	
	if($cariuserpass === FALSE){
		$prosestambah = $this->model_adm->tambah_akun_psep_sekolah($idsekolah, $username, md5($password));
		alert_success("Berhasil", "Akun PSEP Sekolah Berhasil Ditampabahkan");
		redirect('pg_admin/akun_psep/sekolah');
	}
	else{				
		alert_error("Error", "Username Sudah ada yang memakai, pakai username yang lain!");
		redirect('pg_admin/akun_psep/tambah_sekolah');
	}
}

function edit_sekolah($idsekolah){
	$data = array(
		'navbar_title' 	=> "Manajemen Akun PSEP",
		'sekolah' 		=> $this->model_adm->fetch_akun_sekolah_by_id($idsekolah),
		'dataprovinsi'	=> $this->model_adm->fetch_options_provinsi()
	);
	
	$this->load->view('pg_admin/psep_akun_sekolah_edit', $data);
}

function proses_edit_akun_sekolah(){
	$params = $this->input->post(null, true);
	
	$idlogin 	= $params['idlogin'];
	$idsekolah 	= $params['sekolah'];
	$username 	= $params['username'];
	
	$prosestambah = $this->model_adm->edit_akun_psep_sekolah($idlogin, $idsekolah, $username);
	alert_success("Berhasil", "Akun PSEP Sekolah Berhasil Dirubah");
	redirect('pg_admin/akun_psep/sekolah');
}

function edit_password_sekolah($idsekolah){
	$data = array(
		'navbar_title' 	=> "Manajemen Akun PSEP",
		'sekolah' 		=> $this->model_adm->fetch_akun_sekolah_by_id($idsekolah),
		'dataprovinsi'	=> $this->model_adm->fetch_options_provinsi()
	);
	
	$this->load->view('pg_admin/psep_akun_sekolah_editpassword', $data);
}

function proses_edit_password_sekolah(){
	$params = $this->input->post(null, true);
	
	$idlogin 	= $params['idlogin'];
	$password 	= $params['password'];
	$repassword = $params['repassword'];
	
	if($password !== $repassword){
		alert_error("Gagal Register", "Password tidak sama");
		redirect("pg_admin/akun_psep/edit_password_sekolah/".$idlogin);
	}
	$prosestambah = $this->model_adm->edit_password_psep_sekolah($idlogin, $password);
	alert_success("Berhasil", "Password Akun PSEP Sekolah Berhasil Dirubah");
	redirect('pg_admin/akun_psep/sekolah');
}

function hapus_sekolah($idsekolah){
	$this->model_adm->hapus_sekolah($idsekolah);
	redirect('pg_admin/akun_psep/sekolah');
}

//buat function untuk kirim email, jaga2 kalau pengen ngirim ke email sekolah setelah pembuatan akun
function send_Smtp2go($idbayar, $email)
{
	$config = Array(
		'protocol' 		=> 'smtp',
		'smtp_host' 	=> 'smtp.postmarkapp.com',
		'smtp_port' 	=> 587,
		'smtp_user' 	=> 'c51e35dc-358a-4c72-9390-d36ecf7f078c', // change it to yours
		'smtp_pass' 	=> 'c51e35dc-358a-4c72-9390-d36ecf7f078c', // change it to yours
		'mailtype' 		=> 'html',
		'charset' 		=> 'iso-8859-1',
		'wordwrap' 		=> TRUE
	);

	$message = '';
	$this->load->library('email', $config);
	$this->email->set_newline("\r\n");  
	$this->email->from('cs@primemobile.co.id', 'Prime Mobile Customer Service'); // change it to yours
	$this->email->to($email);// change it to yours
	$this->email->subject('Voucher Prime Mobile');
	$dataemail = array (
		'table_data' => $this->model_pembayaran->cari_voucher($idbayar)
	);

	$body = $this->load->view('pg_admin/email.php',$dataemail,TRUE);
	$this->email->message($body);
	if($this->email->send())
	{
	  redirect('pg_admin/akun_psep/sekolah');
	}
	else
	{
		show_error($this->email->print_debugger());
	}
}

function guru(){
	$idsekolah = $this->session->userdata('idsekolah');
	$data = array(
		'navbar_title' 	=> "Manajemen Guru",
		'active'		=> "guru",
		'dataguru'		=> $this->model_adm->fetch_all_guru()
	);
	
	$this->load->view("pg_admin/guru", $data);
}

function verifikasi_guru($idlogin){
	$this->model_adm->verifikasi_guru($idlogin);
	redirect('pg_admin/akun_psep/guru');
}


function kelas_paralel(){
	$data = array(
		'navbar_title' 		=> "Manajemen Kelas",
		'select_provinsi' 	=> $this->model_adm->fetch_options_provinsi(),
	);
	$this->load->view("pg_admin/manajemen_psep/kelas_paralel", $data);
}

function ajax_kelas_paralel($idsekolah){
	$datakelas = $this->model_kesiswaan->fetch_kelas_paralel_by_sekolah($idsekolah);

	$data = array(
		'idsekolah'		=> $idsekolah,
		'datakelas'		=> $datakelas
	);

	$this->load->view("pg_admin/manajemen_psep/ajax_kelas_paralel", $data);
}

function ajax_form($idsekolah){
	//cek jenjang sekolah
	$ceksekolah = $this->model_kesiswaan->fetch_sekolah_by_id($idsekolah);

	$data = array(
		'datakelas'		=> $this->model_kesiswaan->fetch_kelas_by_jenjang($ceksekolah->jenjang),
		'jenjang'		=> $ceksekolah->jenjang
	);
	$this->load->view("pg_admin/manajemen_psep/form_kelas_paralel", $data);
}

}
?>
