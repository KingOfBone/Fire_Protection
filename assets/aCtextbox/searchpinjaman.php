<?php
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'asp_train';
//connect with the database
$db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
//get search term
$searchTerm = $_GET['term'];
$my_data=mysql_real_escape_string($searchTerm);
//get matched data from skills table
$query = $db->query("SELECT CONCAT(tabel_anggota.nama_anggota,' (', tabel_anggota.nip,')') as namakode , tabel_pinjaman.* 
FROM tabel_pinjaman JOIN tabel_anggota ON tabel_anggota.no_anggota = tabel_pinjaman.no_anggota
WHERE CONCAT(nama_anggota,' (', nip,')') LIKE '%$my_data%' ORDER BY tabel_anggota.nama_anggota ASC");

while ($row = $query->fetch_assoc()) {
    $data[] = $row['namakode'];
}
//return json data
echo json_encode($data);
?>