<?php
class Silabus extends CI_Controller{
function __construct(){
	parent::__construct();
	$this->load->library('form_validation');
	$this->load->helper('alert_helper');
	$this->load->model('model_adm');
	$this->load->model('model_security');
	$this->load->model('model_psep');
	$this->load->model('model_banksoal');
	$this->load->model('model_pr');
	$this->load->model('model_dashboard');
	$this->load->model('model_pg');
	$this->load->model('model_materi_urutan');
	$this->load->model('model_silabus');
	
	$this->model_security->psep_sekolah_is_logged_in();
}

function index(){
	$sekolah = $this->model_psep->fetch_sekolah_by_id($this->session->userdata('idsekolah'));
	$data = array(
		"sekolah" 		=> $this->model_psep->fetch_sekolah_by_id($this->session->userdata('idsekolah')),
		"datakelas"		=> $this->model_adm->fetch_kelas_by_jenjang($sekolah->jenjang),
		"tahunajaran"	=> $this->model_psep->fetch_tahun_ajaran_by_sekolah($this->session->userdata('idsekolah'))
	);
	$this->load->view("psep_sekolah/silabus", $data);
}

function ajax_mapel_by_kelas($idkelas){
	$data = array(
		"datamapel"	=> $this->model_silabus->fetch_mapel_by_kelas_and_sekolah($idkelas, $this->session->userdata('idsekolah'))
	);
	$this->load->view("psep_sekolah/silabus_ajax/ajax_daftar_mapel", $data);
}

function ajax_editor_mapel(){
	$sekolah = $this->model_psep->fetch_sekolah_by_id($this->session->userdata('idsekolah'));
	$data = array(
		"datakelas"	=> $this->model_adm->fetch_kelas_by_jenjang($sekolah->jenjang)
	);
	$this->load->view("psep_sekolah/silabus_ajax/ajax_mapel", $data);
}

function ajax_proses_tambah_mapel(){
	$params 	= $this->input->post(null, true);
	$idkelas 	= $params["idkelas"];
	$mapel 		= $params["mapel"];
	$this->model_silabus->tambah_mapel($idkelas, $this->session->userdata('idsekolah'), $mapel, $this->session->userdata('idpsepsekolah'));
	echo $idkelas;
}

function ajax_edit_mapel($idmapel){
	$sekolah = $this->model_psep->fetch_sekolah_by_id($this->session->userdata('idsekolah'));
	$data = array(
		"datakelas"	=> $this->model_adm->fetch_kelas_by_jenjang($sekolah->jenjang),
		"datamapel"	=> $this->model_silabus->fetch_mapel_by_id($idmapel)
	);
	$this->load->view("psep_sekolah/silabus_ajax/ajax_mapel_edit", $data);
}

function ajax_proses_edit_mapel(){
	$params 		= $this->input->post(null, true);
	$idpsepmapel	= $params["idpsepmapel"];
	$idkelas		= $params["idkelas"];
	$mapel			= $params["mapel"];

	$this->model_silabus->edit_mapel($idpsepmapel, $idkelas, $mapel);

	echo $idkelas;
}

function ajax_hapus_mapel($idkelas, $idmapel){
	$this->model_silabus->hapus_mapel($idmapel);

	echo $idkelas;
}

function ajax_editor_bab(){
	$sekolah = $this->model_psep->fetch_sekolah_by_id($this->session->userdata('idsekolah'));
	$data = array(
		"datakelas"		=> $this->model_adm->fetch_kelas_by_jenjang($sekolah->jenjang),
		"jenjang"		=> $sekolah->jenjang,
		"tahunajaran"	=> $this->model_psep->fetch_tahun_ajaran_by_sekolah($this->session->userdata('idsekolah'))
	);

	$this->load->view("psep_sekolah/silabus_ajax/ajax_bab", $data);
}

function ajax_dropdown_mapel_by_kelas($idkelas){
	$datamapel = $this->model_silabus->fetch_mapel_by_kelas_and_sekolah($idkelas, $this->session->userdata('idsekolah'));

	echo "<option value='0'>-- Pilih Mata Pelajaran --</option>";
	foreach($datamapel as $mapel){
		?>
		<option value="<?php echo $mapel->id_psep_mapel;?>"><?php echo $mapel->nama_psep_mapel;?></option>
		<?php
	}
}

function ajax_proses_tambah_bab(){
	$params 		= $this->input->post(null, true);
	$idkelas 		= $params['idkelas'];
	$idpsepmapel 	= $params['idpsepmapel'];
	$kurikulum 		= $params['kurikulum'];
	$tahunajaran 	= $params['tahunajaran'];
	$bab 			= $params['bab'];
	$semester		= $params['semester'];

	$this->model_silabus->tambah_bab($idpsepmapel, $kurikulum, $bab, $tahunajaran, $semester, $this->session->userdata('idpsepsekolah'));

	$data = array(
		"mapel"		=> $idpsepmapel,
		"kurikulum"	=> $kurikulum,
		"tahun"		=> $tahunajaran,
		"semester"	=> $semester
	);

	echo json_encode($data);
}

function ajax_bab($idpsepmapel, $kurikulum, $tahunajaran){
	$data = array(
		"databab"	=> $this->model_silabus->fetch_bab_by_mapel_kurikulum_and_tahun_ajaran($idpsepmapel, $kurikulum, $tahunajaran)
	);

	$this->load->view("psep_sekolah/silabus_ajax/ajax_daftar_bab", $data);
}

function ajax_edit_bab($idpsepbab){
	$sekolah = $this->model_psep->fetch_sekolah_by_id($this->session->userdata('idsekolah'));
	$data = array(
		"datakelas"		=> $this->model_adm->fetch_kelas_by_jenjang($sekolah->jenjang),
		"bab"			=> $this->model_silabus->fetch_psep_bab_by_id($idpsepbab)
	);

	$this->load->view("psep_sekolah/silabus_ajax/ajax_bab_edit", $data);
}

function ajax_proses_edit_bab(){
	$params = $this->input->post(null, true);
	$idpsepbab		= $params["idpsepbab"];
	$idkelas		= $params["idkelas"];
	$idpsepmapel	= $params["idpsepmapel"];
	$kurikulum		= $params["kurikulum"];
	$tahunajaran	= $params["tahunajaran"];
	$bab			= $params["bab"];
	$semester		= $params["semester"];

	$this->model_silabus->edit_bab($idpsepbab, $idpsepmapel, $kurikulum, $bab, $tahunajaran, $semester);

	$data = array(
		"mapel"		=> $idpsepmapel,
		"kurikulum"	=> $kurikulum,
		"tahun"		=> $tahunajaran
	);
	echo json_encode($data);
}

function ajax_hapus_bab(){
	$params 	= $this->input->post(null, true);
	$idpsepbab 	= $params["idpsepbab"];

	$databab = $this->model_silabus->fetch_psep_bab_by_id($idpsepbab);

	$data = array(
		"mapel"		=> $databab->id_psep_mapel,
		"kurikulum"	=> $databab->kurikulum,
		"tahun"		=> $databab->id_tahun_ajaran
	);

	$this->model_silabus->hapus_bab($idpsepbab);

	echo json_encode($data);
}

function ajax_sub($idpsepbab){
	$data = array(
		"bab"		=> $this->model_silabus->fetch_psep_bab_by_id($idpsepbab),
		"datasub"	=> $this->model_silabus->fetch_sub_by_bab($idpsepbab)
	);

	$this->load->view("psep_sekolah/silabus_ajax/ajax_daftar_sub", $data);
}

function ajax_tambah_sub(){
	$params 	= $this->input->post(null, true);
	$idpsepbab	= $params["idpsepbab"];
	$namasub	= $params["namasub"];

	$this->model_silabus->tambah_sub_bab($idpsepbab, $namasub);

	echo $idpsepbab;
}

function edit_sub($idpsepsub){
	$data = array(
		"sub"		=> $this->model_silabus->fetch_sub_by_id($idpsepsub)
	);
	$this->load->view("psep_sekolah/silabus_ajax/ajax_edit_sub", $data);
}

function ajax_proses_edit_sub(){
	$params 	= $this->input->post(null, true);
	$idpsepsub	= $params["idpsepsub"];
	$namasub	= $params["namasub"];

	$this->model_silabus->edit_sub($idpsepsub, $namasub);
}


function ajax_kd(){
	$sekolah = $this->model_psep->fetch_sekolah_by_id($this->session->userdata('idsekolah'));
	$data = array(
		"datakelas"		=> $this->model_adm->fetch_kelas_by_jenjang($sekolah->jenjang),
		"tahunajaran"	=> $this->model_psep->fetch_tahun_ajaran_by_sekolah($this->session->userdata('idsekolah')),
		"jenjang"		=> $sekolah->jenjang,
	);
	$this->load->view("psep_sekolah/silabus_ajax/ajax_kd", $data);
}

function ajax_proses_kd(){
	$params 			= $this->input->post(null, true);
	$mapel 				= $params['mapel'];
	$tahunajaran 		= $params['tahunajaran'];
	$semester 			= $params['semester'];
	$ki 				= $params['ki'];
	$kd 				= $params['kd'];
	$deskripsi 			= $params['deskripsi'];

	$this->model_silabus->tambah_kd($mapel, $tahunajaran, $semester, $ki, $kd, $deskripsi);
	$data = array(
		"mapel"	=> $mapel,
		"tahun"	=> $tahunajaran
	);

	echo json_encode($data);
	//redirect("psep_sekolah/silabus/");
}

function ajax_daftar_kd($idpsepmapel, $idtahunajaran){
	$data = array(
		"daftarkd"	=> $this->model_silabus->fetch_kd_by_mapel_and_tahun_ajaran($idpsepmapel, $idtahunajaran)
	);
	$this->load->view("psep_sekolah/silabus_ajax/ajax_daftar_kd", $data);
}

function edit_kd($idkd){
	$sekolah = $this->model_psep->fetch_sekolah_by_id($this->session->userdata('idsekolah'));
	$data = array(
		"kd"			=> $this->model_silabus->fetch_kd_by_id($idkd),
		"datakelas"		=> $this->model_adm->fetch_kelas_by_jenjang($sekolah->jenjang),
		"tahunajaran"	=> $this->model_psep->fetch_tahun_ajaran_by_sekolah($this->session->userdata('idsekolah')),
		"jenjang"		=> $sekolah->jenjang,
	);
	$this->load->view("psep_sekolah/silabus_ajax/ajax_edit_kd", $data);
}

function ajax_proses_edit_kd(){
	$params 			= $this->input->post(null, true);
	$idkd				= $params['idkd'];
	$mapel 				= $params['mapel'];
	$tahunajaran 		= $params['tahunajaran'];
	$semester 			= $params['semester'];
	$ki 				= $params['ki'];
	$kd 				= $params['kd'];
	$deskripsi 			= $params['deskripsi'];

	$this->model_silabus->proses_edit_kd($idkd, $mapel, $tahunajaran, $semester, $ki, $kd, $deskripsi);

	$data = array(
		"mapel"	=> $mapel,
		"tahun"	=> $tahunajaran
	);

	echo json_encode($data);
}

function hapus_kd(){
	$params	= $this->input->post(null, true);
	$idkd	= $params['idkd'];
	$kd 	= $this->model_silabus->fetch_kd_by_id($idkd);
	$this->model_silabus->hapus_kd($idkd);

	$data = array(
		"mapel"	=> $kd->id_psep_mapel,
		"tahun"	=> $kd->id_tahun_ajaran
	);

	echo json_encode($data);
}


}
?>