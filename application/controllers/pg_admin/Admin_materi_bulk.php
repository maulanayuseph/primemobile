<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_materi_bulk extends CI_Controller {

  public function __construct()
  {
    parent::__construct();    
    $this->load->helper('url_validation_helper');
    $this->load->model('model_adm');
    $this->load->model('model_security');
    $this->load->model('model_materi_bulk');
    $this->model_security->is_logged_in();
  }

  public function materi()
  {
    $data = array(
      'navbar_title'  							=> "Materi",
      'select_options_mapel'        => $this->model_adm->fetch_options_materi_pokok(),
      'judul'  											=> "Tambah Materi Bulk",
      'action'  										=> base_url()."pg_admin/admin_materi_bulk/importmateri",
    );

    $this->load->view('pg_admin/admin_materi_bulk', $data);
  }

	function importmateri() 
	{
    $this->load->library('csvimport');

		$config['upload_path'] 		= 'assets/uploads/csv/';
		$config['allowed_types'] 	= 'csv';
		$config['max_size'] 			= '100000000';

		$this->load->library('upload', $config);


		if (!$this->upload->do_upload()) {
			
			$this->session->set_flashdata('error',  $this->upload->display_errors());
			redirect(base_url('pg_admin/materi/manajemen/tambah-bulk'));
			
		} else {

			$file_data = $this->upload->data();
			$file_path = 'assets/uploads/csv/'.$file_data['file_name'];
			
			if ($this->csvimport->get_array($file_path)) {
					$csv_array = $this->csvimport->get_array($file_path);
					foreach ($csv_array as $row) {
						/* TAMBAH MATERI POKOK */
						$max1           = $this->model_adm->select_max('materi_pokok', 'urutan');
						$urutan_mapok		= ($max1->urutan + 1);

						$mapel 					= $this->input->post('nama_mapel');
						$urutan1 				= $urutan_mapok;
						$nama1 					= $row['bab'];
						$cekmapok				= $this->model_materi_bulk->count_mapok($nama1,$mapel);
						if ($cekmapok == 0){
							$insertmapok 				= $this->model_materi_bulk->add_mapok_csv($mapel,$urutan1,$nama1);
						} else {
							$cekmapok			 				= $this->model_materi_bulk->cek_mapok_csv($mapel,$nama1);
							$insertmapok					= $cekmapok->id_materi_pokok;
						}
						/* TAMBAH MATERI POKOK */

						/* TAMBAH SUB MATERI */
						if($insertmapok){
							$max2           = $this->model_adm->select_max('sub_materi', 'urutan_materi');
							$urutan_mapem		= ($max2->urutan_materi + 1);

							$mapok 					= $insertmapok;
							$urutan2 				= $urutan_mapem;
							$nama2 					= $row['sub_bab'];
							$cekmapem				= $this->model_materi_bulk->count_mapem($nama2,$mapok);
							if ($cekmapem == 0){
								$insertmapem 				= $this->model_materi_bulk->add_mapem_csv($mapok,$urutan2,$nama2);
							} else {
								$cekmapem 						= $this->model_materi_bulk->cek_mapem_csv($mapok,$nama2);
								$insertmapem					= $cekmapem->id_sub_materi;
							}
						}
						/* TAMBAH SUB MATERI */
						
						/* TAMBAH ISI MATERI */
						if($insertmapem){
							$mapem 					= $insertmapem;
							$isi 						= $row['isi_materi_pembelajaran'];
							$cekisvideo			= $row['isi_video_pembelajaran'];
							$video					= (valid_url($cekisvideo) ? $cekisvideo : '');
							if ($cekisvideo == ''){
								$kategori				= '1';
								$insertmapem 		= $this->model_materi_bulk->add_materi_csv($mapem,$isi,$video,$kategori);
							} else {
								$kategori				= '2';
								$insertmapem 		= $this->model_materi_bulk->add_materi_csv($mapem,$isi,$video,$kategori);
							}
						}
						/* TAMBAH ISI MATERI */
						
					}
					unlink($file_path);
					
					$this->session->set_flashdata('hasil', 'Csv Data Imported Succesfully');
					
					redirect(base_url('pg_admin/materi/manajemen/tambah-bulk'));		
			} else {
				
				$this->session->set_flashdata('error', 'Error Import from CSV');
				redirect(base_url('pg_admin/materi/manajemen/tambah-bulk'));
			
			}
		}
	} 
	
  public function soal()
  {
    $data = array(
      'navbar_title'  							=> "Materi",
      'select_options_mapel'        => $this->model_adm->fetch_options_materi_pokok(),
      'judul'  											=> "Tambah Soal Latihan Bulk",
      'action'  										=> base_url()."pg_admin/admin_materi_bulk/importsoal",
    );

    $this->load->view('pg_admin/admin_materi_bulk', $data);
  }

	function importsoal() 
	{
    $this->load->library('csvimport');

		$config['upload_path'] 		= 'assets/uploads/csv/';
		$config['allowed_types'] 	= '*';
		$config['max_size'] 			= '100000000';

		$this->load->library('upload', $config);


		if (!$this->upload->do_upload()) {
			
			$this->session->set_flashdata('error',  $this->upload->display_errors());
			redirect(base_url('pg_admin/materi/manajemen/tambah-soal-bulk'));
			
		} else {

			$file_data = $this->upload->data();
			$file_path = 'assets/uploads/csv/'.$file_data['file_name'];
			
			if ($this->csvimport->get_array($file_path)) {
					$csv_array = $this->csvimport->get_array($file_path);
					foreach ($csv_array as $row) {
						/* TAMBAH MATERI POKOK */
						$max1           = $this->model_adm->select_max('materi_pokok', 'urutan');
						$urutan_mapok		= ($max1->urutan + 1);

						$mapel 					= $this->input->post('nama_mapel');
						$urutan1 				= $urutan_mapok;
						$nama1 					= $row['bab'];
						$cekmapok				= $this->model_materi_bulk->count_mapok($nama1,$mapel);
						if ($cekmapok == 0){
							$insertmapok 				= $this->model_materi_bulk->add_mapok_csv($mapel,$urutan1,$nama1);
						} else {
							$cekmapok			 				= $this->model_materi_bulk->cek_mapok_csv($mapel,$nama1);
							$insertmapok					= $cekmapok->id_materi_pokok;
						}
						/* TAMBAH MATERI POKOK */

						/* TAMBAH SUB MATERI */
						if($insertmapok){
							$max2           = $this->model_adm->select_max('sub_materi', 'urutan_materi');
							$urutan_mapem		= ($max2->urutan_materi + 1);

							$mapok 					= $insertmapok;
							$urutan2 				= $urutan_mapem;
							$nama2 					= $row['sub_bab'];
							$cekmapem				= $this->model_materi_bulk->count_mapem($nama2,$mapok);
							if ($cekmapem == 0){
								$insertmapem 		= $this->model_materi_bulk->add_mapem_csv($mapok,$urutan2,$nama2);
								$mapem 					= $insertmapem;
								$insertidmapem	= $this->model_materi_bulk->add_materi_soal_csv($mapem);
							} else {
								$cekmapem 			= $this->model_materi_bulk->cek_mapem_csv($mapok,$nama2);
								$insertmapem		= $cekmapem->id_sub_materi;
								$mapem 				= $insertmapem;
								$cekkontensub		= $this->model_materi_bulk->cek_mapem_soal_csv($insertmapem,'3');
								$insertidmapem	= $cekmapem->id_sub_materi;
							}
						}
						/* TAMBAH SUB MATERI */
						
						/* TAMBAH PERTANYAAN */
						if($insertidmapem){
							$idmapem 				= $insertidmapem;
							$soal						= $row['soal'];
							$insertidsoal		= $this->model_materi_bulk->add_pertanyaan_csv($mapem,$soal);
						}
						/* TAMBAH PERTANYAAN */
						
						/* TAMBAH PERTANYAAN */
						if($insertidsoal){
							$idsoal 				= $insertidsoal;
							$a							= $row['jawaban_1'];
							$b							= $row['jawaban_2'];
							$c							= $row['jawaban_3'];
							$d							= $row['jawaban_4'];
							$e							= $row['jawaban_5'];
							$kunci					= $row['kunci_jawaban'];
							$teks						= $row['pembahasan_teks'];
							$video					= $row['pembahasan_video'];
							$insertidsoal		= $this->model_materi_bulk->add_jawaban_csv($idsoal,$a,$b,$c,$d,$e,$kunci,$teks,$video);
						}
						/* TAMBAH PERTANYAAN */
						
					}
					unlink($file_path);
					
					$this->session->set_flashdata('hasil', 'Csv Data Imported Succesfully');
					
					redirect(base_url('pg_admin/materi/manajemen/tambah-soal-bulk'));		
			} else {
				
				$this->session->set_flashdata('error', 'Error Import from CSV');
				redirect(base_url('pg_admin/materi/manajemen/tambah-soal-bulk'));
			
			}
		}
	} 
	
}
