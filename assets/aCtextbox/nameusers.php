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
//$query = $db->query("SELECT *, CONCAT(nama_anggota,' (', nip,')') as namakode FROM tabel_anggota WHERE CONCAT(nama_anggota,' (', nip,')') LIKE '%$my_data%' ORDER BY nama_anggota ASC");
$query = $db->query("SELECT * FROM tabel_users WHERE nama_lengkap LIKE '%$my_data%' ORDER BY nama_lengkap DESC");
while ($row = $query->fetch_assoc()) {
    $data[] = $row['nama_lengkap'];
}
//return json data
echo json_encode($data);
?>