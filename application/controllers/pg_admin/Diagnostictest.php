<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diagnostictest extends CI_Controller {
public function __construct(){
	parent::__construct();
	//load library in construct. Construct method will be run everytime the controller is called 
	//This library will be auto-loaded in every method in this controller. 
	//So there will be no need to call the library again in each method. 
	$this->load->helper('alert_helper');
	$this->load->model('model_pg');
	$this->load->model('model_agcu');
	$this->load->model('model_eqtest');
	$this->load->model('model_lstest');
	$this->load->model('model_dashboard');
	$this->load->model('model_banksoal');
	$this->load->model('model_security');
	$this->model_security->is_logged_in();
}
function index(){
	$data = array(
		'kelas'			=> $this->model_agcu->cek_kelas(),
		'diagnostic'	=> $this->model_agcu->get_diagnostic(),
		'jumlah_soal'	=> $this->model_agcu->get_jumlahsoal()
	);
	
	$this->load->view('pg_admin/kategori_diagnostic', $data);
}


function tambah($idprofildiagnostic = null){
	if($idprofildiagnostic == null){
		redirect("pg_admin/diagnostictest/profil_diagnostic");
	}
	$dataprofil = $this->model_agcu->fetch_profil_diagnostic_by_id($idprofildiagnostic);
	if($dataprofil == null){
		redirect("pg_admin/diagnostictest/profil_diagnostic");
	}
	$data = array(
		'kelas'		=> $this->model_agcu->get_kelas(),
		'profil'	=> $dataprofil
	);
	$this->load->view('pg_admin/diagnostic_form', $data);
}

function pilihmapel(){
	$idkelas = $this->uri->segment(4);
	
	$mapel = $this->model_agcu->get_mapel_by_kelas($idkelas);
	
	echo "<option value=''>-- Pilih Mata Pelajaran --</option>";
	foreach($mapel as $datamapel){
		echo "
		<option value='".$datamapel->id_mapel."'>".$datamapel->nama_mapel."</option>
		";
	}
}

function pilihsoal(){
	$idmapel = $this->uri->segment(4);
	
	$soal = $this->model_agcu->get_soal_by_mapel($idmapel);
	
	$no = 1;
	foreach($soal as $datasoal){
		echo "
		<tr>
			<td>".$datasoal->alias_kelas." - ".$datasoal->nama_mapel."</td>
			<td>".$datasoal->pertanyaan."</td>
			<td>".$datasoal->topik."</td>
			<td>
				<input type='checkbox' value='".$datasoal->id_banksoal."' name='pilih[]' />
			</td>
		</tr>
		";
		$no++;
	}
}

function ajax_soal_by_kategori($idkategori){
	
	$soal = $this->model_banksoal->fetch_bank_soal_by_kategori($idkategori);
	
	$no = 1;
	foreach($soal as $datasoal){
		echo "
		<tr>
			<td>".$datasoal->alias_kelas." - ".$datasoal->nama_mapel."</td>
			<td>".$datasoal->pertanyaan."</td>
			<td>".$datasoal->topik."</td>
			<td>
				<input type='checkbox' value='".$datasoal->id_banksoal."' name='pilih[]' />
			</td>
		</tr>
		";
		$no++;
	}
}

function prosestambah(){
	$params = $this->input->post(null, true);
	
	if(isset($params['pilih'])){
		$hitung_soal	= count($params['pilih']);
		$idbanksoal 	= $params['pilih'];
	}
	
	$idprofildiagnostic 	= $params['idprofildiagnostic'];
	$idmapel 				= $params['mapel'];
	$nama 					= $params['nama'];
	$durasi 				= $params['durasi'];
	$ketuntasan 			= $params['ketuntasan'];
	
	$insertkategori = $this->model_agcu->tambah_kategori($idprofildiagnostic, $idmapel, $nama, $durasi, $ketuntasan);
	
	//$idkategori = $this->model_agcu->last_addedkategori();
	
	
	
	for($i=0; $i <= $hitung_soal - 1; $i++){
		$result = $this->model_agcu->add_soal($insertkategori, $idbanksoal[$i]);
	}
	redirect('pg_admin/diagnostictest/profil_diagnostic');
}

function edit(){
	$iddiagnostic 	= $this->uri->segment(4);
	$getdiagnostic 	= $this->model_agcu->get_diagnosticbyid($iddiagnostic );
	$getidsoal 		= $this->model_agcu->get_idsoal($iddiagnostic );
	$getsoal 		= $this->model_agcu->get_soal();
	
	$data = array(
	'iddiagnostic'	=> $iddiagnostic,
	'getdiagnostic'	=> $getdiagnostic,
	'getidsoal'		=> $getidsoal,
	'getsoal'		=> $getsoal,
	'kelas'	=> $this->model_agcu->get_kelas()
	);	
	
	$this->load->view('pg_admin/diagnostic_edit', $data);
}
function prosesedit(){
	$params = $this->input->post(null, true);
	
	
	$idmapel 	= $params['mapel'];
	$iddiagnostic 	= $params['id'];
	$nama 		= $params['nama'];
	$durasi 	= $params['durasi'];
	$ketuntasan = $params['ketuntasan'];
	
	$editkategori = $this->model_agcu->edit_kategori($iddiagnostic, $idmapel, $nama, $durasi, $ketuntasan);
	
	redirect('pg_admin/diagnostictest/profil_diagnostic');
}
function hapus($iddiagnostic){
	$hapuskategori = $this->model_agcu->hapuskategori($iddiagnostic);
	$hapussoal = $this->model_agcu->hapus_soal_kategori($iddiagnostic);
	$hapushasil = $this->model_agcu->hapus_hasil_by_diagnostic($iddiagnostic);
	redirect('pg_admin/diagnostictest');
}

function daftar_soal($iddiagnostic){
	$data = array(
		'datasoal'	=> $this->model_agcu->fetch_soal_by_diagnostic($iddiagnostic)
	);
	$this->load->view('pg_admin/diagnostic_view', $data);
}


function profil_diagnostic(){
	$data = array(
		'dataprofil'	=> $this->model_agcu->fetch_profil_diagnostic()
	);
	$this->load->view("pg_admin/agcu_profil", $data);
}

function tambah_profil(){
	$data = array(
		'kelas'	=> $this->model_agcu->get_kelas()
	);
	$this->load->view("pg_admin/agcu_profil_form", $data);
}

function proses_tambah_profil(){
	$params 			= $this->input->post(null, true);
	$data = array(
		'nama_profil_diagnostic' 	=> $params['nama'],
		'kurikulum' 				=> $params['kurikulum'],
		'id_kelas' 					=> $params['kelas'],
		'start_date' 				=> $params['start_date'],
		'end_date' 					=> $params['end_date']
	);
	$this->model_agcu->insert_profil($data);
	redirect("pg_admin/diagnostictest/profil_diagnostic");
}

function edit_soal($idprofildiagnostic = null, $idkategori = null){
	if($idprofildiagnostic == null){
		redirect("pg_admin/diagnostictest/profil_diagnostic");
	}
	$dataprofil = $this->model_agcu->fetch_profil_diagnostic_by_id($idprofildiagnostic);
	if($dataprofil == null){
		redirect("pg_admin/diagnostictest/profil_diagnostic");
	}
	$data = array(
		'kelas'		=> $this->model_agcu->get_kelas(),
		'profil'	=> $dataprofil,
		'kategori'	=> $this->model_agcu->get_diagnosticbyid($idkategori)
	);
	$this->load->view('pg_admin/agcu_soal', $data);
}


function ajax_soal_by_kategoribaru($idkategori){
	
	$data = array(
		"datasoal"	=> $this->model_banksoal->fetch_bank_soal_by_kategori($idkategori)
	);

	$this->load->view("pg_admin/agcu_ajax_soal_by_kategori", $data);
}

function tambah_soal(){
	$params			= $this->input->post(null, true);
	$idbanksoal 	= $params['idbanksoal'];
	$iddiagnostic 	= $params['iddiagnostic'];

	$this->model_agcu->tambah_soal($iddiagnostic, $idbanksoal);
}

function refresh_soal($iddiagnostic){
	$data = array(
		'datasoal' 	=> $this->model_agcu->fetch_soal_by_diagnostic2($iddiagnostic)
	);

	$this->load->view("pg_admin/agcu_ajax_soal_diagnostic", $data);
}

function hapus_soal(){
	$params 		= $this->input->post(null, true);
	$idsoal 		= $params['idsoal'];
	$iddiagnostic 	= $params['iddiagnostic'];

	$this->model_agcu->hapus_soal($iddiagnostic, $idsoal);
}

}

?>