<?php

class Rekap extends CI_Controller{
function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('alert_helper');
		$this->load->model('model_adm');
		$this->load->model('model_pembayaran');
		$this->load->model('model_paket');
		$this->load->model('model_tryout');
		$this->load->model('model_banksoal');
		$this->load->model('model_security');
		$this->load->model('model_rekap');
		$this->load->model('model_kurikulum');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->model_security->is_logged_in();
	}

function index(){
	$data = array(
		'datakelas'		=> $this->model_adm->fetch_all_kelas()
		//'jumlahkelas'	=> $this->model_adm->jumlah_kelas(),
		//'jumlahmapel'	=> $this->model_adm->jumlah_mapel()
	);
	
	$this->load->view('pg_admin/rekap', $data);
}

function detail($idkelas){
	$data = array(
		'infokelas'	=> $this->model_adm->get_kelas_by_id($idkelas),
		'datamapel'	=> $this->model_adm->fetch_mapel_by_kelas($idkelas)
	);
	
	$this->load->view("pg_admin/rekap_detail", $data);
}

function export($idkelas){
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("PRIME MOBILE")->setTitle("Prime Mobile");
	
	$objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
    $objget = $objPHPExcel->getActiveSheet();  //inisiasi get object
	
	$objget->setTitle('Sample Sheet'); //sheet title
    
	
	//table header
	$cols = array("A","B","C","D","E");
	 
	$val = array("MATA PELAJARAN","BAB","SUB BAB","JUMLAH SOAL","PEMBAHASAN VIDEO", "PEMBAHASAN TEKS");
	 
	for ($a=0;$a<5; $a++){
		$objset->setCellValue($cols[$a].'1', $val[$a]);
		 
		//Setting lebar cell
		//$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
		//$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
		//$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
		
	 
		$style = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			)
		);
		$objPHPExcel->getActiveSheet()->getStyle($cols[$a].'1')->applyFromArray($style);
	}
	
	
	$datamapel	= $this->model_adm->fetch_mapel_by_kelas($idkelas);
	
	$baris = 2;
	foreach($datamapel as $mapel){
		$objset->setCellValue("A".$baris, $mapel->nama_mapel);
		
		$datamateripokok = $this->model_adm->fetch_materi_pokok_by_mapel2($mapel->id_mapel);
		
		$a = $baris;
		foreach($datamateripokok as $bab){
			$objset->setCellValue("B".$a, $bab->nama_materi_pokok);
			
			$datasub = $this->model_adm->fetch_sub_materi_by_mapel($mapel->id_mapel);
			$b = $a;
			foreach($datasub as $sub){
				if($sub->id_materi_pokok == $bab->id_materi_pokok){
					$objset->setCellValue("C".$b, $sub->nama_sub_materi);
					
					if($sub->kategori == 3){
						$jumlahsoal = $this->model_adm->jumlah_soal_by_sub_materi($sub->id_sub_materi);
						//echo $jumlahsoal;
						$objset->setCellValue("D".$b, $jumlahsoal);
						
						$jumlahvideo = $this->model_adm->jumlah_pembahasan_video_by_sub_materi($sub->id_sub_materi);
						$objset->setCellValue("E".$b, $jumlahvideo);
					}else{
						//echo "-";
						$objset->setCellValue("D".$b, "-");
						$objset->setCellValue("E".$b, "-");
					}
					$b++;
				}
			}
			$a = $b;
			$a++;
		}
		$baris = $a;
		$baris++;
	}
	
	$infokelas	= $this->model_adm->get_kelas_by_id($idkelas);
	
	$objPHPExcel->getActiveSheet()->setTitle(str_replace("/", " ", $infokelas->alias_kelas));
	
	$objPHPExcel->setActiveSheetIndex(0);
	$filename = str_replace("/", " ", $infokelas->alias_kelas)."_".date("Y-m-d").".xls";
	   
	  header('Content-Type: application/vnd.ms-excel'); //mime type
	  header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	  header('Cache-Control: max-age=0'); //no cache

	$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');                
	$objWriter->save('php://output');
}

