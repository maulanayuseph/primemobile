<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

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
			'navbar_title' 	=> "Siswa",
			'form_action' 	=> base_url() . $this->uri->slash_segment(1) . $this->uri->slash_segment(2),
			'table_data' 		=> $this->model_adm->fetch_all_siswa()
			);

		$this->load->view('pg_admin/siswa', $data);
	}

	public function pendaftar()
	{
		$data = array(
			'navbar_title' 	=> "Pendaftar",
			'form_action' 	=> base_url() . $this->uri->slash_segment(1) . $this->uri->slash_segment(2),
			'table_data' 		=> $this->model_adm->fetch_siswa_pendaftar()
			);

		$this->load->view('pg_admin/siswa_pendaftar', $data);
	}

	public function aktif()
	{
		$data = array(
			'navbar_title' 	=> "Siswa Aktif",
			'form_action' 	=> base_url() . $this->uri->slash_segment(1) . $this->uri->slash_segment(2),
			'table_data' 		=> $this->model_adm->fetch_siswa_aktif()
			);

		$this->load->view('pg_admin/siswa_aktif', $data);
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
					'navbar_title'	=> "Manajemen Siswa",
					'page_title' 		=> "Tambah Siswa",
					'form_action' 	=> current_url(),
					'select_sekolah' 	=> $this->model_adm->fetch_all_sekolah(),
					'select_options' 	=> $this->model_adm->fetch_all_kelas(),
					'select_jenjang' 	=> $this->model_adm->fetch_options_jenjang(),
					'select_provinsi' => $this->model_adm->fetch_options_provinsi(),
					'select_kota' 		=> $this->model_adm->fetch_options_kota()
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
						$this->load->view('pg_admin/siswa_form', $data);
					}
					break;
				
				case 'ubah':
					//Passing id value from GET '?id' to variable '$id'
					$id = $this->input->get('id') ? $this->input->get('id') : null ;
					
					$data = array(
					'navbar_title'	=> "Manajemen Siswa",
					'page_title' 		=> "Ubah Siswa",
					'form_action' 	=> current_url() . "?id=$id",
					'data_siswa'		=> $this->model_adm->fetch_siswa_by_id($id),
					'select_sekolah' 	=> $this->model_adm->fetch_all_sekolah(),
					'select_options' 	=> $this->model_adm->fetch_all_kelas()
					);

					//Redirect to siswa if id is not exist
					if(!$id)
					{
						redirect('pg_admin/siswa');
					}
					else 
					{
						//Calling values from database by id and pass them to View
						//fetching siswa by id
						$data['data'] = $this->fetch_siswa_by_id($id);

						//Form submit handler. See if the user is attempting to submit a form or not
						if($this->input->post('form_submit')) 
						{
							//Form is submitted. Now routing to proses_tambah method
							$this->proses_ubah($id);
						}
						else 
						{
							//No form is submitted. Displaying the form page
							$this->load->view('pg_admin/siswa_form', $data);
						}
					}
					break;
				
				default:
					redirect('pg_admin/siswa');
					break;
			}
		}
		else
		{
			redirect('pg_admin/siswa');
		}

	}

	public function proses_tambah()
	{
		//set the page title
		$data = array(
			'page_title' 	=> "Pendaftaran Siswa", 
			'form_action' => current_url(),
			'select_sekolah' 	=> $this->model_adm->fetch_all_sekolah(),
			'select_options' 	=> $this->model_adm->fetch_all_kelas()
			);

		//fetch input (make sure that the variable name is the same as column name in database!) 
		$params = $this->input->post(null, true);
		$nama 		 			= $params['nama'] ? $params['nama'] : '';
		$email 		 			= $params['email'] ? $params['email'] : '' ;
		$telepon 		 		= $params['telepon'] ? $params['telepon'] : '';
		$telepon_ortu 	= $params['telepon_ortu'] ? $params['telepon_ortu'] : '';
		$alamat					= $params['alamat'] ? $params['alamat'] : '';
		$sekolah_id			= $params['sekolah'] ? $params['sekolah'] : '';
		$kelas					= $params['kelas'] ? $params['kelas'] : '';
		$tambah_sekolah	= $params['tambah_sekolah'] ? $params['tambah_sekolah'] : null;

		if(!empty($tambah_sekolah)) {
			$jenjang = $this->model_adm->fetch_kelas_by_id($kelas)->jenjang;
			$insert_id = $this->model_adm->add_quick_sekolah($tambah_sekolah, $jenjang);
			$sekolah_id = $insert_id;
		}

		//run the validation
		if ($this->form_validation->run() == FALSE) 
		{
			alert_error("Error", "Data gagal ditambahkan");
			$this->load->view('pg_admin/siswa_form', $data);
		}
		else 
		{
			//passing input value to Model
			$result = $this->model_adm->add_siswa($nama, $email, $telepon, $telepon_ortu, $alamat, $sekolah_id, $kelas);
			alert_success("Sukses", "Data berhasil ditambahkan");
			redirect('pg_admin/siswa');
			// echo "Status Insert: " . $result;
		}	
	}

	public function proses_ubah($id)
	{
		//set the page title
		$data = array(
			'page_title' 	=> "Ubah Data Siswa",
			'select_sekolah' 	=> $this->model_adm->fetch_all_sekolah(),
			'select_options' 	=> $this->model_adm->fetch_all_kelas(),
			'form_action' => current_url(). "?id=$id"
			);

		//fetch input (make sure that the variable name is the same as column name in database!) 
		$params = $this->input->post(null, true);
		$nama 		 			= $params['nama'] ? $params['nama'] : '';
		$email 		 			= $params['email'] ? $params['email'] : '' ;
		$telepon 		 		= $params['telepon'] ? $params['telepon'] : '';
		$telepon_ortu 	= $params['telepon_ortu'] ? $params['telepon_ortu'] : '';
		$alamat					= $params['alamat'] ? $params['alamat'] : '';
		$sekolah_id			= $params['sekolah'] ? $params['sekolah'] : '';
		$kelas					= $params['kelas'] ? $params['kelas'] : '';
		$tambah_sekolah	= $params['tambah_sekolah'] ? $params['tambah_sekolah'] : null;

		if(!empty($tambah_sekolah)) {
			$jenjang = $this->model_adm->fetch_kelas_by_id($kelas)->jenjang;
			$insert_id = $this->model_adm->add_quick_sekolah($tambah_sekolah, $jenjang);
			$sekolah_id = $insert_id;
		}
		
		//run the validation
		if ($this->form_validation->run() == FALSE) 
		{
			alert_error("Error", "Data gagal diubah");
			$this->load->view('pg_admin/siswa_form', $data);
		}
		else 
		{
			//passing input value to Model
			$result = $this->model_adm->update_siswa($id, $nama, $email, $telepon, $telepon_ortu, $alamat, $sekolah_id, $kelas);
			alert_success("Sukses", "Data berhasil diubah");
			redirect('pg_admin/siswa');
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
				$id 		= $this->input->post('hidden_row_id');
				$result = $this->model_adm->delete_siswa($id);
				
				alert_success('Sukses', "Data berhasil dihapus");
				redirect('pg_admin/siswa');
			}
		}
		
		alert_danger('Error', "Data gagal dihapus");
		redirect('pg_admin/siswa');
	}

	private function form_validation_rules()
	{
		//set validation rules for each input
		$this->form_validation->set_rules('nama', 'Nama Siswa', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('telepon', 'Telepon', 'trim|numeric|required');
		$this->form_validation->set_rules('telepon_ortu', 'Telepon Orang Tua', 'trim|numeric|required');
		$this->form_validation->set_rules('kelas', 'Kelas', 'trim|required');
		// $this->form_validation->set_rules('sekolah', 'Sekolah', 'trim|required');
		// $this->form_validation->set_rules('asal_sekolah', 'Asal Sekolah', 'trim|required');
		
		//set custom error message
		$this->form_validation->set_message('required', '%s tidak boleh kosong');
	}

	private function fetch_siswa_by_id($id)
	{
		$data 					= new stdClass();
		$table_data 		= $this->model_adm->fetch_siswa_by_id($id); 
		$table_fields 	= $this->model_adm->get_table_fields('siswa');
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

	function ajax_select_sekolah()
  {
    $id = $this->input->post('id', true) ? $this->input->post('id', true) : null;
  	$id="ALL"; //remove this if you want to select sekolah by kota
    
    if($id)
    {
      // $dynamic_options = $this->model_pg->fetch_sekolah_by_kota($id);
      $dynamic_options = $this->model_adm->fetch_all_sekolah($id);

      if($dynamic_options){
        echo "<option value='' disabled selected>Pilih Sekolah...</option>";
        foreach ($dynamic_options as $item) {
          echo "<option value='" . $item->id_sekolah . "'> $item->nama_sekolah </option>";
        }
      }
      else
      {
        echo "<option value='' disabled='disabled' selected>Data sekolah tidak ditemukan...</option>";
      }
    }
    else{
      return false;
    }
  }

	function ajax_select_kelas()
  {
    $id = $this->input->post('id', true) ? $this->input->post('id', true) : null;
    
    if($id)
    {
    	$sekolah = $this->model_adm->fetch_sekolah_by_id($id);
      $dynamic_options = $this->model_adm->fetch_kelas_by_jenjang($sekolah->jenjang);

      if($dynamic_options){
        foreach ($dynamic_options as $item) {
          echo "<option value=''></option>";
          echo "<option value='" . $item->id_kelas . "'> $item->alias_kelas </option>";
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

  function ajax_tambah_sekolah()
  {
    $result_id = 0;
    $id_kota = $this->input->post('id_kota');
    $jenjang = $this->input->post('jenjang');
    $sekolah = $this->input->post('sekolah');
    $email = $this->input->post('email');
    $telepon = $this->input->post('telepon');
    $alamat = $this->input->post('alamat');
    
    if(!empty($id_kota) AND !empty($jenjang) AND !empty($sekolah) AND !empty($email)) {
      //checking if nama sekolah is already exist
      $sekolah_found = $this->model_adm->check_sekolah_by_nama($sekolah);
      if(empty($sekolah_found)) {
        $result_id = $this->model_adm->add_sekolah($sekolah, $jenjang, $email, $telepon, $id_kota, $alamat);
      }
    }
    echo json_encode($result_id);
  }

}
