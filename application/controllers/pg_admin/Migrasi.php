<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrasi extends CI_Controller {

public function __construct(){
parent::__construct();
	
	//check user session

	//load library in construct. Construct method will be run everytime the controller is called 
	//This library will be auto-loaded in every method in this controller. 
	//So there will be no need to call the library again in each method. 
	$this->load->library('form_validation');
	$this->load->helper('alert_helper');
	$this->load->model('model_kurikulum');
	$this->load->model('model_adm');
	$this->load->model('model_banksoal');
	$this->load->model('model_security');
	$this->load->model('model_migrasi');
	$this->load->model('model_duplikat');
	$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
	$this->model_security->is_logged_in();
}

function pindah(){
	$data = array(
		"datakelas"	=> $this->model_banksoal->get_kelas()
	);
	$this->load->view("pg_admin/migrasi_pindah", $data);
}

function duplikat(){
	$data = array(
		"datakelas"	=> $this->model_banksoal->get_kelas()
	);
	$this->load->view("pg_admin/migrasi_duplikat", $data);
}

function ajax_sub_bab($idmapok){
	$daftarsub = $this->model_migrasi->fetch_sub_by_bab($idmapok);
	?>
	<option value="0">-- Pilih Latihan Soal --</option>
	<?php
	foreach($daftarsub as $sub){
		if($sub->kategori !== "3"){
			?>
			<option value="<?php echo $sub->id_sub_materi;?>" disabled><?php echo $sub->nama_sub_materi;?></option>
			<?php
		}else{
			?>
			<option value="<?php echo $sub->id_sub_materi;?>"><?php echo $sub->nama_sub_materi;?></option>
			<?php
		}
	}
}

function ajax_list_soal_pindah($idsub){
	$data = array(
		"datasoal"	=> $this->model_migrasi->fetch_soal_by_sub($idsub),
		"datakelas"	=> $this->model_banksoal->get_kelas(),
		"idsub"		=> $idsub
	);
	
	$this->load->view("pg_admin/migrasi_ajax_soal_pindah", $data);
}

function proses_pindah(){
	$params 	= $this->input->post(null, true);
	$subawal	= $params["sub-awal"];
	
	$datasoal	= $this->model_migrasi->fetch_soal_by_sub($subawal);
	
	foreach($datasoal as $soal){
		$subpindah = $params["sub-" . $soal->id_soal];
		if($subpindah !== "0"){
			//echo "<p>Pindah" . $subpindah;
			$this->model_migrasi->proses_pindah_soal($soal->id_soal, $subpindah);
		}
	}
	redirect("pg_admin/migrasi/pindah");
}

function ajax_list_soal_duplikat($idsub){
	$data = array(
		"datasoal"	=> $this->model_migrasi->fetch_soal_by_sub($idsub),
		"datakelas"	=> $this->model_banksoal->get_kelas(),
		"idsub"		=> $idsub
	);
	
	$this->load->view("pg_admin/migrasi_ajax_soal_duplikat", $data);
}

function proses_duplikat(){
	$params 	= $this->input->post(null, true);
	$subawal	= $params["sub-awal"];
	
	$datasoal	= $this->model_migrasi->fetch_soal_by_sub($subawal);
	
	foreach($datasoal as $soal){
		$subduplikat 	= $params["sub-" . $soal->id_soal];
		$bobot 			= $params["bobot-" . $soal->id_soal];
		if($subduplikat !== "0"){
			$fetchsoal	= $this->model_adm->fetch_soal_by_id($soal->id_soal);
			
			$this->model_adm->add_item_soal($fetchsoal->isi_soal, $fetchsoal->jawab_1, $fetchsoal->jawab_2, $fetchsoal->jawab_3, $fetchsoal->jawab_4, $fetchsoal->jawab_5, $fetchsoal->kunci_jawaban, $subduplikat, $fetchsoal->pembahasan, $fetchsoal->pembahasan_video, $bobot, $this->session->userdata('id_admin'));
		}
	}
	redirect("pg_admin/migrasi/duplikat");
}

function duplikat_bab(){
	$data = array(
		"datakelas"	=> $this->model_banksoal->get_kelas()
	);
	$this->load->view("pg_admin/migrasi_duplikat_bab", $data);
}

function proses_duplikat_bab(){
	$params 	= $this->input->post(null, true);
	$idbab		= $params["idbab"];
	$idmapel	= $params["idmapel"];
	$kurikulum	= $params["kurikulum"];
	
	//fetch bab
	$fetchbab = $this->model_adm->fetch_materi_pokok_by_id($idbab);
	
	$babbaru = $this->model_migrasi->add_materi_pokok($idmapel, $fetchbab->nama_materi_pokok, $fetchbab->judul_bab_k13, $fetchbab->judul_bab_ktsp, $fetchbab->deskripsi_materi_pokok, $fetchbab->urutan);
	
	//fetch setiap sub bab dari bab awal
	$subawal = $this->model_migrasi->fetch_sub_materi_by_bab($idbab);
	
	foreach($subawal as $sub){
		if($sub->kategori == 1){
			$tambahsub	= $this->model_adm->add_materi($sub->kategori, $idmapel, $babbaru, $sub->nama_sub_materi, $sub->deskripsi_sub_materi, $sub->isi_materi, $sub->video_materi, $sub->gambar_materi, $sub->tanggal, $sub->waktu, $sub->urutan_materi, $kurikulum);
		}elseif($sub->kategori == 2){
			$tambahsub	= $this->model_adm->add_materi($sub->kategori, $idmapel, $babbaru, $sub->nama_sub_materi, $sub->deskripsi_sub_materi, $sub->isi_materi, $sub->video_materi, $sub->gambar_materi, $sub->tanggal, $sub->waktu, $sub->urutan_materi, $kurikulum);
		}elseif($sub->kategori == 3){
			$tambahsub	= $this->model_adm->add_materi($sub->kategori, $idmapel, $babbaru, $sub->nama_sub_materi, $sub->deskripsi_sub_materi, $sub->isi_materi, $sub->video_materi, $sub->gambar_materi, $sub->tanggal, $sub->waktu, $sub->urutan_materi, $kurikulum);
			
			$datasoalawal = $this->model_duplikat->fetch_soal_awal($sub->id_sub_materi);
			
			foreach($datasoalawal as $soalawal){
				$insertsoal = $this->model_duplikat->insert_soal($tambahsub, $soalawal->isi_soal, $soalawal->status);
				
				$fetchjawaban = $this->model_duplikat->fetch_jawaban_by_id_soal($soalawal->id_soal);
				
				$insertjawaban = $this->model_duplikat->insert_jawaban($insertsoal, $fetchjawaban->jawab_1, $fetchjawaban->jawab_2, $fetchjawaban->jawab_3, $fetchjawaban->jawab_4, $fetchjawaban->jawab_5, $fetchjawaban->kunci_jawaban, $fetchjawaban->pembahasan, $fetchjawaban->pembahasan_video, $fetchjawaban->bobot);
			}
		}
	}
}

}
?>