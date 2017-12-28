<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

	public function __construct()
  {
    parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('alert_helper');
		$this->load->model('model_adm');
		$this->load->model('model_security');
		$this->load->model('model_psep');
		$this->load->model('model_kesiswaan');
		$this->load->model('model_voucher');
		$this->load->model('model_pg');
		$this->load->model('model_aktivasi_psep');
		$this->load->model('model_adm_event');
		$this->load->model('model_dashboard');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->model_security->is_logged_in();
  }

function index(){
	$data = array(
		'dataevent'		=> $this->model_adm_event->fetch_all_event()
	);
	$this->load->view("pg_admin/event/index", $data);
}

function set_cbt($idevent){
	$data = array(
		"datacbt"	=> $this->model_adm_event->fetch_cbt_event(),
		"event"		=> $this->model_adm_event->fetch_event_by_id($idevent)
	);
	$this->load->view("pg_admin/event/set_cbt", $data);
}

function assign_cbt(){
	$params 	= $this->input->post(null, true);
	$idprofil 	= $params['idprofil'];
	$idevent 	= $params['idevent'];
	$operasi 	= $params['operasi'];

	if($operasi == "set"){
		$this->model_adm_event->assign_cbt_event($idevent, $idprofil);
	}elseif($operasi == "unset"){
		$this->model_adm_event->delete_cbt_event($idevent, $idprofil);
	}
	echo "sukses";
}

function jadwal_sekolah($idevent){
	$data = array(
		"datacbt"	=> $this->model_adm_event->fetch_cbt_by_event($idevent),
		"event"		=> $this->model_adm_event->fetch_event_by_id($idevent)
	);
	$this->load->view("pg_admin/event/set_jadwal", $data);
}


function ajax_tambah_jadwal($idevent, $idprofil){
	$data = array(
		"event"			=> $this->model_adm_event->fetch_event_by_id($idevent),
		"profil"		=> $this->model_adm_event->fetch_cbt_by_id($idprofil),
		"dataprovinsi"	=> $this->model_adm_event->fetch_provinsi()
	);
	$this->load->view("pg_admin/event/ajax_tambah_jadwal_sekolah", $data);
}

function ajax_kota_by_provinsi($idprovinsi){
	$datakota = $this->model_adm_event->fetch_kota_by_provinsi($idprovinsi);

	echo "<option value=''>-- Pilih Kota Sekolah --</option>";

	foreach($datakota as $kota){
		?>
		<option value="<?php echo $kota->id_kota;?>"><?php echo $kota->nama_kota;?></option>
		<?php
	}
}

function ajax_sekolah_by_kota($idkota, $idkelas){
	//cari jenjang kelas
	$jenjang = $this->model_adm_event->fetch_kelas_by_id($idkelas);

	$datasekolah = $this->model_adm_event->fetch_sekolah_by_kota_and_jenjang($idkota, $jenjang->jenjang);

	echo "<option value=''>-- Pilih Sekolah --</option>";

	foreach($datasekolah as $sekolah){
		?>
		<option value="<?php echo $sekolah->id_sekolah;?>"><?php echo $sekolah->nama_sekolah;?></option>
		<?php
	}
}

function proses_tambah_jadwal(){
	$params 	= $this->input->post(null, true);
	$idevent 	= $params['idevent'];
	$idsekolah 	= $params['idsekolah'];
	$idprofil 	= $params['idprofil'];

	$tanggalmulai	= new DateTime($params['startdate']);
	$tanggalakhir	= new DateTime($params['enddate']);
	$startdate 		= date_format($tanggalmulai, 'Y-m-d H:i:s');
	$enddate 		= date_format($tanggalakhir, 'Y-m-d H:i:s');

	//cek dulu apakah end date lebih dari startdate
	if($startdate <= $enddate){
		//echo "bisa " . $startdate;
		$this->model_adm_event->tambah_jadwal($idevent, $idprofil, $idsekolah, $startdate, $enddate);
		$respon = array(
			'idprofil'	=> $idprofil
		);
		$data = json_encode($respon);
		echo $data;
	}else{
		echo "tanggal error";
	}
}

