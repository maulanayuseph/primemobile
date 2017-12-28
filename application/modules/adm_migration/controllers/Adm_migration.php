<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adm_migration extends CI_Controller {

	public function __construct()
  {
    parent::__construct();
	//$this->load->model('model_user_dashboard');
	$this->load->model('adm_migration_model');
	$this->load->model('adm_main/adm_main_model');
	$this->load->helper(array('form', 'url'));
	$this->adm_main_model->adm_login_security();
  }

function adm_data(){
	$dataadm = $this->adm_main_model->fetch_admin_by_id($this->session->userdata('idlogin'));
	return $dataadm;
}

function content(){
	$this->adm_main_model->security_level_superadmin();
	$data = array(
		'title'			=> 'Super Administrator Dashboard | Content Migration',
		'content'		=> 'adm_migration/index',
		'headerassets'	=> 'adm_migration/index_headerassets',
		'footerassets'	=> 'adm_migration/index_footerassets',
		'dataadmin'		=> $this->adm_data(),
		'datakelas'		=> $this->adm_migration_model->fetch_kelas(),
		'datakurikulum'	=> $this->adm_migration_model->fetch_kurikulum(),
		'datamapel'		=> $this->adm_migration_model->fetch_mapel()		
	);
	$this->load->view("template_admin/template_adm", $data);
}

function ajax_mapel_by_kelas_old(){
	$params 		= $this->input->post(null, true);
	$idkelas 		= $params['idkelas'];

	$datamapel = $this->adm_migration_model->fetch_mapel_by_kelas_old($idkelas);

	echo "<option value=''>-- Pilih Mapel --</option>";

	foreach($datamapel as $mapel){
		?>
		<option value="<?php echo $mapel->id_mapel;?>"><?php echo $mapel->nama_mapel;?></option>
		<?php
	}
}

function ajax_bab_by_kurikulum(){
	$params 		= $this->input->post(null, true);
	$idmapel 		= $params['idmapel'];
	$kurikulum 		= $params['kurikulum'];

	$carimapok 	= $this->adm_migration_model->cari_mapok_by_mapel($idmapel);

	echo '<option value="">-- Pilih Materi Pokok --</option>';
	
	if($kurikulum == "K-13"){
		foreach($carimapok as $mapok){
			$jumlahsubk13 		= $this->adm_migration_model->jumlah_subk13_by_mapok($mapok->id_materi_pokok);
			$jumlahsubirisan 	= $this->adm_migration_model->jumlah_subkirisan_by_mapok($mapok->id_materi_pokok);

			if($jumlahsubk13 > 0 or $jumlahsubirisan > 0){
				?>
				<option value="<?php echo $mapok->id_materi_pokok;?>"><?php echo $mapok->judul_bab_k13;?></option>
				<?php
			}
		}
	}elseif($kurikulum == "K-13 REVISI"){
		foreach($carimapok as $mapok){
			$jumlahsubk13rev = $this->adm_migration_model->jumlah_subk13rev_by_mapok($mapok->id_materi_pokok);

			if($jumlahsubk13rev > 0){
				?>
				<option value="<?php echo $mapok->id_materi_pokok;?>"><?php echo $mapok->judul_bab_k13;?></option>
				<?php
			}
		}
	}elseif($kurikulum == "KTSP"){
		foreach($carimapok as $mapok){
			$jumlahsubktsp 		= $this->adm_migration_model->jumlah_ktsp_by_mapok($mapok->id_materi_pokok);
			$jumlahsubirisan 	= $this->adm_migration_model->jumlah_subkirisan_by_mapok($mapok->id_materi_pokok);

			if($jumlahsubktsp > 0 or $jumlahsubirisan > 0){
				?>
				<option value="<?php echo $mapok->id_materi_pokok;?>"><?php echo $mapok->judul_bab_ktsp;?></option>
				<?php
			}
		}
	}
}

function ajax_sub_materi(){
	$params 		= $this->input->post(null, true);
	$kurikulum 		= $params['kurikulum'];
	$idmapok 		= $params['idmapok'];

	if($kurikulum == "K-13"){
		$datasub = $this->adm_migration_model->fetch_sub_k13_by_mapok($idmapok);
	}elseif($kurikulum == "KTSP"){
		$datasub = $this->adm_migration_model->fetch_sub_ktsp_by_mapok($idmapok);
	}elseif($kurikulum == "K-13 REVISI"){
		$datasub = $this->adm_migration_model->fetch_sub_k13rev_by_mapok($idmapok);
	}

	$data = array(
		'datasub'	=> $datasub,
		'kurikulum'	=> $kurikulum,
		'mapok'		=> $this->adm_migration_model->fetch_mapok_by_id($idmapok)
	);
	$this->load->view('adm_migration/index_ajax_sub_materi', $data);
}

function ajax_cek_transfer_bab(){
	$params 		= $this->input->post(null, true);
	$idkelas		= $params['idkelas'];
	$idkurikulum	= $params['idkurikulum'];
	$idmapel		= $params['idmapel'];
	$bab			= $params['bab'];
	$idmapok 		= $params['idmapok'];

	$data = array(
		'kelas'			=> $this->adm_migration_model->fetch_kelas_by_id($idkelas),
		'kurikulum'		=> $this->adm_migration_model->fetch_kurikulum_by_id($idkurikulum),
		'mapel'			=> $this->adm_migration_model->fetch_mapel_new_by_id($idmapel),
		'bab'			=> $bab,
		'mapok'			=> $this->adm_migration_model->fetch_mapok_by_id($idmapok)
	);
	$this->load->view("adm_migration/index_ajax_cek_transfer_bab");
}

function proses_transfer_bab(){
	
}

}
?>