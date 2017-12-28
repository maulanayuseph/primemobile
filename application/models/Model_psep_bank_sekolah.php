<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_psep_bank_soal extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

function fetch_mapel(){
	$this->db->select("*");
	$this->db->from("mapel");

	$query = $this->db->get();
	return $query->result();
}



}
?>