<?php
include "../../config/koneksi.php";
/*
$dbHost = 'localhost';
$dbUsername = 'kptp8438_aspuser';
$dbPassword = 'BDTz9xbQEv1I';
$dbName = 'kptp8438_aspdb';
//connect with the database
$db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
*/
//get search term
$searchTerm = $_GET['term'];
$my_data=mysql_real_escape_string($searchTerm);
//get matched data from skills table
//$query = $db->query("SELECT *, CONCAT(nama_anggota,' (', nip,')') as namakode FROM tabel_anggota WHERE CONCAT(nama_anggota,' (', nip,')') LIKE '%$my_data%' ORDER BY nama_anggota ASC");

$th = date('Y')-55;
$query = mysql_query("SELECT nama_anggota, nip FROM tabel_anggota WHERE substr(nip,1,2) = substr($th,3,4)  AND nama_anggota LIKE '%$my_data%' ORDER BY nama_anggota DESC");

while ($row = mysql_fetch_array($query)) {
    $data[] = $row['nama_anggota']." (".$row['nip'].")";
}
//return json data
echo json_encode($data);
?>