function soal_pdf($idkelas){
	$carisubmateri = $this->model_adm->fetch_sub_materi_by_kelas($idkelas);
	
	foreach($carisubmateri as $sub){
		//echo "<p>" . $sub->nama_materi_pokok . "-" . $sub->nama_sub_materi;
		
		$this->set_pdf($sub->id_sub_materi);
		
		//file_put_contents('soal' . $sub->id_sub_materi . '.pdf', base_url('pg_admin/rekap/set_pdf/' . $sub->id_sub_materi));
	}
}

function soal_kolektif(){
	$data = array(
		'datakelas'		=> $this->model_adm->fetch_all_kelas()
	);
	
	$this->load->view('pg_admin/rekap_pilih_mapel_pdf_soal', $data);
}

function set_pdf($idsubmateri){
	$this->load->library('pdf');
	
	$infosub = $this->model_adm->fetch_sub_by_id($idsubmateri);
	
	$data = array(
		'datasoal'	=> $this->model_adm->fetch_soal_by_sub_materi($idsubmateri),
		'infosub'	=> $infosub,
		'title'		=> $infosub->alias_kelas . " " . $infosub->nama_mapel . " " . $infosub->nama_materi_pokok . " " . " " . $infosub->nama_sub_materi
	);
	
	$html = $this->load->view('pg_admin/pdf_soal', $data, true);
	
	$this->pdf->pdf_create($html,"assets/rekap_soal/LATIHAN SOAL " . str_replace("/", " ", $infosub->alias_kelas . " " . $infosub->nama_mapel . " " . $infosub->nama_materi_pokok . " " . " " . $infosub->nama_sub_materi . ".pdf"),'A4','potrait', false);
}

function set_pdf_manual($idsubmateri){
	$this->load->library('pdf');
	
	$infosub = $this->model_adm->fetch_sub_by_id($idsubmateri);
	
	$data = array(
		'datasoal'	=> $this->model_adm->fetch_soal_by_sub_materi($idsubmateri),
		'infosub'	=> $infosub
	);
	
	$html = $this->load->view('pg_admin/pdf_soal', $data, true);
	
	$this->pdf->pdf_create($html, url_title($infosub->alias_kelas . " " . $infosub->nama_mapel . " " . $infosub->nama_materi_pokok . " " . " " . $infosub->nama_sub_materi, '-', true),'A4','potrait', true);
	$this->load->view("pg_admin/pdf_soal", $data);
}

function set_html_manual($idsubmateri){
	$this->load->library('pdf');
	
	$infosub = $this->model_adm->fetch_sub_by_id($idsubmateri);
	
	$data = array(
		'datasoal'	=> $this->model_adm->fetch_soal_by_sub_materi($idsubmateri),
		'infosub'	=> $infosub,
		'title'		=> $infosub->alias_kelas . " " . $infosub->nama_mapel . " " . $infosub->nama_materi_pokok . " " . " " . $infosub->nama_sub_materi
	);
	
	//$html = $this->load->view('pg_admin/pdf_soal', $data, true);
	
	//$this->pdf->pdf_create($html, url_title($infosub->nama_sub_materi, '-', true),'A4','potrait', true);
	$this->load->view("pg_admin/html_soal", $data);
}

function set_html_manual_non_penulis($idsubmateri){
	$this->load->library('pdf');
	
	$infosub = $this->model_adm->fetch_sub_by_id($idsubmateri);
	
	$data = array(
		'datasoal'	=> $this->model_adm->fetch_soal_by_sub_materi_non_penulis($idsubmateri),
		'infosub'	=> $infosub,
		'title'		=> $infosub->alias_kelas . " " . $infosub->nama_mapel . " " . $infosub->nama_materi_pokok . " " . " " . $infosub->nama_sub_materi . "non penulis"
	);
	
	//$html = $this->load->view('pg_admin/pdf_soal', $data, true);
	
	//$this->pdf->pdf_create($html, url_title($infosub->nama_sub_materi, '-', true),'A4','potrait', true);
	$this->load->view("pg_admin/html_soal", $data);
}

function ajax_materi_pokok($idmapel){
	$caribab = $this->model_adm->fetch_materi_pokok_by_mapel2($idmapel);
	
	echo "<option value='0'>-- Pilih Bab --</option>";
	
	foreach($caribab as $bab){
		?>
		<option value="<?php echo $bab->id_materi_pokok;?>"><?php echo $bab->nama_materi_pokok;?></option>
		<?php
	}
}

