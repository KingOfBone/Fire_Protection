<?php
	$konek = mysqli_connect('localhost', 'root', '', 'tabs_apar');
	
	for($i=1; $i<=20; $i++) { // BaseCamp
		for($j=1; $j<=5; $j++) { //GI
			for($k=1; $k<=5; $k++) { //Lantai
				$sql = "insert into Lantai values('', $j, $k, 'lokasi apar.png', 'aktif')";
				mysqli_query($konek, $sql);
			}
		}
	}
?>

Berhasil !