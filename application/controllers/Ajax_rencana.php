<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Ajax_rencana extends CI_Controller {



	public function __construct()

  {

    parent::__construct();

		//load library in construct. Construct method will be run everytime the controller is called 

		//This library will be auto-loaded in every method in this controller. 

		//So there will be no need to call the library again in each method. 

		$this->load->library('form_validation');

		$this->load->helper('alert_helper');

		$this->load->model('model_pg');

		$this->load->model('model_paket');

		$this->load->model('model_voucher');

		$this->load->model('model_pembayaran');
		
		$this->load->model('model_dashboard');
		$this->load->model('model_signup');
		$this->load->model('model_poin');
		$this->load->model('model_bonus');
		$this->load->model('model_tryout');
		$this->load->model('model_psep');
		$this->load->model('model_pr');
		$this->load->model('model_login');
		$this->load->model('model_rencana_belajar');

  }

function simpan_mapok(){
	$idsiswa 	= $this->session->userdata('id_siswa');
	$params 	= $this->input->post(null, true);
	$kurikulum 	= $params["kurikulum"];
	$idmapok 	= $params["idmapok"];
	//insert id materi pokok terpilih beserta kurikulumnya
	//echo $kurikulum;
	//echo $idmapok;

	//cek dulu aktivasi siswanya apa
	$tanggalsekarang = date('Y-m-d');
	$cekaktivasi = $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);

	if($cekaktivasi->kode_paket == "PSEP"){
		echo "gagal psep";
	}else{
		$this->model_rencana_belajar->simpan_materi_pokok($idsiswa, $idmapok, $kurikulum);
		echo "sukses";
	}
}

function hapus_rencana(){
	$idsiswa 	= $this->session->userdata('id_siswa');
	$params 	= $this->input->post(null, true);
	$kurikulum 	= $params["kurikulum"];
	$idmapok 	= $params["idmapok"];
	
	$this->model_rencana_belajar->hapus_materi_pokok($idsiswa, $idmapok, $kurikulum);
}

function refresh_rencana(){
	$idsiswa 	= $this->session->userdata('id_siswa');
	$mapelsiswa	= $this->model_rencana_belajar->fetch_mapel_by_materi_tersimpan($idsiswa);
	
	$tanggalsekarang = date('Y-m-d');
	$carikelas = $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);
	$kelas = $carikelas->id_kelas;
	
	$data = array(
		"mapeltersimpan"	=> $this->model_rencana_belajar->fetch_mapel_by_materi_tersimpan_and_kelas_aktif($idsiswa, $kelas)

	);
	//$this->load->view("pg_user/ajax_mapel_siswa");
	//cek jumlah rencana apakah lebih dari 0
	//$cekrencana = $this->model_rencana_belajar->cek_rencana_siswa();
	///echo "hahhahaha";
	$this->load->view("pg_user/ajax_mapel_siswa", $data);
}

function fetch_mapok(){
	$params 			= $this->input->get(null, true);
	$idmapel 			= $params['idmapel'];
	$idsiswa 			= isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : 0;
	$tanggalsekarang 	= date('Y-m-d');
	
	$carikelas 			= $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);
	
	$materibelajar = $this->model_rencana_belajar->fetch_rencana_belajar_by_mapel($idmapel, $idsiswa);
	
	$pencapaian = 0;
	if($materibelajar !== null){
	    foreach($materibelajar as $materi){
    		$carisubmateri = $this->model_rencana_belajar->fetch_sub_by_materi_pokok_and_kurikulum($materi->id_materi_pokok, $materi->rencana_kurikulum);
    		
    		foreach($carisubmateri as $sub){
    			$cekpencapaian = $this->model_rencana_belajar->cek_pencapaian($this->session->userdata("id_siswa"), $sub->id_sub_materi);
    			if($cekpencapaian > 0){
    				$pencapaian += 1;
    			}
    		}
    	}
	}
	$data = array(
		'materibelajar'	=> $this->model_rencana_belajar->fetch_rencana_belajar_by_mapel($idmapel, $idsiswa),
		'infomapel'			=> $this->model_dashboard->get_info_mapel($idmapel),
		'jumlahkonten'		=> $this->model_rencana_belajar->get_jumlah_konten_belajar($idmapel, $idsiswa),
		//'pencapaian'		=> $this->model_rencana_belajar->get_pencapaian_siswa_by_mapel($idmapel, $idsiswa)
		'pencapaian'		=> $pencapaian
	);
	
	$this->load->view("pg_user/ajax_rencana/bab_tersimpan", $data);
	//echo $idmapel;
	//$mapoktersimpan
}



}