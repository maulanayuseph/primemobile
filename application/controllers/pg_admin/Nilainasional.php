<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilainasional extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct() {
			parent::__construct();
	}

	function importcsv()
	{
		$data = array(
			'title' 	=> "Import Nilai Nasional",
			'error' 	=> "",
		);

		$this->load->view('pg_admin/import_nn', $data);
	}

	function prosesimportcsv() 
	{
    $this->load->library('csvimport');
		$data['title'] = 'Import Nilai Nasional';
		$data['error'] = '';

		$config['upload_path'] 		= 'assets/uploads/csv/';
		$config['allowed_types'] 	= 'csv';
		$config['max_size'] 			= '100000';

		$this->load->library('upload', $config);


		if (!$this->upload->do_upload()) {
			$data['error'] = $this->upload->display_errors();

			$this->load->view('pg_admin/import_nn', $data);
		} else {

			$file_data = $this->upload->data();
			$file_path = 'assets/uploads/csv/'.$file_data['file_name'];
			
			if ($this->csvimport->get_array($file_path)) {
					$csv_array = $this->csvimport->get_array($file_path);
					foreach ($csv_array as $row) {
						$kode_prodi 	= $row['kode_prodi'];
						$nn 					= $row['nn'];
						$this->db->set('nn', $nn);
						$this->db->where('kode_prodi', $kode_prodi);
						$this->db->update('program_studi');
					}
					$this->session->set_flashdata('sukses', 'Csv Data Imported Succesfully');
					
					//unlink($file_path);
					
					redirect('pg_admin/nilainasional/importcsv');		
			} else {
					$data['error'] = "Error occured";
				
					$this->load->view('pg_admin/import_nn', $data);
			}
		}
	} 
	
}
