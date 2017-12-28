<?php 

/**
* 
*/
class Pengumuman extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_pg');
		$this->load->model('model_paket');
		$this->load->model('model_event');
		$this->load->model('model_pembayaran');
		$this->load->model('model_dashboard');
	}

function cbt(){
	$data = array(
		'nasionalsd'	=> $this->model_event->fetch_peringkat_nasional_sd(),
		'nasionalsmp'	=> $this->model_event->fetch_peringkat_nasional_smp(),
		'nasionalsmaipa'	=> $this->model_event->fetch_peringkat_nasional_sma_ipa(),
		'nasionalsmaips'	=> $this->model_event->fetch_peringkat_nasional_sma_ips(),
		'regionalsd'		=> $this->model_event->fetch_peringkat_regional_sd(),
		'regionalsmp'		=> $this->model_event->fetch_peringkat_regional_smp(),
		'regionalsmaipa'	=> $this->model_event->fetch_peringkat_regional_sma_ipa(),
		'regionalsmaips'	=> $this->model_event->fetch_peringkat_regional_sma_ips()

	);
	$this->load->view("landing_page/cbt2017/pengumuman", $data);
}

}
?>