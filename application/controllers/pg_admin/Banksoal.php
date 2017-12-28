<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Banksoal extends CI_Controller{
public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('alert_helper');
		$this->load->model('model_adm');
		$this->load->model('model_pembayaran');
		$this->load->model('model_paket');
		$this->load->model('model_tryout');
		$this->load->model('model_banksoal');
		$this->load->model('model_qc_user');
		$this->load->model('model_security');
		$this->model_security->is_logged_in();
	}

function index(){
	$data = array(
		'navbar_title'	=> 'Data Bank Soal',
		'data_soal' 	=> $this->model_banksoal->fetch_banksoal(),
		'select_options_kelas'	=> $this->model_banksoal->get_kelas()
	);
	$this->load->view('pg_admin/banksoal', $data);
}

function tambah(){
	$data = array(
		'navbar_title' 			=> "Tambah Bank Soal",
		'form_action'			=> current_url(),
		'select_options_mapel'	=> $this->model_banksoal->get_kelas()
	);
	$this->load->view('pg_admin/banksoal_form', $data);
}

function prosesbanksoal(){
	$params 		= $this->input->post(null, true);
	$mapel			= $params['nama_mapel'];
	
	if(isset($params['topikbaru'])){
		$topik		= $params['topikbaru'];
	}else{
		$topik			= $params['topik'];
	}
	$soal			= str_replace("\\\\", "\\", $params['soal']);
	$bobot			= $params['bobot'];
	$jawabbenar		= $params['jawabbenar'];
	$jawab1			= str_replace("\\\\", "\\", $params['jawab1']);
	$jawab2			= str_replace("\\\\", "\\", $params['jawab2']);
	$jawab3			= str_replace("\\\\", "\\", $params['jawab3']);
	$jawab4			= str_replace("\\\\", "\\", $params['jawab4']);
	$jawab5			= str_replace("\\\\", "\\", $params['jawab5']);
	$bahasteks		= str_replace("\\\\", "\\", $params['bahasteks']);
	$bahasvideo		= $params['bahasvideo'];
	$kategori		= $params['kategori'];
	$tipe			= $params['tipe'];
	$qcstatus 		= $params['qcstatus'];
	
	$result = $this->model_banksoal->tambah_banksoal($mapel, $topik, $soal, $bobot, $jawabbenar, $jawab1, $jawab2, $jawab3, $jawab4, $jawab5, $bahasteks, $bahasvideo, $kategori, $tipe, $qcstatus);
	redirect('pg_admin/banksoal');
}

function kategori(){
	$data = array(
		'navbar_title' 			=> "Tambah Kategori Bank Soal",
		'kategoribanksoal'	=> $this->model_banksoal->fetch_kategori_bank_soal()
	);
	$this->load->view('pg_admin/kategori_banksoal', $data);
}

function tambahkategori(){
	$data = array(
		'navbar_title' 			=> "Tambah Kategori Bank Soal",
		'datakelas'				=> $this->model_banksoal->get_kelas()
	);
	
	$this->load->view('pg_admin/kategori_banksoal_form', $data);
}

function pilihmapel($idkelas){
	$carimapel = $this->model_banksoal->get_mapel_by_kelas($idkelas);
	
	echo "<option value=''>-- pilih mata pelajaran --</option>";
	foreach($carimapel as $mapel){
	?>
		<option value="<?php echo $mapel->id_mapel; ?>"><?php echo $mapel->nama_mapel; ?></option>
	<?php
	}
}

function pilihkategori($idmapel){
	$carikategori = $this->model_banksoal->get_kategori_by_mapel($idmapel);
	
	echo "<option value='0'>Uncategorized</option>";
	foreach($carikategori as $kategori){
	?>
		<option value="<?php echo $kategori->id_kategori_bank_soal; ?>"><?php echo $kategori->nama_kategori; ?></option>
	<?php
	}
}

