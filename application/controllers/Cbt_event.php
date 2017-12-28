<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cbt_event extends CI_Controller {

	public function __construct()
  {
    parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('alert_helper');
		$this->load->model('model_cbt_event');
		$this->load->model('model_dashboard');
		$this->load->model('model_pg');
		$this->load->model('model_event');
		$this->load->model('model_pembayaran');
  }


function index($idevent){
	//cek keaslian id event
	$this->cek_event($idevent);

	//cek apakah siswa benar2 kelas ujung
	$this->cek_siswa($this->session->userdata("id_siswa"));
	//cek apakah user memiliki aktivasi event dan apakah aktivasinya sesuai dengan aktivasi event 
	$this->cek_aktivasi_event($idevent);
	$this->session->set_userdata("idevent", $idevent);
	$idsiswa 			= $this->session->userdata("id_siswa");
	$tanggalsekarang 	= date('Y-m-d');
	$infosiswa 			= $this->model_dashboard->get_info_siswa($idsiswa);
	$kelasaktif 		= $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);

	//ceksiswa
	$ceksiswa 	= $this->model_cbt_event->cek_jadwal_sekolah($infosiswa->id_sekolah);

	if($ceksiswa > 0){
		$datacbt 	= $this->model_cbt_event->fetch_cbt_berlangsung($infosiswa->id_sekolah);
	}else{
		$today = date("Y-m-d H:i:s");
		$start1 = date("Y-m-d H:i:s", strtotime("2017-11-25 14:00:00"));
		$end1 = date("Y-m-d H:i:s", strtotime("2017-11-25 16:00:00"));
		$start2 = date("Y-m-d H:i:s", strtotime("2017-11-26 14:00:00"));
		$end2 = date("Y-m-d H:i:s", strtotime("2017-11-26 16:00:00"));

		if(($start1 <= $today and $end1 >= $today) or ($start2 <= $today and $end2 >= $today)){
			$datacbt	= $this->model_cbt_event->fetch_cbt_by_event($idevent);
		}else{
			$datacbt = null;
		}
		
	}

	//cek aktivasi event berlangsung untuk prevent gelombang 1
	$aktivasieventaktif = $this->model_cbt_event->fetch_aktivasi_event_aktif($idevent, $idsiswa);
	if($aktivasieventaktif == 0){
		$datacbt = null;
		$gelombang = 1;
	}else{
		$gelombang = 2;
	}

	$data = array(
		'infosiswa'				=> $infosiswa,
		'kelasaktif'			=> $kelasaktif,
		'event'					=> $this->model_cbt_event->fetch_event_by_id($idevent),
		'datacbt'				=> $datacbt,
		'gelombang'				=> $gelombang
	);
	$this->load->view("pg_user/cbt_event/index", $data);
}

function cek_siswa($idsiswa){
	$tanggalsekarang 	= date('Y-m-d');
	$kelasaktif 		= $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);
	if($kelasaktif->id_kelas == 6 or $kelasaktif->id_kelas == 9 or $kelasaktif->id_kelas == 19 or $kelasaktif->id_kelas == 20){
		return true;
	}else{
		?>
		<script>
			alert("Maaf, saat ini belum ada event berlangsung untuk kelas kamu");
			window.location.replace("<?php echo base_url("user/dashboard");?>");
		</script>
		<?php
	}
}

function cek_event($idevent){
	$cek = $this->model_cbt_event->cek_event($idevent);

	if($cek !== null){
		return true;
	}else{
		redirect("user/dashboard");
	}
}

function cek_aktivasi_event($idevent){
	$cekaktivasi = $this->model_cbt_event->cek_aktivasi_event_siswa($this->session->userdata("id_siswa"), $idevent);

	$cekpembelian = $this->model_cbt_event->cek_pembelian_aktivasi_event_not_cancel($this->session->userdata("id_siswa"), $idevent);

	if($this->session->userdata("id_siswa") == 6174 or $this->session->userdata("id_siswa") == 6179 or $this->session->userdata("id_siswa") == 6180){
		return true;
	}
	if($cekaktivasi == 0 and $cekpembelian == null){
		//periksa dulu apakah sudah ada pembelian yang sudah di verifikasi prime mobile
		$verifikasi = $this->model_cbt_event->cek_verifikasi($this->session->userdata("id_siswa"), $idevent);
		if($verifikasi == null){
			redirect("cbt_event/aktivasi/" . $idevent . "/buy");
		}else{
			redirect("cbt_event/aktivasi/" . $idevent . "/" . $verifikasi->status);
		}
		
	}elseif($cekaktivasi == 0 and $cekpembelian !== null){
		redirect("cbt_event/aktivasi/" . $idevent . "/" . $cekpembelian->status);
	}else{
		return true;
	}
}

