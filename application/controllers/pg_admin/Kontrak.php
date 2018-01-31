<?php

class Kontrak extends CI_Controller{
function __construct(){
	parent::__construct();
	$this->load->library('form_validation');
	$this->load->helper('alert_helper');
	$this->load->model('model_adm');
	$this->load->model('model_pembayaran');
	$this->load->model('model_paket');
	$this->load->model('model_tryout');
	$this->load->model('model_banksoal');
	$this->load->model('model_security');
	$this->load->model('model_rekap');
	$this->load->model('model_kurikulum');
	$this->load->model('model_keuangan');
	$this->load->model('model_kontrak');
	$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
	$this->load->library('PHPRequests');
	$this->model_security->is_logged_in();
}

function index(){
	$data = array(
		'navbar_title' 	=> "Kontrak PSEP",
		"datakontrak"	=> $this->model_kontrak->fetch_all_kontrak()
	);
	$this->load->view("pg_admin/kontrak/index", $data);
}

function buat(){
	$respon = Requests::get(api_dealer . "/all_dealer");
	$datadealer = json_decode($respon->body);
	//var_dump($datadealer);
	//return false;
	$data = array(
		'navbar_title' 	=> "Kontrak PSEP",
		'dataprovinsi'	=> $this->model_kontrak->fetch_provinsi(),
		'datadealer'	=> $datadealer->data,
		'datapa'		=> $this->model_kontrak->fetch_admin_pa(),
		'datareferral'	=> $this->model_kontrak->fetch_referral(),
		'formaction'	=> base_url("pg_admin/kontrak/proses_kontrak")
	);
	$this->load->view("pg_admin/kontrak/kontrak_form", $data);
}

function ajax_kota(){
	$params 	= $this->input->post(null, true);
	$idprovinsi	= $params['idprovinsi'];

	$datakota 	= $this->model_kontrak->fetch_kota_by_provinsi($idprovinsi);

	echo "<option value=''>-- Pilih Kota --</option>";
	foreach($datakota as $kota){
		?>
		<option value="<?php echo $kota->id_kota;?>"><?php echo $kota->nama_kota;?></option>
		<?php
	}
}

function ajax_sekolah(){
	$params 	= $this->input->post(null, true);
	$idkota 	= $params['idkota'];

	$datasekolah 	= $this->model_kontrak->fetch_sekolah_by_kota($idkota);

	echo "<option value=''>-- Pilih Sekolah --</option>";
	foreach($datasekolah as $sekolah){
		?>
		<option value='<?php echo $sekolah->id_sekolah;?>'>
			<?php echo $sekolah->nama_sekolah;?>
		</option>
		<?php
	}
}

function ajax_akun_sekolah(){
	$params 		= $this->input->post(null, true);
	$idsekolah 		= $params['idsekolah'];

	$dataakun		= $this->model_kontrak->fetch_akun_sekolah($idsekolah);

	echo "<option value=''>--- Pilih PIC Sekolah ---</option>";
	foreach($dataakun as $akun){
		?>
		<option value="<?php echo $akun->id_login_sekolah;?>"><?php echo $akun->nama;?></option>
		<?php
	}
}

function ajax_kelas_by_jenjang(){
	$params		= $this->input->post(null, true);
	$idsekolah 	= $params['idsekolah'];

	$sekolah 	= $this->model_kontrak->fetch_sekolah_by_id($idsekolah);

	$datakelas 	= $this->model_kontrak->fetch_kelas_by_jenjang($sekolah->jenjang);

	echo "<option value=''>--- Pilih Kelas ---</option>";
	foreach($datakelas as $kelas){
		?>
		<option value="<?php echo $kelas->id_kelas;?>"><?php echo $kelas->alias_kelas;?></option>
		<?php
	}
}

function ajax_tahun_ajaran_by_sekolah(){
	$params		= $this->input->post(null, true);
	$idsekolah 	= $params['idsekolah'];

	$datatahun = $this->model_kontrak->fetch_tahun_ajaran_by_sekolah($idsekolah);
	echo "<option value=''>--- Pilih Tahun Ajaran ---</option>";
	foreach($datatahun as $tahun){
		?>
		<option value='<?php echo $tahun->id_tahun_ajaran;?>'><?php echo $tahun->tahun_ajaran;?></option>
		<?php
	}
}

function ajax_tambah_kelas(){
	$params 		= $this->input->post(null, true);
	$idsekolah 		= $params['idsekolah'];
	$idkelas 		= $params['idkelas'];
	$idtahunajaran 	= $params['idtahunajaran'];

	$data = array(
		'kelas'				=> $this->model_kontrak->fetch_kelas_by_id($idkelas),
		'tahunajaran'		=> $this->model_kontrak->fetch_tahun_ajaran_by_id($idtahunajaran),
		'datakelasparalel'	=> $this->model_kontrak->fetch_kelas_paralel_by_kelas_and_sekolah($idsekolah, $idkelas)
	);
	$this->load->view("pg_admin/kontrak/ajax_tambah_detail_kontrak", $data);
}



function ajax_detail_kelas(){
	$params			= $this->input->post(null, true);
	$idsekolah 		= $params['idsekolah'];
	$idtahunajaran 	= $params['idtahunajaran'];

	$sekolah 	= $this->model_kontrak->fetch_sekolah_by_id($idsekolah);
	$data = array(
		'datatahunajaran'	=> $this->model_kontrak->fetch_tahun_ajaran_by_sekolah($idsekolah),
		'datakelas'			=> $this->model_kontrak->fetch_kelas_by_jenjang($sekolah->jenjang),
		'tahunajaran'		=> $this->model_kontrak->fetch_tahun_ajaran_by_id($idtahunajaran),
		'sekolah'			=> $sekolah
	);

	$this->load->view('pg_admin/kontrak/ajax_detail_kontrak', $data);
}

function ajax_detail_kelas_all(){
	$params			= $this->input->post(null, true);
	$idsekolah 		= $params['idsekolah'];
	$sekolah 	= $this->model_kontrak->fetch_sekolah_by_id($idsekolah);

	$data = array(
		'datakelas'			=> $this->model_kontrak->fetch_kelas_by_jenjang($sekolah->jenjang),
		'sekolah'			=> $sekolah,
		'datatahunajaran'	=> $this->model_kontrak->fetch_tahun_ajaran_by_sekolah($idsekolah)
	);
	$this->load->view("pg_admin/kontrak/ajax_detail_kontrak_all", $data);
}

function proses_kontrak(){
	$params			= $this->input->post(null, true);
	$idsekolah 		= $params['idsekolah'];	
	$date 			= $params['kontrakdate'];
	$enddate 		= $params['kontrakenddate'];
	$picsekolah 	= $params['picsekolah'];
	$picdealer 		= $params['picdealer'];
	$picpm 			= $params['picpm'];
	$picreferral 	= $params['picreferral'];
	$cbsekolah 		= $params['cbsekolah'];
	$cbdealer 		= $params['cbdealer'];
	$cbreferral 	= $params['cbreferral'];
	$tipeharga 		= $params['tipeharga'];
	$periodetagihan = $params['periodetagihan'];

	$sekolah 		= $this->model_kontrak->fetch_sekolah_by_id($idsekolah);

	$tahunkontrak 	= date_format(date_create($params['kontrakdate']), "Y");
	$bulankontrak 	= date_format(date_create($params['kontrakdate']), "m");
	$tanggalkontrak = date_format(date_create($params['kontrakdate']), "d");
	$detik 			= date("s");
	
	$nokontrak 		= "PSEP" . $tanggalkontrak . $bulankontrak . $tahunkontrak . $idsekolah . $detik;

	$datakontrak 	= array(
		'id_sekolah'		=> $idsekolah,
		'kontrak_no'		=> $nokontrak,
		'date'				=> $date,
		'end_date'			=> $enddate,
		'id_pic_sekolah'	=> $picsekolah,
		'pic_pm'			=> $picpm,
		'id_dealer'			=> $picdealer,
		'id_referral'		=> $picreferral,
		'cb_sekolah'		=> $cbsekolah,
		'cb_dealer'			=> $cbdealer,
		'cb_referral'		=> $cbreferral,
		'tipe_harga'		=> $tipeharga,
		'periode_tagihan'	=> $periodetagihan,
		'status'			=> 1
	);

	$insertkontrak 	= $this->model_kontrak->insert_kontrak($datakontrak);

	//fetch kelas dari sekolah
	$datakelas = $this->model_kontrak->fetch_kelas_by_jenjang($sekolah->jenjang);

	foreach($datakelas as $kelas){
		if($params['harga-' . $kelas->id_kelas]){
			$hargakelas 	= $params['harga-' . $kelas->id_kelas];
			$periode1 		= $params['periode-1-' . $kelas->id_kelas];
			$periode3 		= $params['periode-3-' . $kelas->id_kelas];
			$periode6 		= $params['periode-6-' . $kelas->id_kelas];
			$periode12 		= $params['periode-12-' . $kelas->id_kelas];

			$datadetail = array(
				'id_kontrak'	=> $insertkontrak,
				'id_kelas'		=> $kelas->id_kelas,
				'harga'			=> $params['harga-' . $kelas->id_kelas],
				'periode_1'		=> $periode1,
				'periode_3'		=> $periode3,
				'periode_6'		=> $periode6,
				'periode_12'	=> $periode12,
			);

			$this->model_kontrak->insert_kontrak_detail($datadetail);
		}
	}


	//mulai ganti status penagihan tabel siswa
	if($periodetagihan == 1){
		$idpaket = 15;
	}elseif($periodetagihan == 3){
		$idpaket = 16;
	}elseif($periodetagihan == 6){
		$idpaket = 17;
	}elseif($periodetagihan == 12){
		$idpaket = 18;
	}

	$datakelasparalel 	= $this->model_kontrak->fetch_kelas_paralel_by_sekolah($idsekolah);
	$tahunajaran 		= $this->model_kontrak->fetch_tahun_ajaran_by_sekolah($idsekolah);

	foreach($tahunajaran as $tahun){
		foreach($datakelasparalel as $kelaspar){
			$datasiswa = $this->model_kontrak->fetch_siswa_psep($tahun->id_tahun_ajaran, $kelaspar->id_kelas_paralel);
			foreach($datasiswa as $siswa){
				$this->model_kontrak->edit_tagihan_kontrak_kolektif_siswa($siswa->id_siswa, $idpaket);
			}
		}
	}
	redirect("pg_admin/kontrak");

}


function edit($idkontrak){
	$respon = Requests::get(api_dealer . "/all_dealer");
	$datadealer = json_decode($respon->body);
	$kontrak = $this->model_kontrak->fetch_kontrak_by_id($idkontrak);
	$idsekolah = $kontrak->id_sekolah;
	$data = array(
		'navbar_title' 		=> "Kontrak PSEP",
		'dataprovinsi'		=> $this->model_kontrak->fetch_provinsi(),
		'datadealer'		=> $datadealer->data,
		'datapa'			=> $this->model_kontrak->fetch_admin_pa(),
		'datareferral'		=> $this->model_kontrak->fetch_referral(),
		'kontrak'			=> $kontrak,
		'detailkontrak'		=> $this->model_kontrak->fetch_detail_kontrak_by_kontrak($idkontrak),
		'datapicsekolah'	=> $this->model_kontrak->fetch_akun_sekolah($idsekolah),
		'datakelas'			=> $this->model_kontrak->fetch_kelas_by_jenjang($kontrak->jenjang),
		'datatahunajaran'	=> $this->model_kontrak->fetch_tahun_ajaran_by_sekolah($kontrak->id_sekolah),
		'formaction'	=> base_url("pg_admin/kontrak/proses_edit")
	);
	$this->load->view("pg_admin/kontrak/kontrak_form", $data);
}


function proses_edit(){
	$params			= $this->input->post(null, true);
	$idkontrak 		= $params['idkontrak'];
	$date 			= $params['kontrakdate'];
	$enddate 		= $params['kontrakenddate'];
	$picsekolah 	= $params['picsekolah'];
	$picdealer 		= $params['picdealer'];
	$picpm 			= $params['picpm'];
	$picreferral 	= $params['picreferral'];
	$cbsekolah 		= $params['cbsekolah'];
	$cbdealer 		= $params['cbdealer'];
	$cbreferral 	= $params['cbreferral'];
	$tipeharga 		= $params['tipeharga'];
	$periodetagihan = $params['periodetagihan'];

	$kontrak 		= $this->model_kontrak->fetch_kontrak_by_id($idkontrak);
	$idsekolah 		= $kontrak->id_sekolah;

	$datakontrak 	= array(
		'date'				=> $date,
		'end_date'			=> $enddate,
		'id_pic_sekolah'	=> $picsekolah,
		'pic_pm'			=> $picpm,
		'id_dealer'			=> $picdealer,
		'id_referral'		=> $picreferral,
		'cb_sekolah'		=> $cbsekolah,
		'cb_dealer'			=> $cbdealer,
		'cb_referral'		=> $cbreferral,
		'tipe_harga'		=> $tipeharga,
		'periode_tagihan'	=> $periodetagihan,
		'status'			=> 1
	);
	$this->model_kontrak->edit_kontrak($idkontrak, $datakontrak);

	//hapus detail kontrak, ganti dengan yang baru
	$this->model_kontrak->delete_detail_kontrak_by_kontrak($idkontrak);

	$sekolah 		= $this->model_kontrak->fetch_sekolah_by_id($idsekolah);
	//fetch kelas dari sekolah
	$datakelas = $this->model_kontrak->fetch_kelas_by_jenjang($sekolah->jenjang);
	foreach($datakelas as $kelas){
		if($params['harga-' . $kelas->id_kelas]){
			$hargakelas 	= $params['harga-' . $kelas->id_kelas];
			$periode1 		= $params['periode-1-' . $kelas->id_kelas];
			$periode3 		= $params['periode-3-' . $kelas->id_kelas];
			$periode6 		= $params['periode-6-' . $kelas->id_kelas];
			$periode12 		= $params['periode-12-' . $kelas->id_kelas];

			$datadetail = array(
				'id_kontrak'	=> $idkontrak,
				'id_kelas'		=> $kelas->id_kelas,
				'harga'			=> $params['harga-' . $kelas->id_kelas],
				'periode_1'		=> $periode1,
				'periode_3'		=> $periode3,
				'periode_6'		=> $periode6,
				'periode_12'	=> $periode12,
			);

			$this->model_kontrak->insert_kontrak_detail($datadetail);
		}
	}

	redirect("pg_admin/kontrak");
}

function hapus($idkontrak){
	$this->model_kontrak->hapus_kontrak($idkontrak);
	redirect("pg_admin/kontrak");
}

}
?>