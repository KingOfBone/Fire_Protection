<?php
	$konek = mysqli_connect('localhost', 'root', '', 'tabs_apar');
	
	for($i=1; $i<=20; $i++) {
		for($j=1; $j<=20; $j++) {
			$sql = "insert into Maintenance values('', $j, 'Jangan telat lagi maintenancenya', '2017/02/02', 'bisa dipakai untuk 1 tahun', 100)";
			//echo 
			mysqli_query($konek, $sql);
		}
	}
?>

Berhasil !