function refresh_jadwal($idevent, $idprofil){
	$data = array(
		"datajadwal"	=> $this->model_adm_event->fetch_jadwal_by_tryout_and_event($idevent, $idprofil)
	);
	$this->load->view("pg_admin/event/ajax_refresh_jadwal_sekolah", $data);
}

function proses_hapus_jadwal(){
	$params 	= $this->input->post(null, true);
	$idjadwal 	= $params['idjadwal'];
	$jadwal 	= $this->model_adm_event->fetch_jadwal_by_id($idjadwal);

	$idprofil 	= $jadwal->id_profil;

	$this->model_adm_event->hapus_jadwal($idjadwal);

	$respon = array(
		'idprofil'	=> $idprofil
	);
	$data = json_encode($respon);
	echo $data;
}

function reset_cbt($idsekolah, $idevent){
	$datasiswa = $this->model_adm_event->fetch_siswa_by_sekolah($idsekolah);
	$datacbt = $this->model_adm_event->fetch_cbt_by_event($idevent);

	foreach($datasiswa as $siswa){
		foreach($datacbt as $cbt){
			//cari kategori
			$datakategori = $this->model_adm_event->fetch_kategori_by_profil($cbt->id_profil);
			foreach($datakategori as $kategori){
				$this->model_adm_event->hapus_analisis_waktu($siswa->id_siswa, $kategori->id_kategori);
				$this->model_adm_event->hapus_analisis_topik($siswa->id_siswa, $kategori->id_kategori);
				$this->model_adm_event->hapus_elapsed_time($siswa->id_siswa, $kategori->id_kategori);
			}
		}
	}
}

function rank($idevent){
	$data = array(
		"datacbt"	=> $this->model_adm_event->fetch_cbt_by_event($idevent),
		"event"		=> $this->model_adm_event->fetch_event_by_id($idevent)
	);

	$this->load->view("pg_admin/event/rank", $data);
}

function ajax_peringkat_cbt($idcbt){
	$data = array(
		'dataperingkat'	=> $this->model_dashboard->peringkat($idcbt),
		'datakategori'	=> $this->model_psep->get_tryout_by_profil2($idcbt),
		'idprofil'		=> $idcbt,
		"dataprovinsi"	=> $this->model_adm_event->fetch_provinsi(),
		'datawilayah'	=> $this->model_adm_event->fetch_wilayah(),
		"profil"		=> $this->model_adm_event->fetch_cbt_by_id($idcbt)
	);
	$this->load->view("pg_admin/event/ajax_peringkat_cbt", $data);
}

function ajax_peringkat_by_provinsi($idprovinsi, $idcbt){
	$data = array(
		'dataperingkat'	=> $this->model_dashboard->peringkat($idcbt),
		'datakategori'	=> $this->model_psep->get_tryout_by_profil2($idcbt),
		'idprovinsi'	=> $idprovinsi,
		'idprofil'		=> $idcbt
	);
	$this->load->view("pg_admin/event/ajax_peringkat_cbt_provinsi", $data);
}

function ajax_peringkat_by_sekolah($idsekolah, $idcbt){
	$data = array(
		'dataperingkat'	=> $this->model_dashboard->peringkat($idcbt),
		'datakategori'	=> $this->model_psep->get_tryout_by_profil2($idcbt),
		'idsekolah'		=> $idsekolah,
		'idprofil'		=> $idcbt
	);
	$this->load->view("pg_admin/event/ajax_peringkat_cbt_sekolah", $data);
}

function ajax_peringkat_by_wilayah($idwilayah, $idcbt){
	$data = array(
		'dataperingkat'	=> $this->model_dashboard->peringkat($idcbt),
		'datakategori'	=> $this->model_psep->get_tryout_by_profil2($idcbt),
		'idwilayah'		=> $idwilayah,
		'idprofil'		=> $idcbt
	);
	$this->load->view("pg_admin/event/ajax_peringkat_cbt_wilayah", $data);
}

