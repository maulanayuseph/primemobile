<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Adm_konten_model extends CI_Model
{
	private $insert_id;
	function __construct()
	{
		parent::__construct();
	}

function fetch_kurikulum_x_kelas_group(){
	$this->db->select("*");
	$this->db->from("kurikulum_x_kelas");
	$this->db->join("kelas", "kurikulum_x_kelas.id_kelas = kelas.id_kelas", "left");
	$this->db->group_by("kelas.id_kelas");

	$query = $this->db->get();	
	return $query->result();
}

}
?>