function proses_rekap_soal($idmapel){
	$carisub = $this->model_adm->fetch_sub_soal_by_mapel($idmapel);
	
	$this->load->library('zip');
	foreach($carisub as $sub){
		$this->set_pdf($sub->id_sub_materi);
		
		$infosub = $this->model_adm->fetch_sub_by_id($sub->id_sub_materi);
		
		$path = "assets/rekap_soal/LATIHAN SOAL " . str_replace("/", " ", $infosub->alias_kelas . " " . $infosub->nama_mapel . " " . $infosub->nama_materi_pokok . " " . " " . $infosub->nama_sub_materi . ".pdf");
		
		$this->zip->read_file($path, FALSE);
	}
	
	$infomapel = $this->model_adm->fetch_mapel_by_id($idmapel);
	//$this->zip->download('my_backup.zip');
	$this->zip->archive(str_replace("/", " ", $infomapel->alias_kelas . " - " . $infomapel->nama_mapel . '.zip'));
	echo "
	<div class='se-pre-con'>
			</div> 
			<br>&nbsp;
			<p>Rekap Selesai, Download rekap soal dengan klik tombol di bawah ini
			<p><a href='" . base_url(str_replace("/", " ", $infomapel->alias_kelas . " - " . $infomapel->nama_mapel . ".zip")) . "' class='btn btn-primary'>Download</a>
			";
}

