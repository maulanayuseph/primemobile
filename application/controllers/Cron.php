<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

	public function __construct()
	{
    parent::__construct();
			
		//check user session

		//load library in construct. Construct method will be run everytime the controller is called 
		//This library will be auto-loaded in every method in this controller. 
		//So there will be no need to call the library again in each method. 
		$this->load->library('form_validation');
		$this->load->helper('alert_helper');
		$this->load->model('model_cron');
		$this->load->model('model_login_aktif');
	}

function index(){
	$this->model_cron->test_cron();
}

function cek_login_aktif(){
	/*
	$start_date = new DateTime('2007-09-01 04:10:58');
	$since_start = $start_date->diff(new DateTime('2012-09-11 10:25:00'));
	*/
	/*
	$start_date = new DateTime('01-08-2017 10:10:00');
	$since_start = $start_date->diff(new DateTime('01-08-2017 10:20:00'));
	
	/
	echo $since_start->days.' days total<br>';
	echo $since_start->y.' years<br>';
	echo $since_start->m.' months<br>';
	echo $since_start->d.' days<br>';
	echo $since_start->h.' hours<br>';
	echo $since_start->i.' minutes<br>';
	echo $since_start->s.' seconds<br>';
	*/
	$datalogin = $this->model_cron->fetch_login_aktif();
	foreach($datalogin as $login){
		//echo "<p>".$login->timestamp;
		$start_date = new DateTime($login->timestamp);
		$since_start = $start_date->diff(new DateTime(date("d-m-Y H:i:s")));
		
		$minutes = $since_start->days * 24 * 60;
		$minutes += $since_start->h * 60;
		$minutes += $since_start->i;
		//echo "<p>" . $login->id_siswa . " " . $minutes.' minutes';
		if($minutes >= 10){
			//echo "<p>" . $login->id_siswa . " " . $minutes.' minutes';
			$this->model_cron->delete_login_aktif($login->id_siswa);
		}
	}
}
function daftar_login_user(){
	$datalogin = $this->model_cron->fetch_login_aktif_siswa();
	$data = array(
		'datalogin' => $datalogin
	);
	$this->load->view("login_aktif", $data);
}
function update_timestamp(){
	if($this->session->userdata('id_siswa') !== null){
		$idsiswa = $this->session->userdata('id_siswa');
		$timestamp = date("d-m-Y H:i:s");
		
		$this->model_login_aktif->edit_cookie($idsiswa, $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT'], $timestamp);
		setcookie("timestamp_user_pm", $timestamp, time() + (86400 * 30), "/");
	}
}

function update_aktivasi(){
	$datapaket = $this->model_cron->fetch_paket_aktif();

	$today = date("Y-m-d");

	foreach($datapaket as $paket){
		if($paket->expired_on < $today){
			//echo "<p>" . $paket->expired_on;
			$this->model_cron->update_expired_paket_aktif($paket->id_paket_aktif);
		}
	}
}

}
?>