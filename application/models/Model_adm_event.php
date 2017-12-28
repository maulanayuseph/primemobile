<?php 
class Model_adm_event extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

function fetch_all_event(){
	$this->db->select("*");
	$this->db->from("event");

	$result = $this->db->get();
	return $result->result();
}

function fetch_cbt_event(){
	$this->db->select("*");
	$this->db->from("profil_tryout");
	$this->db->join("kelas", "profil_tryout.id_kelas = kelas.id_kelas", "left");
	$this->db->where("tipe", 5);

	$result = $this->db->get();
	return $result->result();
}

function fetch_event_by_id($idevent){
	$this->db->select("*");
	$this->db->from("event");
	$this->db->where("id_event", $idevent);

	$result = $this->db->get();
	return $result->row();
}

function assign_cbt_event($idevent, $idprofil){
	$this->db->select("*");
	$this->db->from("event_x_cbt");
	$this->db->where("event_x_cbt.id_event", $idevent);
	$this->db->where("id_profil", $idprofil);
	if($this->db->count_all_results() == 0){
		$data = array(
			'id_event'	=> $idevent,
			'id_profil'	=> $idprofil
		);
		$this->db->insert("event_x_cbt", $data);
	}
}

function cek_cbt_event($idevent, $idprofil){
	$this->db->select("*");
	$this->db->from("event_x_cbt");
	$this->db->where("id_event", $idevent);
	$this->db->where("id_profil", $idprofil);
	return $this->db->count_all_results();
}

function fetch_cbt_by_event($idevent){
	$this->db->select("*");
	$this->db->from("event_x_cbt");
	$this->db->join("profil_tryout", "event_x_cbt.id_profil = profil_tryout.id_tryout", "left");
	$this->db->join("kelas", "profil_tryout.id_kelas = kelas.id_kelas", "left");
	$this->db->where("event_x_cbt.id_event", $idevent);

	$result = $this->db->get();
	return $result->result();
}

function fetch_cbt_by_id($idprofil){
	$this->db->select("*");
	$this->db->from("profil_tryout");
	$this->db->join("kelas", "profil_tryout.id_kelas = kelas.id_kelas", "left");
	$this->db->where("id_tryout", $idprofil);

	$result = $this->db->get();
	return $result->row();
}

function fetch_provinsi(){
	$this->db->select("*");
	$this->db->from("provinsi");
	$this->db->order_by("nama_provinsi", "ASC");
	$result = $this->db->get();
	return $result->result();
}

function fetch_kota_by_provinsi($idprovinsi){
	$this->db->select("*");
	$this->db->from("kota_kabupaten");
	$this->db->where("provinsi_id", $idprovinsi);
	$this->db->order_by("nama_kota", "ASC");

	$result = $this->db->get();
	return $result->result();
}

function fetch_sekolah_by_kota_and_jenjang($idkota, $jenjang){
	$this->db->select("*");
	$this->db->from("sekolah");
	$this->db->where("kota_id", $idkota);
	$this->db->where("jenjang", $jenjang);
	$this->db->order_by("nama_sekolah", "ASC");

	$result = $this->db->get();
	return $result->result();
}

function fetch_kelas_by_jenjang($jenjang){
	$this->db->select("*");
	$this->db->from("kelas");
	$this->db->where("jenjang", $jenjang);

	$result = $this->db->get();
	return $result->result();
}

function fetch_jadwal_by_tryout_and_event($idevent, $idprofil){
	$this->db->select("*, jadwal_event_cbt.start_date as mulai_date, jadwal_event_cbt.end_date as selesai_date");
	$this->db->from("jadwal_event_cbt");
	$this->db->join("event", "jadwal_event_cbt.id_event = event.id_event", "left");
	$this->db->join("profil_tryout", "jadwal_event_cbt.id_profil = profil_tryout.id_tryout", "left");
	$this->db->join("sekolah", "jadwal_event_cbt.id_sekolah = sekolah.id_sekolah", "left");
	$this->db->where("jadwal_event_cbt.id_event", $idevent);
	$this->db->where("jadwal_event_cbt.id_profil", $idprofil);
	$result = $this->db->get();
	return $result->result();
}

function fetch_kelas_by_id($idkelas){
	$this->db->select("*");
	$this->db->from("kelas");
	$this->db->where("id_kelas", $idkelas);
	$result = $this->db->get();
	return $result->row();
}

function tambah_jadwal($idevent, $idprofil, $idsekolah, $startdate, $enddate){
	$data = array(
		'id_event'		=> $idevent,
		'id_profil'		=> $idprofil,
		'id_sekolah'	=> $idsekolah,
		'start_date'	=> $startdate,
		'end_date'		=> $enddate
	);
	$this->db->insert("jadwal_event_cbt", $data);
}

