<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_history extends CI_Model
{

	private $insert_id;

	function __construct()
	{
		parent::__construct();
	}

function fetch_all_history_dashboard(){
	$this->db->select("*,
		qc_history_before.soal as soal_before,
		qc_history_before.status  as status_before,
		qc_history_before.jawab_1  as jawab_1_before,
		qc_history_before.jawab_2  as jawab_2_before,
		qc_history_before.jawab_3  as jawab_3_before,
		qc_history_before.jawab_4  as jawab_4_before,
		qc_history_before.jawab_5  as jawab_5_before,
		qc_history_before.kunci_jawaban  as kunci_jawaban_before,
		qc_history_before.pembahasan  as pembahasan_before,
		qc_history_before.pembahasan_video  as pembahasan_video_before,
		qc_history_before.bobot  as bobot_before,
		qc_history_after.soal as soal_after,
		qc_history_after.status  as status_after,
		qc_history_after.jawab_1  as jawab_1_after,
		qc_history_after.jawab_2  as jawab_2_after,
		qc_history_after.jawab_3  as jawab_3_after,
		qc_history_after.jawab_4  as jawab_4_after,
		qc_history_after.jawab_5  as jawab_5_after,
		qc_history_after.kunci_jawaban  as kunci_jawaban_after,
		qc_history_after.pembahasan  as pembahasan_after,
		qc_history_after.pembahasan_video  as pembahasan_video_after,
		qc_history_after.bobot  as bobot_after
	");
	$this->db->from("qc_history");
	$this->db->join("qc_history_before", "qc_history.id_qc_history = qc_history_before.id_qc_history");
	$this->db->join("qc_history_after", "qc_history.id_qc_history = qc_history_after.id_qc_history");
	$this->db->join("login_adm", "qc_history.id_adm = login_adm.id_adm", "left");
	$this->db->order_by("qc_history.id_qc_history", "desc");
	$this->db->limit(100);
	
	$query = $this->db->get();
	return $query->result();
}

function fetch_history_by_soal($idsoal){
	$this->db->select("*,
		qc_history_before.soal as soal_before,
		qc_history_before.status  as status_before,
		qc_history_before.jawab_1  as jawab_1_before,
		qc_history_before.jawab_2  as jawab_2_before,
		qc_history_before.jawab_3  as jawab_3_before,
		qc_history_before.jawab_4  as jawab_4_before,
		qc_history_before.jawab_5  as jawab_5_before,
		qc_history_before.kunci_jawaban  as kunci_jawaban_before,
		qc_history_before.pembahasan  as pembahasan_before,
		qc_history_before.pembahasan_video  as pembahasan_video_before,
		qc_history_before.bobot  as bobot_before,
		qc_history_after.soal as soal_after,
		qc_history_after.status  as status_after,
		qc_history_after.jawab_1  as jawab_1_after,
		qc_history_after.jawab_2  as jawab_2_after,
		qc_history_after.jawab_3  as jawab_3_after,
		qc_history_after.jawab_4  as jawab_4_after,
		qc_history_after.jawab_5  as jawab_5_after,
		qc_history_after.kunci_jawaban  as kunci_jawaban_after,
		qc_history_after.pembahasan  as pembahasan_after,
		qc_history_after.pembahasan_video  as pembahasan_video_after,
		qc_history_after.bobot  as bobot_after
	");
	$this->db->from("qc_history");
	$this->db->join("qc_history_before", "qc_history.id_qc_history = qc_history_before.id_qc_history");
	$this->db->join("qc_history_after", "qc_history.id_qc_history = qc_history_after.id_qc_history");
	$this->db->join("login_adm", "qc_history.id_adm = login_adm.id_adm", "left");
	$this->db->where("qc_history.id_soal", $idsoal);
	$this->db->order_by("qc_history.id_qc_history", "desc");
	
	$query = $this->db->get();
	return $query->result();
}

function fetch_history_by_idhistory($idhistory){
	$this->db->select("*,
		qc_history_before.soal as soal_before,
		qc_history_before.status  as status_before,
		qc_history_before.jawab_1  as jawab_1_before,
		qc_history_before.jawab_2  as jawab_2_before,
		qc_history_before.jawab_3  as jawab_3_before,
		qc_history_before.jawab_4  as jawab_4_before,
		qc_history_before.jawab_5  as jawab_5_before,
		qc_history_before.kunci_jawaban  as kunci_jawaban_before,
		qc_history_before.pembahasan  as pembahasan_before,
		qc_history_before.pembahasan_video  as pembahasan_video_before,
		qc_history_before.bobot  as bobot_before,
		qc_history_after.soal as soal_after,
		qc_history_after.status  as status_after,
		qc_history_after.jawab_1  as jawab_1_after,
		qc_history_after.jawab_2  as jawab_2_after,
		qc_history_after.jawab_3  as jawab_3_after,
		qc_history_after.jawab_4  as jawab_4_after,
		qc_history_after.jawab_5  as jawab_5_after,
		qc_history_after.kunci_jawaban  as kunci_jawaban_after,
		qc_history_after.pembahasan  as pembahasan_after,
		qc_history_after.pembahasan_video  as pembahasan_video_after,
		qc_history_after.bobot  as bobot_after
	");
	$this->db->from("qc_history");
	$this->db->join("qc_history_before", "qc_history.id_qc_history = qc_history_before.id_qc_history");
	$this->db->join("qc_history_after", "qc_history.id_qc_history = qc_history_after.id_qc_history");
	$this->db->join("login_adm", "qc_history.id_adm = login_adm.id_adm", "left");
	$this->db->where("qc_history.id_qc_history", $idhistory);
	
	$query = $this->db->get();
	return $query->row();
}

}
?>
