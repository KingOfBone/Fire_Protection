<?php
	$konek = mysqli_connect('localhost', 'root', '', 'master');
	
	// "kode login"=>[["kode aplikasi", "kode aplikasi"], ["kode aplikasi", "kode aplikasi"]]
	// Kode Aplikasi Apar = 4
	$kode_login = [6=>[4], 7=>[4]];
	$jumlah_aplikasi = 6;
	
	$ar_key = array_keys($kode_login);
	foreach($kode_login as $key=>$kolo) {
		for($i=1; $i<=$jumlah_aplikasi; $i++) { // kode_aplikasi			
			
			if(in_array($i, $kolo)) {
				$keys = $i;
				$status = 'aktif';
			}
			else {
				$keys = $i;
				$status = 'nonaktif';
			}
			
			
			
			$sql = "insert into userakses values(
				'', 
				'$key',
				$i,
				'$status'				
			)";
			
			echo "$sql; <br>";
			//mysqli_query($konek, $sql);				
		}
	}
?>

Berhasil !