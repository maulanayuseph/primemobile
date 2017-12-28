<?php 

/**
* 
*/
class Ref extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index($kode){
			$url = "http://affiliasi.primemobile.co.id/affiliasi?kode=" . $kode;
			
			$ref = json_decode($this->curl_get_contents($url), true);
			if ($ref['status'] == true) {
				/*
				$sesi 	= array(
					'id_affiliasi' => $ref['id_affiliasi']
				);
				$this->session->set_userdata($sesi);
				*/
				$cookie_name = "id_affiliasi";
				$cookie_value = $ref['id_affiliasi'];
				setcookie($cookie_name, $cookie_value, time() + (86500 * 90), "/");
				
				if ($kode == 'republika'){
					redirect(base_url('event/sbmptn'));
				} else {
					redirect(base_url());
				}
			} else {
				redirect(base_url());
			}
	}

	function curl_get_contents($url){
	  $ch = curl_init($url);
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	  $data = curl_exec($ch);
	  curl_close($ch);
	  return $data;
	}

}