function aktivasi($idevent, $act){
	//cek keaslian id event
	$this->cek_event($idevent);

	if($act == "buy"){
		//user belum beli aktivasi event
		//echo "beli dulu";
		redirect("cbt_event/buy_activation/" . $idevent);
	}elseif($act == 0){
		//user sudah beli tapi belum upload bukti transfer
		//echo "bayar dulu";
		redirect("cbt_event/buy_confirm/" . $idevent);
	}elseif($act == 1){
		//user sudah beli, sudah upload bukti transfer tapi belum di kofirm
		//echo "tunggu konfirmasi ya";
		redirect("cbt_event/waiting/" . $idevent);
	}elseif($act == 2){
		//komfirmasi selesai, suruh user melakukan input kode informasi
		//echo "masukin kodenya";
		redirect("cbt_event/activation/" . $idevent);
	}elseif($act == 3){

		redirect("cbt_event/buy_activation/" . $idevent);
	}else{
		redirect("user/dashboard");
	}
}

function buy_activation($idevent){
	$this->cek_event($idevent);
	$idsiswa 			= $this->session->userdata("id_siswa");
	$tanggalsekarang 	= date('Y-m-d');
	$infosiswa 			= $this->model_dashboard->get_info_siswa($idsiswa);
	$kelasaktif 		= $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);
	$data = array(
		'event'		=> $this->model_cbt_event->fetch_event_by_id($idevent),
		'infosiswa'				=> $infosiswa,
		'kelasaktif'			=> $kelasaktif
	);
	$this->load->view("pg_user/cbt_event/beli_aktivasi", $data);
}

function proses_beli($idevent){
	$idpaket 			= 26;
	$idsiswa 			= $this->session->userdata("id_siswa");
	$now 				= new DateTime(null);
 
	//PERSIAPAN 1
	$new_pembayaran = array(
		"no_tagihan"				=> '', //no_tagihan set in model_event 
		"siswa_id"					=> $idsiswa, // Umum tanpa register 
		"kelas_id"					=> '0', //temporary, ganti dengan id_kelas siswa yg sedang login(ambil dari session)
		"metode_pembayaran"			=> '1', // 1=transfer, 2=indomaret 
		"status"					=> '0', 
		"timestamp"					=> $now->format("Y-m-d H:i:00"),
		'id_event'					=> $idevent
		);

	//PERSIAPAN 2
	//Set interval 1 hari untuk batas waktu pembayaran
	$now->add(new DateInterval('P1D'));
	$new_pembayaran['expired_on'] = $now->format("Y-m-d H:i:00");

	//PERSIAPAN 3
	

	//cari harga paket
	$this->db->select("*");
	$this->db->from("paket");
	$this->db->where("id_paket", $idpaket);
	$result 	= $this->db->get();
	$datapaket	= $result->row();

	if($datapaket->kode_paket == "EVENT"){
		$this->db->select("*");
		$this->db->from("event");
		$this->db->where("id_event", $idevent);
		$resultevent	= $this->db->get();
		$dataevent		= $resultevent->row();
		$hargasatuan 	= $dataevent->harga;
	}else{
		$hargasatuan 	= $datapaket->harga;
	}
	$detail_pembelian = array(
		'id_paket'		=> $idpaket,
		'harga_satuan'	=> $hargasatuan,
		'jumlah'		=> '1',
	);
	/* Data Pemebelian */
	$result = $this->model_event->simpan($new_pembayaran, $detail_pembelian);
	$this->send_invoice_event($result);

	redirect("user/bayar/" . $result);
}


function send_invoice_event($id_pembelian)
	{
		$siswa_id 			= $this->model_pembayaran->cek_siswa_by_pembelian($id_pembelian); 
		$infosiswa 			= $this->model_dashboard->get_info_siswa($siswa_id);

		$data = array(
			'buy'			   => $this->model_pembayaran->get_pembelian($id_pembelian),
			'detail_pembelian' => $this->model_pembayaran->get_detail_pembelian($id_pembelian)
		);

		$config = Array(
			'protocol' 		=> 'smtp',
			'smtp_host' 	=> 'smtp.postmarkapp.com',
			'smtp_port' 	=> 587,
			'smtp_user' 	=> '5c0b100a-00e5-4803-b6d9-8ec6be6b5fa4', // change it to yours
			'smtp_pass' 	=> '5c0b100a-00e5-4803-b6d9-8ec6be6b5fa4', // change it to yours
			'mailtype' 		=> 'html',
			'charset' 		=> 'iso-8859-1',
			'wordwrap' 		=> TRUE
		);

		$message = '';
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");  
		$this->email->from('cs@primemobile.co.id', 'Prime Mobile Customer Service'); // change it to yours
		$this->email->to($infosiswa->email_siswa);// change it to yours
		$this->email->subject('Invoice Prime Mobile');
		$dataemail = $data;

		$body = $this->load->view('pg_user/email_invoice.php',$dataemail,TRUE);
		


		$this->email->message($body);
		
		if($this->email->send())
		{
			$res = $this->session->set_flashdata('pesan','<div class="alert alert-success">Terima kasih atas pendaftaran yang telah anda lakukan</div>');
		}
		else
		{
			$res = $this->session->set_flashdata('error',show_error($this->email->print_debugger()));
		}
		return $res;
		
	}


