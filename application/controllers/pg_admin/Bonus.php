<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bonus extends CI_Controller {

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
		$data = array(
			'navbar_title' 	=> "Bonus",
			'form_action' 	=> base_url() . $this->uri->slash_segment(1) . $this->uri->slash_segment(2),
			'table_data' 		=> $this->model_adm->fetch_all_bonus_konten()
			);

		$this->load->view('pg_admin/bonus', $data);
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
					'navbar_title'	=> "Manajemen Bonus",
					'page_title' 		=> "Tambah Bonus",
					'form_action' 	=> current_url(),
					'select_options' 	=> $this->model_adm->fetch_all_kategori_bonus()
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
						$this->load->view('pg_admin/bonus_form', $data);
					}
					break;

				case 'ubah':
					//Passing id value from GET '?id' to variable '$id'
					$id = $this->input->get('id') ? $this->input->get('id') : null ;
					
					$data = array(
					'navbar_title'	=> "Manajemen Bonus",
					'page_title' 		=> "Ubah Bonus",
					'form_action' 	=> current_url() . "?id=$id",
					'select_options' 	=> $this->model_adm->fetch_all_kategori_bonus()
					);

					//Redirect to bonus if id is not exist
					if(!$id)
					{
						redirect('pg_admin/bonus');
					}
					else 
					{
						//Calling values from database by id and pass them to View
						//fetching bonus by id
						$data['data'] = $this->model_adm->fetch_bonus_konten_by_id($id);

						//Form submit handler. See if the user is attempting to submit a form or not
						if($this->input->post('form_submit')) 
						{
							//Form is submitted. Now routing to proses_tambah method
							$this->proses_ubah($id);
						}
						else 
						{
							//No form is submitted. Displaying the form page
							$this->load->view('pg_admin/bonus_form', $data);
						}
					}
					break;
				
				default:
					redirect('pg_admin/bonus');
					break;
			}
		}
		else
		{
			redirect('pg_admin/bonus');
		}

	}

	public function proses_tambah()
	{
		//set the page title
		$data = array(
			'page_title' 	=> "Tambah Bonus", 
			'form_action' => current_url(),
			'select_options' 	=> $this->model_adm->fetch_all_kategori_bonus()
			);
			
		if($_FILES['gambar']['name'] !== ""){
			$tipe 		 	= $this->cek_tipe($_FILES['gambar']['type']);
			$img_path	 	= "assets/uploads/bonus/";
			$namafile		= "bonus".md5(time()).$tipe;
			
			
			$config['upload_path']		= $img_path;
			$config['allowed_types']    = 'gif|jpg|png';
			$config['file_name'] 		= $namafile;
			
			$this->load->library('upload', $config);
			$this->upload->do_upload('gambar');
		}else{
			$namafile = "";
		}
		//fetch input (make sure that the variable name is the same as column name in database!) 
		$params = $this->input->post(null, true);
		$data_model = array(
						'kategori_id' 	=> $params['kategori_bonus'],
						'judul_konten' 	=> $params['judul_konten'],
						'url' 			=> $params['url_konten'],
						'poin' 			=> $params['poin'],
						'gambar'		=> $namafile
						);
		
		//run the validation
		if ($this->form_validation->run() == FALSE) 
		{
			alert_error("Error", "Data gagal ditambahkan");
			$this->load->view('pg_admin/bonus_form', $data);
		}
		else 
		{
			//passing input value to Model
			$result = $this->model_adm->add_bonus_konten($data_model);
			alert_success("Sukses", "Data berhasil ditambahkan");
			redirect('pg_admin/bonus');
			// echo "Status Insert: " . $result;
		}	
	}

	public function proses_ubah($id)
	{
		//set the page title
		$data = array(
			'page_title' 	=> "Ubah Bonus",
			'form_action' => current_url(). "?id=$id"
			);

		//fetch input (make sure that the variable name is the same as column name in database!) 
		$params = $this->input->post(null, true);
		
		if($_FILES['gambar']['name'] !== ""){
			$tipe 		 	= $this->cek_tipe($_FILES['gambar']['type']);
			$img_path	 	= "assets/uploads/bonus/";
			$namafile		= "bonus".md5(time()).$tipe;
			
			
			$config['upload_path']		= $img_path;
			$config['allowed_types']    = 'gif|jpg|png';
			$config['file_name'] 		= $namafile;
			
			$this->load->library('upload', $config);
			$this->upload->do_upload('gambar');
			
			
			$data_model = array(
							'kategori_id' => $params['kategori_bonus'],
							'judul_konten' => $params['judul_konten'],
							'url' => $params['url_konten'],
							'poin' => $params['poin'],
							'gambar'		=> $namafile
							);
		}else{
			$data_model = array(
							'kategori_id' => $params['kategori_bonus'],
							'judul_konten' => $params['judul_konten'],
							'url' => $params['url_konten'],
							'poin' => $params['poin'],
							);
		}
		

		//run the validation
		if ($this->form_validation->run() == FALSE) 
		{
			alert_error("Error", "Data gagal diubah");
			$this->load->view('pg_admin/bonus_form', $data);
		}
		else 
		{
			//passing input value to Model
			$result = $this->model_adm->update_bonus_konten($id, $data_model);
			alert_success("Sukses", "Data berhasil diubah");
			redirect('pg_admin/bonus');
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
        $id   = $this->input->post('hidden_row_id');
        $result = $this->model_adm->delete_bonus($id);
        
        alert_success('Sukses', "Data berhasil dihapus");
        redirect('pg_admin/bonus');
      }
    }
    
    alert_danger('Error', "Data gagal dihapus");
    redirect('pg_admin/bonus');
  }

	private function form_validation_rules()
	{
		//set validation rules for each input
		$this->form_validation->set_rules('kategori_bonus', 'Kategori Bonus', 'trim|required');
		$this->form_validation->set_rules('judul_konten', 'Judul Konten', 'trim|required');
		$this->form_validation->set_rules('poin', 'Nilai Poin', 'trim|numeric|required');
		$this->form_validation->set_rules('url_konten', 'URL File', 'trim|required');
		//set custom error message
		$this->form_validation->set_message('required', '%s tidak boleh kosong');
	}

	function ajax_select_kategori()
  {
    $dynamic_options = $this->model_adm->fetch_all_kategori_bonus();

    if($dynamic_options){
      echo "<option value='' disabled selected>Pilih Sekolah...</option>";
      foreach ($dynamic_options as $item) {
        echo "<option value='" . $item->id_kategori . "'> $item->kategori_bonus </option>";
      }
    }
    else
    {
      echo "<option value='' disabled='disabled' selected>Data kategori tidak ditemukan...</option>";
    }
  }

  function ajax_tambah_kategori()
  {
    $result_id = 0;
    $data_model = array(
    		'kategori_bonus' => $this->input->post('tambah_kategori')
    	);
    
    if(!empty($data_model['kategori_bonus'])) {
      //checking if nama sekolah is already exist
      $kategori_found = $this->model_adm->check_kategori_bonus($data_model['kategori_bonus']);
      if(empty($kategori_found)) {
        $result_id = $this->model_adm->add_bonus_kategori($data_model);
      }
    }
    echo json_encode($result_id);
  }
  
  private function cek_tipe($tipe)

	{

		if ($tipe == 'image/jpeg') 

			{ return ".jpg"; }

		

		else if($tipe == 'image/png') 

			{ return ".png"; }

		

		else 

			{ return false; }

	}

}
