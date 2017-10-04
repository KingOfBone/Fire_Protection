<?php
	$konek = mysqli_connect('localhost', 'root', '', 'tabs_apar');
	
	$jenis_api = [
		'Dry Powder Extinguisher',
		'Gas Extinguisher',
		'Foam Extinguisher',
		'Carbondioxide Extinguisher'
	];
	
	for($i=1; $i<=20; $i++) {
		foreach($jenis_api as $ja) {
			$sql = "insert into Jenis values('', $i, '$ja')";
			mysqli_query($konek, $sql);
		}
	}
?>

Berhasil !