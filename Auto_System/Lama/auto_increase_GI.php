<?php
	$konek = mysqli_connect('localhost', 'root', '', 'tabs_apar');
	
	for($i=1; $i<=20; $i++) {
		for($j=1; $j<=5; $j++) {
			$sql = "insert into GI values('', $i, 'GI Region $j', 'aktif')";
			mysqli_query($konek, $sql);
		}
	}
?>

Berhasil !