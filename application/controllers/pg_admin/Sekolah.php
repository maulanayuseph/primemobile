<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sekolah extends CI_Controller {

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
		$this->load->model('model_psep');
		$this->load->model('model_kesiswaan');
		$this->load->model('model_voucher');
		$this->load->model('model_pg');
		$this->load->model('model_aktivasi_psep');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->model_security->is_logged_in();
  }

	public function index()
	{
		$data = array(
			'navbar_title' 	=> "Sekolah",
			'form_action' 	=> base_url() . $this->uri->slash_segment(1) . $this->uri->slash_segment(2),
			'table_data' 		=> $this->model_adm->fetch_all_sekolah()
			);

		$this->load->view('pg_admin/sekolah', $data);
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
					'navbar_title'		=> "Manajemen Sekolah",
					'page_title' 			=> "Tambah Sekolah",
					'form_action' 		=> current_url(),
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
						$this->load->view('pg_admin/sekolah_form', $data);
					}
					break;
				
				case 'ubah':
					//Passing id value from GET '?id' to variable '$id'
					$id = $this->input->get('id') ? $this->input->get('id') : null ;
					
					$data = array(
					'navbar_title'		=> "Manajemen Sekolah",
					'page_title' 			=> "Ubah Sekolah",
					'form_action' 		=> current_url() . "?id=$id",
					'select_jenjang' 	=> $this->model_adm->fetch_options_jenjang(),
					'select_provinsi' => $this->model_adm->fetch_options_provinsi(),
					'select_kota' 		=> $this->model_adm->fetch_options_kota()
					);

					//Redirect to kelas if id is not exist
					if(!$id)
					{
						redirect('pg_admin/sekolah');
					}
					else 
					{
						//Calling values from database by id and pass them to View
						//fetching kelas by id
						$data['data'] = $this->model_adm->fetch_sekolah_by_id($id);

						//Form submit handler. See if the user is attempting to submit a form or not
						if($this->input->post('form_submit')) 
						{
							//Form is submitted. Now routing to proses_tambah method
							$this->proses_ubah($id);
						}
						else 
						{
							//No form is submitted. Displaying the form page
							$this->load->view('pg_admin/sekolah_form', $data);
						}
					}
					break;

				case 'import':
					$data = array(
					'navbar_title'		=> "Manajemen Sekolah",
					'page_title' 			=> "Import Data Sekolah",
					'form_action' 		=> current_url()
					);

					//Form materi submit handler. See if the user is attempting to submit a form or not
					if($this->input->post('form_submit')) 
					{
						//Form is submitted. Now routing to proses_tambah method
						$this->proses_import();

					}
					else 
					{
						//No form is submitted. Displaying the form page
						$this->load->view('pg_admin/sekolah_import', $data);
					}
					break;

				
				default:
					redirect('pg_admin/sekolah');
					break;
			}
		}
		else
		{
			redirect('pg_admin/sekolah');
		}

	}

	public function proses_tambah()
	{
		//set the page title
		$data = array(
			'page_title' 			=> "Tambah Sekolah", 
			'form_action' 		=> current_url(),
			'select_jenjang' 	=> $this->model_adm->fetch_options_jenjang(),
			'select_provinsi' => $this->model_adm->fetch_options_provinsi(),
			'select_kota' 		=> $this->model_adm->fetch_options_kota()

			);

		//fetch input (make sure that the variable name is the same as column name in database!) 
		$params = $this->input->post(null, true);
		$nama_sekolah 	= $params['nama_sekolah'];
		$jenjang				= $params['jenjang'];
		$email					= $params['email'];
		$telepon				= $params['telepon'];
		$kota						= $params['kota'];
		$alamat_sekolah	= $params['alamat'];

		//run the validation
		if ($this->form_validation->run() == FALSE) 
		{
			alert_error("Error", "Data gagal ditambahkan");
			$this->load->view('pg_admin/sekolah_form', $data);
		}
		else 
		{
			//passing input value to Model
			$result = $this->model_adm->add_sekolah($nama_sekolah, $jenjang, $email, $telepon, $kota, $alamat_sekolah);
			alert_success("Sukses", "Data berhasil ditambahkan");
			redirect('pg_admin/sekolah');
			// echo "Status Insert: " . $result;
		}	
	}

	public function proses_ubah($id)
	{
		//set the page title
		$data = array(
			'page_title' 			=> "Ubah Sekolah",
			'form_action' 		=> current_url(). "?id=$id",
			'select_jenjang' 	=> $this->model_adm->fetch_options_jenjang(),
			'select_provinsi' => $this->model_adm->fetch_options_provinsi(),
			'select_kota' 		=> $this->model_adm->fetch_options_kota()
			);

		//fetch input (make sure that the variable name is the same as column name in database!) 
		$params = $this->input->post(null, true);
		$nama_sekolah 	= $params['nama_sekolah'];
		$jenjang				= $params['jenjang'];
		$email					= $params['email'];
		$telepon				= $params['telepon'];
		$kota						= $params['kota'];
		$alamat_sekolah	= $params['alamat'];

		//run the validation
		if ($this->form_validation->run() == FALSE) 
		{
			alert_error("Error", "Data gagal diubah");
			$this->load->view('pg_admin/sekolah_form', $data);
		}
		else 
		{
			//passing input value to Model
			$result = $this->model_adm->update_sekolah($id, $nama_sekolah, $jenjang, $email, $telepon, $kota, $alamat_sekolah);
			alert_success("Sukses", "Data berhasil diubah");
			redirect('pg_admin/sekolah');
			// echo "Status Update: " . $result;
		}	
	}

	public function proses_import()
	{
		$data = array(
			'page_title' 			=> "Import Data Sekolah",
			'form_action' 		=> current_url()
			);

		$this->upload_config();

		if (!$this->upload->do_upload('import_data')) 
		{
			$errors = array('error' => $this->upload->display_errors());
			alert_error("Error", "Proses import data gagal");
			$this->load->view('pg_admin/sekolah_import', $data);
		}
		else
		{
			$this->load->library(array('PHPExcel', 'PHPExcel/IOFactory'));

			$media = $this->upload->data();
      $data_sekolah  = array();
      $inputFileName = 'assets/uploads/excel_files/'.$media['file_name'];

     	try {
     		$inputFileType = IOFactory::identify($inputFileName);
        $objReader     = IOFactory::createReader($inputFileType);
        $objPHPExcel   = $objReader->load($inputFileName);
      } 
      catch(Exception $e) {
        die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
      }

      $sheet = $objPHPExcel->getSheet(0);
      $highestRow = $sheet->getHighestRow();
      $highestColumn = $sheet->getHighestColumn();

      for ($row = 2; $row <= $highestRow; $row++)
      { //  Read a row of data into an array                 
        $rowData = $sheet->rangeToArray(
        	'A' . $row . ':' . $highestColumn . $row,
          NULL,
          TRUE,
          FALSE
          );
        //Sesuaikan dengan nama kolom tabel di database                                
         if(!empty($rowData[0][0]) && !empty($rowData[0][1]))
         {
	         $data_sekolah[] = array(
	            "nama_sekolah"		=> $rowData[0][0],
	            "jenjang"					=> strtoupper($rowData[0][1]),
	            "alamat_sekolah"	=> $rowData[0][2],
	            "kota_id"					=> $rowData[0][3],
	            "email"						=> $rowData[0][4],
	            "telepon"					=> $rowData[0][5]
	        );
         }
             
      }

      $import = $this->model_adm->import_sekolah($data_sekolah);
      if($import){
      	alert_success('Sukses', "Data berhasil diimport!");
      }
    	redirect('pg_admin/sekolah');
      // echo "<pre>";
      // echo print_r($data_sekolah);
      // echo "</pre>";
      // die();
      //
      // delete_files($media['file_path']);

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
				$result = $this->model_adm->delete_sekolah($id);
				
				alert_success('Sukses', "Data berhasil dihapus");
				redirect('pg_admin/sekolah');
			}
		}
		
		alert_danger('Error', "Data gagal dihapus");
		redirect('pg_admin/sekolah');
	}

	function ajax_select_kota()
  {
    $id = $this->input->post('id', true) ? $this->input->post('id', true) : null;
    
    if($id)
    {
      $dynamic_options = $this->model_adm->fetch_kota_by_provinsi($id);

      if($dynamic_options){
        echo "<option value=''></option>";
        foreach ($dynamic_options as $item) {
          echo "<option value='" . $item->id_kota . "'> $item->nama_kota </option>";
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

function ajax_kota($idprovinsi){
	$datakota = $this->model_adm->fetch_kota_by_provinsi($idprovinsi);
	echo "<option value=''>-- Pilih Kota/Kabupaten --</option>";
	foreach($datakota as $item){
		echo "<option value='" . $item->id_kota . "'> $item->nama_kota </option>";
	}
}

function ajax_sekolah($idkota){
	$datasekolah = $this->model_adm->fetch_sekolah_by_kota($idkota);
	echo "<option value=''>-- Pilih Sekolah --</option>";
	foreach($datasekolah as $sekolah){
		echo "<option value='". $sekolah->id_sekolah ."'>$sekolah->nama_sekolah</option>";
	}
}

function ajax_kelas($idsekolah){
	$datakelas = $this->model_psep->fetch_kelas_paralel_by_sekolah($idsekolah);
	echo "<option value=''>-- Pilih Kelas --</option>";
	foreach($datakelas as $kelas){
		echo "<option value='". $kelas->id_kelas_paralel ."'>" . $kelas->kelas_paralel . "</option>";
	}
}

function ajax_tahun($idsekolah){
	$datatahun = $this->model_psep->fetch_tahun_ajaran_by_sekolah($idsekolah);
	echo "<option value=''>-- Pilih Tahun Ajaran --</option>";

	foreach($datatahun as $tahun){
		echo "<option value='". $tahun->id_tahun_ajaran ."'>" . $tahun->tahun_ajaran . "</option>";
	}
}

	private function upload_config()
	{
		// $fileName = date("dmy_Hi")."_".$_FILES['import_data']['name'];
		$fileName = 'latest_upload';
	 	$config['upload_path']      = 'assets/uploads/excel_files';
    $config['file_name'] 				= $fileName;
    $config['allowed_types']    = 'xls|xlsx|csv';
    $config['max_size']         = 10000;
    $config['overwrite'] 			  = TRUE;

    $this->load->library('upload');
    $this->upload->initialize($config);
	}

	private function form_validation_rules()
	{
		//set validation rules for each input
		$this->form_validation->set_rules('nama_sekolah', 'Nama Sekolah', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('kota', 'Kota', 'trim|required');
		$this->form_validation->set_rules('jenjang', 'Jenjang', 'trim|required');
		
		//set custom error message
		$this->form_validation->set_message('required', '%s tidak boleh kosong');
	}

function import_siswa(){
	$data = array(
		'select_provinsi' 	=> $this->model_adm->fetch_options_provinsi(),
		'judul'				=> "import data siswa"
	);
	$this->load->view("pg_admin/sekolah/import_siswa", $data);
}

function proses_import_siswa(){
	$this->load->library('csvimport');
	$config['upload_path'] 		= 'assets/uploads/siswa/csv/';
	$config['allowed_types'] 	= 'csv';
	$config['max_size'] 		= '100000000';

	$this->load->library('upload', $config);

	if(!$this->upload->do_upload()) {
		alert_error('error', $this->upload->display_errors());
		
	}else{
		$file_data = $this->upload->data();
		$file_path = 'assets/uploads/siswa/csv/'.$file_data['file_name'];
		if ($this->csvimport->get_array($file_path)) {
			$csv_array = $this->csvimport->get_array($file_path);

			$params 			= $this->input->post(null, true);
			$idsekolah 			= $params['sekolah'];
			$idkelasparalel 	= $params['kelas'];
			$idtahunajaran 		= $params['tahun'];
			$datakelas 			= $this->model_psep->fetch_kelas_paralel_by_id($idkelasparalel, $idsekolah);
			$idkelas 			= $datakelas->id_kelas;
			foreach($csv_array as $row){
				//echo "<p>" . $row["nama"];
				//cek email apakah sudah ada yang punya
				if($row['email'] !== ""){
					$cekemail = $this->model_kesiswaan->cek_email($row['email']);
					if($cekemail > 0){
						alert_error('error', 'email ' . $row["email"] . ' sudah ada yang memakai, silahkan menggunakan email lain');
						redirect("pg_admin/sekolah/import_siswa");
					}
				}
				//buatkan akun login
				$this->model_kesiswaan->add_login_siswa($row['nama'], $row['email'], $row['telepon'], $row['telepon_ortu'], $row['nama_ortu'], $idsekolah, $idkelas, $idkelasparalel, $idtahunajaran);
			}
			alert_success('success', 'berhasil');
			redirect("pg_admin/sekolah/import_siswa");
		}else{
			alert_error('error', 'Error Import from CSV');
		}

	}
}

function aktivasi_psep(){
	$url = "http://dealership.primemobile.co.id/api/all_dealer";
	$data = array(
		'select_provinsi' 	=> $this->model_adm->fetch_options_provinsi(),
		'judul'				=> "Aktivasi Siswa PSEP",
		'datadealer'		=> json_decode($this->curl_get_contents($url), true),
		'dataevent'			=> $this->model_kesiswaan->fetch_event_berlangsung()
	);
	
	$this->load->view("pg_admin/transaksi_psep", $data);
}

function daftar_siswa(){
	$data = array(
		'select_provinsi' 	=> $this->model_adm->fetch_options_provinsi(),
		'judul'				=> "Aktivasi Siswa PSEP"
	);
	$this->load->view("pg_admin/psep_siswa", $data);
}

function ajax_daftar_siswa($idsekolah = null, $idkelasparalel = null, $idtahunajaran = null){
	if($idtahunajaran !== null and $idsekolah !== null and $idkelasparalel !== null){
		$data = array(
			"datasiswa"	=> $this->model_psep->fetch_siswa_by_kelasparalel_and_tahunajaran($idsekolah, $idkelasparalel, $idtahunajaran)
		);
		$this->load->view("pg_admin/ajax_list_siswa_psep", $data);
	}
}

function ajax_pembelian_dealer($iddealer){
	$url = "http://dealership.primemobile.co.id/api/penjualan_dealer?id_dealer=" . $iddealer;
	$jual  = json_decode($this->curl_get_contents($url), true);

	echo "<option value=''>-- Pilih Kode Penjualan --</option>";
	foreach($jual['data'] as $data){
		?>
		<option value="<?php echo $data['id_penjualan'];?>"><?php echo $data['nama_customer'];?> (<?php echo $data['no_tagihan'];?>)</option>
		<?php
	}
}

function ajax_approval_psep($iddealer){
	$url = "http://dealership.primemobile.co.id/api/psep_dealer?dealer_id=" . $iddealer;
	$jual  = json_decode($this->curl_get_contents($url), true);

	if($jual['status']){
		echo "<option value=''>-- Pilih Kode Penjualan --</option>";
	foreach($jual['data'] as $data){
		?>
		<option value="<?php echo $data['id_psep_kuota_log'];?>">
			<?php
				//cari sekolah
				$sekolah 	= $this->model_aktivasi_psep->fetch_sekolah_by_id($data['sekolah_id']);
				$paket 		= $this->model_aktivasi_psep->fetch_paket_by_id($data['paket_id']);

				echo $sekolah->nama_sekolah . " Aktivasi PSEP " .  $paket->durasi . " Bulan" . " (".$data['jumlah'].")";
			?>
		</option>
		<?php
	}
	}else{
		echo "<option value=''>-- Pilih Kode Penjualan --</option>";
	}
}

function ajax_penjualan_event($iddealer){

	$url = "http://dealership.primemobile.co.id/api/penjualan_event_dealer?id_dealer=" . $iddealer;
	$jual  = json_decode($this->curl_get_contents($url), true);

	echo "<option value=''>-- Pilih Kode Penjualan --</option>";
	foreach($jual['data'] as $data){
		?>
		<option value="<?php echo $data['id_penjualan'];?>"><?php echo $data['nama_customer'];?> (<?php echo $data['no_tagihan'];?>)</option>
		<?php
	}
}

function proses_aktivasi_psep(){
	$params 			= $this->input->post(null, true);
	$sekolah 			= $params['sekolah'];
	$kelas 				= $params['kelas'];
	$tahunajaran 		= $params['tahun'];
	$iddealer 			= $params['iddealer'];
	$idpembelian 		= $params['idpembelian'];
	$tipe 				= $params['tipe'];
	$idevent			= $params['idevent'];
	//echo $idpembelian;

	$infokelas			= $this->model_psep->fetch_kelas_paralel_by_id($kelas, $sekolah);
	$datasiswa			= $this->model_psep->fetch_siswa_by_kelasparalel_and_tahunajaran2($sekolah, $kelas, $tahunajaran);

	if($tipe == 0){
		$url = "http://dealership.primemobile.co.id/api/penjualan_voucher?id_penjualan=" . $idpembelian;
		$apivoucher = json_decode($this->curl_get_contents($url), true);
	}elseif($tipe == 1){
		//cek dulu apakah approval aktivasi PSEP benar2 milik sekolah tersebut 
		$url = "http://dealership.primemobile.co.id/api/psep_dealer?dealer_id=" . $iddealer;
		$jual  = json_decode($this->curl_get_contents($url), true);

		if($jual['status']){
			foreach($jual['data'] as $data){
				if($data['id_psep_kuota_log'] == $idpembelian){
					if($sekolah !== $data['sekolah_id']){
						$respon = array(
							'message'	=> 'sekolah tidak sama',
							'status'	=> 'failed'
						);
						$data = json_encode($respon);
						echo $data;
						return false;
					}
				}
			}
			$url = "http://dealership.primemobile.co.id/api/psep_voucher?id_psep_kuota_log=" . $idpembelian;
			$apivoucher = json_decode($this->curl_get_contents($url), true);
		}else{
			$respon = array(
				'status'	=> 'failed'
			);
			$data = json_encode($respon);
			echo $data;
			return false;
		}
	}elseif($tipe == 2){
		$url = "http://dealership.primemobile.co.id/api/penjualan_voucher?id_penjualan=" . $idpembelian;
		$apivoucher = json_decode($this->curl_get_contents($url), true);
	}
	
	$x = 0;
	foreach($apivoucher['data'] as $vc){
		//cek dulu apakah vc sudah ada di paket_aktif
		$cekpaketaktif = $this->model_voucher->cek_paket_aktif_by_voucher($vc['kode_voucher']);
		if($cekpaketaktif == 0){
			foreach($datasiswa as $siswa){
				$tanggalsekarang = date('Y-m-d');
				$cekaktivasi = $this->model_voucher->fetch_existing_aktivation($siswa->id_siswa, $tanggalsekarang);

				if($tipe == 1){
					if($cekaktivasi !== null){
						$kodepaket = $cekaktivasi->kode_paket;
					}else{
						$kodepaket = "nope";
					}
				}else{
					$kodepaket = "nope";
				}
				

				if($cekaktivasi == null or $kodepaket == "PSEP"){
					$cekpaketaktif2 = $this->model_voucher->cek_paket_aktif_by_voucher($vc['kode_voucher']);
					if($cekpaketaktif2 == 0){
					    $carivoucher = $this->model_voucher->check_voucher_by_kode($vc['kode_voucher']);
					
    					$voucher 		= $this->model_voucher->check_voucher_by_aktivasi($carivoucher->no_aktivasi);
    					
    						$now = new DateTime(null);
    						//echo "<p>" . $carivoucher->kode_voucher;
    						//echo "<p>" . $kodevoucher;
    						//echo "<p>" . $idpembelian;
    
    						// echo 'ada bo! '.($voucher->tipe == 0 ? 'reguler' : 'premium').' '.$voucher->durasi.' bulan';
    						
    						$data_aktivasi = array(
    
    							'id_siswa' 		=> $siswa->id_siswa,
    
    							'id_kelas' 		=> $infokelas->id_kelas,
    
    							'id_paket' 		=> $voucher->id_paket,
    
    							'isaktif'		=> 1, //diaktifkan
    							
    							'kode_voucher'	=> $vc['kode_voucher']
    
    							);
    							
    						//cari apakah user ada aktivasi sebelumnya atau tidak, jika ada, ambil tanggal terakhir dari aktivasi yang sudah ada
    						$tanggalsekarang = date('Y-m-d');
    						$cekaktivasi = $this->model_voucher->fetch_existing_aktivation($siswa->id_siswa, $tanggalsekarang);

    						if($tipe == 1){
								if($cekaktivasi !== null){
									$kodepaket = $cekaktivasi->kode_paket;
								}else{
									$kodepaket = "nope";
								}
							}else{
								$kodepaket = "nope";
							}

							if($tipe !== 2){
								$data_aktivasi['timestamp'] = $now->format("Y-m-d H:i:00");
								if($cekaktivasi !== null and $kodepaket !== "PSEP"){
    
	    							$now = new DateTime($cekaktivasi->expired_on);
	    							$now->format("Y-m-d H:i:00");
	    							$now->add(new DateInterval('P'.$vc['durasi'].'M'));
	    							$data_aktivasi['expired_on'] = $now->format("Y-m-d H:i:00");
	    							//echo $exp;
	    							//return false;
	    						}else{
	    							$now->add(new DateInterval('P'.$vc['durasi'].'M'));
	    							$data_aktivasi['expired_on'] = $now->format("Y-m-d H:i:00");
	    							//echo $now;
	    							//return false;
	    						}
							}else{
								//cari tanggal event untuk dijadikan  interval paket aktif

								$fetchevent = $this->model_kesiswaan->fetch_event_by_id($idevent);

								$data_aktivasi['timestamp'] = $fetchevent->start_date;
								$data_aktivasi['expired_on'] = $fetchevent->end_date;
							}
    						
    						$result 		= $this->model_voucher->add_paket_aktif($data_aktivasi);
    						$set_aktif 	= $this->model_voucher->set_status_aktivasi($carivoucher->no_aktivasi); 
    						

    						//edit kelas di tabel siswa sesuai dengan aktivasi
    						$this->model_voucher->edit_kelas_siswa($siswa->id_siswa, $infokelas->id_kelas);
    						
    						//$kodevoucher = $carivoucher->kode_voucher;
					}
					
				}
				$x++;
			}
		}
	}
	$respon = array(
		'status'	=> 'success'
	);
	$data = json_encode($respon);
	echo $data;
	return false;
}
function curl_get_contents($url){
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}

function download_akun(){
	$params 			= $this->input->post(null, true);
	$idsekolah 			= $params['sekolah'];
	$idkelasparalel 	= $params['kelas'];
	$idtahunajaran 		= $params['tahun'];


	$infosekolah = $this->model_psep->fetch_sekolah_by_id($idsekolah);

	$kelasparalel = $this->model_psep->fetch_kelas_paralel_by_id($idkelasparalel, $idsekolah);

	$tahunajaran = $this->model_psep->fetch_tahun_ajaran_by_id($idtahunajaran, $idsekolah);


	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("PRIME MOBILE")->setTitle("Prime Mobile");
	
	$objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
    $objget = $objPHPExcel->getActiveSheet();  //inisiasi get object
	
	$objget->setTitle('Sample Sheet'); //sheet title

	$objset->setCellValue('A1', $infosekolah->nama_sekolah);
	$objset->setCellValue('A2', $kelasparalel->kelas_paralel . " " . $tahunajaran->tahun_ajaran);


	$datasiswa = $this->model_psep->fetch_siswa_by_kelasparalel_and_tahunajaran($idsekolah, $idkelasparalel, $idtahunajaran);

	$objset->setCellValue('A4', "Nama Siswa");
	$objset->setCellValue('B4', "Username");
	$objset->setCellValue('C4', "Kelas");
	$objset->setCellValue('D4', "Tahun Ajaran");
	$objset->setCellValue('E4', "Voucher");
	$objset->setCellValue('F4', "Expired On");

	$x = 5;
	$tanggalsekarang = date('Y-m-d');
	foreach($datasiswa as $siswa){
		$objset->setCellValue('A'.$x, $siswa->nama_siswa);

		//cari username siswa
		$datalogin = $this->model_pg->get_data_user($siswa->id_siswa);

		$objset->setCellValue('B'.$x, $datalogin->username);
		$objset->setCellValue('C'.$x, $siswa->kelas_paralel);
		$objset->setCellValue('D'.$x, $siswa->tahun_ajaran);

		$cekaktivasi = $this->model_voucher->fetch_existing_aktivation($siswa->id_siswa, $tanggalsekarang);

			if($cekaktivasi !== null){
				$objset->setCellValue('E'.$x, $cekaktivasi->kode_voucher);
				$objset->setCellValue('F'.$x, $cekaktivasi->expired_on);
			}else{
				$objset->setCellValue('E'.$x, "-");
				$objset->setCellValue('F'.$x, "-");
			}
		$x++;
	}

	$objPHPExcel->setActiveSheetIndex(0);
	$filename = str_replace("/", "-", "Akun Siswa " . $kelasparalel->kelas_paralel . " " . $tahunajaran->tahun_ajaran . " " . $infosekolah->nama_sekolah .".xls");
	   
	  header('Content-Type: application/vnd.ms-excel'); //mime type
	  header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	  header('Cache-Control: max-age=0'); //no cache

	$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');                
	$objWriter->save('php://output');
}

//fungsi baru untuk hapus data siswa
function hapus_siswa(){
	$params 	= $this->input->post(null, true);
	$idsiswa 	= $params['idsiswa'];

	$siswa 		= $this->model_kesiswaan->fetch_siswa_by_id($idsiswa);

	//hapus login_siswa
	$this->model_kesiswaan->hapus_login($siswa->id_login);
	//hapus siswa_psep
	$this->model_kesiswaan->hapus_siswa_psep($idsiswa);
	//hapus siswa
	$this->model_kesiswaan->hapus_siswa($idsiswa);

	echo $idsiswa;
}
//end fungsi hapus siswa


function detail_penerbitan($iddealer, $tipe, $idpenerbitan){
	if($tipe == 0 or $tipe == 2){
		$url = "http://dealership.primemobile.co.id/api/penjualan_voucher?id_penjualan=" . $idpenerbitan;
		$apivoucher = json_decode($this->curl_get_contents($url), true);

		$urlpenerbitan = "http://dealership.primemobile.co.id/api/penjualan_dealer?id_dealer=" . $iddealer;
		$penerbitan  	= json_decode($this->curl_get_contents($urlpenerbitan), true);
	}elseif($tipe == 1){
		$url = "http://dealership.primemobile.co.id/api/psep_voucher?id_psep_kuota_log=" . $idpenerbitan;
		$apivoucher = json_decode($this->curl_get_contents($url), true);

		$urlpenerbitan = "http://dealership.primemobile.co.id/api/psep_dealer?dealer_id=" . $iddealer;
		$penerbitan  	= json_decode($this->curl_get_contents($urlpenerbitan), true);
	}

	$jumlahvoucher = 0;
	$terpakai = 0;
	$tidakterpakai = 0;
	foreach($apivoucher['data'] as $voucher){
		$jumlahvoucher++;

		$cekpaketaktif = $this->model_voucher->cek_paket_aktif_by_voucher($voucher['kode_voucher']);
		if($cekpaketaktif > 0){
			$terpakai++;
		}else{
			$tidakterpakai++;
		}
	}


	$data = array(
		'judul'				=> "Detail Penerbitan Voucher",
		'datavoucher'		=> $apivoucher,
		'penerbitan'		=> $penerbitan,
		'tipe'				=> $tipe,
		'idpenerbitan'		=> $idpenerbitan,
		'jumlahvoucher'		=> $jumlahvoucher,
		'terpakai'			=> $terpakai,
		'tidakterpakai'		=> $tidakterpakai
	);

	$this->load->view("pg_admin/psep/detail_penerbitan", $data);
}

function ajax_suspend_kelas(){
	$params = $this->input->post(null, true);
	$idkelasparalel = $params['idkelasparalel'];
	$idtahunajaran 	= $params['idtahunajaran'];
	$idsekolah 		= $params['idsekolah'];

	$datasiswa = $this->model_psep->fetch_siswa_by_kelasparalel_and_tahunajaran($idsekolah, $idkelasparalel, $idtahunajaran);

	foreach($datasiswa as $siswa){
		$this->model_kesiswaan->suspend_siswa($siswa->id_siswa);
	}
}

}
