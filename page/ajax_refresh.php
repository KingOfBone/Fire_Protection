<?php
// PDO connect *********
function connect() {
    return new PDO('mysql:host=localhost;dbname=asp', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

$pdo = connect();
$keyword = '%'.$_POST['keyword'].'%';
//$sql = "SELECT * FROM tabel_anggota WHERE nama_anggota LIKE (:keyword) ORDER BY no_anggota ASC LIMIT 0, 10";
$sql="SELECT *, CONCAT(nama_anggota,' (', no_anggota,')') as namakode FROM tabel_anggota WHERE CONCAT(nama_anggota,' (', no_anggota,')') LIKE (:keyword) ORDER BY kode_anggota";
$query = $pdo->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();
$list = $query->fetchAll();
foreach ($list as $rs) {
	// put in bold the written text
	$nama_anggota = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['namakode']);
    $no_anggota = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['no_anggota']);
	// add new option
    echo '<li onclick="set_item(\''.str_replace("'", "\'", $rs['nama_anggota'].'&nbsp('.$rs['no_anggota']).')'.'\')">'.$nama_anggota.'</li>';
    
}
?>