<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Atribut extends CI_Controller {

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
		$this->model_security->is_logged_in();
  }

function index(){
	$data = array(
		"jumlahatribut"	=> $this->model_atribut->fetch_jumlah_atribut(),
		"parentatribut"	=> $this->model_atribut->fetch_parent()
	);
	$this->load->view("pg_admin/atribut", $data);
}

function simpan_atribut(){
	//echo "hahaha";
	$params 	= $this->input->post(null, true);
	$atribut 	= $params['atribut'];
	$parent 	= $params['parent'];
	
	if(isset($atribut) and isset($parent)){
		//cek dulu apakah ada kategori dengan nama yang sama
		$cek = $this->model_atribut->cek_atribut($atribut);
		
		if($cek == 0){
			$this->model_atribut->tambah_atribut($atribut, $parent);
		}
	}
}

function reload_atribut(){
	$data = array(
		"jumlahatribut"	=> $this->model_atribut->fetch_jumlah_atribut(),
		"parentatribut"	=> $this->model_atribut->fetch_parent()
	);
	$this->load->view("pg_admin/atribut_ajax_reload", $data);
}

function reload_parent(){
	$parentatribut = $this->model_atribut->fetch_parent();
		echo "<option value='0'>None</option>";
		foreach($parentatribut as $parent){
			?>
			<option value="<?php echo $parent->id_atribut;?>"><?php echo$parent->atribut;?></option>
			<?php
		}
}

function hapus_atribut(){
	$params 	= $this->input->post(null, true);
	$idatribut	= $params['idatribut'];
	$this->model_atribut->hapus_atribut($idatribut);
}

function edit($idatribut){
	$data = array(
		"parentatribut"	=> $this->model_atribut->fetch_parent(),
		"atribut"		=> $this->model_atribut->fetch_atribut_by_id($idatribut)
	);
	$this->load->view("pg_admin/atribut_edit", $data);
}

function proses_edit(){
	$params 	= $this->input->post(null, true);
	$idatribut	= $params['idatribut'];
	$atribut	= $params['atribut'];
	$parent		= $params['parent'];
	
	$this->model_atribut->edit_atribut($idatribut, $atribut, $parent);
	
	redirect("pg_admin/atribut");
}

function bulk(){
	$params 	= $this->input->post(null, true);
	$bulk		= $params['bulk'];
	//echo $bulk;
	if($bulk == "delete"){
		$dataatribut = $this->model_atribut->fetch_all_atribut();
		foreach($dataatribut as $atribut){
			$checkatr = $this->input->post("checkatr", true);
			if(isset($checkatr[$atribut->id_atribut])){
				//echo "<p>" . $atribut->id_atribut;
				$this->model_atribut->hapus_atribut($checkatr[$atribut->id_atribut]);
			}
		}
	}
	redirect("pg_admin/atribut");
}
}
?>