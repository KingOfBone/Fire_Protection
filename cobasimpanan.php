<?php


    ob_start();
	session_start();
    
    date_default_timezone_set("Asia/Jakarta");
    if( ! isset($_SESSION["level"])) header("location:login.php");
	include    "page/fungsi.php";
    include     "config/koneksi.php";
    include     "config/utility.php";

$sqlanggota = mysql_query("select * from tabel_anggota");

while ($anggota = mysql_fetch_array($sqlanggota)) {



// }
}


$sqlsimpanan = mysql_query("select * from tabel_simpanan a, tabel_anggota b where a.no_anggota = b.no_anggota");
$no=0;
$numsimp = mysql_num_rows($sqlsimpanan);

echo $numsimp;
while ($simpanan = mysql_fetch_array($sqlsimpanan)) {
$no++;

// echo $no."no_anggota :".$simpanan['no_anggota']."<br>";

}
?>