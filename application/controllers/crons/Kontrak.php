<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontrak extends CI_Controller {

public function __construct(){
    parent::__construct();
    $this->load->model('model_kontrak');
    $this->load->model('model_payment');
}

function tagihan_kontrak(){
	$datakontrak = $this->model_kontrak->fetch_kontrak_aktif();

	foreach($datakontrak as $kontrak){
		$execute = $this->execute_tagihan_by_kontrak($kontrak);
	}
}

function execute_tagihan_by_kontrak($kontrak){
	//buat pembelian baru
	$idsekolah 	= $kontrak->id_sekolah;
	$periode 	= $kontrak->periode_tagihan;
	if($periode == 1){
		$idpaket = 15;
	}elseif($periode == 3){
		$idpaket = 16;
	}elseif($periode == 6){
		$idpaket = 17;
	}elseif($periode == 12){
		$idpaket = 18;
	}

	//fetch kelas paralel dan tahun ajaran untuk mendapatkan data siswa
	$datakelasparalel 	= $this->model_kontrak->fetch_kelas_paralel_by_sekolah($idsekolah);
	$tahunajaran 		= $this->model_kontrak->fetch_tahun_ajaran_aktif_by_sekolah($idsekolah);

	$now 	= new DateTime(null);
	//Set interval 6 hari untuk batas waktu pembayaran
	$now->add(new DateInterval('P6D'));
	$expired = $now->format("Y-m-d H:i:00");
	$timestamptagihan = date("Y-m-d H:i:s");
	$datapembelian = array(
		'metode_pembayaran'	=> 1,
		'status'			=> 0,
		'timestamp'			=> $timestamptagihan,
		'expired_on'		=> $expired,
	);

	$pembelian = $this->model_kontrak->insert_pembelian($datapembelian);

	if(!$insertpembelian){
		$totalharga = 0;
		foreach($tahunajaran as $tahun){
			foreach($datakelasparalel as $kelaspar){

				$detail = $this->model_kontrak->fetch_detail_kontrak_by_kelas($kontrak->id_kontrak, $kelaspar->id_kelas);

				$periodedetail[1]	= $detail->periode_1;
				$periodedetail[3]	= $detail->periode_3;
				$periodedetail[6]	= $detail->periode_6;
				$periodedetail[12]	= $detail->periode_12;

				$hargasatuan = $periodedetail[$periode];
				echo $hargasatuan;

				$datasiswa = $this->model_kontrak->fetch_siswa_psep($tahun->id_tahun_ajaran, $kelaspar->id_kelas_paralel);

				$jumsis = 0;
				foreach($datasiswa as $siswa){
					//cari siswa yang memiliki tagihan kolektif_kontrak
					$cektagihan = $this->model_kontrak->cek_siswa_kolektif_kontrak($siswa->id_siswa);
					if($cektagihan > 0){
						$jumsis++;
					}
				}
				
				//insert detail pembelian
				$detail = array(
					'pembelian_id'		=> $insertpembelian,
					'id_kelas_paralel'	=> $kelaspar->id_kelas_paralel,
					'id_tahun_ajaran'	=> $tahun->id_tahun_ajaran,
					'paket_id'			=> $idpaket,
					'jumlah'			=> $jumsis,
					'harga_satuan'		=> $hargasatuan

				);
				$this->db->insert->('pembelian_detail', $data);

				$hargadetail = $hargasatuan * $jumsis;
				$totalharga += $hargadetail;
			}

		}
		//edit pembelian detail
		$this->model_kontrak->edit_total_harga_pembelian($insertpembelian, $totalharga);

		$dataxml = array(
			'bookingid'		=> $insertpembelian,
			'clientid'		=> $idsekolah,
			'customer_name'	=> substr($kontrak->nama_sekolah, 0, 25),
			'amount'		=> $totalharga,
			'productid'		=> $idpaket,
			'interval'		=> 8640,
			'username'			=> username_tfp,
			'booking_datetime'	=> $timestamptagihan,
			'signature'			=> md5(username_tfp . password_tfp . $insertpembelian)
		);

		$reqpaymentcode = $this->model_payment->reqpaymentcode($dataxml);
	}else{
		$this->execute_tagihan_by_kontrak($kontrak);
	}
}

}
?>