function pilihtopik($idmapel){
	$caritopik = $this->model_banksoal->get_topik_by_mapel($idmapel);
	
	echo "<option value=''>Pilih Topik</option>";
	foreach($caritopik as $topik){
	?>
		<option value="<?php echo $topik->topik; ?>"><?php echo $topik->topik; ?></option>
	<?php
	}
	echo "<option value='tambah'>Tambah Topik...</option>";
}

function tambahtopik($topik){
	if($topik = "tambah"){
		echo "<input type='text' class='form-control' name='topikbaru' placeholder='masukkan topik baru...'/>";
	}
}

function proseskategori(){
	$params = $this->input->post(null, true);
	$idmapel = $params['mapel'];
	$namakategori = $params['nama_kastegori'];
	
	$result = $this->model_banksoal->tambah_kategori($idmapel, $namakategori);
	
	redirect('pg_admin/banksoal/kategori');
}

function editkategori($idkategori){
	$data = array(
		'navbar_title' 			=> "Edit Kategori Bank Soal",
		'datakategori'			=> $this->model_banksoal->cari_kategori($idkategori),
		'datakelas'				=> $this->model_banksoal->get_kelas()
	);
	
	$this->load->view('pg_admin/kategori_banksoal_edit', $data);
}

function proseseditkategori(){
	$params 		= $this->input->post(null, true);
	$idmapel 		= $params['mapel'];
	$namakategori 	= $params['nama_kastegori'];
	$idkategori 	= $params['id_kategori'];
	
	$result = $this->model_banksoal->edit_kategori($idkategori, $idmapel, $namakategori);
	
	redirect('pg_admin/banksoal/kategori');
}

function hapuskategori($idkategori){
	$hapus = $this->model_banksoal->hapus_kategori($idkategori);
	
	redirect('pg_admin/banksoal/kategori');
}

function edit($idbanksoal){
	$datasoal = $this->model_banksoal->cari_bank_soal_by_id($idbanksoal);

	$data = array(
		'navbar_title' 			=> "Edit Bank Soal",
		'datasoal'				=> $this->model_banksoal->cari_bank_soal_by_id($idbanksoal),
		'datakelas'				=> $this->model_banksoal->get_kelas(),
		'select_options_mapel'	=> $this->model_banksoal->get_kelas(),
		'datatopik' 			=> $this->model_banksoal->get_topik_by_mapel($datasoal->id_mapel)
	);
	$this->load->view('pg_admin/banksoal_edit', $data);
}



function proseseditbanksoal(){
	$params = $this->input->post(null, true);
	
	$idbanksoal = $params['idbanksoal'];
	$mapel			= $params['nama_mapel'];
	if(isset($params['topikbaru'])){
		$topik		= $params['topikbaru'];
	}else{
		$topik			= $params['topik'];
	}
	$soal			= $_POST['soal'];
	$bobot			= $params['bobot'];
	$jawabbenar		= $params['jawabbenar'];
	$jawab1			= $_POST['jawab1'];
	$jawab2			= $_POST['jawab2'];
	$jawab3			= $_POST['jawab3'];
	$jawab4			= $_POST['jawab4'];
	$jawab5			= $_POST['jawab5'];
	$bahasteks		= $_POST['bahasteks'];
	$bahasvideo		= $params['bahasvideo'];
	$kategori		= $params['kategori'];
	$tipe			= $params['tipe'];
	$qcstatus 		= $params['qcstatus'];

	
	$result = $this->model_banksoal->edit_banksoal($idbanksoal, $mapel, $topik, $soal, $bobot, $jawabbenar, $jawab1, $jawab2, $jawab3, $jawab4, $jawab5, $bahasteks, $bahasvideo, $kategori, $tipe, $qcstatus);
	redirect('pg_admin/banksoal');
}

function hapus($idbanksoal){
	$hapus = $this->model_banksoal->hapus($idbanksoal);
	redirect('pg_admin/banksoal');
}

