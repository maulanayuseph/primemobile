<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Latihansoal extends CI_Controller {

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
		$this->load->model('model_kurikulum');
		$this->load->model('model_atribut');
		$this->load->model('model_komentar_soal');
		$this->load->model('model_security');
		$this->model_security->is_logged_in();
  }

	public function index()
	{
		$data = array(
			'navbar_title' 	=> "Semua Soal",
			'form_action' 	=> base_url() . $this->uri->slash_segment(1) . $this->uri->slash_segment(2),
			'table_data' 		=> $this->model_adm->fetch_all_soal()
			);
		// tester
		// alert_success('', "");
		// alert_error('danger', "isi 2");
		 // alert_warning('info', "isi 2");
		 // alert_info('info', "isi 2");

		$this->load->view('pg_admin/latihansoal', $data);
	}

	
	// show all latihan soal from specified sub materi
	public function detail($id_sub_materi)
	{
		$data = array(
			'navbar_title' 	=> "Latihan Soal",
			'form_action' 	=> base_url() . $this->uri->slash_segment(1) . $this->uri->slash_segment(2),
			'table_data' 	=> $this->model_adm->fetch_soal_by_submateri($id_sub_materi),
			'submateri'		=> $this->model_adm->fetch_materi_by_id($id_sub_materi)
			);

		// tester
		// alert_success('', "");
		// alert_error('danger', "isi 2");
		 // alert_warning('info', "isi 2");
		 // alert_info('info', "isi 2");

		$this->load->view('pg_admin/latihansoal_detail', $data);
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
					'navbar_title'								=> "Manajemen Latihan Soal",
					'page_title' 									=> "Buat Latihan Soal",
					'form_action' 								=> current_url(),
					'select_options_mapel'				=> $this->model_adm->fetch_options_materi_pokok(),
					'select_options_materi_pokok'	=> $this->model_adm->fetch_options_materi(),
					'submateri'										=> $this->model_adm->fetch_all_materi()
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
						$this->load->view('pg_admin/latihansoal_form', $data);
					}
					break;
				
				case 'tambah_soal':
					//Passing id value from GET '?id' to variable '$id'
					$id = $this->input->get('id') ? $this->input->get('id') : null ;

					$data = array(
						'navbar_title'	=> "Manajemen Latihan Soal",
						'page_title' 		=> "Tambah Soal",
						'form_action' 	=> current_url() . "?id=$id",
						'sub_materi_id' => $id
					);

					//Form materi submit handler. See if the user is attempting to submit a form or not
					if($this->input->post('form_submit')) 
					{
						//Form is submitted. Now routing to proses_tambah method
						$this->proses_tambah_soal($id);
					}
					else 
					{
						//No form is submitted. Displaying the form page
						$this->load->view('pg_admin/latihansoal_detail_form', $data);
					}
					break;
				
				case 'ubah_soal':
					//Passing id value from GET '?id' to variable '$id'
					$id = $this->input->get('id') ? $this->input->get('id') : null ;
					
					$data = array(
					'navbar_title'	=> "Manajemen Latihan Soal",
					'page_title' 		=> "Ubah Latihan Soal",
					'form_action' 	=> current_url() . "?id=$id"
					);

					//Redirect to materi if id is not exist
					if(!$id)
					{
						redirect('pg_admin/latihansoal/');
					}
					else 
					{
						//Calling values from database by id and pass them to View
						//fetching jawaban by id
						$data['data'] = $this->model_adm->fetch_soal_by_id($id);

						//Form materi submit handler. See if the user is attempting to submit a form or not
						if($this->input->post('form_submit')) 
						{
							//Form is submitted. Now routing to proses_tambah method
							$this->proses_ubah_soal($id);
						}
						else 
						{
							//No form is submitted. Displaying the form page
							$this->load->view('pg_admin/latihansoal_detail_form', $data);
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

	public function proses_tambah_soal($id)
	{
		//fetch input (make sure that the variable name is the same as column name in database!) 
		$params = $this->input->post(null, false);
		$isi_soal 		 		= $params['isi_soal'];
		$kunci_jawaban 		= $params['kunci_jawaban'];
		$bobot 						= $params['bobot'];
		$jawab_1 					= $params['jawab_1'];
		$jawab_2 					= $params['jawab_2'];
		$jawab_3 					= $params['jawab_3'];
		$jawab_4 					= $params['jawab_4'];
		$jawab_5 					= $params['jawab_5'];
		$sub_materi_id		= $this->input->get('id');
		$pembahasan				= $params['pembahasan'];
		$pembahasan_video	= $params['pembahasan_video'];
		
		//set the page title
		$data = array(
			'page_title' 	=> "Tambah Soal", 
			'form_action' => current_url() . "?id=$id",
			);

		//set validation rules
		$this->form_validation->set_rules('isi_soal', 'Isi Soal', 'required');
		// $this->form_validation->set_rules('pembahasan', 'Pembahasan', 'required');
		$this->form_validation->set_rules('kunci_jawaban', 'Kunci Jawaban', 'required');
			
		//run the validation
		if ($this->form_validation->run() == FALSE) 
		{
			alert_error("Error", "Data gagal ditambahkan");
			$this->load->view('pg_admin/latihansoal_detail_form', $data);
		}
		else 
		{
			//passing input value to Model
			$result = $this->model_adm->add_item_soal($isi_soal,$jawab_1,$jawab_2,$jawab_3,$jawab_4,$jawab_5,$kunci_jawaban,$sub_materi_id,$pembahasan,$pembahasan_video,$bobot, $this->session->userdata('id_admin'));
			//mulai penambahan atribut soal
			//#############################
			//#############################
			$dataatribut = $this->model_atribut->fetch_all_atribut();
			foreach($dataatribut as $atribut){
				$checkatr = $this->input->post("checkatr", true);
				if(isset($checkatr[$atribut->id_atribut])){
					//echo "<p>" . $atribut->id_atribut;
					$this->model_atribut->insert_atribut_soal($result, $checkatr[$atribut->id_atribut]);
				}
			}
			//#############################
			//#############################
			
			alert_success("Sukses", "Data berhasil ditambahkan");
			
			if($this->session->userdata('level') == "author"){
				redirect('pg_admin/author/list_soal/'.$sub_materi_id);
			}else{
				redirect('pg_admin/latihansoal/detail/'.$id);
			}
			// echo "Status Insert: " . $result;
		}	
	}

	public function proses_ubah_soal($id)
	{
		//set the page title
		$data = array(
			'page_title' 	=> "Ubah Soal",
			'form_action' => current_url(). "?id=$id"
			);

		//fetch input (make sure that the variable name is the same as column name in database!) 
		$params = $this->input->post(null, false);
		$isi_soal 		 		= $params['isi_soal'];
		$jawab_1 					= $params['jawab_1'];
		$jawab_2 					= $params['jawab_2'];
		$jawab_3 					= $params['jawab_3'];
		$jawab_4 			= $params['jawab_4'];
		$jawab_5 			= $params['jawab_5'];
		$kunci_jawaban 		= $params['kunci_jawaban'];
		$bobot 				= $params['bobot'];
		$id_soal			= $id;
		$sub_materi_id		= $params['sub_materi_id'];
		$pembahasan			= $params['pembahasan'];
		$pembahasan_video	= $params['pembahasan_video'];
		$status				= $params['status'];

		//set validation rules
		$this->form_validation->set_rules('isi_soal', 'Isi Soal', 'required');
		// $this->form_validation->set_rules('pembahasan', 'Pembahasan', 'required');
		$this->form_validation->set_rules('kunci_jawaban', 'Kunci Jawaban', 'required');
			
		//run the validation
		if ($this->form_validation->run() == FALSE) 
		{
			alert_error("Error", "Data gagal diubah");
			$this->load->view('pg_admin/latihansoal_detail_form', $data);
		}
		else 
		{
			//passing input value to Model
			$result = $this->model_adm->update_item_soal($isi_soal,$jawab_1,$jawab_2,$jawab_3,$jawab_4,$jawab_5,$kunci_jawaban,$pembahasan,$pembahasan_video,$id_soal,$bobot, $status);
			
			//set status waiting approval
			//$this->model_kurikulum->update_status_soal($id_soal, 0);
			$this->model_kurikulum->update_status_soal($id_soal, $status);
			
			//mulai edit atribut soal
			//#############################
			//#############################
			$this->model_atribut->hapus_atribut_soal($id_soal);
			
			$dataatribut = $this->model_atribut->fetch_all_atribut();
			foreach($dataatribut as $atribut){
				$checkatr = $this->input->post("checkatr", true);
				if(isset($checkatr[$atribut->id_atribut])){
					//echo "<p>" . $atribut->id_atribut;
					$this->model_atribut->insert_atribut_soal($id_soal, $checkatr[$atribut->id_atribut]);
				}
			}
			//#############################
			//#############################
			//echo $jawab_3;
			if(isset($params['flag-komentar'])){
				//ganti status semua komentar di soal terkait
				$this->model_komentar_soal->set_status_by_soal($id, 1);
			}
			alert_success("Sukses", "Data berhasil diubah");
			if($this->session->userdata('level') == "author"){
				redirect('pg_admin/author/list_soal/'.$sub_materi_id);
			}else{
				redirect('pg_admin/latihansoal/detail/'.$sub_materi_id, $data);
			}
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
				$result = $this->model_adm->delete_item_soal($id);
				
				alert_success('Sukses', "Data berhasil dihapus");
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
		
		alert_danger('Error', "Data gagal dihapus");
		redirect('pg_admin/materi');
	}

	
	public function proses_tambah()
	{
		//set the page title
		$data = array(
			'page_title' 	=> "Tambah Latihan Soal", 
			'form_action' => current_url(),
			'submateri'		=> $this->model_adm->fetch_all_materi()
			);

		//fetch input (make sure that the variable name is the same as column name in database!) 
		$params 				= $this->input->post(null, true);
		$sub_materi 		 		= $params['sub_materi'];

		$this->form_validation->set_rules('sub_materi', 'Sub Materi', 'required');
		
		//run the validation
		if ($this->form_validation->run() == FALSE) 
		{
			alert_error("Error", "Data gagal ditambahkan");
			$this->load->view('pg_admin/latihansoal_form', $data);
		}
		else 
		{
			//passing input value to Model
			$result = $this->model_adm->add_latihan_soal($sub_materi);
			alert_success("Sukses", "Data berhasil ditambahkan");
			redirect('pg_admin/latihansoal');
			// echo "Status Insert: " . $result;
		}	
	}
	
	
	public function proses_ubah($id)
	{
		//set the page title
		$data = array(
			'page_title' 	=> "Tambah Soal", 
			'form_action' => current_url() . "?id=$id"
			);

		//fetch input (make sure that the variable name is the same as column name in database!) 
		$params = $this->input->post(null, true);
		$kategori 		 			= $params['kategori_materi'];
		$mapel_id 					= $params['nama_mapel'];
		$materi_pokok_id		= $params['materi_pokok'];
		$nama_sub_materi 		= $params['judul_materi'];
		$isi_materi 	 			= $params['konten_materi'];
		$gambar_materi	 		= $params['gambar_materi']; 
		$tanggal	 					= $params['tanggal_post']; 
		$waktu	 						= $params['waktu_post']; 

		//run the validation
		if ($this->form_validation->run() == FALSE) 
		{
			alert_error("Error", "Data gagal ditambahkan");
			$this->load->view('pg_admin/materi_form', $data);
		}
		else 
		{
			//passing input value to Model
			$result = $this->model_adm->add_materi($kategori, $mapel_id, $materi_pokok_id, $nama_sub_materi, $isi_materi, $gambar_materi, $tanggal, $waktu);
			alert_success("Sukses", "Data berhasil ditambahkan");
			redirect('pg_admin/materi');
			// echo "Status Insert: " . $result;
		}	
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

	function ajax_select_sub_materi()
	{
		$id = $this->input->post('id', true) ? $this->input->post('id', true) : null;
		
		if($id)
		{
			$dynamic_options = $this->model_adm->fetch_submateri_by_materi_pokok($id);

			if($dynamic_options){
				$no = 1;
				foreach ($dynamic_options as $item) {
					echo "<option value=''></option>";
					echo "<option value='" . $item->id_sub_materi . "'> $no". ". " ." $item->nama_sub_materi </option>";
					$no++;
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

}