function download_excel_nasional($idcbt){
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("PRIME MOBILE")->setTitle("Prime Mobile");
	
	$objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
    $objget = $objPHPExcel->getActiveSheet();  //inisiasi get object
	
	$objget->setTitle('Sample Sheet'); //sheet title
    
	
	//table header
	$cols = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
	 
	//$val = array("MATA PELAJARAN","BAB","SUB BAB","JUMLAH SOAL","PEMBAHASAN VIDEO", "PEMBAHASAN TEKS");
	$cbt 			= $this->model_adm_event->fetch_cbt_by_id($idcbt);
	$datakategori	= $this->model_psep->get_tryout_by_profil2($idcbt);

	$jumlahkategori =0;
	foreach ($datakategori as $kategori) {
		$jumlahkategori++;
	}
	$objset->setCellValue('A1', "Peringkat " . $cbt->nama_profil);

	$objset->setCellValue('A3', "No");	
	$objset->setCellValue('B3', "Nama");	
	$objset->setCellValue('C3', "Sekolah");	
	$objset->setCellValue('D3', "Kota");	
	$objset->setCellValue('E3', "Provinsi");	

	$i = 5;
	foreach($datakategori as $kategori){
		$objset->setCellValue( $cols[$i].'3', $kategori->nama_kategori);
		$i++;
	}
	
	$objset->setCellValue($cols[$i] . '3', "Jumlah Nilai");
	$i += 1;
	$objset->setCellValue($cols[$i] . '3', "Skor");
	
	$dataperingkat = $this->model_dashboard->peringkat($idcbt);

	$baris = 4;
	$no = 1;
	foreach($dataperingkat as $peringkat){
		$datasiswa = $this->model_dashboard->fetch_siswa_by_id($peringkat->id_siswa, $idcbt);

		$objset->setCellValue('A' . $baris, $no);
		$objset->setCellValue('B' . $baris, $datasiswa->nama_siswa);
		$objset->setCellValue('C' . $baris, $datasiswa->nama_sekolah);
		$objset->setCellValue('D' . $baris, $datasiswa->nama_kota);
		$objset->setCellValue('E' . $baris, $datasiswa->nama_provinsi);

		$datanilai = $this->model_dashboard->rekap_nilai($idcbt, $peringkat->id_siswa);

		$y = 5;
		foreach($datanilai as $nilai){
			$objset->setCellValue($cols[$y] . $baris, number_format($nilai->jumlah_bobot_benar, 0, '.', ''));
			$y++;
		}
		$objset->setCellValue($cols[$y] . $baris, number_format($peringkat->jumlah_bobot_benar, 0, '.', ''));
		$y += 1;
		$objset->setCellValue($cols[$y] . $baris, number_format(($peringkat->jumlah_bobot_benar/$peringkat->jumlah_bobot)*100, 0, '.', '') . "%");

		$no++;
		$baris++;
	}


	$objPHPExcel->setActiveSheetIndex(0);
	$filename = str_replace("/", " ", $cbt->nama_profil).".xls";
	   
	  header('Content-Type: application/vnd.ms-excel'); //mime type
	  header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	  header('Cache-Control: max-age=0'); //no cache

	$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');                
	$objWriter->save('php://output');
}

