<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Author extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    
    //check user session

    //load library in construct. Construct method will be run everytime the controller is called 
    //This library will be auto-loaded in every method in this controller. 
    //So there will be no need to call the library again in each method. 
    $this->load->library('form_validation');
    $this->load->helper('alert_helper');
    $this->load->helper('url_validation_helper');
    $this->load->model('model_adm');
    $this->load->model('model_adm1');
	$this->load->model('model_banksoal');
	$this->load->model('model_materi_urutan');
	$this->load->model('model_kurikulum');
	$this->load->model('model_author');
	$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
    $this->load->model('model_security');
    $this->model_security->is_logged_in();
  }

function index(){
	$this->load->view("pg_admin/author/dashboard.php");
}

function semua_materi(){
	$data = array(
		"datakelas"	=> $this->model_banksoal->get_kelas(),
		"roleadmin"	=> $this->model_author->get_role_by_id_adm($this->session->userdata('id_admin'))
	);
	$this->load->view("pg_admin/author/materi", $data);
}


function ajax_kurikulum(){
	?>
	<option value="0">-- Pilih Kurikulum --</option>
	<option value="K-13">K-13</option>
	<option value="KTSP">KTSP</option>
	<?php
}

function ajax_mapel($kelas){
	$carimapel = $this->model_banksoal->get_mapel_by_kelas($kelas);
	
	$roleadmin = $this->model_author->get_role_by_id_adm($this->session->userdata('id_admin'));
	
	$x = 0;
	foreach($roleadmin as $roleadm){
		$role[$x] = $roleadm->id_mapel;
		$x++;
	}
	
	echo "<option value=''>-- pilih mata pelajaran --</option>";
	foreach($carimapel as $mapel){
		if(in_array($mapel->id_mapel, $role)){
			?>
			<option value="<?php echo $mapel->id_mapel; ?>"><?php echo $mapel->nama_mapel; ?></option>
			<?php
		}else{
			?>
			<option value="<?php echo $mapel->id_mapel; ?>" disabled><?php echo $mapel->nama_mapel; ?></option>
			<?php
		}
	}
}

function ajax_materi_pokok_drop($idkelas, $idmapel, $kurikulum){
	$carimapok 	= $this->model_materi_urutan->cari_mapok_by_mapel($idmapel);
	?>
		<option value="0">-- Pilih Bab --</option>
	<?php
	$x = 1;
	foreach($carimapok as $mapok){
		if($kurikulum == "K-13"){
			$jumlahsubk13 = $this->model_kurikulum->jumlah_subk13_by_mapok($mapok->id_materi_pokok);
			$jumlahsubirisan = $this->model_kurikulum->jumlah_subkirisan_by_mapok($mapok->id_materi_pokok);
			if($jumlahsubk13 > 0 or $jumlahsubirisan > 0){
				?>
				<option value="<?php echo $mapok->id_materi_pokok;?>"><?php echo $mapok->judul_bab_k13;?></option>
				<?php
			}
		}elseif($kurikulum == "KTSP"){
			$jumlahsubktsp = $this->model_kurikulum->jumlah_ktsp_by_mapok($mapok->id_materi_pokok);
			$jumlahsubirisan = $this->model_kurikulum->jumlah_subkirisan_by_mapok($mapok->id_materi_pokok);
			if($jumlahsubktsp > 0 or $jumlahsubirisan > 0){
				?>
				<option value="<?php echo $mapok->id_materi_pokok;?>"><?php echo $mapok->judul_bab_k13;?></option>
				<?php
			}
		}
		$x++;
	}
}

function ajax_list_sub($idbab, $kurikulum){
	$data = array(
		"datasub"	=> $this->model_author->fetch_sub_by_bab_and_kurikulum($idbab, $kurikulum),
		"kurikulum"	=> $kurikulum
	);
	$this->load->view("pg_admin/author/ajax_sub_bab", $data);
}

function list_soal($idsub){
	$datasoal = $this->model_author->fetch_soal_by_sub_and_author($idsub, $this->session->userdata('id_admin'));
	
	$data = array(
		"datasoal"	=> $datasoal,
		"idsub"		=> $idsub
	);
	
	$this->load->view("pg_admin/author/list_soal", $data);
}

function ajax_lihat_soal($idsoal){
	$data = array(
		'soal' => $this->model_adm->fetch_soal_by_id($idsoal)
	);
	$this->load->view("pg_admin/author/ajax_view_soal", $data);
}
}
?>