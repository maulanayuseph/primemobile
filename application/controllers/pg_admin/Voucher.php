<?php 


/**
* 
*/
class Voucher extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->load->helper('alert_helper');
		$this->load->model('model_adm');
		$this->load->model('model_pembayaran');
		$this->load->model('model_paket');
		$this->load->model('model_security');
		$this->load->model('model_voucher');
		$this->model_security->is_logged_in();
		//$this->load->model('model_voucher');
	}
	
	function index(){
		$data = array(
			'navbar_title' 	=> "Voucher",
			'form_action' 	=> base_url() . $this->uri->slash_segment(1) . $this->uri->slash_segment(2),
			'kelas'			=> $this->model_voucher->get_kelas(),
			'table_data' 		=> $this->model_adm->fetch_all_voucher()
			);

		$this->load->view('pg_admin/voucher', $data);
	}
	
	function durasi($kodepaket){
		$caridurasi = $this->model_voucher->fetch_durasi($kodepaket);
		
		echo "<option value=''>Pilih Durasi..</option>";
		
		foreach($caridurasi as $durasi){
			echo "
				<option value='". $durasi->id_paket ."'>". $durasi->durasi ." Bulan</option>
			";
		}
	}
	
	function daftar($paket, $kelas){
		$carivoucher = $this->model_voucher->fetch_voucher_by_durasi_kelas($paket, $kelas);
		$no = 1; 
		foreach ($carivoucher as $item) 
		{
	  ?>
		<tr>
		  <td><?php echo $no;?></td>
		  <td><?php echo $item->kode_voucher;?></td>
		  <td><?php echo ($item->tipe == 0) ? 'Reguler' : 'Premium';?></td>
		  <td><?php echo $item->durasi;?> bulan</td>
		  <td><?php echo $item->alias_kelas;?></td>
		  <!-- <td><?php echo ($item->tipe == 0) ? $item->alias_kelas : 'Semua Kelas';?></td> -->
		  <td><?php echo $item->ket;?></td>
		  <td><?php
							if(strpos($item->status, '0')!==FALSE){
								echo "Available";
							}else{
								echo "Activated";
							}
					  ?>
		  </td>
			  <?php
			  $no++;
		}
	}
	
	function manajemen($aksi){
				//$aksi contains the value needed (tambah/ubah) to direct user to Add/Edit form
		if($aksi)
		{
			//Trigger form submission validation rules
			$this->form_validation_rules();

			switch ($aksi) {
				case 'tambah':
					$data = array(
					'navbar_title'	=> "Manajemen Paket",
					'page_title' 		=> "Tambah Paket",
					'form_action' 	=> current_url(),
					'paket_reguler' =>  $this->model_paket->get_paket_reguler(),
					'paket_premium' => $this->model_paket->get_paket_premium(),
					'data_kelas' 		=> $this->model_adm->fetch_all_kelas()
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
						$this->load->view('pg_admin/voucher_form', $data);
					}
					break;
				
				default:
					redirect('pg_admin/voucher');
					break;
			}
		}
		else
		{
			redirect('pg_admin/voucher');
		}
	}
	
	public function proses_tambah()
	{
		//set the page title
		$data = array(
			'page_title' 	=> "Tambah Paket", 
			'form_action' => current_url()
			);
		//fetch input (make sure that the variable name is the same as column name in database!) 
		$params = $this->input->post(null, true);
		$paket = $params['paket'];
		$kelas = $params['kelas'];
		$keterangan = $params['keterangan'];
		$jumlah = $params['jumlah'];

		//run the validation
		if ($this->form_validation->run() == FALSE) 
		{
			alert_error("Error", "Data gagal ditambahkan");
			$this->load->view('pg_admin/paket_form', $data);
		}
		else 
		{
			//passing input value to Model
			for($i = 1; $i <= $jumlah; $i++){
			$result = $this->model_adm->add_voucher($paket, $kelas, $keterangan);
			}
			alert_success("Sukses", "Data berhasil ditambahkan");

			redirect('pg_admin/voucher');

			// echo "Status Insert: " . $result;
		}	
	}
	
	function form_validation_rules()
	{
		//set validation rules for each input
		$this->form_validation->set_rules('paket', 'paket', 'trim|required');
		$this->form_validation->set_rules('kelas', 'kelas', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
		
		//set custom error message
		$this->form_validation->set_message('required', '%s tidak boleh kosong');
	}
	
	public function export(){
		$this->load->dbutil(); // call db utility library
		$this->load->helper('download'); // call download helper
		
		$params = $this->input->post(null, true);
		$durasi = $params['durasi'];
		$kelas = $params['kelas'];
		
        $ambildata = $this->model_voucher->fetch_voucher_by_durasi_kelas($durasi, $kelas);
         
            $objPHPExcel = new PHPExcel();
            // Set properties
            $objPHPExcel->getProperties()
                  ->setCreator("Fajar Trio Wijanarko") //creator
                    ->setTitle("Prime Generation");  //file title
 
            $objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
            $objget = $objPHPExcel->getActiveSheet();  //inisiasi get object
 
            $objget->setTitle('Sample Sheet'); //sheet title
             
            $objget->getStyle("A1:D1")->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '92d050')
                    ),
                    'font' => array(
                        'color' => array('rgb' => '000000')
                    )
                )
            );
 
            //table header
            $cols = array("A","B","C","D");
             
            $val = array("Kode Voucher ","Paket","Durasi","Kelas");
             
            for ($a=0;$a<4; $a++) 
            {
                $objset->setCellValue($cols[$a].'1', $val[$a]);
                 
                //Setting lebar cell
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25); // NAMA
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25); // ALAMAT
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Kontak
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Kontak
             
                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    )
                );
                $objPHPExcel->getActiveSheet()->getStyle($cols[$a].'1')->applyFromArray($style);
            }
             
            $baris  = 2;
            foreach ($ambildata as $frow){
                 
				 if($frow->tipe == 0){
					 $paket = "Reguler";
				 }else{
					 $paket = "Premium";
				 }
                //pemanggilan sesuaikan dengan nama kolom tabel
                $objset->setCellValue("A".$baris, $frow->kode_voucher);
                $objset->setCellValue("B".$baris, $paket);
                $objset->setCellValue("C".$baris, $frow->durasi . " Bulan"); 
                $objset->setCellValue("D".$baris, $frow->alias_kelas); 
                 
                //Set number value
                $objPHPExcel->getActiveSheet()->getStyle('C1:C'.$baris)->getNumberFormat()->setFormatCode('0');
                 
                $baris++;
            }
             
            $objPHPExcel->getActiveSheet()->setTitle('Data Export');
 
            $objPHPExcel->setActiveSheetIndex(0);  
            $filename = urlencode("Data".date("Y-m-d H:i:s").".xls");
               
              header('Content-Type: application/vnd.ms-excel'); //mime type
              header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
              header('Cache-Control: max-age=0'); //no cache
 
            $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');                
            $objWriter->save('php://output');
       
    }

}