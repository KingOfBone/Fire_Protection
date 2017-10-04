<?php
	$konek = mysqli_connect('localhost', 'root', '', 'tabs_apar');
	
	for($i=1; $i<=20; $i++) {
		$sql = "insert into basecamp values('', 'BaseCamp $i', 'aktif')";
		mysqli_query($konek, $sql);
	}
?>

Berhasil !