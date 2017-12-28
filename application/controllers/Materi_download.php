<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materi_download extends CI_Controller {

	public function __construct()
  {
    parent::__construct();
		//load library in construct. Construct method will be run everytime the controller is called 
		//This library will be auto-loaded in every method in this controller. 
		//So there will be no need to call the library again in each method. 
		$this->load->library('usertracking');
		$this->load->helper('alert_helper');
		$this->load->model('model_pg');
		$this->load->model('model_agcu');
		$this->load->model('model_poin');
  }

	public function download_materi($id)
	{
		if (count($_SESSION['akses']) == 0){
			redirect('user/aktivasi');
		}
		$this->load->library('pdf');
 
		$data['data'] 		= $this->model_pg->get_konten_by_id($id);
		$data['title'] 		= $data['data']->nama_sub_materi;
 
		$html = $this->load->view('pg_user/pdf_materi', $data, true);
		
		$this->pdf->pdf_create($html,url_title($data['data']->nama_sub_materi,'-',TRUE),'A4','potrait');
	}
	
	public function download_bab($materi)
	{
		if (count($_SESSION['akses']) == 0){
			redirect('user/aktivasi');
		}
		$this->load->library('pdf');
 
		$data['header'] 		= $this->model_pg->get_mapel_by_materi($materi);
		$data['list_pokok'] = $this->model_pg->get_mapel_by_materi($data['header']->id_materi_pokok);
		$data['list_sub'] 	= $this->model_pg->fetch_list_konten_by_materi($materi);
 
		$html = $this->load->view('pg_user/pdf_bab', $data, true);
		
		$this->pdf->pdf_create($html,url_title($data['header']->nama_materi_pokok,'-',TRUE),'A4','potrait');
	}
	
}

 ?>