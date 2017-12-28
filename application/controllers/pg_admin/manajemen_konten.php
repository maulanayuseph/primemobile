<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manajemen_konten extends CI_Controller {

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
		$this->load->model('model_kurikulum');
		$this->load->model('model_atribut');
		$this->load->model('model_security');
		$this->load->model('model_manajemen_kurikulum');
		$this->load->model('model_manajemen_mapel');
		$this->load->model('model_manajemen_bab');
		$this->load->model('model_manajemen_konten');
		$this->model_security->is_logged_in();
  }

function index(){
	$data = array(
		'datakelas'		=> $this->model_adm->fetch_all_kelas(),
		'datakurikulum'	=> $this->model_manajemen_kurikulum->fetch_all_kurikulum()
	);
	$this->load->view("pg_admin/manajemen_konten/index", $data);
}

function ajax_bab($idmapel){
	$databab = $this->model_manajemen_bab->filter_bab_by_mapel($idmapel);

	echo "<option value=''>-- Filter Bab --</option>";
	foreach($databab as $bab){
		?>
		<option value="<?php echo $bab->id_materi_pokok;?>"><?php echo $bab->nama_materi_pokok;?></option>
		<?php
	}
}

function ajax_sub_bab($idbab){
	$datasub = $this->model_manajemen_bab->fetch_sub_bab_by_bab($idbab);

	echo "<option value=''>-- Filter Sub Bab --</option>";
	foreach($datasub as $sub){
		?>
		<option value="<?php echo $sub->id_sub_bab;?>"><?php echo $sub->nama_sub_bab;?></option>
		<?php
	}
}

function filter_konten($idsubbab){
	$data = array(
		'datakonten'	=> $this->model_manajemen_konten->fetch_konten_by_sub_bab($idsubbab)
	);

	$this->load->view("pg_admin/manajemen_konten/ajax_refresh", $data);
}

function tambah_latihan_mapel(){
	$data = array(
		'datakelas'		=> $this->model_adm->fetch_all_kelas(),
		'datakurikulum'	=> $this->model_manajemen_kurikulum->fetch_all_kurikulum()
	);
	$this->load->view("pg_admin/manajemen_konten/tambah_latihan_mapel", $data);
}



function tambah_materi_mapel(){
	$data = array(
		'datakelas'		=> $this->model_adm->fetch_all_kelas(),
		'datakurikulum'	=> $this->model_manajemen_kurikulum->fetch_all_kurikulum()
	);
	$this->load->view("pg_admin/manajemen_konten/tambah_materi_mapel", $data);
}




}
?>