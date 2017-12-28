<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materi_pokok extends CI_Controller {

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
			'navbar_title' 	=> "Materi Pokok",
			'form_action' 	=> base_url() . $this->uri->slash_segment(1) . $this->uri->slash_segment(2),
			'table_data' 		=> $this->model_adm->fetch_all_materi_pokok()
			);

		$this->load->view('pg_admin/materi_pokok', $data);
	}

	public function manajemen($aksi)
	{
		//$aksi contains the value needed (tambah/ubah) to direct user to Add/Edit form
		if($aksi)
		{
			//Trigger form submission validation rules
			$this->form_validation_rules();

			//Fetch select options from table in database

			switch ($aksi) {
				case 'tambah':
					$data = array(
					'navbar_title'		=> "Manajemen Materi Pokok",
					'page_title' 			=> "Tambah Materi Pokok",
					'form_action' 		=> current_url(),
					'select_options' 	=> $this->model_adm->fetch_options_materi_pokok()
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
						$this->load->view('pg_admin/materi_pokok_form', $data);
					}
					break;
				
				case 'ubah':
					//Passing id value from GET '?id' to variable '$id'
					$id = $this->input->get('id') ? $this->input->get('id') : null ;
					
					$data = array(
					'navbar_title'		=> "Manajemen Mata Pelajaran",
					'page_title' 			=> "Ubah Mata Pelajaran",
					'form_action' 		=> current_url() . "?id=$id",
					'select_options' 	=> $this->model_adm->fetch_options_materi_pokok()
					);

					//Redirect to kelas if id is not exist
					if(!$id)
					{
						redirect('pg_admin/materi_pokok');
					}
					else 
					{
						//Calling values from database by id and pass them to View
						//fetching kelas by id
						$data['data'] = $this->fetch_materi_pokok_by_id($id);

						//Form submit handler. See if the user is attempting to submit a form or not
						if($this->input->post('form_submit')) 
						{
							//Form is submitted. Now routing to proses_tambah method
							$this->proses_ubah($id);
						}
						else 
						{
							//No form is submitted. Displaying the form page
							$this->load->view('pg_admin/materi_pokok_form', $data);
						}
					}
					break;
				
				default:
					redirect('pg_admin/materi_pokok');
					break;
			}
		}
		else
		{
			redirect('pg_admin/materi_pokok');
		}

	}

public function proses_tambah()
	{
		//set the page title
		$data = array(
			'page_title' 			=> "Tambah Materi Pokok", 
			'form_action' 		=> current_url(),
			'select_options' 	=> $this->model_adm->fetch_options_materi_pokok()
			);

		//fetch input (make sure that the variable name is the same as column name in database!) 
		$params = $this->input->post(null, true);
		$mapel_id 		 			= $params['mata_pelajaran'];
		$nama_materi_pokok			= $params['materi_pokok'];
		$deskripsi_materi_pokok		= $params['deskripsi_materi_pokok'];
		$max 						= $this->model_adm->select_max('materi_pokok', 'urutan');
		$urutan 					= ($max->urutan + 1);
		$judulk13					= $params["judul_bab_k13"];
		$judulktsp					= $params["judul_bab_ktsp"];

		//run the validation
		if ($this->form_validation->run() == FALSE) 
		{
			alert_error("Error", "Data gagal ditambahkan");
			$this->load->view('pg_admin/materi_pokok_form', $data);
		}
		else 
		{
			//passing input value to Model
			$result = $this->model_adm->add_materi_pokok($mapel_id, $nama_materi_pokok, $judulk13, $judulktsp, $deskripsi_materi_pokok, $urutan);
			alert_success("Sukses", "Data berhasil ditambahkan");
			redirect('pg_admin/materi_pokok');
			// echo "Status Insert: " . $result;
		}	
	}

	public function proses_ubah($id)
	{
		//set the page title
		$data = array(
			'page_title' 	=> "Ubah Materi Pokok",
			'form_action' => current_url(). "?id=$id",
			'select_options' 	=> $this->model_adm->fetch_options_materi_pokok()
			);

		//fetch input (make sure that the variable name is the same as column name in database!) 
		$params = $this->input->post(null, true);
		$mapel_id 								= $params['mata_pelajaran'];
		$nama_materi_pokok 				= $params['materi_pokok'];
		$deskripsi_materi_pokok 	= $params['deskripsi_materi_pokok'];
		$judulk13					= $params["judul_bab_k13"];
		$judulktsp					= $params["judul_bab_ktsp"];

		//run the validation
		if ($this->form_validation->run() == FALSE) 
		{
			alert_error("Error", "Data gagal diubah");
			$this->load->view('pg_admin/materi_pokok_form', $data);
		}
		else 
		{
			//passing input value to Model
			//echo $judulk13. "<br>";
			//echo $judulktsp. "<br>";
			$result = $this->model_adm->update_materi_pokok($id, $mapel_id, $nama_materi_pokok, $judulk13, $judulktsp, $deskripsi_materi_pokok);
			alert_success("Sukses", "Data berhasil diubah");
			redirect('pg_admin/materi_pokok');
			//echo "Status Update: " . $result;
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
				$id 		= $this->input->post('hidden_row_id');
				$result = $this->model_adm->delete_materi_pokok($id);
				
				alert_success('Sukses', "Data berhasil dihapus");
				redirect('pg_admin/materi_pokok');
			}
		}
		
		alert_danger('Error', "Data gagal dihapus");
		redirect('pg_admin/materi_pokok');
	}

	function form_validation_rules()
	{
		//set validation rules for each input
		$this->form_validation->set_rules('mata_pelajaran', 'Mata Pelajaran', 'trim|required');
		$this->form_validation->set_rules('materi_pokok', 'Nama Materi Pokok', 'trim|required');
		
		//set custom error message
		$this->form_validation->set_message('required', '%s tidak boleh kosong');
	}

	function fetch_materi_pokok_by_id($id)
	{
		$data 					= new stdClass();
		$table_data 		= $this->model_adm->fetch_materi_pokok_by_id($id); 
		$table_fields 	= $this->model_adm->get_table_fields('materi_pokok', 'mata_pelajaran', 'kelas');
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

function sesuaikan_judul(){
	$datamapok = $this->model_adm->fetch_all_materi_pokok();
	
	foreach($datamapok as $mapok){
		$id 								= $mapok->id_materi_pokok;
		$mapel_id 							= $mapok->mapel_id;
		$nama_materi_pokok 					= $mapok->nama_materi_pokok;
		$judulk13 							= $mapok->judul_bab_k13;
		$judulktsp 							= $mapok->judul_bab_ktsp;
		$deskripsi_materi_pokok 			= $mapok->deskripsi_materi_pokok;
		
		$this->model_adm->update_materi_pokok($id, $mapel_id, $nama_materi_pokok, $nama_materi_pokok, $nama_materi_pokok, $deskripsi_materi_pokok);
	}
	
	echo "sukses";
}

}
