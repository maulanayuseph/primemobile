<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

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

function validasi(){
	$idsekolah = $this->session->userdata('idsekolah');
	$sekolah = $this->model_psep->fetch_sekolah_by_id($idsekolah);
	$data = array(
		'navbar_title' 	=> "Dashboard",
		'sekolah'		=> $sekolah,
		'dataprovinsi'	=> $this->model_adm->fetch_options_provinsi()
	);
	$this->load->view("psep_sekolah/profil/validasi", $data);
}

function ajax_kota($idprovinsi){
	$datakota = $this->model_adm->fetch_kota_by_provinsi($idprovinsi);
	echo "<option value=''>-- Pilih Kota --</option>";
	foreach($datakota as $kota){
		?>
		<option value="<?php echo $kota->id_kota;?>"><?php echo $kota->nama_kota;?></option>
		<?php
	}
}

function proses_validasi(){
	$params 	= $this->input->post(null, true);
	$nama		= $params['nama'];
	$email		= $params['email'];
	$hp			= $params['hp'];
	$kota		= $params['kota'];
	$alamat		= $params['alamat'];
	
	if ($_FILES['foto']['type'] == 'image/jpeg'){ 
		$tipe = ".jpg";
	}else if($_FILES['foto']['type'] == 'image/png'){
		$tipe = ".png";
	}else{
		redirect("psep_sekolah/profil/validasi");
	}

	//cek email apakah sudah ada yang memakai
	$cekemail = $this->model_psep->cek_email($email);
	if($cekemail !== 0){
		alert_error("Invalid Email", "Email yang anda masukkan sudah ada yang memakai, silahkan gunakan email lain");
		redirect("psep_sekolah/profil/validasi");
	}
	$cekhp = $this->model_psep->cek_hp($hp);
	if($cekhp !== 0){
		alert_error("Invalid Phone", "Nomor telepon yang anda masukkan sudah ada yang memakai, silahkan gunakan nomor lain");
		redirect("psep_sekolah/profil/validasi");
	}

	$filename = "guru-".$this->session->userdata('idpsepsekolah') . md5(time()) . $tipe;

	$config['upload_path']          = 'assets/uploads/foto_guru/';
	$config['allowed_types']        = 'gif|jpg|png';

	$config['max_size']             = 2048;

	$config['overwrite']            = TRUE;
	
	$config['file_name']			= $filename;
	$this->load->library('upload', $config);

	if($this->upload->do_upload('foto')){
		
		//redirect("psep_sekolah/dashboard");
		$cek = $this->model_psep->cek_tabel_guru($this->session->userdata('idpsepsekolah'));
		if($cek == 0){
			$insertguru = $this->model_psep->insert_guru($nama, $email, $hp, $kota, $alamat, $filename);
		}else{
			$insertguru = $this->model_psep->edit_guru($this->session->userdata('idpsepsekolah'), $nama, $email, $hp, $kota, $alamat, $filename);
		}
		if($insertguru){
			redirect('psep_sekolah/profil/set_foto');
		}else{
			alert_error("Gagal Menyimpan", "Kesalahan simpan, harap coba lagi");
			redirect("psep_sekolah/profil/validasi");
		}
	}else{
		alert_error("Gagal Upload", "Gambar yang anda upload melebihi limit, pastikan size gambar maksimal 2MB");
		redirect("psep_sekolah/profil/validasi");
	}
}

function set_foto(){
	$idsekolah = $this->session->userdata('idsekolah');
	$sekolah = $this->model_psep->fetch_sekolah_by_id($idsekolah);
	$data = array(
		'navbar_title' 	=> "Dashboard",
		'sekolah'		=> $sekolah,
		'guru'			=> $this->model_psep->fetch_guru_by_id_login($this->session->userdata('idpsepsekolah'))
	);
	$this->load->view("psep_sekolah/profil/crop_foto", $data);
}
function crop_foto_profil(){
	//$params 	= $this->input->post(null, true);
	$gambar = $_POST['kodegambar'];
	$editcropimage = $this->model_psep->edit_crop_image($this->session->userdata('idpsepsekolah'), $gambar);
	if($editcropimage){
		echo "success";
	}else{
		echo "failed";
	}
}