function fetch_jadwal_by_id($idjadwal){
	$this->db->select("*");
	$this->db->from("jadwal_event_cbt");
	$this->db->where("id_jadwal_event_cbt", $idjadwal);

	$result = $this->db->get();
	return $result->row();
}

function hapus_jadwal($idjadwal){
	$this->db->where("id_jadwal_event_cbt", $idjadwal);
	$this->db->delete("jadwal_event_cbt");
}

function delete_cbt_event($idevent, $idprofil){
	$data = array(
		'id_event'	=> $idevent,
		'id_profil'	=> $idprofil
	);
	$this->db->delete("event_x_cbt", $data);
}

function fetch_siswa_by_sekolah($idsekolah){
	$this->db->select("*");
	$this->db->from("siswa");
	$this->db->where("sekolah_id", $idsekolah);

	$result = $this->db->get();
	return $result->result();
}

function fetch_kategori_by_profil($idprofil){
	$this->db->select("*");
	$this->db->from("kategori_tryout");
	$this->db->where("id_profil", $idprofil);

	$result = $this->db->get();
	return $result->result();
}

function hapus_analisis_waktu($idsiswa, $idkategori){
	$data = array(
		'id_siswa'		=> $idsiswa,
		'id_kategori'	=> $idkategori
	);
	$this->db->delete("analisis_waktu", $data);
}

function hapus_analisis_topik($idsiswa, $idkategori){
	$data = array(
		'id_siswa'	=> $idsiswa,
		'id_kategori'	=> $idkategori
	);
	$this->db->delete("analisis_topik", $data);
}

function hapus_elapsed_time($idsiswa, $idkategori){
	$data = array(
		'id_siswa'		=> $idsiswa,
		'id_kategori'	=> $idkategori
	);
	$this->db->delete("elapsed_time", $data);
}

function fetch_siswa_by_id($idsiswa){
	$this->db->select("*");
	$this->db->from("siswa");
	$this->db->join("sekolah", "siswa.sekolah_id = sekolah.id_sekolah");
	$this->db->join("kota_kabupaten", "sekolah.kota_id = kota_kabupaten.id_kota");
	$this->db->join("provinsi", "kota_kabupaten.provinsi_id = provinsi.id_provinsi", "left");
	$this->db->where("id_siswa", $idsiswa);

	$result = $this->db->get();
	return $result->row();
}

function fetch_siswa_include_wilayah($idsiswa){
	$this->db->select("*");
	$this->db->from("siswa");
	$this->db->join("sekolah", "siswa.sekolah_id = sekolah.id_sekolah");
	$this->db->join("kota_kabupaten", "sekolah.kota_id = kota_kabupaten.id_kota");
	$this->db->join("wilayah_x_kota", "kota_kabupaten.id_kota = wilayah_x_kota.id_kota", "left");
	$this->db->where("id_siswa", $idsiswa);

	$result = $this->db->get();
	return $result->row();
}

function fetch_cbt_by_event_and_kelas($idevent, $idkelas){
	$this->db->select("*");
	$this->db->from("profil_tryout");
	$this->db->join("event_x_cbt", "profil_tryout.id_tryout = event_x_cbt.id_profil", "left");
	$this->db->where("event_x_cbt.id_event", $idevent);
	$this->db->where("profil_tryout.id_kelas", $idkelas);
	$result = $this->db->get();
	return $result->result();
}

function peringkat_event($idevent, $idkelas){
	$this->db->select("sum(analisis_topik.status) AS jumlah_benar,
		(
		select sum(time_to_sec(analisis_waktu.dikerjakan)) 
		from analisis_waktu 
		inner join kategori_tryout on analisis_waktu.id_kategori = kategori_tryout.id_kategori
		inner join profil_tryout on kategori_tryout.id_profil = profil_tryout.id_tryout
		where id_siswa = analisis_topik.id_siswa
		) as waktu_kerja,
		id_siswa
	");
	$this->db->from("analisis_topik");
	$this->db->join('kategori_tryout', 'analisis_topik.id_kategori=kategori_tryout.id_kategori', 'left');
	$this->db->join('profil_tryout', 'kategori_tryout.id_profil=profil_tryout.id_tryout', 'left');
	$this->db->join("event_x_cbt", "profil_tryout.id_tryout = event_x_cbt.id_profil", "left");
	$this->db->where("analisis_topik.status", 1);
	$this->db->where("event_x_cbt.id_event", $idevent);
	$this->db->where("profil_tryout.id_kelas", $idkelas);
	$this->db->group_by("event_x_cbt.id_event");
	$this->db->group_by("analisis_topik.id_siswa");
	$this->db->order_by("jumlah_benar", "desc");
	$this->db->order_by("waktu_kerja", "asc");
	
	$query = $this->db->get();
	return $query->result();
}

function fetch_wilayah(){
	$this->db->select("*");
	$this->db->from("wilayah");

	$query = $this->db->get();
	return $query->result();
}

}
?>
