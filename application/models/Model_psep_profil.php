<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_psep_profil extends CI_Model
{

	private $insert_id;

	function __construct()
	{
		parent::__construct();
	}

function edit_profil_sekolah($idsekolah, $alamat, $email, $telepon, $motto){
	$data = array(
		'alamat_sekolah'	=> $alamat,
		'email'				=> $email,
		'telepon'			=> $telepon,
		'motto'				=> $motto
	);
	$this->db->where('id_sekolah', $idsekolah);
	$result = $this->db->update('sekolah', $data);
	return $result;
}

function update_logo($idsekolah, $filename){
	$data = array(
		'logo'	=> $filename
	);
	$this->db->where('id_sekolah', $idsekolah);
	$result = $this->db->update('sekolah', $data);
	return $result;
}

function update_banner($idsekolah, $filename){
	$data = array(
		'banner'	=> $filename
	);
	$this->db->where('id_sekolah', $idsekolah);
	$result = $this->db->update('sekolah', $data);
	return $result;
}
}
?>