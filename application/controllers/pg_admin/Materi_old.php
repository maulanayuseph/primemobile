<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materi extends CI_Controller {

	public function __construct()
  {
    parent::__construct();
		
		//check user session

		//load library in construct. Construct method will be run everytime the controller is called 
		//This library will be auto-loaded in every method in this controller. 
		//So there will be no need to call the library again in each method. 
		$this->load->library('form_validation');
		$this->load->helper('alert_helper');
		$this->load->helper('url_validation_helper');
		$this->load->model('model_adm');
		$this->load->model('model_security');
		$this->model_security->is_logged_in();
  }

	public function index()
	{
		$data = array(
			'navbar_title' 	=> "Materi",
			'form_action' 	=> base_url() . $this->uri->slash_segment(1) . $this->uri->slash_segment(2),
			'table_data' 		=> $this->model_adm->fetch_all_materi()
			);
		// tester
		// alert_success('', "");
		// alert_error('danger', "isi 2");
		 // alert_warning('info', "isi 2");
		 // alert_info('info', "isi 2");

		$this->load->view('pg_admin/materi', $data);
	}

	public function manajemen($aksi)
	{
		//$aksi contains the value needed (tambah/ubah) to direct user to Add/Edit form
		if($aksi)
		{
			//Trigger form submission validation rules
			$this->form_validation_rules();

			switch ($aksi) {
				case 'tambah':
					$data = array(
					'navbar_title'								=> "Manajemen Materi",
					'page_title' 									=> "Tambah Materi",
					'form_action' 								=> current_url(),
					'select_options_mapel'				=> $this->model_adm->fetch_options_materi_pokok(),
					'select_options_materi_pokok'	=> $this->model_adm->fetch_options_materi(),
					'jumlah_soal_submateri'				=> 0
					);

					//Form materi submit handler. See if the user is attempting to submit a form or not
					if($this->input->post('form_submit')) 
					{
						//Form is submitted. Now routing to proses_tambah method
						$this->proses_tambah();
					}
					else 
					{
						//No form is submitted. Displaying the form page
						$this->load->view('pg_admin/materi_form', $data);
					}
					break;
				
				case 'ubah':
					//Passing id value from GET '?id' to variable '$id'
					$id = $this->input->get('id') ? $this->input->get('id') : null ;
					
					$data = array(
					'navbar_title'								=> "Manajemen Materi",
					'page_title' 									=> "Ubah Materi",
					'form_action' 								=> current_url() . "?id=$id",
					'select_options_mapel'				=> $this->model_adm->fetch_options_materi_pokok(),
					'select_options_materi_pokok'	=> $this->model_adm->fetch_options_materi(),
					'jumlah_soal_submateri'				=> $this->model_adm->fetch_jumlah_soal($id),
					'data_soal_submateri'					=> $this->model_adm->fetch_soal_by_submateri($id)
					);

					//Redirect to materi if id is not exist
					if(!$id)
					{
						redirect('pg_admin/materi');
					}
					else 
					{
						//Calling values from database by id and pass them to View
						//fetching konten_materi by id
						$data['data'] 			= $this->fetch_materi_by_id($id);
						$data['data_soal'] 	= $this->model_adm->fetch_soal_by_id($id);
						// var_dump($data['data_soal']);

						//Form materi submit handler. See if the user is attempting to submit a form or not
						if($this->input->post('form_submit')) 
						{
							//Form is submitted. Now routing to proses_tambah method
							$this->proses_ubah($id);
						}
						else 
						{
							//No form is submitted. Displaying the form page
							$this->load->view('pg_admin/materi_form', $data);
						}
					}
					break;
				
				default:
					redirect('pg_admin/materi');
					break;
			}
		}
		else
		{
			redirect('pg_admin/materi');
		}

	}

	public function proses_tambah()
	{
		//set the page title
		$data = array(
			'page_title' 									=> "Tambah Materi", 
			'form_action' 								=> current_url(),
			'select_options_mapel'				=> $this->model_adm->fetch_options_materi_pokok(),
			'select_options_materi_pokok'	=> $this->model_adm->fetch_options_materi()
			);

		//fetch input (make sure that the variable name is the same as column name in database!) 
		$params = $this->input->post(null, false);
		$kategori 		 				= $params['kategori_materi'];
		$mapel_id 						= $params['nama_mapel'];
		$materi_pokok_id			= $params['materi_pokok'];
		$nama_sub_materi 			= $params['judul_materi'];
		$deskripsi_sub_materi	= isset($params['deskripsi_materi']) ? $params['deskripsi_materi'] : ''; 
		// $deskripsi_sub_materi	= ''; 
		$isi_materi 	 				= $params['konten_materi'];
		$video_materi 	 			= valid_url($params['konten_video']) ? $params['konten_video'] : '';
		$gambar_materi	 			= $params['gambar_materi']; 
		$tanggal	 						= $params['tanggal_post']; 
		$waktu	 							= $params['waktu_post'];
		$max 									= $this->model_adm->select_max('sub_materi', 'urutan_materi');
		$urutan_materi 				= ($max->urutan_materi + 1);

		//fetch input for soal
		if($kategori == 3)
		{
			$isi_soal 		 		= $params['isi_soal'];
			$kunci_jawaban 		= $params['kunci_jawaban'];
			$jawab_1 					= $params['jawab_1'];
			$jawab_2 					= $params['jawab_2'];
			$jawab_3 					= $params['jawab_3'];
			$jawab_4 					= $params['jawab_4'];
			$jawab_5 					= $params['jawab_5'];
			$pembahasan				= $params['pembahasan'];
			$pembahasan_video	= valid_url($params['pembahasan_video']) ? $params['pembahasan_video'] : '';
		}

		//run the validation
		if ($this->form_validation->run() == FALSE) 
		{
			alert_error("Error", "Data gagal ditambahkan");
			$this->load->view('pg_admin/materi_form', $data);
		}
		else 
		{
			//passing input value to Model
			$insert_id = $this->model_adm->add_materi($kategori, $mapel_id, $materi_pokok_id, $nama_sub_materi, $deskripsi_sub_materi, $isi_materi, $video_materi, $gambar_materi, $tanggal, $waktu, $urutan_materi);

			//continue passing soal input value to Model
			if($insert_id && $kategori == 3) 
			{
				$result = $this->model_adm->add_item_soal($isi_soal, $jawab_1, $jawab_2, $jawab_3, $jawab_4, $jawab_5, $kunci_jawaban, $insert_id, $pembahasan, $pembahasan_video);
			} 

			alert_success("Sukses", "Data berhasil ditambahkan");
			redirect('pg_admin/materi');
			// echo "Status Insert: " . $result;
		}	
	}

	public function proses_ubah($id)
	{
		//set the page title
		$data = array(
			'page_title' 									=> "Ubah Materi",
			'form_action' 								=> current_url(). "?id=$id",
			'select_options_mapel'				=> $this->model_adm->fetch_options_materi_pokok(),
			'select_options_materi_pokok'	=> $this->model_adm->fetch_options_materi()
			);

		//fetch input (make sure that the variable name is the same as column name in database!) 
		$params = $this->input->post(null, false);
		$kategori 		 					= $params['kategori_materi'];
		$mapel_id 							= $params['nama_mapel'];
		$materi_pokok_id				= $params['materi_pokok'];
		$nama_sub_materi 				= $params['judul_materi'];
		$deskripsi_sub_materi 	= isset($params['deskripsi_materi']) ? $params['deskripsi_materi'] : '' ;
		// $deskripsi_sub_materi		= ''; 
		$isi_materi 	 					= $params['konten_materi'];
		$video_materi 	 				= valid_url($params['konten_video']) ? $params['konten_video'] : '';
		$gambar_materi	 				= $params['gambar_materi']; 
		$tanggal	 							= $params['tanggal_post']; 
		$waktu	 								= $params['waktu_post']; 

		//fetch input for soal
		if($kategori == 3)
		{
			$id_soal_array = explode(',', $this->input->post('id_soal_array'));
			$ke = 1;
			foreach ($id_soal_array as $id_soal) 
			{
				if($id_soal == 0) { $ke = ''; }
				$isi_soal 		 		= $params['isi_soal'.$ke];
				$jawab_1 					= $params['jawab_1'.$ke];
				$jawab_2 					= $params['jawab_2'.$ke];
				$jawab_3 					= $params['jawab_3'.$ke];
				$jawab_4 					= $params['jawab_4'.$ke];
				$jawab_5 					= $params['jawab_5'.$ke];
				$kunci_jawaban 		= $params['kunci_jawaban'.$ke];
				$pembahasan				= $params['pembahasan'.$ke];
				$pembahasan_video	= valid_url($params['pembahasan_video'.$ke]) ? $params['pembahasan_video'.$ke] : '';

				if($id_soal != 0)
				{
					$this->model_adm->update_item_soal($isi_soal, $jawab_1, $jawab_2, $jawab_3, $jawab_4, $jawab_5, $kunci_jawaban, $pembahasan, $pembahasan_video, $id_soal);
					$ke++;
				}
				else if($id_soal == 0)
				{
					$sub_materi_id = $this->input->get('id') ? $this->input->get('id') : null ;
					$this->model_adm->add_item_soal($isi_soal, $jawab_1, $jawab_2, $jawab_3, $jawab_4, $jawab_5, $kunci_jawaban, $sub_materi_id, $pembahasan, $pembahasan_video);
				}
			}
		}

		//run the validation
		if ($this->form_validation->run() == FALSE) 
		{
			alert_error("Error", "Data gagal diubah");
			$this->load->view('pg_admin/materi_form', $data);
		}
		else 
		{
			//passing input value to Model
			$result = $this->model_adm->update_materi($id, $kategori, $mapel_id, $materi_pokok_id, $nama_sub_materi, $deskripsi_sub_materi, $isi_materi, $video_materi, $gambar_materi, $tanggal, $waktu);
			alert_success("Sukses", "Data berhasil diubah");
			redirect('pg_admin/materi');
			// echo "Status Update: " . $result;
		}	
	}

	public function proses_hapus()
	{

		if($this->input->post('deleteRow_submit'))
		{
			//set form validation rules 
			$this->form_validation->set_rules('hidden_row_id', "Nomor Baris", 'trim|required|numeric');

			if($this->form_validation->run())
			{
				$id 	= $this->input->post('hidden_row_id');
				$result = $this->model_adm->delete_materi($id);
				
				alert_success('Sukses', "Data berhasil dihapus");
				redirect('pg_admin/materi');
			}
		}
		
		alert_danger('Error', "Data gagal dihapus");
		redirect('pg_admin/materi');
	}

	function preview_konten($sub_materi_id)
	{
		if($sub_materi_id)
		{
			$data['content_preview'] 	= $this->model_adm->fetch_content_by_id($sub_materi_id);
			$gambar_materi = isset($data['content_preview']->gambar_materi) ? $data['content_preview']->gambar_materi : '';
			$data['thumbnail_dir'] 		= base_url('') . "assets/img/no-image.jpg";
			
			if($gambar_materi)
			{
				$data['thumbnail_dir'] 	= base_url('') . "assets/js/plugins/kcfinder/upload/images/" . $data['content_preview']->gambar_materi;
			}

			$this->load->view('preview/content_preview', $data);
		}
		else
		{
			redirect('pg_admin/materi');
		}
	}

	function form_validation_rules()
	{
		//set validation rules for each input
		$this->form_validation->set_rules('kategori_materi', 'Kategori Materi', 'trim|required');
		$this->form_validation->set_rules('nama_mapel', 'Mata Pelajaran', 'trim|required');
		$this->form_validation->set_rules('materi_pokok', 'Materi Pokok', 'trim|required');
		$this->form_validation->set_rules('judul_materi', 'Judul Materi', 'trim|required');
		// $this->form_validation->set_rules('deskripsi_materi', 'Deskripsi Materi', 'trim');
		// $this->form_validation->set_rules('konten_materi', 'Konten Materi', 'required');
		$this->form_validation->set_rules('tanggal_post', 'Tanggal Post', 'trim|required');
		$this->form_validation->set_rules('waktu_post', 'Waktu Post', 'trim|required');
		
		//set custom error message
		$this->form_validation->set_message('required', '%s tidak boleh kosong');
	}

	function fetch_materi_by_id($id)
	{
		$data 					= new stdClass();
		$table_data 		= $this->model_adm->fetch_materi_by_id($id); 
		$table_fields 	= $this->model_adm->get_table_fields('mata_pelajaran', 'materi_pokok', 'sub_materi', 'konten_materi');
		//tester
		// var_dump($table_data);
		// var_dump($table_fields);
		if($table_data)
		{
			foreach ($table_fields as $field) {
				$data->{$field} = $table_data->{$field} ? $table_data->{$field} : ''; 
				// echo "$field -> " . ${$field} . ", "; 
			}
		}
		else { $data = null; }

		return $data; 
	}

	function ajax_select_materi_pokok()
	{
		$id = $this->input->post('id', true) ? $this->input->post('id', true) : null;
		
		if($id)
		{
			$dynamic_options = $this->model_adm->fetch_materi_pokok_by_mapel($id);

			if($dynamic_options){
				foreach ($dynamic_options as $item) {
					echo "<option value=''></option>";
					echo "<option value='" . $item->id_materi_pokok . "'> $item->nama_materi_pokok </option>";
				}
			}
			else
			{
				echo "<option value=''></option>";
				echo "<option value='' disabled='disabled'>Tidak ada data</option>";
			}
		}
		else{
			return false;
		}
	}

	function ajax_status_materi()
	{
		$target = $this->input->post('target_name');
		$state 	= ($this->input->post('state') == 'true') ? 0 : 1; // (0)free : (1)berbayar

		$target = explode('_', $target);
		$id_sub = end($target);

		$result = $this->model_adm->set_status_materi($id_sub, $state);
		
		echo "target: $id_sub, state: $state, resultDB: $result";
	}


	// function ajax_konten_video()
	// {
	// 	$url = $this->input->post('data', true) ? $this->input->post('data', true) : null;
		
	// 	if($url)
	// 	{
	// 		$valid_url = valid_url($url);

	// 		if($valid_url){
	// 			echo "<iframe src='" . $url . "' id='iframe' width='640' height='380'></iframe>";
	// 		}
	// 		else
	// 		{
	// 			echo "<p class='text-danger'>URL tidak valid</p>";
	// 		}
	// 	}
	// 	else{
	// 		return false;
	// 	}
	// }

}
