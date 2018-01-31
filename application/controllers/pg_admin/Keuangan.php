<?php

class Keuangan extends CI_Controller{
function __construct(){
	parent::__construct();
	$this->load->library('form_validation');
	$this->load->helper('alert_helper');
	$this->load->model('model_adm');
	$this->load->model('model_pembayaran');
	$this->load->model('model_paket');
	$this->load->model('model_tryout');
	$this->load->model('model_banksoal');
	$this->load->model('model_security');
	$this->load->model('model_rekap');
	$this->load->model('model_kurikulum');
	$this->load->model('model_keuangan');
	$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
	$this->load->library('PHPRequests');
	$this->model_security->is_logged_in();
}

function dashboard(){
	$data = array(
		'navbar_title'	=> "Dashboard Keuangan",
	);
	$this->load->view("pg_admin/keuangan/dashboard", $data);
}

function tagihan(){
	$data = array(
		'navbar_title' 	=> "Tagihan",
		'datatagihan'	=> $this->model_keuangan->fetch_all_tagihan()
	);
	$this->load->view("pg_admin/keuangan/tagihan", $data);
}

function buat_tagihan(){
	$data = array(
		'navbar_title'	=> "Buat Tagihan",
		'dataprovinsi'	=> $this->model_keuangan->fetch_all_provinsi()
	);
	$this->load->view("pg_admin/keuangan/tagihan_form", $data);
}

function ajax_kota(){
	$params 	= $this->input->post(null, true);
	$idprovinsi	= $params['idprovinsi'];

	$datakota 	= $this->model_keuangan->fetch_kota_by_provinsi($idprovinsi);

	echo "<option value=''>-- Pilih Kota --</option>";
	foreach($datakota as $kota){
		?>
		<option value="<?php echo $kota->id_kota;?>"><?php echo $kota->nama_kota;?></option>
		<?php
	}
}

function ajax_sekolah(){
	$params 	= $this->input->post(null, true);
	$idkota 	= $params['idkota'];

	$datasekolah 	= $this->model_keuangan->fetch_sekolah_by_kota($idkota);

	echo "<option value=''>-- Pilih Sekolah --</option>";
	foreach($datasekolah as $sekolah){
		?>
		<option value='<?php echo $sekolah->id_sekolah;?>'>
			<?php echo $sekolah->nama_sekolah;?>
		</option>
		<?php
	}
}

function ajax_event(){
	//cari event yang sedang berlangsung
	$dataevent = $this->model_keuangan->fetch_event_berlangsung()

	?>
	<div class="col-sm-12">
		<select class="form-control" name="idevent" id="select-event" required>
			<option value="">--Pilih Event --</option>
			<?php
				foreach($dataevent as $event){
					?>
					<option value="<?php echo $event->id_event;?>"><?php echo $event->nama_event;?></option>
					<?php
				}
			?>
		</select>
	</div>
	<?php
}

function ajax_kelas_paralel(){
	$params 	= $this->input->post(null, true);
	$idsekolah 	= $params['idsekolah'];

	$datakelasparalel = $this->model_keuangan->fetch_kelas_paralel_by_sekolah($idsekolah);

	echo "<option value=''>-- Pilih Kelas --</option>";
	foreach($datakelasparalel as $kelas){
		?>
		<option value="<?php echo $kelas->id_kelas_paralel;?>"><?php echo $kelas->kelas_paralel;?></option>
		<?php
	}
}

function ajax_tahun_ajaran(){
	$params		= $this->input->post(null, true);
	$idsekolah 	= $params['idsekolah'];

	$datatahunajaran = $this->model_keuangan->fetch_tahun_ajaran_by_sekolah($idsekolah);

	echo "<option value=''>-- Pilih Tahun Ajaran --</option>";
	foreach($datatahunajaran as $tahun){
		?>
		<option value="<?php echo $tahun->id_tahun_ajaran;?>"><?php echo $tahun->tahun_ajaran;?></option>
		<?php
	}
}


function ajax_harga_paket(){
	$params 	= $this->input->post(null, true);
	$idpaket 	= $params['idpaket'];
	if($idpaket != 26){
		$paket = $this->model_keuangan->fetch_paket_by_id($idpaket);

		echo $paket->harga;
	}
}

function ajax_harga_event(){
	$params		= $this->input->post(null, true);
	$idevent 	= $params['idevent'];

	$event 		= $this->model_keuangan->fetch_event_by_id($idevent);

	echo $event->harga;
}

function ajax_tambah_kelas(){
	$params				= $this->input->post(null, true);
	$idkelasparalel 	= $params['idkelasparalel'];
	$idtahunajaran 		= $params['idtahunajaran'];
	$idpaket 			= $params['idpaket'];
	$tipe 				= $params['tipe'];
	$idevent 			= $params['idevent'];
	$hargasatuan 		= $params['hargasatuan'];
	$kelas 	= $this->model_keuangan->fetch_kelas_paralel_by_id($idkelasparalel);
	$tahun 	= $this->model_keuangan->fetch_tahun_ajaran_by_id($idtahunajaran);

	$jumsis = $this->model_keuangan->fetch_jumlah_siswa_kelas_psep($idkelasparalel, $idtahunajaran);

	if($tipe == 'reguler'){
		
		//$paket 	= $this->model_keuangan->fetch_paket_by_id($idpaket);

		$subtotal = $hargasatuan * $jumsis;
		
	}elseif($tipe == "event"){
		//$event 		= $this->model_keuangan->fetch_event_by_id($idevent);
		$subtotal = $hargasatuan * $jumsis;
	}
	?>
	<tr id="tr-detail-<?php echo $kelas->id_kelas_paralel;?>-<?php echo $tahun->id_tahun_ajaran;?>">
		<td>
			<?php echo $kelas->kelas_paralel;?> (<?php echo $tahun->tahun_ajaran;?>)
			<input type="hidden" name="kelas-tahun[]" class="input-kelas-tahun" value="<?php echo $kelas->id_kelas_paralel;?>-<?php echo $tahun->id_tahun_ajaran;?>" />
		</td>
		<td class="text-center">
			<?php echo $jumsis;?>
			<input type="hidden" name="jumsis-<?php echo $kelas->id_kelas_paralel;?>-<?php echo $tahun->id_tahun_ajaran;?>" value="<?php echo $jumsis;?>" />
		</td>
		<td style="text-align: right;">
			<?php echo $subtotal;?>
			<input type="hidden" name="subtotal-<?php echo $kelas->id_kelas_paralel;?>-<?php echo $tahun->id_tahun_ajaran;?>" class="input-subtotal" value="<?php echo $subtotal;?>" />
		</td>
		<td class="text-center">
			<button type="button" class="hapus-detail btn btn-sm btn-danger" id="<?php echo $kelas->id_kelas_paralel;?>-<?php echo $tahun->id_tahun_ajaran;?>"><i class="fa fa-times" aria-hidden="true"></i></button>
		</td>
	</tr>
	<?php
}

function proses_tagihan(){
	$params 		= $this->input->post(null, true);
	$idsekolah 		= $params['idsekolah'];
	$idpaket 		= $params['paket'];
	$kelastahun 	= $params['kelas-tahun'];
	$totalharga 	= $params['totalharga'];
	$nama 			= $params['nama'];
	$email 			= $params['email'];
	$hp 			= $params['hp'];
	$hargasatuan 	= $params['hargapaket'];

	if($idpaket == 26){
		$idevent = $params['idevent'];
	}else{
		$idevent = 0;
	}

	//insert pembelian
	$pembelian = $this->model_keuangan->simpan_tagihan($totalharga, $email, $nama, $hp, $idevent, $idsekolah);

	foreach($kelastahun as $kelasth){
		$explode = explode("-", $kelasth);
		$idkelasparalel 	= $explode[0];
		$idtahunajaran 		= $explode[1];
		$jumlah 			= $params['jumsis-' . $kelasth];

		//insert pembelian_detail
		$insertdetail = $this->model_keuangan->insert_pembelian_detail($pembelian, $idkelasparalel, $idtahunajaran, $idpaket, $jumlah, $hargasatuan);
	}

	//fetch sekolah
	$sekolah = $this->model_keuangan->fetch_sekolah_by_id($idsekolah);

	//fetch tagihan
	$tagihan = $this->model_keuangan->fetch_tagihan_by_id($pembelian);
	$dataxml = array(
		'bookingid'			=> $pembelian,
		'clientid'			=> $idsekolah,
		'customer_name'		=> substr($sekolah->nama_sekolah, 0, 25),
		'amount'			=> $totalharga,
		'productid'			=> $idpaket,
		'interval'			=> 2880,
		'username'			=> username_tfp,
		'booking_datetime'	=> $tagihan->timestamp,
		'signature'			=> md5(username_tfp . password_tfp . $pembelian)
	);

	$xml 	= '<?xml version="1.0"?>';
	$xml 	.= '<data>';
	$xml 	.= '<type>reqpaymentcode</type>';
	$xml 	.= '<bookingid>' . $dataxml['bookingid'] .'</bookingid>';
	$xml 	.= '<clientid>' . $dataxml['clientid'] .'</clientid>';
	$xml 	.= '<customer_name>' . $dataxml['customer_name'] .'</customer_name>';
	$xml 	.= '<amount>' . $dataxml['amount'] .'</amount>';
	$xml 	.= '<productid>' . $dataxml['productid'] .'</productid>';
	$xml 	.= '<interval>' . $dataxml['interval'] .'</interval>';
	$xml 	.= '<username>' . $dataxml['username'] .'</username>';
	$xml 	.= '<booking_datetime>' . $dataxml['booking_datetime'] .'</booking_datetime>';
	$xml 	.= '<signature>' . $dataxml['signature'] .'</signature>';
	$xml 	.= '</data>';
	//send xml ke arta jasa untuk mendapatkan payment code
	//$xml 		= $this->load->view("pg_admin/keuangan/xml_reqpaymentcode", $dataxml);
	$this->model_keuangan->insert_payment_tracking($pembelian, 'reqpaymentcode', $xml);

	$reqpaymentcode = $this->reqpaymentcode($xml);
	//var_dump($reqpaymentcode);
	//insert payment_tracking
	if($reqpaymentcode == false){
		$this->model_keuangan->delete_pembelian($pembelian);
		?>
		<script type="text/javascript">
			alert('Gagal Mendapatkan Payment Code, Error(<?php echo $reqpaymnetcode['ack'] ;?>)');
			window.location.href = "<?php echo base_url("pg_admin/keuangan/tagihan");?>";
		</script>
		<?php
		return true;
	}
	
	$this->model_keuangan->insert_payment_tracking($pembelian, $reqpaymentcode['type'], $reqpaymentcode['rawxml']);
	if($reqpaymentcode['ack'] != '00'){
		$this->model_keuangan->delete_pembelian($pembelian);
		?>
		<script type="text/javascript">
			alert('Gagal Mendapatkan Payment Code, Error(<?php echo $reqpaymnetcode['ack'] ;?>)');
			window.location.href = "<?php echo base_url("pg_admin/keuangan/tagihan");?>";
		</script>
		<?php
		return true;
	}else{
		//insert vaid ke tabel pembelian
		$insertvaid = $this->model_keuangan->edit_vaid($pembelian, $reqpaymentcode['vaid']);		
		?>
		<script type="text/javascript">
			alert('Sukses');
			window.location.href = "<?php echo base_url("pg_admin/keuangan/tagihan");?>";
		</script>
		<?php
		return true;
	}
}

function reqpaymentcode($xml, $retry = 0){
	$urlpost 	= url_reqpaymentcode;

	$headers 	= array('Content-Type' => 'application/xml');
	$options	= array('timeout' => 60000);
	$response 	= Requests::post($urlpost, $headers, $xml, $options);
	
	if($response->success){
		//var_dump($response->body);
		$xmlres 	= simplexml_load_string($response->body);
		$data = array(
			'rawxml'		=> $response->body,
			'type'			=> (string)$xmlres->type,
			'ack'			=> (string)$xmlres->ack,
			'bookingid'		=> (string)$xmlres->bookingid,
			'vaid'			=> (string)$xmlres->vaid,
			'bankcode'		=> (string)$xmlres->bankcode,
			'signature'		=> (string)$xmlres->signature
		);
		return $data;
	}else{
		if($retry <= 3){
			$retry++;
			$this->reqpaymentcode($xml, $retry);
		}else{
			return $false;
		}
	}
}

function cetak_tagihan($idpembelian){
	$this->load->library('pdf');
	$tagihan = $this->model_keuangan->fetch_tagihan_by_id($idpembelian);
	$data = array(
		'tagihan'	=> $this->model_keuangan->fetch_tagihan_by_id($idpembelian)
	);
	$html = $this->load->view('pg_admin/keuangan/pdf_tagihan', $data, true);
	$this->pdf->pdf_create($html, url_title("tagihan ". $tagihan->no_tagihan, '-', true),'A4','potrait', true);
	//$this->load->view('pg_admin/keuangan/pdf_tagihan', $data);
}

function transaction_status($idpembelian){
	$tagihan = $this->model_keuangan->fetch_tagihan_by_id($idpembelian);
	
	$trx = $this->reqtrxstatus($tagihan->vaid, $tagihan->timestamp, $tagihan->id_pembelian);

	echo$trx;
	$data = array(
		'navbar_title'	=> "Buat Tagihan",
		'tagihan'	=> $tagihan 
	);

	//$this->load->view("pg_admin/keuangan/transaction_detail", $data);
}

function reqtrxstatus($vaid, $booking_datetime, $idpembelian){
	$signature = md5(username_tfp . password_tfp . $idpembelian);
	$xml = '<?xml version="1.0" ?>';
	$xml .= "<notification>";
	$xml .= "<type>reqtrxstatus</type>";
	$xml .= "<item01>";
	$xml .= "<vaid>" . $vaid . "</vaid>";
	$xml .= "<booking_datetime>" . $booking_datetime . "</booking_datetime>";
	$xml .= "<username>" . username_tfp . "</username>";
	$xml .= "<signature>" . $signature . "</signature>";
	$xml .= "</item01>";
	$xml .= "</notification>";

	$urlpost 	= url_reqtrxstatus;
	$options	= array('timeout' => 60000);
	$headers 	= array('Content-Type' => 'application/xml');
	
	$response 	= Requests::post($urlpost, $headers, $xml, $options);
	//var_dump($response->body);
	$xmlres 	= $response->body;

	return $xmlres;
}

}
?>