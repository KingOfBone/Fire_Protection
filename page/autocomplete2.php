<?php
include "../config/koneksi.php";
	$q=$_GET['q'];
	$my_data=mysql_real_escape_string($q);
	$sql="SELECT *, CONCAT(nama_anggota,' (', nip,')') as namakode FROM tabel_anggota a, tabel_pinjaman b WHERE a.no_anggota = b.no_anggota and CONCAT(nama_anggota,' (', nip,')') LIKE '%$my_data%' GROUP BY CONCAT(nama_anggota,' (', nip,')')";
	$result = mysql_query($sql, $koneksimysql) or die(mysql_error());
	
	if($result)
	{
		while($row=mysql_fetch_array($result))
		{
			echo $row['namakode']."\n";
		}
	}
	
	
?>