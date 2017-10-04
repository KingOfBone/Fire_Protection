<?php
	$konek = mysqli_connect('localhost', 'root', '', 'apar');
	
	$penempatan_lokasi = [
		'RUANG KONTROL',
		'RUANG PLC',
		'RUANG AC/DC',
		'RUANG BATTERE'
	];
	
	for($i=1; $i<=20; $i++) { // Merk
		for($j=1; $j<=4; $j++) { // Jenis_Api
			$kapasitas = rand(10, 100);
			$diameter = rand(100, 200);
			$tinggi = rand(300, 600);
			$tekanan_kerja = rand(15, 18);
			$tekanan_uji = rand(15, 25);
			$waktu_semprot = rand(9, 25);
			$kelas_kebakaran = "ABC";
			
			$sql = "insert into APAR values(
				'', 
				$i,
				$j,
				'APR-KODE/L$i/$j',
				$j,
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
				'".$penempatan_lokasi[($j-1)]."',
				'lokasi apar.png',
				'2017-07-01 06:18:22',
				'2017-08-01 06:18:22',
				'2017-09-01 06:18:22',
				'2019-09-02 06:18:22',
				'baik',
				''
			)";
			
			//echo "$sql <br>"; die();
			mysqli_query($konek, $sql);
		}
	}
?>

Berhasil !