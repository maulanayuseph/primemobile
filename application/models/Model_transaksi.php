<?php 

/**
* 
*/
class Model_transaksi extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function get_trans($tipe,$cari,$offset=0,$limit=0){
		$this->db->select("pembelian.no_tagihan, pembelian.siswa_id, pembelian.total_harga, pembelian.metode_pembayaran, pembelian.status, pembelian.status as angka_status, pembelian.expired_on, pembelian.id_pembelian, pembelian.file_bukti, pembelian.status, pembelian.email, pembelian.nama, siswa.nama_siswa, siswa.email as email_siswa, siswa.telepon as telepon_siswa");
		$this->db->from("pembelian");
		$this->db->join("siswa", "siswa.id_siswa = pembelian.siswa_id","left");
		$this->db->order_by("pembelian.expired_on", "DESC");
		$this->db->order_by("siswa.nama_siswa", "ASC");

		if ($cari != '0'){
			$this->db->like("siswa.nama_siswa", $cari);
			$this->db->or_like("pembelian.email", $cari);
			$this->db->or_like("siswa.email", $cari);
			$this->db->or_like("pembelian.no_tagihan", $cari);
		}

		//Registered
		if ($tipe == 0){
			$this->db->where("pembelian.siswa_id !=", 0);
			$this->db->where("pembelian.metode_pembayaran <", 3);
		//Umum
		} else if ($tipe == 1){
			$this->db->where("pembelian.siswa_id", 0);
			$this->db->where("pembelian.metode_pembayaran <", 3);
		//Sekolah
		} else if ($tipe == 2){
			$this->db->where("pembelian.siswa_id", 0);
			$this->db->where("pembelian.metode_pembayaran", 4);
		//Indihome
		} else if ($tipe == 3){
			$this->db->where("pembelian.siswa_id !=", 0);
			$this->db->where("pembelian.metode_pembayaran", 3);
		//Demo
		} else if ($tipe == 4){
			$this->db->where("pembelian.siswa_id", 0);
			$this->db->where("pembelian.metode_pembayaran", 5);
		}

