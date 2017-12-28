<?php
class Model_eqtest extends CI_Model{
function __construct(){

	parent::__construct();
}

function get_eqtest(){
	$this->db->select('*');
	$this->db->from('eq_test');
	
	$query = $this->db->get();
	return $query->result();
}

function insert_skor($idsiswa, $aq, $eq, $am){
	$data = array(
		'id_siswa' 	=> $idsiswa,
		'skor_aq' 	=> $aq,
		'skor_eq' 	=> $eq,
		'skor_am' 	=> $am
		);
	$result = $this->db->insert('hasil_eq', $data);
	return $result;
}

}

?>