function download_excel_sekolah($idcbt, $idsekolah){
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("PRIME MOBILE")->setTitle("Prime Mobile");
	
	$objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
    $objget = $objPHPExcel->getActiveSheet();  //inisiasi get object
	
	$objget->setTitle('Sample Sheet'); //sheet title
    
	
	//table header
	$cols = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
	 
	//$val = array("MATA PELAJARAN","BAB","SUB BAB","JUMLAH SOAL","PEMBAHASAN VIDEO", "PEMBAHASAN TEKS");
	$cbt 			= $this->model_adm_event->fetch_cbt_by_id($idcbt);
	$datakategori	= $this->model_psep->get_tryout_by_profil2($idcbt);

	$jumlahkategori =0;
	foreach ($datakategori as $kategori) {
		$jumlahkategori++;
	}
	$objset->setCellValue('A1', "Peringkat " . $cbt->nama_profil);

	$objset->setCellValue('A3', "No");	
	$objset->setCellValue('B3', "Nama");	
	$objset->setCellValue('C3', "Sekolah");	
	$objset->setCellValue('D3', "Kota");	
	$objset->setCellValue('E3', "Provinsi");	

	$i = 5;
	foreach($datakategori as $kategori){
		$objset->setCellValue( $cols[$i].'3', $kategori->nama_kategori);
		$i++;
	}
	
	$objset->setCellValue($cols[$i] . '3', "Jumlah Nilai");
	$i += 1;
	$objset->setCellValue($cols[$i] . '3', "Skor");
	
	$dataperingkat = $this->model_dashboard->peringkat($idcbt);

	$baris = 4;
	$no = 1;
	foreach($dataperingkat as $peringkat){
		$datasiswa = $this->model_dashboard->fetch_siswa_by_id($peringkat->id_siswa, $idcbt);

		if($datasiswa->id_sekolah == $idsekolah){
			$objset->setCellValue('A' . $baris, $no);
			$objset->setCellValue('B' . $baris, $datasiswa->nama_siswa);
			$objset->setCellValue('C' . $baris, $datasiswa->nama_sekolah);
			$objset->setCellValue('D' . $baris, $datasiswa->nama_kota);
			$objset->setCellValue('E' . $baris, $datasiswa->nama_provinsi);

			$datanilai = $this->model_dashboard->rekap_nilai($idcbt, $peringkat->id_siswa);

			$y = 5;
			foreach($datanilai as $nilai){
				$objset->setCellValue($cols[$y] . $baris, number_format($nilai->jumlah_bobot_benar, 0, '.', ''));
				$y++;
			}
			$objset->setCellValue($cols[$y] . $baris, number_format($peringkat->jumlah_bobot_benar, 0, '.', ''));
			$y += 1;
			$objset->setCellValue($cols[$y] . $baris, number_format(($peringkat->jumlah_bobot_benar/$peringkat->jumlah_bobot)*100, 0, '.', '') . "%");

			$no++;
			$baris++;
		}
	}


	$objPHPExcel->setActiveSheetIndex(0);
	$filename = str_replace("/", " ", $cbt->nama_profil).".xls";
	   
	  header('Content-Type: application/vnd.ms-excel'); //mime type
	  header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	  header('Cache-Control: max-age=0'); //no cache

	$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');                
	$objWriter->save('php://output');
}

function download_excel_nasional_all_gelombang($idevent, $idkelas){
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("PRIME MOBILE")->setTitle("Prime Mobile");
	
	$objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
    $objget = $objPHPExcel->getActiveSheet();  //inisiasi get object
	
	$objget->setTitle('Sample Sheet'); //sheet title
    
	
	//table header
	$cols = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
	 
	//$val = array("MATA PELAJARAN","BAB","SUB BAB","JUMLAH SOAL","PEMBAHASAN VIDEO", "PEMBAHASAN TEKS");
	//$cbt 			= $this->model_adm_event->fetch_cbt_by_id($idcbt);
	

	
	//$objset->setCellValue('A1', "Peringkat " . $cbt->nama_profil);

	$objset->setCellValue('A3', "No");	
	$objset->setCellValue('B3', "Nama");	
	$objset->setCellValue('C3', "Sekolah");	
	$objset->setCellValue('D3', "Kota");	
	$objset->setCellValue('E3', "Provinsi");	

	//cari cbt yang ada di dalam event yang bersangkutan
	$datacbt = $this->model_adm_event->fetch_cbt_by_event_and_kelas($idevent, $idkelas);

	$a = 1;
	foreach($datacbt as $cbt){
		$datakategori	= $this->model_psep->get_tryout_by_profil2($cbt->id_profil);
		if(!isset($i)){
			$i = 5;
		}
		foreach($datakategori as $kategori){
			$objset->setCellValue( $cols[$i].'3', $kategori->nama_kategori . " Gel. " . $a);
			$i++;
		}
		$a++;
	}
	
	$objset->setCellValue($cols[$i] . '3', "Jumlah Nilai");
	$i += 1;
	$objset->setCellValue($cols[$i] . '3', "Skor");

	$dataperingkat = $this->model_adm_event->peringkat_event($idevent, $idkelas);

	$baris = 4;
	$no = 1;
	foreach($dataperingkat as $peringkat){
		$datasiswa = $this->model_dashboard->fetch_siswa_by_id($peringkat->id_siswa, $idcbt);

		if($datasiswa->id_sekolah == $idsekolah){
			$objset->setCellValue('A' . $baris, $no);
			$objset->setCellValue('B' . $baris, $datasiswa->nama_siswa);
			$objset->setCellValue('C' . $baris, $datasiswa->nama_sekolah);
			$objset->setCellValue('D' . $baris, $datasiswa->nama_kota);
			$objset->setCellValue('E' . $baris, $datasiswa->nama_provinsi);
			$no++;
			$baris++;
		}
	}

	$objPHPExcel->setActiveSheetIndex(0);
	$filename = str_replace("/", " ", "Peringkat Nasional All Gelombang").".xls";
	   
	  header('Content-Type: application/vnd.ms-excel'); //mime type
	  header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	  header('Cache-Control: max-age=0'); //no cache

	$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');                
	$objWriter->save('php://output');
}


