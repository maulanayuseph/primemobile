<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materi_urutan extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    
    $this->load->library('form_validation');
    $this->load->helper('alert_helper');
    $this->load->helper('url_validation_helper');
    $this->load->model('model_materi_urutan');
    $this->load->model('model_adm');
    $this->load->model('model_adm1');
    $this->load->model('model_banksoal');
    $this->load->model('model_security');
    $this->model_security->is_logged_in();
  }

  public function index($kelas=0,$mapel=0,$mapok=0)
  {
    if ($kelas > 0){
		$carimapel 					= $this->model_banksoal->get_mapel_by_kelas($kelas);
	} else {
		$carimapel 					= '';
	}

    if ($kelas > 0 && $mapel > 0){
		$carimapok 					= $this->model_adm1->get_mapok_by_mapel($mapel);
	} else {
		$carimapok 					= '';
	}

    $data = array(
      'navbar_title'  				=> "Dashboard",
      'form_action'   				=> base_url() . $this->uri->slash_segment(1) . $this->uri->slash_segment(2),
      'idkelas'    					=> $kelas,
      'idmapel'    					=> $mapel,
      'idmapok'    					=> $mapok,
	  'select_options_kelas'		=> $this->model_banksoal->get_kelas(),
      'carimapel'    				=> $carimapel,
      'carimapok'    				=> $carimapok,
    );
    
    if ($kelas > 0){
		$data['list_mapel']			= $this->model_materi_urutan->cari_mapel_by_kelas($kelas);
	} else {
		$data['list_mapel']			= NULL;
	}

    if ($kelas > 0 && $mapel > 0){
		$data['list_materi_pokok']	= $this->model_materi_urutan->cari_mapok_by_mapel($mapel);
	} else {
		$data['list_materi_pokok']	= NULL;
	}

    if ($kelas > 0 && $mapel > 0&& $mapok > 0){
		$data['list_sub_materi']	= $this->model_materi_urutan->cari_mapem_by_mapok($mapok);
	} else {
		$data['list_sub_materi']	= NULL;
	}

    $this->load->view('pg_admin/materi_urutan', $data);
  }

  public function ajax_view($kelas=0,$mapel=0,$mapok=0)
  {
    if ($kelas > 0){
		$carimapel 					= $this->model_banksoal->get_mapel_by_kelas($kelas);
	} else {
		$carimapel 					= '';
	}

    if ($kelas > 0 && $mapel > 0){
		$carimapok 					= $this->model_adm1->get_mapok_by_mapel($mapel);
	} else {
		$carimapok 					= '';
	}

    $data = array(
      'navbar_title'  				=> "Dashboard",
      'form_action'   				=> base_url() . $this->uri->slash_segment(1) . $this->uri->slash_segment(2),
      'idkelas'    					=> $kelas,
      'idmapel'    					=> $mapel,
      'idmapok'    					=> $mapok,
	  'select_options_kelas'		=> $this->model_banksoal->get_kelas(),
      'carimapel'    				=> $carimapel,
      'carimapok'    				=> $carimapok,
    );
    
    if ($kelas > 0){
		$data['list_mapel']			= $this->model_materi_urutan->cari_mapel_by_kelas($kelas);
	} else {
		$data['list_mapel']			= NULL;
	}

    if ($kelas > 0 && $mapel > 0){
		$data['list_materi_pokok']	= $this->model_materi_urutan->cari_mapok_by_mapel($mapel);
	} else {
		$data['list_materi_pokok']	= NULL;
	}

    if ($kelas > 0 && $mapel > 0&& $mapok > 0){
		$data['list_sub_materi']	= $this->model_materi_urutan->cari_mapem_by_mapok($mapok);
	} else {
		$data['list_sub_materi']	= NULL;
	}
	
    $this->load->view('pg_admin/materi_urutan_ajaxpage', $data);
  }

	public function ajax_handler()
	{
		$id_materi_pokok 	= array();
		$id_sub_materi 		= array();
		$id_konten 			= array();
		$id_mapel 			= $this->input->post('id_mapel');
		$data 				= $this->input->post('json');
		$json 				= json_decode($data);
		
		foreach ($json as $key => $materi_pokok) 
		{
			$id_materi_pokok[] = $materi_pokok->id;
			
			foreach ($materi_pokok->children as $value => $sub_materi) 
			{
				$id_sub_materi[] = $sub_materi->id;
			}
		}
		
		$id_mapel 			= str_replace('map-', '', $id_mapel);
		$id_materi_pokok 	= str_replace('pok-', '', $id_materi_pokok);
		$id_sub_materi 		= str_replace('sub-', '', $id_sub_materi);

		echo $this->model_adm->update_urutan_materi_pokok($id_mapel, $id_materi_pokok);
		echo $this->model_adm->update_urutan_sub_materi($id_materi_pokok, $id_sub_materi);

	}

	function ajax_set_demo() 
	{
		$result = 0;

		if ($this->input->post('id') != null)
		{
			$id = $this->input->post('id');
			$cek_demo = $this->model_adm->cek_demo($id);

			if($cek_demo->is_demo == 1) {
				$result = $this->model_adm->set_demo($id, 0); //set video bukan menjadi video demo
			}
			else {
				$result = $this->model_adm->set_demo($id, 1); //set video menjadi video demo
			}

			echo $result;
		}
	}

}
