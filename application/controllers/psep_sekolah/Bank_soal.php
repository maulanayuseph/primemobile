<?php
class Bank_soal extends CI_Controller{
function __construct(){
	parent::__construct();
	$this->load->library('form_validation');
	$this->load->helper('alert_helper');
	$this->load->model('model_adm');
	$this->load->model('model_security');
	$this->load->model('model_psep');
	$this->load->model('model_banksoal');
	$this->load->model('model_pr');
	$this->load->model('model_dashboard');
	$this->load->model('model_pg');
	$this->load->model('model_materi_urutan');
	$this->load->model('model_silabus');
	$this->load->model('model_psep_bank_soal');
	
	$this->model_security->psep_sekolah_is_logged_in();
}


function kategori(){
	$idsekolah 		= $this->session->userdata('idsekolah');
	$carisekolah 	= $this->model_psep->fetch_sekolah_by_id($idsekolah);
	$data = array(
		'sekolah'		=> $this->model_psep->fetch_sekolah_by_id($idsekolah),
		'datakategori'	=> $this->model_psep_bank_soal->fetch_kategori($idsekolah)
	);
	$this->load->view("psep_sekolah/bank_soal/kategori", $data);
}


function ajax_tambah_kategori(){
	$params 	= $this->input->post(null, true);
	$kategori 	= $params['kategori'];
	$idsekolah 	= $this->session->userdata('idsekolah');

	$tambahatribut 			= $this->model_psep_bank_soal->insert_atribut($kategori);
	$insertatributsekolah 	= $this->model_psep_bank_soal->insert_atribut_sekolah($idsekolah, $tambahatribut);

	if($insertatributsekolah){
		$respon = array(
			'status'	=> 'success'
		);
		$data = json_encode($respon);
		echo $data;
		return true;
	}else{
		$respon = array(
			'status'	=> 'failed'
		);
		$data = json_encode($respon);
		echo $data;
		return true;
	}
}

function ajax_refresh_kategori(){
	$idsekolah 		= $this->session->userdata('idsekolah');
	$data = array(
		'datakategori'	=> $this->model_psep_bank_soal->fetch_kategori($idsekolah)
	);
	$this->load->view("psep_sekolah/bank_soal/ajax_refresh_kategori", $data);
}

function ajax_edit_kategori(){
	$params 		= $this->input->post(null, true);
	$idkategori 	= $params['idkategori'];

	//cek apakah kategori yang akan di edit benar2 milik id login yang bersangkutan
	$kategori = $this->model_psep_bank_soal->fetch_kategori_by_id($idkategori);
	if($kategori->id_login == $this->session->userdata('idpsepsekolah')){
		$data = array(
			'kategori'	=> $kategori
		);
		$this->load->view("psep_sekolah/bank_soal/ajax_edit_kategori", $data);
	}else{
		echo "failed";
	}
}

function ajax_proses_edit_kategori(){
	$params 		= $this->input->post(null, true);
	$idatribut 		= $params['idatribut'];
	$atribut 		= $params['atribut'];
	//cek apakah kategori yang akan di edit benar2 milik id login yang bersangkutan
	$kategori = $this->model_psep_bank_soal->fetch_kategori_by_id($idatribut);
	if($kategori->id_login == $this->session->userdata('idpsepsekolah')){
		$edit = $this->model_psep_bank_soal->edit_atribut($idatribut, $atribut);
		if($edit){
			$respon = array(
				'status'	=> 'success'
			);
			$data = json_encode($respon);
			echo $data;
			return true;
		}else{
			$respon = array(
				'status'	=> 'failed'
			);
			$data = json_encode($respon);
			echo $data;
			return true;
		}
	}else{
		$respon = array(
			'status'	=> 'failed'
		);
		$data = json_encode($respon);
		echo $data;
		return true;
	}
}

function ajax_hapus_kategori(){
	$params 		= $this->input->post(null, true);
	$idatribut 		= $params['idatribut'];
	//cek apakah kategori yang akan di edit benar2 milik id login yang bersangkutan
	$kategori = $this->model_psep_bank_soal->fetch_kategori_by_id($idatribut);
	if($kategori->id_login == $this->session->userdata('idpsepsekolah')){
		$hapus = $this->model_psep_bank_soal->hapus_atribut($idatribut);
		$hapusatributsekolah = $this->model_psep_bank_soal->hapus_atribut_sekolah($idatribut);
		if($hapusatributsekolah){
			$respon = array(
				'status'	=> 'success'
			);
			$data = json_encode($respon);
			echo $data;
			return true;
		}else{
			$respon = array(
				'status'	=> 'failed'
			);
			$data = json_encode($respon);
			echo $data;
			return true;
		}
	}else{
		$respon = array(
			'status'	=> 'failed'
		);
		$data = json_encode($respon);
		echo $data;
		return true;
	}
	$respon = array(
		'status'	=> 'failed'
	);
	$data = json_encode($respon);
	echo $data;
	return true;
}

function index(){
	$idsekolah 		= $this->session->userdata('idsekolah');
	$carisekolah 	= $this->model_psep->fetch_sekolah_by_id($idsekolah);
	$data = array(
		'sekolah'		=> $this->model_psep->fetch_sekolah_by_id($idsekolah),
		'datakategori'	=> $this->model_psep_bank_soal->fetch_kategori($idsekolah),
		'datakelas'		=> $this->model_adm->fetch_kelas_by_jenjang($carisekolah->jenjang),
		'datamapel'		=> $this->model_psep_bank_soal->fetch_mapel()
	);
	$this->load->view("psep_sekolah/bank_soal/index", $data);	
}

function ajax_filter_soal(){
	$params		= $this->input->post(null, true);
	$idkelas 	= $params['idkelas'];
	$idmapel 	= $params['idmapel'];
	$idatribut 	= $params['idatribut'];
	$data = array(
		'datasoal'	=> $this->model_psep_bank_soal->filter_bank_soal($idkelas, $idmapel, $idatribut)
	);
	$this->load->view('psep_sekolah/bank_soal/ajax_filter_soal', $data);
}

function tambah_soal(){
	$idsekolah 		= $this->session->userdata('idsekolah');
	$carisekolah 	= $this->model_psep->fetch_sekolah_by_id($idsekolah);
	$data = array(
		'sekolah'		=> $this->model_psep->fetch_sekolah_by_id($idsekolah),
		'datakategori'	=> $this->model_psep_bank_soal->fetch_kategori($idsekolah),
		'datakelas'		=> $this->model_adm->fetch_kelas_by_jenjang($carisekolah->jenjang),
		'datamapel'		=> $this->model_psep_bank_soal->fetch_mapel(),
		'datatopik'		=> $this->model_psep_bank_soal->fetch_topik()
	);
	$this->load->view("psep_sekolah/bank_soal/tambah_soal", $data);
}

function proses_tambah_soal(){
	$params 	= $this->input->post(null, true);
	$idkelas 	= $params['kelas'];
	$idmapel 	= $params['mapel'];
	$idatribut 	= $params['kategori'];
	$topik 		= $_POST['topik'];
	$topikbaru 	= $_POST['topik-baru'];
	$soal 		= $_POST['soal'];
	$kunci 		= $params['jawabbenar'];
	$bobot 		= $params['bobot'];
	$jawab1 	= $_POST['jawab1'];
	$jawab2 	= $_POST['jawab2'];
	$jawab3 	= $_POST['jawab3'];
	$jawab4 	= $_POST['jawab4'];
	$jawab5 	= $_POST['jawab5'];
	$pembahasan = $_POST['bahasteks'];

	if($topikbaru !== ""){
		$topik = $topikbaru;
	}

	$tambahsoal 	= $this->model_psep_bank_soal->insert_soal($soal, $topik, $jawab1, $jawab2, $jawab3, $jawab4, $jawab5, $pembahasan, $bobot, $kunci);
	$soalatribut 	= $this->model_psep_bank_soal->insert_soal_atribut($tambahsoal, $idatribut);
	$soalkelas 		= $this->model_psep_bank_soal->insert_soal_kelas($tambahsoal, $idkelas);
	$soalmapel 		= $this->model_psep_bank_soal->insert_soal_mapel($tambahsoal, $idmapel);
	$soalsekolah 	= $this->model_psep_bank_soal->insert_soal_sekolah($tambahsoal);
	if($soalmapel and $soalkelas and $soalatribut and $soalsekolah){
		redirect("psep_sekolah/bank_soal");
	}
}

function edit_soal($idsoal){
	$soal = $this->model_psep_bank_soal->fetch_soal_by_id($idsoal);

	if($soal->id_login !== $this->session->userdata('idpsepsekolah')){
		redirect("psep_sekolah/bank_soal");
		return false;
	}
	$idsekolah 		= $this->session->userdata('idsekolah');
	$carisekolah 	= $this->model_psep->fetch_sekolah_by_id($idsekolah);
	$data = array(
		'sekolah'		=> $this->model_psep->fetch_sekolah_by_id($idsekolah),
		'datakategori'	=> $this->model_psep_bank_soal->fetch_kategori($idsekolah),
		'datakelas'		=> $this->model_adm->fetch_kelas_by_jenjang($carisekolah->jenjang),
		'datamapel'		=> $this->model_psep_bank_soal->fetch_mapel(),
		'datatopik'		=> $this->model_psep_bank_soal->fetch_topik(),
		'soal'			=> $soal
	);
	$this->load->view("psep_sekolah/bank_soal/edit_soal", $data);
}

function proses_edit_soal(){
	$params 	= $this->input->post(null, true);
	$idkelas 	= $params['kelas'];
	$idmapel 	= $params['mapel'];
	$idatribut 	= $params['kategori'];
	$topik 		= $_POST['topik'];
	$topikbaru 	= $_POST['topik-baru'];
	$soal 		= $_POST['soal'];
	$kunci 		= $params['jawabbenar'];
	$bobot 		= $params['bobot'];
	$jawab1 	= $_POST['jawab1'];
	$jawab2 	= $_POST['jawab2'];
	$jawab3 	= $_POST['jawab3'];
	$jawab4 	= $_POST['jawab4'];
	$jawab5 	= $_POST['jawab5'];
	$pembahasan = $_POST['bahasteks'];
	$idsoal 	= $_POST['idsoal'];

	if($topikbaru !== ""){
		$topik = $topikbaru;
	}
	$editsoal 		= $this->model_psep_bank_soal->edit_soal($soal, $topik, $jawab1, $jawab2, $jawab3, $jawab4, $jawab5, $pembahasan, $bobot, $kunci, $idsoal);
	$editatribut 	= $this->model_psep_bank_soal->edit_soal_atribut($idsoal, $idatribut);
	$editkelas 		= $this->model_psep_bank_soal->edit_soal_kelas($idsoal, $idkelas);
	$editmapel 		= $this->model_psep_bank_soal->edit_soal_mapel($idsoal, $idmapel);

	//cari pr yang memiliki id soal sama
	$carisoalpr = $this->model_psep_bank_soal->fetch_soal_pr_by_id($idsoal);
	//EDIT SOAL YANG ADA DI TABLE SOAL_PR JUGA
	foreach($carisoalpr as $soalpr){
		$this->model_psep_bank_soal->edit_soal_pr($soalpr->id_soal_pr, $soal, $jawab1, $jawab2, $jawab3, $jawab4, $jawab5, $pembahasan, $kunci);
	}

	if($editsoal and $editatribut and $editkelas and $editmapel){
		redirect('psep_sekolah/bank_soal');
	}

}

function hapus_soal(){
	$params = $this->input->post(null, true);
	$idsoal = $params['idsoal'];

	$soal = $this->model_psep_bank_soal->fetch_soal_by_id($idsoal);

	$hapus = $this->model_psep_bank_soal->delete_soal($idsoal);
	if($hapus){
		$respon = array(
			'idkelas'	=> $soal->id_kelas,
			'idmapel'	=> $soal->id_mapel,
			'idatribut'	=> $soal->id_atribut
		);
		$data = json_encode($respon);
		echo $data;
		return true;
	}

}

}
?>