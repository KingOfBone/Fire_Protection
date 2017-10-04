<?php
	$konek = mysqli_connect('localhost', 'root', '', 'apar');
	
	$jumlah = [1, 7, 216];
	for($i=1; $i<=1; $i++) { // KI
		$sql = "insert into table_user values(
			'', 
			'$i',
			$j,
			'APR-KODE/L$i/$j',
			'APR/L$i/$j',
			$kapasitas,
			'APR-MODEL/L$i/$j',
			$diameter,
			$tinggi,
			$tekanan_kerja,
			$tekanan_uji,
			$waktu_semprot,
			'2 s/d 7',
			'$kelas_kebakaran',
			'-20 s/d 60',
			'APAR R$j.jpg',
			'Merah',
			'Lantai $i',
			'Ruang $j',
			'lokasi apar.png',
			'2019-08-01 06:18:22'
		)";
		
		//echo "$sql <br>";
		mysqli_query($konek, $sql);
			
	}
?>

Berhasil !