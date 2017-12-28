<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materi extends CI_Controller {

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
		$this->load->model('model_banksoal');
		$this->load->model('model_pr');
		$this->load->model('model_dashboard');
		$this->load->model('model_pg');
		$this->load->model('model_materi_urutan');
		$this->load->model('model_kurikulum');
		$this->load->model('model_rencana_belajar');
		$this->load->model('model_psep_materi');
		$this->model_security->psep_sekolah_is_logged_in();
	}

function index(){
	$idsekolah 	= $this->session->userdata('idsekolah');
	$sekolah 	= $this->model_psep->fetch_sekolah_by_id($idsekolah);
	$datakelas 	= $this->model_adm->fetch_kelas_by_jenjang($sekolah->jenjang);
	$data = array(
		'navbar_title' 		=> "Materi Pembelajaran",
		'sekolah'			=> $sekolah,
		'datakelas'		=> $datakelas
	);
	$this->load->view("psep_sekolah/materi/index", $data);
}

function ajax_mapel_by_kelas($idkelas){
	$datamapel = $this->model_psep_materi->fetch_mapel_by_kelas($idkelas);

	echo "<option value=''>-- Pilih Mata Pelajaran --</option>";
	foreach($datamapel as $mapel){
		?>
		<option value="<?php echo $mapel->id_mapel;?>"><?php echo $mapel->nama_mapel;?></option>
		<?php
	}
}

function ajax_bab($idmapel, $kurikulum){
	if($kurikulum == "K-13REV"){
		$kurikulum = "K-13 REVISI";
	}
	$carimapok = $this->model_materi_urutan->cari_mapok_by_mapel($idmapel);
	
	
	echo "<option value=''>-- Pilih Materi Pokok --</option>";
	foreach($carimapok as $mapok){
		if($kurikulum == "K-13"){
			$jumlahsubk13 = $this->model_kurikulum->jumlah_subk13_by_mapok($mapok->id_materi_pokok);
			$jumlahsubirisan = $this->model_kurikulum->jumlah_subkirisan_by_mapok($mapok->id_materi_pokok);
			if($jumlahsubk13 > 0 or $jumlahsubirisan > 0){
				?>
				<option value="<?php echo $mapok->id_materi_pokok;?>"><?php echo $mapok->judul_bab_k13;?></option>
				<?php
			}
		}elseif($kurikulum == "KTSP"){
			$jumlahsubktsp = $this->model_kurikulum->jumlah_ktsp_by_mapok($mapok->id_materi_pokok);
			$jumlahsubirisan = $this->model_kurikulum->jumlah_subkirisan_by_mapok($mapok->id_materi_pokok);
			if($jumlahsubktsp > 0 or $jumlahsubirisan > 0){
				?>
				<option value="<?php echo $mapok->id_materi_pokok;?>"><?php echo $mapok->judul_bab_ktsp;?></option>
				<?php
			}
		}elseif($kurikulum == "K-13 REVISI"){
			$jumlahsubk13rev = $this->model_kurikulum->jumlah_subk13rev_by_mapok($mapok->id_materi_pokok);
			if($jumlahsubk13rev > 0){
				?>
				<option value="<?php echo $mapok->id_materi_pokok;?>"><?php echo $mapok->judul_bab_k13;?></option>
				<?php
			}
		}
	}
}

function ajax_konten($idmapok, $kurikulum){
	if($kurikulum == "K-13REV"){
		$kurikulum = "K-13 REVISI";
	}
	//$carilatihansoal = $this->model_materi_urutan->cari_latihan_soal_by_mapok($idmapok);
	$carikonten = $this->model_rencana_belajar->fetch_sub_by_materi_pokok_and_kurikulum($idmapok, $kurikulum);

	echo "<option value=''>-- Pilih Konten --</option>";
	foreach($carikonten as $konten){
		?>
		<option value="<?php echo $konten->id_sub_materi;?>"><?php echo $konten->nama_sub_materi;?></option>
		<?php
	}
}

function ajax_view_konten($idsub){
	//fetch konten materi atau soal
	$konten = $this->model_psep_materi->fetch_konten_by_sub($idsub);

	if($konten->kategori == 1){
		$data = array(
			"konten"	=> $this->model_psep_materi->fetch_konten_by_sub($idsub)
		);
		$this->load->view("psep_sekolah/materi/ajax_view_konten", $data);
	}elseif($konten->kategori == 3){
		$data = array(
			"konten"	=> $this->model_psep_materi->fetch_konten_by_sub($idsub),
			'datasoal'	=> $this->model_psep_materi->fetch_soal_by_sub_materi($idsub)
		);
		$this->load->view("psep_sekolah/materi/ajax_view_konten_soal", $data);
	}
	
}

}
?>