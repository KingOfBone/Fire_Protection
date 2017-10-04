<?php
include "../config/koneksi.php";
	$q=$_GET['q'];
	$my_data=mysql_real_escape_string($q);
	$sql="SELECT *, CONCAT(nama_anggota,' (', nip,')') as namakode FROM tabel_anggota WHERE CONCAT(nama_anggota,' (', nip,')') LIKE '%$my_data%' ORDER BY nama_anggota";
	$result = mysql_query($sql, $koneksimysql) or die(mysql_error());
	
	if($result)
	{
		while($row=mysql_fetch_array($result))
		{
			echo $row['namakode']."\n";
		}
	}
	
	
?>