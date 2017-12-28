<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Komentar extends CI_Controller {

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
		$this->load->model('model_komentar_soal');
		$this->model_security->is_logged_in();
  }

function index(){
	$data	= array(
		'datakelas'		=> $this->model_adm->fetch_all_kelas(),
		'datakomentar'	=> $this->model_komentar_soal->fetch_komentar_limit(1),
	);
	$this->load->view("pg_admin/komentar", $data);
}

function view_soal($idkomentar){
	$datakomen = $this->model_komentar_soal->fetch_komentar_by_id($idkomentar);
	$data = array(
		'soal'	=> $this->model_adm->fetch_soal_by_id($datakomen->id_soal)
	);
	$this->load->view("pg_admin/komentar_ajax/ajax_view_soal", $data);
}

function check_komentar(){
	$params 	= $this->input->post(null, true);
	$idkomentar	= $params["idkomentar"];

	$this->model_komentar_soal->check_komentar($idkomentar);
	//fetch admin
	$admin = $this->model_komentar_soal->fetch_admin_by_id($this->session->userdata('id_admin'));

	$data = array(
		'idkomentar'	=> $idkomentar,
		'username'		=> $admin->username
	);

	echo json_encode($data);
}

function detail(){
	$data = array(
		'datakomentar'	=> $this->model_komentar_soal->fetch_jumlah_komentar()
	);
	
	$this->load->view("pg_admin/komentar_ajax/detail", $data);
}

function filter_mapel($idkelas){
	$datamapel = $this->model_adm->fetch_mapel_by_kelas($idkelas);
	echo "<option value=''>-- Filter Mapel --</option>";
	foreach($datamapel as $mapel){
		?>
		<option value="<?php echo $mapel->id_mapel;?>"><?php echo $mapel->nama_mapel;?></option>
		<?php
	}
}

function filter_komentar($idmapel, $flag){
	$data = array(
		'datakomentar'	=> $this->model_komentar_soal->fetch_komentar_by_mapel_and_status($idmapel, $flag)
	);
	$this->load->view("pg_admin/komentar_ajax/ajax_filter", $data);
}

}
?>