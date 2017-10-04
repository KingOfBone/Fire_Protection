<?php
	$konek = mysqli_connect('localhost', 'root', '', 'tabs_apar');
	
	for($i=1; $i<=7; $i++) { // GI
		for($j=1; $j<=3; $j++) { // APAR - Lantai - Ruang - APAR
			$sql = "insert into Lokasi values('', ".($i*$j).", 'Lantai $j', 'Ruang $j', 'lokasi apar.png')";
			mysqli_query($konek, $sql);
		}
	}
?>

Berhasil !