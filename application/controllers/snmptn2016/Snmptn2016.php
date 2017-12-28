<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Snmptn2016 extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->library('form_validation');

		$this->load->helper('alert_helper');

		$this->load->model('model_pg');

		$this->load->model('model_paket');

		$this->load->model('model_voucher');

		$this->load->model('model_pembayaran');
		
		$this->load->model('model_dashboard');

	}
  public function index(){
  	$idsiswa = $this->session->userdata('id_siswa');
	
	if($idsiswa == ""){
		redirect('login');
	}
	$infosiswa = $this->model_dashboard->get_info_siswa($idsiswa);
	
	$carikelas = $this->model_dashboard->get_kelas($idsiswa);
	$kelas = $carikelas->kelas;
	
	$carimapel = $this->model_dashboard->get_mapel_by_kelas($kelas);
	
	$tanggalsekarang = date('Y-m-d');
	$kelasaktif = $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);
	
	$jumlahsoaltryout = $this->model_dashboard->get_jumlah_soaltryout_bykelas($kelas);
	
	$cariaktivasi = $this->model_dashboard->cari_aktivasi($idsiswa);
	
	
	if($cariaktivasi == 0){
		$statussiswa = 'tidak_aktif';
	}else{
		$statussiswa = 'aktif';
	}

	$data = array(
		'infosiswa'		=> $infosiswa,
		'datamapel'		=> $carimapel,
		'status_siswa'	=> $statussiswa,
		'kelasaktif'	=> $kelasaktif
	);
  	 $this->load->view('pg_user/SNMPTN/halaman_SNMPTN',$data);
    }
   public function pengantar(){
	  	$idsiswa = $this->session->userdata('id_siswa');
		
		if($idsiswa == ""){
			redirect('login');
		}
		$infosiswa = $this->model_dashboard->get_info_siswa($idsiswa);
		
		$carikelas = $this->model_dashboard->get_kelas($idsiswa);
		$kelas = $carikelas->kelas;
		
		$carimapel = $this->model_dashboard->get_mapel_by_kelas($kelas);
		
		$tanggalsekarang = date('Y-m-d');
		$kelasaktif = $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);
		
		$jumlahsoaltryout = $this->model_dashboard->get_jumlah_soaltryout_bykelas($kelas);
		
		$cariaktivasi = $this->model_dashboard->cari_aktivasi($idsiswa);
	
	
		if($cariaktivasi == 0){
			$statussiswa = 'tidak_aktif';
		}else{
			$statussiswa = 'aktif';
		}

		$data = array(
			'infosiswa'		=> $infosiswa,
			'status_siswa'	=> $statussiswa,
			'datamapel'		=> $carimapel,
			'kelasaktif'	=> $kelasaktif
	);
	 $this->load->view('pg_user/SNMPTN/pengantar',$data);
    }

     public function informasisnmptn(){
	  	$idsiswa = $this->session->userdata('id_siswa');
		
		if($idsiswa == ""){
			redirect('login');
		}
		$infosiswa = $this->model_dashboard->get_info_siswa($idsiswa);
		
		$carikelas = $this->model_dashboard->get_kelas($idsiswa);
		$kelas = $carikelas->kelas;
		
		$carimapel = $this->model_dashboard->get_mapel_by_kelas($kelas);
		
		$tanggalsekarang = date('Y-m-d');
		$kelasaktif = $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);
		
		$jumlahsoaltryout = $this->model_dashboard->get_jumlah_soaltryout_bykelas($kelas);
			$cariaktivasi = $this->model_dashboard->cari_aktivasi($idsiswa);
		if($cariaktivasi == 0){
			$statussiswa = 'tidak_aktif';
		}else{
			$statussiswa = 'aktif';
		}
		$data = array(
			'infosiswa'		=> $infosiswa,
			'datamapel'		=> $carimapel,
			'status_siswa'	=> $statussiswa,
			'kelasaktif'	=> $kelasaktif

	);
  	 $this->load->view('pg_user/SNMPTN/informasisnmptn',$data);
    }
     public function daftarptn(){
	  	$idsiswa = $this->session->userdata('id_siswa');
		
		if($idsiswa == ""){
			redirect('login');
		}
		$infosiswa = $this->model_dashboard->get_info_siswa($idsiswa);
		
		$carikelas = $this->model_dashboard->get_kelas($idsiswa);
		$kelas = $carikelas->kelas;
		
		$carimapel = $this->model_dashboard->get_mapel_by_kelas($kelas);
		
		$tanggalsekarang = date('Y-m-d');
		$kelasaktif = $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);
		
		$jumlahsoaltryout = $this->model_dashboard->get_jumlah_soaltryout_bykelas($kelas);
			$cariaktivasi = $this->model_dashboard->cari_aktivasi($idsiswa);
		if($cariaktivasi == 0){
			$statussiswa = 'tidak_aktif';
		}else{
			$statussiswa = 'aktif';
		}
		$data = array(
			'infosiswa'		=> $infosiswa,
			'datamapel'		=> $carimapel,
			'status_siswa'	=> $statussiswa,
			'kelasaktif'	=> $kelasaktif
	);
	 
  	 $this->load->view('pg_user/SNMPTN/daftarptn',$data);
    }
    /*
    public function malikusaleh(){
    	$idsiswa = $this->session->userdata('id_siswa');
		
		if($idsiswa == ""){
			redirect('login');
		}
		$infosiswa = $this->model_dashboard->get_info_siswa($idsiswa);
		
		$carikelas = $this->model_dashboard->get_kelas($idsiswa);
		$kelas = $carikelas->kelas;
		
		$carimapel = $this->model_dashboard->get_mapel_by_kelas($kelas);
		
		$tanggalsekarang = date('Y-m-d');
		$kelasaktif = $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);
		
		$jumlahsoaltryout = $this->model_dashboard->get_jumlah_soaltryout_bykelas($kelas);
		
		$data = array(
			'infosiswa'		=> $infosiswa,
			'datamapel'		=> $carimapel,
			'kelasaktif'	=> $kelasaktif
	);
	 $this->load->view('pg_user/header_dashboard',$data);
  	 $this->load->view('pg_user/premium/SNMPTN_2016/snmptn/malikusaleh');
    }
    
    public function malikusalag(){
    	$idsiswa = $this->session->userdata('id_siswa');
		
		if($idsiswa == ""){
			redirect('login');
		}
		$infosiswa = $this->model_dashboard->get_info_siswa($idsiswa);
		
		$carikelas = $this->model_dashboard->get_kelas($idsiswa);
		$kelas = $carikelas->kelas;
		
		$carimapel = $this->model_dashboard->get_mapel_by_kelas($kelas);
		
		$tanggalsekarang = date('Y-m-d');
		$kelasaktif = $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);
		
		$jumlahsoaltryout = $this->model_dashboard->get_jumlah_soaltryout_bykelas($kelas);
		
		$data = array(
			'infosiswa'		=> $infosiswa,
			'datamapel'		=> $carimapel,
			'kelasaktif'	=> $kelasaktif
	);
	 $this->load->view('pg_user/header_dashboard',$data);
  	 $this->load->view('pg_user/premium/SNMPTN_2016/snmptn/malikusalehprodiagrobisnis');
    }*/
}
