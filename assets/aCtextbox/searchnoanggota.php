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
$query = $db->query("SELECT *, CONCAT(nama_anggota,' (', no_anggota,')') as namakode FROM tabel_anggota WHERE CONCAT(nama_anggota,' (', nip,')') LIKE '%$my_data%' ORDER BY nama_anggota ASC");

while ($row = $query->fetch_assoc()) {
    $data[] = $row['namakode'];
}
//return json data
echo json_encode($data);
?>