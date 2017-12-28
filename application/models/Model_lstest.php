<?php
class Model_lstest extends CI_Model{
function __construct(){

	parent::__construct();
}

function hapus_ls($idsiswa){
	$this->db->delete('hasil_ls', array('id_siswa' => $idsiswa));
}

function get_lstest(){
	$this->db->select('*');
	$this->db->from('ls_test1');
	
	$query = $this->db->get();
	return $query->result();
}
function get_lstest2(){
	$this->db->select('*');
	$this->db->from('ls_test2');
	
	$query = $this->db->get();
	return $query->result();
}

function insert_skor($idsiswa, $no, $skor){
	$this->db->select("*");
	$this->db->from("hasil_ls");
	$this->db->where("id_siswa", $idsiswa);
	$this->db->where("no", $no);
	if($this->db->count_all_results() > 0){
		$this->db->where('no', $no);
		$this->db->where('id_siswa', $idsiswa);
		$result = $this->db->delete('hasil_ls');
	}
	$data = array(
		'id_siswa' 	=> $idsiswa,
		'no' 	=> $no,
		'skor' 	=> $skor
		);
	$result = $this->db->insert('hasil_ls', $data);
	return $result;
}

function skor($idsiswa){
	$this->db->select('*');
	$this->db->from('hasil_ls');
	$this->db->where('id_siswa', $idsiswa);
	
	$query = $this->db->get();
	return $query->result();
}

function test_sql(){
	$this->db->query("SELECT * FROM hasil_ls where id_siswa = 17 and no = 24");
	$query = $this->db->get('hasil_ls');
	return $query->row();
}



}

?>