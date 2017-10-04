<?php
	$konek = mysqli_connect('localhost', 'root', '', 'tabs_apar');
	
	for($i=1; $i<=20; $i++) { // BaseCamp
		for($j=1; $j<=5; $j++) { //GI
			for($k=1; $k<=5; $k++) { //Lantai
				for($l=1; $l<=3; $l++) { //APAR
					$sql = "insert into APAR values('', $k, 'APR/R$i/GI$j/L$k/$l', 'APAR R$l.jpg', 'aktif')";
					mysqli_query($konek, $sql);
				}
			}
		}
	}
?>

Berhasil !