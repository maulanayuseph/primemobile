<?php
foreach($table_data as $data){
	echo "<p>Kode Voucher : " . $data->kode_voucher . " Untuk durasi ";
	if($data->tipe == "0"){
	echo $data->durasi . " Bulan (Reguler)";
	}else{
	echo $data->durasi . " Bulan (Premium)";
	}
}
?>