function proses_rekap_soal_by_bab($idmateripokok){
	$carisub = $this->model_adm->fetch_sub_soal_by_materi_pokok($idmateripokok);
	
	$this->load->library('zip');
	foreach($carisub as $sub){
		//echo $sub->id_sub_materi;
		$this->set_pdf($sub->id_sub_materi);
		
		$infosub = $this->model_adm->fetch_sub_by_id($sub->id_sub_materi);
		
		$path = "assets/rekap_soal/LATIHAN SOAL " . str_replace("/", " ", $infosub->alias_kelas . " " . $infosub->nama_mapel . " " . $infosub->nama_materi_pokok . " " . " " . $infosub->nama_sub_materi . ".pdf");
		
		$this->zip->read_file($path, FALSE);
	}
	
	$infomapok = $this->model_adm->fetch_materi_pokok_by_id($idmateripokok);
	
	$this->zip->archive("assets/zip/" . str_replace("/", " ", $infomapok->alias_kelas . " - " . $infomapok->nama_mapel . "-" . $infomapok->nama_materi_pokok. '.zip'));
	
	echo "
	<div class='se-pre-con'>
			</div> 
			<br>&nbsp;
			<p>Rekap Selesai, Download rekap soal dengan klik tombol di bawah ini
			<p><a href='" . base_url("assets/zip/" . str_replace("/", " ", $infomapok->alias_kelas . " - " . $infomapok->nama_mapel . "-" . $infomapok->nama_materi_pokok. '.zip')) . "' class='btn btn-primary'>Download</a>
			";
}
function export_by_kurikulum($kurikulum, $idkelas){
	if($kurikulum == "k13"){
		$kurikulum = "K-13";
	}elseif($kurikulum == "ktsp"){
		$kurikulum = "KTSP";
	}
	
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("PRIME MOBILE")->setTitle("Prime Mobile");
	
	$objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
    $objget = $objPHPExcel->getActiveSheet();  //inisiasi get object
	
	$objget->setTitle('Sample Sheet'); //sheet title
    
	
	//table header
	$cols = array("A","B","C","D","E", "F", "G");
	 
	$val = array("MATA PELAJARAN","BAB","SUB BAB","JUMLAH SOAL SUB","PEMBAHASAN VIDEO", "JUMLAH SOAL BAB", "PEMBAHASAN VIDEO");
	 
	for ($a=0;$a<6; $a++){
		$objset->setCellValue($cols[$a].'1', $val[$a]);
		 
		//Setting lebar cell
		//$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
		//$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
		//$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
		
	 
		$style = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			)
		);
		$objPHPExcel->getActiveSheet()->getStyle($cols[$a].'1')->applyFromArray($style);
	}
	
	
	$datamapel	= $this->model_adm->fetch_mapel_by_kelas($idkelas);
	
	$baris = 2;
	foreach($datamapel as $mapel){
		$objset->setCellValue("A".$baris, $mapel->nama_mapel);
		
		$datamateripokok = $this->model_adm->fetch_materi_pokok_by_mapel2($mapel->id_mapel);
		
		$a = $baris;
		foreach($datamateripokok as $bab){
			if($kurikulum == "K-13"){
				$jumlahsubk13 = $this->model_kurikulum->jumlah_subk13_by_mapok($bab->id_materi_pokok);
				$jumlahsubirisan = $this->model_kurikulum->jumlah_subkirisan_by_mapok($bab->id_materi_pokok);
				if($jumlahsubk13 > 0 or $jumlahsubirisan > 0){
					$objset->setCellValue("B".$a, $bab->judul_bab_k13);
				}
			}elseif($kurikulum == "KTSP"){
				$jumlahsubktsp = $this->model_kurikulum->jumlah_ktsp_by_mapok($bab->id_materi_pokok);
				$jumlahsubirisan = $this->model_kurikulum->jumlah_subkirisan_by_mapok($bab->id_materi_pokok);
				if($jumlahsubktsp > 0 or $jumlahsubirisan > 0){
					$objset->setCellValue("B".$a, $bab->judul_bab_ktsp);
				}
			}
			
			
			//$datasub = $this->model_adm->fetch_sub_materi_by_mapel($mapel->id_mapel);
			$datasub = $this->model_rekap->fetch_sub_materi_by_mapel_and_kurikulum($mapel->id_mapel, $kurikulum);
			$b = $a;
			foreach($datasub as $sub){
				if($sub->id_materi_pokok == $bab->id_materi_pokok){
					if($kurikulum == "K-13"){
						$objset->setCellValue("C".$b, $sub->nama_sub_materi);
						
					}elseif($kurikulum == "KTSP"){
						$objset->setCellValue("C".$b, $sub->nama_sub_materi);
						
					}
					
					
					if($sub->kategori == 3){
						if($sub->tipe_latihan == 0){
							$jumlahsoal = $this->model_adm->jumlah_soal_by_sub_materi($sub->id_sub_materi);
							//echo $jumlahsoal;
							$objset->setCellValue("D".$b, $jumlahsoal);
							
							$jumlahvideo = $this->model_adm->jumlah_pembahasan_video_by_sub_materi($sub->id_sub_materi);
							$objset->setCellValue("E".$b, $jumlahvideo);
							
							
							$objset->setCellValue("F".$b, "-");
							$objset->setCellValue("G".$b, "-");
							
							
						}elseif($sub->tipe_latihan == 1){
							$jumlahsoal = $this->model_adm->jumlah_soal_by_sub_materi($sub->id_sub_materi);
							//echo $jumlahsoal;
							$objset->setCellValue("F".$b, $jumlahsoal);
							$jumlahvideo = $this->model_adm->jumlah_pembahasan_video_by_sub_materi($sub->id_sub_materi);
							$objset->setCellValue("G".$b, $jumlahvideo);
							
							
							$objset->setCellValue("D".$b, "-");
							$objset->setCellValue("E".$b, "-");
							
						}
						
						
						
					}else{
						//echo "-";
						$objset->setCellValue("D".$b, "-");
						$objset->setCellValue("E".$b, "-");
						$objset->setCellValue("F".$b, "-");
						$objset->setCellValue("G".$b, "-");
						
					}
					$b++;
					
				}
			}
			if($kurikulum == "K-13"){
				if($jumlahsubk13 > 0 or $jumlahsubirisan > 0){
					//$objset->setCellValue("B".$a, $bab->judul_bab_k13);
					$a = $b;
					$a++;
				}
			}elseif($kurikulum == "KTSP"){
				if($jumlahsubktsp > 0 or $jumlahsubirisan > 0){
					//$objset->setCellValue("B".$a, $bab->judul_bab_ktsp);
					$a = $b;
					$a++;
				}
			}
		}
		$baris = $a;
		$baris++;
	}
	
	$infokelas	= $this->model_adm->get_kelas_by_id($idkelas);
	
	$objPHPExcel->getActiveSheet()->setTitle(str_replace("/", " ", $infokelas->alias_kelas));
	
	$objPHPExcel->setActiveSheetIndex(0);
	$filename = str_replace("/", " ", $infokelas->alias_kelas)."_".$kurikulum.".xls";
	   
	  header('Content-Type: application/vnd.ms-excel'); //mime type
	  header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	  header('Cache-Control: max-age=0'); //no cache

	$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');                
	$objWriter->save('php://output');
}

