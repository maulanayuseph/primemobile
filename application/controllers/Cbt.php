<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Cbt extends CI_Controller {

public function __construct(){
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

}



public function index(){
	$idsiswa = $this->session->userdata('id_siswa');
	
	if($idsiswa == ""){
		redirect('login');
	}
	$infosiswa = $this->model_dashboard->get_info_siswa($idsiswa);
	$tanggalsekarang = date('Y-m-d');
	$data = array(
		'infosiswa'		=> $infosiswa,
		'kelasaktif'	=> $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang),
		'data_profil' 	=> $this->model_dashboard->fetch_all_cbtcontest()
		);

	$this->load->view('pg_user/cbt_index', $data);
}

function cbt_detail($idprofil){
	$idsiswa = $this->session->userdata('id_siswa');
	
	if($idsiswa == ""){
		redirect('login');
	}
	$infosiswa = $this->model_dashboard->get_info_siswa($idsiswa);
	$tanggalsekarang = date('Y-m-d');
	
	$caripendaftaran = $this->model_dashboard->cari_daftar_cbt_by_siswa_and_profil($idsiswa, $idprofil);
	
	$data = array(
		'infosiswa'		=> $infosiswa,
		'data_profil' 	=> $this->model_dashboard->get_cbt_by_profil($idprofil),
		'navbar_links' 		=> $this->model_pg->get_navbar_links()
		);

	$this->load->view('pg_user/cbt_detail', $data);
}

function proses_daftar($idprofil){
	$idsiswa = $this->session->userdata('id_siswa');
	
	$daftar = $this->model_dashboard->proses_daftar_cbt($idsiswa, $idprofil);
	
	redirect('cbt/daftar/'.$daftar);
}

function daftar($iddaftar){
	$idsiswa = $this->session->userdata('id_siswa');
	
	if($idsiswa == ""){
		redirect('login');
	}
	
	
	$data = array(
		'infosiswa'			=> $this->model_dashboard->get_info_siswa($idsiswa),
		'infopendaftaran'	=> $this->model_dashboard->get_info_pembayaran_cbt($iddaftar)
		);
	
	$this->load->view('pg_user/cbt_bayar', $data);
}

function proses_bukti(){
	$data = array(
		'page_title' 	=> "Tambah Paket", 
		'form_action' 	=> current_url()
	);
	$idsiswa = $this->session->userdata('id_siswa');
	$params 		= $this->input->post(null, true);
	$iddaftar 		= $params['iddaftar'];
	
	$tipe 		 	= $this->cek_tipe($_FILES['bukti']['type']);
	$img_path	 	= "assets/uploads/bukti_cbt/";
	$namafile		= md5($idsiswa).md5($iddaftar).md5(time()).$tipe;
	
	
	$config['upload_path']		= $img_path;
	$config['allowed_types']    = 'gif|jpg|png';
	$config['file_name'] 		= $namafile;
	
	$this->load->library('upload', $config);
	$this->upload->do_upload('bukti');
	
	$proses = $this->model_dashboard->proses_bukti_cbt($idsiswa, $iddaftar, $namafile);
	
	redirect('cbt/daftar/'.$iddaftar);
}

private function cek_tipe($tipe){

	if ($tipe == 'image/jpeg') 

		{ return ".jpg"; }

	

	else if($tipe == 'image/png') 

		{ return ".png"; }

	

	else 

		{ return false; }

}


function ajax_list_cbt($idprofil, $statusbayar){
		$caritryout = $this->model_dashboard->get_tryout_by_profil($idprofil);
		$idsiswa = $this->session->userdata('id_siswa');
		foreach($caritryout as $tryout){
			?>
			<div class="mapel-container">
				<div class="header"><?php echo $tryout->jumlah_soal;?> Soal</div>
				<div class="content">
					<div class="title">
					<h5><?php echo $tryout->alias_kelas;?></h5>
					<h3><?php echo $tryout->nama_kategori;?></h3>
					
					<?php
						$cariskor 		= $this->model_dashboard->cari_skor($tryout->id_kategori, $idsiswa);
						$cariskorsalah 	= $this->model_dashboard->cari_skor_salah($tryout->id_kategori, $idsiswa);
						$cariwaktu 		= $this->model_dashboard->cari_waktu($tryout->id_kategori, $idsiswa);
						
						$prosentase = round(($cariskor/$tryout->jumlah_soal) * 100, 2);
						
						if($cariskor > 0 and $cariwaktu > 0){
							
							echo "<h4>".$prosentase."% Tuntas</h4>
							<h6>".$cariskor."/".$tryout->jumlah_soal." Soal yang benar</h6>
							";
						}elseif($cariskor == 0 and $cariskorsalah > 0 and  $cariwaktu > 0){
							echo "
							<h4>0% progress</h4>
							<h6>0/".$tryout->jumlah_soal." Soal yang benar</h6>
							";
						}elseif($cariskor > 0 and $cariwaktu == 0){
							echo "
							<h4>0% progress</h4>
							<h6>0/".$tryout->jumlah_soal." Soal yang benar</h6>
							";
						}elseif($cariskor == 0 and $cariwaktu == 0){
							echo "
							<h4>0% progress</h4>
							<h6>0/".$tryout->jumlah_soal." Soal yang benar</h6>
							";
						}else{
							echo "
							<h4>0% progress</h4>
							<h6>0/".$tryout->jumlah_soal." Soal yang benar</h6>
							";
						}
					?>
					</div>
				 <?php
					if(($cariskor > 0 or $cariskorsalah > 0) and $cariwaktu > 0){
					?>
						<div class="progress" style="height: 10px;">
						<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $prosentase;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prosentase;?>%;">
						<span class="sr-only"><?php echo $prosentase;?>% Complete</span>
						</div>
					</div>
					<a href="../tryout/openclass/<?php echo $tryout->id_kategori; ?>" class="btn btn-primary" style="float: right; margin: 15px 0;">Open Class</a>
					<a href="../tryout/pembahasan/<?php echo $tryout->id_kategori;?>" class="btn btn-success" type="submit" style="float: right; margin: 15px 15px;">Pembahasan</a>
					<?php
					}elseif(($cariskor > 0 or $cariskorsalah > 0) and $cariwaktu == 0){
					?>
						<div class="progress" style="height: 10px;">
							<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
							<span class="sr-only">0% Complete</span>
							</div>
						</div>
						<a href="../tryout/mulai/<?php echo $tryout->id_kategori;?>" class="btn btn-default btn-mapel" type="submit">Lanjut Mengerjakan</a>
					<?php
					}else{
					?>
					<div class="progress" style="height: 10px;">
						<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
						<span class="sr-only">0% Complete</span>
						</div>
					</div>
					<?php
						if($statusbayar == 0 or $statusbayar == 1 or $statusbayar == 3 or $statusbayar == 4){
					?>
					<button class="btn btn-default btn-mapel" data-toggle="modal" data-target="#myModal">Mulai</button>
					<?php
						}else{
					?>
					<a href="../../tryout/mulai/<?php echo $tryout->id_kategori;?>" class="btn btn-default btn-mapel" type="submit">Mulai</a>
					<?php
						}
					?>
					
					<?php
					}	
					?>
					
					
				</div>
				</div>
			<?php
		}
	}

}

?>