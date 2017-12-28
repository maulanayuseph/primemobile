<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
    parent::__construct();
			
		//check user session

		//load library in construct. Construct method will be run everytime the controller is called 
		//This library will be auto-loaded in every method in this controller. 
		//So there will be no need to call the library again in each method. 
		$this->load->library('form_validation');
		$this->load->helper('alert_helper');
		$this->load->model('model_adm');
		$this->load->model('model_security');
		$this->model_security->is_logged_in();
	}

	public function index()
	{
		if($this->session->userdata('level') == "adminqc"){
			redirect('pg_admin/quality/dashboard');
		}elseif($this->session->userdata('level') == "qc"){
			redirect("pg_admin/quality/qc_dashboard");
		}elseif($this->session->userdata('level') == "adminpa"){
			redirect('pg_admin/pa');
		}else{
			redirect('pg_admin/materi_urutan');
		}
		
		$data = array(
			'navbar_title' 					=> "Dashboard",
			'list_jenjang_kelas' 		=> $this->model_adm->fetch_list_group_by('kelas', 'jenjang', 'tingkatan_kelas'),
			'list_tingkatan_kelas' 	=> $this->model_adm->fetch_list_group_by('kelas', 'tingkatan_kelas', 'tingkatan_kelas'),
			'list_mapel' 						=> $this->model_adm->fetch_list_group_by('mata_pelajaran', '', 'kelas_id'),
			'list_materi_pokok'			=> $this->model_adm->fetch_list_group_by('materi_pokok', '', 'urutan'),
			// 'list_sub_materi'				=> $this->model_adm->fetch_list_group_by('sub_materi', '', 'urutan_materi'),
			// 'list_kategori_konten'	=> $this->model_adm->fetch_kategori_konten()
			//'list_sub_materi'				=> $this->model_adm->fetch_kategori_konten(),
			'urutan_konten' 				=> array('teks', 'video', 'soal')

			);

		$this->load->view('pg_admin/dashboard', $data);
	}

	public function ajax_handler()
	{
		$id_materi_pokok 	= array();
		$id_sub_materi 		= array();
		$id_konten 				= array();
		$id_mapel 				= $this->input->post('id_mapel');
		$data 						= $this->input->post('json');
		$json 						= json_decode($data);
		// echo "Posted Data = " . $data;
		// echo "\njson[0] " . $json[0]->id;
		// print_r($json);

		// echo "children0: " . (!empty($json[0]->children) ? 'ada' : 'kosong'); 
		// echo "children1: " . (!empty($json[1]->children) ? 'ada' : 'kosong'); 
		// echo "id_materi_pokok: " . (!empty($id_materi_pokok) ? 'ada' : 'kosong'); 
		
		foreach ($json as $key => $materi_pokok) 
		{
			$id_materi_pokok[] = $materi_pokok->id;
			
			foreach ($materi_pokok->children as $value => $sub_materi) 
			{
				$id_sub_materi[] = $sub_materi->id;
				
				// REVERT
				// foreach ($sub_materi->children as $konten) 
				// {
				// 	// 1. 18_teks
				// 	$exp = explode("_", $konten->id); 
				// 	// 2. $exp = ('18', 'teks')
				// 	if (("sub-".$exp[0]) == $sub_materi->id) 
				// 	{
				// 		$id_konten[$exp[0]][] = $exp[1];
				// 		// 3. $exp[18] = ('teks', 'video')
				// 	}
				// }

			}
		}

		// echo "\n".count($id_materi_pokok).
		// "\n".count($id_sub_materi)."\n";

		// print_r($id_materi_pokok);
		// print_r($id_sub_materi);
		
		$id_mapel 				= str_replace('map-', '', $id_mapel);
		$id_materi_pokok 	= str_replace('pok-', '', $id_materi_pokok);
		$id_sub_materi 		= str_replace('sub-', '', $id_sub_materi);

		// REVERT
		// foreach ($id_sub_materi as $id_sub) {
		// 	foreach ($id_konten as $key => $tipe) {
		// 		if($id_sub == $key) {
		// 			$id_konten[$key] = join(',', $tipe);
		// 			// echo "JOIN ".$key." -> ".join(',', $tipe)."\n";
		// 		}
		// 	}
		// }

		// TESTER
		// print_r($id_materi_pokok);
		// echo "\n";
		// print_r($id_sub_materi);
		// echo "\n";
		// print_r($id_konten);

		echo $this->model_adm->update_urutan_materi_pokok($id_mapel, $id_materi_pokok);
		echo $this->model_adm->update_urutan_sub_materi($id_materi_pokok, $id_sub_materi);
		// REVERT
		// echo $this->model_adm->update_urutan_konten($id_konten);
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