function download_excel_wilayah($idcbt, $idwilayah){
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("PRIME MOBILE")->setTitle("Prime Mobile");
	
	$objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
    $objget = $objPHPExcel->getActiveSheet();  //inisiasi get object
	
	$objget->setTitle('Sample Sheet'); //sheet title
    
	
	//table header
	$cols = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
	 
	//$val = array("MATA PELAJARAN","BAB","SUB BAB","JUMLAH SOAL","PEMBAHASAN VIDEO", "PEMBAHASAN TEKS");
	$cbt 			= $this->model_adm_event->fetch_cbt_by_id($idcbt);
	$datakategori	= $this->model_psep->get_tryout_by_profil2($idcbt);

	$jumlahkategori =0;
	foreach ($datakategori as $kategori) {
		$jumlahkategori++;
	}
	$objset->setCellValue('A1', "Peringkat " . $cbt->nama_profil);

	$objset->setCellValue('A3', "No");	
	$objset->setCellValue('B3', "Nama");	
	$objset->setCellValue('C3', "Sekolah");	
	$objset->setCellValue('D3', "Kota");	
	$objset->setCellValue('E3', "Provinsi");	

	$i = 5;
	foreach($datakategori as $kategori){
		$objset->setCellValue( $cols[$i].'3', $kategori->nama_kategori);
		$i++;
	}
	
	$objset->setCellValue($cols[$i] . '3', "Jumlah Nilai");
	$i += 1;
	$objset->setCellValue($cols[$i] . '3', "Skor");
	
	$dataperingkat = $this->model_dashboard->peringkat($idcbt);

	$baris = 4;
	$no = 1;
	foreach($dataperingkat as $peringkat){
		$datasiswa = $this->model_dashboard->fetch_siswa_by_id($peringkat->id_siswa, $idcbt);

		$fetchsiswa = $this->model_adm_event->fetch_siswa_include_wilayah($peringkat->id_siswa);

		if($fetchsiswa->id_wilayah == $idwilayah){
			$objset->setCellValue('A' . $baris, $no);
			$objset->setCellValue('B' . $baris, $datasiswa->nama_siswa);
			$objset->setCellValue('C' . $baris, $datasiswa->nama_sekolah);
			$objset->setCellValue('D' . $baris, $datasiswa->nama_kota);
			$objset->setCellValue('E' . $baris, $datasiswa->nama_provinsi);

			$datanilai = $this->model_dashboard->rekap_nilai($idcbt, $peringkat->id_siswa);

			$y = 5;
			foreach($datanilai as $nilai){
				$objset->setCellValue($cols[$y] . $baris, number_format($nilai->jumlah_bobot_benar, 0, '.', ''));
				$y++;
			}
			$objset->setCellValue($cols[$y] . $baris, number_format($peringkat->jumlah_bobot_benar, 0, '.', ''));
			$y += 1;
			$objset->setCellValue($cols[$y] . $baris, number_format(($peringkat->jumlah_bobot_benar/$peringkat->jumlah_bobot)*100, 0, '.', '') . "%");

			$no++;
			$baris++;
		}
	}


	$objPHPExcel->setActiveSheetIndex(0);
	$filename = str_replace("/", " ", $cbt->nama_profil).".xls";
	   
	  header('Content-Type: application/vnd.ms-excel'); //mime type
	  header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	  header('Cache-Control: max-age=0'); //no cache

	$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');                
	$objWriter->save('php://output');
}

}
?>