function export_new($idkelas){
	
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("PRIME MOBILE")->setTitle("Prime Mobile");
	
	$objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
    $objget = $objPHPExcel->getActiveSheet();  //inisiasi get object
	
	$objget->setTitle('Sample Sheet'); //sheet title
    
	
	//table header
	$cols = array("A","B","C","D","E", "F", "G");
	 
	$val = array("MATA PELAJARAN","BAB","SUB BAB","JUMLAH SOAL SUB","PEMBAHASAN VIDEO", "JUMLAH SOAL BAB", "PEMBAHASAN VIDEO");
	 
	for ($a=0;$a<=6; $a++){
		$objset->setCellValue($cols[$a].'1', $val[$a]);
		 
		//Setting lebar cell
		//$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
		//$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
		//$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
		
	 
		$style = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			)
		);
		$objPHPExcel->getActiveSheet()->getStyle($cols[$a].'1')->applyFromArray($style);
	}
	
	
	$datamapel	= $this->model_adm->fetch_mapel_by_kelas($idkelas);
	
	$baris = 2;
	foreach($datamapel as $mapel){
		$objset->setCellValue("A".$baris, $mapel->nama_mapel);
		
		$datamateripokok = $this->model_adm->fetch_materi_pokok_by_mapel2($mapel->id_mapel);
		
		$a = $baris;
		foreach($datamateripokok as $bab){
			$objset->setCellValue("B".$a, $bab->nama_materi_pokok);
			
			
			//$datasub = $this->model_adm->fetch_sub_materi_by_mapel($mapel->id_mapel);
			$datasub = $this->model_rekap->fetch_all_sub_by_mapel($mapel->id_mapel);
			$b = $a;
			foreach($datasub as $sub){
				if($sub->id_materi_pokok == $bab->id_materi_pokok){
						$objset->setCellValue("C".$b, $sub->nama_sub_materi);
						
					if($sub->kategori == 3){
						if($sub->tipe_latihan == 0){
							$jumlahsoal = $this->model_adm->jumlah_soal_by_sub_materi($sub->id_sub_materi);
							//echo $jumlahsoal;
							$objset->setCellValue("D".$b, $jumlahsoal);
							
							$jumlahvideo = $this->model_adm->jumlah_pembahasan_video_by_sub_materi($sub->id_sub_materi);
							$objset->setCellValue("E".$b, $jumlahvideo);
							
							
							$objset->setCellValue("F".$b, "-");
							$objset->setCellValue("G".$b, "-");
							
							
						}elseif($sub->tipe_latihan == 1){
							$jumlahsoal = $this->model_adm->jumlah_soal_by_sub_materi($sub->id_sub_materi);
							//echo $jumlahsoal;
							$objset->setCellValue("F".$b, $jumlahsoal);
							$jumlahvideo = $this->model_adm->jumlah_pembahasan_video_by_sub_materi($sub->id_sub_materi);
							$objset->setCellValue("G".$b, $jumlahvideo);
							
							
							$objset->setCellValue("D".$b, "-");
							$objset->setCellValue("E".$b, "-");
							
						}
						
						
						
					}else{
						//echo "-";
						$objset->setCellValue("D".$b, "-");
						$objset->setCellValue("E".$b, "-");
						$objset->setCellValue("F".$b, "-");
						$objset->setCellValue("G".$b, "-");
						
					}
					$b++;
					
				}
			}
			$a = $b;
			$a++;
		}
		$baris = $a;
		$baris++;
	}
	
	$infokelas	= $this->model_adm->get_kelas_by_id($idkelas);
	
	$objPHPExcel->getActiveSheet()->setTitle(str_replace("/", " ", $infokelas->alias_kelas));
	
	$objPHPExcel->setActiveSheetIndex(0);
	$filename = str_replace("/", " ", $infokelas->alias_kelas)."_all_kurikulum.xls";
	   
	  header('Content-Type: application/vnd.ms-excel'); //mime type
	  header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	  header('Cache-Control: max-age=0'); //no cache

	$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');                
	$objWriter->save('php://output');
}
}