function buy_confirm($idevent){
	$this->cek_event($idevent);
	$idsiswa 			= $this->session->userdata("id_siswa");
	$tanggalsekarang 	= date('Y-m-d');
	$infosiswa 			= $this->model_dashboard->get_info_siswa($idsiswa);
	$kelasaktif 		= $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);
	$data = array(
		'event'		=> $this->model_cbt_event->fetch_event_by_id($idevent),
		'infosiswa'				=> $infosiswa,
		'kelasaktif'			=> $kelasaktif,
		'pembelian'				=> $this->model_cbt_event->cek_pembelian_aktivasi_event_not_cancel($this->session->userdata("id_siswa"), $idevent)
	);
	$this->load->view("pg_user/cbt_event/confirm_activation", $data);
}

function waiting($idevent){
	$this->cek_event($idevent);
	$idsiswa 			= $this->session->userdata("id_siswa");
	$tanggalsekarang 	= date('Y-m-d');
	$infosiswa 			= $this->model_dashboard->get_info_siswa($idsiswa);
	$kelasaktif 		= $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);
	$data = array(
		'event'		=> $this->model_cbt_event->fetch_event_by_id($idevent),
		'infosiswa'				=> $infosiswa,
		'kelasaktif'			=> $kelasaktif
	);
	$this->load->view("pg_user/cbt_event/waiting_confirmation", $data);
}

function activation($idevent){
	$this->cek_event($idevent);
	$idsiswa 			= $this->session->userdata("id_siswa");
	$tanggalsekarang 	= date('Y-m-d');
	$infosiswa 			= $this->model_dashboard->get_info_siswa($idsiswa);
	$kelasaktif 		= $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);
	$data = array(
		'event'		=> $this->model_cbt_event->fetch_event_by_id($idevent),
		'infosiswa'				=> $infosiswa,
		'kelasaktif'			=> $kelasaktif
	);
	$this->load->view("pg_user/cbt_event/activation", $data);
}

function analisis($idprofil){
	if($idprofil == ""){
		redirect('user/dashboard');
	}
	
	$aliaskelas = $this->model_dashboard->kelas_by_profil($idprofil);
	
	
	
	$idsiswa 	= $this->session->userdata('id_siswa');
	$carikelas 	= $this->model_dashboard->get_kelas($idsiswa);
	$kelas 		= $carikelas->kelas;
	
	$cariidkelas	= $this->model_dashboard->get_idkelas_byprofil($idprofil);
	
	if($cariidkelas->id_kelas == ""){
		redirect('user/dashboard');
	}
	
	$idkelas = $cariidkelas->id_kelas;
	$infosiswa 			= $this->model_dashboard->get_info_siswa($idsiswa);
	$data = array(
		'navbar_links'		=> $this->model_pg->get_navbar_links(),
		'infosiswa'			=> $this->model_dashboard->get_info_siswa($idsiswa),
		'analisis_mapel_lama'	=> $this->model_dashboard->get_analisis_mapel_byprofil($idsiswa, $idprofil),
		'analisis_waktu'	=> $this->model_dashboard->get_analisis_waktu_byprofil($idsiswa, $idprofil),
		'kategori'			=> $this->model_dashboard->get_kategori_tryout_byprofil($idprofil),
		'kelas'				=> $kelas,
		'analisis_topik'	=> $this->model_dashboard->get_analisis_topik_2($idsiswa),
		'kelasaktif'		=> $this->model_dashboard->get_kelas_aktif($idsiswa, date('Y-m-d')),
		'aliaskelas'		=> $aliaskelas,
		'totalpeserta'		=> $this->model_dashboard->peserta_tryout($idkelas),
		'totalsoal'			=> $this->model_dashboard->total_soal_byprofil($idprofil),
		'jumlahbenar'		=> $this->model_dashboard->jumlah_benar($idsiswa, $idprofil),
		'dataperingkatlama'	=> $this->model_dashboard->peringkat($idprofil),
		'dataperingkat'	=> $this->model_dashboard->peringkat_by_sekolah($idprofil, $infosiswa->id_sekolah),
		'analisis_mapel' => $this->model_dashboard->analisis_mapel_by_profil_siswa($idsiswa, $idprofil),
		'idprofil'		=> $idprofil
	);
	
	$this->load->view('pg_user/cbt_event/hasil_tryout', $data);
}

}

?>