function edit_profil(){
	$idsekolah = $this->session->userdata('idsekolah');
	$sekolah = $this->model_psep->fetch_sekolah_by_id($idsekolah);

	$guru    = $this->model_psep->fetch_guru_by_id_login($this->session->userdata('idpsepsekolah'));

	$kota = $this->model_psep->fetch_kota_by_id($guru->id_kota);

	$kotabyprovinsi = $this->model_adm->fetch_kota_by_provinsi($kota->provinsi_id);
	$data = array(
		'navbar_title' 		=> "Dashboard",
		'sekolah'			=> $sekolah,
		'dataprovinsi'		=> $this->model_adm->fetch_options_provinsi(),
		'guru'				=> $guru,
		'kota'				=> $kota,
		'kotabyprovinsi'	=> $kotabyprovinsi
	);
	$this->load->view("psep_sekolah/profil/edit", $data);
}

function proses_edit(){
	$params 	= $this->input->post(null, true);
	$nama		= $params['nama'];
	$email		= $params['email'];
	$hp			= $params['hp'];
	$kota		= $params['kota'];
	$alamat		= $params['alamat'];
	

	$guru    = $this->model_psep->fetch_guru_by_id_login($this->session->userdata('idpsepsekolah'));
	if($guru->email !== $email){
		//cek email apakah sudah ada yang memakai
		$cekemail = $this->model_psep->cek_email($email);
		if($cekemail !== 0){
			alert_error("Invalid Email", "Email yang anda masukkan sudah ada yang memakai, silahkan gunakan email lain");
			redirect("psep_sekolah/profil/edit_profil");
		}
	}
	
	if($guru->hp !== $hp){
		$cekhp = $this->model_psep->cek_hp($hp);
		if($cekhp !== 0){
			alert_error("Invalid Phone", "Nomor telepon yang anda masukkan sudah ada yang memakai, silahkan gunakan nomor lain");
			redirect("psep_sekolah/profil/edit_profil");
		}
	}

	$editguru = $this->model_psep->edit_guru($this->session->userdata('idpsepsekolah'), $nama, $email, $hp, $kota, $alamat, $filename);
	if($editguru){
		redirect('psep_sekolah/dashboard');
	}else{
		alert_error("Gagal Menyimpan", "Kesalahan simpan, harap coba lagi");
		redirect("psep_sekolah/profil/validasi");
	}
}

function upload_foto(){
	if ($_FILES['foto']['type'] == 'image/jpeg'){ 
		$tipe = ".jpg";
	}else if($_FILES['foto']['type'] == 'image/png'){
		$tipe = ".png";
	}else{
		alert_error("Invalid File", "Tipe file yang anda upload tidak valid");
		redirect("psep_sekolah/profil/edit_profil");
	}

	$filename = "guru-".$this->session->userdata('idpsepsekolah') . md5(time()) . $tipe;

	$config['upload_path']          = 'assets/uploads/foto_guru/';
	$config['allowed_types']        = 'gif|jpg|png';

	$config['max_size']             = 2048;

	$config['overwrite']            = TRUE;
	
	$config['file_name']			= $filename;
	$this->load->library('upload', $config);

	if($this->upload->do_upload('foto')){
		$editfoto = $this->model_psep->edit_foto_guru($this->session->userdata('idpsepsekolah'), $filename);
		if($editfoto){
			redirect("psep_sekolah/profil/set_foto");
		}else{
			alert_error("Gagal Upload", "Terjadi kesalahan upload");
			redirect("psep_sekolah/profil/edit_profil");
		}
	}else{
		alert_error("Gagal Upload", "Gambar yang anda upload melebihi limit, pastikan size gambar maksimal 2MB");
		redirect("psep_sekolah/profil/edit_profil");
	}
}
}
?>