		if ($limit > 0){
			$this->db->limit($limit, $offset);
		}
		$result=$this->db->get();
		return $result;
	}

	function get_info_pembayaran($id_pembelian){
		$this->db->select("pembelian.id_pembelian, pembelian.no_tagihan, pembelian.siswa_id, pembelian.kelas_id, pembelian.metode_pembayaran, pembelian.total_harga, pembelian.file_bukti, pembelian.status, pembelian.timestamp, pembelian.expired_on, pembelian.id_event, pembelian_detail.id_detail, pembelian_detail.pembelian_id, pembelian_detail.paket_id, pembelian_detail.jumlah, pembelian_detail.harga_satuan, siswa.nama_siswa, siswa.email, pembelian.email as email_umum, siswa.telepon as telepon_siswa");
		$this->db->from("pembelian");
		$this->db->join("pembelian_detail", "pembelian_detail.pembelian_id=pembelian.id_pembelian");
		$this->db->join("siswa", "pembelian.siswa_id = siswa.id_siswa","left");
		$this->db->where("pembelian.id_pembelian", $id_pembelian);
		$result=$this->db->get();

		return $result->result();
	}
	
	function aktivasi_voucher($idpaket, $idkelas, $keterangan, $idpembelian){
   		$this->db->set('id_pembelian', $idpembelian);
		$this->db->where('kode_voucher >', 0);
		$this->db->where('no_aktivasi >', 0);
		$this->db->where('paket_id', $idpaket);
		$this->db->where('ket', $keterangan);
		$this->db->where('id_pembelian', 0);
		$this->db->where('status', 0);
		$this->db->order_by('kode_voucher', 'ASC');
		$this->db->limit(1, 0);
		$query = $this->db->update('voucher');
		
		return $query;
	}
	
	//TAMBAHAN FUNGSI UNTUK AKTIVASI EVENT
	//####################################
	//####################################
	//####################################
	function fetch_pembayaran_by_id($idpembelian){
		$this->db->select("*");
		$this->db->from("pembelian");
		$this->db->where("id_pembelian", $idpembelian);

		$result=$this->db->get();
		return $result->row();
	}

	function insert_voucher_event($idevent, $voucher){
		$data = array(
			'id_event'		=> $idevent,
			'kode_voucher'	=> $voucher
		);
		$this->db->insert("event_x_voucher", $data);
	}
	//END TAMBAHAN FUNGSI UNTUK AKTIVASI EVENT
	//####################################
	//####################################
	//####################################
	function update_status($status, $id_pembelian)
	{
		$data = array('status' => $status);
		$this->db->where('id_pembelian', $id_pembelian);
		$result = $this->db->update("pembelian", $data);

		return $result;
	}

	function cari_voucher($idpembelian){
			$this->db->select("
			voucher.kode_voucher,
			voucher.no_aktivasi,
			paket.durasi,
			paket.tipe
			");
			$this->db->from("voucher");
			$this->db->join("paket", "voucher.paket_id = paket.id_paket");
			$this->db->where("voucher.id_pembelian", $idpembelian);
			$result=$this->db->get();

			return $result->result();
	}
	
	function hapus_pembayaran($idpembelian){
		$this->db->delete('pembelian', array('id_pembelian' => $idpembelian));
		$this->db->delete('pembelian_detail', array('pembelian_id' => $idpembelian));
	}
	
	function simpan($data_pembelian, $detail_pembelian)
	{
		//insert data into table pembelian
		$query = $this->db->insert('pembelian', $data_pembelian);
		
		$pembelian_id = $this->db->insert_id();
		if($pembelian_id)
		{
			$grand_total  = 0;
			$no_tagihan		= 'PM'.date('md').$pembelian_id.date('s'); //pattern is PM,month,day,id_pembelian,seconds  

			foreach ($detail_pembelian as $item) 
			{
				if ($item['metode'] != 5){
					$hargasat = $item['harga_satuan'];
				} else {
					$hargasat = $item['harga_satuan'];
				}
				$harga = ($item['jumlah'] * $hargasat);
				//count grand total
				$grand_total = $grand_total + ($harga - ($harga * ($item['disc']/100)));
				//insert each item into table pembelian_detail
				$data = array(
					'pembelian_id' => $pembelian_id, 
					'paket_id' 		 => $item['id_paket'], 
					'harga_satuan' => $hargasat, 
					'jumlah' 		 	 => $item['jumlah']
					);
				$query = $this->db->insert('pembelian_detail', $data);
			}

			//update data total_harga in table Pembelian
			$this->db->set('no_tagihan', $no_tagihan);
			$this->db->set('total_harga', $grand_total);
			$this->db->where('id_pembelian', $pembelian_id);
			$this->db->update('pembelian');
		}
		
		return $pembelian_id;
	}

	function get_pembelian($id_pembelian)
	{
		$this->db->select("*");
		$this->db->from("pembelian");
		$this->db->join("siswa", "siswa.id_siswa = pembelian.siswa_id");
		$this->db->where("pembelian.id_pembelian", $id_pembelian);
		$query = $this->db->get();

		return $query->row();
	}

	function get_pembelian_umum($id_pembelian)
	{
		$this->db->select("*");
		$this->db->from("pembelian");
		$this->db->where("pembelian.id_pembelian", $id_pembelian);
		$query = $this->db->get();

		return $query->row();
	}

	function get_detail_pembelian($id_pembelian)
	{
		$this->db->select("paket.kode_paket, paket.durasi, paket.tipe, pembelian_detail.harga_satuan, pembelian_detail.jumlah");
		$this->db->from("pembelian_detail");
		$this->db->join("paket", "paket.id_paket = pembelian_detail.paket_id");
		$this->db->where("pembelian_detail.pembelian_id", $id_pembelian);
		$query = $this->db->get();

		return $query->result();
	}

}