function ajax_mapel($kelas){
	if($this->session->userdata('level') == "qc"){
		$carimapel = $this->model_qc_user->fetch_mapel_qc_by_kelas($this->session->userdata('id_admin'), $kelas);
	}else{
		$carimapel = $this->model_banksoal->get_mapel_by_kelas($kelas);
	}
	
	echo "<option value=''>-- pilih mata pelajaran --</option>";
	foreach($carimapel as $mapel){
	?>
		<option value="<?php echo $mapel->id_mapel; ?>"><?php echo $mapel->nama_mapel; ?></option>
	<?php
	}
}

function ajax_soal($kelas, $mapel){
	$carisoal = $this->model_banksoal->fetch_banksoal_by_kelas_mapel($kelas, $mapel);
	$data = array(
		'datasoal'	=> $carisoal
	);
	$this->load->view("pg_admin/bank_soal_ajax/ajax_tabel", $data);
}

function ajax_soal_modal($kelas, $mapel){

	$carisoal = $this->model_banksoal->fetch_banksoal_by_kelas_mapel($kelas, $mapel);

	$data = array(
		"datasoal"	=> $carisoal
	);

	$this->load->view("pg_admin/bank_soal_ajax/ajax_modal_view", $data);
}

function ajax_kategori($idmapel){
	$carikategori = $this->model_banksoal->get_kategori_by_mapel($idmapel);
	
	echo "<option value=''>Pilih Kategori...</option>";
	foreach($carikategori as $kategori){
		?>
		<option value="<?php echo $kategori->id_kategori_bank_soal;?>"><?php echo $kategori->nama_kategori;?></option>
		<?php
	}
}
function ajax_soal_by_kategori($idkategori){
	$carisoal = $this->model_banksoal->fetch_bank_soal_by_kategori($idkategori);
	$data = array(
		'datasoal'	=> $carisoal
	);
	$this->load->view("pg_admin/bank_soal_ajax/ajax_tabel", $data);
}

function ajax_soal_modal_by_kategori($idkategori){
	$carisoal = $this->model_banksoal->fetch_bank_soal_by_kategori($idkategori);

	$data = array(
		"datasoal"	=> $carisoal
	);

	$this->load->view("pg_admin/bank_soal_ajax/ajax_modal_view", $data);
}

function cetak($idkategori){
	$carisoal = $this->model_banksoal->fetch_bank_soal_by_kategori($idkategori);
	$infobank = $this->model_banksoal->fetch_info_kategori($idkategori);
	
	$title = "Bank Soal " . $infobank->alias_kelas . " " . $infobank->nama_mapel . " - " . $infobank->nama_kategori;
	
	$data = array(
		"infobank"	=> $infobank,
		"title"		=> $title,
		"datasoal"	=> $this->model_banksoal->fetch_bank_soal_by_kategori($idkategori)
	);
	
	$this->load->view("pg_admin/cetak_bank_soal", $data);
}

function cetaknobahas($idkategori){
	$carisoal = $this->model_banksoal->fetch_bank_soal_by_kategori($idkategori);
	$infobank = $this->model_banksoal->fetch_info_kategori($idkategori);
	
	$title = "Bank Soal " . $infobank->alias_kelas . " " . $infobank->nama_mapel . " - " . $infobank->nama_kategori;
	
	$data = array(
		"infobank"	=> $infobank,
		"title"		=> $title,
		"datasoal"	=> $this->model_banksoal->fetch_bank_soal_by_kategori($idkategori)
	);
	
	$this->load->view("pg_admin/cetak_bank_soal_no_bahas", $data);
}

function ajax_view_soal($idbanksoal){
	$datasoal = $this->model_banksoal->cari_bank_soal_by_id($idbanksoal);
	$data = array(
		'data'	=> $datasoal
	);
	$this->load->view("pg_admin/bank_soal_ajax/ajax_modal_soal", $data);
}

