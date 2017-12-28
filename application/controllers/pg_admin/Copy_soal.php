<?php

class Copy_soal extends CI_Controller{
function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('alert_helper');
		$this->load->model('model_security');
		$this->load->model('model_duplikat');
		$this->load->model('model_banksoal');
		$this->load->model('model_adm');
		$this->model_security->is_logged_in();
	}

function index(){
	$this->load->view('pg_admin/copy');
}

function proses_copy(){
	$params = $this->input->post(null, true);
	
	$idawal 	= $params['idawal'];
	$idtujuan 	= $params['idtujuan'];
	
	$datasoalawal = $this->model_duplikat->fetch_soal_awal($idawal);
	
	foreach($datasoalawal as $soalawal){
		$insertsoal = $this->model_duplikat->insert_soal($idtujuan, $soalawal->isi_soal, $soalawal->status);
		
		$fetchjawaban = $this->model_duplikat->fetch_jawaban_by_id_soal($soalawal->id_soal);
		
		$insertjawaban = $this->model_duplikat->insert_jawaban($insertsoal, $fetchjawaban->jawab_1, $fetchjawaban->jawab_2, $fetchjawaban->jawab_3, $fetchjawaban->jawab_4, $fetchjawaban->jawab_5, $fetchjawaban->kunci_jawaban, $fetchjawaban->pembahasan, $fetchjawaban->pembahasan_video, $fetchjawaban->bobot);
	}
	
	redirect("pg_admin/copy_soal");
}

function dua(){
	$data = array(
		'datakelas'	=> $this->model_banksoal->get_kelas()
	);
	$this->load->view('pg_admin/copy2', $data);
}

function tiga(){
	$data = array(
		'datakelas'	=> $this->model_banksoal->get_kelas()
	);
	$this->load->view('pg_admin/copy3', $data);
}

function ajax_materi_pokok($idmapel){
	$materipokok = $this->model_adm->fetch_materi_pokok_by_mapel($idmapel);
	
	foreach($materipokok as $materi){
	?>
		<option value="<?php echo $materi->id_materi_pokok;?>"><?php echo $materi->nama_materi_pokok;?></option>
	<?php
	}
}

function proses_copy2(){
	$params = $this->input->post(null, true);
	
	$materipokok 	= $params['materipokok'];
	$namasoal 		= $params['latihansoal'];
	$idawal 		= $params['idawal'];
	
	
	$inputsubmateri = $this->model_duplikat->insert_submateri($materipokok, $namasoal);
	
	$tanggal 	= date('Y-m-d');
	$waktu 		= date('H-i-s');
	
	$inputkontenmateri = $this->model_duplikat->insert_konten_materi($inputsubmateri, $tanggal, $waktu);
	
	$datasoalawal = $this->model_duplikat->fetch_soal_awal($idawal);
	
	foreach($datasoalawal as $soalawal){
		$insertsoal = $this->model_duplikat->insert_soal($inputsubmateri, $soalawal->isi_soal, $soalawal->status);
		
		$fetchjawaban = $this->model_duplikat->fetch_jawaban_by_id_soal($soalawal->id_soal);
		
		$insertjawaban = $this->model_duplikat->insert_jawaban($insertsoal, $fetchjawaban->jawab_1, $fetchjawaban->jawab_2, $fetchjawaban->jawab_3, $fetchjawaban->jawab_4, $fetchjawaban->jawab_5, $fetchjawaban->kunci_jawaban, $fetchjawaban->pembahasan, $fetchjawaban->pembahasan_video, $fetchjawaban->bobot);
	}
	redirect("pg_admin/copy_soal/dua");
}
function proses_copy3(){
	$params = $this->input->post(null, true);
	
	$idawal 	= $params['idawal'];
	$idtujuan 	= $params['idtujuan'];
	
	$datasoalawal = $this->model_duplikat->fetch_soal_awal($idawal);
	
	//cari soal2 yang ada di id sub tujuan
	$carisoaltujuan = $this->model_adm->fetch_soal_by_sub_materi($idtujuan);
	foreach($carisoaltujuan as $soaltujuan){
		//hapus jawaban
		$this->model_duplikat->hapus_jawaban_by_soal($soaltujuan->id_soal);
		
		//hapus soal
		$this->model_duplikat->hapus_soal_by_id($soaltujuan->id_soal);
	}
	
	foreach($datasoalawal as $soalawal){
		$insertsoal = $this->model_duplikat->insert_soal($idtujuan, $soalawal->isi_soal, $soalawal->status);
		
		$fetchjawaban = $this->model_duplikat->fetch_jawaban_by_id_soal($soalawal->id_soal);
		
		$insertjawaban = $this->model_duplikat->insert_jawaban($insertsoal, $fetchjawaban->jawab_1, $fetchjawaban->jawab_2, $fetchjawaban->jawab_3, $fetchjawaban->jawab_4, $fetchjawaban->jawab_5, $fetchjawaban->kunci_jawaban, $fetchjawaban->pembahasan, $fetchjawaban->pembahasan_video, $fetchjawaban->bobot);
	}
	
	redirect("pg_admin/copy_soal/tiga");
}
}