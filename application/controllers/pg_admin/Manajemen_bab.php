<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manajemen_bab extends CI_Controller {

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
		$this->model_security->is_logged_in();
  }

function index(){
	$data = array(
		"datakelas"		=> $this->model_adm->fetch_all_kelas(),
		'datakurikulum'	=> $this->model_manajemen_kurikulum->fetch_all_kurikulum()
	);

	$this->load->view("pg_admin/Manajemen_bab/index", $data);
}


function filter_mapel($idkelas, $idkurikulum){
	$datamapel = $this->model_manajemen_mapel->fetch_mapel_by_filter($idkelas, $idkurikulum);

	echo '<option value="">-- Filter Mapel --</option>';

	foreach($datamapel as $mapel){
		?>
		<option value="<?php echo $mapel->id_mapel;?>"><?php echo $mapel->nama_mapel;?></option>
		<?php
	}

}

function filter_bab($idmapel){
	$data = array(
		'databab'	=> $this->model_manajemen_bab->filter_bab_by_mapel($idmapel)
	);
	$this->load->view("pg_admin/manajemen_bab/ajax_refresh", $data);
}


function tambah(){
	$data = array(
		"datakelas"		=> $this->model_adm->fetch_all_kelas(),
		'datakurikulum'	=> $this->model_manajemen_kurikulum->fetch_all_kurikulum()
	);

	$this->load->view("pg_admin/Manajemen_bab/ajax_tambah", $data);
}

function proses_tambah(){
	$params 		= $this->input->post(null, true);
	$idmapel 		= $params['idmapel'];
	$materipokok	= $params['bab'];

	$this->model_manajemen_bab->tambah_bab($idmapel, $materipokok);

	$data = array(
		'idmapel'	=> $idmapel
	);

	echo json_encode($data);
}

function edit($idbab){
	$bab 			= $this->model_manajemen_bab->fetch_bab_by_id($idbab);
	$idkelas 		= $bab->id_kelas;
	$idkurikulum 	= $bab->id_kurikulum;
	$data = array(
		'bab'			=> $this->model_manajemen_bab->fetch_bab_by_id($idbab),
		'datakelas'		=> $this->model_adm->fetch_all_kelas(),
		'datakurikulum'	=> $this->model_manajemen_kurikulum->fetch_all_kurikulum(),
		'datamapel'		=> $this->model_manajemen_mapel->fetch_mapel_by_filter($idkelas, $idkurikulum)
	);

	$this->load->view("pg_admin/manajemen_bab/ajax_edit", $data);
}

function proses_edit(){
	$params 	= $this->input->post(null, true);
	$idmapel 	= $params['idmapel'];
	$idbab		= $params['idbab'];
	$bab		= $params["bab"];

	$this->model_manajemen_bab->edit_bab($idbab, $idmapel, $bab);

	$data = array(
		'idmapel'	=> $idmapel
	);

	echo json_encode($data);
}

function proses_hapus(){
	$params = $this->input->post(null, true);
	$idbab	= $params['idbab'];

	$bab 	= $this->model_manajemen_bab->fetch_bab_by_id($idbab);

	$data = array(
		'idmapel'	=> $bab->id_mapel
	);

	$this->model_manajemen_bab->hapus_bab($idbab);

	echo json_encode($data);
}

function tambah_sub_bab($idbab){
	$data = array(
		'bab'	=> $this->model_manajemen_bab->fetch_bab_by_id($idbab)
	);

	$this->load->view("pg_admin/manajemen_bab/ajax_tambah_sub", $data);
}

function proses_tambah_sub_bab(){
	$params = $this->input->post(null, true);
	$idbab	= $params['idbab'];
	$subbab = $params['subbab'];

	$bab 	= $this->model_manajemen_bab->fetch_bab_by_id($idbab);
	$data = array(
		'idmapel'	=> $bab->id_mapel
	);
	$this->model_manajemen_bab->tambah_sub_bab($idbab, $subbab);
	echo json_encode($data);
}

function edit_sub_bab($idsub){
	$data = array(
		'subbab'	=> $this->model_manajemen_bab->fetch_sub_bab_by_id($idsub)
	);
	$this->load->view("pg_admin/manajemen_bab/ajax_edit_sub_bab", $data);
}

function proses_edit_sub_bab(){
	$params		= $this->input->post(null, true);
	$idsubbab 	= $params['idsub'];
	$subbab 	= $params['subbab'];

	$this->model_manajemen_bab->edit_sub_bab($idsubbab, $subbab);

	$datasub = $this->model_manajemen_bab->fetch_sub_bab_by_id($idsubbab);

	$data = array(
		'idmapel'	=> $datasub->id_mapel
	);
	echo json_encode($data);
}

function proses_hapus_sub_bab(){
	$params		= $this->input->post(null, true);
	$idsubbab	= $params['idsub'];

	$datasub = $this->model_manajemen_bab->fetch_sub_bab_by_id($idsubbab);

	$data = array(
		'idmapel'	=> $datasub->id_mapel
	);

	$this->model_manajemen_bab->hapus_sub_bab($idsubbab);

	echo json_encode($data);
}



}
?>