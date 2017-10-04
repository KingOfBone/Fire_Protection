<?php
	$kodelogin = [1, 2];
	
	foreach($kodelogin as $kolo) {
		for($i=1; $i<=6; $i++) {
			echo "insert into userakses values('', $kolo, $i, 'aktif')";
		}
	}
?>