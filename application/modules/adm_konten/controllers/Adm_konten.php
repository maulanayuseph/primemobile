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
		'datakelas'		=> $this->adm_konten_model->fetch_kurikulum_x_kelas_group(),
		'allkelas'		=> $this->adm_konten_model->fetch_all_kelas(),
		'allkurikulum'	=> $this->adm_konten_model->fetch_all_kurikulum(),
		'allmapel'		=> $this->adm_konten_model->fetch_all_kelas()
	);
	$this->load->view("template_admin/template_adm", $data);
}

function ajax_kur_kelas(){
	$params 	= $this->input->post(null, true);
	$idkelas 	= $params['idkelas'];

	$datakur 	= $this->adm_konten_model->fetch_kurikulum_x_kelas_by_kelas($idkelas);

	echo '<option value="">-- Pilih Kurikulum --</option>';

	foreach($datakur as $kur){
		?>
		<option value="<?php echo $kur->id_kurikulum;?>"><?php echo $kur->nama_kurikulum;?></option>
		<?php
	}
}

function ajax_kur_mapel(){
	$params 		= $this->input->post(null, true);
	$idkelas 		= $params['idkelas'];
	$idkurikulum	= $params['idkurikulum'];

	echo '<option value="">-- Pilih Mata Pelajaran --</option>';

	$datamapel	= $this->adm_konten_model->fetch_kur_mapel_by_kelas_and_kurikulum($idkelas, $idkurikulum);

	foreach($datamapel as $mapel){
		?>
		<option value="<?php echo $mapel->id_mapel;?>"><?php echo $mapel->nama_mapel;?></option>
		<?php
	}
}

function ajax_kur_bab(){
	$params 		= $this->input->post(null, true);
	$idmapel 		= $params['idmapel'];
	$idkelas 		= $params['idkelas'];
	$idkurikulum	= $params['idkurikulum'];

	echo '<option value="">-- Pilih Bab --</option>';

	$databab 		= $this->adm_konten_model->fetch_kur_bab_by_kelas_mapel_and_kurikulum($idkelas, $idkurikulum, $idmapel);

	foreach($databab as $bab){
		?>
		<option value="<?php echo $bab->id_bab;?>"><?php echo $bab->nama_bab;?></option>
		<?php
	}
}

function ajax_kur_sub(){
	$params 		= $this->input->post(null, true);
	$idmapel 		= $params['idmapel'];
	$idkelas 		= $params['idkelas'];
	$idkurikulum	= $params['idkurikulum'];
	$idbab 			= $params['idbab'];

	$kurbab 		= $this->adm_konten_model->fetch_row_kur_bab($idkelas, $idkurikulum, $idbab);
	$data = array(
		'datasubbab'	=> $this->adm_konten_model->fetch_kur_sub($idkelas, $idkurikulum, $idmapel, $idbab),
		'datajudul'		=> $this->adm_konten_model->fetch_judul_by_kur_bab($kurbab->id_kurikulum_x_bab),
		'judulunknown'	=> $this->adm_konten_model->fetch_judul_unknown($kurbab->id_kurikulum_x_bab)
	);
	$this->load->view('adm_konten/kur_mapel/kur_mapel_ajax_sub', $data);
}

function ajax_urut_sub(){
	$params		= $this->input->post(null, true);
	$json 		= $params['urut'];

	$x = 1;
	foreach($json as $js){
		$this->adm_konten_model->edit_urutan_sub_bab($js['id'], $x);
		//var_dump($js['id']);
		$x++;
	}
}

function proses_tambah_kur_kelas(){
	$params 		= $this->input->post(null, true);
	$idkelas 		= $params['kelas'];
	$idkurikulum 	= $params['kurikulum'];

	//test dulu, apakah kurikulum_x_kelas sudah ada
	$kurkelas 		= $this->adm_konten_model->fetch_kurikulum_x_kelas_by_kurikulum_and_kelas($idkurikulum, $idkelas);
	if($kurkelas == null){
		$insertkurkelas 	= $this->adm_konten_model->insert_kurikulum_x_kelas($idkurikulum, $idkelas);
		if($insertkurkelas){
			$this->session->set_flashdata('success', 'Kurikulum kelas berhasil ditambahkan');
			redirect("adm_konten/kur_mapel");
		}
	}else{
		$this->session->set_flashdata('error', 'Kurikulum kelas sudah terdaftar, input tidak diproses');
		redirect("adm_konten/kur_mapel");
	}
}

}
?>