function qc(){
	if($this->session->userdata('level') == "qc"){
		$datakelas = $this->model_qc_user->fetch_kelas_qc($this->session->userdata('id_admin'));
	}else{
		$datakelas = $this->model_banksoal->get_kelas();
	}
	$data = array(
		"datakelas"		=> $datakelas
	);
	$this->load->view("pg_admin/bank_soal/qc", $data);
}

function ajax_mapel_qc($idkelas){
	if($this->session->userdata('level') == "qc"){
		$datamapel = $this->model_qc_user->fetch_mapel_qc_by_kelas($this->session->userdata('id_admin'), $idkelas);
	}else{
		$datamapel = $this->model_banksoal->get_mapel_by_kelas($idkelas);
	}
	echo "<option value=''>-- Pilih Mapel --</option>";

	foreach($datamapel as $mapel){
		$jumlahqc = $this->model_banksoal->count_qc_by_mapel($mapel->id_mapel);
		?>
		<option value="<?php echo $mapel->id_mapel;?>"><?php echo $mapel->nama_mapel;?> (<?php echo $jumlahqc;?>)</option>
		<?php
	}
}

function ajax_kategori_qc($idmapel){
	$datakategori = $this->model_banksoal->get_kategori_by_mapel($idmapel);
	echo "<option value=''>-- Pilih Kategori --</option>";

	foreach($datakategori as $kategori){
		$jumlahqc = $this->model_banksoal->count_qc_by_kategori($kategori->id_kategori_bank_soal);
		?>
		<option value="<?php echo $kategori->id_kategori_bank_soal;?>"><?php echo $kategori->nama_kategori;?> (<?php echo $jumlahqc;?>)</option>
		<?php
	}
}

function ajax_status_qc($idkategori){
	echo "<option value=''>-- Pilih QC Status --</option>";
	for($i = 0; $i <= 11; $i++){
		$jumlahqc = $this->model_banksoal->count_qc_by_status($idkategori, $i);
		?>
		<option value="<?php echo $i;?>">
			<?php
				if($i == 0){
					echo "Waiting Approval (" . $jumlahqc . ")";
				}elseif($i == 1){
					echo "Approved (" . $jumlahqc . ")";
				}elseif($i == 2){
					echo "Pembahasan Tidak Lengkap (" . $jumlahqc . ")";
				}elseif($i == 3){
					echo "Salah Pembobotan (" . $jumlahqc . ")";
				}elseif($i == 4){
					echo "Soal Membingungkan (" . $jumlahqc . ")";
				}elseif($i == 5){
					echo "Soal Double";
				}elseif($i == 6){
					echo "Soal Tidak Layak (" . $jumlahqc . ")";
				}elseif($i == 7){
					echo "Soal perlu dipindah (" . $jumlahqc . ")";
				}elseif($i == 8){
					echo "Soal Belum di QC (" . $jumlahqc . ")";
				}elseif($i == 9){
					echo "Video Salah (" . $jumlahqc . ")";
				}elseif($i == 10){
					echo "Gambar Hilang (" . $jumlahqc . ")";
				}elseif($i == 11){
					echo "Pembahasan dan kunci tidak sesuai (" . $jumlahqc . ")";
				}
			?>
		</option>
		<?php
	}
}

function ajax_soal_by_status($idkategori, $status){
	$data = array(
		"datasoal"	=> $this->model_banksoal->fetch_soal_by_kategori_and_status($idkategori, $status)
	);
	$this->load->view("pg_admin/bank_soal/ajax_bank_soal_by_status", $data);
}

function ajax_approve(){
	$params		= $this->input->post(null, true);
	$idbanksoal = $params['idbanksoal'];

	//fetch dulu row bank soalnya
	$soal = $this->model_banksoal->cari_bank_soal_by_id($idbanksoal);

	$this->model_banksoal->set_status_qc($idbanksoal, 1);

	$respon = array(
		'idkategori'	=> $soal->id_kategori_bank_soal,
		'status'		=> 'success'
	);
	$data = json_encode($respon);
	echo $data;
}

}
?>