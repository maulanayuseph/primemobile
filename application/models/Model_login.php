<?php 

/**
* 
*/
class Model_login extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function cek_login($username, $password)
	{
		$result = null;
		//old - Not Used
		// $data = array(
		// 	"username" => $username,
		// 	"password" => md5($password)
		// 	);

		$this->db->select("siswa.id_siswa, siswa.nama_siswa, siswa.kelas, siswa.email, siswa.foto, siswa.last_login, login_siswa.username");
		$this->db->from("login_siswa");
		$this->db->join("siswa", "siswa.id_login = login_siswa.id_login");
		$this->db->where("(username = '$username' OR email = '$username')");
		// $this->db->where('username', $username);
		// $this->db->or_where('email', $username);
		$this->db->where('password', md5($password));
		// echo $this->db->_compile_select();
		// die();	
		$result = $this->db->get();
		return $result->row_array();
	}
	
	function cek_login_ortu($username, $password){
		$result = null;
		//old - Not Used
		// $data = array(
		// 	"username" => $username,
		// 	"password" => md5($password)
		// 	);

		$this->db->select("*");
		$this->db->from("parents");
		$this->db->join("siswa", "siswa.id_siswa = parents.id_siswa");
		$this->db->where("(parents.username = '$username' OR parents.email = '$username')");
		// $this->db->where('parents.username', $username);
		// $this->db->or_where('parents.email', $username);
		$this->db->where('parents.password', md5($password));
		// echo $this->db->_compile_select();
		// die();	
		$query 	= $this->db->get();
		$data 	= $query->row();
		return $data;
	}
	
	function cek_akun_fb($fb_id)
	{
		$this->db->select("siswa.id_siswa, siswa.nama_siswa, siswa.email, siswa.foto, siswa.last_login, login_siswa.username, login_siswa.fb_id");
		$this->db->from("login_siswa");
		$this->db->join("siswa", "siswa.id_login = login_siswa.id_login");
		$this->db->where('login_siswa.fb_id', $fb_id);
		// echo $this->db->_compile_select();
		$query = $this->db->get();

		return $query->row_array();
	}

	function cek_user_akses2($id_siswa)
	{
		$this->db->select("paket_aktif.id_paket_aktif, paket_aktif.id_siswa, paket_aktif.id_kelas, paket_aktif.id_paket, paket_aktif.expired_on, paket_aktif.isaktif, paket.tipe ");
		$this->db->from("paket_aktif");
		// $this->db->join("pembayaran", "pembayaran.id_pembayaran = paket_aktif.id_pembayaran");
		$this->db->join("paket", "paket.id_paket = paket_aktif.id_paket");
		$this->db->where('paket_aktif.id_siswa', $id_siswa);
		$this->db->where('paket_aktif.isaktif', 1); //selecting only the active paket
		// echo $this->db->_compile_select();
		$query = $this->db->get();

		return $query->result();
	}

	function cek_user_akses($idsiswa)
	{
		$tanggalsekarang = date('Y-m-d');
		$this->db->select("*");
		$this->db->from('paket_aktif');
		$this->db->join("paket", "paket_aktif.id_paket = paket.id_paket", "left");
		$this->db->where('id_siswa', $idsiswa);
		$this->db->where("expired_on >=", $tanggalsekarang);
		$this->db->where("paket.tipe", 0);
		$this->db->where("paket_aktif.isaktif", 1);
		$this->db->limit(0,1);
		if($this->db->count_all_results() > 0){
			$this->db->select("*");
			$this->db->from('paket_aktif');
			$this->db->join("paket", "paket_aktif.id_paket = paket.id_paket", "left");
			$this->db->where('id_siswa', $idsiswa);
			$this->db->where("expired_on >=", $tanggalsekarang);
			$this->db->where("paket.tipe", 0);
			$this->db->where("paket_aktif.isaktif", 1);
			$this->db->limit(0,1);

			$query = $this->db->get();
			return $query->result();
		}else{
			$this->db->select("*");
			$this->db->from('paket_aktif');
			$this->db->join("paket", "paket_aktif.id_paket = paket.id_paket", "left");
			$this->db->where('id_siswa', $idsiswa);
			$this->db->where("expired_on >=", $tanggalsekarang);
			$this->db->where("paket_aktif.isaktif", 1);
			$this->db->limit(0,1);

			$query = $this->db->get();
			return $query->result();
		}
	}

	function set_to_inactive($id_paket_aktif)
	{
		$this->db->set('isaktif', 0); //set paket to 'not active'
		$this->db->where('paket_aktif.id_paket_aktif', $id_paket_aktif);
		$result = $this->db->update('paket_aktif');

		return $result;
	}
	function cek_user_sbmptn($idsiswa){
		$this->db->select("*");
		$this->db->from("paket_aktif");
		$this->db->where("id_siswa", $idsiswa);
		
		$query 	= $this->db->get();
		$data 	= $query->row();
		return $data;
	}

}