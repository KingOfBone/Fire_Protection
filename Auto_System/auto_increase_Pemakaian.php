<?php
	$konek = mysqli_connect('localhost', 'root', '', 'tabs_apar');
	
	for($i=1; $i<=400; $i++) {
		$pakai = rand(20, 90);
		$sisa = 100 - $pakai;
		
		$sql = "insert into Pemakaian values('', $i, $pakai, $sisa, 'Lancar', '2017/02/02')";
		//echo $sql; die();
		mysqli_query($konek, $sql);		
	}
?>

Berhasil !