<?php
class Payment extends CI_Controller
{
  
  function __construct()
  {
    parent::__construct();
    $this->load->model("model_payment");
    $this->load->model("model_dashboard");
    $this->load->model("model_psep");
    $this->load->library("form_validation");
    $this->load->library("session");
    $this->load->helper("alert_helper");
    $this->load->helper("socmed_helper");
  }

function cek(){
  $idsiswa = $this->session->userdata("id_siswa");
  //echo $idsiswa;
  //cek dulu apakah siswa memiliki siklus tagihan di tabel siswa
  $siswa = $this->model_payment->fetch_siswa_by_id($idsiswa);

  if($siswa->id_paket == 0){
    redirect("payment/pilih_tagihan");
  }else{
    redirect("payment/tagihan");
  }
}

function pilih_tagihan(){
  $idsiswa      = $this->session->userdata("id_siswa");
  $tanggalsekarang  = date('Y-m-d');
  $infosiswa      = $this->model_dashboard->get_info_siswa($idsiswa);
  $kelasaktif     = $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);
  $data = array(
    'infosiswa'   => $infosiswa,
    'siswa'       => $this->model_payment->fetch_siswa_by_id($this->session->userdata("id_siswa")),
    'datapaket'   => $this->model_payment->fetch_paket_reguler()
  );
  $this->load->view("pg_user/payment/pilih_tagihan", $data);
}


function select_payment($idpaket){
  //cek apakah idpaket benar2 ada
  $cek = $this->model_payment->fetch_paket_by_id($idpaket);
  if($cek == null){
    redirect("payment/pilih_tagihan");
  }
  $idsiswa = $this->session->userdata("id_siswa");

  //set billing (id_paket di dalam tabel siswa)
  $setbill  = $this->model_payment->edit_paket_siswa($idsiswa, $idpaket);

  if($setbill){
    redirect("payment/tagihan");
  }
}

function tagihan(){
  $idsiswa = $this->session->userdata("id_siswa");
  $siswa = $this->model_payment->fetch_siswa_by_id($idsiswa);

  if($siswa->id_paket == 0){
    redirect("payment/pilih_tagihan");
  }

  $idsiswa      = $this->session->userdata("id_siswa");
  $tanggalsekarang  = date('Y-m-d');
  $infosiswa      = $this->model_dashboard->get_info_siswa($idsiswa);
  $kelasaktif     = $this->model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);
  $data = array(
    'infosiswa'   => $infosiswa,
    'siswa'       => $siswa,
    'tagihan'     => $this->model_payment->fetch_paket_by_id($siswa->id_paket)
  );
  $this->load->view("pg_user/payment/tagihan", $data);
}

function tagihan_id($idpembelian){
  $idsiswa = $this->session->userdata("id_siswa");
  $infosiswa      = $this->model_dashboard->get_info_siswa($idsiswa);
  $data = array(
    'infosiswa'       => $infosiswa,
    'tagihan'         => $this->model_payment->fetch_pembelian_by_id($idpembelian),
    'detailpembelian' => $this->model_payment->fetch_detail_by_pembelian($idpembelian)
  );
  $this->load->view("pg_user/payment/tagihan_pembelian", $data);
}

}
?>